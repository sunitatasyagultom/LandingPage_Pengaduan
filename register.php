<?php
require_once "koneksi.php";

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];

    $query = "INSERT INTO users (username, password, npm, nama, program_studi, fakultas, role) VALUES ('$username', '$password', '$npm', '$nama', '$prodi', '$fakultas', 'mahasiswa')";
    if(mysqli_query($koneksi, $query)) {
        echo "Registration successful!";
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="gambar/umi.png" rel="icon">
    <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="npm" placeholder="NPM" required>
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="prodi" placeholder="Program Studi" required>
            <input type="text" name="fakultas" placeholder="Fakultas" required>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="login.php">Sudah Memiliki Akun? Login</a>
    </div>
</body>
</html>
