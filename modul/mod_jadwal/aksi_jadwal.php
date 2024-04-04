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

    function getJadwal($waktu)
    {
      global $konek;
      $qjdwl = mysqli_query($konek, "SELECT p.id AS pegawai_id, p.nama AS nama_pegawai, 
                                    r.id AS role_id, r.nama AS nama_role, 
                                    s.id AS shift_id, s.nama AS nama_shift, 
                                    sc.id AS schedule_id, sc.date
                              FROM pegawai p
                              LEFT JOIN schedules sc ON p.id = sc.employ_id
                              LEFT JOIN roles r ON sc.role_id = r.id
                              LEFT JOIN shifts s ON sc.shift_id = s.id"
                            );
      // Membuat array untuk menyimpan data jadwal untuk setiap karyawan
      $schedules = array();

      // Menyiapkan daftar tanggal dari 1 hingga 30
      for ($i = 1; $i <= 30; $i++) {
          $tanggal = sprintf('%02d', $i); // Format tanggal menjadi dua digit angka
          $date = "2024-04-$tanggal"; // Format tanggal sesuai kebutuhan Anda
          
          // Menambahkan tanggal ke array jadwal untuk setiap karyawan
          foreach ($qjdwl as $row) {
              $nama_pegawai = $row['nama_pegawai'];
              $schedule_date = $row['date'];

              // Jika tanggal yang cocok ditemukan, tambahkan data role dan shift
              if ($date == $schedule_date) {
                  $role_id = $row['role_id'];
                  $nama_role = $row['nama_role'];
                  $shift_id = $row['shift_id'];
                  $nama_shift = $row['nama_shift'];

                  // Memasukkan data role dan shift ke dalam array jadwal
                  if (!isset($schedules[$nama_pegawai][$date])) {
                      $schedules[$nama_pegawai][$date] = array();
                  }

                  // Menambahkan data role dan shift ke dalam array jadwal
                  $schedules[$nama_pegawai][$date][] = array(
                      'role_id' => $role_id,
                      'nama_role' => $nama_role,
                      'shift_id' => $shift_id,
                      'nama_shift' => $nama_shift
                  );
              }
          }

          // Jika tidak ada data untuk tanggal tertentu, tetap tambahkan tanggal dengan nilai null
          foreach ($qjdwl as $row) {
              $nama_pegawai = $row['nama_pegawai'];
              $schedule_date = $row['date'];

              if (!isset($schedules[$nama_pegawai][$date])) {
                  $schedules[$nama_pegawai][$date] = null;
              }
          }
      }


      return $schedules;
    }

    function getJumlahHari()
    {
      $total_hari = cal_days_in_month(CAL_GREGORIAN, date("m"),date("Y"));
      return $total_hari;
    }

// Pastikan Anda memiliki koneksi ke basis data jika diperlukan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui AJAX
    $employ = $_POST['employ'];
    $tanggal = $_POST['tanggal'];
    $role = $_POST['role'];
    $shift = $_POST['shift'];

    // Lakukan operasi yang diperlukan, misalnya simpan data ke basis data
    // Contoh: Simpan data ke basis data menggunakan PDO
    // Ganti informasi koneksi dengan yang sesuai
    $host = 'localhost';
    $db = 'nama_database';
    $user = 'nama_pengguna';
    $pass = 'password';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Lakukan operasi simpan data ke dalam tabel tertentu
        // Contoh: Simpan data ke dalam tabel jadwal
        $stmt = $conn->prepare("INSERT INTO jadwal (employ, tanggal, role, shift) VALUES (:employ, :tanggal, :role, :shift)");
        $stmt->bindParam(':employ', $employ);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':shift', $shift);
        $stmt->execute();

        echo "Data berhasil disimpan"; // Kirim respon ke client
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage(); // Tangani kesalahan jika terjadi
    }
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