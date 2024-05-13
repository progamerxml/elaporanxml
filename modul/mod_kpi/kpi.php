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
    require __DIR__ . "/../mod_jabatan/aksi_jabatan.php";

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];


    $roles = getRole();
    $gol_kpi2 = getGolKpi();
    $gol2 = getDataGolKpi();


    //$hasil = getRoleId(3); var_dump($hasil);
    ?>
    <section class="content-header">
        <h1 class="page-header">
            <ol class="breadcrumb">
                <li>
                    <a href="<?= $base_url; ?>">
                        <i class="fa fa-home"></i>
                        <span style="vertical-align: inherit;">Home </span>
                    </a>
                </li>
                <li class="active"><span style="vertical-align: inherit;" class="text-capitalize">Manajemen <?= $mod; ?></span></li>
                <li class="active"><span style="vertical-align: inherit;" class="text-capitalize"><?= $mod; ?> </span></li>
            </ol>
        </h1>
    </section>
    <!-- Main content -->
    <div class="col-md-12">

        <!-- bagian alert -->
        <?php 
            $alert = "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button> <h4><i class=\"icon fa fa-check\"></i> Sukses!</h4>". $_SESSION['error']  . "</div>"; 
            if(isset ($_SESSION['error'])) {
                echo $alert;
            }
            unset($_SESSION['error'])
        ?>


        <h2>Manajemen <?= $mod; ?></h2> <br>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php foreach($gol2 as $gol) : ?>
                    <li class=" <?= $gol['id'] == 1 ? 'active' : '' ?>">
                    <a href="#gol-<?= $gol['id'] ?>" data-toggle="tab" aria-expanded="false"><b><?= camelCaseToSpace($gol['golongan']) ?></b></a>
                    </li>
                <?php endforeach ?>
                <li class="pull-right">
                    <button type="button" class="btn btn-success pull-right text-capitalize" data-toggle="modal" data-target="#modal-update" onclick="switchModal();">
                        Tambah indikator <?= $mod; ?>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <?php foreach($gol2 as $gol) : ?>
                    <div class="tab-pane <?= $gol['id'] == 1 ? 'active' : '' ?>" id="gol-<?= $gol['id'] ?>">
                        <b><?= camelCaseToSpace($gol['golongan']) ?></b> <br> <hr>
                        <div class="box-body  table-responsive mt-2">
                            <table id="datatemplates_<?= $gol['id'] ?>" class="table table-borderless table-hover table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 1%;" >No</th>
                                    <th>Nama Indikator</th>
                                    <th>Recap Indikator</th>
                                    <th>Target Indikator</th>
                                    <th>Bobot Indikator</th>
                                    <th>Role</th>
                                    <th>Tipe Indikator</th>
                                    <th>Parameter Indikator</th>
                                    <th style="width: 6%;">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $kinerja2 = getKinerjaKpi($gol['id']);
                                        $no = 1;
                                        foreach($kinerja2 as $kinerja){
                                            $role = getJabatanById($kinerja['role_id']);
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= camelCaseToSpace($kinerja['nama']) ?></td>
                                            <td><?= $kinerja['recap'] ?></td>
                                            <td><?= $kinerja['target'] ?></td>
                                            <td><?= konversiDecimalKePersen($kinerja['bobot']) ?></td>
                                            <td><?= $role['nama_jabatan'] ?></td>
                                            <td><?= $kinerja['tipe'] ?></td>
                                            <td><?= $kinerja['param_indikator'] ?></td>
                                            <td align="center">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-update" onclick="getDataKr(<?=$kinerja['id']?>, '<?=$kinerja['nama']?>','<?=$kinerja['recap']?>', <?= $kinerja['target'] ?>, <?= $kinerja['bobot'] ?>, <?= $kinerja['role_id'] ?>, '<?= $kinerja['tipe'] ?>', '<?= $kinerja['param_indikator'] ?>');"><i class="fa fa-pencil"></i></button>
                                                <a type="button" class="btn btn-danger"  href="<?= $aksi . "?module=kpi&act=hapus&id=" . $kinerja['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
                                                <i class="fa fa-trash"></i></a> &nbsp; 
                                            </td>
                                        </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-warning">
                    <section class="content-header">
                        <div class="row border">
                            <div class="col-md-11 border">
                                <h3 class="text-capitalize fw-bolder">Data Indikator <?= $mod; ?></h3>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success pull-right text-capitalize" data-toggle="modal" data-target="#modal-update" onclick="switchModal();">
                                    Tambah <?= $mod; ?>
                                </button>
                            </div>
                        </div>
                    <!-- debuging -->
                    </section>
                    <hr>

                    <!-- bagian input master dan sub master -->
                    <div class="box-body">
                        <!-- bagian input master indikator -->
                        <!-- <div class="col-md-6">
                            <div class="mb-2">
                                <div class="">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><b>Input Indikator</b></h3>
                                    </div>
    
                                    <form role="form" action="<?= $aksi ?>" method="POST">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="namaIndikator">Nama</label>
                                            <input type="text" class="form-control" id="namaIndikator" name="nama" placeholder="Nama Indikator">
                                        </div>
                                        <div class="form-group">
                                            <label for="recapIndikator">Recap</label>
                                            <input type="text" class="form-control" id="recapIndikator" name="recap" placeholder="Recap Indikator">
                                        </div>
                                        <div class="form-group">
                                            <label for="targetIndikator">Target</label>
                                            <input type="number" class="form-control" id="targetIndikator" name="target" placeholder="Target Indikator">
                                        </div>
                                        <div class="form-group">
                                            <label for="bobotIndikator">Bobot</label>
                                            <input type="number" class="form-control" id="bobotIndikator" name="bobot" placeholder="Bobot Indikator" step="0.01" min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="typeIndikator">Tipe</label>
                                            <select class="form-control" id="typeIndikator" name="tipe">
                                                <option value="">-- Pilih Tipe --</option>
                                                <option value="kualitatif">Kualitatif</option>
                                                <option value="kuantitatif">Kuantitatif</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->

                        <!-- input sub master indikator -->
                        <!-- <div class="col-md-6">
                            <div class="">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><b>Input Indikator</b></h3>
                                </div>
    
                                <form role="form" action="<?= $aksi ?>" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="namaIndikator">Nama</label>
                                        <input type="text" class="form-control" id="namaIndikator" name="nama" placeholder="Nama Indikator">
                                    </div>
                                    <div class="form-group">
                                        <label for="recapIndikator">Recap</label>
                                        <input type="text" class="form-control" id="recapIndikator" name="recap" placeholder="Recap Indikator">
                                    </div>
                                    <div class="form-group">
                                        <label for="targetIndikator">Target</label>
                                        <input type="number" class="form-control" id="targetIndikator" name="target" placeholder="Target Indikator">
                                    </div>
                                    <div class="form-group">
                                        <label for="bobotIndikator">Bobot</label>
                                        <input type="number" class="form-control" id="bobotIndikator" name="bobot" placeholder="Bobot Indikator" step="0.01" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="typeIndikator">Tipe</label>
                                        <select class="form-control" id="typeIndikator" name="tipe">
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="kualitatif">Kualitatif</option>
                                            <option value="kuantitatif">Kuantitatif</option>
                                        </select>
                                    </div>
                                </div>
    
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div> -->
                        <!-- <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Input Data Indikator</h3>
                            </div>

                            <div class="box-body">
                                <div class="box-group" id="accordion">

                                        <div class="box-header with-border active">
                                            <h4 class="">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                                                    Input Data Master
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                                labore sustainable VHS.
                                            </div>
                                        </div>
                                    <div class="panel box box-danger">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                                    Collapsible Group Danger
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                                labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel box box-success">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                                Collapsible Group Success
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                            <div class="box-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                                labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <!-- pembungkus table -->
                    <div class="box-body  table-responsive">

                        <table id="datatemplates" class="table table-borderless table-hover table-striped">
                            <thead>
                            <tr>
                                <th style="width: 3%;" >No</th>
                                <th>Nama Indikator</th>
                                <th>Recap Indikator</th>
                                <th>Target Indikator</th>
                                <th>Bobot Indikator</th>
                                <th>Role</th>
                                <th>Tipe Indikator</th>
                                <th>Parameter Indikator</th>
                                <th style="width: 6%;">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($kinerja2 as $kinerja){
                                        $role = getJabatanById($kinerja['role_id']);
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $kinerja['nama'] ?></td>
                                        <td><?= $kinerja['recap'] ?></td>
                                        <td><?= $kinerja['target'] ?></td>
                                        <td><?= konversiDecimalKePersen($kinerja['bobot']) ?></td>
                                        <td><?= $role['nama_jabatan'] ?></td>
                                        <td><?= $kinerja['tipe'] ?></td>
                                        <td><?= $kinerja['param_indikator'] ?></td>
                                        <td align="center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-update" onclick="getDataKr(<?=$kinerja['id']?>, '<?=$kinerja['nama']?>','<?=$kinerja['recap']?>', <?= $kinerja['target'] ?>, <?= $kinerja['bobot'] ?>, <?= $kinerja['role_id'] ?>, '<?= $kinerja['tipe'] ?>', '<?= $kinerja['param_indikator'] ?>');"><i class="fa fa-pencil"></i></button>
                			                <a type="button" class="btn btn-danger"  href="<?= $aksi . "?module=kpi&act=hapus&id=" . $kinerja['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
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
            <div class="modal-dialog rounded rounded-3">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Perbarui Role</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="updateForm" action="<?=$aksi?>?module=kpi&act=update" method="POST">
                        <div class="box-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="nama">
                                    Nama
                                </label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Indikator" required>
                            </div>
                            <div class="form-group">
                                <label for="recap"> 
                                    Recap
                                </label>
                                <input type="text" class="form-control" id="recap" name="recap" placeholder="Recap Indikator" required>
                            </div>
                            <div class="form-group">
                                <label for="target">
                                    Target
                                </label>
                                <input type="number" class="form-control" id="target" name="target" placeholder="Target Indikator" required>
                            </div>
                            <div class="form-group">
                                <label for="bobotIndikator">Bobot</label>
                                <input type="number" class="form-control" id="bobotIndikator" name="bobot" placeholder="Bobot Indikator" step="0.01" min="0" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="role_id">Role</label>
                                <select class="form-control" id="role_id" name="role_id" required>
                                    <option value="">-- Pilih Role--</option>
                                    <?php foreach($roles as $role) { ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['nama'] . " ( " . $role['kode'] . " )" ?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select class="form-control" id="gol_kpi" name="gol_kpi" required>
                                    <option value="">-- Pilih Role--</option>
                                    <?php foreach($gol_kpi2 as $gol_kpi) { ?>
                                    <option value="<?= $gol_kpi['id'] ?>"><?= $gol_kpi['golongan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="typeIndikator">Tipe</label>
                                <select class="form-control" id="typeIndikator" name="tipe" required>
                                    <option value="">-- Pilih Tipe Indikator--</option>
                                    <option value="kualitatif">Kualitatif</option>
                                    <option value="kuantitatif">Kuantitatif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="param_indikator">
                                    Parameter Indikator
                                </label>
                                <input type="text" class="form-control" id="param_indikator" name="param_indikator" placeholder="Parameter Indikator" required>
                                <span class="text-danger" style="font-weight: normal; font-size: .9em; font-style: italic;"><b>*</b>gunakan tanda koma (,) untuk memisahkan tiap parameter</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
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
    function getDataKr(id, indikator, recap, target, bobot, role_id, tipe, param_indikator) {
    // Isi nilai input pada modal dengan data yang diambil dari tabel
    $('#id').val(id);
    $('#nama').val(indikator);
    $('#recap').val(recap);
    $('#target').val(target);
    $('#bobotIndikator').val(bobot);
    $('#role_id').val(role_id);
    $('#typeIndikator').val(tipe);
    $('#param_indikator').val(param_indikator);
    }

    // Reset nilai input pada modal setelah modal ditutup
    $('#modal-update').on('hidden.bs.modal', function () {
        $('#id').val('');
        $('#nama').val('');
        $('#recap').val('');
        $('#target').val('');
    });

    function switchModal()
    {
        $('.modal-title').text("Tambah Indikator");
        $('#updateForm').attr('action','modul/mod_kpi/kpi_aksi.php?module=kpi&act=input');
    }
</script>