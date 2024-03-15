<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";
  include "../../config/fungsi_cryptologi.php";


  $module = $_GET['module']; //var_dump($module);
  $act    = $_GET['act']; //var_dump($act);

    if($module=='user' AND $act=='upuser'){
        $id = $_POST['id'];
        $nama = $_POST['nama']; //var_dump($_POST['nama']);
        $alamat = $_POST['alamat']; //var_dump($alamat);
        $email = $_POST['email']; //var_dump($email);
        $kontak = $_POST['kontak']; //var_dump($kontak);
        $username = $_POST['username']; //var_dump($username);
        $password = encrypt($_POST['password']); //echo "password enkripsi = ".$password."<br>";
        $seepass = decrypt($password); //echo "password non-enkripsi = ".$seepass;

        $filename = $_FILES["filefoto"]["name"];
        $tempname = $_FILES["filefoto"]["tmp_name"];
        $folder = "./../../assets/img/" . $filename;

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // encript password menggunakan open ssl

        $password = "$password\n";
        
        // Display the original string
        echo "Original String: " . $password;
        
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';
        
        // Store the encryption key
        $encryption_key = "GeeksforGeeks";
        
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($password, $ciphering,
                    $encryption_key, $options, $encryption_iv);
        var_dump($encryption);

        $upquery = "UPDATE pegawai SET nama = '$nama', alamat = '$alamat', email = '$email', kontak = '$kontak' WHERE id = $id"; //var_dump($upquery);
        $upuser = "UPDATE users set username = '$username', password = '$password', url_foto = '$target_file' where nama_lengkap = $id"; var_dump($upuser);
        mysqli_query($konek, $upquery);
        mysqli_query($konek, $upuser);
        // // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        // $check = getimagesize($_FILES["filefoto"]["tmp_name"]);
        // if($check !== false) {
        //     echo "File is an image - " . $check["mime"] . ".";
        //     $uploadOk = 1;
        // } else {
        //     echo "File is not an image.";
        //     $uploadOk = 0;
        // }
        // }
    
        // // Check if file already exists
        // if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        // $uploadOk = 0;
        // }
    
        // // Check file size
        // if ($_FILES["filefoto"]["size"] > 5000000) {
        // echo "File terlalu besar ! gunakan file dibawah 5 mb.";
        // $uploadOk = 0;
        // }
    
        // // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        // echo "Hanya diperbolehkan upload file dengan ekstensi JPG, JPEG, PNG & GIF.";
        // $uploadOk = 0;
        // }
    
        // // Check if $uploadOk is set to 0 by an error
        // if ($uploadOk == 0) {
        // echo "File tidak terupload.";
        // // if everything is ok, try to upload file
        // } else {
        // if (move_uploaded_file($_FILES["filefoto"]["tmp_name"], $target_file)) {
        //     echo "The file ". htmlspecialchars( basename( $_FILES["filefoto"]["name"])). " has been uploaded.";
        // } else {
        //     echo "Maaf, terjadi error saat mengupload file.";
        // }
        // }
        // if(mysqli_query($konek, $upquery) AND mysqli_query($konek, $upuser)){
        // header("location:".$base_url."profile");
        // }else{
          // }
          header("location:".$base_url."profile.html");
    }



}
?>