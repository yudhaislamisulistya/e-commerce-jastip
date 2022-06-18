<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentStoreModel;
use App\Models\SelectionModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->departmentStoreModel = new DepartmentStoreModel();
        $this->selectionModel = new SelectionModel();
        $this->data = $this->userModel->where('role', 1)
            ->get()
            ->getResult();
        $this->data2 = $this->userModel->where('role', 2)
        ->get()
        ->getResult();
    }
    public function index()
    {
    }

    public function login(){
        return view('login');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function login_post(){
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];

        $errors = [
            'password' => [
                'validateUser' => "Email atau Password Tidak Sama",
            ],
        ];

        if(!$this->validate($rules, $errors)){
            return view('login', [
                'validation' => $this->validator,
            ]);
        } else {
            $user = $this->userModel->where('email', $this->request->getVar('email'))
                ->first();
            
            // Menyimpan Nilai Session
            $this->setUserSession($user);

            // Disini Kondisi Yah
            if($user['role'] == 3){
                return redirect()->to(base_url('admin/dashboard'));
            }else if($user['role'] == 2){
                return redirect()->to(base_url('entrepreneur/dashboard'));
            }else if($user['role'] == 1){
                return redirect()->to(base_url('customer/dashboard'));
            }
        }
    }

    public function setUserSession($user){
        $data = [
            'id_user' => $user['id_user'],
            'nama_lengkap' => $user['nama_lengkap'],
            'email' => $user['email'],
            'nomor_telepon' => $user['nomor_telepon'],
            'alamat' => $user['alamat'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }

    public function admin(){
        return view('admin/dashboard');
    }

    public function entrepreneur(){
        return view('entrepreneur/dashboard');
    }

    public function customer(){
        return view('customer/dashboard');
    }

    public function customer_list(){
        $data = $this->data;
        return view('admin/customer/index', compact('data'));
    }

    public function customer_save(){
        try {
            $data = $this->request->getVar();
            $data['plain_password'] = $data['password'];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['role'] = 1;

            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nomor_telepon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('admin/customer/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->userModel->insert($data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function customer_delete(){
        try {
            $id = $this->request->getVar('id_user');
            $this->userModel->where('id_user', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function customer_update(){
        try {
            $data = $this->request->getVar();
            $data['plain_password'] = $data['password'];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['role'] = 1;

            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nomor_telepon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('admin/customer/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->userModel->update($data['id_user'],$data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }
    
    public function entrepreneur_list(){
        $data = $this->data2;
        return view('admin/entrepreneur/index', compact('data'));
    }

    public function entrepreneur_save(){
        try {
            $data = $this->request->getVar();
            $data['plain_password'] = $data['password'];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['role'] = 2;

            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nomor_telepon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('admin/customer/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->userModel->insert($data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function entrepreneur_delete(){
        try {
            $id = $this->request->getVar('id_user');
            $this->userModel->where('id_user', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function entrepreneur_update(){
        try {
            $data = $this->request->getVar();
            $data['plain_password'] = $data['password'];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['role'] = 2;

            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nomor_telepon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('admin/customer/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->userModel->update($data['id_user'],$data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function courier_service_list(){
        $data = $this->selectionModel
            ->groupBy('kode_seleksi')
            ->get()
            ->getResult();
        

        return view('admin/courier-service/index', [
            'data' => $data
        ]);
    }

    public function alamat_index(){
        return view('customer/alamat/index');
    }

    public function alamat_update(){
        try {
            $data = $this->request->getVar();

            $rules = [
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('customer/alamat/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->userModel->update($data['id_user'],$data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function entrepreneur_list_customer(){
        $data = $this->userModel->where('role', 1)
            ->get()
            ->getResult();
        return view('entrepreneur/customer/index', [
            'data' => $data
        ]);
    }

    public function entrepreneur_list_department_store(){
        $data = $this->departmentStoreModel
            ->get()
            ->getResult();
        return view('entrepreneur/department-store/index', [
            'data' => $data
        ]);
    }

    function register(){
        return view('register');
    }

    function register_post(){
        try {
            $data = $this->request->getVar();
            $this->userModel->insert([
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'plain_password' => $data['password'],
                'nomor_telepon' => $data['nomor_telepon'],
            ]);
            return redirect()->to(base_url('register'))->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->to(base_url('register'))->with('status', 'failed');
        }
    }
}
