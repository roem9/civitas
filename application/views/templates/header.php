<?php

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    

    <!-- Custom fonts for this template-->
    <link href="<?= base_url()?>assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- <link href="<?= base_url()?>assets/css/simple-sidebar.css" rel="stylesheet"> -->
  
    <link href="<?= base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url()?>assets/css/style3.css" rel="stylesheet">
    
    <link rel="icon" href="<?=base_url()?>assets/img/logo-tarq.jpg">

    <script src="<?= base_url()?>assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  
    <title><?= $title?></title>
</head>

<body>
    
<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
          <div class="list-group list-group-flush">
            <a href="<?= base_url()?>" class="list-group-item list-group-item-action" id="beranda"><i class="fa fa-home mr-1"></i>Beranda</a>
            <!-- <a href="<?= base_url()?>inbox" class="list-group-item list-group-item-action d-flex justify-content-between" id="inbox"> -->
              <!-- <?php if($jml_inbox == 0):?> -->
                <!-- <span><i class="fa fa-inbox mr-1"></i>Inbox</span> -->
              <!-- <?php else :?> -->
                <!-- <span><i class="fa fa-inbox mr-1"></i>Inbox</span> <span class="badge badge-danger"><?= $jml_inbox?></span> -->
              <!-- <?php endif;?> -->
            <!-- </a> -->
            <a class="list-group-item list-group-item-action d-flex justify-content-between" id="kelasku"><span><i class="fa fa-clock mr-1"></i>Jadwal KBM</span> <span class="badge badge-danger"><?= $jml_kelas?></span></a>
            <div class="hari">
              <a href="<?= base_url()?>kelas" class="list-group-item list-group-item-action d-flex justify-content-between"><span class="ml-4">Semua Hari</span> <span class="badge badge-danger"><?= $jml_kelas?></span></a>
              <?php if($jml['ahad'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/ahad" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Ahad</span> 
                  <span class="badge badge-danger"><?= $jml['ahad']?></span>
                </a>
              <?php endif;?>
              <?php if($jml['senin'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/senin" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Senin</span> 
                  <span class="badge badge-danger"><?= $jml['senin']?></span>
                </a>
              <?php endif;?>
              <?php if($jml['selasa'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/selasa" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Selasa</span> 
                  <span class="badge badge-danger"><?= $jml['selasa']?></span>
                </a>
              <?php endif;?>
              <?php if($jml['rabu'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/rabu" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Rabu</span> 
                  <span class="badge badge-danger"><?= $jml['rabu']?></span>
                </a>
              <?php endif;?>
              <?php if($jml['kamis'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/kamis" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Kamis</span> 
                  <span class="badge badge-danger"><?= $jml['kamis']?></span>
                </a>
              <?php endif;?>
              <?php if($jml['jumat'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/jumat" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Jumat</span> 
                  <span class="badge badge-danger"><?= $jml['jumat']?></span>
                </a>
              <?php endif;?>
              <?php if($jml['sabtu'] != 0):?>
                <a href="<?= base_url()?>kelas/hari/sabtu" class="list-group-item list-group-item-action d-flex justify-content-between">
                  <span class="ml-4">Sabtu</span> 
                    <span class="badge badge-danger"><?= $jml['sabtu']?></span>
                </a>
              <?php endif;?>
            </div>
            <a href="<?= base_url()?>kelas/badal" id="jadwal_badal" class="list-group-item list-group-item-action d-flex justify-content-between">
              <span><i class="fa fa-exchange-alt mr-1"></i>Jadwal Badal</span>
              <?php if($jml_badal != 0):?>
                <span class="badge badge-danger"><?= $jml_badal?></span>
              <?php endif;?>
            </a>
            <a href="<?= base_url()?>kelas/wl" class="list-group-item list-group-item-action d-flex justify-content-between" id="wl">
              <span><i class="fa fa-list mr-1"></i>Waiting List</span>
              <?php if($jml_wl != 0):?>
                <span class="badge badge-danger"><?= $jml_wl?></span>
              <?php endif;?>
            </a>
            <a href="<?= base_url()?>kesediaan" class="list-group-item list-group-item-action" id="kesediaan"><i class="fa fa-car mr-1"></i>Kesediaan Mengajar</a>
            <a href="<?= base_url()?>pengaturan/profil" class="list-group-item list-group-item-action" id="profil"><i class="fa fa-user-cog mr-1"></i>Pengaturan Profil</a>
            <a href="<?= base_url()?>pengaturan/foto" class="list-group-item list-group-item-action" id="foto"><i class="fa fa-image mr-1"></i>Upload Foto</a>
            <a href="<?= base_url()?>pengaturan/password" class="list-group-item list-group-item-action" id="password"><i class="fa fa-key mr-1"></i>Pengaturan Password</a>
            <a href="<?= base_url()?>auth/logout" onclick="return confirm('Yakin akan keluar?')" class="list-group-item list-group-item-action"><i class="fa fa-sign-out-alt mr-1"></i>Keluar</a>

          </div>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-info sticky-top navbar-ku">
                <div class="container">
                    <a id="sidebarCollapse" class="btn btn-sm"><i class="fa fa-bars text-light"></i><span class="ml-3 text-light"><b><?= $title?></b></span></a>
                </div>
            </nav>
