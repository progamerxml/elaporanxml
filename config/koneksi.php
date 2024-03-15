<?php
// panggil fungsi validasi xss dan injection
require_once('fungsi_validasi.php');
include "config.php";
include "helper.php";

// definisikan koneksi ke database
$server = "localhost";
$username = "root";
$password = "";
$database = "db_ekinerja";


/*
// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
*/

// melakukan koneksi ke database
 $konek = new mysqli($server,$username,$password,$database);
 
// cek koneksi yang kita lakukan berhasil atau tidak
 if ($konek->connect_error) {
    // jika terjadi error, matikan proses dengan die() atau exit();
    die('Maaf koneksi gagal: '. $konek->connect_error);
}




// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Lokovalidasi;

?>
