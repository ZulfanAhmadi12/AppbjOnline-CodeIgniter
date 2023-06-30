<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/favicon.ico">


        <!-- third party css -->
        <link href="<?= base_url(); ?>/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


        <!-- App css -->
        <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
        <link href="<?= base_url(); ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

        <style>
            .masthead-heading {
                font-size: 3rem;
                font-weight: 600;
                line-height: 2rem;
                margin-bottom: 2rem;
                margin-top: 2rem;
                font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            };
            .text-uppercase {
                text-transform: uppercase !important;
            };
        </style>

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
 <!-- ========== Left Sidebar Start ========== -->
 <div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="/" class="logo text-center logo-light">
        <span class="logo-lg">
            <img style="width: 170px; height: 35px" src="<?= base_url(); ?>/assets/images/polda-white.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img style="width: 35px; height: 35px" src="<?= base_url(); ?>/assets/images/polda.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="/" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="<?= base_url(); ?>/assets/images/polda1.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="<?= base_url(); ?>/assets/images/polda.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="/" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Halaman Utama </span>
                </a>
            </li>
            
            <li class="side-nav-item">
                <a href="/tabel" class="side-nav-link">
                    <i class="uil-table"></i>
                    <span> Tabel Data </span>
                </a>
            </li>

            <?php if(logged_in()) : ?>
                <li class="side-nav-item">
                    <a href="/ubah/password" class="side-nav-link">
                        <i class="uil-lock-alt"></i>
                        <span> Ubah Password </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(!in_groups('admin')) : ?>
                <li class="side-nav-item">
                    <a href="/tabel/tambahdata" class="side-nav-link">
                        <i class="uil-folder-plus"></i>
                        <span> Tambah Data </span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->


<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topbar-menu float-end mb-0">
                <li class="dropdown notification-list d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="dripicons-search noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                        <form class="p-3">
                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>
                <?php if(logged_in()) : ?>
                <li class="notification-list">
                    
                    <a href="/logout" class="btn btn-primary btn-lg mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"/></svg>
                    Logout
                    </a>
    
                </li>
                <?php else : ?>
                <li class="notification-list">
                    
                <a href="/login" class="btn btn-primary btn-lg mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M8 0a4 4 0 0 1 4 4v1a4 4 0 0 1-8 0V4a4 4 0 0 1 4-4zm1 7H7V6h2v1zm4 1a5.978 5.978 0 0 0-3.56 1.206A6 6 0 0 0 0 13a6 6 0 0 0 12 0 6 6 0 0 0-4.44-5.794A5.978 5.978 0 0 0 13 8zm-1 3a4.978 4.978 0 0 1-2.94-.994 3.982 3.982 0 0 1-1.862-1.862A4.978 4.978 0 0 1 11 8a4.978 4.978 0 0 1-1.206 3.56A3.982 3.982 0 0 1 7.932 12.94 4.978 4.978 0 0 1 8 11z"/>
                    </svg>
                    Login
                    </a>

                </li>
                <?php endif; ?>


            </ul>
            <button class="button-menu-mobile open-left">
                <i class="mdi mdi-menu"></i>
            </button>
            
           
        </div>
        <!-- end Topbar -->

            <?= $this->renderSection('content'); ?>

                 <!-- Footer Start -->
                 <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Sisppbj by Zulfan & Ihya
                            </div>
                            
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->               
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <?= $this->include('templates/rightsidebar'); ?>

        <!-- bundle -->
        <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/script.js"></script>

        <!-- third party js -->
        <script src="<?= base_url(); ?>/assets/js/vendor/apexcharts.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

        <script src="<?= base_url(); ?>/assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/buttons.bootstrap5.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/buttons.flash.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/dataTables.select.min.js"></script>
        <script src="https://kit.fontawesome.com/30c1edcb14.js" crossorigin="anonymous"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="<?= base_url(); ?>/assets/js/pages/demo.dashboard.js"></script>
        <script src="<?= base_url(); ?>/assets/js/pages/demo.datatable-init.js"></script>
        <!-- end demo js-->
    </body>
</html>