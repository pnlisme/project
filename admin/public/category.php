<head>
  <link rel="stylesheet" href="./layout/css/category.css">
</head>
<main class="main">
  <h1 class="title">Danh mục</h1>
  <div class="table-scroll">
    <table class="category table">
      <thead class="table-head">
        <tr>
          <th>Tên danh mục</th>
          <th>Ẩn</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody class="table-body category-form-show">
        <!-- table -->
      </tbody>
    </table>
    <button class="table-button button category-add">
      <p>Thêm danh mục</p>
    </button>
  </div>
  <div class="category-form">
    <div class="category-form-container">
      <h2 class="sub-title category-form-title">Thêm danh mục</h2><button class="category-form-close" href="#">
        <ion-icon name="close-circle-outline"></ion-icon></button>
      <div class="category-form-table">
        <form action="#" method="post" id="formAddCategory">
          <table class="category-form-group table">
            <thead class="table-head">
              <tr>
                <th>Tên danh mục</th>
                <th>Hàng động</th>
              </tr>
            </thead>
            <tbody class="table-body category-form-body">
              <tr>
                <td>
                  <input id="category_add" name="category_name" type="text" placeholder="Nhập tên danh mục">
                </td>
                <td>
                  <button class="button btnAddCategory" type="button">Thêm danh mục</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  <div class="category-form">
    <div class="category-form-container">
      <h2 class="sub-title category-form-title">Chỉnh sửa danh mục</h2><a class="category-form-close" href="#">
        <ion-icon name="close-circle-outline"></ion-icon></a>
      <div class="category-form-table">
        <form action="#" id="formUpCategory">
          <table class="category-form-group table">
            <thead class="table-head">
              <tr>
                <th>Tên thể loại</th>
                <th>Hàng động</th>
              </tr>
            </thead>
            <tbody class="table-body category-form-body">
              <tr>
                <td>
                  <input id="category_up" name="category_name" type="text" placeholder="Nhập tên danh mục">
                </td>
                <td>
                  <button class="button" id="btnUpCategory" type="button" onclick="categoryUp(this)">Chỉnh sửa danh mục</button>
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
<script src="./layout/js/category.js"> </script>