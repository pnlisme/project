<?php
include_once('../model/global.php');
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
            <p>Tổng người dùng</p>
          </div>
          <div class="overview-count"> <span>100</span></div>
        </div>
        <div class="overview-icon"><ion-icon name="eye-outline"></ion-icon></div>
      </div>
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng người dùng</p>
          </div>
          <div class="overview-count"> <span>100</span></div>
        </div>
        <div class="overview-icon"><ion-icon name="eye-outline"></ion-icon></div>
      </div>
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng người dùng</p>
          </div>
          <div class="overview-count"> <span>100</span></div>
        </div>
        <div class="overview-icon"><ion-icon name="eye-outline"></ion-icon></div>
      </div>
      <div class="overview-item">
        <div class="overview-content">
          <div class="overview-title">
            <p>Tổng người dùng</p>
          </div>
          <div class="overview-count"> <span>100</span></div>
        </div>
        <div class="overview-icon"><ion-icon name="eye-outline"></ion-icon></div>
      </div>
    </div>
  </div>
  <div class="statistic">
    <div class="statistic-list">
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê sản phẩm</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p>5 sản phẩm mới được thêm trong tháng này!</p>
        </div>
      </div>
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê sản phẩm</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p>5 sản phẩm mới được thêm trong tháng này!</p>
        </div>
      </div>
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê sản phẩm</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p>5 sản phẩm mới được thêm trong tháng này!</p>
        </div>
      </div>
      <div class="statistic-item">
        <div class="statistic-content">
          <div class="statistic-title">
            <p>Thống kê sản phẩm</p>
          </div>
          <div class="statistic-icon">
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </div>
        </div>
        <div class="statistic-dropdown">
          <p>5 sản phẩm mới được thêm trong tháng này!</p>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="./layout/js/dashboard.js"> </script>