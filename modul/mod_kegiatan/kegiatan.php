<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_kegiatan/aksi_kegiatan.php";
  $mod=$_GET['module'];

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
?>
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
<?php
	switch($act){
		// Tampil Templates
		default:
?>
              
			  <div class="box">
			  <section class="content-header">
		<h1>MASTER Kegiatan</h1>
		<ol class="breadcrumb">
            <li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambah.html"><i class="fa fa-plus"></i>Tambah Kegiatan</a></li>
        </ol>
	</section>
	<hr>
                <div class="box-body">
                  <table id="datatemplates" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>NO</th>
			            <th>URAIAN KEGIATAN</th>
                        <th>SATUAN</th>                    
                        <th>TARGET</th>
                        <th>PEGAWAI</th>
			  <th>AKSI</th>

                      </tr>
                    </thead>
                    <tbody>
					<?php
					$query  = "SELECT a.uraian,a.satuan,a.target,b.nama,a.id
FROM `kegiatan` a,`pegawai` b
WHERE a.id_pegawai=b.id";
					$tampil = mysqli_query($konek, $query);
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){  
						echo "<tr><td>$no</td>
						    <td>$r[uraian]</td>
							<td>$r[satuan]</td>
                			<td>$r[target]</td>
							<td>$r[nama]</td>
                  		
                  			<td align=\"center\"><a href=\"".$base_url.$mod."-edit-$r[id].html\" title=\"Edit Data\"><i class=\"fa fa-pencil\"></i></a> &nbsp; 
                			<a href=\"$aksi?module=kegiatan&act=hapus&id=$r[id]\" onclick=\"return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')\" title=\"Hapus Data\"><i class=\"fa fa-trash text-red\"></i></a> &nbsp; 
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
                  <h3 class="box-title">Tambah Kegiatan</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=kegiatan&act=input" class="form-horizontal">
					<div class="box-body">
					   						
						<div class="form-group">
							<label for="nama_templates" class="col-sm-2 control-label">Uraian Kegiatan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="uraian" name="uraian" />
							</div>
						</div>
						
						<div class="form-group">
							<label for="nama_templates" class="col-sm-2 control-label">Satuan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="satuan" name="satuan" />
							</div>
						</div>
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Target</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="target" name="target" />
							</div>
						</div>
						<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Nama Pegawai</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="nama" name="nama">
									<option value="0" selected>- Pilih Pegawai -</option>
									<?php
									$query  = "SELECT * FROM pegawai";
									$tampil = mysqli_query($konek, $query);
									while($r=mysqli_fetch_array($tampil)){
										
										echo "<option value=\"$r[id]\">$r[nip] - $r[nama]</option>";
									}
									?>
								</select>
							</div>
						</div>
					
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Simpan</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
				</form>
              </div><!-- /.box -->
<?php
		break;
		
		case "edit":
			$query = "SELECT * FROM kegiatan WHERE id='$_GET[id]'";
			$hasil = mysqli_query($konek, $query);
			$r     = mysqli_fetch_array($hasil);
?>
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Templates</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=kegiatan&act=update" class="form-horizontal">
					<input type="hidden" name="id" value="<?php echo $r['id']; ?>">
					<div class="box-body">
					    
<div class="form-group">
							<label for="nama_templates" class="col-sm-2 control-label">Uraian Kegiatan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="uraian" name="uraian" value="<?php echo $r[uraian];?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label for="nama_templates" class="col-sm-2 control-label">Satuan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $r[satuan];?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Target</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="target" name="target" value="<?php echo $r[target];?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="album" class="col-sm-2 control-label">Nama Pegawai</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="nama" name="nama">
									<?php
									$query  = "SELECT * FROM pegawai";
									$tampil = mysqli_query($konek, $query);
									while($res=mysqli_fetch_array($tampil)){
										if($res[id]==$r[id_pegawai]){
										echo "<option value=\"$res[id]\" selected >$res[nip] - $res[nama]</option>";
										}else{
										echo "<option value=\"$res[id]\">$res[nip] - $res[nama]</option>";
										}

									}
									?>
								</select>
							</div>
						</div>





					</div><!-- /.box-body -->
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