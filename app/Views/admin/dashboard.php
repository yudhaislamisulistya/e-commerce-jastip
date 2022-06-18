<?= $this->extend('layouts/page-layout.php') ?>

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
                    <li class="breadcrumb-item"><a href="<?= route_to('admin_dashboard') ?>"><i class="zmdi zmdi-home"></i> Jastip</a></li>
                    <li class="breadcrumb-item active">Admin Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card widget_2">
            <ul class="row clearfix list-unstyled m-b-0">
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Usaha Jastip</h5>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class=""><?= count(get_user_by_role(2)) ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Swalayan</h5>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class=""><?= count(get_department_store()) ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Kriteria</h5>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class=""><?= count(get_criterias()) ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Transaksi</h5>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class=""><?= count(get_items()) ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob pending_payment" value="66" data-width="90" data-height="90"
                            data-thickness="0.1" data-fgColor="#666" readonly>
                        <h6 class="m-t-20">Pending Payment</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob cancel_payment" value="26" data-width="90" data-height="90"
                            data-thickness="0.1" data-fgColor="#7b69ec" readonly>
                        <h6 class="m-t-20">Cencel Payment</h6>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob success_payment" value="76" data-width="90" data-height="90"
                            data-thickness="0.1" data-fgColor="#f9bd53" readonly>
                        <h6 class="m-t-20">Success Payment</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 col-lg-12">
                <div class="card project_list">
                    <div class="header">
                        <h2><strong>List</strong> Swalayan</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Kode Alternatif</th>
                                        <th>Nama Alternatif / Department Store</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (get_department_store() as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $value->kode_department_store ?></td>
                                            <td><?= $value->nama_department_store ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>

    $(document).ready(function () {
        $(".pending_payment").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= count(get_transaction_by_status('pending')) ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".pending_payment").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });



        $(".cancel_payment").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= count(get_transaction_by_status('cancel')) ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".cancel_payment").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });


        $(".success_payment").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= count(get_transaction_by_status('settlement')) ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".success_payment").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });
    });

</script>
<?= $this->endSection() ?>