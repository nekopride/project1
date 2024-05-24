<?php
include 'config.php';

if (isset($_GET['id'])){
     $id = $_GET['id'];

     mysqli_query($connect, " DELETE FROM user WHERE id_user='$id' ");
     header("location:barang.php");
}
?>