
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
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold"><?=lang('Auth.loginTitle')?></h4>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form action="<?= url_to('login') ?>" method="post">
                                <?= csrf_field() ?>

                                <?php if ($config->validFields === ['email']): ?>
                                    <div class="form-group">
                                        <label for="login" class="form-label"><?=lang('Auth.email')?></label>
                                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
								   name="login" placeholder="<?=lang('Auth.email')?>">
                                        <div class="invalid-feedback">
								         <?= session('errors.login') ?>
							            </div>
                                    </div>
                                <?php else: ?>
                                    <div class="form-group">
                                        <label for="login" class="form-label"><?=lang('Auth.emailOrUsername')?></label>
                                        <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
								        name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                                        <div class="invalid-feedback">
							            	<?= session('errors.login') ?>
							            </div>
                                    </div>
                                <?php endif; ?>
                                    <div class="form-group">
                                        <label for="password" class="form-label mt-1"><?=lang('Auth.password')?></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            <div class="invalid-feedback">
								                <?= session('errors.password') ?>
							                </div>
                                        </div>
                                    </div>
                                    <?php if ($config->allowRemembering): ?>
                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="mt-3 mb-1 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                            <?php if ($config->allowRegistration) : ?>
                                <p class="text-muted">Don't have an account? <a href="<?= url_to('register') ?>" class="text-muted ms-1"><b><?=lang('Auth.needAnAccount')?></b></a></p>
                            <?php endif; ?>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
<?= $this->endSection(); ?>