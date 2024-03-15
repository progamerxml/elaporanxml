<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_kinerja/rekap_report.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
  $mod=$_GET['module']; //var_dump($mod);
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

	$tgl_req = $_POST['tgl_req'] ? $_POST['tgl_req'] : date("Y-m-d", strtotime("yesterday")); //var_dump($tgl_req);

	$today = date('Y-m-d');
    $jmlpg = mysqli_query($konek, "SELECT * FROM pegawai where report = 1");
    $jmlpgw = mysqli_num_rows($jmlpg);
    // echo $jmlpgw;
    $count = mysqli_query($konek, "SELECT DISTINCT karyawan FROM pekerjaan where tgl = '$tgl_req'"); //var_dump($nmpgw['nama']);
    $jml = mysqli_num_rows($count);
    // echo $jml;
    $blm = $jmlpgw - $jml;
	
?>
	<!-- form input tanggal -->
				<div class="row ">
					<div class="col-sm-4">
						<form action="" method="post">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" name="tgl_req" id="tgl_req" class="form-control" value="<?php echo $tgl_req; ?>">
								<span class="input-group-btn"><button type="submit" class="btn btn-warning btn-flat">tampilkan</button></span>
							</div>
							<!-- <input type="date" name="tgl_req" id="tgl_req">
							<button type="submit">tampilkan</button> -->
						</form>
					</div>
				</div>
				<br>
            <!-- <h3 class="page-header">Data Report Hari Ini</h3> -->
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="small-box bg-green">
							<div class="inner">
								<h3><?php echo $jml; ?></h3>
								<p>Karyawan Sudah Report</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<!-- <a href="<?php //echo $base_url.$mod; ?>-sdh.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
	
					<div class="col-sm-6 col-xs-12">
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><?php echo $blm; ?></h3>
								<p>Karyawan Belum Report</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<!-- <a href="<?php //echo $base_url.$mod; ?>-blm.html" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
				</div>
				<div class="row border">
					<div class="col-sm-6">
							<div class="box box-success">
							<section class="content-header">
								<h1>Karyawan yang telah melakukan Report tanggal : <?php echo date("d - m - Y", strtotime($tgl_req)); ?></h1>
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
										$dkaryawan = mysqli_query($konek, "SELECT * FROM pekerjaan WHERE tgl = '$tgl_req'");
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
					</div>
					<div class="col-sm-6">
					<?php
						$query = "SELECT * FROM pegawai WHERE id='$_GET[id]'";
						$hasil = mysqli_query($konek, $query);
						$res     = mysqli_fetch_array($hasil);
					?>
						<div class="box box-warning">
							<section class="content-header">
								<h1>Karyawan yang belum melakukan Report tanggal : <?php echo date("d - m - Y", strtotime($tgl_req)); ?></h1>
							</section>
							<hr>
							<div class="box-body">
								<table id="datavideo" class="table table-hover">
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
												WHERE id NOT IN (SELECT DISTINCT karyawan FROM pekerjaan WHERE tgl = '$tgl_req') and report = 1") ;
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
					</div>
				</div>
			
	<?php 
	}
	?>


            </div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.section -->



