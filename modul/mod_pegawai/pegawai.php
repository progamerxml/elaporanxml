<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_pegawai/aksi_pegawai.php";
  require_once __DIR__ . "/aksi_pegawai.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
  $mod=$_GET['module'];
?>
<section class="content-header">
	<h1 class="page-header">
		<font style="vertical-align: inherit;">Data Pegawai</font>
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
		<li class="active"><font style="vertical-align: inherit;">Manajemen Data</font></li>
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

			<div class="box box-warning">
				<section class="content-header">
					<h1>Manajemen Data Pegawai</h1>
					<ol class="breadcrumb">
						<li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambah.html"><i
									class="fa fa-plus"></i>Tambah Pegawai</a></li>
					</ol>
					<!-- debuging -->
				</section>
				<hr>
				<div class="box-body">
					<table id="datatemplates" class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>No Absen</th>
								<th>Nama Karyawan</th>
								<th>Jabatan</th>
								<th>Alamat</th>
								<th>Tanggal Masuk</th>
								<th>Tanggal Kontrak</th>
								<th>Report</th>
								<th>BPJS Kes</th>
								<th>BPJS Ket</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>

						<!-- <?php $no = 1; foreach(getAllKaryawan() as $karyawan) { $report = ($karyawan['report'] == 1) ? "iya" : "tidak"; ?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $karyawan['nama'] ?></td>
								<td><?= $karyawan['jabatan'] ?></td>
								<td><?= $karyawan['alamat'] ?></td>
								<td><?= $karyawan['tgl_masuk'] ?></td>
								<td><?= $karyawan['tgl_kontrak'] ?></td>
								<td><?= $report ?></td>
								<td><?= $karyawan['bpjs_kes'] ?></td>
								<td><?= $karyawan['bpjs_ket'] ?></td>
								<td align="center">
									<a href="<?= $base_url.$mod . '-edit-' . $karyawan['id'] ?>.html" title="Edit Data"><i class="fa fa-pencil"></i></a> &nbsp; 
									<a href="<?= $aksi . '?module=pegawai&act=hapus&id=' .$karyawan['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data"><i class="fa fa-trash text-red"></i></a> &nbsp; 
								</td>
							<tr>
							<?php $no++; } ?> -->
							
							<?php
					$query  = "	SELECT a.nama, a.no_absen, a.alamat, a.tgl_masuk, a.tgl_kontrak, a.report, a.bpjs_kes, a.bpjs_ket,  b.nama_jabatan as jabatan, a.id
								FROM pegawai a, jabatan b
								WHERE a.jabatan=b.id 
								order by a.no_absen DESC";
					$tampil = mysqli_query($konek, $query);
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){  
						if ($r['report'] == 1 ){$rport = "iya";}else{$rport = "tidak";}
						echo "<tr><td>$no</td>
                			<td>$r[no_absen]</td>
                			<td>$r[nama]</td>
							<td>$r[jabatan]</td>
							<td>$r[alamat]</td>
							<td>$r[tgl_masuk]</td>
							<td>$r[tgl_kontrak]</td>
							<td>$rport</td>
							<td>$r[bpjs_kes]</td>
							<td>$r[bpjs_ket]</td>
                  		
                  		
                  		
                  			<td align=\"center\"><a href=\"".$base_url.$mod."-edit-$r[id].html\" title=\"Edit Data\"><i class=\"fa fa-pencil\"></i></a> &nbsp; 
                			<a href=\"$aksi?module=pegawai&act=hapus&id=$r[id]\" onclick=\"return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')\" title=\"Hapus Data\"><i class=\"fa fa-trash text-red\"></i></a> &nbsp; 
	                    	</td>
							</tr>";
						$no++;
					}
					?>
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
					<h3 class="box-title">Tambah Pegawai</h3>
				</div><!-- /.box-header -->
				<form method="POST" action="<?php echo $aksi; ?>?module=pegawai&act=input" class="form-horizontal">
					<div class="box-body">
						<div class="form-group">
							<label for="no_absen" class="col-sm-2 control-label">No Absen</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" id="no_absen" name="no_absen" />
							</div>
						</div>
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="nama" name="nama" />
							</div>
						</div>
						<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Alamat</label>
							<!-- <div class="col-sm-6"> -->
							<div class="col-sm-6">
								<!-- <textarea name="alamat" id="isi_pegawai" cols="30" rows="10"></textarea> -->
								<input type="text" class="form-control" id="alamat" name="alamat" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="album" class="col-sm-2 control-label">Jabatan</label>
						<div class="col-sm-6">
							<select class="form-control select2" id="nama_jabatan" name="nama_jabatan">
								<option value="0" selected>- Pilih Jabatan -</option>
								<?php
									$query  = "SELECT * FROM jabatan ORDER BY id asc";
									$tampil = mysqli_query($konek, $query);
									while($r=mysqli_fetch_array($tampil)){
										
										echo "<option value=\"$r[id]\">$r[nama_jabatan]</option>";
									}
									?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Tanggal Masuk</label>
						<div class="col-sm-6">
							<input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" />
						</div>
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Tanggal Kontrak</label>
						<div class="col-sm-6">
							<input type="date" class="form-control" id="tgl_kontrak" name="tgl_kontrak" />
						</div>
					</div>
					<div class="form-group">
						<label for="album" class="col-sm-2 control-label">Wajib Report</label>
						<div class="col-sm-6">
							<select class="form-control select2" id="report" name="report">
								<option selected>- Pilih -</option>
								<option value="1"> Iya </option>
								<option value="0"> Tidak </option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="album" class="col-sm-2 control-label">BPJS Kesehatan</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="bpjs_kes" name="bpjs_kes" />
						</div>
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">BPJS Ketenagakerjaan</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="bpjs_ket" name="bpjs_ket" />
						</div>
					</div>


			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Simpan</button> <button type="button"
					onclick="self.history.back()" class="btn">Batal</button>
			</div><!-- /.box-footer -->
			</form>
		</div><!-- /.box -->
		<?php
		break;
		
	case "edit":
			$query = "SELECT * FROM pegawai WHERE id='$_GET[id]'";
			$hasil = mysqli_query($konek, $query);
			$res     = mysqli_fetch_array($hasil);
?>
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Pegawai</h3>
			</div><!-- /.box-header -->
			<form method="POST" action="<?php echo $aksi; ?>?module=pegawai&act=update" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $res['id']; ?>">
				<div class="box-body">
					<div class="form-group">
						<label for="no_absen" class="col-sm-2 control-label">No Absen</label>
						<div class="col-sm-6">
							<input type="number" class="form-control" id="no_absen" name="no_absen" value="<?php echo $res['no_absen']; ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="nama" name="nama"
								value="<?php echo $res['nama']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label for="album" class="col-sm-2 control-label">Alamat</label>
						<!-- <div class="col-sm-6"> -->
						<div class="col-sm-6">
							<!-- <textarea name="alamat" id="isi_pegawai" cols="30" rows="10">
									<?php echo $res['alamat']; ?>
								</textarea> -->
							<input type="text" class="form-control" id="alamat" name="alamat"
								value="<?php echo $res['alamat']; ?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="album" class="col-sm-2 control-label">Jabatan</label>
					<div class="col-sm-6">
						<select class="form-control select2" id="nama_jabatan" name="nama_jabatan">
							<option value="0" selected>- Pilih Jabatan -</option>
							<?php
										$query  = "SELECT * FROM jabatan ORDER BY id asc";
										$tampil = mysqli_query($konek, $query);
										while($r=mysqli_fetch_array($tampil)){
											if($res['jabatan'] == $r['id']){
												echo "<option value=\"$r[id]\" selected>$r[nama_jabatan]</option>";
											}else{
												echo "<option value=\"$r[id]\">$r[nama_jabatan]</option>";
											}
										}
									?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="album" class="col-sm-2 control-label">Wajib Report</label>
					<div class="col-sm-6">
						<select class="form-control select2" id="report" name="report">
							<option value="1"> Iya </option>
							<option value="0"> Tidak </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="pembuat" class="col-sm-2 control-label">Tanggal Masuk</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk"
							value="<?php echo $res['tgl_masuk']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="pembuat" class="col-sm-2 control-label">Tanggal Kontrak</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="tgl_kontrak" name="tgl_kontrak"
							value="<?php echo $res['tgl_kontrak']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="album" class="col-sm-2 control-label">BPJS Kesehatan</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="bpjs_kes" name="bpjs_kes"
							value="<?php echo $res['bpjs_kes']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="pembuat" class="col-sm-2 control-label">BPJS Ketenagakerjaan</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="bpjs_ket" name="bpjs_ket"
							value="<?php echo $res['bpjs_ket']; ?>" />
					</div>
				</div>
		</div><!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Update</button> <button type="button"
				onclick="self.history.back()" class="btn">Batal</button>
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