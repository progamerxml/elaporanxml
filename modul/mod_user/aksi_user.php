<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";
  include "../../config/fungsi_cryptologi.php";


  $module = $_GET['module']; //var_dump($module);
  $act    = $_GET['act']; //var_dump($act);

  // Hapus templates
  if ($module=='user' AND $act=='hapus'){
    $hapus = "DELETE FROM users WHERE id='$_GET[id]'";
    mysqli_query($konek, $hapus);
    
    header("location:".$base_url.$module);
  }


  // Input templates
  if ($module=='user' AND $act=='input'){
  $username		= $_POST['username'];
	$password		= encrypt($_POST['password']);
	$level		= $_POST['level'];
	$nama			= $_POST['nama'];

    $cek = "SELECT COUNT(username) AS jml FROM users WHERE username = '$username' OR nama_lengkap = $nama";
    $exec = mysqli_fetch_object(mysqli_query($konek, $cek));
    if($exec->jml < 1)
    {
      $input = "INSERT INTO users (username, password, level, nama_lengkap) VALUES('$username','$password','$level','$nama')";
      mysqli_query($konek, $input);
      header("location:".$base_url.$module);
    }else{
      echo "<script> alert('User sudah ada');</script>";
      header("location:".$base_url.$module."-tambah.html");
    }
  }
  
  // Update templates
  elseif ($module=='user' AND $act=='update'){
    $id         = $_POST['id'];
    $username		= $_POST['username'];
    $password		= encrypt($_POST['password']);
    $level		  = $_POST['level'];
    $blokir     = $_POST['blokir']; 

  if($password==""){
     $update = "UPDATE users SET  username='$username', level='$level', blokir='$blokir' WHERE id='$id'";
  }
  else{
     $update = "UPDATE users SET  password='$password', username='$username', level='$level', blokir='$blokir' WHERE id='$id'";
  }
    var_dump($update);
    mysqli_query($konek, $update);

    header("location:".$base_url.$module);
  }

  //tambah userlevel
  elseif($module == 'userlevel' AND $act=='input')
  {
    $userlevel = $_POST['userlevel']; //var_dump($userlevel);

    $cek = "SELECT COUNT(id) AS jml FROM user_level WHERE level = '$userlevel'";
    $exec = mysqli_fetch_object(mysqli_query($konek, $cek));
    if($exec->jml < 1)
    {
      $input = "INSERT INTO user_level (level) VALUES('$userlevel')";
      mysqli_query($konek, $input); 
      //echo "input berhasil";
      header("location:".$base_url.'user');
    }else{
      echo "<script> alert('User sudah ada');</script>";
      //echo "input gagal";
      header("location:".$base_url.$module."-tambahlevel.html");
    }
  }

  //update userlevel
  elseif($module=='userlevel' AND $act =='edit')
  {
    $userlevel = $_POST['userlevel']; //var_dump($userlevel);
    $parameter = $_POST['id']; //var_dump($parameter);

    $qupul= "UPDATE user_level SET level = '$userlevel' WHERE id = $parameter";  //var_dump($qupul);
    $ekul = mysqli_query($konek, $qupul);
    header("location:".$base_url.'user');
  }

  //hapus userlevel
  else if ($module= 'userlevel' AND $act=='hapus')
  {
    $hps = "DELETE FROM user_level WHERE id = $_GET[id]";
    mysqli_query($konek, $hps);
    //var_dump($hps);
    header("location:".$base_url.'user');
  }


  // Aktifkan templates
  elseif ($module=='templates' AND $act=='aktifkan'){
    $query1 = mysqli_query($konek, "UPDATE templates SET aktif='Y' WHERE id_templates='$_GET[id]'");
    $query2 = mysqli_query($konek, "UPDATE templates SET aktif='N' WHERE id_templates!='$_GET[id]'");

    header("location:../../media.php?module=".$module);
  }

}
?>
