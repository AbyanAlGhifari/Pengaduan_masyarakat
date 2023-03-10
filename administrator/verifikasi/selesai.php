<?php
SESSION_START();
include '../../lib/database.php';
if (($_SESSION['level'] != 'admin') and ($_SESSION['level'] != 'petugas')) {
    header('Location/pengaduan_masyarakat/logout.php');
}

$query = "SELECT p.id_pengaduan as id_pengaduan, m.nama as nama, p.tgl_pengaduan as tgl_pengaduan, p.foto as foto, p.isi_laporan as isi_laporan, p.status as status FROM pengaduan p JOIN masyarakat m where p.nik = m.nik AND p.status = 'selesai';";
$execQuery = mysqli_query($koneksi, $query);
$getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Selesai</title>
    <link rel="stylesheet" type="text/css " href="../../dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/nonvalid.php" class="nav-link">Pengaduan Non Valid</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/valid.php" class="nav-link">Pengaduan Valid</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/proses.php" class="nav-link">Pengaduan Proses</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/verifikasi/selesai.php" class="nav-link">Pengaduan Selesai</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/generate-laporan.php" class="nav-link">Generate Laporan</a>
                </li>
                <li class="nav-item">
                    <a href="/pengaduan_masyarakat/administrator/registrasi.php" class="nav-link">Registrasi</a>
                </li>
            </ul>
            <div>
                <?php
                    echo $_SESSION['nama'].' '.'<a href="/pengaduan_masyarakat/logout.php">Logout</a>'
                ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <center>
            <h2>
                List Pengaduan Selesai
            </h2>
        </center>
        <div class="row justify-content-center align-middle">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pengadu</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Foto Penunjang</th>
                        <th>Isi Aduan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($getData as $data) {
                        $no += 1;
                        if ($data['status'] == 'selesai') {
                            $status = 'Selesai';
                        } else if ($data['status'] == 'proses') {
                            $status = 'Proses';
                        } else {
                            $status = 'status tidak diketahui';
                        }
                        echo "
                            <tr>
                                <td>$no</td>
                                <td>$data[nama]</td>
                                <td>$data[tgl_pengaduan]</td>
                                <td>
                                    <img src=$data[foto] width=100px class='img img-thumbnail'>
                                </td>
                                    <td>$data[isi_laporan]</td>
                                <td>
                                    $status
                                </td>
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script type="text/javascript" src="../../dist/js/bootstrap.min.js"></script>
</html>