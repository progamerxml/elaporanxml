<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_tugas/aksi_tugas.php";
	$persen = array("0%","5%", "10%", "15%", "20%", "25%", "30%", "35%", "40%", "45%", "50%", "55%", "60%", "65%", "70%", "75%", "80%", "85%", "90%", "95%", "100%");

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
  $mod=$_GET['module']; //var_dump($mod);
  $karyawan = mysqli_query($konek, "SELECT a.id, a.nama, a.jabatan, b.username FROM pegawai a, users b WHERE b.nama_lengkap = a.id AND b.username = '$_SESSION[namauser]'"); $hkaryawan = mysqli_fetch_array($karyawan); 
  $jabatan = mysqli_query($konek, "SELECT nama_jabatan as jabatan FROM jabatan WHERE id = $hkaryawan[jabatan]"); $hjabatan = mysqli_fetch_array($jabatan); //var_dump($hjabatan['jabatan']);
  $ctm = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jtm from task where kepada like '%$hkaryawan[nama]%' and status !='selesai'")); //var_dump($ctm->jtm);
  $cto = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jto from task where pembuat like '%$hkaryawan[nama]%'")); //var_dump($ctm->jtm);
  $ctp = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jtp from task where status != 'selesai' and kepada LIKE '%$hkaryawan[nama]%'"));
  $cts = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jts from task where status = 'selesai' and kepada LIKE '%$hkaryawan[nama]%'")); //var_dump($cts->jts);
?>
  <section class="content-header">
  <h1 class="page-header">
	  <small>
		  <font style="vertical-align: middle;"></font>
	  </small>
  </h1>
  <ol class="breadcrumb">
	  <li>
		  <a href="<?php echo $base_url; ?>">
			  <i class="fa fa-home"></i>
			  <font style="vertical-align: inherit;">Home </font>
		  </a>
	  </li>
	  <li class="active">
		<a href="<?php echo $base_url.'tugas'; ?>">
			<font style="vertical-align: inherit;">Manajemen Tugas</font>
		</a>
	  </li>
	  <li class="active"><font style="vertical-align: inherit;"><?php echo "Detail ".$mod; ?> </font></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
	  <div class="col-xs-12">
<?php
switch($act){
  // Tampil Templates
  	default:
 ?>

<?php
	$sp = "select a.id, a.nama, b.nama_jabatan as jabatan from pegawai a, jabatan b where a.jabatan = b.id"; $hpa = mysqli_query($konek, $sp);
	$tingkat = mysqli_query($konek, "SELECT a.level, b.nama FROM users a, pegawai b
	WHERE a.nama_lengkap = b.id AND username = '$_SESSION[namauser]'"); $htingkat = mysqli_fetch_array($tingkat); 
	$jabatan = mysqli_query($konek, "SELECT a.nama, b.nama_jabatan AS jabatan FROM pegawai a, jabatan b
	WHERE a.jabatan = b.id AND a.nama LIKE '%$htingkat[nama]%'"); $hjabatan = mysqli_fetch_array($jabatan); 

	//ambil data jumlah tugas masuk, keluar dan selesai
	if ($htingkat['level']=='superadmin' && $hjabatan['jabatan'] == 'Owner Utama')
	{ ?>

		<div class="box box-warning">
			<div class="content-header">
				<h1 class="box-title with-border">Rekap Tugas Karyawan</h1>
				<ul class="breadcrumb">
					<li><a class="btn btn-warning btn-xs" href="<?php echo $base_url.$mod; ?>-tambah.html"><i class="fa fa-plus"></i>Buat Tugas</a></li>
				</ul>
			</div>
			<div class="box-body"> 
				<table id="datadownload" class="table table-hover">
					<thead>
						<tr>
							<th class="text-center" width= "1%;">No</th>
							<th class="text-center" width= "12%;">Nama</th>
							<!-- <th class="text-center" width= "22%">Keterangan</th> -->
							<th class="text-center" width= "13%">Jabatan</th>
							<!-- <th class="text-center" width= "13%">Kepada</th> -->
							<th class="text-center" width= "5%">Tugas Masuk</th>
							<th class="text-center" width= "5%">Tugas Keluar</th>
							<th class="text-center" width= "5%">Tugas Selesai</th>
							<th class="text-center" width= "3%;">detail</th>
						</tr>
					</thead>
					<tbody>
					<?php
					//var_dump($task_masuk);
					$srdtk = "";
					$paramow = mysqli_query($konek, "SELECT a.id as id_peg, a.nama, b.id as id_us, b.username FROM pegawai a, users b WHERE a.id = b.nama_lengkap AND b.username = '$_SESSION[namauser]'"); $hparamow = mysqli_fetch_array($paramow);
					$task_keluarow = "SELECT * FROM task WHERE pembuat LIKE '%$hparamow[nama]%' ".$filter.$filter2." order by id DESC"; //var_dump($task_keluarow);
					$tampilow = mysqli_query($konek, $task_keluarow);
					$adatkeluarow = mysqli_num_rows($tampilow);
					if($adatkeluarow > 0) {
					$no=1;
					while ($hp=mysqli_fetch_array($hpa)){ 
						$sjtm = mysqli_fetch_object(mysqli_query($konek, "select count(id) as ttlmsk$no from task where kepada like '%$hp[nama]%'")); //echo $sjtm."<br>";
						$sjtk = mysqli_fetch_object(mysqli_query($konek, "select count(id) as ttlklr$no from task where pembuat like '%$hp[nama]%'"));
						$sjts = mysqli_fetch_object(mysqli_query($konek, "select count(id) as ttlsls$no from task where kepada like '%$hp[nama]%' and status = 'selesai'"));
						?>
						<tr>
							<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
							<td style="vertical-align: middle;"><?php echo $hp['nama']; ?></td>
							<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
							<td class="text-center" style="vertical-align: middle;"><?php echo $hp['jabatan']; ?></td>
							<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
							<td class="text-center" style="vertical-align: middle;"><?php $in = "ttlmsk$no"; echo $sjtm->$in; ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php $out = "ttlklr$no"; echo $sjtk->$out; ?></td>
							<td class="text-center" style="vertical-align: middle;"><?php $don = "ttlsls$no"; echo $sjts->$don; ?></td>
							<td class="text-center" style="vertical-align: middle;" align="center">
								<a href="<?php echo $base_url.$mod;?>-detail-<?php echo $hp['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
							</td>
						</tr>
											
						<?php $no++; } } else { ?>
						<tr>
							<td class="text-center" colspan="7" style="height: 20em; vertical-align: middle; text-align: center; "> Belum ada tugas keluar</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php }elseif($htingkat['level']=='admin' || $htingkat['level']=='superadmin'){ ?>

		<?php
		// admin dan superadmin
		$filter = '';
		$filter2 = '';
		if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
		if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
		$param = mysqli_query($konek, "SELECT a.id as id_peg, a.nama, b.id as id_us, b.username FROM pegawai a, users b WHERE a.id = b.nama_lengkap AND b.username = '$_SESSION[namauser]'"); $ow = mysqli_fetch_array($param); //var_dump($ow['nama']);
		$task_masuk  = "SELECT * FROM task WHERE kepada LIKE '%$ow[nama]%'  AND status != 'selesai' ".$filter.$filter2." order by id DESC"; //var_dump($task_masuk);
		$task_keluar = "SELECT * FROM task WHERE pembuat LIKE '%$ow[nama]%' ".$filter.$filter2." order by id DESC"; //var_dump($task_keluar); 
		?>

		<!-- notif-cound tugas perkaryawan -->

		<div class="row">
			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-aqua">
					<div class="inner">
							<h3><?php $jtm = $ctm->jtm ? $ctm->jtm : "0"; echo $jtm; ?></h3>
						<p>Total Tugas Masuk</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#tab_1" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		
			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php $jto = $cto->jto ? $cto->jto : "0"; echo $jto; ?></h3>
						<p>Total Tugas Keluar</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#tab_2" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?php $jtp = $ctp->jtp ? $ctp->jtp : "0"; echo $jtp; ?></h3>
						<p>Tugas dalam Proses</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#tab_3" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php $jts = $cts->jts ? $cts->jts : "0"; echo $jts; ?></h3>
						<p>Total Tugas Selesai</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#tab_4" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>

		<!-- tab data tugas -->

		<div class="row">
			<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_0" data-toggle="tab" aria-expanded="true"><strong>Rekap Tugas Karyawan</strong></a></li>
					<li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false"><strong>Tugas Masuk</strong></a></li>
					<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><strong>Tugas Keluar</strong></a></li>
					<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><strong>Tugas Terbaru</strong></a></li>
					<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><strong>Tugas Selesai</strong></a></li>
					<li class="pull-right"><a href="<?php echo $base_url.$mod; ?>-tambah.html" aria-expanded="false"><button type="button" class="btn btn-block btn-success btn-sm">Buat Tugas</button></a></li>
				</ul>
				<div class="tab-content">
					<!-- lalu lintas tugas terbaru -->
					<div class="tab-pane active" id="tab_0">
							<table id="datatemplates" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "1%;">No</th>
										<th class="text-center" width= "12%;">Nama</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Jabatan</th>
										<!-- <th class="text-center" width= "13%">Kepada</th> -->
										<th class="text-center" width= "5%">Tugas Masuk</th>
										<th class="text-center" width= "5%">Tugas Keluar</th>
										<th class="text-center" width= "5%">Tugas Selesai</th>
										<th class="text-center" width= "3%;">detail</th>
									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$srdtk = "";
								$paramow = mysqli_query($konek, "SELECT a.id as id_peg, a.nama, b.id as id_us, b.username FROM pegawai a, users b WHERE a.id = b.nama_lengkap AND b.username = '$_SESSION[namauser]'"); $hparamow = mysqli_fetch_array($paramow);
								$task_keluarow = "SELECT * FROM task WHERE pembuat LIKE '%$hparamow[nama]%' ".$filter.$filter2." order by id DESC"; //var_dump($task_keluarow);
								$tampilow = mysqli_query($konek, $task_keluarow);
								$adatkeluarow = mysqli_num_rows($tampilow);
								if($adatkeluarow > 0) {
								$no=1;
								while ($hp=mysqli_fetch_array($hpa)){ 
									$sjtm = mysqli_fetch_object(mysqli_query($konek, "select count(id) as ttlmsk$no from task where kepada like '%$hp[nama]%'")); //echo $sjtm."<br>";
									$sjtk = mysqli_fetch_object(mysqli_query($konek, "select count(id) as ttlklr$no from task where pembuat like '%$hp[nama]%'"));
									$sjts = mysqli_fetch_object(mysqli_query($konek, "select count(id) as ttlsls$no from task where kepada like '%$hp[nama]%' and status = 'selesai'"));
									?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td style="vertical-align: middle;"><?php echo $hp['nama']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $hp['jabatan']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php $in = "ttlmsk$no"; echo $sjtm->$in; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php $out = "ttlklr$no"; echo $sjtk->$out; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php $don = "ttlsls$no"; echo $sjts->$don; ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-detail-<?php echo $hp['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
														
									<?php $no++; } } else { ?>
									<tr>
										<td class="text-center" colspan="7" style="height: 20em; vertical-align: middle; text-align: center; "> Belum ada tugas keluar</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						
					</div>

					<!-- tugas masuk -->
					<div class="tab-pane" id="tab_1">
							<table id="datatemplates" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Pembuat</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Deadline</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$tampil = mysqli_query($konek, $task_masuk);
								$adatmasuk = mysqli_num_rows($tampil);
					
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['pembuat']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['deadline'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?> <button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
															<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
													
								  <?php $no++;  }  ?>
								
								</tbody>
							</table>
						
					</div>
	
					<!-- tugas keluar -->
					<div class="tab-pane" id="tab_2">
							<table id="datadownload" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Kepada</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Deadline</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">detail</th>
									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$tampil = mysqli_query($konek, $task_keluar);
								$adatkeluar = mysqli_num_rows($tampil);
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['kepada']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['deadline'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?> <button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
													
									<?php $no++; }  ?>
	
								</tbody>
							</table>
					</div>
	
					<!-- tugas terkini -->
						<?php 
							$user = mysqli_query($konek, "SELECT nama_lengkap FROM `users` WHERE `username` = '$_SESSION[namauser]'"); 
							$idnm = mysqli_fetch_array($user); $idpg = $idnm['nama_lengkap'];
							$tanggal = $_POST['tgl'];
							$fltrtgl = isset($_POST['tglfilter']) ? $_POST['tglfilter'] : ''; //var_dump($fltrtgl);
							$fltrnm = isset($_POST['namafilter']) ? $_POST['namafilter'] : ''; //var_dump($fltrnm);
							$level = mysqli_query($konek, "SELECT level FROM users WHERE username = '$_SESSION[namauser]'"); $hlev = mysqli_fetch_array($level);
						?>
						<?php 
							$tanggal = mysqli_query($konek, "SELECT DISTINCT(tgl) FROM pekerjaan order by tgl DESC");
							$skrg = date("d-m-Y"); 
							?>
					<div class="tab-pane" id="tab_3">
						<table id="datahalamanstatis" class="table table-hover">
							<thead>
								<th class="text-center">No</th>
								<th class="text-center">Judul</th>
								<th class="text-center">Pembuat</th>
								<th class="text-center">Kepada</th>
								<th class="text-center">Tanggal Input</th>
								<th class="text-center">Deadline</th>
								<th class="text-center">Status</th>
								<th class="text-center">Detail</th>
							</thead>
							<tbody>
							<?php
	
							$filter = '';
							$filter2 = '';
							if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
							if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
							if($hlev['level'] == 'admin') {
								$queryt  = "SELECT * FROM task WHERE kepada like '%$ow[nama]%' and status !='selesai'  order by id DESC";
							}
										//var_dump($query);
							$tampilt = mysqli_query($konek, $queryt);
							$adaterbaru = mysqli_num_rows($tampilt);
							$no=1;
							while ($trbr=mysqli_fetch_array($tampilt)){ ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td class="text-center"><?php echo $trbr['judul']; ?></td>
									<td class="text-center"><?php echo $trbr['pembuat']; ?></td>
									<td class="text-center"><?php echo $trbr['kepada']; ?></td>
									<td class="text-center"><?php echo $trbr['tgl_input']; ?></td>
									<td class="text-center"><?php echo $trbr['deadline']; ?></td>
									<td class="text-center"><?php if(empty($trbr['status'])){ ?><button class="btn btn-info btn-xs">diproses</button> <?php } else if($trbr['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $trbr['status']; ?></button> <?php } ?></td>
									<td class="text-center">
										<a href="<?php echo $base_url.$mod;?>-detail-<?php echo $trbr['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
									</td>
								</tr>
								<?php $no++; } ?>
	
							</tbody>
						</table>
					</div>
	
					<!-- tugas selesai -->
					<div class="tab-pane" id="tab_4">
							<table id="datahalamanstatis" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<th class="text-center" width= "22%">Keterangan</th>
										<th class="text-center" width= "13%">Pembuat</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Tanggal Selesai</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">detail</th>
									</tr>
								</thead>
								<tbody>
								<?php
	
								$filter = '';
								$filter2 = '';
								if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
								if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
								$param = mysqli_query($konek, "SELECT a.id as id_peg, a.nama, b.id as id_us, b.username FROM pegawai a, users b WHERE a.id = b.nama_lengkap AND b.username = '$_SESSION[namauser]'"); $hparam = mysqli_fetch_array($param); //var_dump($param);
								// if($hlev['level'] != 'admin'){
									$query  = "SELECT * FROM task WHERE kepada LIKE '%$hparam[nama]%' AND status = 'selesai'".$filter.$filter2." order by id DESC"; //var_dump($query);
								// }else{
								// 	$query = "SELECT * FROM task WHERE status = 'selesai'".$filter.$filter2." order by pembuat DESC";
								// }
								//var_dump($query);
								$tampil = mysqli_query($konek, $query);
								$adatselesai = mysqli_num_rows($tampil);
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr> 
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<td class="" style="vertical-align: middle;"><?php echo $r['keterangan']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['pembuat']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['tgl_input'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?><button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
									
									<?php $no++; } ?>
	
								</tbody>
							</table>

					</div>
				</div>
		</div>
	<?php }else{ ?> 

		<?php
		// admin dan karyawan
		$filter = '';
		$filter2 = '';
		if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
		if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
		$param = mysqli_query($konek, "SELECT a.id as id_peg, a.nama, b.id as id_us, b.username FROM pegawai a, users b WHERE a.id = b.nama_lengkap AND b.username = '$_SESSION[namauser]'"); $ow = mysqli_fetch_array($param); //var_dump($ow['nama']);
		$task_masuk  = "SELECT * FROM task WHERE kepada LIKE '%$ow[nama]%'  AND status != 'selesai' ".$filter.$filter2." order by id DESC"; //var_dump($task_masuk);
		$task_keluar = "SELECT * FROM task WHERE pembuat LIKE '%$ow[nama]%' ".$filter.$filter2." order by id DESC"; //var_dump($task_keluar); 
		?>

		<!-- notif-cound tugas perkaryawan -->

		<div class="row">
			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-aqua">
					<div class="inner">
							<h3><?php $jtm = $ctm->jtm ? $ctm->jtm : "0"; echo $jtm; ?></h3>
						<p>Total Tugas Masuk</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#tab_1" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		
			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php $jto = $cto->jto ? $cto->jto : "0"; echo $jto; ?></h3>
						<p>Total Tugas Keluar</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#tab_2" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?php $jtp = $ctp->jtp ? $ctp->jtp : "0"; echo $jtp; ?></h3>
						<p>Tugas dalam Proses</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#tab_3" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-sm-3 col-xs-12">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php $jts = $cts->jts ? $cts->jts : "0"; echo $jts; ?></h3>
						<p>Total Tugas Selesai</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="#tab_4" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>

		<!-- tab data tugas -->

		<div class="row">
			<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false"><strong>Tugas Masuk</strong></a></li>
					<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><strong>Tugas Keluar</strong></a></li>
					<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><strong>Tugas Terbaru</strong></a></li>
					<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><strong>Tugas Selesai</strong></a></li>
					<li class="pull-right"><a href="<?php echo $base_url.$mod; ?>-tambah.html" aria-expanded="false"><button type="button" class="btn btn-block btn-success btn-sm">Buat Tugas</button></a></li>
				</ul>
				<div class="tab-content">
					<!-- tugas masuk -->
					<div class="tab-pane active" id="tab_1">
							<table id="datatemplates" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Pembuat</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Deadline</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$tampil = mysqli_query($konek, $task_masuk);
								$adatmasuk = mysqli_num_rows($tampil);
					
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['pembuat']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['deadline'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?> <button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
															<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
													
								  <?php $no++;  }  ?>
								
								</tbody>
							</table>
						
					</div>
	
					<!-- tugas keluar -->
					<div class="tab-pane" id="tab_2">
							<table id="datadownload" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Kepada</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Deadline</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">detail</th>
									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$tampil = mysqli_query($konek, $task_keluar);
								$adatkeluar = mysqli_num_rows($tampil);
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['kepada']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['deadline'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?> <button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
													
									<?php $no++; }  ?>
	
								</tbody>
							</table>
					</div>
	
					<!-- tugas terkini -->
						<?php 
							$user = mysqli_query($konek, "SELECT nama_lengkap FROM `users` WHERE `username` = '$_SESSION[namauser]'"); 
							$idnm = mysqli_fetch_array($user); $idpg = $idnm['nama_lengkap'];
							$tanggal = $_POST['tgl'];
							$fltrtgl = isset($_POST['tglfilter']) ? $_POST['tglfilter'] : ''; //var_dump($fltrtgl);
							$fltrnm = isset($_POST['namafilter']) ? $_POST['namafilter'] : ''; //var_dump($fltrnm);
							$level = mysqli_query($konek, "SELECT level FROM users WHERE username = '$_SESSION[namauser]'"); $hlev = mysqli_fetch_array($level);
						?>
						<?php 
							$tanggal = mysqli_query($konek, "SELECT DISTINCT(tgl) FROM pekerjaan order by tgl DESC");
							$skrg = date("d-m-Y"); 
							?>
					<div class="tab-pane" id="tab_3">
						<table id="datahalamanstatis" class="table table-hover">
							<thead>
								<th class="text-center">No</th>
								<th class="text-center">Judul</th>
								<th class="text-center">Pembuat</th>
								<th class="text-center">Kepada</th>
								<th class="text-center">Tanggal Input</th>
								<th class="text-center">Deadline</th>
								<th class="text-center">Status</th>
								<th class="text-center">Detail</th>
							</thead>
							<tbody>
							<?php
	
							$filter = '';
							$filter2 = '';
							if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
							if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
							if($hlev['level'] == 'admin') {
								$queryt  = "SELECT * FROM task WHERE kepada like '%$ow[nama]%' and status !='selesai'  order by id DESC";
							}
										//var_dump($query);
							$tampilt = mysqli_query($konek, $queryt);
							$adaterbaru = mysqli_num_rows($tampilt);
							$no=1;
							while ($trbr=mysqli_fetch_array($tampilt)){ ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td class="text-center"><?php echo $trbr['judul']; ?></td>
									<td class="text-center"><?php echo $trbr['pembuat']; ?></td>
									<td class="text-center"><?php echo $trbr['kepada']; ?></td>
									<td class="text-center"><?php echo $trbr['tgl_input']; ?></td>
									<td class="text-center"><?php echo $trbr['deadline']; ?></td>
									<td class="text-center"><?php if(empty($trbr['status'])){ ?><button class="btn btn-info btn-xs">diproses</button> <?php } else if($trbr['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $trbr['status']; ?></button> <?php } ?></td>
									<td class="text-center">
										<a href="<?php echo $base_url.$mod;?>-detail-<?php echo $trbr['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
									</td>
								</tr>
								<?php $no++; } ?>
	
							</tbody>
						</table>
					</div>
	
					<!-- tugas selesai -->
					<div class="tab-pane" id="tab_4">
							<table id="datahalamanstatis" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<th class="text-center" width= "22%">Keterangan</th>
										<th class="text-center" width= "13%">Pembuat</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Tanggal Selesai</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">detail</th>
									</tr>
								</thead>
								<tbody>
								<?php
	
								$filter = '';
								$filter2 = '';
								if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
								if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
								$param = mysqli_query($konek, "SELECT a.id as id_peg, a.nama, b.id as id_us, b.username FROM pegawai a, users b WHERE a.id = b.nama_lengkap AND b.username = '$_SESSION[namauser]'"); $hparam = mysqli_fetch_array($param); //var_dump($param);
								// if($hlev['level'] != 'admin'){
									$query  = "SELECT * FROM task WHERE kepada LIKE '%$hparam[nama]%' AND status = 'selesai'".$filter.$filter2." order by id DESC"; //var_dump($query);
								// }else{
								// 	$query = "SELECT * FROM task WHERE status = 'selesai'".$filter.$filter2." order by pembuat DESC";
								// }
								//var_dump($query);
								$tampil = mysqli_query($konek, $query);
								$adatselesai = mysqli_num_rows($tampil);
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr> 
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<td class="" style="vertical-align: middle;"><?php echo $r['keterangan']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['pembuat']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['tgl_input'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?><button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
									
									<?php $no++; } ?>
	
								</tbody>
							</table>

					</div>
				</div>
		</div>
	<?php } ?>

	<!-- case tambah -->
	<?php
		break;
		
		case "tambah":
	?>
			<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Tugas</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=tugas&act=input" class="form-horizontal">
					
				<div class="box-body">
				<?php echo date("Y-m-d"); ?>
						<?php 
							$pembuat = mysqli_query($konek, "SELECT a.id, a.username, a.nama_lengkap AS id_peg, b.nama, c.id AS id_jbtn, c.nama_jabatan AS jabatan
							FROM users a, pegawai b, jabatan c 
							WHERE a.nama_lengkap = b.id AND b.jabatan = c.id AND a.username = '$_SESSION[namauser]'");
							$h = mysqli_fetch_array($pembuat);
							$level = mysqli_query($konek, "SELECT level FROM users WHERE username = '$_SESSION[namauser]'"); $hlev = mysqli_fetch_array($level); //var_dump($h['jabatan']);
						?>
						<div class="form-group">
							<div class="col-sm-6">
								<input type="hidden" name="pembuat" id="pembuat" class="form-control" value="<?php echo $h['jabatan']." - ".$h['nama']; ?>" required>
								<input type="hidden" name="lpem" value="<?php echo $hlev['level']; ?>">
								<input type="hidden" name="tgl_input" value="<?php echo date('Y-m-d'); ?>">
								<!-- <input type="text" name="pembuat" id="pembuat" class="form-control" value="<?php echo $h['nama']; ?>" required disabled> -->
							</div>
						</div>
							<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Kepada</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="nama" name="nama">
									<option value="0" selected>- Pilih Departemen -</option>
									<?php
									$query  = "SELECT a.nama, a.jabatan, b.nama_jabatan, b.id
									FROM pegawai a, jabatan b
									WHERE b.id = a.jabatan";
									$tampil = mysqli_query($konek, $query);
									while($r=mysqli_fetch_array($tampil)){?>
										<option value="<?php echo $r['nama_jabatan'].' - '.$r['nama']; ?>"> <?php echo $r['nama_jabatan']." - ".$r['nama']; ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>

						
						<!-- codeku irfan-->

						<div class="form-group">
							<label for="tanggal" class="col-sm-2 control-label">Deadline</label>
							<div class="col-sm-6">
								<input type="date" name="tanggal_input" id="tanggal_input" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<label for="tanggal" class="col-sm-2 control-label">Judul</label>
							<div class="col-sm-6">
								<input type="text" name="judul" id="judul" class="form-control" required>
							</div>
						</div>
						
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Detail / Keterangan</label>
							<div class="col-sm-6">
								<textarea name="isi_tugas" id="isi_tugas" cols="30" rows="10" class="form-control" required>

								</textarea>
							</div>
						</div>
				
						
						
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-warning btn-sm">Simpan</button> <button type="button" onclick="self.history.back()" class="btn btn-sm">Batal</button>
					</div><!-- /.box-footer -->
				</form>
            </div><!-- /.box -->
			
<!-- case edit -->
<?php
		break;
		
	case "edit":
	$level = mysqli_query($konek, "SELECT level FROM users WHERE username = '$_SESSION[namauser]'"); $hlev = mysqli_fetch_array($level);
	//var_dump($hlev['level']);
	if ($hlev['level'] == 'admin') {
	$detask = mysqli_query($konek, "SELECT * FROM task WHERE id = $_GET[id]"); $htask = mysqli_fetch_array($detask);
	$prmadm = $hjabatan['jabatan']." - ".$hkaryawan['nama']; 

?>
	<div class="box box-warning">
		<div class="box-header with-border">
			<h1 class="box-title">Update Detail</h1>
			<button type="button" onclick="self.history.back()" class="btn btn-warning btn-xs pull-right"><span aria-hidden="true"><font style="vertical-align: inherit;">kembali </font></span></button>
			<button class="btn btn-danger btn-xs pull-right" style="margin-right: 1em;"><a href="<?php echo $aksi."?module=tugas&act=hapus&id=".$htask['id']; ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data" style="color: white;">hapus</a></button>
		</div>
		<div class="box-body">
			<div class="col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title"><font style="vertical-align: inherit;"><strong><?php echo $htask['judul']; ?></strong></font></h3>
				</div>
				<div class="box-body">
					<dl class="dl-horizontal">
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Pembuat</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $htask['pembuat']; ?></font>
						</dd>
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Kepada</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $htask['kepada']; ?></font></font>
						</dd>
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Deadline Tugas</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $htask['deadline']; ?></font>
						</dd>
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Tanggal Input</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $htask['tgl_input']; ?></font>
						</dd>
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Status</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php if(empty($htask['status'])){ ?> <button class="btn btn-xs btn-primary">diproses</button> <?php }else{ ?> <button class="btn btn-xs <?php if($htask['status'] == 'selesai'){echo 'btn-success';}else{ echo 'btn-primary';} ?>"><?php echo $htask['status'];?></button> <?php } ?></font>
						</dd>
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Detail</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $htask['keterangan']; ?></font>
						</dd>
						<dt>
							<font style="vertical-align: middle; float: left; padding: .5em;">Progres</font>
						</dt>
						<dd>
							<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $htask['progres']; ?></font>
						</dd>
					</dl>
				</div>
			</div>
			<?php if ($htask['pembuat'] != $prmadm) { ?>
			<div class="col-md-6">
				<div class="box-header with-border">
						<strong>Update Progres</strong>
					</div>
					<div class="box-body">
						<form action="<?php echo $aksi; ?>?module=tugas&act=uprogres" method="post">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
							<label for="status"><font style="vertical-align: inherit;">Presentase progres :</font></label>
							<select name="status" class="form-control" id="status">
							<?php foreach($persen as $prsn){ ?>
								<option value="<?php if($prsn == '100%'){echo 'selesai';}else{echo $prsn;} ?>" <?php if($prsn == $htask["status"]){ echo "selected"; } ?> ><?php echo $prsn; ?></option>
							<?php } ?>
							</select>
							<br>
							<label for="det_prog">Detail Progres :</label>
							<textarea name="det_prog" id="isi_tugas" cols="30" rows="10">
								<?php if(empty($htask['progres'])) { echo "tuliskan detail progress yang sudah dicapai"; } else { echo $htask['progres']; } ?>
							</textarea>
							<br>
							<button type="submit" class="btn btn-warning btn-sm">update</button>
						</div>
						</form>
					</div>
			</div>
			<?php } ?>
		</div>
	</div>
<?php } else{ 
	//var_dump($hlev['level']);
	$det_tgs = mysqli_query($konek, "SELECT * FROM task WHERE id = $_GET[id]"); $hdet_tgs = mysqli_fetch_array($det_tgs); $prm = $hjabatan['jabatan']." - ".$hkaryawan['nama'];
	if ($prm == $hdet_tgs['pembuat']) { ?>
	<div class="box box-warning">
		<div class="box-header">
			<h1 class="box-title">Progres Tugas</h1>
			<button type="button" onclick="self.history.back()" class="btn btn-warning btn-xs pull-right"><span aria-hidden="true"><font style="vertical-align: inherit;">kembali</font></span></button>
			<button class="btn btn-danger btn-xs pull-right" style="margin-right: 1em;"><a href="<?php echo $aksi."?module=tugas&act=hapus&id=".$hdet_tgs['id']; ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data" style="color: white;">hapus</a></button>
		</div>
		<div class="box-body">
						<div class="box-header with-header">
							<h3 class="box-title"><font style="vertical-align: inherit;"><strong><?php echo $hdet_tgs['judul']; ?></strong></font></h3>
						</div>
						<div class="box-body">
						<dl class="dl-horizontal">
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Departement :</font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['kepada']; ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Tanggal Deadline :</font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['deadline']; ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Detail Tugas :</font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['keterangan']; ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Status : </font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php if(empty($hdet_tgs['status'])){ ?> <button class="btn btn-xs btn-primary">diproses</button> <?php }else{ ?> <button class="btn btn-xs <?php if($hdet_tgs['status'] == 'selesai'){echo 'btn-success';}else{ echo 'btn-primary';} ?>"><?php echo $hdet_tgs['status'];?></button> <?php } ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Progres : </font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['progres']; ?></font>
							</dd>
						</dl>
						</div>
					</div>

		</div>
	</div>
	<?php } else { ?>

<div class="box box-warning">
	<div class="box-header with-border">
		<h1 class="box-title">Update Detail</h1>
		<button type="button" onclick="self.history.back()" class="btn btn-warning btn-sm pull-right"><span aria-hidden="true"><font style="vertical-align: inherit;">kembali </font></span></button>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
					<div class="box-header with-border">
						<h3 class="box-title"><font style="vertical-align: inherit;"><strong><?php echo $hdet_tgs['judul']; ?></strong></font></h3>
						
					</div>
					<div class="box-body">
					<dl class="dl-horizontal">
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Pembuat :</font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['pembuat']; ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Tanggal Deadline :</font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['deadline']; ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Detail Tugas :</font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['keterangan']; ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Status : </font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php if(empty($hdet_tgs['status'])){ ?> <button class="btn btn-xs btn-primary">diproses</button> <?php }else{ ?> <button class="btn btn-xs <?php if($hdet_tgs['status'] == 'selesai'){echo 'btn-success';}else{ echo 'btn-primary';} ?>"><?php echo $hdet_tgs['status'];?></button> <?php } ?></font>
							</dd>
							<dt>
								<font style="vertical-align: middle; float: left; padding: .5em;">Progres : </font>
							</dt>
							<dd>
								<font style="vertical-align: middle; float: left; padding: .5em;"><?php echo $hdet_tgs['progres']; ?></font>
							</dd>
						</dl>
					</div>
			</div>
			<div class="col-md-6"</div>
					<div class="box-header with-border">
						<strong>Update Progres</strong>
					</div>
					<div class="box-body">
						<form action="<?php echo $aksi; ?>?module=tugas&act=uprogres" method="post">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
							<label for="status"><font style="vertical-align: inherit;">Presentase progres :</font></label>
							<select name="status" class="form-control" id="status">
							<?php foreach($persen as $prsn){ ?>
								<option value="<?php if($prsn == '100%'){echo 'selesai';}else{echo $prsn;} ?>" <?php if($prsn == $hdet_tgs["status"]){ echo "selected"; } ?> ><?php echo $prsn; ?></option>
							<?php } ?>
							</select>
							<br>
							<label for="det_prog">Detail Progres :</label>
							<textarea name="det_prog" id="isi_tugas" cols="30" rows="10">
								<?php if(empty($hdet_tgs['progres'])) { echo "tuliskan detail progress yang sudah dicapai"; } else { echo $hdet_tgs['progres']; } ?>
							</textarea>
							<br>
							<button type="submit" class="btn btn-warning btn-sm">update</button>
						</div>
						</form>
					</div>
				
			</div>
		</div>
	</div>
</div>
	<?php }}
		break;
		case "detail":
			$detailtsk = mysqli_query($konek, "SELECT * FROM pegawai WHERE id = $_GET[id]");
			$hdetailtsk = mysqli_fetch_array($detailtsk); //var_dump($hdetailtsk['nama']);
			$ctm = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jtm from task where kepada like '%$hdetailtsk[nama]%' and status !='selesai'")); //var_dump($ctm->jtm);
			$cto = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jto from task where pembuat like '%$hdetailtsk[nama]%'")); //var_dump($ctm->jtm);
			$ctp = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jtp from task where status != 'selesai' and kepada LIKE '%$hdetailtsk[nama]%'"));
			$cts = mysqli_fetch_object(mysqli_query($konek, "select count(id) as jts from task where status = 'selesai' and kepada LIKE '%$hdetailtsk[nama]%'")); //var_dump($cts->jts); 
			$task_masukid  = "SELECT * FROM task WHERE kepada LIKE '%$hdetailtsk[nama]%'  AND status != 'selesai' ".$filter.$filter2." order by id DESC"; //var_dump($task_masuk);
			$task_keluarid = "SELECT * FROM task WHERE pembuat LIKE '%$hdetailtsk[nama]%' ".$filter.$filter2." order by id DESC"; //var_dump($task_keluar); 
			{
	?>

<!-- tab data tugas -->

<div class="row">
	<div class="col-md-12">
		<h4>Nama : <?php echo $hdetailtsk['nama']; ?></h4> <br>
		<div class="nav-tabs-custom">

		<!-- counter -->
			<div class="row">
				<div class="col-sm-3 col-xs-12">
					<div class="small-box bg-aqua">
						<div class="inner">
								<h3><?php $jtm = $ctm->jtm ? $ctm->jtm : "0"; echo $jtm; ?></h3>
							<p>Total Tugas Masuk</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="#tab_1" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			
				<div class="col-sm-3 col-xs-12">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?php $jto = $cto->jto ? $cto->jto : "0"; echo $jto; ?></h3>
							<p>Total Tugas Keluar</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#tab_2" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			
				<div class="col-sm-3 col-xs-12">
					<div class="small-box bg-primary">
						<div class="inner">
							<h3><?php $jtp = $ctp->jtp ? $ctp->jtp : "0"; echo $jtp; ?></h3>
							<p>Tugas dalam Proses</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#tab_3" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			
				<div class="col-sm-3 col-xs-12">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php $jts = $cts->jts ? $cts->jts : "0"; echo $jts; ?></h3>
							<p>Total Tugas Selesai</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#tab_4" data-toggle="tab" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Tugas Masuk</strong></a></li>
					<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><strong>Tugas Keluar</strong></a></li>
					<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><strong>Tugas Terbaru</strong></a></li>
					<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><strong>Tugas Selesai</strong></a></li>
					<li class="pull-right"><a href="<?php echo $base_url.$mod; ?>-tambah.html" aria-expanded="false"><button type="button" class="btn btn-block btn-success btn-sm">Buat Tugas</button></a></li>
				</ul>
				<div class="tab-content">
					<!-- tugas masuk -->
					<div class="tab-pane active" id="tab_1">
							<table id="datatemplates" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Pembuat</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Deadline</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$tampil = mysqli_query($konek, $task_masukid);
								$adatmasuk = mysqli_num_rows($tampil);
					
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['pembuat']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['deadline'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?> <button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
													
								  <?php $no++;  }  ?>
								
								</tbody>
							</table>
						
					</div>
	
					<!-- tugas keluar -->
					<div class="tab-pane" id="tab_2">
							<table id="datadownload" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Kepada</th>
										<!-- <th class="text-center" width= "13%">Kepada</th>
										<th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Deadline</th>
										<th class="text-center" width= "6%">status</th>
  									</tr>
								</thead>
								<tbody>
								<?php
								//var_dump($task_masuk);
								$tampil = mysqli_query($konek, $task_keluarid);
								$adatkeluar = mysqli_num_rows($tampil);
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['kepada']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['kepada']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['deadline'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?> <button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td> -->
									</tr>
													
									<?php $no++; }  ?>
	
								</tbody>
							</table>
					</div>
	
					<!-- tugas terkini -->
						<?php 
							$user = mysqli_query($konek, "SELECT nama_lengkap FROM `users` WHERE `username` = '$_SESSION[namauser]'"); 
							$idnm = mysqli_fetch_array($user); $idpg = $idnm['nama_lengkap'];
							$tanggal = $_POST['tgl'];
							$fltrtgl = isset($_POST['tglfilter']) ? $_POST['tglfilter'] : ''; //var_dump($fltrtgl);
							$fltrnm = isset($_POST['namafilter']) ? $_POST['namafilter'] : ''; //var_dump($fltrnm);
							$level = mysqli_query($konek, "SELECT level FROM users WHERE username = '$_SESSION[namauser]'"); $hlev = mysqli_fetch_array($level);
						?>
						<?php 
							$tanggal = mysqli_query($konek, "SELECT DISTINCT(tgl) FROM pekerjaan order by tgl DESC");
							$skrg = date("d-m-Y"); 
							?>
					<div class="tab-pane" id="tab_3">
						<table id="datahalamanstatis" class="table table-hover">
							<thead>
								<th class="text-center">No</th>
								<th class="text-center">Judul</th>
								<th class="text-center">Pembuat</th>
								<th class="text-center">Kepada</th>
								<th class="text-center">Tanggal Input</th>
								<th class="text-center">Deadline</th>
								<th class="text-center">Status</th>
								<th class="text-center">Detail</th>
							</thead>
							<tbody>
							<?php
	
							$filter = '';
							$filter2 = '';
							if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
							if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
							if($hlev['level'] == 'admin') {
								$queryt  = "SELECT * FROM task WHERE kepada like '%$hdetailtsk[nama]%' order by id DESC";
							}
										//var_dump($query);
							$tampilt = mysqli_query($konek, $queryt);
							$adaterbaru = mysqli_num_rows($tampilt);
							$no=1;
							while ($trbr=mysqli_fetch_array($tampilt)){ ?>
								<tr>
									<td class="text-center"><?php echo $no; ?></td>
									<td class="text-center"><?php echo $trbr['judul']; ?></td>
									<td class="text-center"><?php echo $trbr['pembuat']; ?></td>
									<td class="text-center"><?php echo $trbr['kepada']; ?></td>
									<td class="text-center"><?php echo $trbr['tgl_input']; ?></td>
									<td class="text-center"><?php echo $trbr['deadline']; ?></td>
									<td class="text-center"><?php if(empty($trbr['status'])){ ?><button class="btn btn-info btn-xs">diproses</button> <?php } else if($trbr['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $trbr['status']; ?></button> <?php } ?></td>
									<td class="text-center">
										<a href="<?php echo $base_url.$mod;?>-detail-<?php echo $trbr['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
									</td>
								</tr>
								<?php $no++; } ?>
	
							</tbody>
						</table>
					</div>
	
					<!-- tugas selesai -->
					<div class="tab-pane" id="tab_4">

							<table id="datapolling" class="table table-hover">
								<thead>
									<tr>
										<th class="text-center" width= "3%;">No</th>
										<th class="text-center" width= "12%;">Judul</th>
										<!-- <th class="text-center" width= "22%">Keterangan</th> -->
										<th class="text-center" width= "13%">Pembuat</th>
										<th class="text-center" width= "13%">Kepada</th>
										<!-- <th class="text-center" width= "13%">Tanggal Input</th> -->
										<th class="text-center" width= "10%">Tanggal Selesai</th>
										<th class="text-center" width= "6%">status</th>
										<th class="text-center" width= "3%;">detail</th>
									</tr>
								</thead>
								<tbody>
								<?php
	
								$filter = '';
								$filter2 = '';
								if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
								if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
	
								$query  = "SELECT * FROM task WHERE status = 'selesai' AND kepada like '%$hdetailtsk[nama]%'".$filter.$filter2." order by id DESC";
								//var_dump($query);
								$tampil = mysqli_query($konek, $query);
								$adatselesai = mysqli_num_rows($tampil);
								if($adatselesai > 0) {
								$no=1;
								while ($r=mysqli_fetch_array($tampil)){ ?>
									<tr>
										<td class="text-center" style="vertical-align: middle;"><?php echo $no; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['judul']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo $r['keterangan']; ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['pembuat']; ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php echo $r['kepada']; ?></td>
										<!-- <td class="text-center" style="vertical-align: middle;"><?php //echo date("d-m-Y H:i:s",strtotime($r['tgl_input'])); ?></td> -->
										<td class="text-center" style="vertical-align: middle;"><?php echo date("d-m-Y",strtotime($r['tgl_input'])); ?></td>
										<td class="text-center" style="vertical-align: middle;"><?php if(empty($r['status'])){ ?><button class="btn btn-info btn-xs">diproses</button> <?php } else if($r['status'] == 'selesai') { ?> <button class="btn btn-success btn-xs">selesai</button> <?php } else { ?>  <button class="btn btn-xs btn-primary"><?php echo $r['status']; ?></button> <?php } ?></td>
										<td class="text-center" style="vertical-align: middle;" align="center">
											<a href="<?php echo $base_url.$mod;?>-edit-<?php echo $r['id']; ?>.html" title="lihat">Detail</a> &nbsp; 
										</td>
									</tr>
									
									<?php $no++; } ?>
								  <?php } ?>
								</tbody>
							</table>

<?php } }
?>
            </div><!-- /.col -->
		</div>
	</section>
<?php
}
?>
<script>
	function reset() {
		// document.getElementById("reset").window.location.href = "http://192.168.1.64/elaporanxml/kinerja";
		alert("hello world!");
	}
</script>