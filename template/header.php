<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
  <meta name="author" content="Coderthemes">

  <link rel="shortcut icon" href="assets/images/favicon_1.png">

  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="assets/plugins/morris/morris.css">
  <link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />

  <!-- Form Select -->
  <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
  <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
  <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

  <!-- DataTables -->
  <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

  <!-- Template -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

  <script src="assets/js/modernizr.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>

</head>


<body class="fixed-left">

  <!-- Begin page -->
  <div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

      <!-- LOGO -->
      <div class="topbar-left">
        <div class="text-center">
          <a href="#" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Admin</span></a>
        </div>
      </div>

      <!-- Button mobile view to collapse sidebar menu -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="">
            <div class="pull-left">
              <button class="button-menu-mobile open-left waves-effect waves-light">
                <i class="md md-menu"></i>
              </button>
              <span class="clearfix"></span>
            </div>
             <ul class="nav navbar-nav navbar-right pull-right">
              <li class="dropdown top-menu-item-xs">
                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/default_admin.jpg" alt="user-img" class="img-circle"> </a>
                <ul class="dropdown-menu">
                  <li><a href="<?= url('set_akun') ?>"><i class="ti-user m-r-10 text-custom"></i>Atur Akun</a></li>
                  <li><a href="config.php?logout=true"><i class="ti-power-off m-r-10 text-danger"></i>Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
          <ul>
           <li class="has_sub" id="home">
            <a href="<?= url('debit_kredit') ?>" class="waves-effect">
              <i class="ti-wallet"></i> Debit/Kredit
            </a>
          </li>

          <li class="has_sub" id="home">
            <a href="<?= url('laporan') ?>" class="waves-effect">
              <i class="ti-clipboard"></i> Laporan
            </a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <!-- Left Sidebar End -->



  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
      <div class="container" id="content">