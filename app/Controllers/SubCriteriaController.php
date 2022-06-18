<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubCriteriaModel;

class SubCriteriaController extends BaseController
{
    public function __construct()
    {
        $this->subCriteriaModel = new SubCriteriaModel();
        $this->data = $this->subCriteriaModel->get()->getResult();
    }
    public function index()
    {
        return view('admin/criteria/index', [
            'data' => $this->data
        ]);
    }

    public function save(){
        try {
            $data = $this->request->getVar();
            $data['kode_gabungan'] = $data['kode_kriteria'] . $data['kode_sub_kriteria'];

            $rules = [
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'kode_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('admin/criteria/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->subCriteriaModel->insert($data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_sub_kriteria');
            $this->subCriteriaModel->where('id_sub_kriteria', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {

            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $data['kode_gabungan'] = $data['kode_kriteria'] .'-'. $data['kode_sub_kriteria'];

            $rules = [
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'kode_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('admin/criteria/index',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->subCriteriaModel->update($data['id_sub_kriteria'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function preference_value_index(){
        return view('admin/preference-value/index');
    }
}
