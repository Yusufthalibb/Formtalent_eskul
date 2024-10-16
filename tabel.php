<?php
// Include file koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Inisialisasi variabel dengan nilai awal kosong
$NIK = "";
$nama = "";
$kelas = "";
$jurusan = "";
$talent = "";
$eskul = "";
$nomor_wa = "";
$sukses = "";
$error = "";

// Cek apakah parameter 'op' ada dalam URL
if (isset($_GET['op'])) {
    // Jika 'op' ada, simpan nilai 'op' ke dalam variabel $op
    $op = $_GET['op'];
} else {
    // Jika 'op' tidak ada, set nilai $op menjadi string kosong
    $op = "";
}

// Jika 'op' adalah 'ubah', lakukan operasi untuk mengambil data siswa berdasarkan NIK
if ($op == 'ubah') {
    // Ambil nilai NIK dari parameter URL
    $NIK = $_GET['NIK'];
    
    // Query untuk mengambil data siswa berdasarkan NIK
    $query = "SELECT * FROM tb_siswa WHERE NIK = '$NIK'";
    $ubah = mysqli_query($conn, $query);
    
    // Ambil data siswa dari hasil query
    $tampil = mysqli_fetch_array($ubah);
    
    // Assign nilai-nilai dari data siswa ke dalam variabel yang sesuai
    $nama = $tampil['nama'];
    $kelas = $tampil['kelas'];
    $jurusan = $tampil['jurusan'];
    $talent = $tampil['talent'];
    $eskul = $tampil['eskul'];
    $nomor_wa = $tampil['nomor_wa'];

    // Periksa apakah data siswa ditemukan
    if (!$nama) {
        // Jika tidak ditemukan, set pesan error
        $error = "Data Tidak Ditemukan";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Talent Day Dan Extrakurikuler</title>
    <link rel="shortcut icon" href="assets/faviconPenus-32x32.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: {
        extend: {
            borderRadius: {
            '4xl': '3rem',
            },
            width: {
            '35': '36%',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-[#55679C]"> 
<div class=" w-[96rem] ml-20">
        <div class="font-bold text-4xl mb-10 mt-12 text-white">
            Data Talent Dan Ekskul Siswa
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">No</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">NIK</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Nama Siswa</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Kelas</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Jurusan</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Talent</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Eskul</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Nomor Whatsapp</th>
                        <th scope="col" class="text-lg text-center px-5 py-3 px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tb_siswa ORDER BY NIK ASC";
                    $tampil = mysqli_query($conn, $query);
                    $urut = 1;
                    while ($result = mysqli_fetch_array($tampil)) {
                        $NIK = $result['NIK'];
                        $nama = $result['nama'];
                        $kelas = $result['kelas'];
                        $jurusan = $result['jurusan'];
                        $talent = $result['talent'];
                        $eskul = $result['eskul'];
                        $nomor_wa = $result['nomor_wa'];
                    ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $urut++; ?></th>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $NIK; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $nama; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $kelas; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $jurusan; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $talent; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $eskul; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4"><?php echo $nomor_wa; ?></td>
                            <td class="text-lg text-center px-5 py-3 px-6 py-4">
                                <a href="index.php?op=ubah&NIK=<?php echo $NIK; ?>"><button type="button" class="text-center items-center bg-white text-black w-12 rounded-full">Edit</button></a>
                                <a href="delete.php?NIK=<?php echo $NIK; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ???')"><button type="button" class="text-center items-center ml-1 bg-red-800 text-white w-16 rounded-full">Hapus</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
                </body>
                </html>