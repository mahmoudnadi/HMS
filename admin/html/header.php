<?php
echo <<<_END
<!doctype html>
<html  class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reeves Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../images/icon/favicon.ico">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/metisMenu.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/slicknav.min.css">
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.jqueryui.min.css">

    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../css/typography.css">
    <link rel="stylesheet" href="../css/default-css.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- modernizr css -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="../js/activePage.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->

    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="../index.php">Reeves Hotel</a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li name="dashboard">
                                <a href="index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li name="bookings">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Bookings</span></a>
                                <ul class="collapse">
                                    <li><a href="#">New Booking</a></li>
                                    <li><a href="#">Edit Booking</a></li>
                                    <li><a href="#">View Bookings</a></li>
                                </ul>
                            </li>
                            <li id="rooms">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Rooms</span></a>
                                <ul class="collapse">
                                    <li><a href="roomTypes.php">Room Types</a></li>
                                    <li><a href="newRoom.php">New Room</a></li>
                                    <li><a href="editRoom.php">Edit Room</a></li>
                                    <li><a href="viewRooms.php">View Rooms</a></li>
                                </ul>
                            </li>
                            <li name="halls">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>Halls</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Hall Types</a></li>
                                    <li><a href="#">New Hall</a></li>
                                    <li><a href="#">Edit Hall</a></li>
                                    <li><a href="#">View Halls</a></li>
                                </ul>
                            </li>
                            <li name="guests">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>Guests</span></a>
                                <ul class="collapse">
                                    <li><a href="newGuests.php">New Guest</a></li>
                                    <li><a href="editGuests.php"><?php">Edit Guest</a></li>
                                    <li><a href="viewGuests.php">View Guests</a></li>
                                </ul>
                            </li>
                            <li name="employees">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i><span>Employees</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Add Employee</a></li>
                                    <li><a href="#">Edit Employee</a></li>
                                    <li><a href="#">View Employees</a></li>
                                </ul>
                            </li>
                            <li name="users">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i><span>Users</span></a>
                                <ul class="collapse">
                                    <li><a href="#">User Types</a></li>
                                    <li><a href="#">Add User</a></li>
                                    <li><a href="#">Edit User</a></li>
                                    <li><a href="#">View Users</a></li>
                                </ul>
                            </li>
                            <li name="jobTasks">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-exclamation-triangle"></i><span>Job Tasks</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Job Categories</a></li>
                                    <li><a href="#">New Task</a></li>
                                    <li><a href="#">Edit Task</a></li>
                                    <li><a href="#">View All Tasks</a></li>
                                </ul>
                            </li>
                            <li name="services">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-exclamation-triangle"></i><span>Services</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Service Categories</a></li>
                                    <li><a href="#">New Service</a></li>
                                    <li><a href="#">Edit Service</a></li>
                                    <li><a href="#">View All Services</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
_END;
?>
