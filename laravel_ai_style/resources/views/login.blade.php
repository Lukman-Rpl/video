@extends('front')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Login</h4>
            </div>
            <div class="card-body p-4">
                @if (Session::has('pesan'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ Session::get('pesan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <form action="{{ url('/postlogin') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Masukkan email Anda">
                        </div>
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan password Anda">
                        </div>
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <p>Belum punya akun? <a href="{{ url('register') }}" class="text-decoration-none">Daftar sekarang</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection