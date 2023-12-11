<?php
include_once('../../model/pdo.php');
include_once('../../model/global.php');
include_once('../../model/category.php');
include_once('../../model/brand.php');
include_once('../../model/product.php');

function show_table_product($products)
{
  $showProduct = "";
  foreach ($products as $product) {
    extract($product);
    if (is_file('../' . PATH_PRODUCT_ADMIN . $img)) {
      $img = PATH_PRODUCT_ADMIN . $img;
    } else {
      $img = PATH_PRODUCT_ADMIN . "no-image.jpeg";
    }
    if ($quantity == 0) {
      $quantity = '<p style="color: #ff497c;">Hết hàng</p>';
    } else {
      $quantity = '<p>' . $quantity . '</p>';
    }
    $showProduct .= '<tr>
                      <td>
                        <div class="product-image"> <img src="' . $img . '" alt="product"></div>
                      </td>
                      <td>
                        <div class="product-name">
                          <p>' . $name . '</p>
                        </div>
                      </td>
                      <td>
                        <div class="product-entry-date">
                          <p>' . $entry_date . '</p>
                        </div>
                      </td>
                      <td>
                        <div class="product-quantity">
                          <p>' . $quantity . '</p>
                        </div>
                      </td>
                      <td>
                        <div class="product-price">
                          <del>' . $price . ' VND</del>
                          <p>' . $price_sale . ' VND</p>
                        </div>
                      </td>
                      <td>
                        <div class="product-category">
                          <p>' . $category_name . '</p>
                        </div>
                      </td>
                      <td>
                        <div class="product-brand">
                          <p>' . $brand_name . '</p>
                        </div>
                      </td>
                      <td>
                        <div class="product-action"> <a class="product-update" value="' . $id . '" onclick="openFormUp(this)" href="#">
                            <ion-icon name="create-outline"></ion-icon></a><span>|</span><a value="' . $id . '" onclick="deleteProduct(this)" href="#">
                            <ion-icon name="trash-outline"></ion-icon></a></div>
                      </td>
                    </tr>';
  }
  return $showProduct;
}

if ($_GET['func'] == "show") {
  if (isset($_POST['page'])) {
    $page = ($_POST['page'] - 1) * 6;
  } else {
    $page = 0;
  }
  if (isset($_POST['name']) && $_POST['name'] != "") {
    $name = $_POST['name'];
  } else {
    $name = "";
  }
  $sql = "SELECT product.*, category.name AS category_name, brand.name AS brand_name
  FROM product
  JOIN category ON product.id_category = category.id
  JOIN brand ON product.id_brand = brand.id
  WHERE product.name LIKE '%" . $name . "%'
  OR category.name LIKE '%" . $name . "%'
  OR brand.name LIKE '%" . $name . "%'
  ORDER BY product.id DESC
  LIMIT 6 OFFSET " . $page . ";
  ";

  $products = pdo_query($sql);
  $showProduct = show_table_product($products);
  print_r($showProduct);
}

if ($_GET['func'] == 'page') {
  $pages = product_count_all();
  $pages = (int)$pages;
  $page = ceil($pages / 6);
  // print_r($page);
  $showPageIndex = '';
  for ($i = 1; $i <= $page; $i++) {
    $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadProductInPage(this)" href="#"><span>' . $i . '</span></a>';
  }
  print_r($showPageIndex);
}

if ($_GET['func'] == 'up') {
  if (isset($_POST['id'])) {
    $product_detail = product_detail($_POST['id']);
    if ($product_detail['sale'] == 1) {
      $sale = '<div>
                  <input type="radio" name="sale" id="sale-y" value="1" checked>
                  <label for="sale-y">Có!</label>
                </div>
                <div>
                  <input type="radio" name="sale" id="sale-n" value="0">
                  <label for="sale-n">Không!</label>
                </div>';
    } else {
      $sale = '<div>
                  <input type="radio" name="sale" id="sale-y" value="1">
                  <label for="sale-y">Có!</label>
                </div>
                <div>
                  <input type="radio" name="sale" id="sale-n" value="0" checked>
                  <label for="sale-n">Không!</label>
                </div>';
    }
    if ($product_detail['hot'] == 1) {
      $hot = '<div>
                <input type="radio" name="hot" id="hot-y" value="1" checked>
                <label for="hot-y">Có!</label>
              </div>
              <div>
                <input type="radio" name="hot" id="hot-n" value="0">
                <label for="hot-n">Không!</label>
              </div>';
    } else {
      $hot = '<div>
                <input type="radio" name="hot" id="hot-y" value="1">
                <label for="hot-y">Có!</label>
              </div>
              <div>
                <input type="radio" name="hot" id="hot-n" value="0" checked>
                <label for="hot-n">Không!</label>
              </div>';
    }
    if ($product_detail['status'] == 1) {
      $status = '<div>
                  <input type="radio" name="status" id="status-y" value="1" checked>
                  <label for="status-y">Có!</label>
                </div>
                <div>
                  <input type="radio" name="status" id="status-n" value="0">
                  <label for="status-n">Không!</label>
                </div>';
    } else {
      $status = '<div>
                <input type="radio" name="status" id="status-y" value="1">
                <label for="status-y">Có!</label>
              </div>
              <div>
                <input type="radio" name="status" id="status-n" value="0" checked>
                <label for="status-n">Không!</label>
              </div>';
    }
    for ($i = 0; $i <= 4; $i++) {
      if ($i == 0) {
        if ($product_detail['img'] == "") {
          $img = PATH_PRODUCT_ADMIN . "no-image.jpeg";
        } else {
          if (is_file('../' . PATH_PRODUCT_ADMIN . $product_detail['img'])) {
            $img = PATH_PRODUCT_ADMIN . $product_detail['img'];
          } else {
            $img = PATH_PRODUCT_ADMIN . "no-image.jpeg";
          }
        }
      } else {
        if ($product_detail['img_' . $i] == "") {
          $product_detail['img_' . $i] = PATH_PRODUCT_ADMIN . "no-image.jpeg";
        } else {
          if (is_file('../' . PATH_PRODUCT_ADMIN . $product_detail['img_' . $i])) {
            $product_detail['img_' . $i] = PATH_PRODUCT_ADMIN . $product_detail['img_' . $i];
          } else {
            $product_detail['img_' . $i] = PATH_PRODUCT_ADMIN . "no-image.jpeg";
          }
        }
      }
    }

    $categories = category_select_all();
    $show_option_category = "";
    foreach ($categories as $category) {
      if ($category['id'] == $product_detail['id_category']) {
        $show_option_category .= '<option value="' . $category['id'] . '" selected>' . $category['name'] . '</option>';
      } else {
        $show_option_category .= '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
      }
    }
    $brands = brand_select_all();
    $show_option_brand = "";
    foreach ($brands as $brand) {
      if ($brand['id'] == $product_detail['id_brand']) {
        $show_option_brand .= '<option value="' . $brand['id'] . '" selected>' . $brand['name'] . '</option>';
      } else {
        $show_option_brand .= '<option value="' . $brand['id'] . '">' . $brand['name'] . '</option>';
      }
    }

    $showProductDetail = '<h2 class="sub-title product-form-title">Chỉnh sửa sản phẩm</h2><a class="product-form-close" href="#">
                            <ion-icon name="close-circle-outline"></ion-icon></a>
                          <div class="product-form-content">
                            <label>Chọn danh mục:</label>
                            <select name="category" class="product-form-select">
                              <option disable default>-- Danh mục --</option>
                              ' . $show_option_category . '
                            </select>
                            <label>Chọn thương hiệu:</label>
                            <select name="brand" class="product-form-select">
                              <option disable default>-- Thương hiệu --</option>
                              ' . $show_option_brand . '
                            </select>
                            <label>Hình ảnh sản phẩm:</label>
                            <input type="file" name="img_main" id="" onchange="loadImgInput(this)">
                            <div class="show-image-up">
                              <img src="' . $img . '" alt="product image">
                              <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline"></ion-icon></div>
                            </div>
                            <label for="">Ảnh phụ:</label>
                            <div class="product-form-subimg">
                              <div class="product-form-subimg-container">
                                <input type="file" name="img_1" id="" onchange="loadImgInput(this)">
                                <div class="show-image-up">
                                  <img src="' . $product_detail['img_1'] . '" alt="product image">
                                  <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline"></ion-icon></div>
                                </div>
                              </div>
                              <div class="product-form-subimg-container">
                                <input type="file" name="img_2" id="" onchange="loadImgInput(this)">
                                <div class="show-image-up">
                                  <img src="' . $product_detail['img_2'] . '" alt="product image">
                                  <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline"></ion-icon></div>
                                </div>
                              </div>
                              <div class="product-form-subimg-container">
                                <input type="file" name="img_3" id="" onchange="loadImgInput(this)">
                                <div class="show-image-up">
                                  <img src="' . $product_detail['img_3'] . '" alt="product image">
                                  <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline"></ion-icon></div>
                                </div>
                              </div>
                              <div class="product-form-subimg-container">
                                <input type="file" name="img_4" id="" onchange="loadImgInput(this)">
                                <div class="show-image-up">
                                  <img src="' . $product_detail['img_4'] . '" alt="product image">
                                  <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline"></ion-icon></div>
                                </div>
                              </div>
                            </div>
                            <label>Tên sản phẩm:</label>
                            <input class="product-form-input" name="name" type="text" placeholder="Nhập tên sản phẩm" value="' . $product_detail['name'] . '">
                            <label>Giá bán ảo (Hiển thị khi lớn hơn giá bán thực tế):</label>
                            <input class="product-form-input" type="text" name="price" placeholder="Nhập giá sản phẩm" value="' . $product_detail['price'] . '">
                            <label>Giá bán thực tế: </label>
                            <input class="product-form-input" type="text" name="price_sale" placeholder="Nhập giá sản phẩm" value="' . $product_detail['price_sale'] . '">
                            <label>Giảm giá:</label>
                            <div class="product-form-radio-container">
                              ' . $sale . '
                            </div>
                            <label>Bán chạy:</label>
                            <div class="product-form-radio-container">
                            ' . $hot . '
                            </div>
                            <label>Trạng thái:</label>
                            <div class="product-form-radio-container">
                              ' . $status . '
                            </div>
                            <div class="product-form-input-container">
                              <div>
                                <label for="entry-date">Ngày nhập hàng:</label>
                                <input type="text" name="entry_date" placeholder="Ngày nhập sản phẩm:" value="' . $product_detail['entry_date'] . '">
                              </div>
                              <div>
                                <label for="quantity">Số lượng:</label>
                                <input type="text" name="quantity" placeholder="Nhập số lượng" value="' . $product_detail['quantity'] . '">
                              </div>
                            </div>
                            <label>Lượt xem:</label>
                            <input class="product-form-input" type="text" name="view" placeholder="Lượt xem sản phẩm" value="' . $product_detail['view'] . '">
                            <label>Mô tả sản phẩm:</label><textarea id="editor-up" name="description">' . $product_detail['des'] . '</textarea>
                            <button class="product-form-button button" type="submit" id="' . $product_detail['id_product'] . '" onclick="updateProduct(this)">Chỉnh sửa sản phẩm</button>
                          </div>';
  }
  echo $showProductDetail;
}

if ($_GET['func'] == 'upProd') {
  // print_r($_POST);
  // print_r($_FILES);
  // print_r($_GET);
  $id_product = $_GET['id'];
  $product_detail = product_select_by_id($id_product);
  $product_detail_img = product_detail_select_by_id($id_product);
  $products_different = products_select_different($id_product);
  $product_detail_different = products_detail_select_different($id_product);
  $response = array();

  $id_category = $_POST['category'];
  $id_brand = $_POST['brand'];
  if ($_FILES['img_main']['name'] != "") {
    foreach ($products_different as $product_different) {
      if ($product_different['img'] == $_FILES['img_main']['name']) {
        $img_main = "no-image";
        $response['imgmain'] = 'fail';
      } else {
        $img_main = $_FILES['img_main']['name'];
        $img_tmp_main = $_FILES['img_main']['tmp_name'];
      }
    }
  } else {
    $img_main = $product_detail['img'];
  }
  for ($i = 1; $i <= 4; $i++) {
    if ($_FILES['img_' . $i]['name'] != "") {
      foreach ($product_detail_different as $product_detail_different) {
        if ($product_detail_different['img_' . $i] == $_FILES['img_' . $i]['name']) {
          ${'img_' . $i} = "";
          $response['imgsub'] = 'fail';
        } else {
          ${'img_' . $i} = $_FILES['img_' . $i]['name'];
          ${'img_tmp_' . $i} = $_FILES['img_' . $i]['tmp_name'];
        }
      }
    } else {
      ${'img_' . $i} = $product_detail_img['img_' . $i];
    }
  }
  $name = $_POST['name'];
  $price = $_POST['price'];
  $price_sale = $_POST['price_sale'];
  $sale = $_POST['sale'];
  $hot = $_POST['hot'];
  $status = $_POST['status'];
  $view = $_POST['view'];
  $des = $_POST['description'];
  $entry_date = $_POST['entry_date'];
  $quantity = $_POST['quantity'];

  if (!($response['imgmain'] == 'fail' || $response['imgsub'] == 'fail')) {
    if (product_update($id_product, $img_main, $name, $price, $price_sale, $sale, $hot, $status, $view, $id_category, $id_brand, $des, $entry_date, $quantity)) {
      $response['result'] = 'fail';
    } else {
      if ($_FILES['img_main']['name'] != "") {
        if (file_exists('../' . PATH_PRODUCT_ADMIN . $product_detail['img']) && $_FILES['img_main']['name'] != 'no-image.jpeg') {
          unlink('../' . PATH_PRODUCT_ADMIN . $product_detail['img']);
        }
        move_uploaded_file($img_tmp_main, '../' . PATH_PRODUCT_ADMIN . $img_main);
      }
      $response['result'] = 'success';
    }
    if (product_detail_update($img_1, $img_2, $img_3, $img_4, $id_product)) {
      $response['result'] = 'fail';
    } else {
      $response['result'] = 'success';
      for ($i = 1; $i <= 4; $i++) {
        if ($_FILES['img_' . $i]['name'] != "") {
          if (file_exists('../' . PATH_PRODUCT_ADMIN . $product_detail_img['img_' . $i]) && $_FILES['img_' . $i]['name'] != 'no-image.jpeg') {
            unlink('../' . PATH_PRODUCT_ADMIN . $product_detail_img['img_' . $i]);
          }
          move_uploaded_file(${'img_tmp_' . $i}, '../' . PATH_PRODUCT_ADMIN . ${'img_' . $i});
        }
      }
    }
  }

  $sql = "SELECT product.*, category.name AS category_name, brand.name AS brand_name
  FROM product
  JOIN category ON product.id_category = category.id
  JOIN brand ON product.id_brand = brand.id
  ORDER BY product.id DESC
  LIMIT 6 OFFSET 0;
  ";

  $products = pdo_query($sql);
  $response['html'] = show_table_product($products);
  echo json_encode($response);
}

if ($_GET['func'] == "addProd") {
  $id_product = (int)product_count_all() + 1;
  $category = $_POST['category'];
  $brand = $_POST['brand'];
  $response = array();
  if ($_FILES['img_main']['name'] != "") {
    $img_main = $_FILES['img_main']['name'];
    $img_tmp_main = $_FILES['img_main']['tmp_name'];
    if (file_exists('../' . PATH_PRODUCT_ADMIN . $img_main)) {
      $img_main = "no-image.jpeg";
      $response['imgmain'] = 'fail';
    }
  } else {
    $img_main = "no-image.jpeg";
    $response['result'] = 'fail';
  }
  for ($i = 1; $i <= 4; $i++) {
    if ($_FILES['img_' . $i]['name'] != "") {
      ${'img_' . $i} = $_FILES['img_' . $i]['name'];
      ${'img_tmp_' . $i} = $_FILES['img_' . $i]['tmp_name'];
      if (file_exists('../' . PATH_PRODUCT_ADMIN . ${'img_' . $i})) {
        $response['imgsub'] = 'fail';
        ${'img_' . $i} = "";
      }
    } else {
      ${'img_' . $i} = "";
    }
  }

  $name = $_POST['name'];
  $price = $_POST['price'];
  $price_sale = $_POST['price_sale'];
  $sale = $_POST['sale'];
  $hot = $_POST['hot'];
  $status = $_POST['status'];
  $view = $_POST['view'];
  $des = $_POST['description'];
  $entry_date = $_POST['entry-date'];
  $quantity = $_POST['quantity'];

  if (!($response['imgmain'] == 'fail' || $response['imgsub'] == 'fail')) {
    if (product_insert($id_product, $img_main, $name, $price, $price_sale, $sale, $hot, $status, $view, $category, $brand, $des, $entry_date, $quantity)) {
      $response['result'] = 'fail';
    } else {
      move_uploaded_file($img_tmp_main, '../' . PATH_PRODUCT_ADMIN . $img_main);
      for ($i = 1; $i <= 4; $i++) {
        move_uploaded_file(${'img_tmp_' . $i}, '../' . PATH_PRODUCT_ADMIN . ${'img_' . $i});
      }
      $response['result'] = 'success';
      if (product_detail_insert($img_1, $img_2, $img_3, $img_4, $id_product)) {
        $response['result'] = 'fail';
      } else {
        $response['result'] = 'success';
      }
    }
  }

  $sql = "SELECT product.*, category.name AS category_name, brand.name AS brand_name
  FROM product
  JOIN category ON product.id_category = category.id
  JOIN brand ON product.id_brand = brand.id
  ORDER BY product.id DESC
  LIMIT 6 OFFSET 0;
  ";

  $products = pdo_query($sql);
  $response['html'] = show_table_product($products);
  echo json_encode($response);
}

if ($_GET['func'] == 'delProd') {
  $id_product = $_GET['id'];
  $product_detail = product_detail($id_product);
  $response = array();
  if (!product_detail_delete($id_product)) {
    if (product_delete($id_product)) {
      $response['result'] = 'fail';
    } else {
      $response['result'] = 'success';
      if (file_exists('../' . PATH_PRODUCT_ADMIN . $product_detail['img']) && $product_detail['img'] != 'no-image.jpeg') {
        unlink('../' . PATH_PRODUCT_ADMIN . $product_detail['img']);
      }
      for ($i = 1; $i <= 4; $i++) {
        if (file_exists('../' . PATH_PRODUCT_ADMIN . $product_detail['img_' . $i]) && $product_detail['img_' . $i] != 'no-image.jpeg') {
          unlink('../' . PATH_PRODUCT_ADMIN . $product_detail['img_' . $i]);
        }
      }
    }
    $sql = "SELECT product.*, category.name AS category_name, brand.name AS brand_name
    FROM product
    JOIN category ON product.id_category = category.id
    JOIN brand ON product.id_brand = brand.id
    ORDER BY product.id DESC
    LIMIT 6 OFFSET 0;
    ";

    $products = pdo_query($sql);
    $response['html'] = show_table_product($products);

    $pages = product_count_all();
    $pages = (int)$pages;
    $page = ceil($pages / 6);
    $showPageIndex = '';
    for ($i = 1; $i <= $page; $i++) {
      $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadProductInPage(this)" href="#"><span>' . $i . '</span></a>';
    }
    $response['page'] = $showPageIndex;
  }
  echo json_encode($response);
}
