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
                    <li class="breadcrumb-item active">Daftar Usaha Jastip atau Entrepreneur</li>
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
                        <h2><strong>Daftar Usaha Jastip atau</strong> Entrepreneur </h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                    data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i
                                        class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addModal">Tambah Usaha Jastip atau Entrepreneur</a></li>
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
                                        <th>Nama Jastip</th>
                                        <th>Tanggal Approve Jastip</th>
                                        <th>Item</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= get_user_by_id($value->id_user)['nama_lengkap'] ?></td>
                                            <td><?= $value->updated_at ?></td>
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
                                            <td>
                                                <?php
                                                    $items = explode("-", $value->id_item);
                                                    for ($i=0; $i < 1; $i++) { 
                                                        foreach (get_items_by_id($items[0]) as $key2 => $value2) { ?>
                                                            <?php if($value2->status != 12){ ?>
                                                                <a href="<?= route_to('admin_courier_service_check', $value->kode_seleksi) ?>" class="btn btn-sm btn-info">Cek Rekomndasi</a>
                                                            <?php }else if($value2->status == 12){ ?>
                                                                Rekomendasi : <span style="font-weight: bold;"><?= get_department_store_by_id(get_rating_by_code_selection($value->kode_seleksi)['kode_department_store'])['nama_department_store'] ?></span>
                                                                <a href="<?= route_to('admin_courier_service_check', $value->kode_seleksi) ?>" class="btn btn-sm btn-info">Detail Rekomendasi</a>
                                                            <?php } ?>
                                                        <?php }
                                                    }
                                                ?>
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

<?= $this->endSection() ?>
