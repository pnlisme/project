<?php
include_once('../../model/pdo.php');
include_once('../../model/category.php');

if ($_GET['func'] == "show") {
  $categories = category_select_all();
  echo json_encode($categories);
}
if ($_GET['func'] == "add") {
  $category_name = $_POST['category_name'];
  $category = category_exist($category_name);
  if ($category != 1) {
    if (strlen($category_name) < 4) {
      echo json_encode(['result' => "null"]);
    } else {
      category_insert($category_name);
      echo json_encode(['result' => "success"]);
    }
  } else {
    echo json_encode(['result' => "error"]);
  }
}
if ($_GET['func'] == "up") {
  if (isset($_GET['id']) && isset($_POST['category_name'])) {
    // print_r($_POST);
    // print_r($_GET);
    $category_id = $_GET['id'];
    $category_name = $_POST['category_name'];
    $category = category_exist($category_name);
    if ($category != 1) {
      category_update($category_id, $category_name);
      echo json_encode(['result' => "success"]);
    } else {
      echo json_encode(['result' => "error"]);
    }
  } else {
    echo json_encode(['result' => "error"]);
  }
}
if ($_GET['func'] == "upStatus") {
  if (isset($_GET['id']) && isset($_POST['hidden'])) {
    $category_id = $_GET['id'];
    if ($_POST['hidden'] == "true") {
      $category_hidden = 1;
    } else {
      $category_hidden = 0;
    }
    category_update_hide($category_id, $category_hidden);
    echo json_encode(['result' => "success"]);
  } else {
    echo json_encode(['result' => "error"]);
  }
}
if ($_GET['func'] == "del") {
  // print_r($_POST);
  $category_id = $_GET['id'];
  category_delete($category_id);
  echo json_encode(['result' => "success"]);
}
