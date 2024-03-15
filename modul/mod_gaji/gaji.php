<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_gaji/aksi_gaji.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
  $mod=$_GET['module'];
  $user = $_SESSION['namauser'];
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

	<div class="box box-warning">
			  <section class="content-header border border-danger">
		<h1>Manajemen Data Gaji</h1>
		<ol class="breadcrumb">
            <li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambah.html"><i class="fa fa-plus"></i>Tambah Data Gaji</a></li>
        </ol>
	</section>
	<hr>
                <div class="box-body">
                  <table id="datatemplates" class="table table-hover">
                    <thead>
					<tr>
                        <th>No</th>
						<th>Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus</th>
						<th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
                    
                    $query  = "SELECT a.id, a.gapok, a.bonus, c.nama_jabatan
                     FROM gaji a, jabatan c
                     WHERE a.jabatan = c.id ORDER BY a.gapok DESC";

					$tampil = mysqli_query($konek, $query);
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){  
						echo "<tr><td>$no</td>
						<td>$r[nama_jabatan]</td>
						<td>".number_format($r['gapok'])."</td>
                        <td>".number_format($r['bonus'])."</td>
                  		<td align=\"center\"><a href=\"".$base_url.$mod."-edit-$r[id].html\" title=\"Edit Data\"><i class=\"fa fa-pencil\"></i></a> &nbsp; 
                			<a href=\"$aksi?module=gaji&act=hapus&id=$r[id]\" onclick=\"return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')\" title=\"Hapus Data\"><i class=\"fa fa-trash text-red\"></i></a> &nbsp; 
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
                  <h3 class="box-title">Tambah Data Gaji</h3>
                  <?php echo $_SESSION['level']; ?>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=gaji&act=input" class="form-horizontal">
				
					<div class="box-body">
					
					        <?php
                            echo $_SESSION['level'];
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
						<div class="form-group">
							<label for="tanggal" class="col-sm-2 control-label">Jabatan</label>
							<div class="col-sm-6">
                                <select class="form-control select2" id="jabatan" name="jabatan">
									<option value="0" selected>- Jabatan -</option>
									<?php
									$query  = "SELECT * FROM jabatan";
									$tampil = mysqli_query($konek, $query);
									while($rj=mysqli_fetch_array($tampil)){
									
										echo "<option value=\"$rj[id]\">$rj[nama_jabatan]</option>";
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Gaji Pokok</label>
							<div class="col-sm-6">
                                    <input class="form-control" type="text" name="gapok" id="gapok">
							</div>
						</div>
                        
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Bonus</label>
							<div class="col-sm-6">
                                    <input class="form-control" type="text" name="bonus" id="bonus">
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
			$query = "SELECT * FROM gaji WHERE id='$_GET[id]'";
			$hasil = mysqli_query($konek, $query);
			$res     = mysqli_fetch_array($hasil);



?>
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Data Gaji</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=gaji&act=update" class="form-horizontal">
					<input type="hidden" name="id" value="<?php echo $res['id']; ?>">
					<div class="box-body">
					
						<div class="form-group">
							<label for="tanggal" class="col-sm-2 control-label">Jabatan</label>
							<div class="col-sm-6">
                                <select class="form-control select2" id="jabatan" name="jabatan">
									<?php
										$query  = "SELECT * FROM jabatan";
										$tampil = mysqli_query($konek, $query);
										while($rj=mysqli_fetch_array($tampil)){
											if($res['jabatan'] == $rj['id']){
												echo "<option value=\"$rj[id]\" selected>$rj[nama_jabatan]</option>";
											}else{
												echo "<option value=\"$rj[id]\">$rj[nama_jabatan]</option>";
											}
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Gaji Pokok</label>
							<div class="col-sm-6">
                                    <input class="form-control" type="text" name="gapok" id="gapok" value="<?php echo $res['gapok']; ?>">
							</div>
						</div>
                        
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Bonus</label>
							<div class="col-sm-6">
                                    <input class="form-control" type="text" name="bonus" id="bonus" value="<?php echo $res['bonus']; ?>">
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


