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

                <!-- bagian alert -->
                <?php 
                    $alert = "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button> <h4><i class=\"icon fa fa-check\"></i> Sukses!</h4>". $_SESSION['error']  . "</div>"; 
                    if(isset ($_SESSION['error'])) {
                        echo $alert;
                    }
                    unset($_SESSION['error'])
                ?>

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
                        <?php  foreach($kinerja2 as $kkpi) { ?>

                            <?php 
                                $name = $kkpi['nama'];
                                $result = call_user_func($name);
                                $defColumn = ['no', 'date', 'created_at', 'updated_at', 'ket', 'jumlah'];
                                $param = getParamIndById($kkpi['id']);
                                $columns = array_merge($defColumn, $param);
                                
                            ?>
                            <h3><?= $kkpi['nama'] ?></h3>
                            <table id="datatemplates_<?= $kkpi['id'] ?>" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                            foreach($columns as $column){?>
                                            <th><?= $column ?></th>
                                        <?php } ?>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1;  foreach($result as $r) {?>
                                        <tr>
                                            <td style="width: 1%;"><?= $a ?></td>
                                            <?php for($i=1; $i<count($r); $i++) { ?>
                                                <td><?= $n=$r[$i] ?? '-'  ?></td>
                                            <?php } ?>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update" onclick="">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <a type="button" class="btn btn-danger"  href="<?= $aksi . "?module=kpi&act=hapus_input&id=" . $r[0] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
                                                    <i class="fa fa-trash"></i>
                                                </a> &nbsp; 
                                            </td>
                                        </tr>
                                    <?php $a++; } ?>
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
                        <div class="form-group">
                            <label for="date">
                                Tanggal
                                <input class="form-control" type="date" name="date" id="date">
                            </label>
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