<?php

use App\Models\CriteriaModel;
use App\Models\DepartmentStoreModel;
use App\Models\ItemModel;
use App\Models\PurchaseModel;
use App\Models\RatingModel;
use App\Models\RecomendationModel;
use App\Models\SelectionModel;
use App\Models\SubCriteriaModel;
use App\Models\TransactionModel;
use App\Models\UserModel;

function get_criterias(){
    $criteriaModel = new CriteriaModel();
    $data = $criteriaModel->get()->getResult();
    return $data;
}

function get_sub_criterias_with_code_criteria($code_criteria){
    $subCriteriaModel = new SubCriteriaModel();
    $data = $subCriteriaModel->where('kode_kriteria', $code_criteria)
        ->orderBy('bobot', 'desc')
        ->get()
        ->getResult();
    return $data;
}

function get_user_by_id($id_user){
    $userModel = new UserModel();
    $data = $userModel->where('id_user', $id_user)
        ->first();
    return $data;
}


function get_items_by_id($id_item){
    $itemModel = new ItemModel();
    $data = $itemModel->where('id_item', $id_item)
        ->get()
        ->getResult();
    return $data;
}

function get_items_by_id_and_id_user($id_item, $id_user){
    $itemModel = new ItemModel();
    $data = $itemModel->where('id_item', $id_item)->where('id_user', $id_user)
        ->get()
        ->getResult();
    return $data;
}

function get_item_by_id($id_item){
    $itemModel = new ItemModel();
    $data = $itemModel->where('id_item', $id_item)
        ->first();
    return $data;
}

function get_items_status_accept_by_id_user($id_user){
    $itemModel = new ItemModel();
    $data = $itemModel->where('id_user', $id_user)
        ->where('status', 1)
        ->get()
        ->getResult();
    return $data;
}

function get_selection_by_code_transaction($code_transaction){
    $selectionModel = new SelectionModel();
    $data = $selectionModel->where('kode_seleksi', $code_transaction)
        ->limit(1)
        ->first();
    return $data;
}

function get_department_store(){
    $departmentStoreModel = new DepartmentStoreModel();
    $data = $departmentStoreModel
        ->get()
        ->getResult();
    return $data;
}

function get_bobot_by_id_item_code_selection_code_marge($id_item, $code_selection, $code_marge){

    $selectionModel = new SelectionModel();
    $data = $selectionModel
        ->where('id_item', $id_item)
        ->where('kode_seleksi', $code_selection)
        ->where('kode_gabungan', $code_marge)
        ->first();
    return $data;
}

function get_sub_criteria_by_code_marge($code_marge){
    $subCriteriaModel = new SubCriteriaModel();
    $data = $subCriteriaModel
        ->where('kode_gabungan', $code_marge)
        ->first();

    return $data;
}

function get_rating_by_code_selection($code_selection){
    $ratingModel = new RatingModel();
    $data = $ratingModel
        ->where('kode_seleksi', $code_selection)
        ->orderBy('ranking', 'desc')
        ->first();
    return $data;
}

function get_department_store_by_id($code_department_store){
    $departmentStoreModel = new DepartmentStoreModel();
    $data = $departmentStoreModel
        ->where('kode_department_store', $code_department_store)
        ->first();
    return $data;
}

function get_recomedation_by_code_selection($code_selection){
    $recomendationModel = new RecomendationModel();
    $data = $recomendationModel
        ->where('kode_seleksi', $code_selection)
        ->first();
    return $data;
}

function get_selection_by_code_selection(){
    $selectionModel = new SelectionModel();
    $data = $selectionModel
        ->groupBy('kode_seleksi')
        ->get()
        ->getResult();
    return $data;
}

function get_selection_by_code_selection_and_id_user($id_user){
    $selectionModel = new SelectionModel();
    $data = $selectionModel
        ->where('id_user', $id_user)
        ->groupBy('kode_seleksi')
        ->get()
        ->getResult();
    return $data;
}

function get_name_recomendation_department_store_by_id_items($id_items){
    $selectionModel = new SelectionModel();
    $recomendationModel = new RecomendationModel();
    $departmentStoreModel = new DepartmentStoreModel();
    $kode_seleksi = $selectionModel->where('id_item', $id_items)->select('kode_seleksi')->first();
    $kode_department_store = $recomendationModel->where('kode_seleksi', $kode_seleksi['kode_seleksi'])->first();
    $nama_department_store = $departmentStoreModel
        ->where('kode_department_store', $kode_department_store['kode_department_store'])
        ->select('nama_department_store')
        ->first();
    return $nama_department_store['nama_department_store'];
}

function get_purchase_by_id_item($id_item){
    $purchaseModel = new PurchaseModel();
    $data = $purchaseModel->where('id_items', $id_item)
        ->first();
    return $data;
}

function get_id_user(){
    return session()->get('id_user');
}

function get_nama_lengkap(){
    $userModel = new UserModel();
    $data = $userModel->where('id_user', get_id_user())
        ->first();
    return $data['nama_lengkap'];
}

function get_nama_depan_belakang($nama_lengkap){
    $parts = explode(" ", $nama_lengkap);
    if(count($parts) > 1) {
        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);
    }
    else
    {
        $firstname = $nama_lengkap;
        $lastname = " ";
    }
    $data['nama_depan'] = $firstname;
    $data['nama_belakang'] = $lastname;

    return $data;
}


function get_email(){
    $userModel = new UserModel();
    $data = $userModel->where('id_user', get_id_user())
        ->first();
    return $data['email'];
}

function get_nomor_handphone(){
    $userModel = new UserModel();
    $data = $userModel->where('id_user', get_id_user())
        ->first();
    return $data['nomor_telepon'];
}

function get_alamat_pengiriman(){
    $userModel = new UserModel();
    $data = $userModel->where('id_user', get_id_user())
        ->first();
    return $data['alamat'];
}

function get_transaction_by_id($transaction_id){
    $transactionModel = new TransactionModel();
    $data = $transactionModel->where('transaction_id', $transaction_id)
        ->first();
    return $data;
}

function get_items_by_id_user($id_user){
    $itemModel = new ItemModel();
    $data = $itemModel->where('id_user', $id_user)
        ->get()
        ->getResult();
    return $data;
}

function format_rupiah($angka){
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function get_transaction_by_id_user($id_user){
    $transactionModel = new TransactionModel();
    $data = $transactionModel->where('id_user', $id_user)
        ->get()
        ->getResult();
    return $data;
}

function get_items_by_status($status){
    $itemModel = new ItemModel();
    $data =$itemModel->where('status', 14)
        ->get()
        ->getResult();
    return $data;
}

function get_items_by_not_status($status){
    $itemModel = new ItemModel();
    $data =$itemModel->where('status !=', 14)
        ->get()
        ->getResult();
    return $data;
}

function get_items(){
    $itemModel = new ItemModel();
    $data = $itemModel
        ->get()
        ->getResult();
    return $data;
}

function get_buyer_from_items(){
    $itemModel = new ItemModel();
    $data = $itemModel->groupBy('id_user')
        ->get()
        ->getResult();
    return $data;
}

function get_user_by_role($role){
    $userModel = new UserModel();
    $data = $userModel->where('role', $role)
        ->get()
        ->getResult();
    return $data;
}

function get_transaction_by_status($status){
    $transactionModel = new TransactionModel();
    $data = $transactionModel->where('transaction_status', $status)
        ->get()
        ->getResult();
    return $data;
}


?>