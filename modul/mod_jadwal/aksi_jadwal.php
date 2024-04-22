<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    include "../../config/koneksi.php";

    $module = $_GET['module'];
    $act = $_GET['act'];

//   data role
    function getRole()
    {
        global $konek;
        $qrole = mysqli_query($konek, "select * from roles");
        $roles = array();
        if (mysqli_num_rows($qrole) > 0) {
            while ($hrole = mysqli_fetch_assoc($qrole)) {
                $roles[] = [
                    'id' => $hrole['id'],
                    'kode' => $hrole['kode'],
                    'nama' => $hrole['nama']
                ];
            }
        } else {
            $roles = array();
        }

        return $roles;
    }

    // cek otoritas
    function cekOto($username){
        global $konek;
        $otor = "select * from users where username like '%$username%'";
        $exec = mysqli_query($konek, $otor);
        $hasil = mysqli_fetch_array($exec);

        return $hasil;

    }

    function getShift()
    {
        global $konek;
        $qshift = mysqli_query($konek, "select * from shifts");
        $shifts = [];
        if (mysqli_num_rows($qshift) > 0) {
            while ($hsift = mysqli_fetch_assoc($qshift)) {
                $shifts[] = [
                    'id' => $hsift['id'],
                    'nama' => $hsift['nama']
                ];
            }
        }
        return $shifts;
    }

    function getKaryawan()
    {
        global $konek;
        $qkrywn = mysqli_query($konek, "select id, nama from pegawai");
        $employes = [];
        if (mysqli_num_rows($qkrywn) > 0) {
            while ($hempl = mysqli_fetch_assoc($qkrywn)) {
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
                              LEFT JOIN shifts s ON sc.shift_id = s.id WHERE p.id in(73,80,94)"
        );

        // Membuat array untuk menyimpan data jadwal untuk setiap karyawan
        $schedules = array();
        $jml_hari = cal_days_in_month(CAL_GREGORIAN, $waktu[0], $waktu[1]);

        // Menyiapkan daftar tanggal dari 1 hingga 30
        for ($i = 1; $i <= $jml_hari; $i++) {
            $tanggal = sprintf('%02d', $i); // Format tanggal menjadi dua digit angka
            $bulan = sprintf('%02d', $waktu[0]); // Format bulan menjadi dua digit angka
            $date = "$waktu[1]-$bulan-$tanggal"; // Format tanggal sesuai kebutuhan Anda

            // Menambahkan tanggal ke array jadwal untuk setiap karyawan
            foreach ($qjdwl as $row) {

                $nama_pegawai = $row['nama_pegawai'];
                $schedule_date = $row['date'];

                // Jika tanggal yang cocok ditemukan, tambahkan data role dan shift
                if ($date == $schedule_date) {
                    $id_pegawai = $row['pegawai_id'];
                    $role_id = $row['role_id'];
                    $nama_role = $row['nama_role'];
                    $shift_id = $row['shift_id'];
                    $nama_shift = $row['nama_shift'];
                    $schedule_date = $row['date'];

                    // Memasukkan data role dan shift ke dalam array jadwal
                    if (!isset($schedules[$nama_pegawai][$date])) {
                        $schedules[$nama_pegawai][$date] = array();
                    }

                    // Menambahkan data role dan shift ke dalam array jadwal
                    $schedules[$nama_pegawai][$date][] = array(
                        'pegawai_id' => $id_pegawai,
                        'role_id' => $role_id,
                        'nama_role' => $nama_role,
                        'shift_id' => $shift_id,
                        'nama_shift' => $nama_shift,
                        'tanggal' => $schedule_date
                    );
                }
            }

            // Jika tidak ada data untuk tanggal tertentu, tetap tambahkan tanggal dengan nilai null
            foreach ($qjdwl as $row) {
                $nama_pegawai = $row['nama_pegawai'];
                //$schedule_date = $row['date'];
                $id_pegawai = $row['pegawai_id'];

                if (!isset($schedules[$nama_pegawai][$date])) {
                    $schedules[$nama_pegawai][$date][] = array(
                        'pegawai_id' => $id_pegawai,
                        'role_id' => null,
                        'nama_role' => null,
                        'shift_id' => null,
                        'nama_shift' => null,
                        'tanggal' => $date
                    );
                }
            }
        }


        return $schedules;
    }

    function getJumlahHari()
    {
        $total_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        return $total_hari;
    }

    function getLogJadwal()
    {
        global $konek;
        $log = "SELECT * FROM log";
        $exec = mysqli_query($konek, $log);
        $logs = [];
        if (mysqli_num_rows($exec) > 0) {
            while ($log = mysqli_fetch_assoc($exec)) {
                $logs[] = [
                    'username' => $log['user'],
                    'aksi' => $log['aksi'],
                    'waktu' => $log['created_at']
                ];
            }
        }
        return $logs;

    }

    function getJadwalKini($data){
        global $konek;
        $query = "SELECT p.id AS pegawai_id, p.nama AS nama_pegawai, 
                            r.id AS role_id, r.nama AS nama_role, 
                            s.id AS shift_id, s.nama AS nama_shift, 
                            sc.id AS schedule_id, sc.date
                    FROM pegawai p
                    LEFT JOIN schedules sc ON p.id = sc.employ_id
                    LEFT JOIN roles r ON sc.role_id = r.id
                    LEFT JOIN shifts s ON sc.shift_id = s.id 
                    WHERE p.id = $data[id] and sc.`date` = '$data[tanggal]'";
        $exec = mysqli_query($konek, $query);
        $jadwalKini = mysqli_fetch_array($exec);
        return $jadwalKini;
    }

    // cek jadwal
    if($module == 'jadwal' and $act == 'cek-jadwal') {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $waktu = array("$bulan", "$tahun");

        $datas = getJadwal($waktu);
        $shift = getShift();
        $role = getRole();

        // Ambil semua id shift yang ada dalam data array $schedules
        $existingShiftIds = [];
        foreach ($datas as $nama => $jadwal) {
            foreach ($jadwal as $tanggal => $items) {
                foreach ($items as $item) {
                    if (isset($item['shift_id'])) {
                        $existingShiftIds[$item['shift_id']] = true;
                    }
                }
            }
        }

        // Filter data array $shift untuk mendapatkan shift yang tidak ada pada $existingShiftIds
        $missingShifts = array_filter($shift, function($item) use ($existingShiftIds) {
            return !isset($existingShiftIds[$item['id']]);
        });

        // Output array shift yang tidak ada pada $schedules
        print_r($missingShifts);

    }

    // update role
    if ($module == 'jadwal' and $act == 'update-role') {
        $tanggal = $_POST['tanggal'];
        $pegawai_id = $_POST['pegawai_id'];
        $role_id = $_POST['role_id'];
        $user = $_POST['user'];

        $query = "SELECT * FROM schedules WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
        $result = mysqli_query($konek, $query);

        if ($result->num_rows > 0) {
            $update = "UPDATE schedules SET role_id = '$role_id' WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
            mysqli_query($konek, $update);
            

            $log = "INSERT INTO log (user, aksi) VALUES ('$user', 'update data role pegawai: $pegawai_id, tanggal : $tanggal, role: $role_id')";
            mysqli_query($konek, $log);
        } else {
            $insert = "INSERT INTO schedules (employ_id, role_id, date) VALUES ('$pegawai_id', '$role_id', '$tanggal')";
            mysqli_query($konek, $insert);
            
            $log = "INSERT INTO log (user, aksi) VALUES ('$user', 'insert data role pegawai: $pegawai_id, tanggal : $tanggal, role: $role_id')";
            mysqli_query($konek, $log);
        }

        echo "Data berhasil disimpan";
    }

    if ($module == 'jadwal' and $act == 'update-shift') {
        $tanggal = $_POST['tanggal'];
        $pegawai_id = $_POST['pegawai_id'];
        $shift_id = $_POST['shift_id'];
        $user = $_POST['user'];

        $query = "SELECT * FROM schedules WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
        $result = mysqli_query($konek, $query);

        if ($result->num_rows > 0) {
            $update = "UPDATE schedules SET shift_id = '$shift_id' WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
            mysqli_query($konek, $update);

            $log = "INSERT INTO log (user, aksi) VALUES ('$user', 'update data shift pegawai: $pegawai_id, tanggal : $tanggal, shift: $shift_id')";
            mysqli_query($konek, $log);
        } else {
            $insert = "INSERT INTO schedules (employ_id, shift_id, date) VALUES ('$pegawai_id', '$shift_id', '$tanggal')";
            mysqli_query($konek, $insert);
            
            $log = "INSERT INTO log (user, aksi) VALUES ('$user', 'insert data shift pegawai: $pegawai_id, tanggal : $tanggal, shift: $shift_id')";
            mysqli_query($konek, $log);
        }

        echo "Data berhasil disimpan";
    }


    // Hapus templates
    if ($module == 'jadwal' and $act == 'hapus') {
        $tanggal = $_POST['tanggal'];
        $pegawai_id = $_POST['pegawai_id'];
        $hapus = "DELETE FROM schedules WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
        mysqli_query($konek, $hapus);

        echo "Data berhasil dihapus";
    }

    // next / prev bulan 
    if($module == 'jadwal' and $act == 'nav') {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $waktu = array("$bulan", "$tahun");

        session_start();
        $_SESSION['waktu'] = $waktu;

        header("Location: modul/mod_jadwal/jadwal.php");
        exit;
    }
} 