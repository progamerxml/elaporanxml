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

//   data role
    function getRole(){
        global $konek;
        $qrole = mysqli_query($konek, "select * from roles");
        $roles = array();
        if(mysqli_num_rows($qrole) > 0) {
            while($hrole = mysqli_fetch_assoc($qrole)){
                $roles[] = [
                    'id' => $hrole['id'],
                    'kode' => $hrole['kode'],
                    'nama' => $hrole['nama']
                ];
            }
        }else{
            $roles = array();
        }

        return $roles;
    }

    function getShift(){
        global $konek;
        $qshift = mysqli_query($konek, "select * from shifts");
        $shifts = [];
        if(mysqli_num_rows($qshift) > 0){
            while($hsift = mysqli_fetch_assoc($qshift)){
                $shifts[] = [
                    'id' => $hsift['id'],
                    'nama' => $hsift['nama']
                ];
            }
        }
        return $shifts;
    }

    function getKaryawan(){
      global $konek;
      $qkrywn = mysqli_query($konek, "select id, nama from pegawai");
      $employes = [];
      if(mysqli_num_rows($qkrywn) > 0){
        while($hempl = mysqli_fetch_assoc($qkrywn)){
          $employes [] = [
            "id" => $hempl['id'],
            "nama" => $hempl['nama']
          ];
        }
      }
      return $employes;
    }

    function getJadwal()
    {
      global $konek;
      $qjdwl = mysqli_query($konek, "SELECT 
                                          p.id AS pegawai_id,
                                          p.nama AS nama_pegawai,
                                          s.id AS schedule_id,
                                          sr.id AS schedule_relation_id,
                                          sr.shift_id,
                                          sr.role_id,
                                          sr.date,
                                          r.kode AS role_kode,
                                          r.nama AS role_nama,
                                          sh.nama AS shift_nama
                                      FROM 
                                          pegawai p
                                      LEFT JOIN 
                                          schedules s ON p.id = s.employ_id
                                      LEFT JOIN 
                                          schedule_relations sr ON s.schedule_id = sr.id
                                      LEFT JOIN 
                                          roles r ON sr.role_id = r.id
                                      LEFT JOIN 
                                          shifts sh ON sr.shift_id = sh.id");
      $schedules = array();
      if(mysqli_num_rows($qjdwl) > 0){
        while($hjdwl = mysqli_fetch_assoc($qjdwl)){
          $schedules [] = [
            "pegawai_id" => $hjdwl['pegawai_id'],
            "nama_pegawai" => $hjdwl['nama_pegawai'],
            "schedule_id" => $hjdwl['schedule_id'],
            "schedule_relation_id" => $hjdwl['schedule_relation_id'],
            "shift_id" => $hjdwl['shift_id'],
            "role_id" => $hjdwl['role_id'],
            "date" => $hjdwl['date'],
            "role_kode" => $hjdwl['role_kode'],
            "role_nama" => $hjdwl['role_nama'],
            "shift_nama" => $hjdwl['shift_nama'],
          ];
        }
      }

      return $schedules;
    }

  // Hapus templates
  if ($module=='jadwal' AND $act=='hapus'){
    $hapus = "DELETE FROM atasan WHERE id='$_GET[id]'";
    mysqli_query($konek, $hapus);
    
    header("location:".$base_url.$module);
  }

  // Input templates
  if ($module=='atasan' AND $act=='input'){
    $nama_atasan		= $_POST['nama_atasan'];

   
    
    $input = "INSERT INTO atasan(nama_atasan) VALUES('$nama_atasan')";
    mysqli_query($konek, $input);
    
     header("location:".$base_url.$module);
  }
  // Update templates
  elseif ($module=='atasan' AND $act=='update'){
    $id             = $_POST['id'];
    $nama_atasan		= $_POST['nama_atasan'];
   
    
    $update = "UPDATE atasan SET nama_atasan='$nama_atasan' WHERE id='$id'";
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