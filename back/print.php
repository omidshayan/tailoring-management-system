<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <script src="../js/jquery.js"></script>
    <title>چاپ شماره پارکینگ</title>
    <style>

    </style>
</head>
<body>

<script>
        $(document).ready(function () {
            window.print();
        });
</script>
    <?php
include_once '../db.php';
$mean = $_GET['id'];

echo '<div class="print">
<span>شماره پارکینگ </span></br>
'.$mean.'
</div>
';

?>


</body>
</html>
