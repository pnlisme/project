<?php
function cart_select_by_id_order($id_order)
{
  $sql = "SELECT * FROM `cart` WHERE `id_order` = ?";
  return pdo_query($sql, $id_order);
}
