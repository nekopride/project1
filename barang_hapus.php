<?php
include 'config.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM barang WHERE id_barang='$id'";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("location:tambah_barang.php");
    } else {
        error_log("Error menghapus barang dengan ID $id: " . mysqli_error($connect));
        $_SESSION['error'] = "Gagal menghapus barang: " . mysqli_error($connect);
        header("location:tambah_barang.php");
    }
}
?>