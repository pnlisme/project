<?php
include_once('../../model/pdo.php');
include_once('../../model/global.php');
include_once('../../model/news.php');
include_once('../../model/user.php');
function show_news($news)
{
  $show = '';
  foreach ($news as $new) {
    extract($new);
    $user = user_select_by_id($id_user);
    if (is_file('../' . PATH_NEWS_ADMIN . $img)) {
      $img = PATH_NEWS_ADMIN . $img;
    } else {
      $img = PATH_NEWS_ADMIN . "no-image.jpeg";
    }
    $show .= '<tr>
                <td>
                  <div class="news-image"> <img src="' . $img . '" alt="news"></div>
                </td>
                <td>
                  <div class="news-name">
                    <p>' . $title . '</p>
                  </div>
                </td>
                <td>
                  <div class="news-entry-date">
                    <p>' . $date . '</p>
                  </div>
                  </td>
                  <td>
                  <div class="news-quantity">
                    <p>' . $user['full_name'] . '</p>
                  </div>
                </td>
                <td>
                  <div class="news-action"> <a class="news-update" value="' . $id . '" onclick="openFormUp(this)" href="#">
                      <ion-icon name="create-outline"></ion-icon></a><span>|</span><a value="' . $id . '" onclick="deleteNews(this)" href="#">
                      <ion-icon name="trash-outline"></ion-icon></a></div>
                </td>
              </tr>
    ';
  }
  return $show;
}

if ($_GET['func'] == 'show') {
  $response = array();
  if (isset($_POST['page'])) {
    $page = ($_POST['page'] - 1) * 6;
  } else {
    $page = 0;
  }
  if (isset($_POST['search']) && $_POST['search'] != "") {
    $search = $_POST['search'];
  } else {
    $search = "";
  }

  $sql = "SELECT * FROM news 
          WHERE title LIKE '%$search%' 
          ORDER BY id DESC LIMIT $page,6";

  $news = pdo_query($sql);
  $response['html'] = show_news($news);
  echo json_encode($response);
}

if ($_GET['func'] == 'page') {
  $pages = news_count_all();
  $pages = (int)$pages;
  $page = ceil($pages / 6);
  // print_r($page);
  $showPageIndex = '';
  for ($i = 1; $i <= $page; $i++) {
    $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadNewsInPage(this)" href="#"><span>' . $i . '</span></a>';
  }
  print_r($showPageIndex);
}

if ($_GET['func'] == "addNews") {
  $response = array();
  if ($_FILES['img']['name'] != "") {
    $img = $_FILES['img']['name'];
    $img_tmp_main = $_FILES['img']['tmp_name'];
  } else {
    $img = "";
    $response['result'] = 'fail';
  }

  $title = $_POST['title'];
  $content = $_POST['content'];
  $hot = $_POST['hot'];
  $date = $_POST['date'];
  $short = $_POST['short'];
  $id_user = $_POST['id_user'];

  if (news_insert($title, $img, $short, $content, $date, $hot, $id_user)) {
    $response['result'] = 'fail';
  } else {
    move_uploaded_file($img_tmp_main, '../' . PATH_NEWS_ADMIN . $img);
    $response['result'] = 'success';
  }

  $sql = "SELECT * FROM news 
          ORDER BY id DESC LIMIT 0,6";

  $news = pdo_query($sql);
  $response['html'] = show_news($news);
  echo json_encode($response);
}

if ($_GET['func'] == 'up') {
  if (isset($_POST['id'])) {
    $news_detail = news_select_by_id($_POST['id']);
    if ($news_detail['hot'] == 1) {
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
    if ($news_detail['img'] == "") {
      $img = PATH_NEWS_ADMIN . "no-image.jpeg";
    } else {
      if (is_file('../' . PATH_NEWS_ADMIN . $news_detail['img'])) {
        $img = PATH_NEWS_ADMIN . $news_detail['img'];
      } else {
        $img = PATH_NEWS_ADMIN . "no-image.jpeg";
      }
    }

    $showNewsDetail = '<h2 class="sub-title news-form-title">Chỉnh sửa tin tức</h2><a class="news-form-close" href="#">
                            <ion-icon name="close-circle-outline"></ion-icon></a>
                          <div class="news-form-content">
                            <label>Hình ảnh tin tức:</label>
                            <input type="file" name="img" id="" onchange="loadImgInput(this)">
                            <div class="show-image-up">
                              <img src="' . $img . '" alt="news image">
                              <div class="remove-img" onclick="removeImgInput(this)"><ion-icon name="trash-outline"></ion-icon></div>
                            </div>
                            <label>Tiêu đề tin tức:</label>
                            <input class="news-form-input" name="title" type="text" placeholder="Nhập tiêu đề tin tức" value="' . $news_detail['title'] . '">
                            <label>Nổi bật:</label>
                            <div class="news-form-radio-container">
                            ' . $hot . '
                            </div>
                            <label for="entry-date">Ngày nhập hàng:</label>
                            <input type="text" name="date" placeholder="Ngày nhập" value="' . $news_detail['date'] . '">
                            <label>Mô tả:</label>
                            <input class="news-form-input" type="text" name="short" placeholder="Mô tả tin tức" value="' . $news_detail['short'] . '">
                            <label>Mô tả tin tức:</label><textarea id="editor-up" name="content">' . $news_detail['content'] . '</textarea>
                            <input type="hidden" name="id_user" value="' . $news_detail['id_user'] . '">
                            <button class="news-form-button button" type="submit" id="' . $news_detail['id'] . '" onclick="updateNews(this)">Chỉnh sửa tin tức</button>
                          </div>';
  }
  echo $showNewsDetail;
}

if ($_GET['func'] == 'upNews') {
  $response = array();
  $id_product = $_GET['id'];
  $news = news_select_by_id($id_product);

  if ($_FILES['img']['name'] != "") {
    $img = $_FILES['img']['name'];
    $img_tmp_main = $_FILES['img']['tmp_name'];
  } else {
    $img = $news['img'];
    $response['result'] = 'fail';
  }

  $title = $_POST['title'];
  $content = $_POST['content'];
  $hot = $_POST['hot'];
  $date = $_POST['date'];
  $short = $_POST['short'];
  $id_user = $_POST['id_user'];

  if (news_update($id_product, $title, $img, $short, $content, $date, $hot, $id_user)) {
    $response['result'] = 'fail';
  } else {
    if ($_FILES['img']['name'] != "") {
      if (file_exists('../' . PATH_NEWS_ADMIN . $news['img']) && $_FILES['img']['name'] != 'no-image.jpeg') {
        unlink('../' . PATH_NEWS_ADMIN . $news['img']);
      }
      move_uploaded_file($img_tmp_main, '../' . PATH_NEWS_ADMIN . $img);
    }
    $response['result'] = 'success';
  }


  $sql = "SELECT * FROM news 
          ORDER BY id DESC LIMIT 0,6";

  $news = pdo_query($sql);
  $response['html'] = show_news($news);
  echo json_encode($response);
}

if ($_GET['func'] == 'delNews') {
  $id_news = $_GET['id'];
  $news_detail = news_select_by_id($id_news);
  $response = array();
  if (news_delete($news_detail)) {
    $response['result'] = 'fail';
  } else {
    $response['result'] = 'success';
    if (file_exists('../' . PATH_NEWS_ADMIN . $news_detail['img']) && $news_detail['img'] != 'no-image.jpeg') {
      unlink('../' . PATH_NEWS_ADMIN . $news_detail['img']);
    }
  }

  $sql = "SELECT * FROM news 
          ORDER BY id DESC LIMIT 0,6";

  $news = pdo_query($sql);
  $response['html'] = show_news($news);

  $pages = news_count_all();
  $pages = (int)$pages;
  $page = ceil($pages / 6);
  $showPageIndex = '';
  for ($i = 1; $i <= $page; $i++) {
    $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadNewsInPage(this)" href="#"><span>' . $i . '</span></a>';
  }
  $response['page'] = $showPageIndex;

  echo json_encode($response);
}
