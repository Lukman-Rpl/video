
<h3>Insert Kategori</h3>
<div class="form-group">

<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Kategori</label>
     <input type="text" name="Kategori" require placeholder="ISI KATEGORI" class="form-control">
    </div>
    <div>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
    </div>
</form>
<?php
if (isset($_POST['simpan'])) {

    $kategori=$_POST['kategori'];

    $sql="UPDATE tblkategori SET kategori='$kategori WHERE idkategori=$id";

    $db->runSQL($sql);

    header('location:?f=Kategori&m=select');
}

?>
