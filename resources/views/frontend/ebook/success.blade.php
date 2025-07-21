@extends('frontend.master')
@section('title', 'Pembelian Berhasil')

@section('content')
<div class="container mt-5 text-center">
    <h2 class="text-success">🎉 Pembayaran Berhasil!</h2>
    <p>Terima kasih, {{ $purchase->name }}. Ebook kamu sudah siap didownload.</p>

    <a href="{{ route('ebooks.guest.download', $purchase->download_token) }}" class="btn btn-primary mt-3">
        📥 Download Ebook
    </a>
</div>
@endsection
