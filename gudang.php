<?php
session_start();

if(isset($_SESSION['userid'])){
    if($_SESSION['role_id']==1){
        header('location:index.php');
    }
}else{
    $_SESSION['error'] = 'anda harus login terlebih dahulu';
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
     <title>gudang</title>
     <link rel="stylesheet" href="https://maxcdn.boostrapcdn.com/booststrap/3.3.7/css/bootstrap.min.css"
     integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
     <div class="container">
          <h1>hai</h1>
          <h2>selamat datang <?=$_SESSION['nama']?></h2>
          <a href="logout.php">logout</a>
     </div>
</body>
</html>