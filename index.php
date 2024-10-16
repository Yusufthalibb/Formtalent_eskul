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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,500;0,700;0,800;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet">

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
    <nav class="h-20 bg-white shadow-lg">
        <div class="flex justify-between mx-72 py-4">
            <a href="#">
                <img src="assets/logo.png" alt="logo penus" class="w-52">
            </a>
            <a href="#">
                <button class="bg-blue-950 rounded-3xl w-28 h-12 font-bold text-xl text-white">Masuk</button>
            </a>
        </div>
    </nav>
<div class="mx-72">
    <div class="my-16">
        <div class="w-full h-96 bg-blue-950 rounded-4xl justify-between">
            <div class="flex px-16 py-16">
                <div class="text-white  mr-12">
                    <h1 class="font-black text-5xl relative">Form Pendataan Talent & Ekskul Peserta Didik</h1>
                    <p class="font-medium mt-6 text-xl">Mohon mengisi seluruh data dibawah ini untuk melengkapi pendataan talent & ekskul siswa.</p>
                </div>
                <div class="">
                    <img src="assets/LogoYPNB.png" alt="" class="w-[12rem] mr-12">
                </div>
            </div>
            <div class="w-11/12 h-20 bg-white rounded-full ml-14 pl-14 flex gap-x-16 mt-10 font-bold text-xl items-center shadow-lg">
                <div class="flex gap-x-3 text-blue-950">
                    <div class="w-7 bg-blue-950 rounded-full text-center text-white">1</div>
                    <div>Informasi Data Siswa</div>
                </div>
                <div class="flex gap-x-3 text-gray-300">
                    <div class="w-7 bg-gray-200 rounded-full text-center">2</div>
                    <div>Validasi</div>
                </div>
            </div>
        </div>
    </div>
<div class="flex grid-rows-2">
    <div class="h-24 w-35 bg-white rounded-3xl text-center py-6">
        <button class="text-lg flex mx-7 gap-x-14 items-center">
            <h1>Jadwal Pendataan Siswa</h1>
            <img src="assets/arrow-top.png" alt="arrow-top" class="w-6">
        </button>
    </div>
    <div class="ml-10 w-full">
        <?php
        if ($sukses) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses; ?>
            </div>
        <?php
        }

        if ($error) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php
        }
        ?>

        <!-- Form untuk tambah data siswa -->
        <form action="simpan.php" method="POST">
            <div class="">
                <div class="">
                    <label for="NIK" class="font-bold text-lg">NIK SISWA <span class="text-red-600">*</span></label>
                    <input type="number" name="NIK" value="<?php echo $NIK ?>" class="w-full h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium" id="NIK" placeholder="Isi NIK Siswa Dengan Benar">
                </div>
                <div class="">
                    <label for="nama" class="font-bold text-lg">Nama Siswa <span class="text-red-600">*</span></label>
                    <input type="text" name="nama" class="w-full h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium" id="nama" value="<?php echo $nama ?>" placeholder="Isi Nama Lengkap">
                </div>
            </div>

            <div class="">
                <label for="kelas" class="font-bold text-lg">Kelas Siswa <span class="text-red-600">*</span></label>
                <div class="">
                    <select id="kelas" name="kelas" class="w-96 h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium">
                        <option value="X" <?php if ($kelas == 'X') echo 'selected'; ?>>X</option>
                        <option value="XI" <?php if ($kelas == 'XI') echo 'selected'; ?>>XI</option>
                        <option value="XII" <?php if ($kelas == 'XII') echo 'selected'; ?>>XII</option>
                    </select>
                </div>
            </div>
            <div class="">
                <label for="jurusan" class="font-bold text-lg">Jurusan Siswa <span class="text-red-600">*</span></label>
                <div class="">
                    <select id="jurusan" name="jurusan" class="w-96 h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium">
                        <option value="Rekayasa Perangkat Lunak" <?php if ($jurusan == 'Rekayasa Perangkat Lunak') echo 'selected'; ?>>Rekayasa Perangkat Lunak</option>
                        <option value="Multimedia" <?php if ($jurusan == 'Multimedia') echo 'selected'; ?>>Multimedia</option>
                        <option value="Teknik Jaringan Dan Komputer" <?php if ($jurusan == 'Teknik Jaringan Dan Komputer') echo 'selected'; ?>>Teknik Jaringan Dan Komputer</option>
                        <option value="Perbankan Keuangan Mikro" <?php if ($jurusan == 'Perbankan Keuangan Mikro') echo 'selected'; ?>>Perbankan Keuangan Mikro</option>
                    </select>
                </div>
            </div>
            <div class="">
                <label for="talent" class="font-bold text-lg">Talent Day <span class="text-red-600">*</span></label>
                <div class="">
                    <select id="talent" name="talent" class="w-96 h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium">
                        <option value="Programming" <?php if ($talent == 'Programming') echo 'selected'; ?>>Programming</option>
                        <option value="Broadcasting" <?php if ($talent == 'Broadcasting') echo 'selected'; ?>>Broadcasting</option>
                        <option value="Animasi" <?php if ($talent == 'Animasi') echo 'selected'; ?>>Animasi</option>
                        <option value="Tata Boga" <?php if ($talent == 'Tata Boga') echo 'selected'; ?>>Tata Boga</option>
                        <option value="Musik Modern" <?php if ($talent == 'Musik Modern') echo 'selected'; ?>>Musik Modern</option>
                    </select>
                </div>
            </div>
            <div class="">
                <label for="eskul" class="font-bold text-lg">Extrakurikuler <span class="text-red-600">*</span></label>
                <div class="">
                    <select id="eskul" name="eskul" class="w-96 h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium">
                        <option value="Badminton" <?php if ($eskul == 'Badminton') echo 'selected'; ?>>Badminton</option>
                        <option value="English Club" <?php if ($eskul == 'English Club') echo 'selected'; ?>>English Club</option>
                        <option value="Japan Club" <?php if ($eskul == 'Japan Club') echo 'selected'; ?>>Japan Club</option>
                        <option value="Basket" <?php if ($eskul == 'Basket') echo 'selected'; ?>>Basket</option>
                        <option value="Taekwondo" <?php if ($eskul == 'Taekwondo') echo 'selected'; ?>>Taekwondo</option>
                    </select>
                </div>
            </div>
        <div class="">
            <label for="nama" class="font-bold text-lg">Nomor Whatsapp <span class="text-red-600">*</span></label>
            <div class="">
                <input type="text" name="nomor_wa" class="w-96 h-14 mt-2 mb-6 rounded-lg border border-slate-300 pl-4 text-xl font-medium" id="no" value="<?php echo $nomor_wa ?>" placeholder="Isi Dengan Nomorr WhatsApp">
            </div>
        </div>
        <div class="" align="left">
            <button type="submit" name="simpan" value="Simpan Data" class="w-28 h-10 bg-blue-950 text-white text-center items-center font-medium rounded-xl">Simpan Data</button>
        </div>
    </form>
    </div>
</div>
<div class="w-28 h-18 bg-blue-950 text-white text-center mb-8 items-center font-medium rounded-xl">
    <a href="tabel.php">Tabel Data Siswa</a>
</div>

    <!-- Tabel untuk menampilkan data siswa -->
</div>
</body>

</html>
