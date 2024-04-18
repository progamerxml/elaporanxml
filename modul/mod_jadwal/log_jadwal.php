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

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];

    $logs = getLogJadwal();

    ?>
    <section class="content-header">
        <h1 class="page-header">
            <span style="vertical-align: inherit;">Log Jadwal</span>
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
                                <h1>Log Jadwal</h1>
                            </div>
                        </div>


                        <!-- debuging -->
                    </section>
                    <hr>

                    <div class="box-body  table-responsive">

                        <table id="" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 3%;" >No</th>
                                <th style="width: 27%;" >Username</th>
                                <th>Aksi</th>
                                <th>Waktu Input</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($logs as $log){
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $log['username'] ?></td>
                                        <td><?= $log['aksi'] ?></td>
                                        <td><?= $log['waktu'] ?></td>
                                    </tr>
                                <?php $no++; } ?>
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