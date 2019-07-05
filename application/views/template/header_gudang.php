<?php $d=$this->db->query('SELECT * FROM user WHERE id_user='.$this->session->userdata('id_user'))->row();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pit Stop</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url();?>assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
      <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.min.css" rel="stylesheet">
     <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>gudang" class="site_title"><i class="fa fa-cogs"></i> <span>Pit Stop</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- <img src="<?php echo base_url();?>" alt="..." class="img-circle profile_img"> -->
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $d->nama_user;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Gudang</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url()?>gudang"><i class="fa fa-home"></i>Home</a>
                  <li><a><i class="fa fa-bicycle"></i> Spareparts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>Gudang/beli">Pembelian Spareparts</a></li>
                      <li><a href="<?php echo base_url();?>Gudang/daftar">Daftar Spareparts</a></li>
                    </ul>
                  </li>
            
                  <li><a><i class="fa fa-edit"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>gudang/transaksi">Daftar Transaksi</a></li>
                      <li><a href="<?php echo base_url();?>gudang/harian">Laporan Harian</a></li>
                      <li><a href="<?php echo base_url();?>gudang/bulanan">Laporan Bulanan</a></li>
                      <li><a href="<?php echo base_url();?>gudang/tahunan">Laporan Tahunan</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="<?php echo base_url();?>" alt=""> --><?php echo $d->nama_user;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a data-toggle="modal" data-target="#profil" id-user="<?php echo $this->session->userdata('id_user')?>" class="btn btneditprofil">Profil</a></li>
                    <li><a href="<?php echo base_url()?>Welcome/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->

<div class="modal fade" id="profil">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Profil Anda</h4>
      </div>
      <div class="modal-body">
       <form action="<?php echo base_url(); ?>Welcome/update" id="" method="post" name="login">
                  <div class="form-group has-feedback">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Nama Anda</label>
                           <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama_user" value="nama_user" id="nama_user" required="" data-toggle="tooltip" title="Ganti Nama Anda"/>
                           <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        </div>
                        <div class="col-md-6 col-lg-6">
                          <input type="hidden" name="id" value="id_user" id="id_user"> 
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <label for="int">Username</label>
                           <input type="text" class="form-control" placeholder="Username" name="username" value="username" id="username" data-toggle="tooltip" title="Ganti Username Anda"/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="int">Password</label>
                          <input type="text" class="form-control" placeholder="Password" name="password" value="password" id="password" data-toggle="tooltip" title="Ganti Password Anda"/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="int">Bagian</label>
                          <input type="text" class="form-control" placeholder="Password" id="status" readonly="" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <label for="int">Bergabung Sejak</label>
                          <input type="text" class="form-control" placeholder="Password" id="since" readonly="" />
                        </div>
                     </div>
               </div>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
               <span data-toggle="tooltip" title="Batal">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
               </span>
               <span data-toggle="tooltip" title="Simpan Perubahan">
               <button type="submit" class="btn btn-primary " href="">Simpan</button>
               </span>
            </div>
            </form>
    </div>
    </div>
  </div>
</div>