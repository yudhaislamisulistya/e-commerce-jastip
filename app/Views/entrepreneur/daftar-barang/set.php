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
                    <li class="breadcrumb-item active">Set atau Persetujuan Pemilihan Barang</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Daftar</strong> Pesanan </h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?php
                            $id_items = ""; 
                        ?>
                        <?php foreach (get_items_status_accept_by_id_user($id_user) as $key => $value) { ?>
                            <div class="form-group">
                                <label>Nama Pemesanan</label>
                                <input type="text" class="form-control" value="<?= get_user_by_id($id_user)['nama_lengkap'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" value="<?= $value->nama_barang ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Beli</label>
                                <input type="text" class="form-control" value="<?= $value->jumlah_beli ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <input type="text" class="form-control" value="<?= $value->catatan ?>" disabled>
                            </div>
                        <?php
                            if($key == 0){
                                $id_items .= $value->id_item; 
                            }else{
                                $id_items .= '-' . $value->id_item; 

                            }
                            } 
                        ?>
                    </div>
                    <div class="header">
                        <h2><strong>Penentuan Kriteria</strong> Pada Toko Swalayan </h2>
                    </div>
                    <div class="body">
                        <form action="<?= route_to('entrepreneur_selection_save') ?>" method="post">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Toko Swalayan</th>
                                            <?php foreach (get_criterias() as $key => $value) { ?>
                                                <th><?= $value->nama_kriteria ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $key => $value) { ?>
                                            <tr>
                                                <td><?= $value->kode_department_store ?></td>
                                                <td><?= $value->nama_department_store ?></td>
                                                <?php foreach (get_criterias() as $key2 => $value2) { ?>
                                                    <td>
                                                        <select name="sub_criterias[<?= $key ?>][<?= $key2 ?>]" class="form-control">
                                                            <?php foreach (get_sub_criterias_with_code_criteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                                <option value="<?= $value3->bobot ?>-<?= $value3->kode_kriteria ?>-<?= $value3->kode_sub_kriteria ?>"><?= $value3->nama_sub_kriteria ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <input type="hidden" name="kode_department_store[<?= $key ?>]" value="<?= $value->kode_department_store ?>">
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="id_user" value="<?= $id_user ?>">
                            <input type="hidden" name="id_items" value="<?= $id_items ?>">
                            <button class="btn btn-primary btn-save">Save</button>
                            <div class="alert alert-danger" role="alert">
                                <strong>Perhatian! Data Yang Sudah di Submit Tidak Dapat Dikembalikan</strong>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>



<?= $this->endSection() ?>
