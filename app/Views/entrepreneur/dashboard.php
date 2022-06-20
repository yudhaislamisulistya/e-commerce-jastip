<?= $this->extend('layouts/page-layout.php') ?>

<?= $this->section('content') ?>
<?php
        
    $total_penjualan = 0;
    foreach (get_items_by_status(14) as $key => $value) {
        $total_penjualan += $value->total_harga_per_barang;
    }

    $presentasi_total_penjualan = $total_penjualan / 1000000;

    $transaksi_berhasil = 0;
    if(get_items()){
        $transaksi_berhasil = (count(get_items_by_status(14)) / count(get_items())) * 100;
    }

?>
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
                    <li class="breadcrumb-item"><a href="<?= route_to('entrepreneur_dashboard') ?>"><i class="zmdi zmdi-home"></i> Jastip</a></li>
                    <li class="breadcrumb-item active">Pengusaha Jastip Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card tasks_report">
                    <div class="header">
                        <h2><strong>Total</strong> Penjualan</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body text-center">
                        <h4 class="m-t-0">Total Penjualan</h4>
                        <h6 class="m-b-20">Rp. <?= format_rupiah($total_penjualan) ?></h6>
                        <input type="text" class="knob total_penjualan" value="66" data-width="140" data-height="140" data-thickness="0.1" data-fgColor="#00ced1" readonly>
                        <h6 class="m-t-50">Rate Kepuasan</h6>
                        <small class="displayblock"><?= $transaksi_berhasil ?>% Transaksi Berhasil</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="header">
                        <h2><strong>Total</strong> Penghasilan</h2>                        
                    </div>
                    <div class="body">
                        <h3 class="m-b-0">Rp. <?= format_rupiah($total_penjualan) ?></h3>
                        <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)" data-spot-Color="rgb(63, 81, 181, 0.7)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)"
                        data-fill-Color="rgba(221,94,137, 0.2)"> 1,2,3,1,4,3,6,4,4,1 </div>                        
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Total</strong> Transaksi</h2>                        
                    </div>
                    <div class="body">
                        <h3 class="m-b-0"><?= count(get_items()) ?></h3>
                        <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)"
                        data-fill-Color="rgba(128,133,233, 0.2)"> 4,5,2,8,4,8,7,4,8,5</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="header">
                        <h2><strong>Total</strong> Swalayan</h2>                        
                    </div>
                    <div class="body">
                        <h3 class="m-b-0"><?= count(get_department_store()) ?></h3>
                        <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)"
                        data-fill-Color="rgba(44,168,255, 0.2)">1,5,9,3,5,7,8,5,2,3,5,7</div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Total</strong> Pembeli</h2>                        
                    </div>
                    <div class="body">
                        <h3 class="m-b-0"><?= count(get_buyer_from_items()) ?></h3>
                        <div class="sparkline" data-type="line" data-spot-Radius="1" data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(120, 184, 62)" data-spot-Color="rgb(63, 81, 181, 0.7)"
                        data-offset="90" data-width="100%" data-height="60px" data-line-Width="1" data-line-Color="rgb(63, 81, 181, 0.7)"
                        data-fill-Color="rgba(0,0,0, 0.2)">8,6,4,2,3,6,5,7,9,8,5,2</div>
                    </div>
                </div>
            </div>                
        </div>
        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Transaksi</strong> Terbaru</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive members_profiles">
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
                                                    <td><?= $j; ?></td>
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
                                                            <button class="btn btn-sm btn-secondary">Menunggu Approve Admin</button>
                                                        <?php }else if($value2->status == 12){ ?>
                                                            <a href="<?= route_to('entrepreneur_selection_set_price', $value->id_item) ?>" class="btn btn-primary btn-sm">Set Biaya</a>
                                                        <?php }else if($value2->status == 13){ ?>
                                                            <span class="badge badge-danger">Pembayaran Berhasil</span>
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
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>

    $(document).ready(function () {
        $(".total_penjualan").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= $presentasi_total_penjualan ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".total_penjualan").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });
    });

</script>
<?= $this->endSection() ?>