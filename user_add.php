<?php
include 'config.php';
session_start();

$role = mysqli_query($connect,"SELECT * FROM role");

if (isset($_POST['simpan'])){
     $nama = $_POST['nama'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     $role_id = $_POST['role_id'];

     mysqli_query($connect, "INSERT INTO user VALUES ('','$nama','$password','$username','$role_id')");

     $_SESSION['success'] = 'berhasil menambahkan data';

     header("location: user.php");
}

?>
<!DOCTYPE html>
<html>
     <head>
          <title> Tambah Data</title>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
       
     </head>
     <body>
          <div class="container">
               <h1> Tambah User</h1>
               <form method="post">
                    <div class="form-group">
                         <label>Nama User</label>
                         <input type="text" name="nama" class="form-control" placeholder="Nama User">
                    </div>
                    <div class="form-group">
                         <label>Username</label>
                         <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                         <label>Password</label>
                         <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                         <label>Role Akses</label>
                         <select class="form-control" name="role_id">
                              <option value="">Pilih Role Akses</option>
                         <?php while($row = mysqli_fetch_array($role)){?>
                              <option value="<?= $row['id_role'] ?>"><?= $row['nama'] ?></option>
                         <?php }?>
                         </select>
                    </div>
                    <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                    <a href="user.php" class="btn btn-warning">Kembali</a>
               </form>
          </div>
     </body>
</html>