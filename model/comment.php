<?php
require_once 'pdo.php';

function binh_luan_insert($productId, $userId, $commentContent){
    $sql = "INSERT INTO comment (id_product, id_user, content, date) VALUES ('$productId', '$userId', '$commentContent', NOW())";
    pdo_execute($sql);
}

function binh_luan_update($ma_bl, $ma_kh, $ma_hh, $noi_dung, $ngay_bl){
    $sql = "UPDATE binh_luan SET ma_kh=?,ma_hh=?,noi_dung=?,ngay_bl=? WHERE ma_bl=?";
    pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl, $ma_bl);
}

function binh_luan_delete($ma_bl){
    $sql = "DELETE FROM binh_luan WHERE ma_bl=?";
    if(is_array($ma_bl)){
        foreach ($ma_bl as $ma) {
            pdo_execute($sql, $ma);
        }
    }
    else{
        pdo_execute($sql, $ma_bl);
    }
}

function binh_luan_select_all(){
    $sql = "SELECT * FROM comment ORDER BY date DESC";
    return pdo_query($sql);
}

function binh_luan_select_by_id($idPro){
    $sql = "SELECT comment.*, user.username AS user_name
            FROM comment
            JOIN user ON comment.id_user = user.id
            WHERE id_product=?
            ORDER BY comment.date DESC";
    return pdo_query($sql, $idPro);
}
function binh_luan_exist($ma_bl){
    $sql = "SELECT count(*) FROM binh_luan WHERE ma_bl=?";
    return pdo_query_value($sql, $ma_bl) > 0;
}
//-------------------------------//
function binh_luan_select_by_hang_hoa($ma_hh){
    $sql = "SELECT b.*, h.ten_hh FROM binh_luan b JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_bl DESC";
    return pdo_query($sql, $ma_hh);
}