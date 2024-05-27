<?php
include 'config.php'; // Pastikan file ini mengandung informasi koneksi ke database
session_start();

// Proses input barang baru
if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $stock = $_POST['stock'];

    // Menambahkan barang ke database
    mysqli_query($connect, "INSERT INTO barang VALUES ('', '$nama_barang', '$stock')");

    $_SESSION['success'] = 'Berhasil menambahkan data';
}

// Mengambil data barang dari database untuk tampilan tabel
$query_barang = "SELECT * FROM barang";
$result_barang = $connect->query($query_barang);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah dan Tampilkan Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Barang Baru</h1>
        <form action="tambah_barang.php" method="post">
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang:</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>
            <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
        </form>

        <h2>Daftar Barang</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_barang->num_rows > 0) {
                    while ($row = $result_barang->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id_barang'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>" . $row['stock'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data barang</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>