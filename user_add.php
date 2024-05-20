<?php
include("config.php");
session_start();

$level = $dbconnect->query("SELECT u.*,r.nama as nama_role FROM user as u INNER JOIN role as r ON u.role_id=r.id_role");

if(isset($_SESSION['userid'])){
    if($_SESSION['role_id']==2){
        header('location:gudang.php');
    }
}else{
    $_SESSION['error'] = 'anda harus login terlebih dahulu';
    header('location:login.php');
}
?>

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
       <?php if (isset($_SESSION["success"])&& $_SESSION['success']!=''){?>
     <div class ="alert alert.success" role="alert">
          <?$_SESSION['success']?>
     </div> 
     <?php
     }
     $_SESSION['success']='';
     ?> 
     <h1>list user</h1>
     <a href="/user_add.php" class="btn btn-primasry">tambahdata</a>
     <table class="table table-bordered">
          <tr>
               <th>ID user</th>
               <th>Nama</th>
               <th>Usertname</th>
               <th>Password</th>
               <th>level Akses</th>
               <th>Aksi</th>
          </tr>
          <?php
          while ($row = $viwe->fetch_array()) { ?> 
          <tr>
               <td> <?= $row['id_user'] ?></td>
               <td> <?= $row['nama'] ?></td>
               <td> <?= $row['username'] ?></td>
               <td> <?= $row['password'] ?></td>
               <td> <?= $row['nama_role'] ?></td>
               <td> 
                    <a href="user_edit.php?id=<?= $row['id_user']?>">Edit</a>
                    <a href="user_hapus.php?id=<?= $row['id_user']?>"onclick="retrun confrim('apakah anda yakin?')">Hapus</a>
               </td>
          </tr>
          <?php 
          }?>
     </table>
    </div>
</body>
</html>


