<?php
session_start();

// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";
  include "../../config/config.php";

  $module = $_GET['module'];
  $act    = $_GET['act'];

  // Hapus templates
  if ($module=='kinerja' AND $act=='hapus'){
    $hapus = "DELETE FROM pekerjaan WHERE id='$_GET[id]'";
    mysqli_query($konek, $hapus);
    
    header("location:".$base_url.$module);
  }

// Input templates
  if ($module=='kinerja' AND $act=='input'){
    //lakukan pengecekan dan input ke table rekapitulasi jika pernah tidak reporting
    $nama_pegawai		= $_POST['idk'];
    $jabatan = $_POST['jabatan'];
    $isi_kinerja = $_POST['isi_kinerja']; 
    $tanggal_input = date("Y-m-d H:i:s", strtotime($_POST['tanggal_input']));
    $tgl = date("Y-m-d", strtotime($_POST['tanggal_input'])); //var_dump($tgl);
    $cekTgl = date('Y-m-d',strtotime($tanggal_input));
    
    $qr = "SELECT COUNT(karyawan) AS jml FROM pekerjaan WHERE tgl = '$cekTgl' AND karyawan = $nama_pegawai";
    $cek = mysqli_query($konek, $qr);
    $ada = mysqli_fetch_array($cek);
    
    if ($ada['jml'] <= 0)
    {     
      // mycode
      $input = "INSERT INTO pekerjaan(tanggal, karyawan, pekerjaan, tgl) VALUES(CURRENT_TIMESTAMP(), '$nama_pegawai', '$isi_kinerja', '$tgl')"; //var_dump($input);
      mysqli_query($konek, $input); 
      $shr = "DELETE FROM db_ekinerja.rekap_report WHERE tanggal = '$tgl' and nama = '$nama_pegawai'"; //var_dump($shr);
      mysqli_query($konek, $shr);
    }

    header("location:".$base_url.$module);
  }

  // Update templates
  elseif ($module=='kinerja' AND $act=='update'){
    $id             = $_POST['id'];
    $idkerja        = $_POST['idkerja'];
    // $karyawan       = $_POST['nama'];
    $detail_kerja   = $_POST['isi_kinerja'];
    $tanggal        = $_POST['tanggal'];
    $tgl = date("Y-m-d", strtotime($_POST['tanggal'])); //var_dump($tgl);


    $update = "UPDATE pekerjaan SET karyawan=$id, pekerjaan='$detail_kerja', tgl_update=CURRENT_TIMESTAMP(), tgl='$tgl' WHERE id='$idkerja'"; //var_dump($update);
    mysqli_query($konek, $update);

    header("location:".$base_url.$module);
  }
  
   // Approv templates

 
   

  // Aktifkan templates
  elseif ($module=='templates' AND $act=='aktifkan'){
    $query1 = mysqli_query($konek, "UPDATE templates SET aktif='Y' WHERE id_templates='$_GET[id]'");
    $query2 = mysqli_query($konek, "UPDATE templates SET aktif='N' WHERE id_templates!='$_GET[id]'");

    header("location:../../media.php?module=".$module);
  }
}
?>
