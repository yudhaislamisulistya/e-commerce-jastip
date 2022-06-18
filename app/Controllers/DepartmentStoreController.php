<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentStoreModel;

class DepartmentStoreController extends BaseController
{
    public function __construct()
    {
        $this->departmentStoreModel = new DepartmentStoreModel();
        $this->data = $this->departmentStoreModel->get()->getResult();
    }
    public function index()
    {
        return view('admin/department-store/index', [
            'data' => $this->data
        ]);
    }

    public function save(){
        try {
            $data = $this->request->getVar();

            $rules = [
                'kode_department_store' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_department_store' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('admin/department-store/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->departmentStoreModel->insert($data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_department_store');
            $this->departmentStoreModel->where('id_department_store', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'kode_department_store' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_department_store' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('admin/department-store/index',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->departmentStoreModel->update($data['id_department_store'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}
