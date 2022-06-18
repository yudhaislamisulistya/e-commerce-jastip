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
                    <li class="breadcrumb-item active">Daftar Nilai Prefensi</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Daftar</strong> Nilai Prefensi </h2>
                        <ul class="header-dropdown">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (get_criterias() as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $value->kode_kriteria ?></td>
                                            <td>
                                                <?= $value->nama_kriteria ?>
                                                <ol>
                                                    <?php foreach (get_sub_criterias_with_code_criteria($value->kode_kriteria) as $key2 => $value2) { ?>
                                                        <li><?= $value2->nama_sub_kriteria ?> | Bobot <?= $value2->bobot ?> | <?= $value2->kode_sub_kriteria ?></li>
                                                    <?php } ?>
                                                </ol>
                                            </td>
                                            <td><?= $value->bobot ?></td>
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
