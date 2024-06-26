<style>

    .table-container {
        overflow-x: auto;
        white-space: nowrap;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
    }

    th:first-child, td:first-child {
        position: -webkit-sticky; /* For Safari */
        position: sticky;
        left: 0;
        background-color: white; /* Optional: to keep the background consistent */
        z-index: 1; /* Ensure it stays on top */
    }

</style>
<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    $aksi = "modul/mod_jadwal/aksi_jadwal.php";
    require __DIR__ . "/../../config/fungsi_kalender.php";
    require __DIR__ . "/../mod_shift/shift_aksi.php";
    require __DIR__ . "/../mod_role/role_aksi.php";

    $waktu = (empty($_SESSION['waktu'])) ? explode("-", date("m-Y")) : $_SESSION['waktu'];

    $otoritas = cekOto($_SESSION['namauser']);

    // mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];
    ?>
    <section class="content-header">
        <h1 class="page-header">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo $base_url; ?>">
                        <i class="fa fa-home"></i>
                        <span style="vertical-align: inherit;">Home </span>
                    </a>
                </li>
                <li class="active"><span style="vertical-align: inherit;" class="text-capitalize">Manajemen <?php echo $mod; ?></span></li>
                <li class="active"><span style="vertical-align: inherit;" class="text-capitalize"><?php echo $mod; ?> </span></li>
            </ol>
        </h1>
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
                                <?php $btn = " <button type=\"submit\" name=\"cek\" class=\"btn btn-success\" onclick=\"cekJadwalKosong()\">Cek Jadwal</button> | <button type=\"submit\" name=\"cek\" class=\"btn btn-success\" onclick=\"preview()\">preview</button>"; $prev = "<input type=\"button\" value=\"preview\" >";?>
                                    <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? $btn : '' ?>
                                    | 
                                    <button type="submit" name="prev" class="btn btn-primary" onclick="prevMonth()"><i class="fa fa-arrow-left"></i>
                                        Prev
                                    </button>
                                    | 
                                    <button type="submit" name="next" class="btn btn-primary" onclick="nextMonth()">Next <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- debuging -->
                    </section>
                    <hr>

                    <!-- section hasil cek role dan shift -->
                    <section id="hasil-cek" class=" box-body">
                    </section>

                    <!-- section div untuk table -->
                    <div class="box-body" style="max-width: 100%; overflow-x: auto;">

                        <table id="" class="table table-bordered table-striped table-container">
                            <?php $dates = cal_days_in_month(CAL_GREGORIAN, $waktu[0], $waktu[1]); ?>
                            <thead>
                            <tr>
                                <th style="width: 15em;">Nama</th>
                                <?php
                                // Generate column headers for dates from 1 to 30
                                for ($date = 1; $date <= $dates; $date++) { ?>
                                    <th style="max-width: 100%;"> <?= $date ?> </th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Iterate over the array of names and their schedules
                            foreach (getJadwal($waktu) as $nama => $jadwal) { ?>
                            <tr>
                                <td style="vertical-align: middle; font-weight: bold;"><?= $nama ?></td>

                                <!-- Generate cells for each date from 1 to 30 -->
                                <?php
                                for ($date = 1; $date <= $dates; $date++) {
                                    $tanggal = $waktu[1] . '-' . sprintf("%02d", $waktu[0]) . '-' . sprintf("%02d", $date); // Format tanggal
                                    ?>
                                    <!-- If data exists for this date, display it -->
                                    <?php if ($jadwal[$tanggal] !== null) {
                                        foreach ($jadwal[$tanggal] as $item) { $background = getShiftById($item['shift_id']); ?>
                                            <td style="text-align: left; vertical-align: middle; width: 10em; background-color: <?= $background['kode_warna'] ?>; background-opacity: 0.5; vertical-align: center; border: 1px solid black;" id="td_<?= $item['tanggal'] . '_' . $item['pegawai_id'] ?>">
                                                <div class="tooltip_cust" id="div_<?= $item['tanggal'] . '_' . $item['pegawai_id'] ?>" style="background-color: white; padding: 1px; text-align: center; border-radius: .3em; display: none;"><?= $nama ?></div>
                                                <div class="d-flex flex-column" style="vertical-align:middle;">
                                                    <?php if($otoritas['level'] == 'superadmin' || $otoritas['level'] == 'admin') { ?>
                                                    <select style="border: none; background-color: transparent;" id="role.<?= $item['tanggal'] . '.' . $item['pegawai_id'] ?>"
                                                            <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                        <option style="background-color: transparent;" value="" <?= isset($item['role_id']) ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                            -
                                                        </option>
                                                        <?php foreach ( $roles2 = getRole() as $role) { ?>
                                                            <option style="background-color: transparent;" value="<?= $role['id'] ?>" <?= $role['id'] == $item['role_id'] ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> > <?= $role['kode'] ?> </option>
                                                        <?php } ?>
                                                    </select> <br>
                                                    <select style="border: none; background-color: transparent;" id="shift.<?= $item['tanggal'] . '.' . $item['pegawai_id'] ?>"
                                                            <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                        <option style="background-color: transparent;" value="" <?= isset($item['shift_id']) ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> >
                                                            -
                                                        </option>
                                                        <?php foreach (getShift() as $shift) { ?>
                                                            <option style="background-color: transparent;" value="<?= $shift['id'] ?>" <?= $shift['id'] == $item['shift_id'] ? 'selected' : '' ?> <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? '' : 'disabled' ?> > <?= $shift['nama'] ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                    <br/>
                                                    <?php $btn = "<button class=\"btn btn-danger form-control\" onclick=\"hapusJadwal('{$item['tanggal']}.{$item['pegawai_id']}')\">hapus</button>"; ?>
                                                    <?= in_array($otoritas['level'], ['superadmin', 'admin']) ? $btn : '' ?>
                                                    <?php } else { $role = getRoleId($item['role_id']);  $shift = getShiftById($item['shift_id']);?>
                                                        <p style="color: #fff; padding:.2em; text-align: center; height: 100%;"><strong><?= $role['kode'] . "<br></hr>" . $shift['nama'] ?></strong></p>
                                                    <?php } ?>
                                                </div>
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

    function preview()
    {
        window.location.href="<?=$base_url.'jadwal_prev' ?>";
    }
    const status = '<?= $otoritas['level'] ?>';
    if (status !== "superadmin" && status !== "admin") {
        console.log(status); // Outputkan status jika tidak sama dengan "superadmin" atau "admin"
    }
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

    function cekJadwalKosong(){
        $(document).ready(function() {
            // Loop melalui setiap elemen select
            $('select').each(function() {
                // Periksa nilai option yang dipilih
                if ($(this).val() === '') {
                    // Jika nilai kosong, atur properti CSS secara langsung
                    $(this).css('border', '2px solid red');
                } else {
                    // Jika tidak kosong, hapus properti CSS
                    $(this).css('border', 'none');
                }

                // Menambahkan event listener untuk memantau perubahan nilai <select>
                $(this).change(function() {
                    // Periksa kembali nilai option yang dipilih setelah perubahan
                    if ($(this).val() === '') {
                        // Jika nilai kosong, atur properti CSS
                        $(this).css('border', '2px solid red');
                    } else {
                        // Jika tidak kosong, hapus properti CSS
                        $(this).css('border', 'none');
                    }
                });
            });
        });

        const waktu = <?= json_encode($waktu) ?>;
        console.log(waktu);
        $.ajax({
            url: 'modul/mod_jadwal/aksi_jadwal.php?module=jadwal&act=cek-jadwal',
            type: 'POST',
            data: {
                bulan: waktu[0],
                tahun: waktu[1]
            },
            success: function (response) {
                console.log(response);

                var hasilFilter = document.getElementById('hasil-cek');

                // Menetapkan isi dari variabel response ke dalam elemen HTML hasilFilter
                hasilFilter.innerHTML = response;
            }
        });
    }

    $(document).ready(function () {

        // Menangani acara klik ganda pada elemen <td>
        $("td").dblclick(function() {
                var tooltip = $(this).find(".tooltip_cust");
                var roleText = $(this).find("select[id^='role']").find('option:selected').text();
                var shiftText = $(this).find("select[id^='shift']").find('option:selected').text();
                var displayText = "Role: " + roleText + "<br>Shift: " + shiftText;
                tooltip.html(displayText);
                tooltip.css({
                    display: "block",
                    position: "absolute",
                    top: "50%",
                    left: "50%",
                    transform: "translate(-50%, -50%)",
                    backgroundColor: "rgba(0, 0, 0, 0.7)",
                    color: "white",
                    padding: "10px",
                    borderRadius: "5px"
                });
                setTimeout(function() {
                    tooltip.fadeOut();
                }, 3000); // Tooltip akan hilang setelah 3 detik
            });

            
        // untuk insert / update jadwal dan shift
        $('table').on('change', 'select', function () {
            var selectId = $(this).attr('id'); 
            const values = selectId.split('.'); // Memisahkan string menjadi array

            // Mengambil tiga nilai
            const kolom = values[0];
            const tanggal = values[1];
            const pegawaiId = values[2];
            const user = '<?= $_SESSION['namauser'] ?>';
            let tdId = "td_" + tanggal + "_" + pegawaiId;
            let td = $("#"+tdId);
            let bgColor = td.css('background-color');
            console.log(bgColor);

            if (kolom === 'role') {
                const roleId = $(this).val();
                console.log(roleId);
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
                        console.log(response);
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
                        console.log(response);
                    }
                });

            }

            //save to database


        });
    });
</script>