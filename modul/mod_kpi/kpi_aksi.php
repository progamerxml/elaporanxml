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
    if ($module=='kpi' AND $act=='hapus'){
        mysqli_query($konek, "DELETE FROM kinerja_kuantitatif WHERE id='$_GET[id]'");
        header("location:".$base_url.$module);
    }  

    function cleanString($input) {
        // Menghapus spasi di awal dan akhir baris
        $cleaned = trim($input);
    
        // Menghapus spasi di akhir baris
        $cleaned = preg_replace('/\s+$/m', '', $input);

        // Menghapus spasi yang berada setelah koma dalam string
        $cleaned = preg_replace('/,\s+/', ',', $input);
        
        // Mengubah spasi di antara 2 kata menjadi satu spasi
        $cleaned = preg_replace('/\s+/', '_', $cleaned);
        
        // Mengubah semua huruf menjadi huruf kecil
        $cleaned = strtolower($cleaned);
        
        return $cleaned;
    }

    // function getTableAsal
    function getTableAsal($id){
        global $konek;
        $exec = mysqli_query($konek, "SELECT nama FROM kinerja_kpi WHERE id = $id");
        if(mysqli_num_rows($exec) != 0){
            $row = mysqli_fetch_assoc($exec);
            $hasil = $row['nama'];
        }
        return $hasil;
    }

    // function untuk mengambil semua data kinerja kpi
    function getKinerja()
    {
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM kinerja_kpi");
        $kinerja2 = array();
        if (mysqli_num_rows($exec) > 0) {
            while ($kinerja = mysqli_fetch_assoc($exec)) {
                $kinerja2[] = [
                    'id' => $kinerja['id'],
                    'nama' => $kinerja['nama'],
                    'recap' => $kinerja['recap'],
                    'target' => $kinerja['target'],
                    'bobot' => $kinerja['bobot'],
                    'tipe' => $kinerja['tipe'],
                    'role_id' => $kinerja['role_id'],
                    'param_indikator' => $kinerja['param_indikator']
                ];
            }
        }
        return $kinerja2;
    }

    // function untuk mengambil data kinerja kpi berdasarkan role
    function getKinerjaKpi($role)
    {
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM kinerja_kpi where role_id = $role");
        $kinerja2 = array();
        if (mysqli_num_rows($exec) > 0) {
            while ($kinerja = mysqli_fetch_assoc($exec)) {
                $kinerja2[] = [
                    'id' => $kinerja['id'],
                    'nama' => $kinerja['nama'],
                    'recap' => $kinerja['recap'],
                    'target' => $kinerja['target'],
                    'bobot' => $kinerja['bobot'],
                    'tipe' => $kinerja['tipe'],
                    'role_id' => $kinerja['role_id'],
                    'param_indikator' => $kinerja['param_indikator']
                ];
            }
        }
        return $kinerja2;
    }

    // function untuk mendapatkan parameter indikator berdasarkan id
    function getParamIndById($id){
        global $konek;
        $ex = mysqli_query($konek, "select param_indikator from kinerja_kpi where id = $id");
        $hasil = mysqli_fetch_assoc($ex);
        $param = explode(",", $hasil['param_indikator']);
        return $param;
    }

    if($module == "kpi" && $act == "hapus"){
        $id = $_GET['id'];
        $table = getTableAsal($id);
        $dropTabel = mysqli_query($konek, "DROP TABLE $table");
        if($dropTabel === true){
            $hapus = mysqli_query($konek, "DELETE FROM kinerja_kpi WHERE id = $id");
        }

        $_SESSION['error'] = "Berhasil Menghapus Data dan tabel indikator.";
        header("location:".$base_url.$module);
    }

  // Input templates 
    if ($module=='kpi' AND $act=='input'){
        $nama = htmlspecialchars($_POST['nama']);
        $recap = htmlspecialchars($_POST['recap']);
        $target = htmlspecialchars($_POST['target']);
        $bobot = $_POST['bobot'];
        $role_id = $_POST['role_id'];
        $tipe  = htmlspecialchars($_POST['tipe']);
        $teks_param_indik = cleanString($_POST['param_indikator']);
        $param_indikator = explode(",", cleanString($teks_param_indik));

        $table_name = cleanString($nama); //var_dump($table_name);

        // var_dump(count($param_indikator));

        $cek = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id) as jml FROM kinerja_kpi WHERE nama = '$table_name'"));
        if($cek['jml'] == 0){
            mysqli_query($konek, "insert into kinerja_kpi (nama, recap, target, bobot, role_id, tipe, param_indikator) Values ('$table_name', '$recap', $target, $bobot, $role_id, '$tipe', '$teks_param_indik')");
            $create_table = "create table $table_name ( id INT(11) AUTO_INCREMENT PRIMARY KEY, tanggal DATE, created_at TIMESTAMP DEFAULT NOW(), updated_at TIMESTAMP)";
            mysqli_query($konek, $create_table);

            for($i = 0; $i < count($param_indikator); $i++){
                $alter_table = "ALTER table $table_name ADD COLUMN $param_indikator[$i] VARCHAR(255) DEFAULT NULL";
                mysqli_query($konek, $alter_table);
            }
        }
        session_start();
        $_SESSION['error'] = "Berhasil menambahkan dan membuat table $table_name";
        header("location:".$base_url.$module);
    }  

  // Update templates
    elseif ($module=='kpi' AND $act=='update'){
        $id				= $_POST['id'];
        $nama = htmlspecialchars($_POST['nama']);
        $recap = htmlspecialchars($_POST['recap']);
        $target = htmlspecialchars($_POST['target']);
        $bobot = $_POST['bobot'];
        $role_id = $_POST['role_id'];
        $tipe  = htmlspecialchars($_POST['tipe']);
        $teks_param_indik = cleanString($_POST['param_indikator']);
        $param_indikator = explode(",", cleanString($teks_param_indik));

        $table_name = cleanString($nama); // var_dump($table_name);
        $table_asal = getTableAsal($id); // var_dump($table_asal);

        $hasil = mysqli_query($konek, "update kinerja_kpi set nama = '$table_name', recap = '$recap', target = '$target', bobot = $bobot, role_id = $role_id, tipe = '$tipe', param_indikator = '$teks_param_indik' WHERE id = $id");
        // var_dump ($hasil);
        if($hasil === true){
            $alter = "ALTER TABLE $table_asal RENAME TO $table_name";
            $alterH = mysqli_query($konek, $alter);
            if($alterH === true){
                session_start();
                $_SESSION["error"] = "Nama Table berhasil diubah";
            }
        }
        header("location:".$base_url.$module);
    }

    elseif ($module=="kpi" AND $act=="get-param-indikator"){
        $id = explode("-",$_POST['id']);
        $hasil = mysqli_query($konek, "select param_indikator from kinerja_kpi where id = $id[0]");
        $row = mysqli_fetch_assoc($hasil);
        $param = explode(",", $row['param_indikator']);
        // print_r(count($param));
        
        for($i=0; $i<count($param); $i++){
            echo "<label for='".$param[$i]."'> ".$param[$i]."</label> <input type='text' class='form-control' id='".$param[$i]."' name='".$param[$i]."' placeholder='".$param[$i]."'> <br>";
        }
    }

    elseif($module=="kpi" AND $act=="input_kpi"){

        $idTable = (explode("-",$_POST['indikator']));
        $hasil = getParamIndById($idTable[0]);
        $tgl = date("Y-m-d");
        
        $kolom = "tanggal";
        $nilai = "'$tgl'";
        for ($i = 0; $i < count($hasil); $i++){
            $a = $hasil[$i];
            $kolom .= ", $a";
            $nilai .= ", '$_POST[$a]'";
        }

        $ex = mysqli_query($konek, "insert into $idTable[1] ($kolom) values ($nilai)");
        echo $ex ? "sukses" : "gagal";

    }

}
?>
