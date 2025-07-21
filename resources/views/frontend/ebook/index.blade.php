@extends('frontend.master')


@section('content')
<h2>Daftar Ebook</h2>

<div class="row">
    @foreach ($ebooks as $ebook)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($ebook->thumbnail)
                    <img src="{{ asset('storage/' . $ebook->thumbnail) }}" class="card-img-top" alt="...">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $ebook->title }}</h5>
                    <p class="card-text">Rp{{ number_format($ebook->price) }}</p>
                    <a href="{{ route('frontend.ebooks.lihat', $ebook->id) }}" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
