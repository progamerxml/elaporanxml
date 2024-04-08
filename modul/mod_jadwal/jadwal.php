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
  var_dump($roles2);
//   echo json_encode($schedules, JSON_PRETTY_PRINT);


  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : '';
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

                <table id="datatemplates" class="table table-bordered table-responsive table-hover table-striped">
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
                                    <td style="text-align: left; vertical-align: middle;">
                                    <?php if ($jadwal[$tanggal] !== null) {
                                        foreach ($jadwal[$tanggal] as $item) { ?>
                                            <div class="d-flex flex-column">

                                                <span class=""><?//= date("d", strtotime($tanggal)) ?></span>
                                                <select name="role-<?= $key . '-' . $subKey ?>" id="role-<?= $key . '-' . $subKey ?>" style="border:none;" >
                                                    <?php  foreach($roles2 as $role) { ?>
                                                        <option value="<?= $item['role_id'] ?>" <?= $role['id'] == $item['role_id'] ? 'selected' : '' ?> > <?= $role['kode'] ?> </option>
                                                    <?php } ?>
                                                </select> <br>   
                                                <select name="shift-<?= $key . '-' . $subKey ?>" id="shift-<?= $key . '-' . $subKey ?>" style="border:none;" >
                                                    <?php  foreach($shifts2 as $shift) { ?>
                                                        <option value="<?= $item['shift_id'] ?>" <?= $shift['id'] == $item['shift_id'] ? 'selected' : '' ?> > <?= $shift['nama'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        <?php }
                                    } ?>
                                    </td>
                                <?php } else { ?>
                                    <!-- If data does not exist for this date, display empty cell -->
                                    <td style="text-align: left; vertical-align: middle;"></td>
                                <?php }
                            } ?>

                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>

					<table id="datatemplates" class="table table-bordered table-responsive table-hover table-striped">
                        <?php $dates = cal_days_in_month(CAL_GREGORIAN, $waktu[0], $waktu[1]); ?>
						<thead>
							<tr>
								<th rowspan="3" style="vertical-align: middle; text-align: center; width: 10%;">Nama</th>
                                <td colspan="<?= $dates ?>" style="text-align: center;" > <strong>Tanggal</strong></td>
							</tr>
                            <tr>
                                <?php for($d = 1; $d<= $dates; $d++){ ?>
								    <td style="text-align: center;" ><?= $d ?></td>
                                <?php } ?>
                            </tr>
						</thead>
                        <tbody>
                            <?php 
                            foreach($schedules as $nama => $shifts) { ?>
                                <tr>
                                    <form action="<?= $aksi ?>" method="post">
                                    <td style="text-align: left; vertical-align: middle;"><?= $key ?></td>
                                    <?php foreach($shifts as $subKey => $subValue) { ?>
                                        <td class="editable bg-body-secondary" data-employ="<?= $key ?>" data-tanggal="<?= $subKey ?>" data-role="<?= $role['id'] ?>" data-shift="<?= $jadwal['shift'] ?>">
                                            <span class="fc-day-number"><?= date("d", strtotime($subKey)) ?></span>
                                            <select name="role-<?= $key . '-' . $subKey ?>" id="role-<?= $key . '-' . $subKey ?>" style="border:none;" >
                                                <?php  foreach($subKey as $role) { ?>
                                                    <option value="<?= $role['id'] ?>"> <?= $role['nama_role'] ?> </option>
                                                <?php } ?>
                                            </select>
                                            <select name="shift-<?= $key . '-' . $subKey ?>" id="shift-<?= $key . '-' . $subKey ?>" style="border:none;" >
                                                <?php  foreach($shifts2 as $shift) { ?>
                                                    <option value="<?= $shift['id'] ?>"> <?= $shift['nama'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        </form>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                        $(document).ready(function() {
                            $('.editable select').change(function() {
                                var employ = $(this).data('employ');
                                var tanggal = $(this).data('tanggal');
                                var role = $(this).val(); // Mengambil nilai dari select role
                                var shift = $(this).closest('td').find('select[name^="shift"]').val(); // Mengambil nilai dari select shift
                                
                                // Kirim data ke server menggunakan AJAX
                                $.ajax({
                                    type: 'POST',
                                    url: '<?= $aksi ?>', // Ganti dengan URL endpoint Anda
                                    data: {
                                        employ: employ,
                                        tanggal: tanggal,
                                        role: role,
                                        shift: shift
                                    },
                                    success: function(response) {
                                        // Handle respon dari server jika diperlukan
                                        console.log(response);
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle kesalahan jika terjadi
                                        console.error(error);
                                    }
                                });
                            });
                        });
                        </script>




					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->


	    </div><!-- /.col -->
	</div>
</section>
<?php
}
?>