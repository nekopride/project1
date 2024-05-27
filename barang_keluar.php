<?php
include 'config.php';
session_start();

// Proses input barang keluar
if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah_keluar = $_POST['jumlah_keluar'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    // Update stock barang
    $update_stock = "UPDATE barang SET stock = stock - $jumlah_keluar WHERE id_barang = $id_barang";
    mysqli_query($connect, $update_stock);

    // Menambahkan record ke tabel barang_keluar
    $insert_keluar = "INSERT INTO barang_keluar (id_barang, jumlah_keluar, tanggal_keluar) VALUES ($id_barang, $jumlah_keluar, '$tanggal_keluar')";
    mysqli_query($connect, $insert_keluar);

    header("Location: barang_keluar.php");
    exit();
}

// Mengambil data barang dari database untuk dropdown
$query_barang = "SELECT * FROM barang";
$result_barang = mysqli_query($connect, $query_barang);

// Mengambil data barang keluar dari database untuk tampilan tabel
$query_keluar = "SELECT barang_keluar.id_keluar, barang.nama_barang, barang_keluar.jumlah_keluar, barang_keluar.tanggal_keluar
          FROM barang_keluar
          JOIN barang ON barang.id_barang = barang_keluar.id_barang";
$result_keluar = mysqli_query($connect, $query_keluar);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barang Keluar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Input Barang Keluar</h1>
        <form action="barang_keluar.php" method="post">
            <label for="id_barang">Pilih Barang:</label>
            <select name="id_barang" required>
                <?php while ($row = mysqli_fetch_assoc($result_barang)) { ?>
                    <option value="<?= $row['id_barang']; ?>"><?= $row['nama_barang']; ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="jumlah_keluar">Jumlah Keluar:</label>
            <input type="number" name="jumlah_keluar" required>
            <br>
            <label for="tanggal_keluar">Tanggal Keluar:</label>
            <input type="date" name="tanggal_keluar" required>
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <h2>Daftar Barang Keluar</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Keluar</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_keluar) > 0) {
                    while ($row = mysqli_fetch_assoc($result_keluar)) {
                        echo "<tr>
                                <td>" . $row['id_keluar'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>" . $row['jumlah_keluar'] . "</td>
                                <td>" . $row['tanggal_keluar'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data barang keluar</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>