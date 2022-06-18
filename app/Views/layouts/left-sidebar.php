
<?php if(session()->get('role') == '1'){ ?>

<!-- For Customer : Role User => 1 -->

<aside id="leftsidebar" class="sidebar">
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="detail">
                        <h4><?= get_user_by_id(session()->get('id_user'))['nama_lengkap'] ?></h4>
                        <small>
                            <?php if(get_user_by_id(session()->get('id_user'))['role'] == 1){ ?>
                                Customer
                            <?php }else if(get_user_by_id(session()->get('id_user'))['role'] == 2){ ?>
                                Entrepreneur / Usaha Jastip
                            <?php }else if(get_user_by_id(session()->get('id_user'))['role'] == 3){ ?>
                                Admin
                            <?php } ?>
                        </small>                        
                    </div>
                    <a href="<?= route_to('logout') ?>" title="Sign out"><i class="zmdi zmdi-power"></i></a>
                </div>
            </li>
            <li class="header">MAIN</li>
            <li> <a href="<?= route_to('customer_dashboard') ?>"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            <li> <a href="<?= route_to('customer_list_item') ?>"><i class="zmdi zmdi-local-store"></i><span>Daftar Barang</span></a>
            <li> <a href="<?= route_to('customer_list_swalayan') ?>"><i class="zmdi zmdi-shopping-cart"></i><span>Swalayan</span></a>
            </li>
            <li class="header">Other</li>
            <li> <a href="<?= route_to('customer_alamat_index') ?>"><i class="zmdi zmdi-pin-account"></i><span>Alamat</span></a>
        </ul>
    </div>
</aside>
<?php } if(session()->get('role') == '2'){ ?>
<!-- For Entrepreneur -->

<aside id="leftsidebar" class="sidebar">
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="detail">
                        <h4><?= get_user_by_id(session()->get('id_user'))['nama_lengkap'] ?></h4>
                        <small>
                            <?php if(get_user_by_id(session()->get('id_user'))['role'] == 1){ ?>
                                Customer
                            <?php }else if(get_user_by_id(session()->get('id_user'))['role'] == 2){ ?>
                                Entrepreneur / Usaha Jastip
                            <?php }else if(get_user_by_id(session()->get('id_user'))['role'] == 3){ ?>
                                Admin
                            <?php } ?>
                        </small>                        
                    </div>
                    <a href="<?= route_to('logout') ?>" title="Sign out"><i class="zmdi zmdi-power"></i></a>
                </div>
            </li>
            <li class="header">MAIN</li>
            <li> <a href="<?= route_to('entrepreneur_dashboard') ?>"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            <li> <a href="<?= route_to('entrepreneur_list_department_store_index') ?>"><i class="zmdi zmdi-shopping-cart"></i><span>Swalayan</span></a>
            <li> <a href="<?= route_to('entrepreneur_list_item_index') ?>"><i class="zmdi zmdi-local-store"></i><span>Daftar Barang</span></a>
            </li>
            <li class="header">Other</li>
            <li> <a href="<?= route_to('entrepreneur_list_customer_index') ?>"><i class="zmdi zmdi-pin-account"></i><span>Customer</span></a>
            <li> <a href="<?= route_to('entrepreneur_list_department_store_index') ?>"><i class="zmdi zmdi-account"></i><span>DToko Swalayan</span></a>
        </ul>
    </div>
</aside>

<?php } if(session()->get('role') == '3'){ ?>

<aside id="leftsidebar" class="sidebar">
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="detail">
                        <h4><?= get_user_by_id(session()->get('id_user'))['nama_lengkap'] ?></h4>
                        <small>
                            <?php if(get_user_by_id(session()->get('id_user'))['role'] == 1){ ?>
                                Customer
                            <?php }else if(get_user_by_id(session()->get('id_user'))['role'] == 2){ ?>
                                Entrepreneur / Usaha Jastip
                            <?php }else if(get_user_by_id(session()->get('id_user'))['role'] == 3){ ?>
                                Admin
                            <?php } ?>
                        </small>                        
                    </div>
                    <a href="<?= route_to('logout') ?>" title="Sign out"><i class="zmdi zmdi-power"></i></a>
                </div>
            </li>
            <li class="header">MAIN</li>
            <li> <a href="<?= route_to('admin_dashboard') ?>"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            <li> <a href="<?= route_to('admin_courier_service_index') ?>"><i class="zmdi zmdi-bus"></i><span>Usaha Jastip</span></a>
            <li> <a href="<?= route_to('admin_criteria_index') ?>"><i class="zmdi zmdi-code"></i><span>Kriteria</span></a>
            <li> <a href="<?= route_to('admin_preference_value_index') ?>"><i class="zmdi zmdi-fire"></i><span>Nilai Prefensi</span></a>
            <li> <a href="<?= route_to('admin_department_store_index') ?>"><i class="zmdi zmdi-store"></i><span>Departement Store</span></a>
            </li>
            <li class="header">Other</li>
            <li> <a href="<?= route_to('admin_customer_list_index') ?>"><i class="zmdi zmdi-pin-account"></i><span>Customer</span></a>
            <li> <a href="<?= route_to('admin_entrepreneur_list_index') ?>"><i class="zmdi zmdi-account-add"></i><span>Entrepreneur</span></a>
        </ul>
    </div>
</aside>

<?php }?>







