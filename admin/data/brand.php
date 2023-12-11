<?php
include_once('../../model/pdo.php');
include_once('../../model/brand.php');

if ($_GET['func'] == "show") {
  $categories = brand_select_all();
  echo json_encode($categories);
}
if ($_GET['func'] == "add") {
  $brand_name = $_POST['brand_name'];
  $brand = brand_exist($brand_name);
  if ($brand != 1) {
    brand_insert($brand_name);
    echo json_encode(['result' => "success"]);
  } else {
    echo json_encode(['result' => "error"]);
  }
}
if ($_GET['func'] == "up") {
  if (isset($_GET['id']) && isset($_POST['brand_name'])) {
    $brand_id = $_GET['id'];
    $brand_name = $_POST['brand_name'];
    $brand = brand_exist($brand_name);
    if ($brand != 1) {
      if (strlen($brand_name) < 4) {
        echo json_encode(['result' => "null"]);
      } else {
        brand_update($brand_id, $brand_name);
        echo json_encode(['result' => "success"]);
      }
    } else {
      echo json_encode(['result' => "error"]);
    }
  } else {
    echo json_encode(['result' => "error"]);
  }
}
if ($_GET['func'] == "upStatus") {
  if (isset($_GET['id']) && isset($_POST['hidden'])) {
    $brand_id = $_GET['id'];
    if ($_POST['hidden'] == "true") {
      $brand_hidden = 1;
    } else {
      $brand_hidden = 0;
    }
    brand_update_hide($brand_id, $brand_hidden);
    echo json_encode(['result' => "success"]);
  } else {
    echo json_encode(['result' => "error"]);
  }
}
if ($_GET['func'] == "del") {
  // print_r($_GET);
  $brand_id = $_GET['id'];
  brand_delete($brand_id);
  echo json_encode(['result' => "success"]);
}
