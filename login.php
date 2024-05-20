<?php
include 'config.php';
session_start();

print_r($_SESSION);

if(isset($post['Masuk']))

{
     $username = $_post['username'];
     $password = $_post['password'];

     $query = mysqli_query($dbconnect, "SELECT * FROM WHERE username='$username' and password=$'$password' ");

     $datadata = mysqli_fetch_assoc($query);

     $check = mysqli_num_rows($query);

     if(!$check) {
          $_SESSION['error'] = 'username dan password salah';
     }
     else
     {
          $_SESSION['userid'] = $data['id_user'];
          $_SESSION['nama'] = $data['$nama'];
          $_SESSION['role_id'] = $data['role_id'];
          $_SESSION['auth'] = 'YES';

          header ('location:index.php');
     }
}
?>

<!DOCTYPE html>
<html>
<head>
     <title> login </title>
     <link rel="stylesheet" href="https://maxcdn.boostrapcdn.com/booststrap/3.3.7/css/bootstrap.min.css"
     integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     
</head>
<body>
     <div class="container">
       <?php if (isset($_SESSION["error"])&& $_SESSION['error']!=''){?>
     <div class ="alert alert.danger" role="alert">
          <?$_SESSION['error']?>
     </div> 
     <?php
       }
       $_SESSION['error'] = ';'
       ?>

       <h1>login</h1>
       <form method="post">
          <div class="form-group">
               <label for="exampleinputemail">username</label>
               <input type="text" class="'form-control" name="'username" placeholder="'username">
          </div>
          <div class="form-control">
               <label for="exampleinputpassword">password</label>
               <input type="password" class="'form-control" name="password" placeholder="password">
          </div>
          <button type="sumbit" name="masuk" value="masuk" class="btn btn-default">login</button>
       </form>
</body>
</html>