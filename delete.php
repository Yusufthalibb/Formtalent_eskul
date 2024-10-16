<?php
// Import file koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Cek apakah parameter NIK ada dalam URL
if (isset($_GET['NIK'])) {
    // Ambil nilai NIK dari parameter URL
    $NIK = $_GET['NIK'];

    // Query untuk menghapus data siswa berdasarkan NIK
    $query = "DELETE FROM tb_siswa WHERE NIK = '$NIK'";
    $hapus = mysqli_query($conn, $query);

    // Jika operasi hapus berhasil
    if ($hapus) {
        $sukses = "Data Berhasil Dihapus";
    } else {
        // Jika operasi hapus gagal
        $error = "Data Gagal Dihapus";
    }   
    header("Location: index.php");
    exit();
}
?>
