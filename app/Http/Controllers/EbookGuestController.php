<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Illuminate\Support\Str;
use App\Models\EbookPurchase;
use App\Models\Ebook;

class EbookGuestController extends Controller
{
    public function pay(Request $request, Ebook $ebook)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $orderId = 'GUEST-' . $ebook->id . '-' . time();
        $token = Str::uuid();

        // Simpan ke database
        EbookPurchase::create([
            'order_id' => $orderId,
            'name' => $request->name,
            'email' => $request->email,
            'ebook_id' => $ebook->id,
            'status' => 'pending',
            'download_token' => $token,
        ]);

        // Midtrans params
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $ebook->price,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
            ],
            'item_details' => [
                [
                    'id' => $ebook->id,
                    'price' => $ebook->price,
                    'quantity' => 1,
                    'name' => $ebook->title,
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('frontend.ebook.guest_pay', compact('snapToken', 'token', 'ebook'));
    }

    public function download($token)
    {
        // Ambil pembelian yang sukses berdasarkan token
        $purchase = EbookPurchase::where('download_token', $token)
            ->where('status', 'success') // ✅ fix: harus 'success'
            ->firstOrFail();

        $filePath = storage_path('app/' . $purchase->ebook->file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    public function success($token)
    {
        $purchase = EbookPurchase::where('download_token', $token)->firstOrFail();

        return view('frontend.ebook.success', compact('purchase'));
    }
}
