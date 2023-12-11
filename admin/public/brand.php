<head>
  <link rel="stylesheet" href="./layout/css/brand.css">
</head>
<main class="main">
  <h1 class="title">Thương hiệu</h1>
  <div class="table-scroll">
    <table class="brand table">
      <thead class="table-head">
        <tr>
          <th>Tên thương hiệu</th>
          <th>Ẩn</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody class="table-body brand-form-show">
        <!-- table -->
      </tbody>
    </table>
    <button class="table-button button brand-add">
      <p>Thêm thương hiệu</p>
    </button>
  </div>
  <div class="brand-form">
    <div class="brand-form-container">
      <h2 class="sub-title brand-form-title">Thêm thương hiệu</h2><button class="brand-form-close" href="#">
        <ion-icon name="close-circle-outline"></ion-icon></button>
      <div class="brand-form-table">
        <form method="post" id="formAddbrand">
          <table class="brand-form-group table">
            <thead class="table-head">
              <tr>
                <th>Tên thương hiệu</th>
                <th>Hàng động</th>
              </tr>
            </thead>
            <tbody class="table-body brand-form-body">
              <tr>
                <td>
                  <input id="brand_add" name="brand_name" type="text" placeholder="Nhập tên thương hiệu">
                </td>
                <td>
                  <button class="button btnAddbrand" type="button">Thêm thương hiệu</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  <div class="brand-form">
    <div class="brand-form-container">
      <h2 class="sub-title brand-form-title">Chỉnh sửa thương hiệu</h2><a class="brand-form-close" href="#">
        <ion-icon name="close-circle-outline"></ion-icon></a>
      <div class="brand-form-table">
        <form id="formUpbrand">
          <table class="brand-form-group table">
            <thead class="table-head">
              <tr>
                <th>Tên thương hiệu</th>
                <th>Hàng động</th>
              </tr>
            </thead>
            <tbody class="table-body brand-form-body">
              <tr>
                <td>
                  <input id="brand_up" name="brand_name" type="text" placeholder="Nhập tên thương hiệu">
                </td>
                <td>
                  <button class="button" id="btnUpbrand" type="button" onclick=brandUp(this)>Chỉnh sửa thương hiệu</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</main>
</div>
<script src="./layout/js/brand.js"> </script>