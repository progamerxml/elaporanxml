<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_agenda/aksi_agenda.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
  $mod=$_GET['module']; 
?>
	<!-- Main content -->
	<section class="content-header">
		<h1 class="page-header">
			<!-- <font style="vertical-align: inherit;">Rekap Report Hari ini</font> -->
			<small>
				<font style="vertical-align: inherit;"></font>
			</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo $base_url; ?>">
					<i class="fa fa-home"></i>
					<font style="vertical-align: inherit;">Home </font>
				</a>
			</li>
			<li class="active"><font style="vertical-align: inherit;"><?php echo $mod; ?> </font></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
<?php

  switch($act){
    // Tampil Agenda
    default:
  
 //echo "";
?>
<?php
    $today = date('Y-m-d');
    $jmlpg = mysqli_query($konek, "SELECT * FROM pegawai where report = 1");
    $jmlpgw = mysqli_num_rows($jmlpg);
    // echo $jmlpgw;
    $count = mysqli_query($konek, "SELECT DISTINCT karyawan FROM pekerjaan where tgl = '$today'"); //var_dump($nmpgw['nama']);
    $jml = mysqli_num_rows($count);
    // echo $jml;
    $blm = $jmlpgw - $jml;
	$jtugas = mysqli_query($konek, "SELECT * FROM `task` WHERE `kepada` LIKE '%$nmpgw[nama]%' AND status = 'baru' and tgl_input LIKE '%$today%'"); //var_dump($jtugas);
	$jtugs = mysqli_num_rows($jtugas); //var_dump($jtugs);
	$btugas = mysqli_query($konek, "SELECT * FROM `task` WHERE status != 'selesai' AND kepada LIKE '%$nmpgw[nama]%'"); //var_dump($jtugas);
	$btugs = mysqli_num_rows($btugas);
	$ceklevel = mysqli_query($konek, "SELECT * FROM users WHERE username = '$_SESSION[namauser]'");
	$level = mysqli_fetch_array($ceklevel);
	if ($_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] =='superadmin'){   
?>

            <!-- <h3 class="page-header">Data Report Hari Ini</h3> -->
				<div class="row">
					<div class="col-sm-3 col-xs-12">
						<div class="small-box bg-green">
							<div class="inner">
								<h3><?php echo $jml; ?></h3>
								<p>Karyawan Sudah Report</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<a href="<?php echo $base_url.$mod; ?>-sdh.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
	
					<div class="col-sm-3 col-xs-12">
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><?php echo $blm; ?></h3>
								<p>Karyawan Belum Report</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a href="<?php echo $base_url.$mod; ?>-blm.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-sm-3 col-xs-12">
						<div class="small-box bg-red">
							<div class="inner">
								<h3><?php echo $btugs; ?></h3>
								<p>Tugas Belum Selesai</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a href="<?php echo $base_url.$mod; ?>-tugasyet.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-sm-3 col-xs-12">
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $jtugs; ?></h3>
								<p>Tugas Masuk Hari ini</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a href="<?php echo $base_url.$mod; ?>-tugasin.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
	
				</div>
	
				<h3 class="page-header">Report Terbaru</h3>
	
				<div class="row border">
	
				<?php
					
					$sql = "SELECT * FROM pekerjaan WHERE karyawan NOT IN (SELECT nama_lengkap from users where level = 'admin') AND tgl LIKE '%$today%' 
					order by id desc limit 4";
					
					//var_dump($sql);
					$exec = mysqli_query($konek,$sql);
					$adakah = mysqli_num_rows($exec); //var_dump($adakah);
					if ($adakah > 0)
					{
						while ($row = mysqli_fetch_array($exec)){
						  $pegawai = mysqli_query($konek, "SELECT a.nama, a.id, b.nama_jabatan
						  FROM pegawai a, jabatan b
						  WHERE a.jabatan = b.id AND a.id = '$row[karyawan]'");
						  $r = mysqli_fetch_array($pegawai);
		
						  $jabatan = mysqli_query($konek, "SELECT nama_jabatan 
						  FROM jabatan
						  WHERE id = $r[jabatan]");
						  $rj = mysqli_fetch_array($jabatan);
						  echo "
		
						  <div class='col-md-3 d-flex align-items-arround'>
							<div class='box box-solid'>
								<div class='box-header with-border'>
									<i class='fa fa-edit'></i>
									<h3 class='box-title fw-bold'>$r[nama] ( <bold>$r[nama_jabatan]</bold> )</h3>
								</div>
								<div class='box-body'>
									$row[pekerjaan]
								</div>
							</div>
						</div>
						";
					}
					}else{
						echo "			
							<div class='col-md-12'>
								<div class='box box-solid'>
									<div class='box-header with-border'>
										<i class='fa fa-edit'></i>
										<h3 class='box-title'>Belum ada data</h3>
									</div>
									<div class='box-body' style='height: 300px;'>
										<h2 class='text-center' vertical-align='center;'>Belum ada data report</h2>
									</div>
								</div>
							</div>
							";
					}
				?>
				</div>           
				
				<h3 class="page-header">Data Report Lainya</h3>
				<div class="row border">
					<div class="col-md-12">
						<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Tanggal</h3>
							</div>
							<div class="box-body">
	
								<table>
									<tr>
							<?php
								$jmltgl = mysqli_query($konek, "SELECT DISTINCT tgl FROM pekerjaan order by tgl desc limit 16");
								while($tgl = mysqli_fetch_array($jmltgl))
								{ 
									$tanggal = date("d-m-Y", strtotime($tgl['tgl']));?>
									
											<td style="padding-right: .5em;">
												<form action="<?php echo $base_url; ?>report-today" method="post">
													<input type="hidden" name="reqtgl" value="<?php echo $tgl['tgl'];?>">
													<button type="submit" class="btn btn-info"><?php echo $tanggal; ?></button>
												</form>
											</td>
											
							<?php }?>
											
									</tr>
								</table>
							</div>
						</div>
						</div>
					</div>
				</div>
<?php } else{?>
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<div class="small-box bg-green">
				<div class="inner">
						<h3><?php echo $btugs; ?></h3>
					<p>Tugas Belum Selesai</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="<?php echo $base_url.$mod; ?>-tugasyet.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	
		<div class="col-sm-6 col-xs-12">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $jtugs; ?></h3>
					<p>Tugas Baru</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="<?php echo $base_url.$mod; ?>-tugasin.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>

	<div class="row">

<?php
	$sql = "SELECT * FROM pekerjaan WHERE karyawan = $nmpgw[id] order by tanggal desc limit 9";
	//var_dump($sql);
	$exec = mysqli_query($konek,$sql);
	$adakah = mysqli_num_rows($exec); //var_dump($adakah);
	if ($adakah > 0)
	{
		while ($row = mysqli_fetch_array($exec)){
		  $pegawai = mysqli_query($konek, "SELECT a.nama, a.id, b.nama_jabatan
		  FROM pegawai a, jabatan b
		  WHERE a.jabatan = b.id AND a.id = '$row[karyawan]'");
		  $r = mysqli_fetch_array($pegawai);
		//   var_dump($r);

		  $jabatan = mysqli_query($konek, "SELECT nama_jabatan 
		  FROM jabatan
		  WHERE id = $r[jabatan]");
		  $rj = mysqli_fetch_array($jabatan);
		//   var_dump($rj);
		//   var_dump($row['pekerjaan']);
		  echo "

		  <div class='col-md-3 d-flex align-items-arround'>
			<div class='box box-solid'>
				<div class='box-header with-border'>
					<i class='fa fa-edit'></i>
					<h3 class='box-title'>$r[nama] ( $r[nama_jabatan] )</h3>
					<span class='pull-right badge bg-green'> " . date('l, d-m-Y',strtotime($row['tgl'])) . "</span>
				</div>
				<div class='box-body'>
					$row[pekerjaan]
				</div>
			</div>
		</div>
		";
	}
	}else{
		$link = "kinerja-tambah.html";
		echo "

			  <div class='col-md-12'>
				<div class='box box-solid'>
					<div class='box-header with-border' style='padding: 4;'>
						<i class='fa fa-edit'></i>
						<h3 class='box-title'>Belum ada data</h3>
						<div class='box-tools pull-right'>
							<a href='$base_url$link' type='button' class='btn btn-warning btn-sm'><font style='vertical-align: middle;'>tambah report</font></a>
						</div>

					</div>
					<div class='box-body' style='height: 300px; vertical-align: middle;'>
						<h2 class='text-center' style='vertical-align: middle;'>Belum ada data report</h2>
					</div>
				</div>
			</div>
			";
	}
?>
</div>

            
<?php }?>
              
<?php
	break;
	case "sdh";
?>
<div class="box">
				<section class="content-header">
					<h1>Karyawan yang telah melakukan Report Hari Ini (<?php echo date("d/m/Y"); ?>)</h1>
				</section>
				<hr>
				<div class="box-body">
					<table id="datatemplates" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Karyawan</th>
								<th>Jabatan</th>
								<th>Waktu Report</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$today = date('Y-m-d');
							$dkaryawan = mysqli_query($konek, "SELECT * FROM pekerjaan WHERE tgl = '$today'");
							$no=1;
							while($rslt = mysqli_fetch_array($dkaryawan))
							{
								$nama = mysqli_query($konek, "SELECT * FROM pegawai WHERE id = $rslt[karyawan]");
								$rsltn = mysqli_fetch_array($nama);
								$jabatan = mysqli_query($konek, "select * from jabatan where id = $rsltn[jabatan]");
								$rsltj = mysqli_fetch_array($jabatan); 
								?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $rsltn['nama']; ?></td>
							<td><?php echo $rsltj['nama_jabatan']; ?></td>
							<td><?php echo $rslt['tanggal']; ?></td>
						</tr>
						<?php $no++; } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		<?php
		break;
		
	case "blm":
			$query = "SELECT * FROM pegawai WHERE id='$_GET[id]'";
			$hasil = mysqli_query($konek, $query);
			$res     = mysqli_fetch_array($hasil);
?>
		<div class="box">
				<section class="content-header">
					<h1>Karyawan yang belum melakukan Report Hari Ini (<?php echo date("d/m/Y"); ?>)</h1>
				</section>
				<hr>
				<div class="box-body">
					<table id="datatemplates" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Karyawan</th>
								<th>Jabatan</th>
							</tr>
						</thead>
						<tbody>
						<?php
									$today = date('Y-m-d');
									$dkrbl = mysqli_query($konek, "SELECT *
									FROM pegawai
									WHERE id NOT IN (SELECT DISTINCT karyawan FROM pekerjaan WHERE tgl = '$today')");
									$no=1;
									while($rslt = mysqli_fetch_array($dkrbl))
									{
										$nama = mysqli_query($konek, "SELECT * FROM pegawai WHERE id = $rslt[nama_lengkap]");
										$rsltn = mysqli_fetch_array($nama);
										$jabatan = mysqli_query($konek, "select * from jabatan where id = $rslt[jabatan]");
										$rsltj = mysqli_fetch_array($jabatan); 
										?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $rslt['nama']; ?></td>
							<td><?php echo $rsltj['nama_jabatan']; ?></td>
						</tr>
						<?php $no++; } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
			
	<?php
		break;
		case"tugasin" :
			$today = date("Y-m-d"); //var_dump($today);
	?>
	<div class="box box-warning">
		<section class="content-header with-border">
			<h1>Tugas masuk hari ini</h1>
		</section>
		<br>
		<div class="box-body">
<?php $i = 1; 
	$jtugas = mysqli_query($konek, "SELECT * FROM `task` WHERE `kepada` LIKE '%$nmpgw[nama]%' AND status = 'baru' and tgl_input LIKE '%$today%'"); //var_dump($jtugas);
	if (mysqli_num_rows($jtugas) != 0){

	while($rr = mysqli_fetch_array($jtugas)) { ?>
			<div class="col-md-6">
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<i class="fa  fa-check-square-o"></i> 
						<h3 class="box-title"><?php echo $rr['judul']; ?></h3>
					</div>

					<div class="box-body">
						<dl>
						<dt style="margin-bottom: .5em;">Pembuat</dt>
						<dd><?php echo $rr['pembuat']; ?></dd>
						<dt style="margin-bottom: .5em; margin-top: .5em;">Deadline</dt>
						<dd><?php echo date("d / m / Y", strtotime($rr['deadline'])); ?></dd>
						<dt style="margin-bottom: .5em; margin-top: .5em;">Detail Tugas</dt>
						<dd><?php echo $rr['keterangan']; ?></dd>
						</dl>
					</div>
				</div>
			</div>
			<?php $i++; } 
	}else{
		echo "<h3 class ='text-center' style='padding:3em;'>Tidak ada tugas </h3>";
	} ?>
		</div>
	</div>
	<?php
	break;
	case"tugasyet":
		$yet = "const";
	?>
			<div class="box box-warning">
		<section class="content-header with-border">
			<h1>Tugas belum selesai</h1>
		</section>
		<br>
		<div class="box-body">
<?php $i = 1; 
	$btgs = mysqli_query($konek, "SELECT * FROM `task` WHERE `kepada` LIKE '%$nmpgw[nama]%' and status != 'selesai'"); //var_dump($btgs);
	if(mysqli_num_rows($btgs) != 0){

	while($rr = mysqli_fetch_array($btgs)) { ?>
			<div class="col-md-6">
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<i class="fa  fa-check-square-o"></i>
						<h3 class="box-title"><?php echo $rr['judul']; ?></h3>
					</div>

					<div class="box-body">
						<dl>
						<dt style="margin-bottom: .5em;">Pembuat</dt>
						<dd><?php echo $rr['pembuat']; ?></dd>
						<dt style="margin-bottom: .5em; margin-top: .5em;">Deadline</dt>
						<dd><?php echo date("d / m / Y", strtotime($rr['deadline'])); ?></dd>
						<dt style="margin-bottom: .5em; margin-top: .5em;">Detail Tugas</dt>
						<dd><?php echo $rr['keterangan']; ?></dd>
						</dl>
					</div>
				</div>
			</div>
			<?php $i++; } 
	}else{ 
		echo "<h3 class ='text-center' style='padding:3em;'>Tidak ada tugas </h3>";
		 } ?>
		</div>
	</div>
	<?php 
	}
	?>


            </div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.section -->
<?php
}
?>


