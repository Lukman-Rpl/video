@extends('front')

@section('content')

<style>
    /* Style khusus untuk halaman cart */
    .cart-container {
        background: linear-gradient(135deg, #ffffff, #f5f7fa);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .cart-header {
        background: linear-gradient(to right, #3498db, #2ecc71);
        color: white;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .cart-header::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0.1) 75%, transparent 75%);
        background-size: 20px 20px;
        opacity: 0.2;
    }
    
    .cart-body {
        padding: 25px;
    }
    
    .cart-table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .cart-table thead {
        background: linear-gradient(to right, #f5f7fa, #c3cfe2);
        color: #2c3e50;
    }
    
    .cart-table th {
        font-weight: 600;
        padding: 15px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    
    .cart-table td {
        padding: 15px;
        vertical-align: middle;
    }
    
    .cart-table tbody tr {
        transition: all 0.3s;
    }
    
    .cart-table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
        transform: translateY(-2px);
    }
    
    .cart-item-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .cart-item-img:hover {
        transform: scale(1.1);
    }
    
    .cart-item-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        background: linear-gradient(45deg, #e0e0e0, #f5f5f5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
    }
    
    .cart-item-name {
        font-weight: 600;
        margin-bottom: 5px;
        color: #2c3e50;
    }
    
    .cart-item-category {
        color: #7f8c8d;
        font-size: 0.85rem;
    }
    
    .cart-quantity-control {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    
    .cart-quantity-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        color: #2c3e50;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }
    
    .cart-quantity-btn:hover {
        background-color: #3498db;
        color: white;
        transform: scale(1.1);
    }
    
    .cart-quantity-value {
        width: 40px;
        text-align: center;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .cart-price {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .cart-total {
        font-weight: 700;
        color: #e74c3c;
    }
    
    .cart-delete-btn {
        background: linear-gradient(to right, #e74c3c, #c0392b);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 8px 15px;
        font-size: 0.85rem;
        transition: all 0.3s;
    }
    
    .cart-delete-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }
    
    .cart-footer {
        background: linear-gradient(to right, #f5f7fa, #c3cfe2);
        color: #2c3e50;
        font-weight: 700;
        padding: 15px;
        border-radius: 0 0 10px 10px;
    }
    
    .cart-total-amount {
        font-size: 1.5rem;
        color: #e74c3c;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    .cart-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }
    
    .cart-cancel-btn {
        background: linear-gradient(to right, #e74c3c, #c0392b);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }
    
    .cart-cancel-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
    }
    
    .cart-checkout-btn {
        background: linear-gradient(to right, #2ecc71, #27ae60);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
    }
    
    .cart-checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
    }
    
    .empty-cart {
        text-align: center;
        padding: 50px 0;
    }
    
    .empty-cart-icon {
        font-size: 5rem;
        color: #bdc3c7;
        margin-bottom: 20px;
    }
    
    .empty-cart-text {
        font-size: 1.5rem;
        color: #7f8c8d;
        margin-bottom: 30px;
    }
    
    .empty-cart-btn {
        background: linear-gradient(to right, #3498db, #2980b9);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }
    
    .empty-cart-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
    }
</style>

@if (session('cart'))

<div class="cart-container">
    <div class="cart-header">
        <h4 class="mb-0"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</h4>
    </div>
    <div class="cart-body">
        <div class="cart-actions mb-4">
            <a class="cart-cancel-btn" href="{{ url('batal') }}">
                <i class="bi bi-x-circle me-1"></i> Batal Pesanan
            </a>
        </div>
        @php
            $no=1;
            $total=0;
        @endphp
        <div class="table-responsive">
            <table class="table table-hover cart-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="35%">Menu</th>
                        <th width="15%">Harga</th>
                        <th width="20%">Jumlah</th>
                        <th width="15%">Total</th>
                        <th width="10%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart') as $idmenu=>$menu)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if(isset($menu['gambar']) && !empty($menu['gambar']))
                                        <img src="{{ asset('gambar/'.$menu['gambar']) }}" alt="{{ $menu['menu'] }}" class="cart-item-img me-3">
                                    @else
                                        <div class="cart-item-placeholder me-3">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="cart-item-name">{{ $menu['menu'] }}</div>
                                        <div class="cart-item-category">{{ isset($menu['kategori']) ? $menu['kategori'] : 'Tidak ada kategori' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="cart-price">Rp {{ number_format($menu['harga'], 0, ',', '.') }}</td>
                            <td>
                                <div class="cart-quantity-control">
                                    <a href="{{ url('kurang/'.$menu['idmenu']) }}" class="cart-quantity-btn">
                                        <i class="bi bi-dash"></i>
                                    </a>
                                    <span class="cart-quantity-value">{{ $menu['jumlah'] }}</span>
                                    <a href="{{ url('tambah/'.$menu['idmenu']) }}" class="cart-quantity-btn">
                                        <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="cart-total">Rp {{ number_format($menu['jumlah'] * $menu['harga'], 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ url('hapus/'.$menu['idmenu']) }}" class="cart-delete-btn">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    @php
                        $total=$total+($menu['jumlah'] * $menu['harga']);
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="cart-footer">
                        <td colspan="4" class="text-end">Total Pembayaran</td>
                        <td colspan="2" class="cart-total-amount">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-end mt-4">
            <a class="cart-checkout-btn" href="{{ url('checkout') }}">
                <i class="bi bi-cart-check me-1"></i> Checkout
            </a>
        </div>
    </div>
</div>
    
@else
<div class="empty-cart">
    <div class="empty-cart-icon">
        <i class="bi bi-cart-x"></i>
    </div>
    <div class="empty-cart-text">
        Keranjang belanja Anda kosong
    </div>
    <a href="{{ url('/') }}" class="empty-cart-btn">
        <i class="bi bi-shop me-1"></i> Mulai Belanja
    </a>
</div>
<script>
    // Redirect setelah 3 detik
    setTimeout(function() {
        window.location.href="/";
    }, 3000);
</script>
@endif
    
@endsection