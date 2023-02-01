<?php
include "../lib/database.php";
SESSION_STARt();
if ($_SESSION['level'] != 'admin') {
    header('Location:/pengaduan_masyarakat/logout.php');
}
$query = "  SELECT m.nama as nama, p.tgl_pengaduan as tgl_pengaduan, p.foto as foto, p.isi_laporan as 
            isi_laporan, p.status as status FROM pengaduan p FROM masyarakat m WHERE p.nik = m.nik;";
$execQuery = mysqli_query($koneksi, $query);
$getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laporan Pengaduan</title>
</head>
<body>
    <h2>Seluruh laporan yang masuk</h2>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengadu</th>
                <th>Tanggal Aduan</th>
                <th>Foto Aduan</th>
                <th>Isi Aduan</th>
                <th>Status Aduan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=0;
            foreach ($getData as $data) {
                $no+=1;
                if ($data['status'] == NULL) {
                    $status = 'Belum Valid';
                } else if ($data['status'] == '0') {
                    $status = 'Valid';
                } else {
                    $status = $data['status'];
                }
                echo "
                    <tr>
                        <td>$no</td>
                        <td>$data[nama]</td>
                        <td>$data[tgl_pengaduan]</td>
                        <td>
                            <img src=$data[foto] width=100px>
                        </td>
                        <td>$data[isi_laporan]</td>
                        <td>$status</td>
                    </tr>
                ";
            }
            ?>
            
        </tbody>
    </table>
</body>
<script type="text/javascript">
    window.print
</script>
</html>