<?php
include 'config.php';

if (isset($_POST['simpan'])) {

    $id_barang = $_POST['id_barang'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $level_barang = $_POST['level'];

    mysqli_query($connect, "INSERT INTO barang VALUES ('$id_barang', '$nama', '$harga', '$stock', '$tanggal_masuk', '$level_barang')");

    header("location:barang.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Barang</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Tambah barang</h1>
            <form method="post">
                <div class="form-group">
                    <label>ID Barang</label>
                    <input type="number" name="id_barang" class="form-control" placeholder=" ID Barang">
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control" placeholder=" Nama Barang">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder=" Harga Barang">
                </div>
                <div class="form-group">
                    <label>Stock Barang </label>
                    <input type="number" name="stock" class="form-control" placeholder=" stock barang ">
                </div>
                <div class="form-group">
                    <label>Tanggal Masuk Barang </label>
                    <input type="date" name="tanggal_masuk" class="form-control" placeholder=" Tanggal Masuk Barang  ">
                </div>
                <div class="form-group">
                    <label >Jenis Barang:</label>
                    <select name="level" class="form-control" required>
                    <option value=""> - pilih jenis barang -</option>
                    <option value="pakaian">pakaian</option>
                    <option value="makanan">makanan</option>
                    <option value="elektronik">elektronik</option>
                    <option value="minuman">minuman</option>
                    </select>
                </div>
            <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
            <a href="barang.php" class="btn btn-warning">Kembali</a>
            </form>
        </div>
    </body>
</html>