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
  $report     = $_POST['report']; var_dump($report);
	$bpjs_kes				= $_POST['bpjs_kes'];
  $bpjs_ket				= $_POST['bpjs_ket'];
  $username = explode(" ",$nama); $user = strtolower($username[0]).date("dmy", strtotime($tgl_masuk)); 
  $password = md5($user); 

  $qr = "SELECT COUNT(id) AS jml FROM pegawai WHERE nama = '$nama' AND alamat = '$alamat' AND jabatan = $jabatan AND tgl_masuk = '$tgl_masuk'"; var_dump($qr); echo "<br>";
  $cek = mysqli_query($konek, $qr);
  $ada = mysqli_fetch_array($cek);
  //var_dump($ada['jml']);

  if ($ada['jml'] <= 0)
  {     
    // mycode
  $input = "INSERT INTO pegawai(nama, alamat, jabatan, tgl_masuk, tgl_kontrak, report, bpjs_kes, bpjs_ket) VALUES('$nama','$alamat', '$jabatan','$tgl_masuk','$tgl_kontrak', $report, '$bpjs_kes','$bpjs_ket')";
    if(mysqli_query($konek, $input))
    {
      $id = mysqli_fetch_array(mysqli_query($konek, "SELECT id FROM pegawai WHERE nama = '$nama'"));
      mysqli_query($konek, "INSERT INTO users(username, password, blokir, level, nama_lengkap) VALUES ('$user', '$password', 'N', 'karyawan', $id[id])");
    }
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
    $report         = $_POST['report']; //var_dump($report);
    $bpjs_kes				= $_POST['bpjs_kes'];
    $bpjs_ket				= $_POST['bpjs_ket'];
    
    $update = "UPDATE pegawai SET nama='$nama', alamat='$alamat', jabatan='$jabatan', tgl_masuk='$tgl_masuk', tgl_kontrak='$tgl_kontrak', report=$report, bpjs_kes='$bpjs_kes', bpjs_ket='$bpjs_ket' WHERE id=$id";
    //var_dump($update);
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
