<?= $this->extend('templates/template_login'); ?>

<?= $this->section('content'); ?>
<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="<?= base_url(); ?>/assets/images/polda-white.png" alt="" height="18" style="width: 300px; height:80px;"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold"><?= "Input Kata Sandi Baru" ?></h4>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <?php $validation = \Config\Services::validation(); ?>
                                <form action="<?= url_to('updatepassword') ?>" method="POST">
                                <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="password_lama" class="form-label mt-1">Kata Sandi Lama</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password_lama" class="form-control <?= $validation->hasError('password_lama') ? 'is-invalid' : '' ?>" placeholder="<?=lang('Auth.password')?>">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <?php if($validation->hasError('password_lama')) {?>
                                                <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('password_lama'); ?>
                                                </div>
                                        <?php }?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label mt-1">Kata Sandi Baru</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" placeholder="<?=lang('Auth.password')?>">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <?php if($validation->hasError('password')) {?>
                                                <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('password'); ?>
                                                </div>
                                        <?php }?>
                                    </div>
                                    <div class="form-group">
                                        <label for="konfirmasi_password" class="form-label mt-1">Konfirmasi Kata Sandi Baru</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="konfirmasi_password" class="form-control <?= $validation->hasError('konfirmasi_password') ? 'is-invalid' : '' ?>" placeholder="<?=lang('Auth.password')?>">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                        <?php if($validation->getError('konfirmasi_password')) {?>
                                                <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('konfirmasi_password'); ?>
                                                </div>
                                            <?php }?>
                                    </div>

                                    <div class="mt-3 mb-1 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Ubah Password </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

<?= $this->endSection(); ?>