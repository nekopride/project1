<?php
include 'config.php';

if (isset($_GET['id'])){
     $id = $_GET['id'];

     mysqli_query($connect, " DELETE FROM barang WHERE id_barang='$id' ");
     header("location:barang.php");
}
?>