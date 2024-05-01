<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    $aksi = "modul/mod_kpi/kpi_aksi.php";
    require __DIR__ . "/../../config/fungsi_kalender.php";
    require __DIR__ . "/kpi_aksi.php";

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];

    $kinerja2 = getKinerjaKpi(1);
    //var_dump($kinerja2);

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
                        <!-- lakukan perulangan terhadap data kinerja_kpi -->
                        <?php foreach($kinerja2 as $kkpi) { ?>
                            <h3><?= $kkpi['nama'] ?></h3>
                            <table id="datatemplates" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>parameter</th>
                                        <th>parameter</th>
                                        <th>parameter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>@</td>
                                        <td>nilai</td>
                                        <td>nilai</td>
                                        <td>nilai</td>
                                    </tr>
                                </tbody>
                            </table> <br>

                            <?php //var_dump($kkpi['param_indikator']) ?>
                        <?php } ?>
                        
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
                        
                    <form role="form" id="updateForm" action="<?=$aksi?>?module=kpi&act=update_kpi" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <label for="indikator">
                                Indikator
                            </label>
                            <select name="indikator" id="indikator" class="form-control">
                                <option value="">-- pili indikator --</option>
                                <?php foreach($kinerja2 as $inputkpi) { ?>
                                    <option value="<?= $inputkpi['id'] . "-" . $inputkpi['nama'] ?>"> <?= $inputkpi['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="isi"></div>
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
    function getDataKr(id, indikator, recap, target) {
    // Isi nilai input pada modal dengan data yang diambil dari tabel
    $('#id').val(id);
    $('#indikator').val(indikator);
    $('#recap').val(recap);
    $('#target').val(target);
    }

    // Reset nilai input pada modal setelah modal ditutup
    $('#modal-update').on('hidden.bs.modal', function () {
        $('#id').val('');
        $('#indikator').val('');
        $('#recap').val('');
        $('#target').val('');
    });

    function switchModal()
    {
        $('.modal-title').text("Tambah Indikator");
        $('#updateForm').attr('action','modul/mod_kpi/kpi_aksi.php?module=kpi&act=input_kpi');
    }

    $(document).ready(function(){
    $('select').on('change', function () {
        var selectedID = $(this).val(); 
        $.ajax({
            url: 'modul/mod_kpi/kpi_aksi.php?module=kpi&act=get-param-indikator',
            type: 'POST',
            data: {
                id: selectedID
            },
            success: function (response) {
                
                // console.log(response);

                var form = document.getElementById('isi');
                form.innerHTML = response;
            }
        });
    });
});

</script>