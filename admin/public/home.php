<?php
include_once('../model/global.php');
include_once('../model/product.php');
include_once('../model/order.php');
include_once('../model/user.php');
extract($admin);
if (is_file(PATH_ACCOUNT_ADMIN . $user_img)) {
  $user_img = PATH_ACCOUNT_ADMIN . $user_img;
} else {
  $user_img = PATH_ACCOUNT_ADMIN . 'user.png';
}
if ($phone == '' || $phone == null) {
  $phone = 'Chưa cập nhật';
}
if ($role == 1) {
  $role = 'Quản trị viên';
} else {
  $role = 'Nhân viên';
}

$product_new = product_count_now();
$product_all = product_count_all();

$order_new = order_count_now();
$order_all = order_count_all();

$user_new = user_count_now();
$user_all = user_count_all();

$total_now = total_now();
$total_all = total_all();

$chart = chart_total();


// Khởi tạo mảng $m với giá trị mặc định là 0 cho tất cả các tháng
$m = array_fill(1, 12, 0);

// Cập nhật giá trị từ mảng $chart
for ($i = 0; $i < count($chart); $i++) {
  $month = $chart[$i]['month'];
  $total = $chart[$i]['total'];

  // Kiểm tra xem $month có nằm trong khoảng từ 1 đến 12 không
  if ($month >= 1 && $month <= 12) {
    $m[$month] = $total;
  }
}

// echo var_dump($m);
?>

<head>
  <link rel="stylesheet" href="./layout/css/dashboard.css">
</head>
<main class="main">
  <div class="db-account">
    <div class="db-account-image"><img srcset="<?= $user_img ?> 2x" alt="user-image"></div>
    <div class="db-account-info">
      <div class="db-account-container">
        <div class="db-account-info-name"><b>Xin chào</b> <?= $full_name ?></div><span>-</span>
        <div class="db-account-info-email">Email: <?= $email ?></div><span>-</span>
        <div class="db-account-info-phone">Số điện thoại: <?= $phone ?></div>
      </div>
      <div class="db-account-role"> <span><?= $role ?></span></div>
    </div>
  </div>
  <h1 class="title">Bảng điều khiển</h1>
  <canvas id="chartStatistic" style="width:100%;max-width:100%;"></canvas>
  <div class="overview container">
    <div class="overview-list">
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng sản phẩm</p>
          </div>
          <div class="overview-count"> <span><?= $product_all ?></span></div>
        </div>
        <div class="overview-icon"><ion-icon name="cube-outline"></ion-icon></div>
      </div>
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng đơn hàng</p>
          </div>
          <div class="overview-count"> <span><?= $order_all ?></span></div>
        </div>
        <div class="overview-icon"><ion-icon name="cart-outline"></ion-icon></div>
      </div>
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng người dùng</p>
          </div>
          <div class="overview-count"> <span><?= $user_all ?></span></div>
        </div>
        <div class="overview-icon"><ion-icon name="people-circle-outline"></ion-icon></div>
      </div>
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng thu nhập</p>
          </div>
          <div class="overview-count"> <span><?= $total_all ?></span></div>
        </div>
        <div class="overview-icon"><ion-icon name="card-outline"></ion-icon></div>
      </div>
    </div>
  </div>
  <div class="statistic">
    <div class="statistic-list">
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê sản phẩm mới</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p><?= $product_new ?> sản phẩm mới được thêm trong tháng này!</p>
        </div>
      </div>
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê đơn hàng mới</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p><?= $order_new ?> đơn hàng mới được thêm trong tháng này!</p>
        </div>
      </div>
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê người dùng mới</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p><?= $user_new ?> người dùng mới được thêm trong tháng này!</p>
        </div>
      </div>
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê thu nhập mới</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p><?= $total_now ?> VND mới được thêm trong tháng này!</p>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="./layout/js/dashboard.js"> </script>
<script>
  // Chart
  var xValues = [
    "Tháng 1",
    "Tháng 2",
    "Tháng 3",
    "Tháng 4",
    "Tháng 5",
    "Tháng 6",
    "Tháng 7",
    "Tháng 8",
    "Tháng 9",
    "Tháng 10",
    "Tháng 11",
    "Tháng 12",
  ];
  var yValues = [<?= $m['1'] ?>, <?= $m['2'] ?>, <?= $m['3'] ?>, <?= $m['4'] ?>, <?= $m['5'] ?>, <?= $m['6'] ?>, <?= $m['7'] ?>, <?= $m['8'] ?>, <?= $m['9'] ?>, <?= $m['10'] ?>, <?= $m['11'] ?>, <?= $m['12'] ?>];
  var barColors = "#3577F0";

  var chart = new Chart("chartStatistic", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues,
      }, ],
    },
    options: {
      legend: {
        display: false
      },
      title: {
        display: true,
        text: "Biểu đồ doanh thu trong năm 2023",
        fontFamily: "Plus Jakarta Sans, sans-serif",
        fontSize: 20,
        fontStyle: "italic",
        fontWeight: "400",
      },
    },
  });
</script>