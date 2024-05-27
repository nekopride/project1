<?php
include 'config.php';
session_start();

// Proses input barang keluar
if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah_keluar = $_POST['jumlah_keluar'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    // Cek stok saat ini
    $cek_stok = "SELECT stock FROM barang WHERE id_barang = $id_barang";
    $stok_result = mysqli_query($connect, $cek_stok);
    $stok_data = mysqli_fetch_assoc($stok_result);

    if ($stok_data['stock'] >= $jumlah_keluar) {
        // Update stock barang
        $update_stock = "UPDATE barang SET stock = stock - $jumlah_keluar WHERE id_barang = $id_barang";
        mysqli_query($connect, $update_stock);

        // Menambahkan record ke tabel barang_keluar
        $insert_keluar = "INSERT INTO barang_keluar (id_barang, jumlah_keluar, tanggal_keluar) VALUES ($id_barang, $jumlah_keluar, '$tanggal_keluar')";
        mysqli_query($connect, $insert_keluar);

        header("Location: barang_keluar.php");
        exit();
    } else {
        $_SESSION['error'] = "Stok tidak cukup untuk barang ini.";
    }
}

// Mengambil data barang dari database untuk dropdown
$query_barang = "SELECT * FROM barang WHERE stock > 0";
$result_barang = mysqli_query($connect, $query_barang);

// Mengambil data barang keluar dari database untuk tampilan tabel
$limit = 10; // Jumlah barang keluar per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini
$offset = ($page - 1) * $limit; // Offset untuk query

$query_keluar = "SELECT barang_keluar.id_keluar, barang.nama_barang, barang_keluar.jumlah_keluar, barang_keluar.tanggal_keluar
          FROM barang_keluar
          JOIN barang ON barang.id_barang = barang_keluar.id_barang
          LIMIT $limit OFFSET $offset";
$result_keluar = mysqli_query($connect, $query_keluar);

// Menghitung total halaman
$total_keluar = mysqli_query($connect, "SELECT COUNT(*) AS total FROM barang_keluar")->fetch_assoc()['total'];
$total_pages = ceil($total_keluar / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barang Keluar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <h1>Daftar Barang Keluar</h1>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php } ?>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarangKeluarModal">
            Tambah Barang Keluar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="tambahBarangKeluarModal" tabindex="-1" aria-labelledby="tambahBarangKeluarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBarangKeluarModalLabel">Tambah Barang Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="barang_keluar.php" method="post">
                            <div class="mb-3">
                                <label for="id_barang" class="form-label">Pilih Barang:</label>
                                <select name="id_barang" id="id_barang" class="form-select" required>
                                    <?php while ($row = mysqli_fetch_assoc($result_barang)) { ?>
                                        <option value="<?= $row['id_barang']; ?>"><?= $row['nama_barang']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_keluar" class="form-label">Jumlah Keluar:</label>
                                <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_keluar" class="form-label">Tanggal Keluar:</label>
                                <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
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

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="barang_keluar.php?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
