<?php
require_once 'pdo.php';

/**
 * Thêm loại mới
 * @param String $brand_name là tên loại
 * @throws PDOException lỗi thêm mới
 */
function brand_insert($brand_name)
{
  $sql = "INSERT INTO brand(name) VALUES(?)";
  pdo_execute($sql, $brand_name);
}
/**
 * Cập nhật tên loại
 * @param int $brand_id là mã loại cần cập nhật
 * @param String $brand_name là tên loại mới
 * @throws PDOException lỗi cập nhật
 */
function brand_update($brand_id, $brand_name)
{
  $sql = "UPDATE brand SET name=? WHERE id=?";
  pdo_execute($sql, $brand_name, $brand_id);
}
function brand_update_hide($brand_id, $brand_hidden)
{
  $sql = "UPDATE `brand` SET `hidden` = ? WHERE `brand`.`id` = ?";
  pdo_execute($sql, $brand_hidden, $brand_id);
}
/**
 * Xóa một hoặc nhiều loại
 * @param mix $brand_id là mã loại hoặc mảng mã loại
 * @throws PDOException lỗi xóa
 */
function brand_delete($brand_id)
{
  $sql = "DELETE FROM brand WHERE id=?";
  if (is_array($brand_id)) {
    foreach ($brand_id as $id) {
      pdo_execute($sql, $id);
    }
  } else {
    pdo_execute($sql, $brand_id);
  }
}
/**
 * Truy vấn tất cả các loại
 * @return array mảng loại truy vấn được
 * @throws PDOException lỗi truy vấn
 */
function brand_select_all()
{
  $sql = "SELECT * FROM brand";
  return pdo_query($sql);
}
/**
 * Truy vấn một loại theo mã
 * @param int $brand_id là mã loại cần truy vấn
 * @return array mảng chứa thông tin của một loại
 * @throws PDOException lỗi truy vấn
 */
function brand_select_by_id($brand_id)
{
  $sql = "SELECT * FROM brand WHERE id=?";
  return pdo_query_one($sql, $brand_id);
}
/**
 * Kiểm tra sự tồn tại của một loại
 * @param int $brand_name là tên loại cần kiểm tra
 * @return boolean có tồn tại hay không
 * @throws PDOException lỗi truy vấn
 */
function brand_exist($brand_name)
{
  $sql = "SELECT count(*) FROM brand WHERE name=?";
  return pdo_query_value($sql, $brand_name) > 0;
}
