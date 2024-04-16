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
                              LEFT JOIN shifts s ON sc.shift_id = s.id"
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

    if ($module == 'jadwal' and $act == 'update-role') {
        $tanggal = $_POST['tanggal'];
        $pegawai_id = $_POST['pegawai_id'];
        $role_id = $_POST['role_id'];

        $query = "SELECT * FROM schedules WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
        $result = mysqli_query($konek, $query);

        if ($result->num_rows > 0) {
            $update = "UPDATE schedules SET role_id = '$role_id' WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
            mysqli_query($konek, $update);
        } else {
            $insert = "INSERT INTO schedules (employ_id, role_id, date) VALUES ('$pegawai_id', '$role_id', '$tanggal')";
            mysqli_query($konek, $insert);
        }

        echo "Data berhasil disimpan";
    }

    if ($module == 'jadwal' and $act == 'update-shift') {
        $tanggal = $_POST['tanggal'];
        $pegawai_id = $_POST['pegawai_id'];
        $shift_id = $_POST['shift_id'];

        $query = "SELECT * FROM schedules WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
        $result = mysqli_query($konek, $query);

        if ($result->num_rows > 0) {
            $update = "UPDATE schedules SET shift_id = '$shift_id' WHERE employ_id = '$pegawai_id' AND date = '$tanggal'";
            mysqli_query($konek, $update);
        } else {
            $insert = "INSERT INTO schedules (employ_id, shift_id, date) VALUES ('$pegawai_id', '$shift_id', '$tanggal')";
            mysqli_query($konek, $insert);
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
} 