<?php

include 'config.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetching data based on ID
    $data = mysqli_query($dbconnect, "SELECT * FROM role WHERE id_role = '$id'"); 
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST["update"])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];

    // Correcting the update query
    mysqli_query($dbconnect, "UPDATE role SET nama = '$nama' WHERE id_role = '$id'");
    $_SESSION['success'] = 'Berhasil memperbarui data';
    
    // Redirecting to role.php
    header("Location: role.php");
}
?>
