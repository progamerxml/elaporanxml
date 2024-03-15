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



  $module = $_GET['module'];
  $act    = $_GET['act'];

// Input templates
  if ($module=='gaji_test' AND $act=='upload'){
    $qdp = "SELECT nik, jabatan, email FROM pegawai WHERE id = $_POST[pegawai]"; $eqdp = mysqli_query($konek, $qdp); $hqdp = mysqli_fetch_object($eqdp);
    $pegawai = $_POST['pegawai']; $nik = $hqdp->nik; $jabatan = $hqdp->jabatan; $email = $hqdp->email ? $hqdp->email : "belum di input"; $npwp = 0; $bulan = $_POST['bulan']; $gapok = $_POST['gapok'] ? $_POST['gapok'] : 0; $bonus = $_POST['bonus'] ? $_POST['bonus'] : 0; $libur = $_POST['libur'] ? $_POST['libur'] : 0; $tunj_jbtn = $_POST['tunj_jbtn'] ? $_POST['tunj_jbtn'] : 0; $tunj_mkn = $_POST['tunj_mkn'] ? $_POST['tunj_mkn'] : 0; $tunj_mskrj = $_POST['tunj_mskrj'] ? $_POST['tunj_mskrj'] : 0; $tunj_kshtn = $_POST['tunj_kshtn'] ? $_POST['tunj_kshtn'] : 0; $tunj_bpjsjht = $_POST['tunj_bpjsjht'] ? $_POST['tunj_bpjsjht'] : 0; $tunj_hr = $_POST['tunj_hr'] ? $_POST['tunj_hr'] : 0; $bns_absn = $_POST['bns_absn'] ? $_POST['bns_absn'] : 0;
    $ganti_rugi = $_POST['ganti_rugi'] ? $_POST['ganti_rugi'] : 0; $pinjaman = $_POST['pinjaman'] ? $_POST['pinjaman'] : 0; $bpjs_kes = $_POST['bpjs_kes'] ? $_POST['bpjs_kes'] : 0; $bpjs_jht = $_POST['bpjs_jht'] ? $_POST['bpjs_jht'] : 0; $pph21 = $_POST['pph21'] ? $_POST['pph21'] : 0; $ptgn_absen = $_POST['ptgn_absen'] ? $_POST['ptgn_absen'] : 0; $ptgn_kpi = $_POST['ptgn_kpi'] ? $_POST['ptgn_kpi'] : 0; $ptgn_target = $_POST['ptgn_target'] ? $_POST['ptgn_target'] : 0; $total_pendapatan = $gapok+$bonus+$libur+$tunj_jbtn+$tunj_mkn+$tunj_mskrj+$tunj_kshtn+$tunj_bpjsjht+$tunj_hr+$bns_absn; $total_potongan = $ganti_rugi + $pinjaman + $bpjs_kes + $bpjs_jht + $pph21 + $ptgn_absen + $ptgn_kpi + $ptgn_target; $gaji_bersih = $total_pendapatan - $total_potongan; 

    $scek = "select bulan from penggajian_test where bulan = $bulan";
    if (mysqli_num_rows(mysqli_query($konek, $scek)) <= 0){
      $sql = "INSERT INTO penggajian_test(bulan, pegawai, nik, jabatan, npwp, gaji_pokok, bonus_intensif, lembur_tglmrh, tunj_jbtn, tunj_mkn, tunj_mskrj, tunj_kshtn, tunj_bpjsjht, thr, bns_absen, ttl_pndptn, ganti_rugi, pinjaman, bpjs_kshtn, bpjs_jht, pph21, ptgn_absen, ptgn_kpi, ptgn_target, ttl_ptgn, gaji_bersih, email) VALUES($bulan, $pegawai, $nik, $jabatan, '$npwp', $gapok, $bonus, $libur, $tunj_jbtn, $tunj_mkn, $tunj_mskrj, $tunj_kshtn, $tunj_bpjsjht, $tunj_hr, $bns_absn, $total_pendapatan, $ganti_rugi, $pinjaman, $bpjs_kes, $bpjs_jht, $pph21, $ptgn_absen, $ptgn_kpi, $ptgn_target, $total_potongan, $gaji_bersih, '$email')"; //var_dump($sql);
    }else{
      $sql = "UPDATE penggajian_test SET gaji_pokok = $gapok, bonus_intensif = $bonus, lembur_tglmrh = $libur, tunj_jbtn = $tunj_jbtn, tunj_mkn = $tunj_mkn, tunj_mskrj = $tunj_mskrj, tunj_kshtn = $tunj_kshtn, tunj_bpjsjht = $tunj_bpjsjht, thr = $tunj_hr, bns_absen = $bns_absn, ttl_pndptn = $total_pendapatan, ganti_rugi = $ganti_rugi, pinjaman = $pinjaman, bpjs_kshtn = $bpjs_kes, bpjs_jht = $bpjs_jht, pph21 = $pph21, ptgn_absen = $ptgn_absen, ptgn_kpi = $ptgn_kpi, ptgn_target = $ptgn_target, ttl_ptgn = $total_potongan, gaji_bersih = $gaji_bersih WHERE pegawai = $pegawai";
      //var_dump($sql);
    }
    if(mysqli_query($konek, $sql) == true){ ?>
      <script>
        alert("Update / Input Data Berhasil");
      </script>
    <?php }else{ ?>
      <script>
        alert("Update / Input Data Gagal");
      </script>
    <?php } ?>
        <!-- // // upload file xls
        //   $nama_file_baru = $_POST['gaji_excel'];
        //     $path = 'tmp/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana
        
        //     $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        //     $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
        //     $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        //   $numrow = 1;
        //   foreach($sheet as $row){
        //     // Ambil data pada excel sesuai Kolom
        //     $pegawai = $row['A']; // Ambil data NIS
        //     $jabatan = $row['B']; // Ambil data nama
        //     $gaji = $row['C']; // Ambil data jenis kelamin
        //     $potongan = $row['D']; // Ambil data telepon
        //     $gaji_bersih = $row['E']; // Ambil data alamat
        
        //     // Cek jika semua data tidak diisi
        //     if($pegawai == "" && $jabatan == "" && $gaji == "" && $potongan == "" && $gaji_bersih == "")
        //       continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        
        //     // Cek $numrow apakah lebih dari 1
        //     // Artinya karena baris pertama adalah nama-nama kolom
        //     // Jadi dilewat saja, tidak usah diimport
        //     if($numrow > 1){
        //       // Buat query Insert
        //       $query = "INSERT INTO gaji_test VALUES('" . $pegawai . "','" . $jabatan . "','" . $gaji . "','" . $potongan . "','" . $gaji_bersih . "')";
        
        //       // Eksekusi $query
        //       mysqli_query($connect, $query);
        //     }
        
        //     $numrow++; // Tambah 1 setiap kali looping
        
        //     unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file
        // }
        
        // header('location: index.php'); // Redirect ke halaman awal -->
 <?php }

    elseif($module='gaji_test' AND $act =='update'){
      $pegawai = $_POST['pgwi']; $gapok = $_POST['gapok'] ? $_POST['gapok'] : 0; $bonus = $_POST['bonus'] ? $_POST['bonus'] : 0; $libur = $_POST['libur'] ? $_POST['libur'] : 0; $tunj_jbtn = $_POST['tunj_jbtn'] ? $_POST['tunj_jbtn'] : 0; $tunj_mkn = $_POST['tunj_mkn'] ? $_POST['tunj_mkn'] : 0; $tunj_mskrj = $_POST['tunj_mskrj'] ? $_POST['tunj_mskrj'] : 0; $tunj_kshtn = $_POST['tunj_kshtn'] ? $_POST['tunj_kshtn'] : 0; $tunj_bpjsjht = $_POST['tunj_bpjsjht'] ? $_POST['tunj_bpjsjht'] : 0; $tunj_hr = $_POST['tunj_hr'] ? $_POST['tunj_hr'] : 0; $bns_absn = $_POST['bns_absn'] ? $_POST['bns_absn'] : 0;

    $ganti_rugi = $_POST['ganti_rugi'] ? $_POST['ganti_rugi'] : 0; $pinjaman = $_POST['pinjaman'] ? $_POST['pinjaman'] : 0; $bpjs_kes = $_POST['bpjs_kes'] ? $_POST['bpjs_kes'] : 0; $bpjs_jht = $_POST['bpjs_jht'] ? $_POST['bpjs_jht'] : 0; $pph21 = $_POST['pph21'] ? $_POST['pph21'] : 0; $ptgn_absen = $_POST['ptgn_absen'] ? $_POST['ptgn_absen'] : 0; $ptgn_kpi = $_POST['ptgn_kpi'] ? $_POST['ptgn_kpi'] : 0; $ptgn_target = $_POST['ptgn_target'] ? $_POST['ptgn_target'] : 0; $total_pendapatan = $gapok+$bonus+$libur+$tunj_jbtn+$tunj_mkn+$tunj_mskrj+$tunj_kshtn+$tunj_bpjsjht+$tunj_hr+$bns_absn; $total_potongan = $ganti_rugi + $pinjaman + $bpjs_kes + $bpjs_jht + $pph21 + $ptgn_absen + $ptgn_kpi + $ptgn_target; $gaji_bersih = $total_pendapatan - $total_potongan; 

    $sql = "UPDATE penggajian_test SET gaji_pokok = $gapok, bonus_intensif = $bonus, lembur_tglmrh = $libur, tunj_jbtn = $tunj_jbtn, tunj_mkn = $tunj_mkn, tunj_mskrj = $tunj_mskrj, tunj_kshtn = $tunj_kshtn, tunj_bpjsjht = $tunj_bpjsjht, thr = $tunj_hr, bns_absen = $bns_absn, ttl_pndptn = $total_pendapatan, ganti_rugi = $ganti_rugi, pinjaman = $pinjaman, bpjs_kshtn = $bpjs_kes, bpjs_jht = $bpjs_jht, pph21 = $pph21, ptgn_absen = $ptgn_absen, ptgn_kpi = $ptgn_kpi, ptgn_target = $ptgn_target, ttl_ptgn = $total_potongan, gaji_bersih = $gaji_bersih WHERE pegawai = $pegawai"; var_dump($sql);
    }
  // Aktifkan templates
    elseif ($module=='templates' AND $act=='aktifkan'){
    $query1 = mysqli_query($konek, "UPDATE templates SET aktif='Y' WHERE id_templates='$_GET[id]'");
    $query2 = mysqli_query($konek, "UPDATE templates SET aktif='N' WHERE id_templates!='$_GET[id]'");

    header("location:../../media.php?module=".$module);
  }
}
?>
