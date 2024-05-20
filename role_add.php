<?php
include 'config.php';
session_start();

if (isset($_POST['simpan'])){
     $nama = $_POST['nama'];

     mysqli_query($dbconnect,"INSERT INTO role values('','$nama')");

     $_SESSION['success'] = 'berhasil menambahkan data';

     header("location:role.php");
}
?>

<!DOCTYPE html>
<html>
<head>
     <title> tambah role </title>
     <link rel="stylesheet" href="https://maxcdn.boostrapcdn.com/booststrap/3.3.7/css/bootstrap.min.css"
     integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>List Barang</h1>
        <a href="barang_add.php" class="btn btn-primary">Tambah Data</a>
        <table class="table table-bordered">
            <tr>
                <th>ID barang</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>tanggal masuk</th>
                <th>Jenis barang</th>
                <th>Aksi</th>
            </tr>
            <?php
            while ($row = $view->fetch_array()) { ?>

            <tr>
                <td><?= $row['id_barang'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td><?= $row['tanggal_masuk'] ?></td>
                <td><?= $row['role'] ?></td>
                <td>
                    <a href="barang_edit.php?id=<?= $row['id_barang']?>">Edit</a> | 
                    <a href="barang_hapus.php?id=<?= $row['id_barang']?>">Hapus</a>
                </td>
            </tr>
            <?php }

            ?>
        </table>
    </div>
    </body>
</html>


