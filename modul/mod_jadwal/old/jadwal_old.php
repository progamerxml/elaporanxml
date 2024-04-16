<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $aksi = "modul/mod_jadwal/aksi_jadwal.php";
  require __DIR__ . "/../../config/fungsi_kalender.php";
  require __DIR__ . "/aksi_jadwal.php";
  $waktu = explode("-", date("m-Y"));
  $roles2 = getRole();
  $shifts2 = getShift();
  $schedules = getJadwal($waktu);
//   var_dump($waktu);
//   print_r($schedules);
//   echo json_encode($schedules, JSON_PRETTY_PRINT);

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; print_r($act);
  $mod=$_GET['module']; 
?>
<section class="content-header">
	<h1 class="page-header">
		<font style="vertical-align: inherit;">Data Jadwal</font>
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
		<li class="active"><font style="vertical-align: inherit;">Manajemen Jadwal</font></li>
		<li class="active"><font style="vertical-align: inherit;"><?php echo $mod; ?> </font></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
                <div class="box box-warning">
				<section class="content-header">
                    <div class="row border">
                        <div class="col-md-11 border">
                            <h1>Jadwal <?= date("M Y") ?></h1>
                        </div>
                        <div class="col-md-1">
                            <div class="button-group pull-right">
                                <button class="btn">prev</button>
                                <button class="btn">next</button>
                            </div>
                        </div>
                    </div>
                    

					
					
					<!-- debuging -->
				</section>
				<hr>

				<div class="box-body">

                <table id="" class="table table-bordered table-hover table-striped">
                <?php $dates = cal_days_in_month(CAL_GREGORIAN, $waktu[0], $waktu[1]); ?>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <?php
                            // Generate column headers for dates from 1 to 30
                            for ($date = 1; $date <= $dates; $date++) {
                                echo '<th>' . $date . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Iterate over the array of names and their schedules
                        foreach ($schedules as $nama => $jadwal) { ?>
                            <tr>
                            <td><?= $nama ?></td>

                            <!-- // Generate cells for each date from 1 to 30 -->
                            <?php for ($date = 1; $date <= $dates; $date++) {
                                $tanggal = date('Y-m') . '-' . sprintf("%02d", $date); // Format tanggal

                                // Check if the date exists in the schedule
                                if (isset($jadwal[$tanggal])) { ?>
                                    <!-- If data exists for this date, display it -->
                                    <?php if ($jadwal[$tanggal] !== null) { 
                                        foreach ($jadwal[$tanggal] as $item) { ?>
                                            <td style="text-align: left; vertical-align: middle;">
                                                <div class="d-flex flex-column">

                                                    <span class=""><?= date("d", strtotime($tanggal)) ?></span>
                                                    <select name="role.<?= $tanggal . '.' . $item['pegawai_id'] ?>" id="role.<?= $item['tanggal'] . '.' . $item['pegawai_id'] ?>" style="border:none;" >
                                                        <?php  foreach($roles2 as $role) { ?>
                                                            <option value="<?= $role['id'] ?>" <?= $role['id'] == $item['role_id'] ? 'selected' : '' ?> > <?= $role['kode'] ?> </option>
                                                        <?php } ?>
                                                    </select> <br>   
                                                    <select name="shift.<?= $tanggal . '.' . $item['pegawai_id'] ?>" id="shift.<?= $item['tanggal'] . '.' . $item['pegawai_id'] ?>" style="border:none;" >
                                                        <?php  foreach($shifts2 as $shift) { ?>
                                                            <option value="<?= $shift['id'] ?>" <?= $shift['id'] == $item['shift_id'] ? 'selected' : '' ?> > <?= $shift['nama'] ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                <?php  } 
                                    } 
                                } 
                            } ?>

                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->


	    </div><!-- /.col -->
	</div>
</section>
<?php
}
?>

<script>
    $(document).ready(function(){
        $('table').on('change', 'select', function(){
            var selectName = $(this).attr('name');
            var selectValue = $(this).val();
            var aksi = '<?= $aksi ?>';
            console.log(selectName);
            console.log(selectValue);
            console.log(aksi);

            $.ajax({
                url: aksi,
                type: 'POST',
                data: {
                    nama: selectName,
                    value: selectValue
                },
                success: function(response) {
                    // Handle success response (if needed)
                    console.log('Data updated successfully!');
                },
                error: function(xhr, status, error) {
                    // Handle error response (if needed)
                    console.error('Error updating data:', error);
                }
                });
        });
    });
</script>