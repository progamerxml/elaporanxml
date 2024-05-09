<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
    include "../../config/koneksi.php";  
    // require_once __DIR__ . "/../mod_pegawai/aksi_pegawai.php";
    
    $module = $_GET['module'];
    $act    = $_GET['act'];  
    
    // Hapus templates
    if ($module=='kpi' AND $act=='hapus'){
        mysqli_query($konek, "DELETE FROM kinerja_kuantitatif WHERE id='$_GET[id]'");
        header("location:".$base_url.$module);
    }  

    // function input / update nilai_kpi
    function setNilaiKpi($data){
        global $konek;
        $query = ($data['cek']) ? "UPDATE $data[table] set pencapaian = $data[pencapaian]" : "INSERT INTO $data[table] (pencapaian) VALUES ($data[pencapaian])";
        $ex = mysqli_query($konek, $query);

    }

    // function cek nilai_kpi
    function cekNilaiKpi($data){
        global $konek;
        $hsl = true;
        $ex = mysqli_query($konek, "SELECT * FROM nilai_kpi WHERE pegawai_id = $data[pegawai_id] AND indikator_id = $data[indikator_id]");
        if(mysqli_num_rows($ex) == 0){
            $hsl = false;
        }

        return $hsl;
    }

    // function untuk mendapatkan data jabatan.
    function getGolKpi(){
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM golongan_kpi");
        $jabatan2 = array();
        if (mysqli_num_rows($exec) > 0) {
            while ($jabatan = mysqli_fetch_assoc($exec)) {
                $jabatan2[] = [
                    'id' => $jabatan['id'],
                    'golongan' => $jabatan['golongan']
                ];
            }
        }
        return $jabatan2;
    }

    // function untuk mendapatkan data golongan kpi berdasarkan karyawan yang login
    function getGolKpyByKar($id){
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM jabatan WHERE id = $id");
        if(mysqli_num_rows($exec) != 0){
            $row = mysqli_fetch_assoc($exec);
            $hasil = $row['gol_kpi'];
        }
        return $hasil;
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

    function camelCaseToSpace($text) {
        // Mengganti underscore dengan spasi
        $text = str_replace('_', ' ', $text);
        
        // Mengubah menjadi camel case
        $text = ucwords($text);
        
        // Menghapus spasi di awal dan akhir
        $text = trim($text);
        
        return $text;
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
    function getKinerjaKpi($role = null)
    {
        global $konek;
        $query = ($role == null) ? "SELECT * FROM kinerja_kpi where tipe = 'kuantitatif'" : "SELECT * FROM kinerja_kpi where role_id = $role and tipe = 'kuantitatif'";
        $exec = mysqli_query($konek,$query );
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
    
    // buat function untuk table yang di hasilkan dari input indikator
    $names = getKinerja();
    foreach($names as $name){
        $nama = $name['nama'];
        $functs = 'function '.$nama.'(){
            global $konek;
            $resultFunc'.$nama.' = array();
    
            // Eksekusi query
            $exec'.$nama.' = mysqli_query($konek, "SELECT * FROM '.$nama.'");
    
            // Mengambil data dengan mysqli_fetch_row()
            if (mysqli_num_rows($exec'.$nama.') > 0) {
                while ($rowFunc'.$nama.' = mysqli_fetch_row($exec'.$nama.')) {
                    // Tambahkan data ke dalam array $result
                    $resultFunc'.$nama.'[] = $rowFunc'.$nama.';
                }
                $resultfunc'.$nama.'["column"] = mysqli_field_count($konek);
            }
    
            return $resultFunc'.$nama.';
        };';

        eval($functs);
    }

    // function rearrange table
    function arangeColumn($arr1, $arr2){
        $arrBeforeSecondElement = array_slice($arr1, 0, 2);
        $arrAfterSecondElement = array_slice($arr1, 2);

        $arrHasil = array_merge($arrBeforeSecondElement, $arr2, $arrAfterSecondElement);
        return $arrHasil;
    }

    // testing 
    function test1(){
        global $konek;
        $resultFunc = array();

        // Eksekusi query
        $exec = mysqli_query($konek, "SELECT * FROM giveaway");

        // Mengambil data dengan mysqli_fetch_row()
        if (mysqli_num_rows($exec) > 0) {
            while ($rowFunc = mysqli_fetch_row($exec)) {
                // Tambahkan data ke dalam array $result
                $resultFunc[] = $rowFunc;
            }
            $resultFunc['column'] = mysqli_field_count($konek);
        }

        return $resultFunc;
    };

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
        $role_id = $_POST['gol_kpi'];
        $tipe  = htmlspecialchars($_POST['tipe']);
        $teks_param_indik = cleanString($_POST['param_indikator']);
        $param_indikator = explode(",", cleanString($teks_param_indik));

        $table_name = cleanString($nama); //var_dump($table_name);

        // var_dump(count($param_indikator));

        $cek = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id) as jml FROM kinerja_kpi WHERE nama = '$table_name'"));
        if($cek['jml'] == 0){
            mysqli_query($konek, "insert into kinerja_kpi (nama, recap, target, bobot, role_id, tipe, param_indikator) Values ('$table_name', '$recap', $target, $bobot, $role_id, '$tipe', '$teks_param_indik')");
            $create_table = "create table $table_name ( id INT(11) AUTO_INCREMENT PRIMARY KEY, id_pgw INT(11) NOT NULL, date DATE, created_at TIMESTAMP DEFAULT NOW(), updated_at TIMESTAMP, ket Varchar(255) Default Null, jumlah INT(11) default NULL )";
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

        $module = "input_kpi";
        $idPgw = $_POST["pegId"];
        $idTable = (explode("-",$_POST['indikator']));
        $hasil = getParamIndById($idTable[0]);
        $tgl = $_POST['date'];
        
        $kolom = "id_pgw, date, jumlah";
        $nilai = "$idPgw, '$tgl', 1";
        for ($i = 0; $i < count($hasil); $i++){
            $a = $hasil[$i];
            $kolom .= ", $a";
            $nilai .= ", '$_POST[$a]'";
        }

        // untuk debug output syntax query
        // echo "insert into $idTable[1] ($kolom) values ($nilai)";

        // exec syntax query
        $ex = mysqli_query($konek, "insert into $idTable[1] ($kolom) values ($nilai)");

        $ex_penc = mysqli_query($konek, "SELECT COUNT(id) as total FROM $idTable[1] WHERE id_pgw = $idPgw");
        $pencapaian = mysqli_fetch_assoc($ex_penc);
        // menampilkan pesan exec query
        echo $ex ? "sukses" : "gagal";
        print_r($pencapaian['total']);
        print_r($idTable[0]);

        $data = ["pegawai_id" => $idPgw, "indikator_id" => $idTable[0]];
        $cek = cekNilaiKpi($data);

        // session_start();
        // $_SESSION['error'] = "Berhasil menambahkan menambahkan data KPI";
        // header("location:".$base_url.$module);

    }

    elseif($module == "kpi" AND $act == "hapus_input_kpi"){
        $module = "input_kpi";
        $table = $_GET["table"];
        $id = $_GET['id'];
        if(mysqli_query($konek, "DELETE FROM $table WHERE id = $id")){
            session_start();
            $_SESSION['error'] = "Berhasil menghapus data input KPI dari table $table.";
            header("location:".$base_url.$module);
        }
    }

}
?>
