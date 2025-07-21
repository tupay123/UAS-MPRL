@extends('frontend.master')
@section('title', $data->title)

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded overflow-hidden">
                        @if ($data->thumbnail)
                            <img src="{{ asset('storage/' . $data->thumbnail) }}" class="img-fluid w-100"
                                alt="{{ $data->title }}">
                        @endif

                        <div class="card-body p-4">
                            <h1 class="fw-bold">{{ $data->title }}</h1>
                            <p class="text-muted mb-2">Rp{{ number_format($data->price) }}</p>
                            <div class="mb-3">
                                <span class="badge bg-{{ $data->is_published ? 'success' : 'secondary' }}">
                                    {{ $data->is_published ? 'Published' : 'Hidden' }}
                                </span>
                            </div>

                            <!-- Tombol Beli -->
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buyModal">
                                💳 Beli Ebook
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="buyModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('ebooks.guest.pay', $data->id) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Isi Data Pembelian</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="name" class="form-control mb-3"
                                                    placeholder="Nama" required>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Email" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                            <hr>


                            <p>{!! nl2br(e($data->description)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
