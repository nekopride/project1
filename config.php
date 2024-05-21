<?php
 $host = "localhost";
 $user = "root";
 $pass = "";
 $db = "gudang";

 $connect = new mysqli("$host", "$user", "$pass", "$db");

 if($connect -> connect_error)
 {
    echo "koneksi gagal ->".$connect ->connect_error;
 }
?>