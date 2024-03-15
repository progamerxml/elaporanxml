<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
    include "../../config/fungsi_cryptologi.php";
    $aksi = "modul/mod_profile/aksi_profile.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod=$_GET['module']; 
    $quser = "SELECT a.id, a.nama, a.alamat, a.kontak, a.email, a.tgl_masuk, a.tgl_kontrak, b.nama_jabatan, c.username, c.password, c.url_foto
    FROM pegawai a, jabatan b, users c
    WHERE a.jabatan = b.id AND a.id=c.nama_lengkap AND a.nama LIKE '%$nmpgw[nama]%'"; //var_dump($quser);
    $user = mysqli_fetch_array(mysqli_query($konek, $quser)); //var_dump($user['password']);

    $data = $user['password'];
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
        // var_dump($decryptpasword);
    // $encrypt = $user['password'];
    // $dpassword = decrypt($encrypt); var_dump($dpassword);
?>
<section class="content-header">
	<h1 class="page-header">
		<font style="vertical-align: inherit;">User Profile</font>
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
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<?php
	switch($act){
		// Tampil Templates
		default:
?>
<div class="box box-warning" style="padding: 1em 2.5em;">
    <div class="box-body box-profile">
			<a class="btn btn-warning btn-xs" href="<?php echo $base_url.$mod; ?>-edit.html"><i class="fa fa-pencil"></i>  edit profile</a>
            <?php //echo $user['url_foto']; ?>
        <img class="profile-user-img img-responsive img-circle" src="<?php echo $user['url_foto']; ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?php echo $user['nama']; ?></h3>
        <p class="text-muted text-center"><?php echo $user['nama_jabatan']; ?></p>
        <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
        <p class="text-muted"> <br><?php echo $user['alamat']; ?></p>
        <hr>
        <strong><i class="fa  fa-envelope margin-r-5"></i> Email</strong>
        <p class="text-muted"> <br>
        <?php echo $user['email']; ?>
        </p>
        <hr>
        <strong><i class="fa fa-phone margin-r-5"></i> Kontak</strong>
        <p class="text-muted"> <br>
        <?php echo $user['kontak']; ?>
        </p>
        <hr>
        <strong><i class="fa fa-user margin-r-5"></i> username</strong>
        <p class="text-muted"> <br>
        <?php echo $user['username']; ?>
        </p>
        <hr>
        
        <strong><i class="fa  fa-expeditedssl margin-r-5"></i> password</strong>
        <p class="text-muted"> <br>
        <?php echo $decryptpasword; ?>
        </p>
        <hr>
        <!-- <img src="../../Logo Bulat XML.png" download>lihat</img> -->
        <!-- <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
    </div>
</div>

<?php
break;
case "edit":
			$query = "SELECT * FROM pegawai WHERE id='$_GET[id]'"; //var_dump($user['id']);
			$hasil = mysqli_query($konek, $query);
			$res     = mysqli_fetch_array($hasil);
?>
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Update Data</h3>
        </div>


        <form action="<?php echo $aksi; ?>?module=user&act=upuser" method="post" enctype="multipart/form-data">
        <div class="box-body" style="padding: 1em 2.5em;">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama </label>
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <input type="text" name="nama" class="form-control" value="<?php echo $user['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo $user['alamat']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Kontak</label>
                <input type="text" name="kontak" class="form-control" value="<?php echo $user['kontak']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $decryptpasword; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Pilih foto profil baru</label>
                <input type="file" name="filefoto" id="exampleInputFile" value="">
                
            </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-sm">update</button>
                <button type="button" onclick="self.history.back()" class="btn btn-sm">Batal</button>
            </div>
        </div>
        </form>
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