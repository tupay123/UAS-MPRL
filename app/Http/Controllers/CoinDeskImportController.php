<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class CoinDeskImportController extends Controller
{
    public function import()
    {
        // 1. Setup user
        $admin = User::where('email', 'admin@admin.com')->firstOrFail();

        // 2. Ambil data RSS
        $response = Http::get('https://www.coindesk.com/arc/outboundfeeds/rss');
        if (!$response->successful()) {
            return response()->json(['error' => 'Gagal mengambil RSS'], 500);
        }

        $xml = simplexml_load_string($response->body());
        $importedCount = 0;

        // 3. Buat folder uploads/post jika belum ada
        $uploadPath = public_path('uploads/post');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // 4. Loop semua item berita
        foreach ($xml->channel->item as $item) {
            $title = (string) $item->title;
            $slug = Str::slug($title);

            // Skip jika slug atau title sudah ada
            if (Post::where('slug', $slug)->orWhere('title', $title)->exists()) {
                \Log::info('Artikel duplikat dilewati: ' . $title);
                continue;
            }

            // Ambil kategori dan tag dari <category>
            $mainCategory = null;
            $tags = [];

            foreach ($item->category as $cat) {
                $domain = (string) $cat->attributes()->domain;
                $value = trim((string) $cat);

                if ($domain !== 'tag' && !$mainCategory) {
                    $mainCategory = $value;
                }

                if ($domain === 'tag') {
                    $tags[] = Str::lower($value);
                }
            }

            // Default kategori jika tidak ditemukan
            $mainCategory = $mainCategory ?: 'Crypto News';

            // Buat atau ambil kategori
            $category = Category::firstOrCreate(
                ['title' => $mainCategory],
                ['slug' => Str::slug($mainCategory), 'status' => true]
            );

            // Ambil URL gambar
            $thumbnailUrl = $this->getImageUrl($item);
            $imageName = null;

            if ($thumbnailUrl) {
                try {
                    $imageContents = file_get_contents($thumbnailUrl);
                    $imageName = md5(time() . rand(11111, 99999)) . '.jpg';
                    file_put_contents(public_path("uploads/post/" . $imageName), $imageContents);
                } catch (\Exception $e) {
                    \Log::error("Gagal download gambar: " . $e->getMessage());
                }
            }

            // Buat post
            $post = Post::create([
                'user_id' => $admin->id,
                'title' => $title,
                'slug' => $slug,
                'category_id' => $category->id,
                'content' => $this->cleanContent((string) $item->children('content', true)->encoded),
                'thumbnail' => $imageName,
                'is_featured' => false,
                'enable_comment' => true,
                'status' => true
            ]);

            // Proses tag
            $this->processTags($post, $tags);
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

    protected function processTags($post, $tags)
    {
        foreach ($tags as $tagName) {
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
