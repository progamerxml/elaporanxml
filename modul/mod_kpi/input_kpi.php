<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    $aksi = "modul/mod_kpi/kpi_aksi.php";
    require __DIR__ . "/../../config/fungsi_kalender.php";
    require __DIR__ . "/../mod_pegawai/aksi_pegawai.php";
    require __DIR__ . "/kpi_aksi.php";

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];
    $leveluser = $_SESSION['leveluser'];
    $golongan = ($leveluser == 'superadmin') ? null : getGolKpyByKar($nmpgw['jabatan']);
    $kinerja2 = getKinerjaKpi($golongan);
    $idPeg =  $nmpgw['id'];
    $persenKpi = getPersenKpi($idPeg);

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
                <li class="active"><span style="vertical-align: inherit;" class="text-capitalize">Manajemen <?= camelCaseToSpace ($mod); ?></span></li>
                <li class="active"><span style="vertical-align: inherit;" class="text-capitalize"><?= camelCaseToSpace($mod); ?> </span></li>
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

                <div class="row border">
                    <div class="col-md-11 border">
                        <h1 class="text-capitalize fw-bolder"><strong>Data <?= camelCaseToSpace($mod); ?></strong></h1>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <?php 
                            $addBtn = "<button type=\"button\" class=\"btn btn-success pull-right text-capitalize\" data-toggle=\"modal\" data-target=\"#modal-update\" onclick=\"switchModal();\">
                                Tambah <?= camelCaseToSpace($mod); ?>
                            </button>"; 

                            echo $levUsr = ($leveluser == 'superadmin') ?'':$addBtn;
                        ?>
                        
                    </div>
                </div> <br>
                <!-- <div class="box box-warning">
                    <section class="content-header"> -->
                        <!-- debuging -->
                    <!-- </section>
                </div> -->
                <!-- /.box -->

                            <!-- Bagian data KPI Karyawan -->
            <div class="box box-warning" style="display: <?= ($leveluser == 'superadmin') ? "none" : "block";?>;">
                <div class="box-header with-border mb-3 d-flex align-content-center">
                    <h3>Data KPI Saya</h3>
                    <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-xs-3 text-center flex-center" style="">
                            <h1 ><strong><?= konversiDecimalKePersen($persenKpi[0]['total_score']) ?></strong></h1>
                            <div class="knob-label">Total Score KPI</div>
                        </div>

                        <div class="col-xs-9">
                            <ul class="nav nav-stacked">
                                <?php 
                                $indikators = getDetailScoreKpi($idPeg); // print_r($indikators);
                                foreach($indikators as $indk) :
                                ?>
                                <li><a href="#"><?= camelCaseToSpace($indk['indikator']) ?>
                                <span class="pull-right text-red"><strong><?= konversiDecimalKePersen($indk['score']) ?></strong></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

                <?php $b = 1; foreach($kinerja2 as $kkpi) { 
                    // Tambahkan kondisi untuk memeriksa tipe kualitatif dan level user
                    if ($kkpi['tipe'] == 'kualitatif' && !in_array($leveluser, ['superadmin', 'admin'])) {
                        continue;
                    }
                    ?>

                    <!-- <div class="box box-solid">
                        <div class="box-body">
                        <div class="box-group" id="accordion">
                          <div class="panel box box-success">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a  data-toggle="collapse"  data-parent="#accordion"  href="#collapseThree"  class="collapsed"  aria-expanded="true">
                                  Collapsible Group Success
                                </a>
                              </h4>
                            </div>
                            <div  id="collapseThree"  class="panel-collapse collapse"  aria-expanded="false">
                              <div class="box-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                sunt aliqua put a bird on it squid single-origin coffee
                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim
                                aesthetic synth nesciunt you probably haven't heard of them
                                accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div> -->

                <div class="box box-warning">
                    <div class="box-body  table-responsive">
                        <!-- lakukan perulangan terhadap data kinerja_kpi -->

                            <?php 
                                $name = $kkpi['nama'];
                                $result = call_user_func($name);
                                $defColumn = ['no', 'id_pegawai', 'date', 'created_at', 'updated_at', 'ket', 'jumlah'];
                                $param = getParamIndById($kkpi['id']);
                                $columns = array_merge($defColumn, $param);
                                
                            ?>
                            <h3><strong><?= $b.". ".camelCaseToSpace($kkpi['nama']) ?></strong></h3>
                            <hr>
                            <table id="datatemplates_<?= $kkpi['id'] ?>" class="table table-borderless table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                            foreach($columns as $column){?>
                                            <th><?= $column ?></th>
                                        <?php } ?>
                                        <th style="text-align: center;">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1;  foreach($result as $r) {?>
                                        <tr>
                                            <td style="width: 1%;" ><?= $a ?></td>
                                            <?php for($i=1; $i<count($r); $i++) { ?>
                                                <td><?= $n=$r[$i] ?? '-'  ?></td>
                                            <?php } ?>
                                            <td style="text-align: center;">
                                                <!-- <button type="button" class="btn btn-warning" onclick="updateDataInputKpi();">
                                                    <i class="fa fa-pencil"></i>
                                                </button> -->
                                                <a href="<?= $aksi . "?module=kpi&act=hapus_input_kpi&table=".$kkpi['nama']."-".$kkpi['id']."&id=" . $r[0]."&pegawai_id=" . $nmpgw['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
                                                    <i class="fa fa-trash text-red"></i>
                                                </a> &nbsp; 
                                            </td>
                                        </tr>
                                    <?php $a++; } ?>
                                </tbody>
                            </table> 
                            
                            <?php //var_dump($kkpi['param_indikator']) ?>
                            
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    
                <?php $b++; } ?>
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
                                <option value="">-- pilih indikator --</option>
                                <?php foreach($kinerja2 as $inputkpi) { 
                                    // Tambahkan kondisi untuk memeriksa tipe kualitatif dan level user
                                    if ($inputkpi['tipe'] == 'kualitatif' && !in_array($leveluser, ['superadmin', 'admin'])) {
                                        continue;
                                    }
                                ?>
                                    <option value="<?= $inputkpi['id'] . "-" . $inputkpi['nama'] ?>"> <?= $inputkpi['nama'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="pegId" value="<?= $nmpgw['id'] ?>">
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