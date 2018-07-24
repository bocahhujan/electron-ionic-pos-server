<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POS - Point Of Sale</title>
	<!-- Bootstrap Styles-->
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->

        <!-- Custom Styles-->
    <link href="<?php echo base_url() ?>/assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
     <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="<?php echo base_url() ?>/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/plugin/datepicker/datepicker3.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/plugin/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>">Point Of Sale</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="<?php echo base_url().'auth/logout'?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url().'order'?>"><i class="fa fa-edit"></i> Order</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url().'kategori'?>"><i class="fa fa-desktop"></i> Kategori Barang</a>
                    </li>
					          <li>
                        <a href="<?php echo base_url().'barang'?>"><i class="fa fa-bar-chart-o"></i> Data Barang</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'operator'?>"><i class="fa fa-qrcode"></i> Operator Sistem</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Laporan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url().'transaksi/laporan'?>">Transaksi</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'barang/laporanstok'?>">Stok</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'transaksi/penjualan_harian'?>">Penjualan Per Hari</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'transaksi/penjualan_harian_perkategori'?>">Penjualan Per Hari Per Kategori</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url().'transaksi/penjualan_produk'?>">Fast Moving Menu</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url().'transaksi/penjualan_detail_perhari'?>">Laporan Penjualan Menu</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url().'transaksi/perpordakkategori'?>">Per Prodak Kategori</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'auth/logout'?>"><i class="fa fa-fw fa-file"></i> Keluar</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                    <?php echo $contents; ?>
            </div>
            <!-- /. PAGE INNER  -->
            <footer></footer>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url() ?>/assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url() ?>/assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() ?>/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/dataTables/dataTables.bootstrap.js"></script>

    <!-- Morris Chart Js -->
    <script src="<?php echo base_url() ?>/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/morris/morris.js"></script>

    <!-- Morris Chart Js -->
    <script src="<?php echo base_url() ?>/assets/plugin/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugin/datetimepicker/bootstrap-datetimepicker.min.js"></script>


    <script src="<?php echo base_url() ?>/assets/js/jquery.hotkeys/jquery.hotkeys.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url() ?>/assets/js/custom-scripts.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
                $('.datepicker').datepicker();
                $('.datepicker2').datepicker();
                $('#datetimepicker').datetimepicker();
                $('#datetimepicker2').datetimepicker();
            });
    </script>


</body>
</html>
