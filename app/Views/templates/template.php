<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">


        <!-- third party css -->
        <link href="<?= base_url(); ?>/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>/assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- App css -->
        <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
        <link href="<?= base_url(); ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

        <style>
            .button-container {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .form-container {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .form-container .form-group {
                margin-right: 10px;
            }

            .button-container .form-container:last-child {
                margin-right: 0;
            }


            .form-group.with-hint:after {
                content: "Masukkan persentasi berupa angka. Contoh : jika 30% tulis angka 30, jika 30.70% tulis 30.70"; /* Hint text */
                display: block;
                font-size: 11px;
                color: #888;
                margin-bottom: 5px;
                }
            .form-group.with-hintrp:after {
                content: "Masukkan angka dengan thousand separator (pemisah ribuan) contoh format: 1,200,000"; /* Hint text */
                display: block;
                font-size: 11px;
                color: #888;
                margin-bottom: 5px;
                }
        </style>

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
    <!-- This include method is called partial concept -->
            <?= $this->include('templates/topleftbar'); ?>

            <?= $this->renderSection('content'); ?>

                 <!-- Footer Start -->
                 <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Unknow Code
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
        <script>
                function validateForm() {
                    var fileInput = document.getElementById('excel_file');
                    if (fileInput.value === '') {
                        alert('Please select an Excel file.');
                        return false;
                    }
                    return true;
                }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/script.js"></script>

        <!-- third party js -->
        <script src="<?= base_url(); ?>/assets/js/vendor/apexcharts.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>

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