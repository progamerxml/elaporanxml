<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_kinerja/aksi_kinerja.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
  $mod=$_GET['module'];
  $user = mysqli_query($konek, "SELECT nama_lengkap FROM `users` WHERE `username` = '$_SESSION[namauser]'"); 
  $idnm = mysqli_fetch_array($user); $idpg = $idnm['nama_lengkap'];
  $tanggal = $_POST['tgl'];
  $fltrtgl = isset($_POST['tglfilter']) ? $_POST['tglfilter'] : ''; //var_dump($fltrtgl);
  $fltrtgl2 = isset($_POST['tglfilter2']) ? $_POST['tglfilter2'] : ''; //var_dump($fltrtgl2);
  $fltrnm = isset($_POST['namafilter']) ? $_POST['namafilter'] : ''; //var_dump($fltrnm);
  
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
			<li class="active"><font style="vertical-align: inherit;"><?php echo $mod; ?> </font></li>
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
	$tanggal = mysqli_query($konek, "SELECT DISTINCT(tgl) FROM pekerjaan order by tgl DESC");
	$skrg = date("d-m-Y"); 
?>
			  <div class="box box-warning">
			  	<!-- <section class="content-header">
				  	<ul class="nav nav-tabs">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
								<font style="vertical-align: inherit;" class="text-warning">Tanggal</font>
								<span class="caret text-warning"></span>
							</a>
							<ul class="dropdown-menu">
								<?php while($tgl = mysqli_fetch_array($tanggal)){ ?>
									<form action="" method="post">
										<input type="text" name="<?php echo date("d", strtotime($tgl['tgl']))?>" id="tglreq" value>
									</form>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><font style="vertical-align: inherit;">Tindakan </font></a></li>
								<?php }?>
							</ul>
						</li>
						<li>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
								<font style="vertical-align: inherit;" class="text-warning">Bulan</font>
								<span class="caret text-warning"></span>
							</a>
							<ul class="dropdown-menu">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><font style="vertical-align: inherit;">Tindakan </font></a></li>
							</ul>
						</li>
						<li>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
								<font style="vertical-align: inherit;" class="text-warning">Tahun</font>
								<span class="caret text-warning"></span>
							</a>
							<ul class="dropdown-menu">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#"><font style="vertical-align: inherit;">Tindakan </font></a></li>
							</ul>
						</li>
						<li class="pull-right">
							<button class="btn btn-warning btn-sm" type="submit">tampilkan</button>
						</li>
					</ul>
				</section> -->
				<section class="content-header">
					<h1 class="box-title with-border">Report Kerja</h1>
					<ul class="breadcrumb">
						<li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambah.html"><i class="fa fa-plus"></i>Tambah Report Kerja</a></li>
					</ul>
				</section>
				<br>
				<section class="content-header">
					<div class="row">
						<div class="col-md-12 with-border bg-warning">
							<form action="" method="post" id="myForm"  value="Reset form">
								<div class="box-header with-border">
									<h3 class="box-title"><font style="vertical-align: inherit;">Filter</font></h3>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-xs-3">
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calender">Tanggal awal</i>
												</div>
												<input type="date" name="tglfilter" id="datepicker" class="form-control pull-right" value="<?php echo $fltrtgl; ?>"><br>
											</div>
										</div>

										<div class="col-xs-3">
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calender">Tanggal akhir</i>
												</div>
												<input type="date" name="tglfilter2" id="datepicker2" class="form-control pull-right" value="<?php echo $fltrtgl2; ?>">
											</div>
										</div>
										
										<div class="col-xs-3">
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calender">Nama</i>
												</div>
												<input type="text" name="namafilter" id="datepicker" class="form-control pull-right" placeholder="Ketik Nama" value="<?php echo $fltrnm; ?>">
											</div>
										</div>
										<div class="col-xs-1">
											<button type="submit" class="btn btn-block btn-warning btn-sm">Tampil</button>
										</div>
										<div class="col-xs-1">
											<button type="button" onclick="window.location.href=window.location.href;" id="reset" class="btn btn-block btn-warning btn-sm">Reset</button>
										</div>
									</div>
								</div>
							</form>	
						</div>
					</div>
				</section>
				<br>
                <div class="box-body">

                	<table id="dataalbum" class="table table-hover">
						<thead>
							<tr>
								<th style="text-align: center;" width= "5%;">No</th>
								<th style="text-align: center;" width= "25%;">Nama Pegawai</th>
								<th style="text-align: center;" width= "10%">Tanggal</th>
								<th style="text-align: center;" width= "40%">Detail Pekerjaan</th>
								<th style="text-align: center;" width= "20%">Waktu Input</th>
								<!-- <th>Aksi</th> -->
							</tr>
						</thead>
						<tbody>
						<?php
							$filter = '';
							$filter2 = '';
							$filter3 = '';
							if(!empty($fltrtgl)){ $filter = " AND a.tgl = '$fltrtgl'"; } //var_dump($filter);
							if(!empty($fltrtgl2)){ $filter = " AND a.tgl = '$fltrtgl2'"; } //var_dump($filter);
							if(!empty($fltrtgl) && !empty($fltrtgl2)){ $filter = " AND a.tgl between '$fltrtgl' and '$fltrtgl2' "; } //var_dump($filter);
							if(!empty($fltrnm)){ $filter2 = " AND b.nama LIKE '%$fltrnm%'"; } //var_dump($filter2);
							if($_SESSION['leveluser']=="admin" || $_SESSION['leveluser']=="superadmin"){
							$query  = "SELECT a.id as idkrj, a.tgl, a.tanggal , a.pekerjaan, b.nama, b.id
							FROM pekerjaan a, pegawai b
							WHERE a.karyawan = b.id".$filter.$filter2."
							order by a.id DESC";
							}else{
							// mycode
							$query  = "SELECT a.id as idkrj, a.tgl, a.tanggal , a.pekerjaan, b.nama, b.id
							FROM pekerjaan a, pegawai b
							WHERE a.karyawan = b.id AND b.id = $idpg
							order by a.id DESC"; 
							}
							//var_dump($query);
							$tampil = mysqli_query($konek, $query);
							// $ceklog = mysqli_fetch_object($tampil); 
						
						$no=1;
						while ($r=mysqli_fetch_array($tampil)){  ?>
							<tr>
								<td style='vertical-align: top; text-align:center;'><?php echo $no;?></td>
								<td style='vertical-align: top; text-align:left;'><?php echo $r['nama'];?></td>
								<td style='vertical-align: top; text-align:center;'><?php echo date("d-m-Y",strtotime($r['tgl']));?></td>
								<td style='vertical-align: top; '><?php echo $r['pekerjaan'];?></td>
								<td style='vertical-align: top; text-align:center;'><?php echo date("d-m-Y H:i:s",strtotime($r['tanggal']))."<br><br>"; if ($r['id'] == $idpg){ ?>
								<span>
										<a href="<?php echo $base_url.$mod.'-edit-'.$r['idkrj'].'.html'; ?>" title="Edit Data"><button class="btn btn-warning btn-xs">edit</button></a>&nbsp;&nbsp;&nbsp;
										<a href="<?php echo $aksi.'?module=kinerja&act=hapus&id='.$r['idkrj']; ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data"><button class="btn btn-danger btn-xs">hapus</button></a>
									</span> 
								<?php } ?>
								</td>
							
						</tr>
								
						<?php $no++; } ?>
						</tbody>
                  	</table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->


<?php
		break;
		
		case "tambah":
?>
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Report Kerja</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=kinerja&act=input" class="form-horizontal">
				
					<div class="box-body">
					
					        <?php
							if($_SESSION['level']=="admin"){
							?>
					
							<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Nama Pegawai</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="nama" name="nama">
									<option value="0" selected>- Pilih Pegawai -</option>
									<?php
									$query  = "SELECT * FROM pegawai";
									$tampil = mysqli_query($konek, $query);
									while($r=mysqli_fetch_array($tampil)){
										
										echo "<option value=\"$r[id]\">$r[nama]</option>";
									}
									?>
								</select>
							</div>
						</div>
						<?php
							}
							else{
						?>
						<!-- <input type="text" name="nama" value="<?php echo $_SESSION['namauser'];?>" class=""/> -->
						<?php
							}
							?>
						
						<!-- codeku irfan-->
							<?php
							$namapg =mysqli_query($konek, "SELECT a.nama_lengkap, b.id, b.nama, b.jabatan
							FROM users a, pegawai b
							WHERE a.nama_lengkap = b.id AND a.username =  '$_SESSION[namauser]'");
							$rs = mysqli_fetch_array($namapg);

							?>
						<div class="form-group">
							<label for="tanggal" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-6">
								<input type="hidden" name="idk" id="idk" class="form-control" value="<?php echo $rs['id'];?>">
								<input type="hidden" class="form-control" name="jabatan" id="jabatan" value="<?php echo $rs['jabatan']; ?>">
								<input type="text" name="nama" id="nama" class="form-control" value="<?php echo $rs['nama'];?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="tanggal" class="col-sm-2 control-label">Tanggal</label>
							<div class="col-sm-6">
								<input type="date" name="tanggal_input" id="tanggal_input" class="form-control" required>
							</div>
						</div>
						
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Detail Pekerjaan</label>
							<div class="col-sm-6">
								<textarea name="isi_kinerja" id="isi_kinerja" cols="30" rows="10" class="form-control" required>

								</textarea>
							</div>
						</div>
				
						
						
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Simpan</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
				</form>
              </div><!-- /.box -->
<?php
		break;
		    
	case "edit":
			$query = "SELECT * FROM pekerjaan WHERE id='$_GET[id]'";
			$hasil = mysqli_query($konek, $query);
			$res     = mysqli_fetch_array($hasil);
			$id = $res['karyawan'];

?>
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Report Kerja</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=kinerja&act=update" class="form-horizontal">
					<input type="hidden" name="idkerja" value="<?php echo $_GET['id']; ?>">
					<div class="box-body">
					
						<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Nama Pegawai</label>
							<div class="col-sm-6">
									<?php
										$query  = "SELECT a.karyawan, b.nama, b.id as idk, b.jabatan
										FROM pekerjaan a, pegawai b 
										WHERE a.karyawan = b.id AND b.id = '$id' 
										ORDER BY a.karyawan";
										$tampil = mysqli_query($konek, $query);
										$r=mysqli_fetch_array($tampil);
									?>
								<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $r['idk']; ?>">
								<input type="hidden" class="form-control" name="jabatan" id="jabatan" value="<?php echo $r['jabatan']; ?>">
								<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $r['nama']; ?>" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Tanggal</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $res['tgl']; ?>">
							</div>
						</div>
							<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Detail Pekerjaan</label>
							<div class="col-sm-6">
								<textarea name="isi_kinerja" id="isi_kinerja" cols="30" rows="10" class="form-control">
									<?php echo $res['pekerjaan'];?>
								</textarea>
							</div>
						</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Update</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
				</form>
              </div><!-- /.box -->
<?php
		break;
	}
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

