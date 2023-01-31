<?php 

if (isset($_POST['registrasi'])) {
    /* include file yang didalamnya ada mysqli_connect*/
    include '../lib/database.php';

    /* query insert*/
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];


    $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) VALUES ('$nik', '$nama', '$username', '$password', '$telp')";
    $execQuery = mysqli_query($koneksi, $query);
    if ($execQuery) {   
        echo '<script> alert ("data anda berhasil disimpan")</script>';
        header('Location:/pengaduan_masyarakat/index.php');
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
    <title>Registrasi Masyarakat</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nik" placeholder="Nomor Induk Kependudukan" required>
        <input type="text" name="nama" placeholder="Nama Asli Anda" required>
        <input type="text" name="username" placeholder="Username Anda" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="text" name="telp" placeholder="Nomor Telepon" required>
        <input type="submit" name="registrasi" value="Registrasi">
    </form>   
</body>
</html>