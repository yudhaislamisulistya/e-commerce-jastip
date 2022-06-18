<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>


<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard
                    <small class="text-muted">Welcome to Jastip</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="<?= route_to('admin_dashboard') ?>"><i
                                class="zmdi zmdi-home"></i> Jastip</a></li>
                    <li class="breadcrumb-item active">Daftar Kriteria</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <?php if(isset($validation)) : ?>
                    <div class=col-12>
                        <div class="alert alert-danger alert-dismissable alert-style-1">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="zmdi zmdi-block"></i><?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(session()->getFlashData('status') == "success"){ ?>
                    <div class="alert alert-success alert-dismissable alert-style-1">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="zmdi zmdi-check"></i>Proses Berhasil
                    </div>
                    <?php }else if(session()->getFlashData('status') == "failed"){ ?>
                    <div class="alert alert-danger alert-dismissable alert-style-1">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="zmdi zmdi-info-outline"></i>Proses Gagal
                    </div>
                <?php }?>
                <div class="card">
                    <div class="header">
                        <h2><strong>Daftar</strong> Kriteria </h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                    data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i
                                        class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addModal">Tambah Kriteria</a></li>
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addModal2">Tambah Sub Kriteria</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Kode Kriteria</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $value->kode_kriteria ?></td>
                                            <td>
                                                <?= $value->nama_kriteria ?>
                                                <ol>
                                                    <?php foreach (get_sub_criterias_with_code_criteria($value->kode_kriteria) as $key2 => $value2) { ?>
                                                        <li><?= $value2->nama_sub_kriteria ?> | Bobot <?= $value2->bobot ?> | <?= $value2->kode_sub_kriteria ?> | <a href="#" class="text-info btn-edit2" data-id="<?= $value2->id_sub_kriteria ?>" data-kode-sub-kriteria="<?= $value2->kode_sub_kriteria ?>" data-nama-sub-kriteria="<?= $value2->nama_sub_kriteria ?>" data-bobot="<?= $value2->bobot ?>" data-kode-kriteria="<?= $value2->kode_kriteria ?>">Edit</a> | <a href="#" class="text-danger btn-delete2" data-id="<?= $value2->id_sub_kriteria ?>">Delete</a></li>
                                                    <?php } ?>
                                                </ol>
                                            </td>
                                            <td><?= $value->bobot ?></td>
                                            <td>
                                                <?php if($value->keterangan == 1){ ?>
                                                    Cost
                                                <?php }else if($value->keterangan == 2){ ?>
                                                    Benefit
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-edit"
                                                        data-id="<?= $value->id_kriteria;?>"
                                                        data-kode-kriteria="<?= $value->kode_kriteria?>"
                                                        data-nama-kriteria="<?= $value->nama_kriteria?>"
                                                        data-bobot="<?= $value->bobot ?>"
                                                        data-keterangan="<?= $value->keterangan ?>">Edit</a>
                                                <a href=" #" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="<?= $value->id_kriteria?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

    <!-- Modal Add Daftar Barang-->
    <form action="<?= route_to('admin_criteria_save') ?>" method="post">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Kriteria</label>
                            <input type="text" class="form-control" name="kode_kriteria"
                                placeholder="Kode Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama_kriteria"
                                placeholder="Nama Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="number" class="form-control" name="bobot"
                                placeholder="Bobot">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <select name="keterangan" class="form-control">
                                <option value="1">Cost</option>
                                <option value="2">Benefit</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Daftar Barang-->

    <!-- Modal Edit Daftar Barang-->
    <form action="<?= route_to('admin_criteria_update') ?>" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Kriteria</label>
                            <input type="text" class="form-control kode_kriteria" name="kode_kriteria"
                                placeholder="Kode Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input type="text" class="form-control nama_kriteria" name="nama_kriteria"
                                placeholder="Nama Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="number" class="form-control bobot" name="bobot"
                                placeholder="Bobot">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <select name="keterangan" class="form-control keterangan">
                                <option value="1">Cost</option>
                                <option value="2">Benefit</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_kriteria" class="id_kriteria">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Daftar Barang-->

    <!-- Modal Delete Category-->
    <form action="<?= route_to('admin_criteria_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kriteria Ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menghapus Kriteria Ini ?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_kriteria" class="id_kriteria">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->


    <!-- Bagian Modal Untuk Sub Kriteria -->
    <!-- Modal Add Daftar Barang-->
    <form action="<?= route_to('admin_sub_criteria_save') ?>" method="post">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sub Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kriteria</label>
                            <select name="kode_kriteria" id="kode_kriteria" class="form-control">
                                <?php foreach (get_criterias() as $key => $value) { ?>
                                    <option value="<?= $value->kode_kriteria ?>"><?= $value->kode_kriteria ?> | <?= $value->nama_kriteria ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Sub Kriteria</label>
                            <input type="text" class="form-control" name="kode_sub_kriteria"
                                placeholder="Kode Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input type="text" class="form-control" name="nama_sub_kriteria"
                                placeholder="Nama Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="number" class="form-control" name="bobot"
                                placeholder="Bobot">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Daftar Barang-->
    <!-- Modal Edit Daftar Barang-->
    <form action="<?= route_to('admin_sub_criteria_update') ?>" method="post">
        <div class="modal fade" id="editModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kriteria</label>
                            <select name="kode_kriteria" id="kode_kriteria" class="form-control kode_kriteria">
                                <?php foreach (get_criterias() as $key => $value) { ?>
                                    <option value="<?= $value->kode_kriteria ?>"><?= $value->kode_kriteria ?> | <?= $value->nama_kriteria ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kode Sub Kriteria</label>
                            <input type="text" class="form-control kode_sub_kriteria" name="kode_sub_kriteria"
                                placeholder="Kode Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input type="text" class="form-control nama_sub_kriteria" name="nama_sub_kriteria"
                                placeholder="Nama Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="number" class="form-control bobot" name="bobot"
                                placeholder="Bobot">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_sub_kriteria" class="id_sub_kriteria">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Daftar Barang-->
    <!-- Modal Delete Category-->
    <form action="<?= route_to('admin_sub_criteria_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Sub Kriteria Ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menghapus Sub Kriteria Ini ?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_sub_kriteria" class="id_sub_kriteria">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->
    <!-- Akhir Bagian Untuk Modal Sub Kriteria -->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function () {
        // Khusus Untuk Kriteria
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            const kode_kriteria = $(this).data('kode-kriteria');
            const nama_kriteria = $(this).data('nama-kriteria');
            const bobot = $(this).data('bobot');
            const keterangan = $(this).data('keterangan');
            $('.id_kriteria').val(id);
            $('.kode_kriteria').val(kode_kriteria);
            $('.nama_kriteria').val(nama_kriteria);
            $('.bobot').val(bobot);
            $('.keterangan').val(keterangan);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('.id_kriteria').val(id);
            $('#deleteModal').modal('show');
        });

        // Khusus Untuk Sub Kriteria

        $('.btn-edit2').on('click',function(){
            const id = $(this).data('id');
            const kode_kriteria = $(this).data('kode-kriteria');
            const kode_sub_kriteria = $(this).data('kode-sub-kriteria');
            const nama_sub_kriteria = $(this).data('nama-sub-kriteria');
            const bobot = $(this).data('bobot');
            $('.id_sub_kriteria').val(id);
            $('.kode_kriteria').val(kode_kriteria);
            $('.kode_sub_kriteria').val(kode_sub_kriteria);
            $('.nama_sub_kriteria').val(nama_sub_kriteria);
            $('.bobot').val(bobot);
            $('#editModal2').modal('show');
        });

        $('.btn-delete2').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('.id_sub_kriteria').val(id);
            $('#deleteModal2').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>