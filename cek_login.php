<?php
include "config/koneksi.php";
include "config/fungsi_cryptologi.php";

// fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data){
	$filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
}

$username = anti_injection($_POST['username']);
$password = anti_injection(md5($_POST['password']));

//testing
$password_test = encrypt($_POST['password']); var_dump($password_test); $decrypt = decrypt($password_test); var_dump($decrypt);

// menghindari sql injection
$injeksi_username = mysqli_real_escape_string($konek, $username);
$injeksi_password = mysqli_real_escape_string($konek, $password);
$injeksi_password_test = mysqli_real_escape_string($konek, $password_test);
	
// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
	echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{
	//$query2  = "SELECT * FROM users WHERE username='$username' AND password='$password' AND blokir='N'";
	$query  = "SELECT a.username, a.password, a.blokir, a.level, a.nama_lengkap, b.nama, b.id as id_pgw, b.jabatan as id_jbtn, b.tgl_masuk
	FROM users a, pegawai b
	WHERE a.nama_lengkap = b.id AND a.username = '$username' AND a.password='$password' AND a.blokir='N'
	ORDER BY a.username"; //var_dump($query);
	$query2 = "SELECT a.username, a.password, a.blokir, a.level, a.nama_lengkap, b.nama, b.id as id_pgw, b.jabatan as id_jbtn, b.tgl_masuk
	FROM users a, pegawai b
	WHERE a.nama_lengkap = b.id AND a.username = '$username' AND a.password='$password_test' AND a.blokir='N'
	ORDER BY a.username"; //var_dump($query2);

	$login  = mysqli_query($konek, $query);
	$ketemu = mysqli_num_rows($login);
	if ($ketemu == 0){
		$login = mysqli_query($konek, $query2);
		$ketemu = mysqli_num_rows($login);
	}


	// if($ketemu==0){

	// 	$login  = mysqli_query($konek, $query);
	// 	$ketemu = mysqli_num_rows($login);
		
	// }
	$r = mysqli_fetch_array($login);
	var_dump($r['level']);
		// Apabila username dan password ditemukan (benar)
		if ($ketemu > 0){
			if($r['level']=="admin" || $r['level']=="superadmin"){
	/*	$tgl_skrg = date("Y-m-d"); // dapatkan tanggal sekarang saat online
	$q	="select * from waktu_akses";
	$tampil=mysqli_query($konek,$q);
	$p=mysqli_fetch_array($tampil);
	
	$tgl_mulai=$p['tgl_mulai'];
	$tgl_selesai=$p['tgl_selesai'];

	if($tgl_skrg<$tgl_mulai){
		echo "<script>alert('Waktu akses masih belum dibuka! Silahkan Hubungi Administrator.'); window.location = 'index.php'</script>";
	}
	elseif($tgl_skrg>$tgl_selesai){
		echo "<script>alert('Waktu akses telah  berakhir! Silahkan Hubungi Administrator.'); window.location = 'index.php'</script>";
	}
	else{
	*/	
	session_start();

		$_SESSION['namauser']    	= $r['username'];  //var_dump($_SESSION['namauser']);
		$_SESSION['passuser']    	= $r['password'];  //var_dump($_SESSION['passuser']);
		
		
		$_SESSION['namalengkap'] 	= $r['nama_lengkap'];  //var_dump($_SESSION['namalengkap']);

		$_SESSION['leveluser']   	= $r['level'];  //var_dump($_SESSION['leveluser']);
		$_SESSION['id_jabatan']		= $r['id_jbtn'];  //var_dump($_SESSION['id_jabatan']);
		$_SESSION['id_pegawai']  	= $r['id_pgw'];  //var_dump($_SESSION['id_pegawai']);

		// bikin id_session yang unik dan mengupdatenya agar slalu berubah 
		// agar user biasa sulit untuk mengganti password Administrator 
		$sid_lama = session_id(); var_dump($sid_lama);
		session_regenerate_id();
		$sid_baru = session_id();
		mysqli_query($konek, "UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
	

	header("location:".$base_url."beranda");
	//}
	}
	else{
			session_start();

		// bikin variabel session
		$_SESSION['namauser']    = $r['username'];
		$_SESSION['passuser']    = $r['password'];
		$_SESSION['namalengkap'] = $r['nama_lengkap'];
		$_SESSION['leveluser']   = $r['level'];		var_dump($_SESSION['leveluser']);
		
		// $_SESSION['id']          = $r['id'];

		// bikin id_session yang unik dan mengupdatenya agar slalu berubah 
		// agar user biasa sulit untuk mengganti password Administrator 
		$sid_lama = session_id();
		session_regenerate_id();
		$sid_baru = session_id();
		mysqli_query($konek, "UPDATE users SET id_session='$sid_baru' WHERE username='$username'");

		header("location:".$base_url."beranda");

		}
	}  
		
		else{
			echo "<script>alert('Gagal Login.'); window.location = 'index.php'</script>";
		}
}
?>