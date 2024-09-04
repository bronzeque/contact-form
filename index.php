<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kontak</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h1>Form Kontak</h1>
    <form action="process_form.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required><br><br>

        <label for="kelas">Kelas:</label>
        <select id="kelas" name="kelas" required>
            <option value="" disabled selected>Pilih Kelas</option>
            <option value="A">Kelas A</option>
            <option value="B">Kelas B</option>
            <option value="C">Kelas C</option>
            <option value="D">Kelas D</option>
        </select><br><br>

        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="gender" value="Laki-laki" required>
        <label for="male">Laki-laki</label>
        <input type="radio" id="female" name="gender" value="Perempuan" required>
        <label for="female">Perempuan</label><br><br>

        <label for="saran">Saran:</label><br>
        <textarea id="saran" name="saran" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" name="submit" value="Kirim">
    </form>
</body>
</html>


<?php
$db = mysqli_connect('localhost', 'root', '', 'contact_form');

// Cek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi menambahkan data form
function tambah_form($post) {
    global $db;

    $nama = strip_tags($post['nama']);
    $nim = strip_tags($post['nim']);
    $kelas = strip_tags($post['kelas']);
    $gender = strip_tags($post['gender']);
    $saran = strip_tags($post['saran']);

    // Query tambah data
    $query = "INSERT INTO data_contact_form (nama, nim, kelas, gender, saran) VALUES ('$nama', '$nim', '$kelas', '$gender', '$saran')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Cek apakah tombol tambah ditekan
if (isset($_POST['submit'])) {
    if (tambah_form($_POST) > 0) {
        echo "<script>
                alert('Data Form Berhasil Ditambahkan');
                document.location.href = 'data-form.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Form Gagal Ditambahkan');
                document.location.href = 'data-form.php';
            </script>";
    }
}
?>