<?php
include 'config.php';
session_start();

if (isset($_POST['simpan'])){
     $nama = $_POST['nama'];

     mysqli_query($connect,"INSERT INTO role values('','$nama')");

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
        <h1>Tambah role</h1>
        <form method="post">
            <div class="form-group">
                <label>name role</label>
                <input type="text" name="nama" class="form-control" placeholder="nama role">
            </div>
        <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
        <a href="/role.php" class="btn btn-warning">kembali</a>
        </form>
    </div>
    </body>
</html>

