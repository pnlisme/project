<?php
include_once('../model/global.php');
$show = '';
// print_r($comments);
foreach ($comments as $comment) {
  if (is_file(PATH_ACCOUNT_ADMIN . $comment['user_img'])) {
    $comment['user_img'] = PATH_ACCOUNT_ADMIN . $comment['user_img'];
  } else {
    $comment['user_img'] = PATH_ACCOUNT_ADMIN . 'user.png';
  }

  $show .= '
          <tr>
            <td>
              <div class="comment-image"> <img srcset="' . $comment['user_img'] . ' 2x" alt="product"></div>
            </td>
            <td>
              <div class="comment-name">
                <p>' . $comment['full_name'] . '</p>
              </div>
            </td>
            <td>
              <div class="comment-content">
                <p>' . $comment['content'] . '</p>
              </div>
            </td>
            <td><span class="comment-time">' . $comment['date'] . '</span></td>
            <td>
              <div class="comment-action"> <a href="#" id="' . $comment['id'] . '" onclick="delCmt(this)">
                  <ion-icon name="trash-outline"></ion-icon></a></div>
            </td>
          </tr>
          ';
}
?>

<head>
  <link rel="stylesheet" href="./layout/css/comment-dt.css" />
</head>
<main class="main">
  <div class="img-detail">
    <img src="<?= PATH_PRODUCT_ADMIN . $product['img'] ?>" alt="product">
  </div>
  <h1 class="title">Bình luận chi tiết</h1>
  <div class="table-container">
    <table class="comment table">
      <thead class="table-head">
        <tr>
          <th>
            <ion-icon name="image-outline"></ion-icon>
          </th>
          <th>Họ tên</th>
          <th>Nội dung</th>
          <th>Thời gian</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <?= $show ?>
      </tbody>
    </table>
  </div>
</main>
<script src="./layout/js/comment_dt.js"></script>