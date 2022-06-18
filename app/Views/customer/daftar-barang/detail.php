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
                                $items = explode("-", $data['id_items']);
                            ?>
                            <?php 
                            for ($i=0; $i < count($items); $i++) { 
                                foreach (get_items_by_id($items[$i]) as $key => $value) { 
                            ?>
                                <h3>Pesanan Ke <?= $i + 1 ?></h3>
                                <div class="form-group">
                                    <label>Nama Pemesanan</label>
                                    <input type="text" class="form-control" value="<?= get_user_by_id($value->id_user)['nama_lengkap'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" value="<?= $value->nama_barang ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Beli</label>
                                    <input type="text" class="form-control" id="jumlah_beli[<?= $i ?>]" value="<?= $value->jumlah_beli ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <input type="text" class="form-control"  value="<?= $value->catatan ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Harga Barang" value="<?= $value->harga_barang ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Total Harga Per Barang</label>
                                    <input placeholder="Rp. 0" type="text" class="form-control" readonly value="<?= $value->total_harga_per_barang ?>" readonly>
                                </div>
                            <?php
                                }
                            } 
                            ?>
                        </div>
                        <div class="header">
                            <h2><strong>Ringkasan </strong> Pesanan </h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <label>Total Jumlah Beli</label>
                                <input type="text" class="form-control" id="total_jumlah_beli" name="total_jumlah_beli" placeholder="0" readonly value="<?= $data['total_jumlah_beli'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Total Harga Barang</label>
                                <input type="text" class="form-control" id="total_harga_barang" name="total_harga_barang" placeholder="0" readonly value="<?= $data['total_harga_barang'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Biaya Pengiriman</label>
                                <input type="number" onkeyup="setTotalFinal(this)" class="form-control" name="biaya_pengiriman" id="biaya_pengiriman" placeholder="0" value="<?= $data['biaya_pengiriman'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Total Final</label>
                                <input type="text" class="form-control " name="total_final" id="total_final" placeholder="0" value="<?= (int)$data['total_harga_barang'] + (int)$data['biaya_pengiriman'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="badge badge-info">Rekomendasi Department Store atau Swalayan Berdasarkan Kriteria</label>
                                <input type="text" class="form-control " name="department_store_recomendation" placeholder="0" value="<?= get_name_recomendation_department_store_by_id_items($data['id_items']) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Catatan Jastip</label>
                                <textarea readonly name="catatan_jastip" name="catatan_jastip" class="form-control" cols="30" rows="10" placeholder="Masukkan Catatan Dibawah Ini Seperti (Nomor Resi, Nomor Handphone dan Lain-Lain)"><?= $data['catatan_jastip'] ?></textarea>
                            </div>
                            <button class="btn btn-warning" id="pay-button">Bayar Sekarang</button>
                        </div>
                    </div>
            </div>
        </div>
</section>



<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-1f-GtP1qmtyHm6jr"></script>
<script src="<?= base_url() ?>/assets/js/axios.js"></script>
<script>
        HOST_URL = "http://localhost:8080"
        document.getElementById('pay-button').onclick = function () {
            snap.pay('<?=$snapToken?>', {
                onSuccess: function (result) {
                    result['id_items'] = (<?= $id_items_new ?>)
                    console.log(result);
                    axios.post(HOST_URL + "/customer/daftar-barang/update-purchase", result)
                    .then(res => {
                        console.log(res.data)
                        window.location.href = "/customer/daftar-barang";
                    })
                    .catch(err => {
                        console.error(err); 
                    })
                },
                // Optional
                onPending: function (result) {
                    console.log('masuk disini');
                    result['id_items'] = (<?= $id_items_new ?>)
                    console.log(result);
                    axios.post(HOST_URL + "/customer/daftar-barang/update-purchase", result)
                    .then(res => {
                        console.log(res.data)
                        window.location.href = '/customer/daftar-barang';
                    })
                    .catch(err => {
                        console.error(err); 
                    })
                },
                onError: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
</script>
<?= $this->endSection() ?>
