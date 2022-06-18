<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentStoreModel;
use App\Models\ItemModel;
use App\Models\PurchaseModel;
use App\Models\TransactionModel;
use CodeIgniter\API\ResponseTrait;

class ItemController extends BaseController
{

    use ResponseTrait;
    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->itemModel = new ItemModel();
        $this->purchaseModel = new PurchaseModel();
        $this->departmentStoreModel = new DepartmentStoreModel();
        $this->data = $this->itemModel->where('id_user', session()->get('id_user'))->where('status != 13')->where('status != 14')
            ->get()->getResult();
    }

    public function list_item(){

        $data = $this->data;
        return view('customer/daftar-barang/index', compact('data'));
    }

    public function save(){
        try {
            $data = $this->request->getVar();

            $rules = [
                'nama_barang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'jumlah_beli' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'catatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
        if(!$this->validate($rules)){
            return view('customer/daftar-barang/index',[
                'validation' => $this->validator,
                'data' => $this->data
            ]);
        }else{
            $this->itemModel->insert($data);
            return redirect()->back()->with('status', 'success');
        }
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function delete(){
        try {
            $id = $this->request->getVar('id_item');
            $this->itemModel->where('id_item', $id)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function update(){
        try {
            $data = $this->request->getVar();
            $rules = [
                'nama_barang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'jumlah_beli' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'catatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                return view('customer/daftar-barang/index',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->itemModel->update($data['id_item'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function list_swalayan(){
        $data = $this->departmentStoreModel
            ->get()
            ->getResult();
        return view('customer/swalayan/index', [
            'data' => $data
        ]);
    }

    public function entrepreneur_list_item(){
        $data = $this->itemModel
            ->where('status !=', 14)
            ->where('status !=', 13)
            ->where('status !=', 12)
            ->get()
            ->getResult();
        return view('entrepreneur/daftar-barang/index', [
            'data' => $data
        ]);
    }

    public function entrepreneur_item_reject(){
        try {
            $data = $this->request->getVar();
            $data['status'] = 3;
            $this->itemModel->update($data['id_item'], $data);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function entrepreneur_item_accept(){
        try {
            $data = $this->request->getVar();
            $data['status'] = 1;
            $this->itemModel->update($data['id_item'], $data);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function entrepreneur_item_cancel(){
        try {
            $data = $this->request->getVar();
            $data['status'] = 2;
            $this->itemModel->update($data['id_item'], $data);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }

    public function customer_daftar_barang_detail_pesanan($id_items){
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-YSYWu-56zw7glDvZMCragTo9';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $data = $this->purchaseModel->where('id_items', $id_items)
            ->first();

        $items = explode("-", $data['id_items']);
        $a_items = array();
        for ($i=0; $i < count($items); $i++) { 
            $temp_item = array(
                'id'       => get_item_by_id($items[$i])['id_item'],
                'price'    => get_item_by_id($items[$i])['harga_barang'],
                'quantity' => get_item_by_id($items[$i])['jumlah_beli'],
                'name'     => get_item_by_id($items[$i])['nama_barang']
            );

            array_push($a_items, $temp_item);
        }

        $temp_item = array(
            'id'       => 999,
            'price'    => $data['biaya_pengiriman'],
            'quantity' => 1,
            'name'     => 'Biaya Pengiriman'
        );

        array_push($a_items, $temp_item);

        // Populate customer's billing address
        $billing_address = array(
            'first_name'   => get_nama_depan_belakang(get_nama_lengkap())['nama_depan'],
            'last_name'    => get_nama_depan_belakang(get_nama_lengkap())['nama_belakang'],
            'address'      => get_alamat_pengiriman(),
            'phone'        => get_nomor_handphone(),
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => get_nama_depan_belakang(get_nama_lengkap())['nama_depan'],
            'last_name'    => get_nama_depan_belakang(get_nama_lengkap())['nama_belakang'],
            'address'      => get_alamat_pengiriman(),
            'phone'        => get_nomor_handphone(),
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => get_nama_depan_belakang(get_nama_lengkap())['nama_depan'],
            'last_name'        => get_nama_depan_belakang(get_nama_lengkap())['nama_belakang'],
            'email'            => get_email(),
            'phone'            => get_nomor_handphone(),
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );
        
        $params = [
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => (int)$data['total_harga_barang'] + (int)$data['biaya_pengiriman'],
            ),
            'item_details'        => $a_items,
            'customer_details'    => $customer_details
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $id_items_new = json_encode($id_items);

        return view('customer/daftar-barang/detail', compact('data', 'snapToken', 'id_items_new'));
    }

    public function update_purchase(){
        try {
            $data = $this->request->getVar();
            
            if($data->transaction_status == "settlement"){
                $transaction = array(
                    "id_user" => get_id_user(),
                    "status_code"=> $data->status_code,
                    "transaction_id"=> $data->transaction_id,
                    "order_id"=> $data->order_id,
                    "gross_amount"=> (int)$data->gross_amount,
                    "payment_type"=> $data->payment_type,
                    "transaction_time"=> $data->transaction_time,
                    "transaction_status"=> $data->transaction_status,
                );
            }else if($data->transaction_status == "pending"){
                $transaction = array(
                    "id_user" => get_id_user(),
                    "status_code"=> $data->status_code,
                    "transaction_id"=> $data->transaction_id,
                    "order_id"=> $data->order_id,
                    "gross_amount"=> (int)$data->gross_amount,
                    "payment_type"=> $data->payment_type,
                    "transaction_time"=> $data->transaction_time,
                    "transaction_status"=> $data->transaction_status,
                );
                if($data->payment_type == "bank_transfer"){
                    $transaction['bank'] = $data->va_numbers[0]->bank;
                    $transaction['va_number'] = $data->va_numbers[0]->va_number;
                    $transaction['pdf_url'] = $data->pdf_url;
                }
            }else{
                return $this->fail([
                    "status" => "Gagal",
                ]);
            }

            $this->transactionModel->insert($transaction);


            $this->purchaseModel->where(['id_items' => $data->id_items])->set(['transaction_id'=> $data->transaction_id, 'status' => 2])->update();

            $items = explode("-", $data->id_items);
            for ($i=0; $i < count($items); $i++) { 
                $this->itemModel->where(['id_item' => $items[$i]])->set(['status' => 14])->update();
            }
            return $this->respond([
                'code' => 200,
                'status' => "Transaksi Berhasil Diproses...",
                'queryTransaction' => true,
                'queryPurchase' => true,
                'queryCart' => true
            ]);
        } catch (\Exception $th) {
            return $this->fail([
                "status" => "Gagal",
            ]);
        }
    }
}
