<?= $this->extend('layouts/page-layout.php') ?>

<?= $this->section('content') ?>

<?php
        
    $total_pembelian = 0;
    foreach (get_items_by_id_user(session()->get('id_user')) as $key => $value) {
        $total_pembelian += $value->total_harga_per_barang;
    }

    $presentasi_total_pembelian = $total_pembelian / 1000000;

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
                    <li class="breadcrumb-item"><a href="<?= route_to('customer_dashboard') ?>"><i class="zmdi zmdi-home"></i> Jastip</a></li>
                    <li class="breadcrumb-item active">Customer Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card tasks_report">
                    <div class="header">
                        <h2><strong>Total</strong> Pemesanan</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body text-center">
                        <h4 class="m-t-0">Total Pemesanan</h4>
                        <h6 class="m-b-20"><?= count(get_items_by_id_user(session()->get('id_user'))) ?> Item</h6>
                        <input type="text" class="knob total_pemesanan" data-width="140" data-height="140" data-thickness="0.1" data-fgColor="#00ced1" readonly>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card tasks_report">
                    <div class="header">
                        <h2><strong>Total</strong> Pembelian</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body text-center">
                        <h4 class="m-t-0">Total Pembelian</h4>
                        <h6 class="m-b-20">Rp. <?= format_rupiah($total_pembelian) ?></h6>
                        <input type="text" class="knob total_pembelian" value="66" data-width="140" data-height="140" data-thickness="0.1" data-fgColor="#00ced1" readonly>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card tasks_report">
                    <div class="header">
                        <h2><strong>Total</strong> Transaksi</h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body text-center">
                        <h4 class="m-t-0">Total Transaksi</h4>
                        <h6 class="m-b-20"><?= count(get_transaction_by_id_user(session()->get('id_user'))) ?> Transaksi</h6>
                        <input type="text" class="knob total_transaksi" value="100" data-width="140" data-height="140" data-thickness="0.1" data-fgColor="#00ced1" readonly>
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
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>

    $(document).ready(function () {
        $(".total_pemesanan").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= count(get_items_by_id_user(session()->get('id_user'))) ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".total_pemesanan").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });



        $(".total_pembelian").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= $presentasi_total_pembelian ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".total_pembelian").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });


        $(".total_transaksi").knob();
        $({
            animatedVal: 0
        }).animate({
            animatedVal: (<?= count(get_transaction_by_id_user(session()->get('id_user'))) ?>),
        }, {
            duration: 3000,
            easing: "swing",
            step: function() {
                $(".total_transaksi").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });
    });

</script>
<?= $this->endSection() ?>