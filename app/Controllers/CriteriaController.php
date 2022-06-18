<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;

class CriteriaController extends BaseController
{
    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
        $this->data = $this->criteriaModel->get()->getResult();
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

            $rules = [
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_kriteria' => [
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
                ]
            ];
        
        if(!$this->validate($rules)){
            return view('admin/criteria/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->criteriaModel->insert($data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_kriteria');
            $this->criteriaModel->where('id_kriteria', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_kriteria' => [
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
                ]
            ];

            if(!$this->validate($rules)){
                return view('admin/criteria/index',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->criteriaModel->update($data['id_kriteria'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }
}
