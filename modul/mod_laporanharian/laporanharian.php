<script>
function printContent(el){
   
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = history.go(0);
}
</script>


<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_laporanharian/aksi_laporanharian.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  
  $mod=$_GET['module'];
  if($mod=="laporanharian"){
	 $judul="Laporan Harian";
	 $kode="5.1.1";
  }
  elseif($mod=="laporanbulanan"){
	 $judul="Laporan Bulanan";
	 $kode="5.1.2";
  }
 
  
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


                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $judul; ?></h3>
                </div><!-- /.box-header -->
                <form method="POST"  class="form-horizontal">
					<div class="box-body">
					<input type="hidden" name="mod" value="<?php echo $mod; ?>">
					
					<?php
					if ($_SESSION['leveluser']=='admin'){
						$query="SELECT a.nama,b.uraian,b.target,c.id
FROM pegawai a, kegiatan b, kinerja c
WHERE c.nama_pegawai=a.id AND c.uraian_kegiatan=b.id ORDER BY c.id ASC";
					}
					?>   
					  
				<div class="form-group">
							<label for="album" class="col-sm-2 control-label">NIP</label>
							<div class="col-sm-6">
								<select class="form-control select2" id="nip" name="nip">
									<option value="0" selected>- Pilih NIP -</option>
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
						<div class="form-group">
							<label for="pembuat" class="col-sm-2 control-label">Tanggal / Waktu</label>
						
							<div class="col-sm-6">
								<input type="datetime-local" class="form-control" id="tgl_selesaix" name="waktu" />
							</div>
						</div>

					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-danger">Pilih</button> 
						
						
					</div><!-- /.box-footer -->
				</form>
              </div><!-- /.box -->

	<?php
	
	if($_POST['kinerja']!="Semua"){
	$st="SELECT a.nama,b.uraian,b.target,c.id
FROM pegawai a, kegiatan b, kinerja c
WHERE c.nama_pegawai=a.id AND c.uraian_kegiatan=b.id ORDER BY c.id ASC";
	$tem=mysqli_query($konek,$st);
	$r=mysqli_fetch_array($tem);

	}
	else{
	 if($_SESSION['leveluser']=="admin"){
		 $kinerja="Kinerja Harian";
	 }
	
	}
	?>
	<div class="box">
	<section class="content-header">
		<h1></h1>
		<ol class="breadcrumb">
            <li><a class="btn btn-danger" href="javascript:printContent('div1')"><i class="fa fa-print"></i></a></li>
            <li><a class="btn btn-danger" href="<?php echo $base_url."modul/mod_laporanharian/excel.php?leveluser=$level"; ?>"><i class="fa fa-download"></i></a></li>
        </ol>
	</section>
	<div id='div1'>
	
                <div class="box-body">
				<font size="-1">
                  <table id="" class="table table-bordered table-hover">
				  <caption>
				  <h4><center><b>LAPORAN KINERJA HARIAN</b></center></h4>
				  <h6><left><b>NIP </b></left></h6>
				  <h6><left><b>HARI / TANGGAL </b></left></h6>
				 
				  </caption>
                    <thead>
                      <tr>
                        <th>NO</th>
                        
						<th><center>URAIAN KEGIATAN</center></th>
						<th><center>JUMLAH KEGIATAN YANG DILAKSANAKAN</center></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>	
                  </table>
				  </font>		  
				  <br>	
					<?php
					if($_POST['laporanharian']!="Semua"){
					$string="SELECT a.nama,b.uraian,c.waktu,c.waktu_selesai,c.id,b.target
FROM pegawai a, kegiatan b, kinerja c
WHERE c.nama_pegawai=a.id and c.uraian_kegiatan=b.id order by c.id ASC";
                    $temp=mysqli_query($konek,$string);
					$r=mysqli_fetch_array($temp);
					?>
					
					
					<table width="100%">
					<tr align="center">
					<td width="50%">
					Yang Melaporkan  
					<br>
					<br>
					<br>
					<br>
					<b><u></u></b> <br>
					<br>
					NIP. <br>	
					</td>
					<td width="50%">
					Blitar,&nbsp;&nbsp;&nbsp; <?php  echo tgl_indo($_POST['tgl_mulai']);?><br>
					Bendahara/ Staf yang mengelola<br>
					<br>
					<br>
					<br>
					<br>
					<b><u></u></b> <br>
					<br>
					NIP.<br>
					</td>
					</tr>
					</table>
					
					<?php
					}
					?>		  
                </div><!-- /.box-body -->
				</div> <!-- /. print
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