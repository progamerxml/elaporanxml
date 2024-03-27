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
                                          COALESCE(sr.date, '2024-03-01') AS tanggal,
                                          COALESCE(r.nama, 'Tidak ada role') AS nama_role,
                                          COALESCE(s.nama, 'Tidak ada shift') AS nama_shift
                                      FROM 
                                          pegawai p
                                      LEFT JOIN 
                                          schedules sc ON p.id = sc.employ_id
                                      LEFT JOIN 
                                          schedule_relations sr ON sc.schedule_id = sr.id AND MONTH(sr.date) = 3
                                      LEFT JOIN 
                                          roles r ON sr.role_id = r.id
                                      LEFT JOIN 
                                          shifts s ON sr.shift_id = s.id"
                            );
      $schedules = array();
      if(mysqli_num_rows($qjdwl) > 0){
        while($hjdwl = mysqli_fetch_assoc($qjdwl)){
          $pegawaiId = $hjdwl['pegawai_id'];
          $tanggal = $hjdwl['date'];
          $role = $hjdwl['role_id'];
          $shift = $hjdwl['shift_id'];
          if(!isset($schedules[$pegawaiId])){
            $schedules[$pegawaiId] = [];
          }

          if(!isset($schedules[$pegawaiId][$tanggal])){
            $schedules[$pegawaiId][$tanggal] = [];
          }
          
          $schedules[$pegawaiId][$tanggal] = [
            'role' => $role,
            'shift' => $shift
          ];
          
        }
      }

      return $schedules;
    }

    function getJumlahHari()
    {
      $total_hari = cal_days_in_month(CAL_GREGORIAN, date("m"),date("Y"));
      return $total_hari;
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