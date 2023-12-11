<head>
  <link rel="stylesheet" href="./layout/css/order.css" />
</head>
<main class="main">
  <h1 class="title">Đơn hàng</h1>
  <div class="filter">
    <div class="filter-select">
      <select id="filter-select" onchange="filterOrder(this)">
        <option value="all">Tất cả</option>
        <option value="0">Chờ xác nhận</option>
        <option value="1">Đang vận chuyển</option>
        <option value="2">Đã giao</option>
        <option value="3">Đã hủy</option>
      </select>
    </div>
    <div class="filter-search">
      <input id="filter-search" type="text" placeholder="Nhập từ khoá" onkeyup="searchOrder(this)" />
    </div>
  </div>
  <div class="table-container">
    <table class="order table">
      <thead class="table-head">
        <tr>
          <th>Tên người dùng</th>
          <th>Họ và tên</th>
          <th>Thời gian</th>
          <th>Tổng tiền</th>
          <th>Trạng thái</th>
          <th>Hàng động</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <!-- show order in here -->
      </tbody>
    </table>
  </div>
  <div class="table-page">
    <!-- show page index in here -->
  </div>
  <form action="#" onsubmit="return false" id="formUpdateOrder">
    <div class="order-form">
      <div class="order-form-container">
        <h2 class="sub-title order-form-title">Đơn hàng chi tiết</h2><a class="order-form-close" href="#">
          <ion-icon name="close-circle-outline"></ion-icon></a>
        <div class="order-form-content">
          <!-- show order detail in here -->
        </div>
      </div>
    </div>
  </form>
</main>
<script src="./layout/js/order.js"></script>