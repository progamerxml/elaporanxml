<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = '../../index.php'</script>";
} // Apabila user sudah login dengan benar, maka terbentuklah session
else {
    $aksi = "modul/mod_role/role_aksi.php";
    require __DIR__ . "/role_aksi.php";

    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $mod = $_GET['module'];

    $roles = getRole();
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-update" onclick="switchModal();">
                                    Tambah Role
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
                                <th style="width: 27%;" >Kode</th>
                                <th>Nama</th>
                                <th style="width: 6%;">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($roles as $role){
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $role['kode'] ?></td>
                                        <td><?= $role['nama'] ?></td>
                                        <td align="center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-update" onclick="getDataKr('<?=$role['kode']?>', '<?=$role['nama'] ?>', <?=$role['id']?>);"><i class="fa fa-pencil"></i></button>
                			                <a type="button" class="btn btn-danger"  href="<?= $aksi . "?module=role&act=hapus&id=" . $role['id'] ?>" onclick="return confirm('APAKAH ANDA YAKIN AKAN MENGHAPUS DATA INI ?')" title="Hapus Data">
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
                        
                    <form role="form" id="updateForm" action="<?=$aksi?>?module=role&act=update" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kodeRole">Kode Role</label>
                            <input type="hidden" name="id" id="idRole">
                            <input type="text" class="form-control" id="kodeRole" name="kode" placeholder="Kode Role">
                        </div>
                        <div class="form-group">
                            <label for="namaRole">Nama Role</label>
                            <input type="text" class="form-control" id="namaRole" name="nama" placeholder="Nama Role">
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
    function getDataKr(kode, nama, id) {
    // Isi nilai input pada modal dengan data yang diambil dari tabel
    $('#idRole').val(id);
    $('#kodeRole').val(kode);
    $('#namaRole').val(nama);
    }

    // Reset nilai input pada modal setelah modal ditutup
    $('#modal-update').on('hidden.bs.modal', function () {
        $('#kodeRole').val('');
        $('#namaRole').val('');
    });

    function switchModal()
    {
        $('.modal-title').text("Tambah Role");
        $('#updateForm').attr('action','modul/mod_role/role_aksi.php?module=role&act=input');
    }
</script>