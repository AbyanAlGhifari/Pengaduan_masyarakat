<!-- ini untuk login administator dan petugas -->
<?php 
/* mendelklarasikan session start*/
    SESSION_START();
if (isset($_SESSION['id'])) {
    if ($_SESSION['level'] == 'masyarakat') {
        header('Location:/pengaduan_masyarakat/masyarakat/menulis-pengaduan.php');
    } elseif (($_SESSION['level'] == 'admin') or ($_SEESION['level'] == 'petugas')) {
        header('location:/pengaduan_masyarakat/administrator/verifikasi/nonvalid.php');
    } else {
        header('Location:/pengaduan_masyarakat/logout.php');
    }
}

if (isset($_POST['login'])) {

    /* melkukan query dari username dan password yang didapatkan di form (html) ke dlam mysql*/

    /* melakukan koneksi ke database*/
    include '../lib/database.php';

    /* mendapatkan data dari form dengan method post*/
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* melakukan query*/
    $query = "SELECT * FROM petugas WHERE username='$username' AND password='$password';";

    $execQuery = mysqli_query($koneksi, $query);

    /* melakukan aksi untuk mendapatkan data yang keluar dari hasil query*/
    $getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

    /* melakukan aksi mendapatkan jumlah dari data yang keluar setelah eksekusi query*/
    $numRows = mysqli_num_rows($execQuery);

    if ($numRows == 1) {
        /* data user dan pasword yang berhasil login dilakukan penyimpanan di variable session*/
        foreach ($getData as $data) {
            $_SESSION['id'] = $data['id_petugas'];
            $_SESSION['nama'] = $data['nama_petugas'];
            $_SESSION['level'] = $data['level'];
        };
        /* header ini digunakan untuk melempar ke halaman yang di maksud di (Location)*/
        header('Location:verifikasi/nonvalid.php');
        echo '<script> alert("data anda benar") </script>';
    } else {
        echo '<script> alert("data anda salah") </script>';
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="username" required/>
        <input type="password" name="password" placeholder="password" required/>
        <input type="submit" name="login" value="login"/>
    </form>
</body>
</html>