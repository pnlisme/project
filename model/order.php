<?php
function order_count_now()
{
  $sql = "SELECT count(*) FROM `order`
    WHERE MONTH(date) = MONTH(CURRENT_DATE())
        AND YEAR(date) = YEAR(CURRENT_DATE());
    ";
  return pdo_query_value($sql);
}

function order_count_all()
{
  $sql = "SELECT count(*) FROM `order`";
  return pdo_query_value($sql);
}

function total_now()
{
  $sql = "SELECT SUM(total) FROM `order`
    WHERE MONTH(date) = MONTH(CURRENT_DATE())
        AND YEAR(date) = YEAR(CURRENT_DATE());
    ";
  return pdo_query_value($sql);
}

function total_all()
{
  $sql = "SELECT SUM(total) FROM `order`";
  return pdo_query_value($sql);
}

function chart_total()
{
  $sql = "SELECT 
            MONTH(`date`) AS month,
            SUM(total) AS total
          FROM `order`
          WHERE YEAR(`date`) = YEAR(CURRENT_DATE())
          GROUP BY MONTH(`date`);
    ";
  return pdo_query($sql);
}
