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

    // function untuk mendapatkan data role / golongan berdasarkan id
    function getGolongan($id)
    {
        global $konek;
        $query = "SELECT golongan FROM golongan_kpi WHERE id = $id";
        $ex = mysqli_query($konek, $query);
        if($ex){
            $brs = mysqli_fetch_assoc($ex);
            $golongan = $brs['golongan'];
        }

        return $golongan;
    }

    // function untuk mendapatkan detial score dan target KPI perkaryawan
    function getDetailIndikByPegawai($id)
    {
        global $konek;
        $datas = array();
        $query = "SELECT 
                    p.nama AS nama_pegawai,
                    kk.id AS kinerja_id, kk.nama AS nama_kinerja, kk.recap, kk.target, kk.bobot,
                    COALESCE(nk.pencapaian, 0) AS pencapaian, COALESCE(nk.score, 0) AS score, COALESCE(nk.persen, 0) AS persen, COALESCE(nk.final_score, 0) AS final_score,
                    COALESCE(nk.final_score, 0) AS jml_score
                FROM 
                    pegawai p
                JOIN 
                    jabatan j ON p.jabatan = j.id
                JOIN 
                    golongan_kpi gk ON j.gol_kpi = gk.id
                JOIN 
                    kinerja_kpi kk ON gk.id = kk.role_id
                LEFT JOIN 
                    nilai_kpi nk ON p.id = nk.pegawai_id AND kk.id = nk.indikator_id
                WHERE 
                    p.id = $id";

        $ex = mysqli_query($konek, $query);

        if($ex){
            $total_score = 0;
            while($bar = mysqli_fetch_assoc($ex)){
                $total_score += $bar['final_score'];
                $datas[] = [
                    "nama" => $bar['nama_pegawai'],
                    'nama_kinerja' => $bar['nama_kinerja'],
                    'recap' => $bar['recap'],
                    'target' => $bar['target'],
                    'bobot' => $bar['bobot'],
                    'pencapaian' => $bar['pencapaian'],
                    'persen' => $bar['persen'],
                    'score' => $bar['score'],
                    'final_score' => $bar['final_score'],
                ];
            }
        }
        return $datas;
    }

    // function untuk mendapatkan nilai kpi perkaryawan 
    function getDetailScoreKpi($id): array
    {
        $datas = array();
        global $konek;
        $query = "SELECT 
                    p.nama AS nama_pegawai,
                    kk.id AS kinerja_id,
                    kk.nama AS nama_kinerja,
                    COALESCE(nk.final_score, 0) AS final_score
                FROM 
                    pegawai p
                JOIN 
                    jabatan j ON p.jabatan = j.id
                JOIN 
                    golongan_kpi gk ON j.gol_kpi = gk.id
                JOIN 
                    kinerja_kpi kk ON gk.id = kk.role_id
                LEFT JOIN 
                    nilai_kpi nk ON p.id = nk.pegawai_id AND kk.id = nk.indikator_id
                WHERE 
                    p.id = $id";
        $ex = mysqli_query($konek, $query);
        if($ex != false){
            while($brs = mysqli_fetch_assoc($ex)){
                $datas [] = [
                    'id_indikator' => $brs['kinerja_id'],
                    'indikator' => $brs['nama_kinerja'],
                    'score' => $brs['final_score']
                ];
            }
        }

        return $datas;
    }
    // function untuk mendapatkan persentase, 
    function getPersenKpi($id = null)
    {
        global $konek;
        $query = ($id == null) ? "SELECT 
                    p.id as id_peg, p.nama AS nama_pegawai,
                    COALESCE(SUM(nk.persen), 0) AS total_persen,
                    COALESCE(SUM(nk.score), 0) AS total_score,
                    COALESCE(SUM(nk.final_score), 0) AS total_final_score
                FROM 
                    pegawai p
                JOIN 
                    jabatan j ON p.jabatan = j.id
                JOIN 
                    golongan_kpi gk ON j.gol_kpi = gk.id
                LEFT JOIN 
                    nilai_kpi nk ON p.id = nk.pegawai_id
                LEFT JOIN 
                    kinerja_kpi kk ON nk.indikator_id = kk.id
                WHERE 
                    j.gol_kpi != 9
                GROUP BY 
                    p.nama, p.id
                ORDER BY 
                    p.nama;" : "SELECT 
                    p.id as id_peg, p.nama AS nama_pegawai,
                    COALESCE(SUM(nk.persen), 0) AS total_persen,
                    COALESCE(SUM(nk.score), 0) AS total_score,
                    COALESCE(SUM(nk.final_score), 0) AS total_final_score
                FROM 
                    pegawai p
                JOIN 
                    jabatan j ON p.jabatan = j.id
                JOIN 
                    golongan_kpi gk ON j.gol_kpi = gk.id
                LEFT JOIN 
                    nilai_kpi nk ON p.id = nk.pegawai_id
                LEFT JOIN 
                    kinerja_kpi kk ON nk.indikator_id = kk.id
                WHERE 
                    j.gol_kpi != 9 AND p.id = $id
                GROUP BY 
                    p.nama, p.id
                ORDER BY 
                    p.nama";

        $ex = mysqli_query($konek, $query);
        $datas = array();
        while($row = mysqli_fetch_assoc($ex)){
            $datas[] = [
                'id_peg' => $row['id_peg'],
                'nama' => $row['nama_pegawai'],
                'persen' => $row['total_persen'],
                'score' => $row['total_score'],
                'total_score' => $row['total_final_score']
            ];
        }
        return $datas;
    }

    // function untuk mendapatkan data id jabatan dan karyawan by golongan kpi
    function getDataIdJabPeg($id)
    {
        global $konek;
        $query = "SELECT pegawai.id as pegId, pegawai.nama, jabatan.nama_jabatan, golongan_kpi.id
        FROM pegawai
        INNER JOIN jabatan ON pegawai.jabatan = jabatan.id
        INNER JOIN golongan_kpi ON jabatan.gol_kpi = golongan_kpi.id
        WHERE golongan_kpi.id = $id";
        
        $ex = mysqli_query($konek, $query);
        $idPeg = array();
        if(mysqli_num_rows($ex) > 0){
            while($brs = mysqli_fetch_assoc($ex)){
                $idPeg[] = [
                    'id_peg' => $brs['pegId'],
                    'nama_peg' => $brs['nama'],
                    'jabatan' => $brs['nama_jabatan']
                ];
            }
        }

        return $idPeg;
    }

    // function untuk mendapatkan data golongan KPI
    function getDataGolKpi($id = null){
        global $konek;
        $query = ($id == null) ? "SELECT * FROM golongan_kpi" : "SELECT * FROM golongan kpi WHERE id = $id";
        $ex = mysqli_query ($konek, $query);
        $gol2 = [];
        if(mysqli_num_rows($ex) > 0){
            while ($row = mysqli_fetch_assoc($ex)){
                $gol2[] = [
                    "id" => $row['id'],
                    "golongan" => $row['golongan']
                ];
            }
        }

        return $gol2;
    }

    // function untuk mendapatkan data indikator by ID
    function olahNilaiKpi($data, $pencapaian)
    {
        $persen = round($pencapaian / $data['target'], 2);
        $score = round($persen * $data['bobot'], 2);
        $finalScore = ($score <= $data['bobot']) ? round($persen * $data['bobot'], 2) : round($data['bobot'], 2);
        $data_nilai = [
            "persen" => $persen,
            "score" => $score,
            "final_score" => $finalScore
        ];
        return $data_nilai;
    }

    // function input / update nilai_kpi
    function setNilaiKpi($data){
        global $konek;
        
        $ex_penc = mysqli_query($konek, "SELECT COUNT(id) as total FROM $data[table] WHERE id_pgw = $data[pegawai_id]");
        $pencapaian = mysqli_fetch_assoc($ex_penc);
        
        $dataOlah = getKinerja($data['indikator_id']);
        $dataNilai = olahNilaiKpi($dataOlah[0], $pencapaian['total']);

        $cek = cekNilaiKpi($data);

        $query = ($cek) ? "UPDATE nilai_kpi set pencapaian = $pencapaian[total], persen = $dataNilai[persen], score = $dataNilai[score], final_score = $dataNilai[final_score] WHERE indikator_id = $data[indikator_id] AND pegawai_id = $data[pegawai_id]" : "INSERT INTO nilai_kpi (pegawai_id, indikator_id, pencapaian, persen, score, final_score) VALUES ($data[pegawai_id], $data[indikator_id], $pencapaian[total], $dataNilai[persen], $dataNilai[score], $dataNilai[final_score])";
        $ex = mysqli_query($konek, $query);
        $err = mysqli_error($konek);
        $sukses = ($ex) ? "sukses" : "gagal : $err";

        return $dataNilai;
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

        // Menghapus spasi yang berada setelah koma dalam string
        $cleaned = preg_replace('/,\s+/', ',', $cleaned);
    
        // buang tanda strip dari indikator
        $cleaned = preg_replace('/-/', '', $cleaned);

        // buang tanda slash
        $cleaned = preg_replace('/\//', '', $cleaned);

        // Menghapus spasi di akhir baris
        $cleaned = preg_replace('/\s+$/m', '', $cleaned);
        
        // menghapus tanda kurung
        $cleaned = preg_replace('/[()]/', '', $cleaned);
        
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
    function getKinerja($id = null)
    {
        global $konek;
        $query = ($id == null) ? "SELECT * FROM kinerja_kpi ORDER BY role_id ASC" : "SELECT * FROM kinerja_kpi WHERE id = $id";
        $exec = mysqli_query($konek, $query);
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
        $query = ($role == null) ? "SELECT * FROM kinerja_kpi ORDER BY role_id" : "SELECT * FROM kinerja_kpi where role_id = $role ORDER BY role_id";
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

        $nama = htmlspecialchars(cleanString($_POST['nama']));
        $recap = htmlspecialchars($_POST['recap']);
        $target = htmlspecialchars($_POST['target']);
        $bobot = $_POST['bobot'];
        $pencapaian = $target;
        $role_id = $_POST['gol_kpi'];
        $tipe  = htmlspecialchars($_POST['tipe']);
        $param_indik = $_POST['param_indikator'] ?? NULL;
        $teks_param_indik = cleanString($param_indik);
        $param_indikator = explode(",", cleanString($teks_param_indik));
        $golongan = getGolongan($role_id);

        $table_name = cleanString($nama . "_" . $golongan);
        
        $cek = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id) as jml FROM kinerja_kpi WHERE nama = '$table_name'"));
        mysqli_query($konek, "insert into kinerja_kpi (nama, recap, target, bobot, role_id, tipe, param_indikator) Values ('$table_name', '$recap', $target, $bobot, $role_id, '$tipe', '$teks_param_indik')");
        if($cek['jml'] == 0){
            
            if($tipe == 'kualitatif'){
                $idIndiKual = mysqli_insert_id($konek);
                $dataOlah = getKinerja($idIndiKual);
                $nilai = olahNilaiKpi($dataOlah[0],$pencapaian);
                $dataPeg = getDataIdJabPeg($role_id);
                
                foreach($dataPeg as $item){
                    $sInVal = "INSERT INTO nilai_kpi (pegawai_id, indikator_id, pencapaian, persen, score, final_score) VALUES ($item[id_peg], $idIndiKual, $target, $nilai[persen], $nilai[score], $nilai[final_score])";
                    $ex = mysqli_query($konek, $sInVal);
                    echo ($ex) ? "sukses" : "gagal : ".mysqli_error($konek);
                }
            }
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
        $table_name = cleanString($nama);
        $table_asal = getTableAsal($id);

        $hasil = mysqli_query($konek, "update kinerja_kpi set nama = '$table_name', recap = '$recap', target = '$target', bobot = $bobot, role_id = $role_id, tipe = '$tipe', param_indikator = '$teks_param_indik' WHERE id = $id");

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

        $ex = mysqli_query($konek, "insert into $idTable[1] ($kolom) values ($nilai)");

        $dataInputNilai = array(
            "indikator_id" => $idTable[0],
            "table" => $idTable[1],
            "pegawai_id" => $idPgw
        );
        $inputNilai = setNilaiKpi($dataInputNilai);

        session_start();
        $_SESSION['error'] = "Berhasil menambahkan menambahkan data KPI";
        header("location:".$base_url.$module);
    }

    elseif($module == "kpi" AND $act == "hapus_input_kpi"){
        $module = "input_kpi";
        $table = explode("-",$_GET["table"]);
        $indikator_id = $table[1];
        $table_name = $table[0];
        $id = $_GET['id'];
        if(mysqli_query($konek, "DELETE FROM $table_name WHERE id = $id")){
            $dataInputNilai = array(
                "indikator_id" => $indikator_id,
                "table" => $table_name,
                "pegawai_id" => $_GET['pegawai_id']
            );
            $upNilai = setNilaiKpi($dataInputNilai);
            session_start();
            $_SESSION['error'] = "Berhasil menghapus data input KPI dari table $table.";
            header("location:".$base_url.$module);
        }
    }

}
?>