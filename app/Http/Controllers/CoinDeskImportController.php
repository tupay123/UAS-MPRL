<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;

class CoinDeskImportController extends Controller
{
    public function import()
    {
        // 1. Setup user dan kategori
        $admin = User::where('email', 'admin@admin.com')->firstOrFail();
        $category = Category::firstOrCreate(
            ['title' => 'Crypto News'],
            ['slug' => 'crypto-news', 'status' => true]
        );

        // 2. Ambil data RSS
        $response = Http::get('https://www.coindesk.com/arc/outboundfeeds/rss');
        if (!$response->successful()) {
            return response()->json(['error' => 'Gagal mengambil RSS'], 500);
        }

        $xml = simplexml_load_string($response->body());
        $importedCount = 0;

        // 3. Buat folder public/uploads/post jika belum ada
        $uploadPath = public_path('uploads/post');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        foreach ($xml->channel->item as $item) {
            $slug = Str::slug((string)$item->title);

            // Cek duplikat berdasarkan slug
                        // Tambahkan pengecekan berdasarkan title juga untuk lebih aman
            if (Post::where('slug', $slug)->orWhere('title', (string)$item->title)->exists()) {
                \Log::info('Artikel duplikat dilewati: ' . (string)$item->title);
                continue;
            }

            // 4. Download dan simpan gambar ke public/uploads/post
            $thumbnailUrl = $this->getImageUrl($item);
            $imageName = null;

            if ($thumbnailUrl) {
                try {
                    $imageContents = file_get_contents($thumbnailUrl);
                    $imageName = md5(time().rand(11111, 99999)).'.jpg';
                    file_put_contents(public_path("uploads/post/".$imageName), $imageContents);
                } catch (\Exception $e) {
                    \Log::error("Gagal download gambar: " . $e->getMessage());
                }
            }

            // 5. Buat post dengan struktur yang sama seperti store()
            $post = Post::create([
                'user_id' => $admin->id,
                'title' => (string)$item->title,
                'slug' => $slug,
                'category_id' => $category->id,
                'content' => $this->cleanContent((string)$item->children('content', true)->encoded),
                'thumbnail' => $imageName,
                'is_featured' => false, // Default false seperti di store()
                'enable_comment' => true, // Default true
                'status' => true // Default true untuk import
            ]);

            // 6. Proses tags
            $this->processTags($post, $item);
            $importedCount++;
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil import ' . $importedCount . ' artikel',
            'redirect' => route('dashboard.posts.index')
        ]);
    }

    protected function getImageUrl($item)
    {
        $media = $item->children('media', true);
        return $media->content ? (string)$media->content->attributes()->url : null;
    }

    protected function cleanContent($html)
    {
        return strip_tags($html, '<p><a><img><h1><h2><h3><ul><ol><li><strong><em><br>');
    }

    protected function processTags($post, $item)
    {
        foreach ($item->category as $category) {
            $tagName = Str::lower((string)$category);
            if (!empty(trim($tagName))) {
                $tag = Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['slug' => Str::slug($tagName)]
                );
                $post->tags()->attach($tag->id);
            }
        }
    }
}
