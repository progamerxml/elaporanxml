<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_report/aksi_report.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
  $mod=isset ($_GET['module']) ? $_GET['module'] : '';
  $tgl=isset ($_GET['tgl']); 
  $tgl_report = date("Y-m-d	",strtotime($_POST['reqtgl']));
}
?>
<section class="content-header">
		<h1 class="page-header">
			<font style="vertical-align: inherit;">Data Report Kerja</font>
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
			<li class="active"><font style="vertical-align: inherit;">Manajemen Kerja</font></li>
			<li class="active"><font style="vertical-align: inherit;">report <?php echo date("d-m-Y",strtotime($_POST['reqtgl'])); ?> </font></li>
		</ol>
	</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<section class="box-header">
					<h2 class="box-title">Data Report tanggal <?php echo date("d-m-Y",strtotime($_POST['reqtgl'])); ?></h2>
				</section>
				<div class="box-body">
					<table id="datatemplates" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
						<thead>
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
									NO
								</th>
								<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
									Nama
								</th>
								<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
									Jabatan
								</th>
								<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
									Detail Kerja
								</th>
								<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
									Detail Waktu
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$report = mysqli_query($konek, "SELECT * FROM pekerjaan WHERE tanggal LIKE '%$_POST[reqtgl]%'");
							$no = 1;
							while ($rslt = mysqli_fetch_array($report))
						{ 
							$pgwi = mysqli_query($konek, "SELECT a.nama, b.nama_jabatan FROM pegawai a, jabatan b WHERE a.jabatan = b.id and a.id = $rslt[karyawan]");
							$hsl = mysqli_fetch_array($pgwi);
							?>
							<tr>
								<td style="vertical-align:middle; "><?php echo $no; ?></td>
								<td style="vertical-align:middle; "><?php echo $hsl['nama']; ?></td>
								<td style="vertical-align:middle; "><?php echo $hsl['nama_jabatan']; ?></td>
								<td style="vertical-align:middle; "><?php echo $rslt['pekerjaan']; ?></td>
								<td style="vertical-align:middle; "><?php echo date("d-m-Y H:i:s",strtotime($rslt['tanggal'])); ?></td>
							</tr>
									
						<?php $no++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>