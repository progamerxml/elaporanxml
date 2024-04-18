<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    $aksi = "modul/mod_jadwal/aksi_jadwal.php";
    require __DIR__ . "/../../config/fungsi_kalender.php";
    require __DIR__ . "/aksi_jadwal.php";

    if (empty($_SESSION['waktu'])) {
        $waktu = explode("-", date("m-Y"));
    } else {
        $waktu = $_SESSION['waktu'];
    }

    $roles2 = getRole();
    $shifts2 = getShift();
    $schedules = getJadwal($waktu);
    $otoritas = cekOto($_SESSION['namauser']);
    // print_r($otoritas['level']);
    // var_dump($_SESSION['waktu']);
    //print_r($schedules);
    //echo json_encode($schedules, JSON_PRETTY_PRINT);


    // mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];
    ?>
    <section class="content-header">
        <h1 class="page-header">
            <span style="vertical-align: inherit;">Data Jadwal</span>
            <small>
                <span style="vertical-align: inherit;"></span>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $base_url; ?>">
                    <i class="fa fa-home"></i>
                    <span style="vertical-align: inherit;">Home </span>
                </a>
            </li>
            <li class="active"><span style="vertical-align: inherit;">Manajemen Jadwal</span></li>
            <li class="active"><span style="vertical-align: inherit;"><?php echo $mod; ?> </span></li>
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
                                <h1>Jadwal <?php
                                    $tanggal = date('M Y', strtotime("$waktu[1]-$waktu[0]-01"));
                                    echo $tanggal ?></h1>
                            </div>
                            <div class="col-md-auto">
                                <div class="button-group pull-right me-5 border">
                                    <button type="submit" name="prev" class="btn btn-primary" onclick="prevMonth()"><i class="fa fa-arrow-left"></i>
                                        Prev
                                    </button>
                                    <button type="submit" name="next" class="btn btn-primary" onclick="nextMonth()">Next <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- debuging -->
                    </section>
                    <hr>

                    <div class="box-body  table-responsive">

                        <table id="" class="table table-bordered table-striped">
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
                                    <?php
                                    for ($date = 1; $date <= $dates; $date++) {
                                        $tanggal = $waktu[1] . '-' . sprintf("%02d", $waktu[0]) . '-' . sprintf("%02d", $date); // Format tanggal
                                        ?>
                                        <!-- If data exists for this date, display it -->
                                        <?php if ($jadwal[$tanggal] !== null) {
                                            foreach ($jadwal[$tanggal] as $item) { ?>
                                                <td style="text-align: left; vertical-align: middle;">

                                                    <div class="d-flex flex-column">
                                                        <select class="form-control" id="role.<?= $item['tanggal'] . '.' . $item['pegawai_id'] ?>"
                                                                style="border:none;" <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                            <option value="" <?= isset($item['role_id']) ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                                -
                                                            </option>
                                                            <?php foreach ($roles2 as $role) { ?>
                                                                <option value="<?= $role['id'] ?>" <?= $role['id'] == $item['role_id'] ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> > <?= $role['kode'] ?> </option>
                                                            <?php } ?>
                                                        </select> <br>
                                                        <select class="form-control" id="shift.<?= $item['tanggal'] . '.' . $item['pegawai_id'] ?>"
                                                                style="border:none;" <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                            <option value="" <?= isset($item['shift_id']) ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                                -
                                                            </option>
                                                            <?php foreach ($shifts2 as $shift) { ?>
                                                                <option value="<?= $shift['id'] ?>" <?= $shift['id'] == $item['shift_id'] ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> > <?= $shift['nama'] ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <br/>
                                                    <?php $btn = "<button class=\"btn btn-danger form-control\" onclick=\"hapusJadwal('{$item['tanggal']}.{$item['pegawai_id']}')\">hapus</button>"; ?>
                                                    <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? $btn : '' ?>
                                                </td>
                                            <?php }
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
    function prevMonth() {
        const bulanSelected = <?= $waktu[0] ?>;
        const tahunSelected = <?= $waktu[1] ?>;

        if (bulanSelected === 1) {
            // window.location.href = '<?= $base_url ?>jadwal?bulan=12&tahun=' + (tahunSelected - 1);
            var bulan = 12;
            var tahun = (tahunSelected - 1);
        } else {
            // window.location.href = '<?= $base_url ?>jadwal?bulan=' + (bulanSelected - 1) + '&tahun=' + tahunSelected;
            var bulan = (bulanSelected - 1);
            var tahun = tahunSelected;
        }
        $.ajax({
            url: 'modul/mod_jadwal/aksi_jadwal.php?module=jadwal&act=nav',
            type: 'POST',
            data: {
                bulan: bulan,
                tahun: tahun
            },
            success: function (response) {
                //change select to value null
                
                alert(response);
            }
        });

        location.reload();
    }

    function nextMonth() {
        const bulanSelected = <?= $waktu[0] ?>;
        const tahunSelected = <?= $waktu[1] ?>;

        if (bulanSelected === 12) {
            // window.location.href = '<?= $base_url ?>jadwal?bulan=1&tahun=' + (tahunSelected + 1);
            var bulan = 1;
            var tahun = (tahunSelected + 1);
        } else {
            // window.location.href = '<?= $base_url ?>jadwal?bulan=' + (bulanSelected + 1) + '&tahun=' + tahunSelected;
            var bulan = (bulanSelected + 1);
            var tahun = tahunSelected;
        }

        $.ajax({
            url: 'modul/mod_jadwal/aksi_jadwal.php?module=jadwal&act=nav',
            type: 'POST',
            data: {
                bulan: bulan,
                tahun: tahun
            },
            success: function (response) {
                //change select to value null
                
                alert(response);
            }
        });

        location.reload();
    }
    function hapusJadwal(id) {
        const values = id.split('.'); // Memisahkan string menjadi array
        const tanggal = values[0];
        const pegawaiId = values[1];

        $.ajax({
            url: 'modul/mod_jadwal/aksi_jadwal.php?module=jadwal&act=hapus',
            type: 'POST',
            data: {
                tanggal: tanggal,
                pegawai_id: pegawaiId
            },
            success: function (response) {
                //change select to value null
                const selectRole = document.getElementById(`role.${tanggal}.${pegawaiId}`);
                const selectShift = document.getElementById(`shift.${tanggal}.${pegawaiId}`);
                selectRole.value = '';
                selectShift.value = '';

                alert(response);
            }
        });
    }

    $(document).ready(function () {
        $('table').on('change', 'select', function () {
            var selectId = $(this).attr('id');
            const values = selectId.split('.'); // Memisahkan string menjadi array

            // Mengambil tiga nilai
            const kolom = values[0];
            const tanggal = values[1];
            const pegawaiId = values[2];
            const user = '<?= $_SESSION['namauser'] ?>';
            console.log(user);

            if (kolom === 'role') {
                const roleId = $(this).val();
                $.ajax({
                    url: 'modul/mod_jadwal/aksi_jadwal.php?module=jadwal&act=update-role',
                    type: 'POST',
                    data: {
                        tanggal: tanggal,
                        pegawai_id: pegawaiId,
                        role_id: roleId,
                        user: user
                    },
                    success: function (response) {
                        alert(response);
                    }
                });
            } else if (kolom === 'shift') {
                const shiftId = $(this).val();
                $.ajax({
                    url: 'modul/mod_jadwal/aksi_jadwal.php?module=jadwal&act=update-shift',
                    type: 'POST',
                    data: {
                        tanggal: tanggal,
                        pegawai_id: pegawaiId,
                        shift_id: shiftId,
                        user: user
                    },
                    success: function (response) {
                        alert(response);
                    }
                });

            }

            //save to database


        });
    });
</script>