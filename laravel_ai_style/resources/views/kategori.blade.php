@extends('front')

@section('content')
<div class="row">
    @foreach ($menus as $menu )
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm hover-card">
            <div class="position-relative">
                <img src="{{ asset('gambar/'.$menu->gambar) }}" class="card-img-top menu-img" alt="{{ $menu->menu }}">
                <div class="menu-overlay">
                    <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-sm btn-primary">Pesan Sekarang</a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $menu->menu }}</h5>
                <p class="card-text text-muted">{{ $menu->deskripsi }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-primary mb-0">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h5>
                    <a href="{{ url('beli/'.$menu->idmenu) }}" class="btn btn-outline-primary">
                        <i class="bi bi-cart-plus"></i> Beli
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .hover-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .menu-img {
        height: 200px;
        object-fit: cover;
    }
    .menu-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .position-relative:hover .menu-overlay {
        opacity: 1;
    }
</style>
@endsection