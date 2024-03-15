<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	
	function ubah_tgl($tgl){
	        $tanggal = substr($tgl,0,2);
			$bulan = substr($tgl,3,2);
			$tahun = substr($tgl,6,4);
			return $tahun.'-'.$bulan.'-'.$tanggal;		 
	
       }	
	
	
	
    include "../../config/koneksi.php";
    include "../../config/fungsi_seo.php";
  //  include "../../config/fungsi_thumbnail.php";
  //  include "../../config/library.php";
  
  $module = $_GET['module'];

 
  $tgl_mulai      = ubah_tgl($_POST['tgl_mulai']);
  $tgl_selesai    = ubah_tgl($_POST['tgl_selesai']);
   
  
 $update="UPDATE waktu_akses SET tgl_mulai='$tgl_mulai',
												  tgl_selesai='$tgl_selesai'
					 where id='1';
 ";
 
 mysqli_query($konek, $update);
  
  if($update) 
		 echo "<script>alert('Data sudah tersimpan!'); window.location = '".$base_url.$module."'</script>";
	else 
		 echo "<script>alert('Data tidak tersimpan!'); window.location = '".$base_url.$module."'</script>";

}
?>
