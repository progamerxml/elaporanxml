<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_agenda/aksi_agenda.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';  var_dump($act);
}?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-12 d-flex">
          <div class="box box-warning d-flex p-5">
            <?php
              $today = date('Y-m-d');
              $jmlpg = mysqli_query($konek, "SELECT * FROM pegawai");
              $jmlpgw = mysqli_num_rows($jmlpg);
              // echo $jmlpgw;
              $count = mysqli_query($konek, "SELECT * FROM `pekerjaan` where tanggal = '$today'");
              $jml = mysqli_num_rows($count);
              // echo $jml;
              $blm = $jmlpgw - $jml;
              echo "jumlah pegawai yang telah melakukan report kerja hari ini: $jml pegawai";
              echo "<br>";
              echo "jumlah pegawai yang belum melakukan report kerja hari ini: $blm pegawai";
              ?>
              <a class="btn btn-warning btn-sm" href="<?php echo $base_url.$mod; ?>beranda-tambah.html"><i
									class="fa fa-plus"></i>Lihat Detail</a>
          </div>
        </div>
        <div class="col-md-12 d-flex" style="height: 400px; margin:20 auto">
          <!-- general form elements -->
          <div class="box box-warning d-flex">
            <div id="belanja" class="border border-primary rounded col-md-10 d-flex justify-content-around" style="height: 400px; margin: 5 auto">
              <?php
                $sql = "SELECT *
                FROM pekerjaan 
                WHERE tanggal = '$today'
                order by id desc limit 5";
                $exec = mysqli_query($konek,$sql);
                while ($row = mysqli_fetch_array($exec)){
                  $pegawai = mysqli_query($konek, "SELECT a.username, b.nama, b.jabatan 
                  FROM users a, pegawai b
                  WHERE a.nama_lengkap = b.id AND a.username = '$row[karyawan]'");
                  $r = mysqli_fetch_array($pegawai);

                  $jabatan = mysqli_query($konek, "SELECT nama_jabatan 
                  FROM jabatan
                  WHERE id = $r[jabatan]");
                  $rj = mysqli_fetch_array($jabatan);
                  echo "
                  <div class='card col-sm-2 my-3 mx-2'>
                  <h2 class='card-header text-bold'>$rj[nama_jabatan]</h2>
                  <div class='card-body'>
                    <h4 class='card-title text-bold'>$r[nama]</h4>
                    <p class='card-text'>$row[pekerjaan]</p>
                  </div>
                </div>
                ";
                }
              ?>
                
            </div>
            <div class="border col-md-2 p-2 rounded d-flex justify-content-around align-self-end">
              <a href="#" rel="noopener noreferrer" class="text-decoration-none text-light btn btn-warning fw-bold fs-3 rounded-pill px-4">selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.col -->

    <div class="box border">
      <section class="content-header px-2 py-3 border">
        <h1 class="fw-bold">Data Report Kerja Lainya</h1>
      </section>
      <div class="box-body border">
        <div class="border py-3">
          <?php
            $jmltgl = mysqli_query($konek, "SELECT DISTINCT tanggal FROM pekerjaan");
            $tanggal = mysqli_fetch_array($jmltgl);
            while($tanggal = mysqli_fetch_array($jmltgl))
            {
              echo "";
              echo $tanggal['tanggal']."<br>";
            }
            echo $base_url.$mod;
          ?>
        </div>
      </div>
    </div>
  </div><!-- /.row -->
</section><!-- /.section -->
<!-- <a href=""></a> -->

<script type="text/javascript">
<span style="font-size:10px">{point.key}</span>
<table>',
  pointFormat: '<tr>
    <td style="color:{series.color};padding:0">{series.name}: </td>' +
    '<td style="padding:0"><b>{point.y:.2f}</b></td>
  </tr>',
  footerFormat: '</table>',
</script>