<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); // get current file name
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <span class="brand-title">My Admin</span>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Admin Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
                                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li>
                        <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-single-04"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-label">Master Data</li>
                    <li>
                        <a href="brandview.php" class="<?= ($currentPage == 'brandview.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-tag"></i>
                            <span class="nav-text">Brands</span>
                        </a>
                    </li>
                    <li>
                        <a href="districtview.php" class="<?= ($currentPage == 'districtview.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-location-pin"></i>
                            <span class="nav-text">Districts</span>
                        </a>
                    </li>
                    <li>
                        <a href="categoryview.php" class="<?= ($currentPage == 'categoryview.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-layers"></i>
                            <span class="nav-text">Categories</span>
                        </a>
                    </li>

                    <li>
                        <a href="report.php" class="<?= ($currentPage == 'report.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-layers"></i>
                            <span class="btn btn-danger">Reports</span>
                        </a>
                    </li>

                    <li class="nav-label">Verification</li>
                    <li>
                        <a href="sellerverification.php" class="<?= ($currentPage == 'sellerverification.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-user"></i>
                            <span class="nav-text">Seller Verification</span>
                        </a>
                    </li>
                     <li class="nav-label">Sellers</li>
                    <li>
                        <a href="sellerview.php" class="<?= ($currentPage == 'sellerview.php') ? 'mm-active' : '' ?>">
                            <i class="icon icon-people"></i>
                            <span class="nav-text">View Sellers</span>
                        </a>
                    </li>
                    

                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
