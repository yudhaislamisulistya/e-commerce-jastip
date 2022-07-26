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
                    <li class="breadcrumb-item"><a href="<?= route_to('customer_dashboard') ?>"><i
                                class="zmdi zmdi-home"></i> Jastip</a></li>
                    <li class="breadcrumb-item active">Daftar Barang</li>
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
                        <h2><strong>Daftar Permintaan</strong> Barang </h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                    data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i
                                        class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addModal">Request </a></li>
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
                                        <th>Nama Pemesan</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Beli</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th>Tanggal Request</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $items = "";
                                    ?>
                                    <?php foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= get_user_by_id($value->id_user)['nama_lengkap'] ?></td>
                                            <td><?= $value->nama_barang ?></td>
                                            <td><?= $value->jumlah_beli ?></td>
                                            <td><?= $value->catatan ?></td>
                                            <td>
                                                <?php if($value->status == 1){ ?>
                                                    <span class="badge badge-success">Diterima</span>
                                                <?php }else if($value->status == 11){ ?>
                                                    <span class="badge badge-success">Diterima Dan Telah Diset Kriteria</span>
                                                <?php }else if($value->status == 12){ ?>
                                                    <span class="badge badge-success">Diterima Dan Approve Oleh Admin</span>
                                                <?php }else if($value->status == 2){ ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php }else if($value->status == 3){ ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php } ?>
                                            </td>
                                            <td><?= $value->created_at ?></td>
                                            <td><?= $value->updated_at ?></td>
                                            <td>
                                                <?php if($value->status == 1){ ?>
                                                    <a href="<?= route_to('entrepreneur_selection_index', $value->id_user) ?>" class="btn btn-primary btn-sm">Set</a>
                                                <?php }else if($value->status == 11){ ?>
                                                    <a href="<?= route_to('admin_courier_service_check', get_selection_by_id_item($value->id_item)['kode_seleksi']) ?>" class="btn btn-sm btn-info">Cek Rekomndasi</a>
                                                <?php }else if($value->status == 12){ ?>
                                                    <?php
                                                        $items .= $value->id_item;    
                                                    ?>
                                                    <a href="<?= route_to('entrepreneur_selection_set_price', $items) ?>" class="btn btn-primary btn-sm">Set Biaya</a>
                                                <?php }else if($value->status == 2){ ?>
                                                    <a href="#" class="btn btn-info btn-sm btn-accept" data-id="<?= $value->id_item ?>">Terima</a>
                                                    <a href=" #" class="btn btn-danger btn-sm btn-delete" data-id="<?= $value->id_item ?>">Tolak</a>
                                                <?php }else if($value->status == 3){ ?>
                                                    <a href="#" data-id="<?= $value->id_item ?>" class="btn btn-danger btn-sm btn-cancel">Batalkan</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="header">
                        <h2><strong>Daftar Approve </strong> Barang </h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?php if(isset($validation)) : ?>
                            <div class=col-12>
                                <div class="alert alert-danger alert-dismissable alert-style-1">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="zmdi zmdi-block"></i><?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(session()->getFlashData('status') == "success_set_price"){ ?>
                            <div class="alert alert-success alert-dismissable alert-style-1">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="zmdi zmdi-check"></i>Pesanan Berhasil Dibuat Oleh Jastip. Menunggu Pembayaran Oleh Pelanggan
                            </div>
                            <?php }else if(session()->getFlashData('status') == "failed_set_price"){ ?>
                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="zmdi zmdi-info-outline"></i>Gagal Membuat Pesanan
                            </div>
                        <?php }?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Pemesan</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Beli</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th>Tanggal Request</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $j = 1;
                                    ?>
                                    <?php foreach (get_selection_by_code_selection() as $key => $value) { ?>
                                        <?php
                                        $items = explode('-', $value->id_item);
                                        ?>
                                        <?php for ($i=0; $i < count($items); $i++) { ?> 
                                            <?php foreach (get_items_by_id($items[$i]) as $key2 => $value2) { ?>
                                                <tr>
                                                    <td><?= ($j) ?></td>
                                                    <td><?= get_user_by_id($value2->id_user)['nama_lengkap'] ?></td>
                                                    <td><?= $value2->nama_barang ?></td>
                                                    <td><?= $value2->jumlah_beli ?></td>
                                                    <td><?= $value2->catatan ?></td>
                                                    <td>
                                                        <?php if($value2->status == 1){ ?>
                                                            <span class="badge badge-success">Diterima</span>
                                                        <?php }else if($value2->status == 11){ ?>
                                                            <span class="badge badge-success">Diterima Dan Telah Diset Kriteria</span>
                                                        <?php }else if($value2->status == 12){ ?>
                                                            <span class="badge badge-success">Diterima Dan Approve Oleh Admin</span>
                                                        <?php }else if($value2->status == 13){ ?>
                                                            <span class="badge badge-warning">Menunggu Pembayaran Oleh Customer</span>
                                                        <?php }else if($value2->status == 14){ ?>
                                                            <span class="badge badge-warning">Pembayaran Berhasil Terverifikasi</span>
                                                        <?php }else if($value2->status == 2){ ?>
                                                            <span class="badge badge-warning">Pending</span>
                                                        <?php }else if($value2->status == 3){ ?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $value2->created_at ?></td>
                                                    <td><?= $value2->updated_at ?></td>
                                                    <td>
                                                        <?php if($value2->status == 1){ ?>
                                                            <a href="<?= route_to('entrepreneur_selection_index', $value2->id_user) ?>" class="btn btn-primary btn-sm">Set</a>
                                                        <?php }else if($value2->status == 11){ ?>
                                                            <a href="<?= route_to('admin_courier_service_check', $value->kode_seleksi) ?>" class="btn btn-sm btn-info">Cek Rekomndasi</a>
                                                        <?php }else if($value2->status == 12){ ?>
                                                            <a href="<?= route_to('entrepreneur_selection_set_price', $value->id_item) ?>" class="btn btn-primary btn-sm">Set Biaya</a>
                                                        <?php }else if($value2->status == 13){ ?>
                                                            <span class="badge badge-danger">Pembayaran Belum Berhasil</span>
                                                        <?php }else if($value2->status == 14){ ?>
                                                            <span class="badge badge-success">Pembayaran Berhasil</span>
                                                        <?php }else if($value2->status == 2){ ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-accept" data-id="<?= $value2->id_item ?>">Terima</a>
                                                            <a href=" #" class="btn btn-danger btn-sm btn-delete" data-id="<?= $value2->id_item ?>">Tolak</a>
                                                        <?php }else if($value2->status == 3){ ?>
                                                            <a href="#" data-id="<?= $value2->id_item ?>" class="btn btn-danger btn-sm btn-cancel">Batalkan</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $j++; } ?>
                                        <?php }?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


    <!-- Modal Delete Category-->
    <form action="<?= route_to('entrepreneur_item_reject') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Data Pesanan Ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Tolak Pesanan Ini ?</h4>
                        <span>Data Yang Ditolak, Tidak Dapat Dikembalikan</span>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" class="id_item">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->

    <!-- Modal Delete Category-->
        <form action="<?= route_to('entrepreneur_item_accept') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terima Data Pesanan Ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menerima Pesanan Ini ?</h4>
                        <span>Data Yang Menerima, Tidak Dapat Ditolak</span>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" class="id_item">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->

    <!-- Modal Delete Category-->
    <form action="<?= route_to('entrepreneur_item_cancel') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kembalikan Pesanan Ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Mengembalikan Pesanan Ini Ini ?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" class="id_item">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->

<?= $this->endSection() ?>

<?= $this->section('javascript')?>
<script>
    $('.btn-accept').click(function (e) { 
        e.preventDefault();
        const id = $(this).data('id');
        $('.id_item').val(id);
        $('#acceptModal').modal('show');
        
    });
    $('.btn-delete').click(function (e) { 
        e.preventDefault();
        const id = $(this).data('id');
        $('.id_item').val(id);
        $('#deleteModal').modal('show');
        
    });
    $('.btn-cancel').click(function (e) { 
        e.preventDefault();
        const id = $(this).data('id');
        $('.id_item').val(id);
        $('#cancelModal').modal('show');
        
    });
</script>
<?= $this->endSection() ?>