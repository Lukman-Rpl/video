<?php
// Inisialisasi variabel where (kosongkan dulu, bisa nanti ditambah filter)
$where = "";

// Hitung total data order
$jumlahdata = $db->rowCOUNT("SELECT idorder FROM tblorder $where");

$banyak = 2; // data per halaman
$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = (int)$_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

// Query gabungkan tblorder dengan tblpelanggan untuk dapat nama pelanggan
$sql = "SELECT o.*, p.pelanggan FROM tblorder o
        LEFT JOIN tblpelanggan p ON o.idpelanggan = p.idpelanggan
        $where ORDER BY o.status ASC, o.idorder ASC LIMIT $mulai, $banyak";

$row = $db->getALL($sql);

$no = 1 + $mulai;
?>

<h3>Order Pembelian</h3>
<table class="table table-bordered w-70">
  <thead>
    <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Bayar</th>
        <th>Kembali</th>
        <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($row)) : ?>
        <?php foreach ($row as $r) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($r['pelanggan']) ?></td>
                <td><?= htmlspecialchars($r['tglorder']) ?></td>
                <td>Rp. <?= number_format($r['total'], 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($r['bayar'], 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($r['kembali'], 0, ',', '.') ?></td>
                <td>
                    <?php
                    if ($r['status'] == 0) {
                        echo '<a href="?f=Order&m=bayar&id=' . $r['idorder'] . '">Bayar</a>';
                    } else {
                        echo 'Lunas';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7" class="text-center">Data tidak ditemukan</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php
// Pagination
for ($i = 1; $i <= $halaman; $i++) {
    echo '<a href="?f=Order&m=select&p=' . $i . '">' . $i . '</a> &nbsp;&nbsp;';
}
?>
