<?php
// Mengimpor file koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Memeriksa apakah form telah disubmit
if (isset($_POST['simpan'])) {
    // Mengambil nilai dari form
    $NIK = $_POST['NIK'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $talent = $_POST['talent'];
    $eskul = $_POST['eskul'];
    $nomor_wa = $_POST['nomor_wa'];

    // Memeriksa apakah NIK sudah ada dalam tabel siswa
    $query_cek = "SELECT * FROM tb_siswa WHERE NIK = '$NIK'";
    $result_cek = mysqli_query($conn, $query_cek);

    // Jika NIK sudah ada, lakukan operasi update
    if (mysqli_num_rows($result_cek) > 0) {
        $query = "UPDATE tb_siswa SET nama = '$nama', kelas = '$kelas', jurusan = '$jurusan', talent = '$talent', eskul = '$eskul', nomor_wa = '$nomor_wa' WHERE NIK = '$NIK'";
        $ubah = mysqli_query($conn, $query);
        // Jika operasi update berhasil
        if ($ubah) {
            $sukses = "Data Berhasil Diubah";
        } else {
            $error = "Data Gagal Diubah";
        }
    } 
    // Jika NIK belum ada, lakukan operasi insert
    else {
        $query = "INSERT INTO tb_siswa (NIK, nama, kelas, jurusan, talent, eskul, nomor_wa) VALUES ('$NIK', '$nama', '$kelas', '$jurusan', '$talent', '$eskul', '$nomor_wa')";
        $simpan = mysqli_query($conn, $query);
        // Jika operasi insert berhasil
        if ($simpan) {
            $sukses = "Data Berhasil Disimpan";
        } else {
            $error = "Data Gagal Disimpan";
        }
    }
} 
// Jika form tidak disubmit, tampilkan pesan error
else {
    $error = "Silakan Masukkan Semua Data";
}
?>
