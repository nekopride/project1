<?php
include 'config.php';
session_start();

// Proses input barang masuk
if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah_masuk = $_POST['jumlah_masuk'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    // Update stock barang
    $update_stock = "UPDATE barang SET stock = stock + $jumlah_masuk WHERE id_barang = $id_barang";
    mysqli_query($connect, $update_stock);

    // Menambahkan record ke tabel barang_masuk
    $insert_masuk = "INSERT INTO barang_masuk (id_barang, jumlah_masuk, tanggal_masuk) VALUES ($id_barang, $jumlah_masuk, '$tanggal_masuk')";
    mysqli_query($connect, $insert_masuk);

    header("Location: barang_masuk.php");
    exit();
}

// Mengambil data barang dari database untuk dropdown
$query_barang = "SELECT * FROM barang";
$result_barang = mysqli_query($connect, $query_barang);

// Mengambil data barang masuk dari database untuk tampilan tabel
$query_masuk = "SELECT barang_masuk.id_masuk, barang.nama_barang, barang_masuk.jumlah_masuk, barang_masuk.tanggal_masuk
          FROM barang_masuk
          JOIN barang ON barang.id_barang = barang_masuk.id_barang";
$result_masuk = mysqli_query($connect, $query_masuk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barang Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Input Barang Masuk</h1>
        <form action="barang_masuk.php" method="post">
            <label for="id_barang">Pilih Barang:</label>
            <select name="id_barang" required>
                <?php while ($row = mysqli_fetch_assoc($result_barang)) { ?>
                    <option value="<?= $row['id_barang']; ?>"><?= $row['nama_barang']; ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="jumlah_masuk">Jumlah Masuk:</label>
            <input type="number" name="jumlah_masuk" required>
            <br>
            <label for="tanggal_masuk">Tanggal Masuk:</label>
            <input type="date" name="tanggal_masuk" required>
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <h2>Daftar Barang Masuk</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Masuk</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_masuk) > 0) {
                    while ($row = mysqli_fetch_assoc($result_masuk)) {
                        echo "<tr>
                                <td>" . $row['id_masuk'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>" . $row['jumlah_masuk'] . "</td>
                                <td>" . $row['tanggal_masuk'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data barang masuk</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>