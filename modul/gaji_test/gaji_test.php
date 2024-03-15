<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/gaji_test/import.php";

  
  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
  $mod=$_GET['module'];
  $user = $_SESSION['namauser'];
?>
	    <!-- Load File jquery.min.js yang ada difolder js -->

    <script>
        
        let gaji_pokok = document.getElementById("gapok").value;
        function tampil(gaji_pokok){
            alert(gaji_pokok);
        }

        $(document).ready(function() {
            // Sembunyikan alert validasi kosong
            $("#kosong").hide();
        });
    </script>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">

            <?php
                switch($act){
                    // Tampil Templates
                    default:
            ?>
            <!-- case default -->
            <div class="box box-warning">
                <section class="content-header border border-danger">
                    <h1>Manajemen Data Gaji</h1>
                    <ol class="breadcrumb">
                        <li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-import.html"><i class="fa  fa-upload"></i>Import File Excel</a></li>
                        <li><a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>-tambah.html"><i class="fa  fa-plus"></i>Input Gaji Manual</a></li>
                    </ol>
                </section>
                <hr>
                <div class="box-body">
                    <table id="datatemplates" class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Pegawai</th>
                            <th width="15%">Jabatan</th>
                            <th width="10%">Gaji Pokok</th>
                            <th width="10%">Total Pendapatan</th>
                            <th width="10%">Total Potongan</th>
                            <th width="10%">Gaji Bersih</th>
                            <th width="8%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $qipe = "SELECT * FROM penggajian_test"; $eqipe = mysqli_query($konek, $qipe);
                        $nomor = 1;
                        while( $hqipe = mysqli_fetch_object($eqipe)) {
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php $depe = mysqli_fetch_object(mysqli_query($konek, "SELECT * FROM pegawai WHERE id = $hqipe->pegawai")); echo $depe->nama; ?></td>
                            <td><?php $deje = mysqli_fetch_object(mysqli_query($konek, "SELECT * FROM jabatan WHERE id = $depe->jabatan")); echo $deje->nama_jabatan; ?></td>
                            <td><?php echo "Rp. ".number_format($hqipe->gaji_pokok,2,',','.'); ?></td>
                            <td><?php echo "Rp. ".number_format($hqipe->ttl_pndptn,2,',','.'); ?></td>
                            <td><?php echo "Rp. ".number_format($hqipe->ttl_ptgn,2,',','.'); ?></td>
                            <td><?php echo "Rp. ".number_format($hqipe->gaji_bersih,2,',','.'); ?></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><strong><i class="fa fa-sliders"></i></strong></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $base_url.$mod.'-editgaji-1.html'; ?>"><button class="btn btn-warning btn-xs btn-block"><i class="fa fa-edit"></i> Edit Gaji</button></a></li>
                                        <li><a href="#"><button class="btn btn-success btn-xs btn-block"><i class="fa fa-print"></i> Cetak Slip</button></a></li>
                                        <li><a href="#"><button class="btn btn-primary btn-xs btn-block"><i class="fa fa-send-o"></i> Kirim Slip</button></a></li>
                                        <li><a href="#"><button class="btn btn-danger btn-xs btn-block"><i class="fa  fa-trash"></i> Hapus Gaji</button></a></li>
                                    </ul>
                                </div>
                            </td>
						</tr>
                        <?php $nomor++; } ?>
					<?php
                    $query  = "SELECT * FROM gaji_test order by id desc";
					$tampil = mysqli_query($konek, $query);
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){  ?>
						<tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $r['pegawai']; ?></td>
                            <td><?php echo number_format($r['jabatan']); ?></td>
                            <td><?php echo number_format($r['gaji']); ?></td>
                            <td><?php echo number_format($r['potongan']); ?></td>
                            <td><?php echo number_format($r['potongan']); ?></td>
                            <td><?php echo number_format($r['gaji_bersih']); ?></td>
                            <td>
                                <div class="box box-default box-solid collapsed-box">
                                    <div class="box-header with-border">
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body" style="display: none;">
                                    The body of the box
                                    </div>
                                </div>
                            </td>
						</tr>
						$no++;
					<?php }
					?>
                    </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <?php 
                break;
                case "import":
            ?>
                        <!-- case import -->
			<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Import File Excel</h3>
                </div><!-- /.box-header -->
                <form method="POST" action="<?php echo $aksi; ?>?module=gaji_test&act=upload" class="form-horizontal" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="gaji_excel" class="col-sm-2 control-label">Upload File Excel</label>
							<div class="col-sm-6">
                                    <input class="form-control" type="file" name="gaji_excel" id="gaji_excel">
							</div>
						</div>
					<div class="box-footer">
                        <button type="submit" name="preview" class="btn btn-xs btn-success">Preview</button>
						<button type="submit" class="btn btn-xs btn-primary">Upload</button> 
                        <button type="button" onclick="self.history.back()" class="btn btn-xs btn-danger">Batal</button>
					</div><!-- /.box-footer -->
				</form>
            </div><!-- /.box -->
            <!-- testing disini -->

            <?php
                    break;
                    case "tambah":
                    
                    $qget = "select * from pegawai";
                    $hget = mysqli_query($konek, $qget); 
                    $exget = mysqli_fetch_object($hget);
                    $bulanNow = date("m"); var_dump($bulanNow);
                    var_dump($_POST['bulan']); var_dump($_POST['pegawai']);
            ?>
            <form method="POST" action="<?php echo $aksi; ?>?module=gaji_test&act=upload" class="form-horizontal" >
            <div class="box box-warning">
                <div class="box-header with-border">
                    <div class="row border">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="box-title">Input Penggajian</h3>
                                </div>
                                <div class="col-sm-4">
                                    <select name="bulan" id="bulan" class="form-control" required>
                                        <option value=""> Pilih Bulan </option>
                                        <?php
                                            $bulan = array("Januari", "Februari", "Faret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            for($i = 0; $i < count($bulan); $i++) { ?>
                                                <option value="<?php $no = $i+1; echo $no; ?>"><?php echo $bulan[$i]; ?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                                <div class="col-sm-4">

                                    <select name="pegawai" id="pegawai" class="form-control" required>
                                        <option value=""> Pilih Pegawai </option>
                                        <?php
                                            $speg = "select * from pegawai";
                                            $expeg = mysqli_query($konek, $speg);
                                            while($hpeg = mysqli_fetch_object($expeg)){ ?>
                                                <option value="<?php echo $hpeg->id; ?>"><?php echo $hpeg->nama; ?></option>
                                            <?php } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row border">
                            <!-- table pendapatan -->
                            <div class="col-md-6 border">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Pendapatan</h3>
                                    </div>

                                    <div class="box-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>JENIS</th>
                                                    <th></th>
                                                    <th>Besar</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Gaji Pokok</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="gapok" id="gapok" onfocusout="tampil()" value="<?php echo $_POST['gapok']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Bonus / Intensif</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bonus" value="<?php echo $_POST['bonus']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Libur / Tanggal Merah</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="libur" value="<?php echo $_POST['libur']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Tunjangan Jabatan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_jbtn" value="<?php echo $_POST['tunj_jbtn']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>Tunjangan Makan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_mkn" value="<?php echo $_POST['tunj_mkn']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td>Tunjangan Masa Kerja</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_mskrj" value="<?php echo $_POST['tunj_mskrj']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>7.</td>
                                                    <td>Tunjangan Kesehatan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_kshtn" value="<?php echo $_POST['tunj_kshtn']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>8.</td>
                                                    <td>Tunjangan BPJS JHT</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_bpjsjht" value="<?php echo $_POST['tunj_bpjsjht']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>9.</td>
                                                    <td>Tunjangan Hari Raya</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_hr" value="<?php echo $_POST['tunj_hr']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>10.</td>
                                                    <td>Bonus Absensi</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bns_absn" value="<?php echo $_POST['bns_absn']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>TOTAL </strong></td>
                                                    <td>:</td>
                                                    <td><strong><?php $total_pendapatan = $_POST['gapok'] + $_POST['bonus'] + $_POST['libur'] + $_POST['tunj_jbtn'] + $_POST['tunj_mkn'] + $_POST['tunj_mskrj'] + $_POST['tunj_kshtn'] + $_POST['tunj_bpjsjht'] + $_POST['tunj_hr'] + $_POST['bns_absn']; echo "Rp. ".number_format($total_pendapatan,2,',','.');?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- table potongan -->
                            <div class="col-md-6 border">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Potongan</h3>
                                    </div>

                                    <div class="box-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>JENIS</th>
                                                    <th></th>
                                                    <th>Besar</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Cicilan Ganti Rugi</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ganti_rugi" value="<?php echo $_POST['ganti_rugi']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Pinjaman</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="pinjaman" value="<?php echo $_POST['pinjaman']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>BPJS Kesehatan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bpjs_kes" value="<?php echo $_POST['bpjs_kes']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>BPJS JHT</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bpjs_jht" value="<?php echo $_POST['bpjs_jht']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>PPh21</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="pph21" value="<?php echo $_POST['pph21']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td>Potongan Absensi</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ptgn_absen" value="<?php echo $_POST['ptgn_absen']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>7.</td>
                                                    <td>Potongan KPI</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ptgn_kpi" value="<?php echo $_POST['ptgn_kpi']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>8.</td>
                                                    <td>Potongan Target</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ptgn_target" value="<?php echo $_POST['ptgn_target']; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>TOTAL </strong></td>
                                                    <td>:</td>
                                                    <td><strong><?php $total_potongan = $_POST['ganti_rugi'] + $_POST['pinjaman'] + $_POST['bpjs_kes'] + $_POST['bpjs_jht'] + $_POST['pph21'] + $_POST['ptgn_absen'] + $_POST['ptgn_kpi'] + $_POST['ptgn_target']; echo  "Rp. ".number_format($total_potongan,2,',','.');?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>GAJI BERSIH</strong></td>
                                                    <td>:</td>
                                                    <td><strong><?php $gaji_bersih = $total_pendapatan - $total_potongan; echo "Rp. ".number_format($gaji_bersih,2,',','.'); ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

					<div class="box-footer">
						<button type="submit" class="btn btn-xs btn-primary">Input Gaji</button>
                        <button type="submit" class="btn btn-xs btn-success" onclick="tampil()">kalkulasi</button>
                        <button type="button" onclick="self.history.back()" class="btn btn-xs btn-danger">Batal</button>
					</div><!-- /.box-footer -->
				</form>
            </div><!-- /.box -->

            <?php
                    break;
                    case "editgaji":
                        //var_dump($_GET["id"]);
                    $qide = "SELECT * FROM penggajian_test WHERE id = $_GET[id]"; $eqide = mysqli_query($konek, $qide); $hqide = mysqli_fetch_object($eqide);
            ?>
            <form method="POST" action="<?php echo $aksi; ?>?module=gaji_test&act=update" class="form-horizontal" >
            <div class="box box-warning">
                <div class="box-header with-border">
                    <div class="row border">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="box-title">Edit Penggajian</strong></h3>
                                </div>
                                <div class="col-sm-4">
                                    <label for="bulan">Bulan : </label>
                                    <select name="bulan" id="bulan" class="form-control" required disabled>
                                        <option value=""> Pilih Bulan </option>
                                        <?php
                                            $bulan = array("Januari", "Februari", "Faret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            for($i = 0; $i < count($bulan); $i++) { ?>
                                                <option value="<?php $no = $i+1; echo $no; ?>" <?php if( $i+1 == $hqide->bulan){echo "selected";}?>><?php echo $bulan[$i]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                <label for="bulan">Nama : </label>
                                    <select name="pegawai" id="pegawai" class="form-control" required disabled>
                                        <option value=""> Pilih Pegawai </option>
                                        <?php
                                            $speg = "select * from pegawai";
                                            $expeg = mysqli_query($konek, $speg);
                                            while($hpeg = mysqli_fetch_object($expeg)){ ?>
                                                <option value="<?php echo $hpeg->id; ?>" <?php if($hpeg->id == $hqide->pegawai){echo "selected";}?>><?php echo $hpeg->nama; ?></option>
                                            <?php } 
                                        ?>
                                        <input type="hidden" name="pgwi" value="<?php echo $hqide->pegawai; ?>">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row border">
                            <!-- table pendapatan -->
                            <div class="col-md-6 border">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Pendapatan</h3>
                                    </div>

                                    <div class="box-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>JENIS</th>
                                                    <th></th>
                                                    <th>Besar</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Gaji Pokok</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="gapok" id="gapok" onfocusout="tampil()" value="<?php echo $hqide->gaji_pokok; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Bonus / Intensif</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bonus" value="<?php echo $hqide->bonus_intensif; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Libur / Tanggal Merah</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="libur" value="<?php echo $hqide->lembur_tglmrh; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Tunjangan Jabatan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_jbtn" value="<?php echo $hqide->tunj_jbtn; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>Tunjangan Makan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_mkn" value="<?php echo $hqide->tunj_mkn; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td>Tunjangan Masa Kerja</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_mskrj" value="<?php echo $hqide->tunj_mskrj; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>7.</td>
                                                    <td>Tunjangan Kesehatan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_kshtn" value="<?php echo $hqide->tunj_kshtn; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>8.</td>
                                                    <td>Tunjangan BPJS JHT</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_bpjsjht" value="<?php echo $hqide->tunj_bpjsjht; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>9.</td>
                                                    <td>Tunjangan Hari Raya</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="tunj_hr" value="<?php echo $hqide->thr; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>10.</td>
                                                    <td>Bonus Absensi</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bns_absn" value="<?php echo $hqide->bns_absen; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>TOTAL </strong></td>
                                                    <td>:</td>
                                                    <td><strong><?php echo "Rp. ".number_format($hqide->ttl_pndptn,2,',','.');?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- table potongan -->
                            <div class="col-md-6 border">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Potongan</h3>
                                    </div>

                                    <div class="box-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>JENIS</th>
                                                    <th></th>
                                                    <th>Besar</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Cicilan Ganti Rugi</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ganti_rugi" value="<?php echo $hqide->ganti_rugi; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Pinjaman</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="pinjaman" value="<?php echo $hqide->pinjaman; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>BPJS Kesehatan</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bpjs_kes" value="<?php echo $hqide->bpjs_kshtn; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>BPJS JHT</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="bpjs_jht" value="<?php echo $hqide->bpjs_jht; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>PPh21</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="pph21" value="<?php echo $hqide->pph21; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td>Potongan Absensi</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ptgn_absen" value="<?php echo $hqide->ptgn_absen; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>7.</td>
                                                    <td>Potongan KPI</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ptgn_kpi" value="<?php echo $hqide->ptgn_kpi; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td>8.</td>
                                                    <td>Potongan Target</td>
                                                    <td>:</td>
                                                    <td><input type="teks" class="form-control" name="ptgn_target" value="<?php echo $hqide->ptgn_target; ?>" ></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>TOTAL </strong></td>
                                                    <td>:</td>
                                                    <td><strong><?php echo  "Rp. ".number_format($hqide->ttl_ptgn,2,',','.');?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>GAJI BERSIH</strong></td>
                                                    <td>:</td>
                                                    <td><strong><?php $gaji_bersih = $hqide->ttl_pndptn - $hqide->ttl_ptgn; echo "Rp. ".number_format($gaji_bersih,2,',','.'); ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

					<div class="box-footer">
						<button type="submit" class="btn btn-xs btn-primary">Input Gaji</button>
                        <button type="submit" class="btn btn-xs btn-success" onclick="tampil()">kalkulasi</button>
                        <button type="button" onclick="self.history.back()" class="btn btn-xs btn-danger">Batal</button>
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