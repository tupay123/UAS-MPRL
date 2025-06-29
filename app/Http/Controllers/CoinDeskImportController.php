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
    $admin = User::where('email', 'admin@admin.com')->firstOrFail();
    $importedCount = 0;

    $response = Http::get('https://www.coindesk.com/arc/outboundfeeds/rss');
    if (!$response->successful()) {
        return response()->json(['error' => 'Gagal mengambil RSS'], 500);
    }

    $xml = simplexml_load_string($response->body());

    $uploadPath = public_path('uploads/post');
    if (!File::exists($uploadPath)) {
        File::makeDirectory($uploadPath, 0755, true);
    }

    foreach ($xml->channel->item as $item) {
        $slug = Str::slug((string)$item->title);

        if (Post::where('slug', $slug)->orWhere('title', (string)$item->title)->exists()) {
            \Log::info('Artikel duplikat dilewati: ' . (string)$item->title);
            continue;
        }

        // Ambil kategori utama dari item (domain="https://www.coindesk.com/markets")
        $primaryCategory = null;
        foreach ($item->category as $category) {
            if (isset($category['domain']) && (string)$category['domain'] === 'https://www.coindesk.com/markets') {
                $primaryCategory = (string)$category;
                break;
            }
        }

        // Jika tidak ada kategori utama, gunakan default
        $category = $primaryCategory ?
            Category::firstOrCreate(
                ['title' => $primaryCategory],
                ['slug' => Str::slug($primaryCategory), 'status' => true]
            ) :
            Category::firstOrCreate(
                ['title' => 'Crypto News'],
                ['slug' => 'crypto-news', 'status' => true]
            );

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

        $post = Post::create([
            'user_id' => $admin->id,
            'title' => (string)$item->title,
            'slug' => $slug,
            'category_id' => $category->id,
            'content' => $this->cleanContent((string)$item->children('content', true)->encoded),
            'thumbnail' => $imageName,
            'is_featured' => false,
            'enable_comment' => true,
            'status' => true
        ]);

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
        // Skip kategori yang memiliki atribut domain (karena itu kategori utama)
        if (isset($category['domain'])) {
            continue;
        }

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
