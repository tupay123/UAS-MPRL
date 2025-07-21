@extends('dashboard.master')
@section('title', 'All Ebooks')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Ebooks</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Ebooks</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Ebooks</h3>
                            <div class="card-tools">
                                <a href="{{ route('dashboard.ebooks.create') }}" class="btn btn-primary btn-sm">
                                    + New Ebook
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    @foreach ($errors->all() as $error)
                                        <p class="m-0">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if (session("success"))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    <p class="m-0">{{ session("success") }}</p>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Thumbnail</th>
                                        <th>Price</th>
                                        <th>Published</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ebooks as $index => $ebook)
                                    <tr class="text-center align-middle">
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start">{{ $ebook->title }}</td>
                                        <td>
                                            @if($ebook->thumbnail)
                                                <img src="{{ asset('storage/' . $ebook->thumbnail) }}" alt="Thumbnail" width="100">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>Rp{{ number_format($ebook->price) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $ebook->is_published ? 'success' : 'secondary' }}">
                                                {{ $ebook->is_published ? 'Published' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('dashboard.ebooks.show', $ebook->id) }}" class="btn btn-success btn-sm" target="_blank">View</a>
                                                <a href="{{ route('dashboard.ebooks.edit', $ebook->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('dashboard.ebooks.destroy', $ebook->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No ebooks found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            </div>
                        </div>
                        {{-- <div class="card-footer clearfix">
                            {{ $ebooks->links() }} // if you want pagination --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
