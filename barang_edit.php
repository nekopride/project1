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
    $level = $_POST['level1'];

    mysqli_query($connect, "UPDATE barang SET nama='$nama', harga='$harga', stock='$stock', level1='$level' where id_barang = '$id' ");

    header("location:barang.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Barang</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Edit Barang</h1>
            <form method="POST">
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
                <label for="level1">Kategori:</label>
                    <select name="level1">
                        <option value="elektronik" <?php if ($data['level1'] == 'elektronik') echo 'selected'; ?>>elektronik</option>
                        <option value="makanan" <?php if ($data['level1'] == 'makanan') echo 'selected'; ?>>makanan</option>
                        <option value="minuman" <?php if ($data['level1'] == 'minuman') echo 'selected'; ?>>minuman</option>
                        <option value="pakaian" <?php if ($data['level1'] == 'pakaian') echo 'selected'; ?>>pakaian</option>
                    </select>
                </div>
            <input type="submit" name="update" value="Update" class="btn btn-primary">
            <a href="barang.php" class="btn btn-warning">Cancel</a>
            </form>
        </div>
    </body>
</html>