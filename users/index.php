<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">

    <title> سیستم گدام داری افغان فیضی</title>
</head>

<body>
<!-- login form -->
        <div class="login">
            <div class="login-form">
                    <h2>ورود به سیستم</h2>
                    <?php
                    if(isset($_GET['error'])){
                        echo '<span class="mytxt">اطلاعات وارد شده اشتباه است!</span>';
                    }
                    ?>
                    
                <div class="avatar-login">
                    <img src="../img/profile.png" alt="">
                </div><br>
                <form action="back/login-check.php" method="POST">
                    <span> شماره موبایل </span><br>
                    <input type="text"  name="username"  placeholder=" شماره موبایل خود را وارد کنید..." required><br>
                    <span>رمزعبور</span><br>
                    <input type="password" name="password" placeholder="رمز عبور خود را وارد کنید..." required>
                     <input type="submit" value=" ورود " name="" class="my-btn btn-custom">

                </form>
            </div>
        </div>


   <!-- js library -->
    <script src="../js/fontA.js"></script>
    <script src="../js/custom.js"></script>
</body>
</html>