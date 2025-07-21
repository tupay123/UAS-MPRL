@extends('dashboard.layouts.main')

@section('content')
<h2>Edit Ebook</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('ebooks.update', $ebook->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" value="{{ $ebook->title }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="4">{{ $ebook->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Ganti File PDF (kosongkan jika tidak ingin ganti)</label>
        <input type="file" name="file" class="form-control" accept=".pdf">
        <small>File sekarang: <a href="{{ asset('storage/' . $ebook->file) }}" target="_blank">Lihat</a></small>
    </div>

    <div class="mb-3">
        <label>Ganti Thumbnail (kosongkan jika tidak ingin ganti)</label>
        <input type="file" name="thumbnail" class="form-control" accept="image/*">
        @if ($ebook->thumbnail)
            <small><img src="{{ asset('storage/' . $ebook->thumbnail) }}" width="100"></small>
        @endif
    </div>

    <div class="mb-3">
        <label>Harga (Rp)</label>
        <input type="number" name="price" value="{{ $ebook->price }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Status Publikasi</label>
        <select name="is_published" class="form-control">
            <option value="1" {{ $ebook->is_published ? 'selected' : '' }}>Terbitkan</option>
            <option value="0" {{ !$ebook->is_published ? 'selected' : '' }}>Sembunyikan</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Perbarui</button>
</form>
@endsection
