<?php
include 'config.php';
session_start();

// Proses input barang keluar
if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah_keluar = $_POST['jumlah_keluar'];
    $tanggal_keluar = date('Y-m-d');

    // Cek stok saat ini
    $cek_stok = "SELECT stock FROM barang WHERE id_barang = $id_barang";
    $stok_result = mysqli_query($connect, $cek_stok);
    $stok_data = mysqli_fetch_assoc($stok_result);

    if ($stok_data['stock'] >= $jumlah_keluar) {
        // Update stock barang
        $update_stock = "UPDATE barang SET stock = stock - $jumlah_keluar WHERE id_barang = $id_barang";
        mysqli_query($connect, $update_stock);

        // Menambahkan record ke tabel barang_keluar
        $barang_keluar = "INSERT INTO barang_keluar (id_barang, jumlah_keluar, tanggal_keluar) VALUES ($id_barang, $jumlah_keluar, '$tanggal_keluar')";
        mysqli_query($connect, $barang_keluar);

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
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barang Masuk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
    <link rel="stylesheet" href="./assets/css/baru.css">
</head>
<body>

<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Desktop sidebar -->
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                Gudang
            </a>
            <ul class="mt-6">
            <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="index.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Home</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="tambah_barang.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="ml-4">List Barang</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="barang_masuk.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <!-- Panah ke bawah -->
                            <path d="M12 2v8"></path>
                            <path d="M9 7l3 3 3-3"></path>
                            <!-- Kardus -->
                            <path d="M3 9l9-5 9 5-9 5-9-5z"></path>
                            <path d="M3 9v6l9 5 9-5V9"></path>
                            <path d="M12 14l9-5"></path>
                            <path d="M12 14L3 9"></path>
                        </svg>
                        <span class="ml-4">Barang Masuk</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="barang_keluar.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <!-- Panah ke bawah -->
                            <path d="M12 2v8"></path>
                            <path d="M9 7l3 -3 3 3"></path>
                            <!-- Kardus -->
                            <path d="M3 9l9-5 9 5-9 5-9-5z"></path>
                            <path d="M3 9v6l9 5 9-5V9"></path>
                            <path d="M12 14l9-5"></path>
                            <path d="M12 14L3 9"></path>
                        </svg>
                        <span class="ml-4">Barang Keluar</span>
                    </a>
                </li>
            </ul>
             <div class="px-6 my-6">
                        <a href="pages/user_add.php">
                    <button
                      class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                      Create account
                      <span class="ml-2" aria-hidden="true">+</span>
                    </button>
                  </div>
        </div>
    </aside>

    <div class="flex flex-col flex-1 w-full">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <!-- Search input -->
            <div class="">
             
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <li class="flex">
                <button>
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="user.php"
                      >
                        <svg
                          class="w-6 h-6"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor" 
                        >
                        <g transform="translate(0, 2)" fill="#ac94fa">
                            <circle cx="8" cy="8" r="4"></circle>
                            <path d="M8 12c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                          </g>
                          <g transform="translate(8, 2)" fill="#ac94fa">
                            <circle cx="8" cy="8" r="4"></circle>
                            <path d="M8 12c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                          </g>
                        </svg>
                      </a>
                  </button>
                </li>              
              <li class="flex">
                <button>
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="logout.php"
                      >
                        <svg
                          class="w-6 h-6"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                      </a>
                  </button>
                </li>
            </ul>
          </div>

        </header>

        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid">

    <h1 class="text-lg leading-3 font-medium text-gray-900 dark:text-gray-200">Daftar Barang Keluar</h1>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php } ?>

            

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <form method="post" action="">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Barang</span>
                            <select name="id_barang" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                <?php while($data_barang = mysqli_fetch_array($result_barang)) { ?>
                                    <option value="<?php echo $data_barang['id_barang']; ?>"><?php echo $data_barang['nama_barang']; ?></option>
                                <?php } ?>
                            </select>
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Jumlah Keluar</span>
                            <input name="jumlah_keluar" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                        </label>

                        <input name="submit" type="submit" value="Tambah" class="mt-4 px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700" />
                    </form>
                </div>

                <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                    Data Barang Keluar
                </h4>
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">ID Masuk</th>
                                    <th class="px-4 py-3">Nama Barang</th>
                                    <th class="px-4 py-3">Jumlah Keluar</th>
                                    <th class="px-4 py-3">Tanggal Keluar</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <?php while($row = mysqli_fetch_array($result_keluar)) { ?>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm"><?php echo $row['id_keluar']; ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo $row['nama_barang']; ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo $row['jumlah_keluar']; ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo $row['tanggal_keluar']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
