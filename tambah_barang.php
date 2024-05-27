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
$limit = 10; // Jumlah barang per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini
$offset = ($page - 1) * $limit; // Offset untuk query

$query_barang = "SELECT * FROM barang LIMIT $limit OFFSET $offset";
$result_barang = $connect->query($query_barang);

// Menghitung total halaman
$total_barang = $connect->query("SELECT COUNT(*) AS total FROM barang")->fetch_assoc()['total'];
$total_pages = ceil($total_barang / $limit);

// Cek stok habis dan set notifikasi
while ($row = $result_barang->fetch_assoc()) {
    if ($row['stock'] < 1) {
        $_SESSION['notif'] = "Stok barang " . $row['nama_barang'] . " habis!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        
    <h1>List Barang</h1>
        <?php if (isset($_SESSION['notif'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $_SESSION['notif']; unset($_SESSION['notif']); ?>
            </div>
        <?php } ?>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
            Tambah Barang
        </button>

        <!-- Modal -->
        <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="tambahBarangModalLabel">Tambah Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="tambah_barang.php" method="post">
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang:</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock:</label>
                                <input type="number" name="stock" id="stock" class="form-control" required>
                            </div>
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>

       
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Stock</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result_barang = $connect->query($query_barang); // Query ulang untuk reset pointer
                if ($result_barang->num_rows > 0) {
                    while ($row = $result_barang->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id_barang'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>" . $row['stock'] . "</td>

                                <td>
                                    <a href='barang_hapus.php?id=" . $row['id_barang'] . "' class='btn btn-danger'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data barang</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="tambah_barang.php?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</html>