<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\RatingModel;
use App\Models\RecomendationModel;
use App\Models\SelectionModel;
use CodeIgniter\API\ResponseTrait;

class CourierServiceController extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->selectionModel = new SelectionModel();
        $this->ratingModel = new RatingModel();
        $this->itemModel = new ItemModel();
        $this->recomendationModel = new RecomendationModel();
    }
    public function courier_service_check($kode_seleksi){
        $data = $this->selectionModel
            ->where('kode_seleksi', $kode_seleksi)
            ->groupBy('kode_seleksi')
            ->first();
        return view('admin/courier-service/check', [
            'data' => $data
        ]);
    }

    public function courier_service_rating_save(){
        try {
            $data = $this->request->getVar();
            for ($i=0; $i < count($data['kode_department_store']); $i++) { 
                $this->ratingModel->ignore(true)->insert([
                    'kode_seleksi' => $data['kode_seleksi'],
                    'kode_department_store' => $data['kode_department_store'][$i],
                    'hasil' => $data['hasil'][$i],
                    'ranking' => $data['ranking'][$i]
                ]);
            }
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function courier_service_approve($kode_seleksi, $kode_departement_store){
        try {
            $this->recomendationModel->insert([
                'kode_seleksi' => $kode_seleksi,
                'kode_department_store' => $kode_departement_store
            ]);

            $data = $this->selectionModel
                ->where('kode_seleksi', $kode_seleksi)
                ->first();
            
            $items = explode("-", $data['id_item']);

            for ($i=0; $i < count($items); $i++) { 
                $this->itemModel->where(['id_item' => $items[$i]])->set(['status' => 12])->update();
            }

            if (session()->get('role') == '3') {
                return redirect()->to(base_url('admin/courier-service'))->with('status', 'succes');
            }else{
                return redirect()->to(base_url('entrepreneur/daftar-barang'))->with('status', 'succes');
            }
        } catch (\Exception $th) {
            return redirect()->to(base_url('admin/courier-service'))->with('status', 'failed');
        }
    }
}
