<?php
// Load file autoload.php
include '../../import_phpspreadsheet/vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
?>  
<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>"; 
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
  require_once __DIR__ . "/modul/mod_jadwal/aksi_jadwal.php";

  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e-Report XML</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"> 
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-yellow.min.css">

    <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- Load File jquery.min.js yang ada difolder js -->
        <script src="import_phpspreadsheet/js/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                // Sembunyikan alert validasi kosong
                $("#kosong").hide();
            });
        </script>
  </head>
  <body class="hold-transition skin-yellow sidebar-mini border border-5 border-light">
    <div class="wrapper border border-5 border-success">
      <header class="main-header">
        <a href="<?php echo $base_url; ?>" class="logo">
          <span class="logo-mini border border-light"><image src="Logo Bulat XML.png" width="30px" style="margin-right: .5em;"></span>
          <span class="logo-md"><image src="Logo Bulat XML.png" width="25px" style="margin-right: .5em;">Panel <b>eReport XML</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
		  
		  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
               
          </li>
			  <!-- <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Tambah"><i class="fa fa-plus"></i></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo $base_url;?>kastunai-tambah.html" title="Tambah Kas Tunai">Kas Tunai</a></li>
					<li><a href="<?php echo $base_url;?>kasbank-tambah.html" title="Tambah Berita">Kas Bank</a></li>
					<li><a href="<?php echo $base_url;?>pendapatanmurni-tambah.html" title="Tambah Kas Bank">Pendapatan Murni</a></li>
					<li><a href="<?php echo $base_url;?>pendapatanbank-tambah.html" title="Tambah Pendapatan Bank">Pendapatan Bank</a></li>
					<li><a href="<?php echo $base_url;?>belanjapegawai-tambah.html" title="Tambah Belanja Pegawai">Belanja Pegawai</a></li>
					<li><a href="<?php echo $base_url;?>belanjajasa-tambah.html" title="Tambah Belanja Jasa">Belanja Jasa</a></li>
					<li><a href="<?php echo $base_url;?>belanjamodal-tambah.html" title="Tambah Belanja Modal">Belanja Modal</a></li>
					
					
				</ul>
			  </li> -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <i class="fa fa-user"></i>
              <span class="hidden-xs"><?php //var_dump($_SESSION['namalengkap']);
              $pgwi = mysqli_query($konek, "SELECT id, nama, tgl_masuk FROM pegawai WHERE id = $_SESSION[namalengkap]");
              $nmpgw = mysqli_fetch_array($pgwi);
              $jadwalKini = getJadwalKini(["id" => $nmpgw["id"], "tanggal" => date("Y-m-d")]);
                echo $nmpgw['nama'] . " ( " . $jadwalKini['nama_role'] . " - " . $jadwalKini['nama_shift'] . " )"; 
                //var_dump($_SESSION['namalengkap']);
              ?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="user-header">
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                <i class="fa fa-user"></i>
                <p>
                  <?php echo $nmpgw['nama']; ?>
                  <small>Anggota sejak <?php echo date("d M Y", strtotime($nmpgw['tgl_masuk'])); ?></small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $base_url;?>profile" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- <li class="dropdown user user-menu">
              <a href="#"> 
                <i class="fa fa-user"></i>
                <span class="hidden-xs"><?php echo $_SESSION['namalengkap']; ?></span>
              </a>
          </li>
			    <li>
                <a href="logout.php" title="KELUAR"><i class="fa fa-sign-out"></i></a>
          </li>
			    <li>
               <a href="#" data-toggle="control-sidebar" title="Option"><i class="fa fa-gears"></i></a>
          </li> -->
            </ul>
          </div>
        </nav>
      </header>
<?php
}
?>


<!-- chart highchart -->
	<script src="plugins/highcharts/code/highcharts.js"></script>
   <script src="plugins/highcharts/code/highcharts-3d.js"></script>
   <script src="plugins/highcharts/code/modules/exporting.js"></script>
   