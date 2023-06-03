<?php include_once 'sidebar.php';

                        // insert customer info
                        include_once 'db.php';
                        $sql = "SELECT * FROM `users` WHERE id = ? ";
                        $result = $connect->prepare($sql);
                        $result->bindValue(1,$_GET['id']);
                        $result->execute();
                        $row = $result->rowCount();
                        $data = $result->fetch(PDO::FETCH_OBJ);
                         ?>



                    <div class="overview">
                        <div class="all-review">ثبت سفارش جدید</div>
                     </div>   
                     <br>
                     <script>
    $(document).ready(function(){

        $('#search').keyup(function(){
            var search = $('#search').val();
                if(search!=""){
            $.ajax({
                url : 'live-search.php',
                type : 'get',
                data :{
                    'search' : search
                },
                success : function(data){
                        $('.res').html(data)
                }
            })
                }
                else{
                        $('.res').html('')
                }

                    $(document).on('click' , 'a' , function(){
                        $('#search').val($(this).text());
                        $('.res').html('')
                    })


                
        })
// baghimande
                $('#all-price').keyup(function(){
                    var all = $('#all-price').val();
                    $('.remaining').val(all)
        })


                    $('#discount').keyup(function(){
                    let discount = $('#discount').val();
                    let result = $('#all-price').val() - discount;
                    $('.remaining').val(result)
        })
                     $('#prepayment').keyup(function(){
                    let prepayment = $('#prepayment').val();
                    let result = $('#all-price').val() - $('#discount').val() -prepayment;
                    $('.remaining').val(result)
        })

    })
</script>
                        <?php
                        if(isset($_GET['ok'])){
                            echo '<span>result: Ok</span>';
                        }
                                                if(isset($_GET['error'])){
                            echo '<span>not ok</span>';
                        }
?>

        <div class="insert-cars">
        <form action="back/new-order-check.php">
            <div>نام مشتری <span style="color: red;">*</span></div>
            <input type="text" placeholder=" نام مشتری را وارد نمایید ..." name="customer_name" id="search" autocomplete="off" required value="<?=$data->username?>">
            <div>شماره موبایل <span style="color: red;">*</span></div>
            <input type="text" placeholder="شماره موبایل مشتری را وارد نمایید  ..." name="customer_phone" required value="<?=$data->phone?>">
            <div>مدل </div>
            <input type="text" placeholder="مدل را وارد نمایید ..." name="customer_model">
            <div>مبلغ کل</div>
            <input type="text" placeholder="مبلغ کل را وارد نمایید..." name="all_price" id="all-price">
            <div>تخفیف</div>
            <input type="text" placeholder="تخفیف را وارد نمایید ..." name="discount" id="discount">
            <div> پیش پرداخت </div>
            <input type="text" placeholder="پیش پرداخت را وارد نمایید ..." name="prepayment" id="prepayment">
            <div>باقیمانده </div>
            <input type="number" placeholder="باقیمانده را وارد نمایید ..." name="remaining" class="remaining">
            <div>توضیحات </div>
            <input type="text" placeholder="توضیحات را وارد نمایید ..." name="order_desc">
            <input type="hidden" placeholder="توضیحات را وارد نمایید ..." name="id" value="<?=$data->id?>">
            <input type="submit" value="ثبت سفارش جدید" class="my-btn" name="btn">
        </form>
        </div>
        
                     
        </main>

</div>

   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>

