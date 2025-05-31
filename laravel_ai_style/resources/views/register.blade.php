@extends('front')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Daftar Akun Baru</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ url('/postregister') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="pelanggan">Nama Pelanggan</label>
                        <input class="form-control" value="{{ old('pelanggan') }}" type="text" name="pelanggan" id="pelanggan" placeholder="Masukkan nama lengkap">
                        <span class="text-danger">
                            @error('pelanggan')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        <span class="text-danger">
                            @error('alamat')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="telp">Telepon</label>
                        <input class="form-control" value="{{ old('telp') }}" type="text" name="telp" id="telp" placeholder="Masukkan nomor telepon">
                        <span class="text-danger">
                            @error('telp')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="email">Email</label>
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Masukkan email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan password">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Daftar Sekarang</button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <p>Sudah punya akun? <a href="{{ url('login') }}" class="text-decoration-none">Login di sini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection