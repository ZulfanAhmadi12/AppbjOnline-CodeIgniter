<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/favicon.ico">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <!-- App css -->
        <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="<?= base_url(); ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <?= $this->renderSection('content'); ?>

    <footer class="footer footer-alt">
            Sisppbj App
        </footer>

        <!-- bundle -->
        <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>
        
    </body>
</html>