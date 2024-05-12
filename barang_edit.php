<?php 
include 'config.php';

if (isset($_GET['id'])){
    $id =$_GET['id'];

    $data = mysqli_query($connect, "SELECT * FROM barang where id_barang='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {

    $id= $_GET['id'];

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $level = $_POST['level'];

    mysqli_query($connect, "UPDATE barang SET nama='$nama', harga='$harga', stock='$stock', tanggal_masuk ='$tanggal_masuk', level='$level' where id_barang = '$id' ");

    header("location:barang.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>perbaruhi Barang</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Tambah barang</h1>
            <form method="post">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control" placeholder=" Nama Barang" value="<?= $data['nama']?>">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder=" Harga Barang" value="<?= $data['harga']?>">
                </div>
                <div class="form-group">
                    <label>Stock Barang </label>
                    <input type="number" name="stock" class="form-control" placeholder=" stock barang " value="<?= $data['stock']?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Masuk Barang </label>
                    <input type="date" name="tanggal_masuk" class="form-control" placeholder=" Tanggal Masuk Barang  " value="<?= $data['tanggal_masuk']?>">
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select name="level" class="form-control" >
                        <option value="">-pilih-</option>
                        <?php foreach($level->result() as $key => $data) {?>
                            <option value="<?=$data->level?>" <?=$data->level == $row->level ? "selected" : null?>><?=$data->name?></option>
                        <?php }?>   
                    </select>
                    </div>
            <input type="submit" name="update" value="perbaruhi" class="btn btn-primary">
            <a href="barang.php" class="btn btn-warning">Kembali</a>
            </form>
        </div>
    </body>
</html>