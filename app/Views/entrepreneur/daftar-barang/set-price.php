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
                <form action="<?= route_to('entrepreneur_selection_set_price_save') ?>" method="post">
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
                                $items = explode("-", $id_items);
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
                                    <input type="number" class="form-control" onkeyup="totalHarga(<?= $i ?>, <?= $value->jumlah_beli ?>, <?= count($items) ?>)" id="harga_barang[<?= $i ?>]" name="harga_barang[<?= $i ?>]" placeholder="Masukkan Harga Barang">
                                </div>
                                <div class="form-group">
                                    <label>Total Harga Per Barang</label>
                                    <input placeholder="Rp. 0" type="text" class="form-control" id="total_harga_per_barang[<?= $i ?>]" name="total_harga_per_barang[<?= $i ?>]" readonly>
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
                                <input type="text" class="form-control" id="total_jumlah_beli" name="total_jumlah_beli" placeholder="0" readonly>
                            </div>
                            <div class="form-group">
                                <label>Total Harga Barang</label>
                                <input type="text" class="form-control" id="total_harga_barang" name="total_harga_barang" placeholder="0" readonly>
                            </div>
                            <div class="form-group">
                                <label>Biaya Pengiriman</label>
                                <input type="number" onkeyup="setTotalFinal(this)" class="form-control" name="biaya_pengiriman" id="biaya_pengiriman" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label>Total Final</label>
                                <input type="text" class="form-control " name="total_final" id="total_final" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label class="badge badge-info">Rekomendasi Department Store atau Swalayan Berdasarkan Kriteria</label>
                                <input type="text" class="form-control " name="department_store_recomendation" placeholder="0" value="<?= get_name_recomendation_department_store_by_id_items($id_items) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Catatan Jastip</label>
                                <textarea name="catatan_jastip" name="catatan_jastip" class="form-control" cols="30" rows="10" placeholder="Masukkan Catatan Dibawah Ini Seperti (Nomor Resi, Nomor Handphone dan Lain-Lain)"></textarea>
                            </div>
                            <input type="hidden" name="id_items" value="<?= $id_items ?>">
                            <button class="btn btn-info">Kirim Ke Pemesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>



<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function totalHarga(key, jumlah_beli, jumlah_pesanan){
        var harga_barang = $('input[id="harga_barang['+key+']"]').val();
        var sumTotal = harga_barang * jumlah_beli;
        $('input[id="total_harga_per_barang['+key+']"]').val(formatRupiah(sumTotal.toString(), 'Rp. '));
        var total_jumlah_beli = 0;
        var total_harga_barang = 0;
        for (let index = 0; index < jumlah_pesanan; index++) {
            total_jumlah_beli = total_jumlah_beli + parseInt($('input[id="jumlah_beli['+index+']"]').val());
            total_harga_barang = total_harga_barang + parseInt(unFormatRupiah($('input[id="total_harga_per_barang['+index+']"]').val()));
        }
        $('#total_jumlah_beli').val(total_jumlah_beli);
        $('#total_harga_barang').val(formatRupiah(total_harga_barang.toString(), 'Rp. '));

    }

    function setTotalFinal(elm){
        var biaya_pengiriman = $(elm).val();
        var total_harga_barang = parseInt(unFormatRupiah($('#total_harga_barang').val()));
        console.log(biaya_pengiriman);
        var total_final = total_harga_barang + parseInt(biaya_pengiriman);
        $('#total_final').val(formatRupiah(total_final.toString(), 'Rp. '));
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function unFormatRupiah(angka) {
        var result = angka.replace(/[^0-9 ]/g, "");
        return result;
    }

</script>
<?= $this->endSection() ?>
