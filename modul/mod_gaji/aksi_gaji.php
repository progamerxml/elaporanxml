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
  if ($module=='gaji' AND $act=='hapus'){
    $hapus = "DELETE FROM gaji WHERE id='$_GET[id]'";
    mysqli_query($konek, $hapus);
    
    header("location:".$base_url.$module);
  }

// Input templates
  if ($module=='gaji' AND $act=='input'){
    $jabatan    = $_POST['jabatan']; 
    $gapok      = $_POST['gapok'];
    $bonus      = $_POST['bonus'];

    //mycode
    $input = "INSERT INTO gaji (jabatan, gapok, bonus) VALUES('$jabatan', '$gapok', '$bonus')";
    var_dump($input);
    mysqli_query($konek, $input); 

    header("location:".$base_url.$module);
  }

  // Update templates
  elseif ($module=='gaji' AND $act=='update'){
    $id         = $_POST['id'];
    $jabatan    = $_POST['jabatan']; 
    $gapok      = $_POST['gapok'];
    $bonus      = $_POST['bonus'];

    $update = "UPDATE gaji SET jabatan='$jabatan', gapok='$gapok', bonus='$bonus' WHERE id='$id'"; var_dump($update);
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
