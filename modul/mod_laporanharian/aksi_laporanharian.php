<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";

  $module = $_GET['module'];
  $act    = $_GET['act'];

  // Hapus templates
  if ($module=='pegawai' AND $act=='hapus'){
    $hapus = "DELETE FROM pegawai WHERE id='$_GET[id]'";
    mysqli_query($konek, $hapus);
    
    header("location:".$base_url.$module);
  }
  // Pencarian Kinerja
  if ($module=='pegawai' AND $act=='input'){
    $nama_pegawai		= $_POST['nama_pegawai'];
    $uraian_kegiatan    = $_POST['uraian_kegiatan'];
	$waktu         		= $_POST['waktu'];
	$waktu_selesai      = $_POST['waktu_selesai'];
   
    
    $input = "SELECT INTO pegawai (nama_pegawai, uraian_kegiatan, waktu,waktu_selesai,) VALUES('$nama_pegawai', '$uraian_kegiatan',NOW(),'$waktu_selesai')";
    mysqli_query($konek, $input);
    
     header("location:".$base_url.$module);
  }
  // Input templates
  if ($module=='pegawai' AND $act=='input'){
    $nama_pegawai		= $_POST['nama_pegawai'];
    $uraian_kegiatan    = $_POST['uraian_kegiatan'];
	$waktu         		= $_POST['waktu'];
	$waktu_selesai      = $_POST['waktu_selesai'];
   
    
    $input = "INSERT INTO pegawai (nama_pegawai, uraian_kegiatan, waktu,waktu_selesai,) VALUES('$nama_pegawai', '$uraian_kegiatan',NOW(),'$waktu_selesai')";
    mysqli_query($konek, $input);
    
     header("location:".$base_url.$module);
  }

  // Update templates
  elseif ($module=='kastunai' AND $act=='update'){
    $nama_pegawai             	= $_POST['nama_pegawai'];
    $uraian_kegiatan			= $_POST['uraian_kegiatan'];
    $waktu          			= $_POST['waktu'];
	$waktu_selesai         		= $_POST['waktu_selesai'];

    $update = "UPDATE pegawai SET nama_pegawai='$nama_pegawai', uraian_kegiatan='$uraian_kegiatan', waktu='$waktu', waktuselesai='$waktuselesai' WHERE id='$nama_pegawai'";
    mysqli_query($konek, $update);

    header("location:".$base_url.$module);
  }

  // Aktifkan templates
  elseif ($module=='templates' AND $act=='aktifkan'){
    $query1 = mysqli_query($konek, "UPDATE templates SET aktif='Y' WHERE id_templates='$_GET[id]'");
    $query2 = mysqli_query($konek, "UPDATE templates SET aktif='N' WHERE id_templates!='$_GET[id]'");

    header("location:../../media.php?module=".$module);
  }
}
?>
