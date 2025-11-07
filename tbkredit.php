<?php
// Konfigurasi Database
// $server = "localhost";
// $username = "odoo";
// $password = "odoo";

$server = "db";
$username = "android";
$password = "android";

$database = "db_android_1";

// Koneksi
$koneksi = mysqli_connect($server, $username, $password, $database);

@$operasi = $_GET['operasi'];

switch ($operasi) {
    case "view":
        // Asumsi ini seharusnya menampilkan data kredit, tetapi di source code tertulis 'petugas'
        /* Source code untuk Menampilkan data kredit (asumsi) */
        $query_tampil = mysqli_query($koneksi, "SELECT * FROM kredit") or die(mysqli_error($koneksi));
        $data_array = array();
        while ($data = mysqli_fetch_assoc($query_tampil)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);
        break;
        
    case "query_kredit":
        /* Source code untuk Menampilkan join data kredit, kreditor, dan motor */
        $query_tampil_kredit = mysqli_query($koneksi, "SELECT kredit.invoice, kredit.tanggal, kredit.idkreditor,
            kreditor.nama, kreditor.alamat,
            kredit.kdmotor, motor.nama as nmotor, kredit.hrgtunai, kredit.dp, kredit.hrgkredit,
            kredit.bunga, kredit.lama, kredit.totalkredit, kredit.angsuran
            FROM motor INNER JOIN (kreditor INNER JOIN kredit ON kreditor.idkreditor = kredit.idkreditor)
            ON motor.kdmotor = kredit.kdmotor order by kredit.invoice desc") or die(mysqli_error($koneksi));
        
        $data_array = array();
        while ($data = mysqli_fetch_assoc($query_tampil_kredit)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);
        break;

    case "simpan_kredit":
        /* Source code untuk Insert data Kredit */
        @$idkreditor = $_GET['idkreditor'];
        @$kdmotor = $_GET['kdmotor'];
        @$hrgtunai = $_GET['hrgtunai'];
        @$dp = $_GET['dp'];
        @$hrgkredit = $_GET['hrgkredit'];
        @$bunga = $_GET['bunga'];
        @$lama = $_GET['lama'];
        @$totalkredit = $_GET['totalkredit'];
        @$angsuran = $_GET['angsuran'];
        
        $query_insert_data = mysqli_query($koneksi, "INSERT INTO kredit (idkreditor, kdmotor, hrgtunai, dp, hrgkredit, bunga, lama, totalkredit, angsuran)
        VALUES($idkreditor, '$kdmotor', '$hrgtunai', '$dp', '$hrgkredit', '$bunga', '$lama', '$totalkredit', '$angsuran')");
        
        if ($query_insert_data) {
            echo "Data Berhasil Disimpan";
        } else {
            echo "Error Insert kredit: " . mysqli_error($koneksi); // Dikoreksi dari "Error Insert petugas"
        }
        break;

    case "hapus_kredit":
        /* Source code untuk Delete data Kredit */
        @$invoice = $_GET['invoice'];
        $query_delete_kredit = mysqli_query($koneksi, "DELETE FROM kredit WHERE invoice='$invoice'");
        
        if ($query_delete_kredit) {
            echo "Berhasil hapus data Pengajuan Kredit.";
        } else {
            echo "Error Hapus Kredit: " . mysqli_error($koneksi); // Dikoreksi dari mysqli_error()
        }
        break;
        
    default:
        break;
}
?>