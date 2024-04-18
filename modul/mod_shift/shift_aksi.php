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
    if ($module=='shift' AND $act=='hapus'){
        mysqli_query($konek, "DELETE FROM shifts WHERE id='$_GET[id]'");
        header("location:".$base_url.$module);
    }  

  // Input templates
    if ($module=='shift' AND $act=='input'){
        $nama				= $_POST['nama'];

        $cek = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id) as jml FROM shifts WHERE nama = '$nama'"));
        var_dump($cek);
        if($cek['jml'] == 0){
            mysqli_query($konek, "insert into shifts (nama) Values ('$nama')");
        }  
        header("location:".$base_url.$module);
    }  

  // Update templates
    elseif ($module=='shift' AND $act=='update'){
        $id				    = $_POST['id'];
        $nama				= $_POST['nama'];
        mysqli_query($konek, "update shifts set nama = '$nama' WHERE id = $id");
        header("location:".$base_url.$module);
    }

    function getShift()
    {
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM shifts");
        $shifts = array();
        if (mysqli_num_rows($exec) > 0) {
            while ($shift = mysqli_fetch_assoc($exec)) {
                $shifts[] = [
                    'nama' => $shift['nama'],
                    'id' => $shift['id']
                ];
            }
        }
        return $shifts;
    }
}
?>
