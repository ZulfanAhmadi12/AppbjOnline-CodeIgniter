 <!-- ========== Left Sidebar Start ========== -->
 <div class="leftside-menu">
    <!-- LOGO -->
    <a href="/" class="logo text-center logo-light">
        <span class="logo-lg">
            <img style="width: 170px; height: 35px" src="<?= base_url() ?>/assets/images/polda-white.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img style="width: 35px; height: 35px" src="<?= base_url() ?>/assets/images/polda.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-item">
                <a href="/" class="side-nav-link">
                    <i class="uil-home-alt fs-5"></i>
                    <span class="menu-title fs-6">Halaman Utama</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="/tabel" class="side-nav-link">
                    <i class="uil-table fs-5"></i>
                    <span class="menu-title fs-6">Tabel Data</span>
                </a>
            </li>

            <?php if(!in_groups('admin')) : ?>
                <li class="side-nav-item">
                    <a href="/tabel/tambahdata" class="side-nav-link">
                        <i class="uil-folder-plus fs-5"></i>
                        <span class="menu-title fs-6">Tambah Data</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <li class="side-nav-item">
                <a href="https://drive.google.com/file/d/1x5DT-e356THfCZ_kLmnAL0bXob_l4ExD/view?usp=sharing" class="side-nav-link" target="_blank">
                    <i class="uil-book fs-5"></i>
                    <span class="menu-title fs-6">Buku Panduan</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link" target="_blank">
                    <i class="uil-play-circle fs-5"></i>
                    <span class="menu-title fs-6">Video Panduan</span>
                </a>
            </li>
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
                

                <li class="notification-list">
                    <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                        <i class="dripicons-gear noti-icon"></i>
                    </a>
                </li>

                <?php if (logged_in()) : ?>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar"> 
                            <img src="<?= base_url() ?>assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                        </span>
                        <span>
                            <span class="account-user-name mt-1" style="text-transform: uppercase;"><?= user()->username; ?></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                        

                        <!-- item-->
                        <a href="<?= base_url('logout'); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
                <?php endif; ?>

            </ul>
            <button class="button-menu-mobile open-left">
                <i class="mdi mdi-menu"></i>
            </button>
            
           
        </div>
        <!-- end Topbar -->