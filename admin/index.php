<?php
include_once('../model/pdo.php');
include_once('../model/category.php');
include_once('../model/brand.php');
include_once('../model/product.php');
include_once('../model/comment.php');
session_start();
ob_start();

//login
if (!isset($_SESSION['admin'])) {
  header("location: public/login.php");
} else {
  $admin = $_SESSION['admin'];
}

// page
include_once('./public/header.php');
if (!isset($_GET['page'])) {

  include_once('./public/home.php');
} else {
  $page = $_GET['page'];
  switch ($page) {
    case 'category':
      include_once('./public/category.php');
      break;
    case 'brand':
      include_once('./public/brand.php');
      break;
    case 'product':
      $category = category_select_all();
      $brand = brand_select_all();
      include_once('./public/product.php');
      break;
    case 'user':
      include_once('./public/account.php');
      break;
    case 'order':
      include_once('./public/order.php');
      break;
    case 'comment':
      include_once('./public/comment.php');
      break;
    case 'comment_detail':
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = product_select_by_id($id);
        $comments = comments_in_product($id);
      }
      include_once('./public/comment_detail.php');
      break;
    case 'news':
      include_once('./public/news.php');
      break;
    case 'voucher':
      include_once('./public/voucher.php');
      break;
    case 'logout':
      if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        header("location: public/login.php");
      }
      break;

    default:
      include_once('./public/home.php');
      break;
  }
}
include_once('./public/footer.php');
