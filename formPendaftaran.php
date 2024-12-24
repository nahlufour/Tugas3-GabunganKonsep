<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pekan_olahraga';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_team = $_POST['nama'];
    $cabor = $_POST['cabor'];
    $telp = $_POST['tel'];
    $status = $_POST['status'];
    $anggota = $_POST['anggota'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO register (nama_team, cabor, telp, status, anggota) 
            VALUES ('$nama_team', '$cabor', '$telp', '$status', '$anggota')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="style/styleForm.css">
</head>
<body>
    <form action="formPendaftaran.php" method="post">
        <label for="nama">Nama Team:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="cabor">Cabang Olahraga:</label>
        <input type="text" id="cabor" name="cabor" required>

        <label for="tel">No Telpon / WA:</label>
        <input type="tel" id="tel" name="tel" required>

        <label>Status:</label>
        <div class="radio-group">
            <input type="radio" id="pelajar" name="status" value="pelajar" required>
            <label for="pelajar">Pelajar</label>

            <input type="radio" id="mahasiswa" name="status" value="mahasiswa">
            <label for="mahasiswa">Mahasiswa</label>

            <input type="radio" id="pekerja" name="status" value="pekerja">
            <label for="pekerja">Pekerja</label>
        </div>

        <label for="anggota">List Nama Anggota Tim:</label>
        <textarea name="anggota" id="anggota" rows="3" placeholder="ex. 1. Kausar, 2. Zakiul, 3. Dhiaul"></textarea>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
