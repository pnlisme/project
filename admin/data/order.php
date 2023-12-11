<?php
include_once('../../model/pdo.php');
include_once('../../model/global.php');
include_once('../../model/user.php');
include_once('../../model/order.php');
include_once('../../model/cart.php');

function show_order($orders)
{
  $show = '';
  foreach ($orders as $order) {
    extract($order);
    if ($status == 0) {
      $status = '<span class="order-status-pending" style="color: #F7BF0F;">Chờ xác nhận</span>';
    } else if ($status == 1) {
      $status = '<span class="order-status-shipping" style="color: #3577f0;">Đang giao hàng</span>';
    } else if ($status == 2) {
      $status = '<span class="order-status-success">Đã giao hàng</span>';
    } else {
      $status = '<span class="order-status-cancel" style="color: #FF497C;">Đã hủy</span>';
    }
    $show .= '<tr>
                <td>
                  <div class="order-username">
                    <p>' . $username . '</p>
                  </div>
                </td>
                <td>
                  <div class="order-fullname">
                    <p>' . $full_name . '</p>
                  </div>
                </td>
                <td><span class="order-time">' . $date . '</span></td>
                <td>
                  <div class="order-Total">
                    <p>' . $total . ' VND</p>
                  </div>
                </td>
                <td>
                  <div class="order-status">
                    ' . $status . '
                  </div>
                </td>
                <td>
                  <div class="order-action"> <a class="order-detail" href="#" id="' . $id . '" onclick="showMore(this)">
                      <ion-icon name="ellipsis-horizontal-circle-outline" role="img" class="md hydrated"></ion-icon></a></div>  
                </td>
              </tr>';
  }
  return $show;
}

if ($_GET['func'] == "show") {
  $response = array();
  if (isset($_POST['page'])) {
    $page = ($_POST['page'] - 1) * 10;
  } else {
    $page = 0;
  }

  if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    if ($filter == 0) {
      $filter = " AND o.`status` = 0";
    } else if ($filter == 1) {
      $filter = " AND o.`status` = 1";
    } else if ($filter == 2) {
      $filter = " AND o.`status` = 2";
    } else if ($filter == 3) {
      $filter = " AND o.`status` = 3";
    } else {
      $filter = "";
    }
  }
  // $response['filter'] = $filter;

  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  } else {
    $search = '';
  }

  $sql = "SELECT o.*, u.username, u.full_name
          FROM `order` o
          INNER JOIN `user` u ON o.`id_user` = u.`id`
          WHERE (u.username LIKE '%$search%' 
          OR u.full_name LIKE '%$search%')
          " . $filter . "
          ORDER BY o.`id` DESC
          LIMIT $page, 10";

  $orders = pdo_query($sql);
  $response['html'] = show_order($orders);
  echo json_encode($response);
}

if ($_GET['func'] == "page") {
  $pages = order_count_all();
  $pages = (int)$pages;
  $page = ceil($pages / 10);
  // print_r($pages);
  $showPageIndex = '';
  for ($i = 1; $i <= $page; $i++) {
    $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadOrderInPage(this)" href="#"><span>' . $i . '</span></a>';
  }
  $response = array();
  $response['html'] = $showPageIndex;
  echo json_encode($response);
}

// show table cart
function show_table_cart($carts)
{
  $show = array();
  $show['html'] = '';
  $show['sum'] = 0;
  foreach ($carts as $cart) {
    extract($cart);
    $show['html'] .= '<tr>
                        <td>
                          <p class="order-detail-form-name">' . $name . '</p>
                        </td>
                        <td>
                          <p class="order-detail-form-price">' . $price . '</p>
                        </td>
                        <td>
                          <p class="order-detail-form-quantity">' . $quantity . '</p>
                        </td>
                        <td>
                          <p class="order-detail-form-subtotal">' . $total . '</p>
                        </td>
                      </tr>';
    $show['sum'] += $total;
  }
  return $show;
}

// show order detail
if ($_GET['func'] == "open") {
  $id = $_POST['id'];
  $carts = cart_select_by_id_order($id);
  $show_cart = show_table_cart($carts);
  $order = order_detail($id);
  $user = user_select_by_id($order['id_user']);
  $response = array();
  $response['user'] = $user;

  if (is_file('../' . PATH_ACCOUNT_ADMIN . $user['user_img'])) {
    $user['user_img'] = PATH_ACCOUNT_ADMIN . $user['user_img'];
  } else {
    $user['user_img'] = PATH_ACCOUNT_ADMIN . 'user.png';
  }
  if ($order['status'] == 0) {
    $order['status'] = '<select class="order-form-select" name="status">
                        <option value="0" selected>Đang chờ xử lý</option>
                        <option value="1">Đang giao hàng</option>
                        <option value="2">Đã giao hàng</option>
                        <option value="3">Đã hủy</option>
                      </select>';
  } else if ($order['status'] == 1) {
    $order['status'] = '<select class="order-form-select" name="status">
                        <option value="0">Đang chờ xử lý</option>
                        <option value="1" selected>Đang giao hàng</option>
                        <option value="2">Đã giao hàng</option>
                        <option value="3">Đã hủy</option>
                      </select>';
  } else if ($order['status'] == 2) {
    $order['status'] = '<select class="order-form-select" name="status">
                        <option value="0">Đang chờ xử lý</option>
                        <option value="1">Đang giao hàng</option>
                        <option value="2" selected>Đã giao hàng</option>
                        <option value="3">Đã hủy</option>
                      </select>';
  } else {
    $order['status'] = '<select class="order-form-select" name="status">
                        <option value="0">Đang chờ xử lý</option>
                        <option value="1">Đang giao hàng</option>
                        <option value="2">Đã giao hàng</option>
                        <option value="3" selected>Đã hủy</option>
                      </select>';
  }
  if ($order['note'] == '') {
    $order['note'] = 'Không có ghi chú';
  }

  $response['html'] = '<label>Người đặt hàng: </label>
                      <div class="order-form-image"> <img src="' . $user['user_img'] . '" alt="product image"></div>
                      <label>Tên người dùng: <span> *</span></label>
                      <input class="order-form-input" type="text" placeholder="' . $user['username'] . '" disabled style="cursor: not-allowed;">
                      <label>Trạng thái: <span> *</span></label>
                      ' . $order['status'] . '
                      <div class="order-form-input-container">
                        <div>
                          <label for="order-fullname">Họ và tên:<span>*</span></label>
                          <input class="order-form-input" type="text" value="' . $order['full_name'] . '" placeholder="Tên người đặt hàng" id="order-fullname" name="full_name">
                        </div>
                        <div>
                          <label for="receiver-fullname">Họ tên người nhận (nếu có):</label>
                          <input class="order-form-input" type="text" value="' . $order['fullname_receiver'] . '" placeholder="Tên người nhận hàng" id="receiver-fullname" name="fullname_receiver">
                        </div>
                      </div>
                      <div class="order-form-input-container">
                        <div>
                          <label for="order-email">Email:<span>*</span></label>
                          <input class="order-form-input" type="email" value="' . $order['email'] . '" placeholder="Email người đặt hàng" id="order-email" name="email">
                        </div>
                        <div>
                          <label for="receiver-email">Email người nhận (nếu có):</label>
                          <input class="order-form-input" type="email" value="' . $order['email_receiver'] . '" placeholder="Email người nhận hàng" id="receiver-email" name="email_receiver">
                        </div>
                      </div>
                      <div class="order-form-input-container">
                        <div>
                          <label for="order-phone">Số điện thoại:<span>*</span></label>
                          <input class="order-form-input" type="text" value="' . $order['phone'] . '" placeholder="Số điện thoại người đặt hàng" id="order-phone" name="phone">
                        </div>
                        <div>
                          <label for="receiver-phone">Số điện thoại người nhận (nếu có):</label>
                          <input class="order-form-input" type="text" value="' . $order['phone_receiver'] . '" placeholder="Số điện thoại người nhận" id="receiver-phone" name="phone_receiver">
                        </div>
                      </div>
                      <div class="order-form-input-container">
                        <div>
                          <label for="order-address">Địa chỉ:<span>*</span></label>
                          <input class="order-form-input" type="text" value="' . $order['address'] . '" placeholder="Địa chỉ người đặt hàng" id="order-address" name="address">
                        </div>
                        <div>
                          <label for="receiver-address">Địa chỉ người nhận (nếu có):</label>
                          <input class="order-form-input" type="text" value="' . $order['address_receiver'] . '" placeholder="Địa chỉ người nhận hàng" id="receiver-address" name="address_receiver">
                        </div>
                      </div>
                      <label>Ghi chú: </label>
                      <textarea class="order-form-textarea" name="note">' . $order['note'] . '</textarea>
                      <p style="text-align: center; margin-bottom: 24px;">Những thông tin có dấu <span>*</span> sẽ không thay đổi khi bỏ trống</p>
                      <div class="order-detail-form">
                        <table class="table">
                          <thead class="table-head">
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                          </thead>
                          <tbody class="table-body-container">
                            ' . $show_cart['html'] . '
                          </tbody>
                        </table>
                        <div class="order-detail-form-total">
                          <p class="order-detail-form-total-title">Tổng cộng:</p>
                          <p class="order-detail-form-total-price">' . $show_cart['sum'] . ' VND</p>
                        </div>
                      </div>
                      <button class="order-form-button button" type="button" id="' . $order['id'] . '" onclick="updateOrder(this)">Cập nhật thay đổi</button>';
  echo json_encode($response);
}

if ($_GET['func'] == 'update') {
  $response = array();
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $order = order_detail($id);
    $keys = array('status', 'full_name', 'email', 'phone', 'address', 'note');
    $keycannulls = array('fullname_receiver', 'email_receiver', 'phone_receiver', 'address_receiver');
    foreach ($keys as $key) {
      if (isset($_POST[$key]) && $_POST[$key] != '') {
        $$key = $_POST[$key];
      } else {
        $$key = $order[$key];
      }
    }
    foreach ($keycannulls as $key) {
      if (isset($_POST[$key]) && $_POST[$key] != '') {
        $$key = $_POST[$key];
      } else {
        $$key = '';
      }
    }
  }

  if (order_update($id, $status, $full_name, $fullname_receiver, $email, $email_receiver, $phone, $phone_receiver, $address, $address_receiver, $note)) {
    $response['result'] = 'fail';
  } else {
    $response['result'] = 'success';
  }

  $sql = "SELECT o.*, u.username, u.full_name
          FROM `order` o
          INNER JOIN `user` u ON o.`id_user` = u.`id`
          ORDER BY o.`id` DESC
          LIMIT 0, 10";
  $orders = pdo_query($sql);
  $response['html'] = show_order($orders);

  echo json_encode($response);
}
