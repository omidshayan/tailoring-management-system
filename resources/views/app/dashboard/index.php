    <?php
    $title = 'داشبورد';
    include_once('resources/views/layouts/header.php') ?>

    <script src="<?= asset('lib/chart.js') ?>"></script>

    <div class="content">

      <div class="report">
        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>تعداد مشتریان ثبت شده<div class="d-flex"><?= $totalCustomers['total'] ?> مشتری</div></span>
          </div>
        </div>

        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>سفارشات در حال دوخت<div class="d-flex"><?= $ordersProgress['total'] ?> سفارش</div></span>
          </div>
        </div>
        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>تعداد کارمندان فعال<div class="d-flex"><?= $employees['total'] ?> کارمند</div></span>
          </div>
        </div>
      </div>
      <!-- end report -->

      <!-- daily reports -->
      <div class="d-box m-auto center mt20 d-flex gap10 w50d w89d">

        <!-- transactions list -->
        <div class="bg-simillar w50d">
          <div class="mini-title p10">
            <div class="box-title">
              روزنامچه
            </div>
            <hr class="hr">

            <ul class="mt10 text-right ho">
              <?php
              $number = 1;
              foreach ($ordersList as $order) { ?>
                <a href="<?= url('order-details/' . $order['id']) ?>" class="color">
                  <li class="p5 hover">
                    <?= $number ?> -
                    سفارش
                    <?= $order['name'] ?>
                    ثبت شد
                  </li>
                </a>
              <?php
                $number++;
              }
              ?>
            </ul>
          </div>
        </div>

        <!-- report -->
        <div class="bg-simillar w50d">
          <div class="mini-title p5">
            گزارش کلی روزنامچه
          </div>
          <hr class="hr">
          <!-- <div class="mt10 p10 text-right">

            <div class="p5">💰 مجموع دریافتی: 454</div>

            <div class="p5">📥 مجموع پرداختی معاش: 44</div>


            <div class="p5">💸 مجموع مصارف: 44</div>
          </div> -->
        </div>

      </div>

      <!-- chart -->
      <div class="parent-dash-chart d-box mt20">
        <div class="dash-chart">
          <canvas id="ordersChart"></canvas>
        </div>
      </div>
      <!-- end chart -->

    </div>


    <!-- charts -->

    <script>
      const ordersData = <?= json_encode($chartData) ?>;

      const labels = ordersData.map(item => {
        return new Date(item.date).toLocaleDateString('fa-IR', {
          weekday: 'long'
        });
      });

      const totals = ordersData.map(item => item.total);

      const ctx = document.getElementById('ordersChart');

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'تعداد سفارشات',
            data: totals,
            backgroundColor: '#4f46e5',
            hoverBackgroundColor: '#3730a3',
            borderRadius: 8,
            borderSkipped: false,
            barThickness: 18
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              enabled: true,
              callbacks: {
                label: function(context) {
                  return 'تعداد سفارشات: ' + context.raw;
                }
              }
            }
          },
          scales: {
            x: {
              grid: {
                display: false
              }
            },
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0
              }
            }
          }
        }
      });
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>