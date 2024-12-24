<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pekan_olahraga';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $nama_team = $_POST['nama'];
        $cabor = $_POST['cabor'];
        $telp = $_POST['tel'];
        $status = $_POST['status'];
        $anggota = $_POST['anggota'];

        $sql = "INSERT INTO register (nama_team, cabor, telp, status, anggota) VALUES ('$nama_team', '$cabor', '$telp', '$status', '$anggota')";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM register WHERE id = $id";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_team = $_POST['nama'];
        $cabor = $_POST['cabor'];
        $telp = $_POST['tel'];
        $status = $_POST['status'];
        $anggota = $_POST['anggota'];

        $sql = "UPDATE register SET nama_team='$nama_team', cabor='$cabor', telp='$telp', status='$status', anggota='$anggota' WHERE id=$id";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Register</title>
    <link rel="stylesheet" href="style/styleCRUD.css">
</head>
<body>
    <h1>Data Register</h1>
    <form method="POST">
        <input type="hidden" name="id" id="id">
        <label for="nama">Nama Team:</label>
        <input type="text" name="nama" id="nama" required>
        <label for="cabor">Cabang Olahraga:</label>
        <input type="text" name="cabor" id="cabor" required>
        <label for="tel">No Telp:</label>
        <input type="text" name="tel" id="tel" required>
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="pelajar">Pelajar</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="pekerja">Pekerja</option>
        </select>
        <label for="anggota">Anggota Tim:</label>
        <textarea name="anggota" id="anggota" rows="3"></textarea>
        <button type="submit" name="add">Tambah</button>
        <button type="submit" name="update">Ubah</button>
    </form>

    <h2>List Data</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Team</th>
            <th>Cabang Olahraga</th>
            <th>No Telp</th>
            <th>Status</th>
            <th>Anggota</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM register");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nama_team']}</td>
                <td>{$row['cabor']}</td>
                <td>{$row['telp']}</td>
                <td>{$row['status']}</td>
                <td>{$row['anggota']}</td>
                <td>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' name='delete'>Hapus</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
