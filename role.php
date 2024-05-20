<?php
include 'config.php';
session_start();

$view = $dbconnecet->query("SELECT * FROM role"); 
?>

<!DOCTYPE html>
<html>
<head>
     <title> tambah level </title>
     <link rel="stylesheet" href="https://maxcdn.boostrapcdn.com/booststrap/3.3.7/css/bootstrap.min.css"
     integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
   <div class="container">
    <?php if (isset($_SESSION["success"]) && $_SESSION["success"] == ''){?>
        <div class="alert alert-success" level="alert">
            <?=$_SESSION['success']?>
        </div>
    <?php 
    }
    $_SESSION['success']='';
    ?>

    <h1>list role</h1>
    <a href="/role_add.php" class="btn btn-primary">tambah data</a>
   </div>
</body>
</html>


