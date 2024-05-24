<?php
include 'config.php';
session_start();


if (isset($_POST['masuk'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query the database
        $query = mysqli_query($connect, "SELECT * FROM user WHERE username='$username' AND password='$password'");
        $data = mysqli_fetch_assoc($query);

        $check = mysqli_num_rows($query);

        if ($check == 0) {
            $_SESSION['error'] = 'Username dan password salah';
        } else {
            $_SESSION['userid'] = $data['id_user'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role_id'] = $data['role_id'];
            $_SESSION['auth'] = 'YES';

            header('Location: index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Username dan password harus diisi';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION["error"]) && $_SESSION["error"] != '') { ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION["error"] ?>
            </div>
        <?php 
        }
        $_SESSION["error"] = '';
        ?>

        <h1>Login</h1>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" name="masuk" value="masuk" class="btn btn-default">Login</button>
        </form>
    </div>
</body>
</html>
