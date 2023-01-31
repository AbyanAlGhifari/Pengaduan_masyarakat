<?php 
/* mendelklarasikan session start*/
SESSION_START();
if ($_SESSION['level'] != 'admin') {
        header('Location:/pengaduan_masyarakat/logout.php');
}

if (isset($_POST['registrasi'])) {
    /* include file yang didalamnya ada mysqli_connect*/
    include '../lib/database.php';

    /* query insert*/
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];


    $query = "INSERT INTO petugas (nama_petugas, username, password, telp, level) VALUES ('$nama_petugas', '$username', '$password', '$telp', '$level')";
    $execQuery = mysqli_query($koneksi, $query);
    if ($execQuery) {   
        echo '<script> alert ("data anda berhasil disimpan")</script>';
        header('Location:/pengaduan_masyarakat/administrator/index.php');
    }else{
        echo '<script> alert ("data anda ada yang salah")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Petugas</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nama_petugas" placeholder="Nama Asli Anda" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="text" name="telp" placeholder="Nomor Telepon" required>
        <select name="level">
            <option value="petugas">Petugas</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" name="registrasi" value="Registrasi">
    </form>   
</body>
</html>