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
    $leveluser = $_SESSION['leveluser'];
    $idPeg =  ($leveluser == 'superadmin') ? null : $nmpgw['id'];


    //$hasil = getRoleId(3); var_dump($hasil);
    ?>
    <section class="content-header">
		<h1 class="page-header">
			<!-- <font style="vertical-align: inherit;">Rekap Report Hari ini</font> -->
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
            <li class="active"><span style="vertical-align: inherit;" class="text-capitalize">Manajemen <?= camelCaseToSpace ($mod); ?></span></li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
    
            <!-- bagian alert -->
            <?php 
                $alert = "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button> <h4><i class=\"icon fa fa-check\"></i> Sukses!</h4>". $_SESSION['error']  . "</div>"; 
                if(isset ($_SESSION['error'])) {
                    echo $alert;
                }
                unset($_SESSION['error'])
            ?>
    
            <?php switch ($act) { default : ?>
            <!-- Bagian data KPI Karyawan -->
            <div class="box box-warning">
                <div class="box-header with-border mb-3 d-flex align-content-center">
                    <h3>Data KPI Karyawan</h3>
                    <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">

                <table id="datatemplates_1" class="table table-borderless table-hover">
                    <thead>
                        <tr style="display: none;">
                            <th style="width: 5%; color: #fff; font-size: .8em;">no</th>
                            <th style="width: 90%; color: #fff; font-size: .8em;">Nama</th>
                            <th style="color: #fff; font-size: .8em;">Final Score KPI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            $persenKpi = getPersenKpi($idPeg);
                            foreach($persenKpi as $dataPersen) :
                        ?>
                        <tr>
                            <td style="width: 2%; text-decoration: none; font-size: 1em; color: black;"><?= $no ?></td>
                            <td style="width: 90%; text-decoration: none; font-size: 1em; color: black;"><strong text-decoration: none;><a href="<?= $base_url . $mod . "-detail-" . $dataPersen['id_peg'] ?>.html" style="text-decoration: none;"><?= $dataPersen['nama'] ?></a></strong></td>
                            <td style="width: 5%; text-decoration: none; font-size: 1em; color: black;"><strong><?= konversiDecimalKePersen($dataPersen['total_score']) ?></strong></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>

                </div>
            </div>
            
            <!-- bagian data indikator KPI -->
            <div class="box box-warning">
                <div class="box-header with-border mb-3 d-flex align-content-center">
                    <h3 >Data Indikator KPI</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-success text-capitalize pull-right mt-3" data-toggle="modal" data-target="#modal-update" onclick="switchModal();">
                            Tambah indikator <?= $mod; ?>
                        </button>
                    </div>
                    </div>
                    <div class="box-body">
                        
                        <div class="nav-pills-warning">
                            <ul class="nav nav-tabs">
                                <?php foreach($gol2 as $gol) : if($gol['id'] == 9)  continue; ?>
                                <li class=" <?= $gol['id'] == 1 ? 'active' : '' ?>">
                                    <a href="#gol-<?= $gol['id'] ?>" data-toggle="tab" aria-expanded="false"><b><?= camelCaseToSpace($gol['golongan']) ?></b></a>
                                </li>
                                <?php endforeach ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach($gol2 as $gol) : ?>
                                <div class="tab-pane <?= $gol['id'] == 1 ? 'active' : '' ?>" id="gol-<?= $gol['id'] ?>">
                                    <div class="box-body  table-responsive mt-2">
                                        <table id="datatemplates_<?= $gol['id'] ?>" class="table table-borderless table-hover">
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

                                                        // Tambahkan kondisi untuk memeriksa tipe kualitatif dan level user
                                                        if ($kinerja['tipe'] == 'kualitatif' && !in_array($leveluser, ['superadmin', 'admin'])) {
                                                            continue;
                                                        }
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
                                                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-update" onclick="getDataKr(<?=$kinerja['id']?>, '<?=$kinerja['nama']?>','<?=$kinerja['recap']?>', <?= $kinerja['target'] ?>, <?= $kinerja['bobot'] ?>, <?= $kinerja['role_id'] ?>, '<?= $kinerja['tipe'] ?>', '<?= $kinerja['param_indikator'] ?>');"><i class="fa fa-pencil"></i></button> -->
                                                            <a href="<?= $aksi . "?module=kpi&act=hapus&id=" . $kinerja['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
                                                            <b><i class="fa fa-trash text-red"></i></b></a> &nbsp; 
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
            </div>

            <?php break; case "detail" : ?>
                <?php $testDatas = getDetailIndikByPegawai($_GET['id']); // echo json_encode($testDatas); ?>
                <div class="box box-warning">
                    <div class="box-header with-border mb-3 d-flex align-content-center">
                        <h3>Data KPI <?= camelCaseToSpace($testDatas[0]['nama']) ?></h3>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-12">
                                <table id="datatemplates_<?= $gol['id'] ?>" class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">No</th>
                                        <th>Indikator</th>
                                        <th>Recap</th>
                                        <th>Target</th>
                                        <th>Pencapaian</th>
                                        <th>Persen</th>
                                        <th>Bobot</th>
                                        <th>Score</th>
                                        <th>Final Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $totalFinalScore = 0;
                                        foreach($testDatas as $detail) {
                                            $totalFinalScore += $detail['final_score'];
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= camelCaseToSpace($detail['nama_kinerja']) ?></td>
                                            <td><?= $detail['recap'] ?></td>
                                            <td><?= $detail['target'] ?></td>
                                            <td><?= $detail['pencapaian'] ?></td>
                                            <td><?= konversiDecimalKePersen($detail['persen']) ?></td>
                                            <td><?= konversiDecimalKePersen($detail['bobot']) ?></td>
                                            <td><?= konversiDecimalKePersen($detail['score']) ?></td>
                                            <td><?= konversiDecimalKePersen($detail['final_score']) ?></td>
                                        </tr>
                                    <?php $no++; } ?>
                                    <tr>
                                        <td colspan="8" align="left"><strong><h3>Total Nilai KPI</h3></strong></td>
                                        <td><strong><h3><?= konversiDecimalKePersen($totalFinalScore) ?></strong></h3></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            </div>

                        </div>
                    </div>
                </div>
            <?php break; } ?>
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
                            <div class="form-group" id="dynamic-form-group">
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
    function switchModal()
    {
        $('.modal-title').text("Tambah Indikator");
        $('#updateForm').attr('action','modul/mod_kpi/kpi_aksi.php?module=kpi&act=input');
    }

    $(document).ready(function(){
    $('select#typeIndikator').on('change', function () {
        var selectedID = $(this).val(); console.log(selectedID);
        if(selectedID == 'kualitatif') {
            rmvElement = $('#dynamic-form-group');
            rmvElement.remove();
        }
        // $.ajax({
        //     url: 'modul/mod_kpi/kpi_aksi.php?module=kpi&act=get-param-indikator',
        //     type: 'POST',
        //     data: {
        //         id: selectedID
        //     },
        //     success: function (response) {
                
        //         // console.log(response);

        //         var form = document.getElementById('isi');
        //         form.innerHTML = response;
        //     }
        // });
    });
});
</script>