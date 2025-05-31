<h3>Pembayaran Order</h3>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="">Tanggal awal</label>
            <input type="date" name="dawal" required class="form-control">
        </div>
        <div class="form-group w-50">
            <label for="">Tanggal akhir</label>
            <input type="date" name="dakhir" required class="form-control">
        </div>
        <div class="mt-3">
            <input type="submit" name="simpan" value="Cari" class="btn btn-primary">
        </div>
    </form>
</div>

<?php
// Inisialisasi variabel $where kosong agar tidak error
$where = "";

// Pagination setup
$banyak = 3;

// Cek halaman saat ini
if (isset($_GET['p'])) {
    $p = (int)$_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

// Default query: ambil data dengan JOIN supaya bisa tampil pelanggan, menu, dll
$sql = "SELECT od.*, p.pelanggan, o.tglorder, m.menu, m.harga, p.alamat
        FROM tblorderdetail od
        LEFT JOIN tblorder o ON od.idorder = o.idorder
        LEFT JOIN tblpelanggan p ON o.idpelanggan = p.idpelanggan
        LEFT JOIN tblmenu m ON od.idmenu = m.idmenu
        $where
        ORDER BY od.idorderdetail ASC
        LIMIT $mulai, $banyak";

// Jika form pencarian tanggal disubmit, ubah query dan $where
if (isset($_POST['simpan'])) {
    $dawal = $_POST['dawal'];
    $dakhir = $_POST['dakhir'];

    // Validasi tanggal jika perlu (optional)

    $where = "WHERE o.tglorder BETWEEN '$dawal' AND '$dakhir'";

    // Update query dengan filter tanggal dan tanpa limit agar semua data yang cocok muncul
    $sql = "SELECT od.*, p.pelanggan, o.tglorder, m.menu, m.harga, p.alamat
            FROM tblorderdetail od
            LEFT JOIN tblorder o ON od.idorder = o.idorder
            LEFT JOIN tblpelanggan p ON o.idpelanggan = p.idpelanggan
            LEFT JOIN tblmenu m ON od.idmenu = m.idmenu
            $where
            ORDER BY od.idorderdetail ASC";
}

// Jalankan query untuk hitung jumlah data sesuai filter (untuk pagination)
$jumlahdata = $db->rowCOUNT("SELECT od.idorderdetail
                             FROM tblorderdetail od
                             LEFT JOIN tblorder o ON od.idorder = o.idorder
                             $where");

// Jika pencarian tanggal, tampilkan semua data tanpa pagination, jadi $row langsung ambil semua
if (isset($_POST['simpan'])) {
    $row = $db->getALL($sql);
    $halaman = 1; // pagination tidak diperlukan saat pencarian
} else {
    // Pagination: ambil data sesuai limit
    $halaman = ceil($jumlahdata / $banyak);
    $row = $db->getALL($sql);
}

$no = 1 + $mulai;
$total = 0;
?>

<table class="table table-bordered w-70">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($row)) : ?>
            <?php foreach ($row as $r) : 
                $subtotal = $r['jumlah'] * $r['harga'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($r['pelanggan']) ?></td>
                    <td><?= htmlspecialchars($r['tglorder']) ?></td>
                    <td><?= htmlspecialchars($r['menu']) ?></td>
                    <td>Rp. <?= number_format($r['harga'], 0, ',', '.') ?></td>
                    <td><?= $r['jumlah'] ?></td>
                    <td>Rp. <?= number_format($subtotal, 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($r['alamat']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"><h3>Grandtotal :</h3></td>
                <td colspan="2"><h4>Rp. <?= number_format($total, 0, ',', '.') ?></h4></td>
            </tr>
        <?php else: ?>
            <tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if (!isset($_POST['simpan'])): ?>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $halaman; $i++) {
            echo '<a href="?f=OrderDetail&m=select&p=' . $i . '">' . $i . '</a> &nbsp;&nbsp;';
        }
        ?>
    </div>
<?php endif; ?>
