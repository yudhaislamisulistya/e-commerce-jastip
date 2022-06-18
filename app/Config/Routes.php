<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


$routes->get('logout', 'UserController::logout', ['as' => 'logout']);

$routes->get('login', 'UserController::login', ['as' => 'login']);

$routes->get('register', 'UserController::register', ['as' => 'register']);

$routes->post('login', 'UserController::login_post', ['as' => 'login_post']);

$routes->post('register', 'UserController::register_post', ['as' => 'register_post']);

$routes->group('admin', ['filter' => 'auth'], function($routes){
    $routes->get('dashboard', 'UserController::admin', ['as' => 'admin_dashboard']);

    // Department Store atau Alternatif
    $routes->get('department-store', 'DepartmentStoreController::index', ['as' => 'admin_department_store_index']);
    $routes->post('department-store/save', 'DepartmentStoreController::save', ['as' => 'admin_department_store_save']);
    $routes->post('department-store/update', 'DepartmentStoreController::update', ['as' => 'admin_department_store_update']);
    $routes->post('department-store/delete', 'DepartmentStoreController::delete', ['as' => 'admin_department_store_delete']);

    // Kriteria
    $routes->get('kriteria', 'CriteriaController::index', ['as' => 'admin_criteria_index']);
    $routes->post('kriteria/save', 'CriteriaController::save', ['as' => 'admin_criteria_save']);
    $routes->post('kriteria/update', 'CriteriaController::update', ['as' => 'admin_criteria_update']);
    $routes->post('kriteria/delete', 'CriteriaController::delete', ['as' => 'admin_criteria_delete']);

    // Sub Kriteria
    $routes->get('sub-kriteria', 'SubCriteriaController::index', ['as' => 'admin_sub_criteria_index']);
    $routes->post('sub-kriteria/save', 'SubCriteriaController::save', ['as' => 'admin_sub_criteria_save']);
    $routes->post('sub-kriteria/update', 'SubCriteriaController::update', ['as' => 'admin_sub_criteria_update']);
    $routes->post('sub-kriteria/delete', 'SubCriteriaController::delete', ['as' => 'admin_sub_criteria_delete']);

    // Nilai Prefensi
    $routes->get('preference-value', 'SubCriteriaController::preference_value_index', ['as' => 'admin_preference_value_index']);

    // Usaha Jastip
    $routes->get('courier-service', 'UserController::courier_service_list', ['as' => 'admin_courier_service_index']);
    $routes->get('courier-service/(:any)', 'CourierServiceController::courier_service_check/$1', ['as' => 'admin_courier_service_check']);
    $routes->get('courier-service-approve/(:any)/(:any)', 'CourierServiceController::courier_service_approve/$1/$2', ['as' => 'admin_courier_service_approve']);
    $routes->post('courier-service', 'CourierServiceController::courier_service_rating_save', ['as' => 'admin_courier_service_rating_save']);

    // Other
    $routes->get('customer', 'UserController::customer_list', ['as' => 'admin_customer_list_index']);
    $routes->post('customer/save', 'UserController::customer_save', ['as' => 'admin_customer_save']);
    $routes->post('customer/update', 'UserController::customer_update', ['as' => 'admin_customer_update']);
    $routes->post('customer/delete', 'UserController::customer_delete', ['as' => 'admin_customer_delete']);

    $routes->get('entrepreneur', 'UserController::entrepreneur_list', ['as' => 'admin_entrepreneur_list_index']);
    $routes->post('entrepreneur/save', 'UserController::entrepreneur_save', ['as' => 'admin_entrepreneur_save']);
    $routes->post('entrepreneur/update', 'UserController::entrepreneur_update', ['as' => 'admin_entrepreneur_update']);
    $routes->post('entrepreneur/delete', 'UserController::entrepreneur_delete', ['as' => 'admin_entrepreneur_delete']);

});

$routes->group('entrepreneur', ['filter' => 'auth'] , function($routes){
    $routes->get('dashboard', 'UserController::entrepreneur', ['as' => 'entrepreneur_dashboard']);

    // Customer atau Pelanggan
    $routes->get('customer', 'UserController::entrepreneur_list_customer', ['as' => 'entrepreneur_list_customer_index']);

    // Department Store
    $routes->get('department-store', 'UserController::entrepreneur_list_department_store', ['as' => 'entrepreneur_list_department_store_index']);

    // Daftar Barang
    $routes->get('daftar-barang', 'ItemController::entrepreneur_list_item', ['as' => 'entrepreneur_list_item_index']);
    $routes->post('daftar-barang/reject', 'ItemController::entrepreneur_item_reject', ['as' => 'entrepreneur_item_reject']);
    $routes->post('daftar-barang/accept', 'ItemController::entrepreneur_item_accept', ['as' => 'entrepreneur_item_accept']);
    $routes->post('daftar-barang/cancel', 'ItemController::entrepreneur_item_cancel', ['as' => 'entrepreneur_item_cancel']);
    
    // Menu Untuk Selection
    $routes->get('selection/(:any)', 'SelectionController::entrepreneur_selection_index/$1', ['as' => 'entrepreneur_selection_index']);
    $routes->get('selection-set-price/(:any)', 'SelectionController::entrepreneur_selection_set_price/$1', ['as' => 'entrepreneur_selection_set_price']);
    $routes->post('selection-set-price/save', 'SelectionController::entrepreneur_selection_set_price_save/', ['as' => 'entrepreneur_selection_set_price_save']);
    $routes->post('selection/save', 'SelectionController::entrepreneur_selection_save', ['as' => 'entrepreneur_selection_save']);

});

$routes->group('customer', ['filter' => 'auth'] ,function($routes){
    // Untuk Dashboard
    $routes->get('dashboard', 'UserController::customer', ['as' => 'customer_dashboard']);

    // Untuk Daftar Barang
    $routes->get('daftar-barang', 'ItemController::list_item', ['as' => 'customer_list_item']);
    $routes->post('daftar-barang/save', 'ItemController::save', ['as' => 'customer_item_save']);
    $routes->post('daftar-barang/delete', 'ItemController::delete', ['as' => 'customer_item_delete']);
    $routes->post('daftar-barang/update', 'ItemController::update', ['as' => 'customer_item_update']);
    $routes->post('daftar-barang/update-purchase', 'ItemController::update_purchase', ['as' => 'customer_item_update_purchase']);
    $routes->get('daftar-barang/detail-pesanan/(:any)', 'ItemController::customer_daftar_barang_detail_pesanan/$1', ['as' => 'customer_daftar_barang_detail_pesanan']);
    
    // Menu Untuk Swalayan
    $routes->get('swalayan', 'ItemController::list_swalayan', ['as' => 'customer_list_swalayan']);

    // Menu Untuk Alamat
    $routes->get('alamat', 'UserController::alamat_index', ['as' => 'customer_alamat_index']);
    $routes->post('alamat/update', 'UserController::alamat_update', ['as' => 'customer_alamat_update']);

});

$routes->get('generate-password', function(){
    return password_hash('12345678', PASSWORD_DEFAULT);
});

$routes->get('get-session-data', function(){
    return session()->get('nama_lengkap');
});

$routes->get('remove-session-data', function(){
    session()->destroy();
    return redirect()->to(base_url('login'));
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
