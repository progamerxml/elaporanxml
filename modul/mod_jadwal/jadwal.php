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
  $roles2 = getRole();
  $shifts2 = getShift();
  $schedules = getJadwal();
  // var_dump($schedules);
  echo json_encode($schedules, JSON_PRETTY_PRINT);


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
                            <h1>Jadwal <?= "Maret 2024" ?></h1>
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
					<table id="" class="table table-bordered table-responsive">
                        <?php $dates = cal_days_in_month(CAL_GREGORIAN, 3, 2024); ?>
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
    $karyawan = array(); 
    for($i=1; $i<=62; $i++) {
        $dataKaryawan = array(
            "employ_id" => "nama $i",
            "date" => array()
        );

        for($a=1; $a<= $dates; $a++) {
            $tanggal = array(
                "tanggal" => $a,
                "role" => rand(1, 5),
                "shift" => rand(1, 3)
            );

            array_push($dataKaryawan['date'], $tanggal);
        }

        array_push($karyawan, $dataKaryawan);
    }

    foreach($schedules as $jadwal) { ?>
        <tr>
            <form action="<?= $aksi ?>" method="post">
            <td style="text-align: left; vertical-align: middle;"><?= $jadwal["nama_pegawai"] ?></td>
            <?php foreach($kry['date'] as $jadwal) { ?>
                <td class="editable" style="text-align: center;" data-employ="<?= $kry['employ_id'] ?>" data-tanggal="<?= $jadwal['tanggal'] ?>" data-role="<?= $jadwal['role'] ?>" data-shift="<?= $jadwal['shift'] ?>">
                    <select name="role-<?= $kry['employ_id'] . '-' . $jadwal['tanggal'] ?>" id="role-<?= $kry['employ_id'] . '-' . $jadwal['tanggal'] ?>" style="border:none;" class="form-control">
                        <?php  foreach($roles2 as $role) { ?>
                            <option value="<?= $role['id'] ?>"> <?= $role['kode'] ?> </option>
                        <?php } ?>
                    </select>
                    <select name="shift-<?= $kry['employ_id'] . '-' . $jadwal['tanggal'] ?>" id="shift-<?= $kry['employ_id'] . '-' . $jadwal['tanggal'] ?>" style="border:none;" class="form-control">
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

<script>
    // document.addEventListener('click', function(event) {
    //     var clickedElement = event.target;
    //     var editableElement = null;

    //     if (clickedElement.classList.contains('editable')) {
    //         editableElement = clickedElement;
    //     } else if (clickedElement.closest('.editable')) {
    //         editableElement = clickedElement.closest('.editable');
    //     }

    //     if (editableElement) {
    //         var employId = editableElement.dataset.employ;
    //         var tanggal = editableElement.dataset.tanggal;
    //         var role = editableElement.dataset.role;
    //         var shift = editableElement.dataset.shift;

    //         var roleInput = document.createElement('input');
    //         roleInput.type = 'text';
    //         roleInput.name = 'role_' + employId + '_' + tanggal;
    //         roleInput.value = role;

    //         var shiftInput = document.createElement('input');
    //         shiftInput.type = 'text';
    //         shiftInput.name = 'shift_' + employId + '_' + tanggal;
    //         shiftInput.value = shift;

    //         editableElement.innerHTML = '';
    //         editableElement.appendChild(roleInput);
    //         editableElement.appendChild(shiftInput);

    //         roleInput.focus();

    //         roleInput.addEventListener('blur', function() {
    //             editableElement.innerHTML = '<span>role : ' + this.value + '<br></span><span>shift : ' + shiftInput.value + '</span>';
    //         });

    //         shiftInput.addEventListener('blur', function() {
    //             editableElement.innerHTML = '<span>role : ' + roleInput.value + '<br></span><span>shift : ' + this.value + '</span>';
    //         });
    //     }
    // });
</script>



					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
            <!-- <div class="box box-primary">
                <div class="box-body no-padding">

                <div id="calendar" class="fc fc-unthemed fc-ltr">
                    <div class="fc-toolbar fc-header-toolbar">
                        <div class="fc-left">
                            <div class="fc-button-group">
                                <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" aria-label="prev">
                                    <span class="fc-icon fc-icon-left-single-arrow"></span>
                                </button>
                                <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" aria-label="next">
                                    <span class="fc-icon fc-icon-right-single-arrow"></span>
                                </button>
                                <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="">today</button></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left    fc-state-active">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"><h2>March 2024</h2></div><div class="fc-clear"></div>
                            </div>
                            
                            <div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table class=""><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table class=""><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 869px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content" style="height: 144px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2024-02-25"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2024-02-26"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2024-02-27"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2024-02-28"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2024-02-29"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-03-01"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-03-02"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2024-02-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2024-02-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2024-02-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2024-02-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2024-02-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-03-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-03-02"><span class="fc-day-number">2</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#f56954;border-color:#f56954"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">All Day Event</span></div></a></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 144px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-03-03"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2024-03-04"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-03-05"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-03-06"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-03-07"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-03-08"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-03-09"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-03-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-03-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-03-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-03-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-03-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-03-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-03-09"><span class="fc-day-number">9</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 144px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-03-10"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2024-03-11"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-03-12"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-03-13"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-03-14"></td><td class="fc-day fc-widget-content fc-fri fc-today " data-date="2024-03-15"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-03-16"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-03-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-03-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-03-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-03-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-03-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-fri fc-today " data-date="2024-03-15"><span class="fc-day-number">15</span></td><td class="fc-day-top fc-sat fc-future" data-date="2024-03-16"><span class="fc-day-number">16</span></td></tr></thead><tbody><tr><td class="fc-event-container" colspan="3"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Long Event</span></div></a></td><td rowspan="2"></td><td rowspan="2"></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#0073b7;border-color:#0073b7"><div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div></a></td><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00a65a;border-color:#00a65a"><div class="fc-content"><span class="fc-time">7p</span> <span class="fc-title">Birthday Party</span></div></a></td></tr><tr><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00c0ef;border-color:#00c0ef"><div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 144px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-03-17"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-03-18"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-03-19"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-03-20"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-03-21"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2024-03-22"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-03-23"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2024-03-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-mon fc-future" data-date="2024-03-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-tue fc-future" data-date="2024-03-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-wed fc-future" data-date="2024-03-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-thu fc-future" data-date="2024-03-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-fri fc-future" data-date="2024-03-22"><span class="fc-day-number">22</span></td><td class="fc-day-top fc-sat fc-future" data-date="2024-03-23"><span class="fc-day-number">23</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 144px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-03-24"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-03-25"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-03-26"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-03-27"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-03-28"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2024-03-29"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-03-30"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2024-03-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-mon fc-future" data-date="2024-03-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-tue fc-future" data-date="2024-03-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-wed fc-future" data-date="2024-03-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-thu fc-future" data-date="2024-03-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-fri fc-future" data-date="2024-03-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-sat fc-future" data-date="2024-03-30"><span class="fc-day-number">30</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" href="http://google.com/" style="background-color:#3c8dbc;border-color:#3c8dbc"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Click for Google</span></div></a></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 149px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-03-31"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2024-04-01"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2024-04-02"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2024-04-03"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2024-04-04"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-04-05"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2024-04-06"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2024-03-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2024-04-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2024-04-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2024-04-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2024-04-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-04-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2024-04-06"><span class="fc-day-number">6</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table>
                        </div>
                    </div>
                </div>
                
                </div>

            </div> -->

	    </div><!-- /.col -->
	</div>
</section>
<?php
}
?>