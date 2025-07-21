<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Models\EbookPurchase;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::where('is_published', true)->latest()->get();
        return view('frontend.ebook.index', compact('ebooks'));
    }

    public function show($id)
    {
        $data = Ebook::findOrFail($id);
        return view('frontend.ebook.show', compact('data')); // atau dashboard.ebook.show tergantung struktur
    }


public function download($token)
{
    $purchase = EbookPurchase::where('download_token', $token)
        ->where('status', 'success')
        ->firstOrFail();

    $filePath = storage_path('app/' . $purchase->ebook->file);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    return response()->download($filePath);
}

}
