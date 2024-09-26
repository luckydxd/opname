@extends('admin.componen.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Tambah Data Pengguna</div>

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

                    <!-- Form untuk input data pengguna -->
                    <form action="{{ route('data_user_store') }}" method="POST">
                        @csrf <!-- Tambahkan CSRF token untuk keamanan -->

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama pengguna" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email pengguna" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi password" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        <a href="{{ route('data_user') }}" class="btn btn-danger mt-3">Cancel</a>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
