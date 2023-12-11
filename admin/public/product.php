<?php
$show_option_category = "";
foreach ($category as $item) {
  extract($item);
  $show_option_category .= '<option value="' . $id . '">' . $name . '</option>';
}
$show_option_brand = "";
foreach ($brand as $item) {
  extract($item);
  $show_option_brand .= '<option value="' . $id . '">' . $name . '</option>';
}
?>

<head>
  <link rel="stylesheet" href="./layout/css/product.css">
</head>
<main class="main">
  <h1 class="title">Sản phẩm</h1>
  <div class="filter">
    <div class="filter-select">
      <!-- filter -->
    </div>
    <div class="filter-search">
      <input id="filter-search" type="text" placeholder="Nhập từ khoá" onkeyup="loadProductInInput(this)" />
    </div>
  </div>
  <div class="table-container">
    <table class="product table">
      <thead class="table-head">
        <tr>
          <th>
            <ion-icon name="image-outline"></ion-icon>
          </th>
          <th>Tên sản phẩm</th>
          <th>Thời gian nhập</th>
          <th>Số lượng</th>
          <th>Giá</th>
          <th>Danh mục</th>
          <th>Thương hiệu</th>
          <th>Hàng động</th>
        </tr>
      </thead>
      <tbody class="table-body" id="show-product-in-table-body">
        <!-- show product in table body -->
      </tbody>
    </table>
  </div>
  <button class="table-button button product-add">
    <p>Thêm sản phẩm</p>
  </button>
  <div class="table-page">
    <!-- show page index -->
  </div>
  <form action="#" onsubmit="return false" id="formAddProduct" enctype="multipart/form-data">
    <div class=" product-form">
      <div class="product-form-container">
        <h2 class="sub-title product-form-title">Thêm mới sản phẩm</h2><a class="product-form-close" href="#">
          <ion-icon name="close-circle-outline"></ion-icon></a>
        <div class="product-form-content">
          <label>Chọn danh mục:</label>
          <select name="category" class="product-form-select">
            <option disabled selected>-- Danh mục --</option>
            <?= $show_option_category ?>
          </select>
          <label>Chọn thương hiệu:</label>
          <select name="brand" class="product-form-select">
            <option disabled selected>-- Thương hiệu --</option>
            <?= $show_option_brand ?>
          </select>
          <label>Hình ảnh sản phẩm:</label>
          <input class="product-form-input" name="img_main" type="file" onchange="loadImgInputAdd(this)">
          <div class="show-image">
            <img id="product-img-show" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" alt="product-image">
            <div class="remove-img" onclick="removeImgInputAdd(this)"><ion-icon name="trash-outline"></ion-icon></div>
          </div>
          <label for="">Ảnh phụ:</label>
          <div class="product-form-subimg">
            <div class="product-form-subimg-container">
              <input class="product-form-input" name="img_1" type="file" onchange="loadImgInputAdd(this)">
              <div class="show-image">
                <img id="product-img-show" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" alt="product-image">
                <div class="remove-img" onclick="removeImgInputAdd(this)"><ion-icon name="trash-outline"></ion-icon></div>
              </div>
            </div>
            <div class="product-form-subimg-container">
              <input class="product-form-input" name="img_2" type="file" onchange="loadImgInputAdd(this)">
              <div class="show-image">
                <img id="product-img-show" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" alt="product-image">
                <div class="remove-img" onclick="removeImgInputAdd(this)"><ion-icon name="trash-outline"></ion-icon></div>
              </div>
            </div>
            <div class="product-form-subimg-container">
              <input class="product-form-input" name="img_3" type="file" onchange="loadImgInputAdd(this)">
              <div class="show-image">
                <img id="product-img-show" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" alt="product-image">
                <div class="remove-img" onclick="removeImgInputAdd(this)"><ion-icon name="trash-outline"></ion-icon></div>
              </div>
            </div>
            <div class="product-form-subimg-container">
              <input class="product-form-input" name="img_4" type="file" onchange="loadImgInputAdd(this)">
              <div class="show-image">
                <img id="product-img-show" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" alt="product-image">
                <div class="remove-img" onclick="removeImgInputAdd(this)"><ion-icon name="trash-outline"></ion-icon></div>
              </div>
            </div>
          </div>
          <label>Tên sản phẩm:</label>
          <input class="product-form-input" name="name" type="text" placeholder="Nhập tên sản phẩm">
          <label>Giá bán ảo (Hiển thị khi lớn hơn giá bán thực tế):</label>
          <input class="product-form-input" name="price" type="text" placeholder="Nhập giá sản phẩm">
          <label>Giá bán thực tế: </label>
          <input class="product-form-input" name="price_sale" type="text" placeholder="Nhập giá sản phẩm">
          <label>Giảm giá:</label>
          <div class="product-form-radio-container">
            <div>
              <input type="radio" name="sale" id="sale-y" value="1" checked>
              <label for="sale-y">Có!</label>
            </div>
            <div>
              <input type="radio" name="sale" id="sale-n" value="0">
              <label for="sale-n">Không!</label>
            </div>
          </div>
          <label>Bán chạy:</label>
          <div class="product-form-radio-container">
            <div>
              <input type="radio" name="hot" id="hot-y" value="1" checked>
              <label for="hot-y">Có!</label>
            </div>
            <div>
              <input type="radio" name="hot" id="hot-n" value="0">
              <label for="hot-n">Không!</label>
            </div>
          </div>
          <label>Trạng thái:</label>
          <div class="product-form-radio-container">
            <div>
              <input type="radio" name="status" id="status-y" value="1" checked>
              <label for="status-y">Có!</label>
            </div>
            <div>
              <input type="radio" name="status" id="status-n" value="0">
              <label for="status-n">Không!</label>
            </div>
          </div>
          <div class="product-form-input-container">
            <div>
              <label for="entry-date">Ngày nhập hàng:</label>
              <input type="text" name="entry-date" placeholder="Ngày nhập sản phẩm">
            </div>
            <div>
              <label for="quantity">Số lượng:</label>
              <input type="text" name="quantity" placeholder="Nhập số lượng sản phẩm">
            </div>
          </div>
          <label>Lượt xem:</label>
          <input class="product-form-input" name="view" type="text" placeholder="Lượt xem sản phẩm">
          <label>Mô tả sản phẩm:</label><textarea id="editor-add" name="description"></textarea>
          <button class="product-form-button button" type="submit" onclick="addProductBtn()">Thêm sản phẩm</button>
        </div>
      </div>
    </div>
  </form>
  <form action="#" onsubmit="return false" id="formUpdateProduct" enctype="multipart/form-data">
    <div class=" product-form">
      <div id="formUpProduct" class="product-form-container">
        <!-- show form update product -->
      </div>
    </div>
  </form>
</main>
<script src="./layout/js/product.js"></script>