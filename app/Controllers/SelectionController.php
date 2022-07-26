<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentStoreModel;
use App\Models\ItemModel;
use App\Models\PurchaseModel;
use App\Models\SelectionModel;
use CodeIgniter\API\ResponseTrait;

class SelectionController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->selectionModel = new SelectionModel();
        $this->departmentStoreModel = new DepartmentStoreModel();
        $this->itemModel = new ItemModel();
        $this->purchaseModel = new PurchaseModel();
    }

    public function entrepreneur_selection_index($id_user){
        $data = $this->departmentStoreModel
            ->get()
            ->getResult();
        return view('entrepreneur/daftar-barang/set', [
            'id_user' => $id_user,
            'data' => $data
        ]);
    }

    public function entrepreneur_selection_save(){
        try {
            $data = $this->request->getVar();
            $kode_seleksi = random_string('alnum', 16);
            for ($i=0; $i < count($data['sub_criterias']); $i++) { 
                for ($j=0; $j < count($data['sub_criterias'][$i]); $j++) { 
                    $split = explode("-", $data['sub_criterias'][$i][$j]);
                    $bobot = $split[0];
                    $kode_kriteria = $split[1];
                    $kode_sub_kriteria = $split[2];
                    $this->selectionModel->insert([
                        'id_user' => $data['id_user'],
                        'id_item' => $data['id_items'],
                        'kode_seleksi' => $kode_seleksi,
                        'kode_kriteria' => $kode_kriteria,
                        'kode_sub_kriteria' => $kode_sub_kriteria,
                        'kode_department_store' => $data['kode_department_store'][$i],
                        'kode_gabungan' => $data['kode_department_store'][$i] . '-' .$kode_kriteria . '-' . $kode_sub_kriteria,
                        'bobot' => $bobot
                    ]);
                }
            }


            $this->itemModel->where(['id_user' => $data['id_user'], 'status' => 1])->set(['status' => 11])->update();
            return redirect()->to(base_url('entrepreneur/daftar-barang'))->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->to(base_url('entrepreneur/daftar-barang'))->with('status', 'failed');
        }
    }

    public function entrepreneur_selection_set_price($id_items){
        return view('entrepreneur/daftar-barang/set-price', [
            'id_items' => $id_items
        ]);
    }

    public function entrepreneur_selection_set_price_save(){
        try {
            $data = $this->request->getVar();
            $data['total_harga_barang'] = preg_replace("/([^0-9])/i", "", $data['total_harga_barang']); 
            $data['total_final'] = preg_replace("/([^0-9])/i", "", $data['total_final']); 
            for ($i=0; $i < count($data['total_harga_per_barang']); $i++) { 
                $data['total_harga_per_barang'][$i] = preg_replace("/([^0-9])/i", "", $data['total_harga_per_barang'][$i]); 
            }
    
            $items = explode("-", $data['id_items']);
    
            for ($i=0; $i < count($items); $i++) { 
                $this->itemModel
                    ->where(['id_item' => $items[$i]])
                    ->set(['harga_barang' => $data['harga_barang'][$i], 'total_harga_per_barang' => $data['total_harga_per_barang'][$i], 'status' => 13])
                    ->update();
            }
    
            $this->purchaseModel->insert([
                'id_items' => $data['id_items'],
                'total_jumlah_beli' => $data['total_jumlah_beli'],
                'total_harga_barang' => $data['total_harga_barang'],
                'biaya_pengiriman' => $data['biaya_pengiriman'],
                'catatan_jastip' => $data['catatan_jastip'],
                'department_store_recomendation' => $data['department_store_recomendation'],
                'status' => 1,
            ]);
            return redirect()->to(base_url('entrepreneur/daftar-barang'))->with('status', 'success_set_price');
        } catch (\Exception $th) {
            return redirect()->to(base_url('entrepreneur/daftar-barang'))->with('status', 'failed_set_price');
        }
    }
}
