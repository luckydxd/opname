@extends('admin.componen.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Edit Data produk  </div>

                <div class="card-body">
                    <!-- Tampilkan pesan sukses jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tampilkan error jika validasi gagal -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('data_produk_update',$produk ->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $produk->id }}">
                        <div class="row mb-4">
                            <div class="col">
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ $produk->nama }}" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="{{ $produk->kode }}" required>
                            </div>
                        </div>
                        <button type="submit" name="time" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
