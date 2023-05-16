<?php include_once 'sidebar.php'; ?>
                    <div class="overview">
                        <div class="all-review">صفحه اصلی</div>


                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-align-center"></i>
                            </div>
                            <div class="overview-text">
                                <a href="show-orders.php">
                                    <h4>تعداد کل مشتری ها</h4>
                                </a>
                                   
                                <?php
                                    include_once "db.php"; 
                                        $sql = "SELECT * FROM `users`";
                                        $result = $connect->query($sql);
                                        $rows = $result->rowCount();
                                ?>
                                <h5> <?=$rows?> عدد</h5>
                            </div>
                        </div>



                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-align-center"></i>
                            </div>
                            <div class="overview-text">
                                <a href="show-orders.php">
                                    <h4>تعداد کل سفارش ها</h4>
                                </a>
                                   
                                <?php
                                        $sql = "SELECT * FROM `orders`";
                                        $result = $connect->query($sql);
                                        $rows = $result->rowCount();
                                ?>
                                <h5> <?=$rows?> عدد</h5>
                            </div>
                        </div>



                        <div class="overview-item">
                            <div class="overview-icon">
                            <i class="fas fa-list"></i>
                            </div>
                            <div class="overview-text">
                            <a href="sewing.php">
                                <h4>  در حال دوخت</h4>
                            </a>
                                   
                                   <?php
                                           $sql = "SELECT * FROM `orders` WHERE `state` = 1";
                                           $result = $connect->query($sql);
                                           $rows = $result->rowCount();
                                   ?>
                                   <h5> <?=$rows?> عدد</h5>
                            </div>
                        </div>

                        <div class="overview-item">
                            <div class="overview-icon">
                            <i class="far fa-address-book"></i>
                            </div>
                            <div class="overview-text">
                            <a href="finish.php">
                                <h4>دوخته شده</h4>
                            </a>
                                   
                                   <?php
                                           $sql = "SELECT * FROM `orders` WHERE `state` = 0";
                                           $result = $connect->query($sql);
                                           $rows = $result->rowCount();
                                   ?>
                                   <h5> <?=$rows?> عدد</h5>
                            </div>
                        </div>


                    </div>
                </main>

        </div>

   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>