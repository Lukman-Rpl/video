<h3>Menu</h3>

<div class="mt-4 mb-4">
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $where = "WHERE idkategori = $id";
    $idParam = "&id=" . $id;
} else {
    $where = "";
    $idParam = "";
}
?>
</div>

<?php
$jumlahdata = $db->rowCOUNT("SELECT idmenu FROM tblmenu $where");
$banyak = 3;
$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM tblmenu $where ORDER BY menu ASC LIMIT $mulai, $banyak";
$row = $db->getALL($sql);
$no = 1 + $mulai;
?>

<?php if (!empty($row)) : ?>
    <?php foreach ($row as $r) : ?>
        <div class="card" style="width: 255px; float: left; margin: 10px;">
            <img style="height: 265px" src="Upload/<?php echo $r['gambar'] ?>" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title"><?php echo $r['menu'] ?></h5>
                <p class="card-text">Rp.<?php echo $r['harga'] ?></p>
                <a class="btn btn-primary" href="?f=Home&m=beli&id=<?php echo $r['idmenu'] ?>" role="button">Beli</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>Belum ada menu yang tersedia.</p>
<?php endif; ?>

<div style="clear:both;">
    <?php
    for ($i = 1; $i <= $halaman; $i++) {
        echo '<a href="?f=Home&m=produk&p=' . $i . $idParam . '">' . $i . '</a>&nbsp;&nbsp;&nbsp;';
    }
    ?>
</div>
