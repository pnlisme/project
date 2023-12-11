<?php
include_once('../../model/pdo.php');
include_once('../../model/global.php');
include_once('../../model/comment.php');

function show_comment($comments)
{
  $show = '';
  foreach ($comments as $comment) {
    extract($comment);
    if (is_file('../' . PATH_PRODUCT_ADMIN . $img)) {
      $img = PATH_PRODUCT_ADMIN . $img;
    } else {
      $img = PATH_PRODUCT_ADMIN . 'no-image.png';
    }
    $show .= '
            <tr>
              <td>
                <div class="comment-image"> <img srcset="' . $img . ' 2x" alt="product"></div>
              </td>
              <td>
                <div class="comment-name">
                  <p>' . $name . '</p>
                </div>
              </td>
              <td><span class="comment-time">' . $date . '</span></td>
              <td>
                <div class="comment-count">
                  <p>' . $quantity . '</p>
                </div>
              </td>
              <td>
                <div class="comment-action"> <a href="index.php?page=comment_detail&id=' . $id_product . '">
                    <ion-icon name="ellipsis-horizontal-circle-outline"></ion-icon></a></div>
              </td>
            </tr>
    ';
  }
  return $show;
}

if ($_GET['func'] == 'show') {
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $page = ($page - 1) * 6;
  } else {
    $page = 0;
  }
  $sql = "SELECT p.img AS img, p.name AS name, c.id_product , MAX(c.date) as date, COUNT(*) AS quantity
            FROM comment c
            JOIN product p ON c.id_product = p.id
            GROUP BY c.id_product, p.img, p.name
            ORDER BY date DESC
            LIMIT $page, 6;
            ";
  $comments = pdo_query($sql);
  $response['html'] = show_comment($comments);
  echo json_encode($response);
}

if ($_GET['func'] == 'page') {
  $pages = comments_count();
  $pages = (int)$pages;
  $page = ceil($pages / 6);
  // print_r($page);
  $response = array();
  $showPageIndex = '';
  for ($i = 1; $i <= $page; $i++) {
    $showPageIndex .= '<a class="button table-page-button" value="' . $i . '" onclick="loadCommentsInPage(this)" href="#"><span>' . $i . '</span></a>';
  }
  $response['html'] = $showPageIndex;
  echo json_encode($response);
}

if ($_GET['func'] == 'del') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $response = array();
    if (comment_delete($id)) {
      $response['result'] = 'fail';
    } else {
      $response['result'] = 'success';
    }
    echo json_encode($response);
  }
}
