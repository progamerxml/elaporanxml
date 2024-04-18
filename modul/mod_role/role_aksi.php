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
    if ($module=='role' AND $act=='hapus'){
        mysqli_query($konek, "DELETE FROM roles WHERE id='$_GET[id]'");
        header("location:".$base_url.$module);
    }  

  // Input templates
    if ($module=='role' AND $act=='input'){
        $nama				= $_POST['nama'];
        $kode				= $_POST['kode'];  

        $cek = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id) as jml FROM roles WHERE nama = '$nama' AND kode = '$kode'"));
        var_dump($cek);
        if($cek['jml'] == 0){
            mysqli_query($konek, "insert into roles (kode, nama) Values ('$kode', '$nama')");
        }  
        header("location:".$base_url.$module);
    }  

  // Update templates
    elseif ($module=='role' AND $act=='update'){
        $id				    = $_POST['id'];
        $nama				= $_POST['nama'];
        $kode				= $_POST['kode'];  
        mysqli_query($konek, "update roles set kode = '$kode', nama = '$nama' WHERE id = $id");
        header("location:".$base_url.$module);
    }

    function getRole()
    {
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM roles");
        $roles = array();
        if (mysqli_num_rows($exec) > 0) {
            while ($role = mysqli_fetch_assoc($exec)) {
                $roles[] = [
                    'kode' => $role['kode'],
                    'nama' => $role['nama'],
                    'id' => $role['id']
                ];
            }
        }
        return $roles;
    }
}
?>
