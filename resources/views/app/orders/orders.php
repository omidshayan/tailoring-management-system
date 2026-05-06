<?php
$title = 'سفارشات';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background: var(--main);
        width: 350px;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .modal-content h3 {
        margin-bottom: 20px;
    }

    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-success {
        background: #28a745;
        color: #fff;
    }

    .btn-danger {
        background: #dc3545;
        color: #fff;
    }

    .finish-link {
        color: orange;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<div class="content">
    <div class="content-title">نمایش سفارشات
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>
    <?php
    $help_title = _help_title;
    $help_content = _help_desc;
    include_once('resources/views/helps/help.php');
    ?>

    <div class="content-container mt20">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام مشتری</th>
                    <th>اجرت دوخت <?= _afghani ?></th>
                    <th>بیعانه <?= _afghani ?></th>
                    <th>اتمام</th>
                    <th>ارسال پیام</th>
                    <th>چاپ</th>
                    <th>ویرایش</th>
                    <th>جزئیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $perPage = 10;
                $data = paginate($orders, $perPage);
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $number = ($currentPage - 1) * $perPage + 1;
                foreach ($data as $order) {
                ?>

                    <!-- modal -->
                    <div id="finishModal" class="modal">
                        <div class="modal-content">
                            <h3>اتمام سفارش</h3>
                            <form method="POST" action="<?= url('end-sewing/' . $order['id']) ?>">
                                <input type="hidden" name="id" id="order_id">

                                <div class="mb20">
                                    <label style="cursor:pointer;">
                                        <input type="checkbox" name="send_whatsapp" value="1">
                                        ارسال پیام واتساپ
                                    </label>
                                </div>
                                <button type="submit" class="btn-success p10 w60 cursor-p border-radius border hover transition">
                                    اتمام
                                </button>
                                <button type="button" class="btn-danger p10 w60 cursor-p border-radius border hover transition mr25" onclick="closeModal()">
                                    لغو
                                </button>
                            </form>
                        </div>
                    </div>

                    <tr>
                        <td class="color <?= ($order['status'] == 2) ? 'bg-orange' : 'bg-green-opacity' ?>"><?= $number ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= number_format($order['total_amount']) ?></td>
                        <td><?= number_format($order['paid_amount']) ?: 0 ?></td>
                        <td>
                            <?= ($order['status'] == 2)
                                ? '<a href="#" onclick="openFinishModal(' . $order['id'] . '); return false;" class="finish-link">اتمام دوخت</a>'
                                : '<span class="color-green">دوخته شده</span>'
                            ?>
                        </td>

                        <?php if ($order['status'] == 4): ?>
                            <td>
                                <a href="<?= url('send-msg/' . $order['id']) ?>" target="_blank" class="color-orange flex-justify-align">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 640 640">
                                        <path fill="rgb(0, 255, 52)" d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z" />
                                    </svg>
                                </a>
                            </td>
                        <?php else: ?>
                            <td class="opacity flex-justify-align">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 640 640">
                                    <path fill="rgb(174, 190, 186)" d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z" />
                                </svg>
                            </td>
                        <?php endif; ?>

                        <td>
                            <div class="flex-justify-align">
                                <?= ($order['status'] == 4)
                                    ? '<a href="' . url('edit-order/' . $order['id']) . '" class="color-orange flex-justify-align">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path fill="rgb(19, 197, 36)" d="M128 128C128 92.7 156.7 64 192 64L405.5 64C422.5 64 438.8 70.7 450.8 82.7L493.3 125.2C505.3 137.2 512 153.5 512 170.5L512 208L128 208L128 128zM64 320C64 284.7 92.7 256 128 256L512 256C547.3 256 576 284.7 576 320L576 416C576 433.7 561.7 448 544 448L512 448L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 448L96 448C78.3 448 64 433.7 64 416L64 320zM192 480L192 512L448 512L448 416L192 416L192 480zM520 336C520 322.7 509.3 312 496 312C482.7 312 472 322.7 472 336C472 349.3 482.7 360 496 360C509.3 360 520 349.3 520 336z"/></svg>
                                </a>'
                                    : '<svg xmlns="http://www.w3.org/2000/svg" class="opacity" width="23" height="23" viewBox="0 0 640 640"><!--!Font Awesome Pro v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2026 Fonticons, Inc.--><path fill="rgb(174, 190, 186)" d="M128 128C128 92.7 156.7 64 192 64L405.5 64C422.5 64 438.8 70.7 450.8 82.7L493.3 125.2C505.3 137.2 512 153.5 512 170.5L512 208L128 208L128 128zM64 320C64 284.7 92.7 256 128 256L512 256C547.3 256 576 284.7 576 320L576 416C576 433.7 561.7 448 544 448L512 448L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 448L96 448C78.3 448 64 433.7 64 416L64 320zM192 480L192 512L448 512L448 416L192 416L192 480zM520 336C520 322.7 509.3 312 496 312C482.7 312 472 322.7 472 336C472 349.3 482.7 360 496 360C509.3 360 520 349.3 520 336z"/></svg>'
                                ?>
                            </div>
                        </td>

                        <td>
                            <div class="flex-justify-align">
                                <?= ($order['status'] == 2)
                                    ? '<a href="' . url('edit-order/' . $order['id']) . '" class="color-orange flex-justify-align">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" class="color-orange" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </a>'
                                    : '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi         bi-pencil-square opacity" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" class="color-orange" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>'
                                ?>
                            </div>
                        </td>
                        <td>
                            <a href="<?= url('order-details/' . $order['id']) ?>" class="flex-justify-align">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" class="color-orange" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php
                    $number++;
                }
                ?>
            </tbody>
        </table>
        <div class="flex-justify-align mt20 paginate-section">
            <div class="table-info fs12">تعداد کل: <?= count($orders) ?></div>
            <?php
            if (count($orders) == null) { ?>
                <div class="center color-red fs12">
                    <i class="fa fa-comment"></i>
                    <?= _not_infos ?>
                </div>
            <?php } else {
                if (count($orders) > 10) {
                    echo paginateView($orders, 10);
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- modal -->
<script>
    function openFinishModal(orderId) {
        document.getElementById('finishModal').style.display = 'block';
        document.getElementById('order_id').value = orderId;
    }

    function closeModal() {
        document.getElementById('finishModal').style.display = 'none';
    }

    window.onclick = function(event) {
        let modal = document.getElementById('finishModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

<!-- chexk for send msg to watsapp -->
<?php if (!empty($_SESSION['send_whatsapp'])): ?>
    <script>
        let data = <?= json_encode($_SESSION['send_whatsapp']) ?>;

        let url = "https://wa.me/" + data.phone + "?text=" + encodeURIComponent(data.message);

        window.open(url, '_blank');
    </script>
    <?php unset($_SESSION['send_whatsapp']); ?>
<?php endif; ?>

<?php include_once('resources/views/layouts/footer.php') ?>