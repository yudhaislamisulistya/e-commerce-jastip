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
                                $id_items = get_selection_by_code_transaction($data['kode_seleksi'])['id_item'];
                                $items = explode("-", $id_items);
                            ?>
                            <?php 
                            for ($i=0; $i < count($items); $i++) { 
                                foreach (get_items_by_id($items[$i]) as $key => $value) { 
                            ?>
                                <div class="form-group">
                                    <label>Nama Pemesanan</label>
                                    <input type="text" class="form-control" value="<?= get_user_by_id($value->id_user)['nama_lengkap'] ?>" disabled>
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
                                }
                            } 
                            ?>
                        </div>
                        <div class="header">
                            <h2><strong>Penentuan Kriteria</strong> Pada Toko Swalayan </h2>
                        </div>
                        <div class="body">
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
                                        <?php foreach (get_department_store() as $key => $value) { ?>
                                            <tr>
                                                <td><?= $value->kode_department_store ?></td>
                                                <td><?= $value->nama_department_store ?></td>
                                                <?php foreach (get_criterias() as $key2 => $value2) { ?>
                                                    <td>
                                                        <?php foreach (get_sub_criterias_with_code_criteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                            <?php
                                                                if(get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                    $bobot = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                    $kode_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                    $kode_sub_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                    $nama_sub_kriteria = get_sub_criteria_by_code_marge($kode_gabungan)['nama_sub_kriteria']; 
                                                                    echo $bobot . ' / ' . $nama_sub_kriteria;
                                                                }
                                                            ?>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="header">
                            <h2><strong>Tahap</strong> Kedua : Normalisasi</h2>
                        </div>
                        <div class="body">
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
                                        <?php 
                                            $a_value_department_store = array();
                                            foreach (get_department_store() as $key => $value) { 
                                        ?>
                                                <?php foreach (get_criterias() as $key2 => $value2) { ?>
                                                        <?php foreach (get_sub_criterias_with_code_criteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                            <?php
                                                                if(get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                    $bobot = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                    $kode_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                    $kode_sub_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                    $nama_sub_kriteria = get_sub_criteria_by_code_marge($kode_gabungan)['nama_sub_kriteria']; 
                                                                    array_push($a_value_department_store, $bobot);
                                                                }
                                                            ?>
                                                        <?php } ?>
                                                <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_value_sub_kriteria = array();
                                            for ($i=0; $i < count(get_criterias()); $i++) { 
                                                for ($j=$i; $j < count(get_department_store())*count(get_criterias()); $j+=count(get_criterias())) {
                                                    $a_value_sub_kriteria[$i][$j] = $a_value_department_store[$j];
                                                }
                                            }
                                        ?>
                                        <?php foreach (get_department_store() as $key => $value) { ?>
                                            <tr>
                                                <td><?= $value->kode_department_store ?></td>
                                                <td><?= $value->nama_department_store ?></td>
                                                <?php foreach (get_criterias() as $key2 => $value2) { ?>
                                                    <td>
                                                        <?php foreach (get_sub_criterias_with_code_criteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                            <?php
                                                                if(get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                    $bobot = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                    $kode_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                    $kode_sub_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                    $nama_sub_kriteria = get_sub_criteria_by_code_marge($kode_gabungan)['nama_sub_kriteria']; 
                                                                    
                                                                    if($value2->keterangan == 1){
                                                                        $result_normalisasi = min($a_value_sub_kriteria[$key2])/$bobot;
                                                                        echo $result_normalisasi;
                                                                    }else if($value2->keterangan == 2){
                                                                        $result_normalisasi = $bobot/max($a_value_sub_kriteria[$key2]);
                                                                        echo $result_normalisasi;
                                                                    }
                                                                }
                                                            ?>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <tr style="font-weight: bold;">
                                            <td colspan="2">
                                                Bobot (W)
                                            </td>
                                            <?php foreach (get_criterias() as $key => $value) { ?>
                                                <td>
                                                    <?= $value->bobot ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr style="font-weight: bold;">
                                            <td colspan="2">
                                                Atribut/Keterangan
                                            </td>
                                            <?php foreach (get_criterias() as $key => $value) { ?>
                                                <td>
                                                    <?php if($value->keterangan == 1){ ?>
                                                        Cost
                                                    <?php }else if($value->keterangan == 2){ ?>
                                                        Benefit
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="header">
                            <h2><strong>Tahap</strong> Ketiga : Perangkingan</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Toko Swalayan</th>
                                            <?php foreach (get_criterias() as $key => $value) { ?>
                                                <th><?= $value->nama_kriteria ?></th>
                                            <?php } ?>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $a_value_department_store = array();
                                            $a_value_sum_prefensi = array();
                                            $a_value_result_ranking = array();
                                            foreach (get_department_store() as $key => $value) { 
                                        ?>
                                                <?php foreach (get_criterias() as $key2 => $value2) { ?>
                                                        <?php foreach (get_sub_criterias_with_code_criteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                            <?php
                                                                if(get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                    $bobot = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                    $kode_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                    $kode_sub_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                    $nama_sub_kriteria = get_sub_criteria_by_code_marge($kode_gabungan)['nama_sub_kriteria']; 
                                                                    array_push($a_value_department_store, $bobot);
                                                                }
                                                            ?>
                                                        <?php } ?>
                                                <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_value_sub_kriteria = array();
                                            $a_value_prefensi = array();
                                            $index_rank = 0;
                                            $rank_result = array();
                                            for ($i=0; $i < count(get_criterias()); $i++) { 
                                                for ($j=$i; $j < count(get_department_store())*count(get_criterias()); $j+=count(get_criterias())) {
                                                    $a_value_sub_kriteria[$i][$j] = $a_value_department_store[$j];
                                                }
                                            }
                                        ?>
                                        <?php foreach (get_department_store() as $key => $value) { ?>
                                            <tr>
                                                <td><?= $value->kode_department_store ?></td>
                                                <td><?= $value->nama_department_store ?></td>
                                                <?php foreach (get_criterias() as $key2 => $value2) { ?>
                                                    <td>
                                                        <?php foreach (get_sub_criterias_with_code_criteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                            <?php
                                                                if(get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                    $bobot = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                    $kode_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                    $kode_sub_kriteria = get_bobot_by_id_item_code_selection_code_marge($id_items, $data['kode_seleksi'], $value->kode_department_store . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                    $nama_sub_kriteria = get_sub_criteria_by_code_marge($kode_gabungan)['nama_sub_kriteria']; 
                                                                    
                                                                    if($value2->keterangan == 1){
                                                                        $result_normalisasi = min($a_value_sub_kriteria[$key2])/$bobot;
                                                                        $result_prefensi = $value2->bobot * $result_normalisasi;
                                                                        echo $result_prefensi;
                                                                    }else if($value2->keterangan == 2){
                                                                        $result_normalisasi = $bobot/max($a_value_sub_kriteria[$key2]);
                                                                        $result_prefensi = $value2->bobot * $result_normalisasi;
                                                                        echo $result_prefensi;
                                                                    }
                                                                    $a_value_prefensi[$key][$key2] = $result_prefensi;
                                                                }
                                                            ?>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <?php 
                                                        $sum_value_prefensi = array_sum($a_value_prefensi[$key]);
                                                        $a_value_sum_prefensi[$key] = $sum_value_prefensi;
                                                        echo $a_value_sum_prefensi[$key];
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            <?php
                                                $arr  = $a_value_sum_prefensi;
                                                $rank = $arr;
                                                rsort($rank);

                                                foreach($arr as $key55 => $sort) {
                                                    $rank_result[$key55] = (array_search($sort, $rank) + 1);
                                                }
                                            
                                                
                                            ?>
                                    </tbody>
                                </table>
                                <form action="<?= route_to('admin_courier_service_rating_save') ?>" method="post">
                                <?= csrf_field() ?>
                                <table class="table table-bordered table-striped table-hover datatables">
                                    <thead>
                                        <tr>
                                            <td>Kode</td>
                                            <td>Nama</td>
                                            <td>Hasil</td>
                                            <td>Ranking</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (get_department_store() as $key => $value) { ?>
                                            <tr>
                                                <td><?= $value->kode_department_store ?></td>
                                                <td><?= $value->nama_department_store ?></td>
                                                <td><?= $a_value_sum_prefensi[$key] ?></td>
                                                <td style="font-weight: bold;">
                                                    Ranking Ke - <?= $rank_result[$key] ?>
                                                </td>
                                            </tr>
                                            <input type="hidden" name="kode_department_store[<?=$key?>]" value="<?= $value->kode_department_store ?>">
                                            <input type="hidden" name="hasil[<?=$key?>]" value="<?= $a_value_sum_prefensi[$key] ?>">
                                            <input type="hidden" name="ranking[<?=$key?>]" value="<?= $rank_result[$key] ?>">
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <input type="hidden" name="kode_seleksi" value="<?= $data['kode_seleksi'] ?>">
                                <?php if(get_rating_by_code_selection($data['kode_seleksi'])) { ?>
                                    <div class="alert alert-info" role="alert">
                                        Rekomendasi Yang Dihasilkan Adalah : <?= get_rating_by_code_selection($data['kode_seleksi'])['kode_department_store'] ?> atau <span style="font-weight: bold;"><?= get_department_store_by_id(get_rating_by_code_selection($data['kode_seleksi'])['kode_department_store'])['nama_department_store'] ?></span>
                                    </div>
                                    <?php if(!get_recomedation_by_code_selection($data['kode_seleksi'])){ ?>
                                        <a href="<?= route_to('admin_courier_service_approve', $data['kode_seleksi'], get_rating_by_code_selection($data['kode_seleksi'])['kode_department_store']) ?>" class="btn btn-primary">Approve Jastip (Rekomendasikan)</a>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <button class="btn btn-info">Cek Rekomendasi</button>
                                <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</section>



<?= $this->endSection() ?>
