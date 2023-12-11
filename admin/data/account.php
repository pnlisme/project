<?php
include_once('../../model/pdo.php');
include_once('../../model/global.php');
include_once('../../model/user.php');

function show_account($accounts)
{
  $show = '';
  foreach ($accounts as $account) {
    extract($account);
    if (is_file('../' . PATH_ACCOUNT_ADMIN . $user_img)) {
      $user_img = PATH_ACCOUNT_ADMIN . $user_img;
    } else {
      $user_img = PATH_ACCOUNT_ADMIN . 'user.png';
    }
    if ($phone == '' || $phone == null) {
      $phone = 'Chưa cập nhật';
    }
    if ($address == '' || $address == null) {
      $address = 'Chưa cập nhật';
    }
    if ($role == 1) {
      $role = 'Quản trị viên';
    } else if ($role == 2) {
      $role = 'Nhân viên';
    } else {
      $role = 'Khách hàng';
    }
    if ($status == 1) {
      $status = '<p class="account-status-active">Hoạt động</p>';
    } else {
      $status = '<p class="account-status-ban" style="color: #ff497c;">Bị cấm</p>';
    }
    $show .= '<tr>
                <td>
                  <div class="account-image"> <img srcset="' . $user_img . ' 2x" alt="account"></div>
                </td>
                <td>
                  <div class="account-fullname">
                    <p>' . $full_name . '</p>
                  </div>
                </td>
                <td>
                  <div class="account-username">
                    <p>' . $username . '</p>
                  </div>
                </td>
                <td>
                  <div class="account-phone">
                    <p>' . $phone . '</p>
                  </div>
                </td>
                <td>
                  <div class="account-email">
                    <p>' . $email . '</p>
                  </div>
                </td>
                <td>
                  <div class="account-status">
                  ' . $status . '
                  </div>
                </td>
                <td>
                  <div class="account-role">
                    <p>' . $role . '</p>
                  </div>
                </td>
                <td>
                  <div class="account-action"> <a id="' . $id . '" class="account-edit" href="#" onclick="upAcc(this)">
                      <ion-icon name="create-outline"></ion-icon></a><span>|</span><a id="' . $id . '" href="#" onclick="delAcc(this)">
                      <ion-icon name="trash-outline"></ion-icon></a></div>
                </td>
              </tr>';
  }
  return $show;
}

if ($_GET['func'] == "show") {
  if (isset($_POST['page'])) {
    $page = ($_POST['page'] - 1) * 6;
  } else {
    $page = 0;
  }
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
  } else {
    $search = '';
  }
  if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    if ($filter == 0) {
      $filter = " AND role = 0";
    } else if ($filter == 1) {
      $filter = " AND role = 1";
    } else if ($filter == 2) {
      $filter = " AND role = 2";
    } else if ($filter == 3) {
      $filter = " AND status = 1";
    } else if ($filter == 4) {
      $filter = " AND status = 0";
    } else {
      $filter = "";
    }
  }

  $sql = "SELECT * FROM user
          WHERE (username LIKE '%$search%'
                OR full_name LIKE '%$search%'
                OR email LIKE '%$search%'
                OR phone LIKE '%$search%'
                OR address LIKE '%$search%'
                OR date LIKE '%$search%')
                " . $filter . "
          ORDER BY id DESC
          LIMIT " . $page . ", 6";
  $accounts = pdo_query($sql);
  $response = array();
  $response['html'] = show_account($accounts);
  $response['filter'] = $filter;
  $response['search'] = $search;
  echo json_encode($response);
}

if ($_GET['func'] == "page") {
  $pages = user_count_all();
  $pages = (int)$pages;
  $page = ceil($pages / 6);
  // print_r($page);
  $showPageIndex = '';
  for ($i = 1; $i <= $page; $i++) {
    $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadAccInPage(this)" href="#"><span>' . $i . '</span></a>';
  }
  $response = array();
  $response['html'] = $showPageIndex;
  echo json_encode($response);
}

if ($_GET['func'] == "open") {
  $id = $_POST['id'];
  $account = user_select_by_id($id);
  extract($account);
  if (is_file('../' . PATH_ACCOUNT_ADMIN . $user_img)) {
    $user_img = PATH_ACCOUNT_ADMIN . $user_img;
  } else {
    $user_img = PATH_ACCOUNT_ADMIN . 'user.png';
  }
  if ($phone == '' || $phone == null) {
    $phone = 'Chưa cập nhật';
  }
  if ($address == '' || $address == null) {
    $address = 'Chưa cập nhật';
  }
  if ($status == 1) {
    $status = '<select class="account-form-select" name="status">
                <option value="1" selected>Hoạt động</option>
                <option value="0">Bị cấm</option>
              </select>';
  } else {
    $status = '<select class="account-form-select" name="status">
                <option value="1">Hoạt động</option>
                <option value="0" selected>Bị cấm</option>
              </select>';
  }
  if ($role == 1) {
    $role = '<select class="account-form-select" name="role">
                <option value="1" selected>Quản trị viên</option>
                <option value="2">Nhân viên</option>
                <option value="0">Khách hàng</option>
              </select>';
  } else if ($role == 2) {
    $role = '<select class="account-form-select" name="role">
                <option value="1">Quản trị viên</option>
                <option value="2" selected>Nhân viên</option>
                <option value="0">Khách hàng</option>
              </select>';
  } else {
    $role = '<select class="account-form-select" name="role">
                <option value="1">Quản trị viên</option>
                <option value="2">Nhân viên</option>
                <option value="0" selected>Khách hàng</option>
              </select>';
  }
  $response = array();
  $response['acc'] = $user_img;
  $response['html'] = '<label>Ảnh đại diện: </label>
                      <input type="file" name="img_main" id="" onchange="loadImgInput(this)">
                      <div class="show-image-up">
                        <img srcset="' . $user_img . ' 2x" alt="product image">
                        <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline" role="img" class="md hydrated"></ion-icon></div>
                      </div>
                      <label>Tên người dùng: (Không thể thay đổi)<span></span></label>
                      <input class="account-form-input" type="text" placeholder="' . $username . '" disabled style="cursor: not-allowed;">
                      <label for="account-fullname">Tên đầy đủ:<span>*</span></label>
                      <input class="account-form-input" type="text" name="fullname" placeholder="Cập nhật tên đầy đủ" value="' . $full_name . '" id="account-fullname">
                      <label for="account-email">Email:<span>*</span></label>
                      <input class="account-form-input" type="email" placeholder="Cập nhật email" name="email" value="' . $email . '" id="account-email">
                      <label for="account-phone">Số điện thoại:<span>*</span></label>
                      <input class="account-form-input" type="text" placeholder="Cập nhật số điện thoại" name="phone" value="' . $phone . '" id="account-phone">
                      <label for="account-address">Địa chỉ (Cần có địa chỉ để mua hàng):<span>*</span></label>
                      <input class="account-form-input" type="text" placeholder="Cập nhật địa chỉ" name="address" value="' . $address . '" id="account-address">
                      <label>Trạng thái: <span>*</span></label>
                      ' . $status . '
                      <label>Quyền hạn:<span>*</span></label>
                      ' . $role . '
                      <div class="account-form-password">
                        <p>Đổi mật khẩu</p>
                        <hr>
                        <label for="account-password">Mật khẩu mới (Bỏ trống nếu không muốn thay đổi): <span>*</span></label>
                        <input class="account-form-input" name="password" type="password" placeholder="Password" id="account-password">
                        <label for="account-password-confirm">Xác nhận mật khẩu mới:<span>*</span></label>
                        <input class="account-form-input" name="password-confirm" type="password" placeholder="Password confirm" id="account-password-confirm">
                      </div>
                      <p style="text-align: center;">Mọi thông tin bỏ trống sẽ không được cập nhật!</p>
                      <button class="account-form-button button" onclick="btnUpAcc(this)" id="' . $id . '" type="submit">Lưu thay đổi</button>';
  echo json_encode($response);
}

if ($_GET['func'] == "update") {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $account = user_select_by_id($id);
    $response = array();

    if ($_FILES['img_main']['name'] != '') {
      $img = $_FILES['img_main']['name'];
      $img_tmp = $_FILES['img_main']['tmp_name'];
      if (file_exists('../' . PATH_ACCOUNT_ADMIN . $account['user_img'])) {
        $response['img'] = 'fail';
      } else {
        move_uploaded_file($img_tmp, '../' . PATH_ACCOUNT_ADMIN . $img);
        $response['img'] = 'success';
      }
    } else {
      $img = '';
    }

    if ($_POST['fullname'] != '') {
      $fullname = $_POST['fullname'];
    } else {
      $fullname = $account['full_name'];
    }

    if ($_POST['email'] != '') {
      $email = $_POST['email'];
    } else {
      $email = $account['email'];
    }

    if ($_POST['phone'] != '') {
      $phone = $_POST['phone'];
    } else {
      $phone = $account['phone'];
    }

    if ($_POST['address'] != '') {
      $address = $_POST['address'];
    } else {
      $address = $account['address'];
    }

    if ($_POST['status'] != '') {
      $status = $_POST['status'];
    } else {
      $status = $account['status'];
    }

    if ($_POST['role'] != '') {
      $role = $_POST['role'];
    } else {
      $role = $account['role'];
    }

    if ($_POST['password-confirm'] != '') {
      $password = $_POST['password-confirm'];
    } else {
      $password = $account['password'];
    }
  }

  if (user_update($img, $fullname, $password, $email, $phone, $address, $status, $role, $id)) {
    $response['result'] = 'error';
  } else {
    $response['result'] = 'success';
    $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 6";
    $accounts = pdo_query($sql);
    $response['html'] = show_account($accounts);
  }

  echo json_encode($response);
}

if ($_GET['func'] == "delete") {
  $id = $_GET['id'];
  $response = array();
  if (user_delete($id)) {
    $response['result'] = 'error';
  } else {
    $response['result'] = 'success';
    $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 6";
    $accounts = pdo_query($sql);
    $response['html'] = show_account($accounts);

    $pages = user_count_all();
    $pages = (int)$pages;
    $page = ceil($pages / 6);
    $showPageIndex = '';
    for ($i = 1; $i <= $page; $i++) {
      $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadAccInPage(this)" href="#"><span>' . $i . '</span></a>';
    }
    $response['page'] = $showPageIndex;
  }
  echo json_encode($response);
}
