@extends('dashboard.master')

@section('title', 'New Ebook')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h2 class="mb-3">New Ebook</h2>
        </div>
    </div>
    <section class="content">
        <form action="{{ route('dashboard.ebooks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    {{-- Kolom kiri --}}
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Utama</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom kanan --}}
                    <div class="col-md-4">
                        {{-- Upload File --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">File Ebook</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Upload PDF</label>
                                    <input type="file" name="file" class="form-control" accept=".pdf" required>
                                </div>
                            </div>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thumbnail</h3>
                            </div>
                            <div class="card-body">
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            </div>
                        </div>

                        {{-- Harga & Status --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" name="price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Status Publikasi</label>
                                    <select name="is_published" class="form-control">
                                        <option value="1">Terbitkan</option>
                                        <option value="0">Sembunyikan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block">Simpan Ebook</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
