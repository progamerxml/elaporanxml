<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    $aksi = "modul/mod_shift/shift_aksi.php";
    require __DIR__ . "/../../config/fungsi_kalender.php";
    // require __DIR__ . "/shift_aksi.php";

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];

    $shifts = getShifts();

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
                                <h1 class="text-capitalize fw-bolder">Data <?php echo $mod; ?></h1>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success pull-right text-capitalize" data-toggle="modal" data-target="#modal-update" onclick="switchModal();">
                                    Tambah <?php echo $mod; ?>
                                </button>
                            </div>
                        </div>


                        <!-- debuging -->
                    </section>
                    <hr>

                    <div class="box-body  table-responsive">

                        <table id="datatemplates" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 3%;" >No</th>
                                <th>Nama</th>
                                <th>Kode </th>
                                <th>Warna </th>
                                <th style="width: 6%;">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($shifts as $shift){
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $shift['nama'] ?></td>
                                        <td><?= $shift['kode_warna'] ?? '#fff' ?></td>
                                        <td><div style="padding: 1em; border: 1px solid white; background-color: <?= $shift['kode_warna'] ?>; width: 1em; border-radius: 50%;"> </td>
                                        <td align="center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-update" onclick="getDataKr(<?=$shift['id']?>, '<?=$shift['nama'] ?>', '<?=$shift['kode_warna'] ?? '' ?>');"><i class="fa fa-pencil"></i></button>
                			                <a type="button" class="btn btn-danger"  href="<?= $aksi . "?module=shift&act=hapus&id=" . $shift['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
                                            <i class="fa fa-trash"></i></a> &nbsp; 
	                    	            </td>
                                    </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>


        <!-- modal area -->
        <div class="modal fade in" id="modal-update" style="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Perbarui Role</h4>
                    </div>
                    <div class="modal-body">
                        
                    <form role="form" id="updateForm" action="<?=$aksi?>?module=shift&act=update" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="namaShift">Nama Role</label>
                            <input type="hidden" name="id" id="idShift">
                            <input type="text" class="form-control" id="namaShift" name="nama" placeholder="Nama Shift">
                        </div>
                        <div class="form-group">
                            <label for="kodeWarna">Warna</label><br>
                            <input type="color" id="kodeWarna" name="warna" style="height: 4em; width: 4em;">
                            <p>Kode warna : <span id="colorCode"></span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<script>
    document.getElementById('kodeWarna').addEventListener('input', function() {
        let color = this.value;
        document.getElementById('colorCode').textContent = color;
    });
    
    function getDataKr(id, nama, kode_warna) {
    // Isi nilai input pada modal dengan data yang diambil dari tabel
    $('#idShift').val(id);
    $('#namaShift').val(nama);
    $('#kodeWarna').val(kode_warna);
    $('#colorCode').text(kode_warna);
    }

    // Reset nilai input pada modal setelah modal ditutup
    $('#modal-update').on('hidden.bs.modal', function () {
        $('#idShift').val('');
        $('#namaShift').val('');
        $('#kodeWarna').val('');
    });

    function switchModal()
    {
        $('.modal-title').text("Tambah Shift");
        $('#updateForm').attr('action','modul/mod_shift/shift_aksi.php?module=shift&act=input');
    }
</script>