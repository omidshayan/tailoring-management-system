<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/fav.png" type="image/x-icon">  
    <link rel="stylesheet" href="styles/style.css">
        <script src="js/jquery.js"></script>
    <title>خیاطی آرمان</title>
</head>

<body>

<!-- header -->

<div class="menu-toggle"></div>

    <!-- sidebar -->
   <div class="sidebar">
       <div class="sidebar-container">
            <div class="brand">
                <h3>
                    <span class="logo-img"> <img src="img/logo.png" alt="سیستم مدیریت خیاطی"></span>
                    سیستم مدیریت خیاطی
                </h3>
            </div>
            <div class="sidebar-avatar">
                <div class="profile-image">
                    <img src="img/profile.png" alt="سیستم مدیریت خیاطی">
                </div>
                <div class="avatar-info">
                    <div class="avatar-text">
                        <ul class="nav-login">
                                <li class="main-sub-menu">
                                    <h4> مدیر </h4>
                                    <ul class="sub-menu">
                                    <li><a href="back/exit.php">خروج</a></li>
                                    </ul>
                                </li>
                        </ul>
                    </div>
                    <span class="fas fa-chevron-down"></span>
                </div>
            </div>
            <hr class="hr">
            <div class="sidebar-menu">
                <ul>
                    <li><a href="home.php">
                        <i class="fas fa-home"></i>
                        <span>صفحه اصلی</span>
                    </a></li>
                    <li>
                        <a href="insert-customer.php">
                            <span class="fas fa-list-alt"></span>
                            <span>ثبت مشتری جدید</span>
                        </a>
                    </li>
                    <li>
                        <a href="show-customer.php">
                            <span class="fas fa-plus"></span>
                            <span>نمایش مشتری ها</span>
                        </a>
                    </li>
                    <li class="menu-accordion"><a class="menuItemLink"
                        >
                            <span class="fas fa-code-branch"></span>
                            <span>سفارشات</span>
                        </a>
                    </li>
                    <ul class="menu-panel">
                        <a href="show-orders.php"> <li>همه سفارشات</li></a>
                        <a href="sewing.php"> <li>در حال دوخت</li></a>
                        <a href="finish.php"><li>دوخته شده</li></a>
                    </ul>
                    <li>
                        <a href="back/exit.php">
                            <span class="fas fa-sign-out-alt"></span>
                            <span>خروج</span>
                        </a>
                    </li>
                    
                    <div class="about">
                    <span><a href="https://aryatech.af" target="blank"> آریا تِک </a> Copyright 2022 </span>
                    </div>

                </ul>
                
            </div>
       </div>
   </div>

   <!-- mian content -->

        <div class="main-content">
            <header>
                <div class="hamber">
                    <div class="hamber-icon">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>

                <div class="header-search">
                <div class="header-action">
                        <form action="search-name.php">
                                <input type="text" name="data-search" placeholder="جستجو بر اساس نام مشتری...">
                                <button class="btn btn-main">
                                <span class="fas fa-search"></span>
                                </button>
                        </form>
                    </div>
                    <div class="header-action">
                        <form action="search.php">
                                <input type="text" name="data-search" placeholder="جستجو بر اساس شماره موبایل مشتری...">
                                <button class="btn btn-main">
                                <span class="fas fa-search"></span>
                                </button>
                        </form>
                    </div>
                </div>
            </header>






            <!-- box -->
        

                <main>