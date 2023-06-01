<?php include_once 'sidebar.php'; ?>


                    <div class="overview">
                        <div class="all-review">افزودن مشتری جدید</div>
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

    })
</script>
                        <?php
                        if(isset($_GET['ok'])){
                            echo '<div class="my-event"><span>مشتری جدید با موفقیت ثبت شد!</span></div>';
                        }
                                                if(isset($_GET['error'])){
                            echo '<span>not ok</span>';
                        }
                        ?>
                     <div class="insert-cars">
            <form action="back/insert-user-check.php">
                <h3 class="my-title">ثبت مشخصات مشتری</h3>
                <div>نام مشتری <span style="color: red;">*</span></div>
                <input type="text" placeholder=" نام مشتری را وارد نمایید ..." name="customer_name" id="search" autocomplete="off" required>
                <div>شماره موبایل <span style="color: red;">*</span></div>
                <input type="text" placeholder="شماره موبایل مشتری را وارد نمایید  ..." name="customer_phone" required>
                <div>رمزعبور</div>
                <input type="text" placeholder="به صورت پیش فرض شماره موبایل رمز عبور است..." name="customer_pass">
                <div>توضیحات</div>
                <input type="text" placeholder="توضیحات اضافی را وارد نمایید  ..." name="customer_desc">
                <h3 class="my-title">ثبت اندازه های مشتری</h3>
                <div>قد </div>
                <input type="text" placeholder=" اندازه قد را وارد نمایید ..." name="customer_height">
                <div>شانه </div>
                <input type="text" placeholder="اندازه شانه را وارد نمایید ..." name="customer_sholder">
                <div>آستین </div>
                <input type="text" placeholder="اندازه آستین را وارد نمایید ..." name="customer_sleeve">
                <div>هخن </div>
                <input type="text" placeholder="اندازه هخن را وارد نمایید ..." name="customer_ice">
                <div>بغل </div>
                <input type="text" placeholder="اندازه بغل را وارد نمایید ..." name="customer_hug">
                <div>دامن </div>
                <input type="text" placeholder="اندازه دامن را وارد نمایید ..." name="customer_skirt">
                <div>چتی </div>
                <input type="text" placeholder="اندازه چتی را وارد نمایید ..." name="customer_chatty">
                <div>شلوار </div>
                <input type="text" placeholder="اندازه شلوار را وارد نمایید ..." name="customer_pants">
                <div>پارچه </div>
                <input type="text" placeholder="اندازه پارچه را وارد نمایید ..." name="customer_cloth">
                <div>بر شلوار </div>
                <input type="text" placeholder="اندازه بر شلوار را وارد نمایید ..." name="customer_bar_pants">
                <div>مدل </div>
                <input type="text" placeholder="مدل را وارد نمایید ..." name="customer_model">
                <div>توضیحات </div>
                <input type="type" placeholder="توضیحات را وارد نمایید ..." name="customer_size_desc">
                <h3 class="my-title">ثبت اندازه های واسکت</h3>
                <div>قد </div>
                <input type="text" placeholder="اندزه قد را وارد نمایید ..." name="vaskat_height">     
                <div>شانه </div>
                <input type="text" placeholder="اندازه شانه را وارد نمایید ..." name="vaskat_sholder">
                <div>چتی </div>
                <input type="text" placeholder="اندازه چتی را وارد نمایید ..." name="vaskat_chatty">
                <div>توضیحات </div>
                <input type="text" placeholder="توضیحات را وارد نمایید ..." name="vaskat_desc">

                <input type="submit" value="ثبت مشتری جدید" class="my-btn" name="btn">
            </form>
                     </div>
                        
                     
                </main>

        </div>


 


 




   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>