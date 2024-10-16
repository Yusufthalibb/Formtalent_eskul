<?php
include "koneksi.php";

$NIK = "";
$nama = "";
$kelas = "";
$jurusan = "";
$talent = "";
$eskul = "";
$nomor_wa = "";
$sukses = "";
$error = "";

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil nilai dari form
    $NIK = $_POST['NIK'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $talent = $_POST['talent'];
    $eskul = $_POST['eskul'];
    $nomor_wa = $_POST['nomor_wa'];

    // Periksa apakah semua data telah diisi
    if ($NIK && $nama && $kelas && $jurusan && $talent && $eskul && $nomor_wa) {
        // Periksa apakah NIK yang ingin ditambahkan sudah ada dalam tabel
        $query_cek = "SELECT * FROM tb_siswa WHERE NIK = '$NIK'";
        $result_cek = mysqli_query($conn, $query_cek);

        if (mysqli_num_rows($result_cek) > 0) {
            // Jika NIK sudah ada, lakukan operasi update
            $query = "UPDATE tb_siswa SET nama = '$nama', kelas = '$kelas', jurusan = '$jurusan', talent = '$talent', eskul = '$eskul', nomor_wa = '$nomor_wa' WHERE NIK = '$NIK'";
            $ubah = mysqli_query($conn, $query);
            if ($ubah) {
                $sukses = "Data Berhasil Diubah";
            } else {
                $error = "Data Gagal Diubah";
            }
        } else {
            // Jika NIK belum ada, lakukan operasi insert
            $query = "INSERT INTO tb_siswa (NIK, nama, kelas, jurusan, talent, eskul, nomor_wa) VALUES ('$NIK', '$nama', '$kelas', '$jurusan', '$talent', '$eskul', '$nomor_wa')";
            $simpan = mysqli_query($conn, $query);
            if ($simpan) {
                $sukses = "Data Berhasil Disimpan";
            } else {
                $error = "Data Gagal Disimpan";
            }
        }
    } else {
        $error = "Silakan Masukkan Semua Data";
    }

    // Muat ulang halaman untuk menampilkan pesan sukses atau error
    header("Location: index.php");
    exit();
}

// Jika operasi untuk mengubah data
if ($op == 'ubah') {
    // Lakukan operasi untuk mengambil data siswa berdasarkan NIK
    $NIK = $_GET['NIK'];
    $query = "SELECT * FROM tb_siswa WHERE NIK = '$NIK'";
    $ubah = mysqli_query($conn, $query);
    $tampil = mysqli_fetch_array($ubah);
    $nama = $tampil['nama'];
    $kelas = $tampil['kelas'];
    $jurusan = $tampil['jurusan'];
    $talent = $tampil['talent'];
    $eskul = $tampil['eskul'];
    $nomor_wa = $tampil['nomor_wa'];

    // Periksa apakah data siswa ditemukan
    if (!$nama) {
        $error = "Data Tidak Ditemukan";
    }
}
?>
