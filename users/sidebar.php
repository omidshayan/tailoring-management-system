<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
        <script src="../js/jquery.js"></script>
    <title> سیستم مدیریت خیاطی</title>
</head>

<body>

<!-- header -->

<div class="menu-toggle"></div>

    <!-- sidebar -->
   <div class="sidebar">
       <div class="sidebar-container">
            <div class="brand">
                <h3>
                    <span class='fas fa-address-card' style="font-size: 30px;"></span>
                    سیستم مدیریت خیاطی
                </h3>
            </div>
            <div class="sidebar-avatar">
                <div class="profile-image">
                    <img src="img/profile.png" alt="">
                </div>
                <div class="avatar-info">
                    <div class="avatar-text">
                        <ul class="nav-login">
                                <li class="main-sub-menu">
                                    <h4>کاربر</h4>
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
                    <li><a href="panel.php">
                        <i class="fas fa-home"></i>
                        <span>صفحه اصلی</span>
                    </a></li>
                    <li>
                        <a href="orders.php">
                            <span class="fas fa-list-alt"></span>
                            <span>سفارشات</span>
                        </a>
                    </li>
                    <li>
                        <a href="show-customer.php">
                            <span class="fas fa-plus"></span>
                            <span>نمایش مشتری ها</span>
                        </a>
                    </li>
                    <li>
                        <a href="back/exit.php">
                            <span class="fas fa-sign-out-alt"></span>
                            <span>خروج</span>
                        </a>
                    </li>
                    
                    <div class="about">
                    <span>Copyright 2022  شعیب</span>
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
                    <div class="header-action">
                        <form action="search.php">
                                <input type="text" name="data-search" placeholder="شماره موبایل مشتری را وارد کنید...">
                                <button class="btn btn-main">
                                <span class="fas fa-search"></span>
                                </button>
                        </form>

                    </div>
            </header>






            <!-- box -->
        

                <main>