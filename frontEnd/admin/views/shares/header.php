<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TRANG QUẢN TRỊ SPARK</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/dataTables.bootstrap4.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="../../assets/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../../assets/css/responsive.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>

<body>
    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
                <a id="manage" asp-area="Admin" asp-controller="Manager" asp-action="Index" class="header-logo">
                    <img src="../../assets/images/logo.png" class="img-fluid rounded-normal" alt="">
                    <div class="logo-title">
                        <span class="text-primary text-uppercase">SPARK</span>
                    </div>
                </a>
                <div class="iq-menu-bt-sidebar">
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                            <div class="main-circle">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sidebar-scrollbar" style="margin-top: 60px;">
                <hr />
                <nav class="iq-sidebar-menu">
                    
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li><a id="manage" href="http://localhost/webbangiay/frontEnd/admin/views/shoemanager/index.php">
                                <i class="fa-solid fa-th-large"></i>
                                Danh sách giày</a>
                        </li>
                        <li><a id="manage" href="http://localhost/webbangiay/frontEnd/admin/views/brands/brands.php">
                                <i class="fa-solid fa-th-large"></i>
                                Danh sách thương hiệu</a>
                        </li>
                        <li><a id="manage" href="http://localhost/webbangiay/frontEnd/admin/views/material/materials.php">
                                <i class="fa-solid fa-th-large"></i>
                                Danh sách nguyên liệu</a>
                        </li>
                        <li><a id="manage" href="http://localhost/webbangiay/frontEnd/admin/views/type/types.php">
                                <i class="fa-solid fa-th-large"></i>
                                Danh sách loại</a>
                        </li>
                        <li><a id="manage" href="http://localhost/webbangiay/frontEnd/admin/views/order/order.php">
                                <i class="fa-solid fa-th-large"></i>
                                Danh sách đơn đặt hàng</a>
                        </li>
                        <li><a id="manage" href="http://localhost/webbangiay/frontEnd/admin/views/user/index.php">
                        <i class="fa-solid fa-tags"></i> 
                                Tài khoản</a>
                        </li>
                    </ul>
                </nav>
                <div id="sidebar-bottom" class="p-3 position-relative">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <div class="sidebar-bottom-content">
                                <a class="btn w-100 btn-primary mt-4 view-more" href="http://localhost/webbangiay/frontEnd/views/index.php">
                                    <i class="fa-solid fa-home"></i>
                                    Trang chủ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <!-- TOP Nav Bar -->
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-menu-bt d-flex align-items-center">
                        <div class="wrapper-menu">
                            <div class="main-circle"><i class="fa-solid fa-bars"></i></div>
                        </div>
                        <div class="iq-navbar-logo d-flex justify-content-between">
                            <a href="index.html" class="header-logo">
                                <img src="../../assets/images/logo.png" class="img-fluid rounded-normal" alt="">
                                <div class="logo-title">
                                    <span class="text-primary text-uppercase">SPARK</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="navbar-breadcrumb">
                        <h5 class="mb-0">TRANG QUẢN LÝ</h5>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list">
                            <li>
                                
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-- CONTENT -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body">