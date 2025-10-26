<?php
// Konfigurasi Database (sama seperti tbpetugas/tbmotor)
$server = "localhost";
$username = "root";
$password = "";
$database = "db_android_1";

// Koneksi
$koneksi = mysqli_connect($server, $username, $password, $database);

@$operasi = $_GET['operasi'];

switch ($operasi) {
    case "view":
        /* Source code untuk Menampilkan Kreditor */
        $query = mysqli_query($koneksi, "SELECT * FROM kreditor") or die(mysqli_error($koneksi));
        $data_array = array();
        while ($data = mysqli_fetch_assoc($query)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);
        break;

    case "insert":
        /* Source code untuk Insert data Kreditor */
        @$nama = $_GET['nama'];
        @$pekerjaan = $_GET['pekerjaan'];
        @$telp = $_GET['telp'];
        @$alamat = $_GET['alamat'];
        
        $query_insert = mysqli_query($koneksi, "INSERT INTO kreditor (nama, pekerjaan, telp, alamat) VALUES('$nama', '$pekerjaan', '$telp', '$alamat')");
        
        if ($query_insert) {
            echo "Data Kreditor Berhasil Disimpan";
        } else {
            echo "Error Insert Kreditor: " . mysqli_error($koneksi);
        }
        break;

    case "get_kreditor_by_idkreditor":
        /* Source code untuk Edit data dan mengirim data berdasarkan idkreditor */
        @$idkreditor = $_GET['idkreditor'];
        $query_tampil = mysqli_query($koneksi, "SELECT * FROM kreditor WHERE idkreditor='$idkreditor'") or die(mysqli_error($koneksi));
        
        $data_array = array();
        $data_array = mysqli_fetch_assoc($query_tampil);
        echo "[" . json_encode($data_array) . "]";
        break;

    case "update":
        /* Source code untuk Update data Kreditor */
        @$idkreditor = $_GET['idkreditor'];
        @$nama = $_GET['nama'];
        @$pekerjaan = $_GET['pekerjaan'];
        @$telp = $_GET['telp'];
        @$alamat = $_GET['alamat'];
        
        $query_update = mysqli_query($koneksi, "UPDATE kreditor SET nama='$nama', pekerjaan='$pekerjaan', telp='$telp', alamat='$alamat' WHERE idkreditor='$idkreditor'");
        
        if ($query_update) {
            echo "Update Data Kreditor Berhasil";
        } else {
            echo "Error Update Kreditor: " . mysqli_error($koneksi);
        }
        break;

    case "delete":
        /* Source code untuk Delete data Kreditor */
        @$idkreditor = $_GET['idkreditor'];
        $query_delete = mysqli_query($koneksi, "DELETE FROM kreditor WHERE idkreditor='$idkreditor'");
        
        if ($query_delete) {
            echo "Delete Data Kreditor Berhasil";
        } else {
            echo "Error Delete Kreditor: " . mysqli_error($koneksi);
        }
        break;

    default:
        break;
}

?>