<head>
  <link rel="stylesheet" href="./layout/css/account.css">
</head>
<main class="main">
  <h1 class="title">Tài khoản</h1>
  <div class="filter">
    <div class="filter-select">
      <select id="filter-select" onchange="selectAcc(this)">
        <option default value="">Tất cả</option>
        <option value="0">Người dùng</option>
        <option value="1">Quản lí</option>
        <option value="2">Nhân viên</option>
        <option value="3">Hoạt động</option>
        <option value="4">Bị cấm</option>
      </select>
    </div>
    <div class="filter-search">
      <input id="filter-search" type="text" placeholder="Nhập từ khoá" onkeyup="searchAcc(this)" />
    </div>
  </div>
  <div class="table-container">
    <table class="account table">
      <thead class="table-head">
        <tr>
          <th>
            <ion-icon name="image-outline"></ion-icon>
          </th>
          <th>Tên đầy đủ</th>
          <th>Tên người dùng</th>
          <th>Điện thoại</th>
          <th>Email </th>
          <th>Trạng thái</th>
          <th>Quyền hạn</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <!-- show account in table -->
      </tbody>
    </table>
  </div>
  <div class="table-page">
    <!-- show page in here -->
  </div>
  <form action="#" onsubmit="return false" id="formUpAcc">
    <div class="account-form">
      <div class="account-form-container open-form">
        <h2 class="sub-title account-form-title">Chỉnh sửa tài khoản </h2><a class="account-form-close" href="#">
          <ion-icon name="close-circle-outline" role="img" class="md hydrated"></ion-icon>
        </a>
        <div class="account-form-content">
          <!-- show info in here -->
        </div>
      </div>
    </div>
  </form>
</main>
<script src="./layout/js/account.js"> </script>