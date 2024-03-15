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

  $module = $_GET['module']; //var_dump($module);
  $act    = $_GET['act']; //var_dump($act);

  // Hapus templates
  if ($module=='tugas' AND $act=='hapus'){
    $hapus = "DELETE FROM task WHERE id='$_GET[id]'";
    mysqli_query($konek, $hapus);
    
    header("location:".$base_url.$module);
  }

// Input templates
  if ($module=='tugas' AND $act=='input'){
    echo "ko g masuk?";
    $nama_pegawai		= $_POST['nama']; //var_dump($nama_pegawai);
    $pembuat = $_POST['pembuat']; //var_dump($pembuat);
    $judul = $_POST['judul']; //var_dump($judul);
    $isi_tugas = $_POST['isi_tugas']; //var_dump($isi_tugas);
    $deadline = $_POST['tanggal_input']; //var_dump($deadline);
    $tgl_input = $_POST['tgl_input']; //var_dump($tgl_input);
    $dari = $_POST['lpem']; //var_dump($dari);
    $ke = explode(" - ", $nama_pegawai); //var_dump($ke['1']);
    $dr = explode(" - ", $pembuat); ////var_dump($
    $levke = mysqli_fetch_array(mysqli_query($konek, "SELECT a.level 
    FROM users a, pegawai b
    WHERE a.nama_lengkap = b.id AND b.nama LIKE '%$ke[1]%';")); //var_dump($levke['level']);

    $tgl = date("Y-m-d", strtotime($_POST['tanggal_input']));
    $cekTgl = date('Y-m-d',strtotime($tgl_input));

    
    //var_dump($dari); var_dump($levke['level']); var_dump($dr['0']);

    if($dari == $levke['level'] || $dari == 'admin' && $levke['level'] == 'karyawan' || $dari == 'karyawan' && $levke['level'] == 'admin' || $dr['0'] == 'Owner Utama'){
      //echo "bisa"; //var_dump($dari); echo "<br>";
      $qr = "SELECT COUNT(id) AS jml FROM task WHERE deadline = '$deadline' AND judul = '$judul' AND keterangan = '$isi_tugas' AND pembuat = '$pembuat' AND kepada = '$nama_pegawai'"; //var_dump($qr);
      $cek = mysqli_query($konek, $qr);
      $ada = mysqli_fetch_array($cek);
  
      if ($ada['jml'] <= 0)
      {     
        // mycode
        $input = "INSERT INTO task (tgl_input, deadline, judul, keterangan, status, kepada, pembuat) VALUES ('$tgl_input', '$deadline', '$judul', '$isi_tugas', 'baru', '$nama_pegawai', '$pembuat')"; var_dump($input);
        if($brhsl = mysqli_query($konek, $input)){ echo "berhasil"; } else { echo mysqli_error($konek); }
      }
    }
    echo "raiso<br>"; var_dump($dari);   echo "<br>";   var_dump($levke['level']);   echo "<br>";   var_dump($ke);   echo "<br>";   var_dump($dr['0']);   echo "<br>";
    header("location:".$base_url.$module);
  }

  // Update templates
  elseif ($module=='tugas' AND $act=='update'){
    $id             = $_POST['id'];
    $idkerja        = $_POST['idkerja'];
    // $karyawan       = $_POST['nama'];
    $detail_kerja   = $_POST['isi_kinerja'];
    $tanggal        = $_POST['tanggal'];
    $tgl = date("Y-m-d", strtotime($_POST['tanggal'])); //var_dump($tgl);


    $update = "UPDATE pekerjaan SET karyawan=$id, pekerjaan='$detail_kerja', tanggal=CURRENT_TIMESTAMP(), tgl='$tgl' WHERE id='$idkerja'"; //var_dump($update);
    mysqli_query($konek, $update);

    header("location:".$base_url.$module);
  }
  

  elseif($module == 'tugas' AND $act == 'uprogres')
  {
    $id = $_POST['id']; //var_dump($id);
    $status = $_POST['status']; //var_dump($status);
    $progres = $_POST['det_prog']; //var_dump($progres);
    $update = mysqli_query($konek, "UPDATE task set status = '$status', progres = '$progres', tgl_update = CURRENT_TIMESTAMP() WHERE id = $id");

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
