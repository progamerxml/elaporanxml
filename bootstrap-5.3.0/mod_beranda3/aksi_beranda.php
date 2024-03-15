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

  // Input templates
  if ($module=='pegawai' AND $act=='input'){
	$nama				= $_POST['nama'];
	$alamat				= $_POST['alamat'];
	$jabatan			= $_POST['nama_jabatan'];
	$tgl_masuk		= $_POST['tgl_masuk'];
  $tgl_kontrak		= $_POST['tgl_kontrak'];
	$bpjs_kes				= $_POST['bpjs_kes'];
  $bpjs_ket				= $_POST['bpjs_ket'];

    $input = "INSERT INTO pegawai(nama, alamat, jabatan, tgl_masuk, tgl_kontrak, bpjs_kes, bpjs_ket) VALUES('$nama','$alamat', '$jabatan','$tgl_masuk','$tgl_kontrak','$bpjs_kes','$bpjs_ket')";
    if(mysqli_query($konek, $input))
    {
      echo "simpan berhasil";
    }else{
      echo "gagal simpan".mysqli_error($konek);
    }

    
     header("location:".$base_url.$module);
  }

  // Update templates
  elseif ($module=='pegawai' AND $act=='update'){
    $id             = $_POST['id'];
    $nama        		= $_POST['nama'];
	  $alamat				  = $_POST['alamat'];
    $jabatan			  = $_POST['nama_jabatan'];
    $tgl_masuk		  = date("Y-m-d",strtotime($_POST['tgl_masuk']));
    $tgl_kontrak		= date("Y-m-d",strtotime($_POST['tgl_kontrak']));
    $bpjs_kes				= $_POST['bpjs_kes'];
    $bpjs_ket				= $_POST['bpjs_ket'];
    
    $update = "UPDATE pegawai SET nama='$nama', alamat='$alamat', jabatan='$jabatan', tgl_masuk='$tgl_masuk', tgl_kontrak='$tgl_kontrak', bpjs_kes='$bpjs_kes', bpjs_ket='$bpjs_ket' WHERE id=$id";
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
