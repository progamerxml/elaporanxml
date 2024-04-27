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
        mysqli_query($konek, "DELETE FROM kpis WHERE id='$_GET[id]'");
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

  // Input templates
    if ($module=='kpi' AND $act=='input'){
        $indikator = $_POST['indikator'];
        $recap = $_POST['recap'];
        $target = $_POST['target'];
        $param_indikator = explode(",", cleanString($_POST['param_indikator']));

        // var_dump(count($param_indikator));

        $cek = mysqli_fetch_array(mysqli_query($konek, "SELECT COUNT(id) as jml FROM kinerja_kuantitatif WHERE indikator = '$indikator'"));
        var_dump($cek);
        if($cek['jml'] == 0){
            mysqli_query($konek, "insert into kinerja_kuantitatif (indikator, recap, target, param_indikator) Values ('$indikator', '$recap', $target, '" . cleanString($_POST['param_indikator']) . "')");
            $create_table = "create table $indikator ( id INT(11) AUTO_INCREMENT PRIMARY KEY, tanggal DATE, created_at TIMESTAMP DEFAULT NOW(), updated_at TIMESTAMP)";
            mysqli_query($konek, $create_table);

            for($i = 0; $i < count($param_indikator); $i++){
                $alter_table = "ALTER table $indikator ADD COLUMN $param_indikator[$i] VARCHAR(255) DEFAULT NULL";
                mysqli_query($konek, $alter_table);
            }
        }

        // header("location:".$base_url.$module);
    }  

  // Update templates
    elseif ($module=='kpi' AND $act=='update'){
        $id				= $_POST['id'];
        $indikator      = $_POST['indikator'];
        $recap          = $_POST['recap'];
        $target         = $_POST['target'];
        mysqli_query($konek, "update kinerja_kuantitatif set indikator = '$indikator', recap = '$recap', target = '$target' WHERE id = $id");
        header("location:".$base_url.$module);
    }

    function getKinerja()
    {
        global $konek;
        $exec = mysqli_query($konek, "SELECT * FROM kinerja_kuantitatif");
        $kinerja2 = array();
        if (mysqli_num_rows($exec) > 0) {
            while ($kinerja = mysqli_fetch_assoc($exec)) {
                $kinerja2[] = [
                    'id' => $kinerja['id'],
                    'indikator' => $kinerja['indikator'],
                    'recap' => $kinerja['recap'],
                    'target' => $kinerja['target'],
                    'pencapaian' => $kinerja['pencapaian'],
                    'presentase' => $kinerja['presentase'],
                    'bobot' => $kinerja['bobot'],
                    'score' => $kinerja['score'],
                    'final_score' => $kinerja['final_score'],
                ];
            }
        }
        return $kinerja2;
    }

    
}
?>
