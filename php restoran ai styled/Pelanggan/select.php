<?php
// Pastikan $db sudah diinisialisasi sebelumnya
// Jika belum, tambahkan:
// require_once('../dbcontroller.php');
// $db = new DB;

$where = ""; // Jika tidak ada filter, set kosong

// Hitung jumlah data pelanggan (gunakan kolom yang ada, contoh idpelanggan)
$jumlahdata = $db->rowCOUNT("SELECT idpelanggan FROM tblpelanggan $where");

$banyak = 3;
$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = (int)$_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

// Query perbaikan: hapus ORDER BY status,idorder ganti dengan idpelanggan
$sql = "SELECT * FROM tblpelanggan $where ORDER BY idpelanggan ASC LIMIT $mulai, $banyak";
$row = $db->getALL($sql);

$no = 1 + $mulai;
?>

<h3>Pelanggan</h3>
<table class="table table-striped w-70">
  <thead>
    <tr>
      <th>No</th>
      <th>Pelanggan</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>Email</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($row as $r) : 
        $status = ($r['aktif'] == 1) ? 'AKTIF' : 'TIDAK AKTIF';
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($r['pelanggan']) ?></td>
      <td><?= htmlspecialchars($r['alamat']) ?></td>
      <td><?= htmlspecialchars($r['telp']) ?></td>
      <td><?= htmlspecialchars($r['email']) ?></td>
      <td><?= $status ?></td>
      <td>
        <a href="?f=Pelanggan&m=update&id=<?= $r['idpelanggan'] ?>">Update</a> | 
        <a href="?f=Pelanggan&m=delete&id=<?= $r['idpelanggan'] ?>" onclick="return confirm('Yakin ingin hapus?')">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
// Pagination links
for ($i = 1; $i <= $halaman; $i++) {
    echo '<a href="?f=Pelanggan&m=select&p=' . $i . '">' . $i . '</a> &nbsp;&nbsp;';
}
?>
