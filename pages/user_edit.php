<?php
include '../config.php';
session_start();

$roleQuery = "SELECT * FROM role";
$role = mysqli_query($connect, $roleQuery);

$data = []; // Inisialisasi variabel data sebagai array kosong

// Menampilkan data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dataQuery = "SELECT * FROM user WHERE id_user='$id'";
    $result = mysqli_query($connect, $dataQuery);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    }
}

// Cek jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    $updateQuery = "UPDATE user SET nama='$nama', username='$username', password='$password', role_id='$role_id' WHERE id_user='$id'";
    if (mysqli_query($connect, $updateQuery)) {
        $_SESSION['success'] = 'Berhasil memperbaruhi data';
        header("location:../user.php");
        exit();
    } else {
        echo "Error: " . $updateQuery . "<br>" . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit User - Gudang</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
</head>
<body class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800 border-4 border-purple-500">
        <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="../assets/img/editt.jpg"
              alt="edit t"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../assets/img/editm.jpeg"
              alt="edit m"
            />
          </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Edit User</h1>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= isset($data['id_user']) ? $data['id_user'] : '' ?>">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Nama</span>
                            <input type="text" name="nama" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama User" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Username</span>
                            <input type="text" name="username" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Username" value="<?= isset($data['username']) ? $data['username'] : '' ?>">
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input type="password" name="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Password" value="<?= isset($data['password']) ? $data['password'] : '' ?>">
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Role Akses</span>
                            <select class="block w-full mt-1 text-sm form-select border-gray-300 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:shadow-outline-gray py-2" name="role_id">
                                <option value="">Pilih Role Akses</option>
                                <?php while($row = mysqli_fetch_array($role)) { ?>
                                    <option value="<?=$row['id_role']?>" <?= isset($data['role_id']) && $row['id_role'] == $data['role_id'] ? 'selected' : '' ?>><?=$row['nama']?></option>
                                <?php } ?>
                            </select>
                        </label>
                        <div class="flex justify-between mt-4">
                            <a class="block w-1/2 px-6 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red mr-2" href="../user.php">
                                Kembali
                            </a>
                            <button type="submit" name="update" class="block w-1/2 px-5 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple ml-2">
                                Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>