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
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addModal">Request Barang</a></li>
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
                                    <?php foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
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
                                                <?php }else if($value->status == 13){ ?>
                                                    <span class="badge badge-warning">Menunggu Pembayaran</span>
                                                <?php }else if($value->status == 2){ ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php }else if($value->status == 3){ ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php } ?>
                                            </td>
                                            <td><?= $value->created_at ?></td>
                                            <td><?= $value->updated_at ?></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-edit"
                                                        data-id="<?= $value->id_item;?>"
                                                        data-nama-barang="<?= $value->nama_barang?>"
                                                        data-jumlah-beli="<?= $value->jumlah_beli?>"
                                                        data-catatan="<?= $value->catatan?>">Edit</a>
                                                <a href=" #" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="<?= $value->id_item?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="header">
                        <h2><strong>Daftar Pembayaran</strong> Barang </h2>
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
                                        <th>Daftar Barang</th>
                                        <th>Total Jumlah Beli</th>
                                        <th>Total Harga Barang</th>
                                        <th>Catatan Jastip</th>
                                        <th>Rekomendasi Swalayan</th>
                                        <th>Status Pembayaran</th>
                                        <th>Tanggal Request</th>
                                        <th>Tanggal Update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (get_selection_by_code_selection_and_id_user(session()->get('id_user')) as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td>
                                                <?php
                                                    $items = explode("-", $value->id_item);
                                                    for ($i=0; $i < count($items); $i++) { 
                                                        foreach (get_items_by_id($items[$i]) as $key2 => $value2) { ?>
                                                        
                                                        <ul >
                                                            <li>Nama Pelanggan : <?= get_user_by_id($value2->id_user)['nama_lengkap'] ?></li>
                                                            <li>Nama Barang : <?= $value2->nama_barang ?></li>
                                                            <li>Jumlah Beli : <?= $value2->jumlah_beli ?></li>
                                                            <li>Catatan : <?= $value2->catatan ?></li>
                                                        </ul>
                                                        
                                                        <?php }
                                                    }
                                                ?>
                                            </td>
                                            <td><?= get_purchase_by_id_item($value->id_item)['total_jumlah_beli'] ?></td>
                                            <td><?= get_purchase_by_id_item($value->id_item)['total_harga_barang'] ?></td>
                                            <td><?= get_purchase_by_id_item($value->id_item)['catatan_jastip'] ?></td>
                                            <td><?= get_purchase_by_id_item($value->id_item)['department_store_recomendation'] ?></td>
                                            <td>
                                                <?php if(get_purchase_by_id_item($value->id_item)['status'] == 1) {?>
                                                    <span class="badge badge-danger">Menunggu Pembayaran</span>
                                                <?php }else if(get_purchase_by_id_item($value->id_item)['status'] == 3){?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php }else if(get_purchase_by_id_item($value->id_item)['status'] == 2){?>
                                                    <span class="badge badge-info">Pembayaran Berhasil</span>
                                                    <?php
                                                        $status = '';
                                                        if(get_transaction_by_id(get_purchase_by_id_item($value->id_item)['transaction_id'])['transaction_status'] == "pending"){
                                                            $status = "<span class='badge badge-warning'>Pending (Menunggu Pembayaran)</span>";
                                                        }else if(get_transaction_by_id(get_purchase_by_id_item($value->id_item)['transaction_id'])['transaction_status'] == "settlement"){
                                                            $status = "<span class='badge badge-success'>Success (Berhasil)</span>";
                                                        }else if(get_transaction_by_id(get_purchase_by_id_item($value->id_item)['transaction_id'])['transaction_status'] == "cancel"){
                                                            $status = "<span class='badge badge-danger'>Cancel (Pembayaran Dibatalkan)</span>";
                                                        }else if(get_transaction_by_id(get_purchase_by_id_item($value->id_item)['transaction_id'])['transaction_status'] == "expire"){
                                                            $status = "<span class='badge badge-warning'>Expired (Waktu Pembayaran Berakhir)</span>";
                                                        }else{
                                                            $status = "<span>Alasan lain...</span>";
                                                        }
                                                        echo $status;
                                                    ?>
                                                <?php }?>
                                            </td>
                                            <td><?= get_purchase_by_id_item($value->id_item)['created_at'] ?></td>
                                            <td><?= get_purchase_by_id_item($value->id_item)['updated_at'] ?></td>
                                            <td>
                                                <?php if(get_purchase_by_id_item($value->id_item)['status'] == 1) {?>
                                                    <a href="<?= route_to('customer_daftar_barang_detail_pesanan', $value->id_item) ?>" class="btn btn-info">Detail Pesanan</a>
                                                <?php }else if(get_purchase_by_id_item($value->id_item)['status'] == 3){?>
                                                    <a href="<?= route_to('customer_daftar_barang_detail_pesanan', $value->id_item) ?>" class="btn btn-info">Detail Pesanan</a>
                                                <?php }else if(get_purchase_by_id_item($value->id_item)['status'] == 2){?>
                                                    <button class="btn btn-secondary">...</button>
                                                <?php }?>
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
    <form action="<?= route_to('customer_item_save') ?>" method="post">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Barang Yang Diinginkan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang"
                                placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Beli</label>
                            <input type="number" class="form-control" name="jumlah_beli"
                                placeholder="Jumlah Beli">
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" cols="30" rows="10" class="form-control" placeholder="Catatan Anda"></textarea>
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
    <form action="<?= route_to('customer_item_update') ?>" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Daftar Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control nama_barang" name="nama_barang"
                                placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Beli</label>
                            <input type="number" class="form-control jumlah_beli" name="jumlah_beli"
                                placeholder="Jumlah Beli">
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" cols="30" rows="10" class="form-control catatan" placeholder="Catatan Anda"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" class="id_item">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Daftar Barang-->

    <!-- Modal Delete Category-->
    <form action="<?= route_to('customer_item_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Barang ini ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menghapus Barang Ini?</h4>

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

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function () {
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            const nama_barang = $(this).data('nama-barang');
            const jumlah_beli = $(this).data('jumlah-beli');
            const catatan = $(this).data('catatan');
            console.log(nama_barang);
            $('.id_item').val(id);
            $('.nama_barang').val(nama_barang);
            $('.jumlah_beli').val(jumlah_beli);
            $('.catatan').val(catatan);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('.id_item').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>