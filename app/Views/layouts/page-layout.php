
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<title>Dashboard Jastip Masyita</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/morrisjs/morris.min.css" />
<!-- CSS Untuk Datatables -->
<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<!-- Akhir CSS Untuk Datatables -->
<!-- Custom Css -->
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/main.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/ecommerce.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/color_skins.css">

<?= $this->renderSection('css') ?>
</head>
<body class="theme-cyan">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="<?= base_url() ?>/assets/images/logo.svg" width="48" height="48" alt="Compass"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">        
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.html"><img src="<?= base_url() ?>/assets/images/logo.svg" width="30" alt="Compass"><span class="m-l-10">Jastip</span></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true"><i class="zmdi zmdi-fullscreen"></i></a>
            </li>
            <li><a href="<?= route_to('logout') ?>" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
            <li class=""><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        </ul>
    </div>
</nav>

<?= $this->include('layouts/left-sidebar') ?>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active slideRight" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>Skins</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple">
                            <div class="purple"></div>
                        </li>                   
                        <li data-theme="blue">
                            <div class="blue"></div>
                        </li>
                        <li data-theme="cyan" class="active">
                            <div class="cyan"></div>                    
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>                    
                        </li>
                    </ul>                    
                </div>
                <div class="card">
                    <h6>Left Menu</h6>
                    <ul class="list-unstyled theme-light-dark">
                        <li>
                            <div class="t-light btn btn-default btn-simple btn-round">Light</div>
                        </li>
                        <li>
                            <div class="t-dark btn btn-default btn-round">Dark</div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">Report Panel Usage</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox2" type="checkbox" checked="">
                                <label for="checkbox2">Email Redirect</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox3" type="checkbox" checked="">
                                <label for="checkbox3">Notifications</label>
                            </div>                        
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox4" type="checkbox" checked="">
                                <label for="checkbox4">Auto Updates</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>Account Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <div class="checkbox">
                                <input id="checkbox5" type="checkbox" checked="">
                                <label for="checkbox5">Offline</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox6" type="checkbox" checked="">
                                <label for="checkbox6">Location Permission</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>                
        </div>       
        <div class="tab-pane right_chat pullUp" id="chat">
            <div class="slim_scroll">
                <div class="card">
                    <div class="search">                        
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h6>Recent</h6>
                    <ul class="list-unstyled">
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Sophia</span>
                                        <span class="message">There are many variations of passages of Lorem Ipsum available</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Grayson</span>
                                        <span class="message">All the Lorem Ipsum generators on the</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Isabella</span>
                                        <span class="message">Contrary to popular belief, Lorem Ipsum</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="me">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">John</span>
                                        <span class="message">It is a long established fact that a reader</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Alexander</span>
                                        <span class="message">Richard McClintock, a Latin professor</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>                        
                    </ul>
                </div>
                <div class="card">
                    <h6>Contacts</h6>
                    <ul class="list-unstyled">
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar10.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar6.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar7.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar8.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar9.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline inlineblock">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="<?= base_url() ?>/assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane slideRight" id="activity">
            <div class="slim_scroll">
                <div class="card">
                    <h6>Recent Activity</h6>
                    <ul class="list-unstyled activity">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="zmdi zmdi-cake bg-blue"></i>                    
                                <div class="info">
                                    <h4>Admin Birthday</h4>                    
                                    <small>Will be Dec 21th</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="zmdi zmdi-file-text bg-red"></i>
                                <div class="info">
                                    <h4>Code Change</h4>                    
                                    <small>Will be Dec 22th</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="zmdi zmdi-account-box-phone bg-green"></i>
                                <div class="info">
                                    <h4>Add New Contact</h4>                    
                                    <small>Will be Dec 23th</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="zmdi zmdi-email bg-amber"></i>
                                <div class="info">
                                    <h4>New Email</h4>
                                    <small>Will be July 28th</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h6>Project Status</h6>
                    <div class="progress-container progress-primary">
                        <span class="progress-badge">eCommerce Website</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                <span class="progress-value">86%</span>
                            </div>
                        </div>                        
                        <ul class="list-unstyled team-info">
                            <li class="m-r-15"><small>Team</small></li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar2.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar3.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar4.jpg" alt="Avatar">
                            </li>                            
                        </ul>
                    </div>
                    <div class="progress-container">
                        <span class="progress-badge">iOS Game Dev</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                <span class="progress-value">45%</span>
                            </div>
                        </div>
                        <ul class="list-unstyled team-info">
                            <li class="m-r-15"><small>Team</small></li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar10.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar9.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar8.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar7.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar6.jpg" alt="Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="progress-container progress-warning">
                        <span class="progress-badge">Home Development</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;">
                                <span class="progress-value">29%</span>
                            </div>
                        </div>
                        <ul class="list-unstyled team-info">
                            <li class="m-r-15"><small>Team</small></li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar5.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar2.jpg" alt="Avatar">
                            </li>
                            <li>
                                <img src="<?= base_url() ?>/assets/images/xs/avatar7.jpg" alt="Avatar">
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Chat-launcher -->
<div class="chat-launcher"></div>
<div class="chat-wrapper">
    <div class="card">
        <div class="header">
            <ul class="list-unstyled team-info margin-0">
                <li class="m-r-15"><h2>Design Team</h2></li>
                <li>
                    <img src="<?= base_url() ?>/assets/images/xs/avatar2.jpg" alt="Avatar">
                </li>
                <li>
                    <img src="<?= base_url() ?>/assets/images/xs/avatar3.jpg" alt="Avatar">
                </li>
                <li>
                    <img src="<?= base_url() ?>/assets/images/xs/avatar4.jpg" alt="Avatar">
                </li>
                <li>
                    <img src="<?= base_url() ?>/assets/images/xs/avatar6.jpg" alt="Avatar">
                </li>
                <li>
                    <a href="javascript:void(0);" title="Add Member"><i class="zmdi zmdi-plus-circle"></i></a>
                </li>
            </ul>                       
        </div>
        <div class="body">
            <div class="chat-widget">
            <ul class="chat-scroll-list clearfix">
                <li class="left float-left">
                    <img src="<?= base_url() ?>/assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">
                    <div class="chat-info">
                        <a class="name" href="#">Alexander</a>
                        <span class="datetime">6:12</span>                            
                        <span class="message">Hello, John </span>
                    </div>
                </li>
                <li class="right">
                    <div class="chat-info"><span class="datetime">6:15</span> <span class="message">Hi, Alexander<br> How are you!</span> </div>
                </li>
                <li class="right">
                    <div class="chat-info"><span class="datetime">6:16</span> <span class="message">There are many variations of passages of Lorem Ipsum available</span> </div>
                </li>
                <li class="left float-left"> <img src="<?= base_url() ?>/assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                    <div class="chat-info"> <a class="name" href="#">Elizabeth</a> <span class="datetime">6:25</span> <span class="message">Hi, Alexander,<br> John <br> What are you doing?</span> </div>
                </li>
                <li class="left float-left"> <img src="<?= base_url() ?>/assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                    <div class="chat-info"> <a class="name" href="#">Michael</a> <span class="datetime">6:28</span> <span class="message">I would love to join the team.</span> </div>
                </li>
                    <li class="right">
                    <div class="chat-info"><span class="datetime">7:02</span> <span class="message">Hello, <br>Michael</span> </div>
                </li>
            </ul>
            </div>
            <div class="input-group p-t-15">
                <input type="text" class="form-control" placeholder="Enter text here...">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-mail-send"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<?= $this->renderSection('content') ?>
<!-- Jquery Core Js --> 
<script src="<?= base_url() ?>/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="<?= base_url() ?>/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<!-- Plugin Untuk Datatables -->
<script src="<?= base_url() ?>/assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/tables/jquery-datatable.js"></script>

<!-- Akhir Plugin Untuk Datatables -->
<script src="<?= base_url() ?>/assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="<?= base_url() ?>/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="<?= base_url() ?>/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->
<script src="<?= base_url() ?>/assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->

<script src="<?= base_url() ?>/assets/bundles/mainscripts.bundle.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/index.js"></script>

<?= $this->renderSection('javascript') ?>
</body>
</html>