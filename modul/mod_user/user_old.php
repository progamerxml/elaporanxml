<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	include "../../config/fungsi_cryptologi.php";
  	$aksi = "modul/mod_user/aksi_user.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
  $mod=$_GET['module'];
?>
	<section class="content-header">
		<h1 class="page-header">
			<font style="vertical-align: inherit;">Data User</font>
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
		<h1>Manajemen Level User </h1>
		<ol class="breadcrumb">
            <li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambahlevel.html"><i class="fa fa-plus"></i>Tambah User Level</a></li>
        </ol>
	</section>
	<hr>
                <div class="box-body">
                  <table id="datatemplates" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                       <th width="1%">No</th>
						<th>Level</th>
                        <th width="3%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$queryu  = "	SELECT * From user_level ORDER BY id ASC";
					$tampilu = mysqli_query($konek, $queryu);
					$nou=1;
					while ($ru=mysqli_fetch_array($tampilu)){  
						echo  "<tr><td>$nou</td>
							<td>$ru[level]</td>				
                  			<td align=\"center\"><a href=\"".$base_url.$mod."-editlevel-$ru[id].html\" title=\"Edit Data\"><i class=\"fa fa-pencil\"></i></a> &nbsp; 
                			<a href=\"$aksi?module=userlevel&act=hapus&id=$ru[id]\" onclick=\"return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')\" title=\"Hapus Data\"><i class=\"fa fa-trash text-red\"></i></a> &nbsp; 
	                    	</td>
							</tr>";
						$nou++;
					}
					?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
			  <div class="box box-warning">
			  <section class="content-header">
		<h1>Manajemen User</h1>
		<ol class="breadcrumb">
            <li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambah.html"><i class="fa fa-plus"></i>Tambah User</a></li>
        </ol>
	</section>
	<hr>
                <div class="box-body">
                  <table id="datapolling" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                       <th>No</th>
                        <th>Username</th>
						<th>Password</th>
                        <th>Nama Lengkap</th>
						<th>Level</th>
						<th>Blokir</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$query  = "	SELECT a.username,a.password,a.blokir,a.id,a.level,b.nama,c.nama_jabatan
					FROM users a, pegawai b, jabatan c
					WHERE a.nama_lengkap=b.id AND b.jabatan=c.id
					ORDER BY a.id ASC";
					$tampil = mysqli_query($konek, $query);
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){  
						echo  "<tr><td>$no</td>
							<td>$r[username]</td>
                			<td>$r[password]</td>
							<td>$r[nama] </td>
							<td>$r[level]</td>
							<td>$r[blokir]</td>
					
                			
                  		
                  			<td align=\"center\"><a href=\"".$base_url.$mod."-edit-$r[id].html\" title=\"Edit Data\"><i class=\"fa fa-pencil\"></i></a> &nbsp; 
                			<a href=\"$aksi?module=user&act=hapus&id=$r[id]\" onclick=\"return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')\" title=\"Hapus Data\"><i class=\"fa fa-trash text-red\"></i></a> &nbsp; 
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
		case "tambahlevel":
?>
				<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Level User</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=userlevel&act=input" class="form-horizontal" onsubmit="return validasi_input(this)">
					<div class="box-body">
						<div class="form-group">

						<div class="form-group">
							<label for="username" class="col-sm-3 control-label">User Level</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="userlevel" name="userlevel" />
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Tambah</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
				</form>
				</div>
            </div><!-- /.box -->
<?php
		break;
		case "editlevel":
		$synul = "Select * FROM user_level where id = $_GET[id]"; $exul = mysqli_query($konek, $synul); $hul = mysqli_fetch_object($exul);
?>

<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Level User</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=userlevel&act=edit" class="form-horizontal" onsubmit="return validasi_input(this)">
					<div class="box-body">
						<div class="form-group">

						<div class="form-group">
							<label for="username" class="col-sm-3 control-label">User Level</label>
							<div class="col-sm-6">
								<input type="hidden" name="id" id="id" value="<?php echo $hul->id; ?>">
								<input type="text" class="form-control" id="userlevel" name="userlevel" value="<?php echo $hul->level; ?>"/>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">edit</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
				</form>
				</div>
            </div><!-- /.box -->

<?php
		break;
		case "tambah":
    
			
?>
<?php 
	$err = $_GET['err']; echo $err;
	if (isset($_GET["err"])){
		echo "<div class='alert alert-primary' role='alert'> A simple primary alert—check it out! </div>";
	}
?>
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah User</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=user&act=input" class="form-horizontal" onsubmit="return validasi_input(this)">
					<div class="box-body">
					
						<div class="form-group">
							<label for="album" class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="nama" name="nama">
									<option value="0" selected>- Pilih Karyawan -</option>
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

						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Level</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="level" name="level">
									<option value="0" selected>- Pilih Level -</option>
									<option value="admin" >Admin</option>
									<option value="karyawan" >Karyawan</option>

									<!-- <?php
									$query  = "SELECT * FROM pegawai";
									$tampil = mysqli_query($konek, $query);
									while($r=mysqli_fetch_array($tampil)){
										$nilai = $r['nip'] ? $r['nip'] : $r['nama'];
										echo "<option value=\"$nilai\">$r[nip] - $r[nama]</option>";
									}
									?> -->
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="col-sm-3 control-label">Username</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="username" name="username" />
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="password" name="password" />
							</div>
						</div>
						
						
						<!-- <div class="form-group">
							<label for="password" class="col-sm-3 control-label">No. Telepon</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="no_telp" name="no_telp" />
							</div>
						</div> -->

					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Simpan</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
				</form>
				</div>
            </div><!-- /.box -->
<?php
		break;
		
case "edit":
			$query2 = "SELECT a.id, a.level, a.username, a.password, a.nama_lengkap, a.blokir, b.nama 
			FROM users a, pegawai b
			WHERE a.nama_lengkap = b.id AND a.id = $_GET[id]";
			// $query = "SELECT * FROM users WHERE id='$_GET[id]'";
			$hasil = mysqli_query($konek, $query2);
			$res     = mysqli_fetch_array($hasil);
			$data = $res['password'];
			// Store the cipher method
			$ciphering = "AES-128-CTR";
			
			// Use OpenSSl Encryption method
			$iv_length = openssl_cipher_iv_length($ciphering);
			$options = 0;
					
			// Non-NULL Initialization Vector for decryption
			$decryption_iv = '1234567891011121';
					
			// Store the decryption key
			$decryption_key = "GeeksforGeeks";
					
			// Use openssl_decrypt() function to decrypt the data
			$decryptpasword = openssl_decrypt($data, $ciphering, $decryption_key, $options, $decryption_iv);
			// $pswrd = decrypt($res['password']); var_dump($res['password']);
?>
			<script>
				function lihat(){
					document.getElementById('password').type = 'text';
				}
				function tutup(){
					document.getElementById('password').type = 'password';
				}
			</script>
			<div class="box">
                <div class="box-header with-border">
                  	<h3 class="box-title">Edit User</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=user&act=update" class="form-horizontal">
					<input type="hidden" name="id" value="<?php echo $res['id']; ?>">
				<div class="box-body">
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Nama</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $res['nama']; ?>" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Username </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="username" name="username" value="<?php echo $res['username']; ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label for="album" class="col-sm-2 control-label">Level</label>
						<div class="col-sm-6">
							<select class="form-control select2" id="level" name="level">
<?php 
	$cek = mysqli_query($konek, "SELECT * FROM user_level"); while($hslcek = mysqli_fetch_array($cek)){
?>
								<option value="<?php echo $hslcek['level']; ?>" <?php if($res['level'] == $hslcek['level']){ echo 'selected'; } ?>><?php echo $hslcek['level']; ?></option>
								<!-- <option value="admin" >Admin</option>
								<option value="karyawan" >Karyawan</option> -->
<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Password </label>
						<div class="col-sm-6">
							<input type="password" class="form-control" id="password" name="password" value="<?php echo $decryptpasword; ?>"/> <button class="btn btn-xs btn-danger" onmouseover="lihat()" onmouseout="tutup()">lihat</button>
						</div>
						
					</div>
					<div class="form-group">
						<label for="pembuat" class="col-sm-2 control-label">Blokir </label>
						<div class="col-sm-6">
							<select class="form-control select2" id="blokir" name="blokir">
<?php $blok = mysqli_query($konek, "SELECT DISTINCT (blokir) FROM users"); while($dblok = mysqli_fetch_array($blok)) {?>
								<option value="<?php echo $dblok['blokir']; ?>" <?php if ($res['blokir'] == $dblok['blokir']){ echo 'selected';} ?>><?php echo $dblok['blokir']; ?></option>
<?php } ?>

<?php if ($dblok['blokir'] = 'N') { ?>
									<option value="Y" >Y</option>
<?php } ?>
							</select>
						</div>
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-primary btn-sm">Update</button> <button class="btn btn-sm" type="button" onclick="self.history.back()" class="btn">Batal</button>
					</div><!-- /.box-footer -->
					</div>
					</form>
				</div><!-- /.box-body -->
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