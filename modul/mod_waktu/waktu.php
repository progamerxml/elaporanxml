  <!-- Pace style -->
  <link rel="stylesheet" href="../../plugins/pace/pace.min.css">

<script>
function readURL(input) { // Mulai membaca inputan gambar
if (input.files && input.files[0]) {
var reader = new FileReader(); // Membuat variabel reader untuk API FileReader
 
reader.onload = function (e) { // Mulai pembacaan file
$('#preview_gambar') // Tampilkan gambar yang dibaca ke area id #preview_gambar
.attr('src', e.target.result)
.width(200); // Menentukan lebar gambar preview (dalam pixel)
//.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
};
 
reader.readAsDataURL(input.files[0]);
}
}
</script>

 <!-- bootstrap datepicker -->
     <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
	<!-- bootstrap datepicker -->
     <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
  $(function () {




    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

  });
</script>
<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	$aksi = "modul/mod_waktu/aksi_waktu.php";
	
	
	$query = "SELECT * FROM waktu_akses";
	
    $hasil = mysqli_query($konek,$query);
    $r     = mysqli_fetch_array($hasil);
	
	
	
    
?>
	<section class="content-header">
		<h1>Formulir Pendaftaran</h1>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
		<?php			
		if(isset($_GET['r'])) {
			if($_GET['r']=="sukses") {
		?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> SUKSES!</h4>
					Data BERHASIL di SIMPAN!
				</div>
		<?php
			}
			elseif($_GET['r']=="gagal") {
		?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> GAGAL!</h4>
					Data GAGAL di SIMPAN!
			</div>
		<?php
			}
		}
		?>
			<form method="POST" enctype="multipart/form-data" action="<?php echo $aksi; ?>?module=waktu" class="form-horizontal">
				
				
				<div class="box-body">
				 
					
					
					
				
					
					<div class="form-group">
							<label for="tgl_mulai" class="col-sm-3 control-label">Tgl. Mulai</label>
							<div class="col-sm-9">
								 <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                   </div>
                        <input type="text" class="form-control pull-right" id="tgl_mulai" name="tgl_mulai" placeholder="31/12/2017" value="<?php echo tanggal($r['tgl_mulai']); ?>" >
                          </div>
							</div>
						</div>
					

                      <div class="form-group">
							<label for="tgl_selesai" class="col-sm-3 control-label">Tgl. Selesai</label>
							<div class="col-sm-9">
								 <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                   </div>
                        <input type="text" class="form-control pull-right" id="tgl_selesai" name="tgl_selesai" placeholder="31/12/2017" value="<?php echo tanggal($r['tgl_selesai']); ?>" >
                          </div>
							</div>
						</div>


						
								
			
				
				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Simpan</button> <button type="button" onclick="self.history.back()" class="btn">Batal</button>
				</div><!-- /.box-footer -->
			</form>
		</div><!-- /.box -->
	</section><!-- /.content -->
<?php
}
?>



<script type="text/javascript">
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>