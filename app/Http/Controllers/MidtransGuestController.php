<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbookPurchase;
use Midtrans\Snap;
use Illuminate\Support\Str;

class MidtransGuestController extends Controller
{
public function callback(Request $request)
{
    // Validasi signature (penting untuk keamanan)
    $serverKey = config('midtrans.server_key');
    $validSignature = hash('sha512',
        $request->order_id .
        $request->status_code .
        $request->gross_amount .
        $serverKey
    );

    if ($request->signature_key !== $validSignature) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $purchase = EbookPurchase::where('order_id', $request->order_id)->first();

    if (!$purchase) {
        return response()->json(['message' => 'Purchase not found'], 404);
    }

    // Kalau pembayaran berhasil (settlement), update status
    if ($request->transaction_status === 'settlement') {
        $purchase->status = 'success';
        $purchase->save();
    }

    return response()->json(['message' => 'Callback processed']);
}

}
