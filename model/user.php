<?php
require_once 'pdo.php';
//userloginlogout
function checkuser($username, $password)
{
    $sql = "SELECT * FROM user WHERE username=? and password=?";
    return pdo_query_one($sql, $username, $password);
    // if (is_array($kq) && (count($kq))) {
    //     return $kq["id_user"];
    // } else {
    //     return 0;
    // }
}
function  acount_update($fullname,$phone,$address,$password,$role,$id){
    $sql = "UPDATE user SET full_name=?, phone=?, address=?, password=?, role=? WHERE id=?";
    pdo_execute($sql, $fullname,$phone,$address,$password,$role,$id);

}

function pdo_re_pass($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
    } catch (PDOException $e) {
        echo "PDOException: " . $e->getMessage(); // In thông điệp lỗi
        throw $e;
    } finally {
        unset($conn);
    }
}

function reset_pass($reset_token, $reset_token_ex, $email){
    $sql = "UPDATE user SET reset_token=?, reset_token_ex=? WHERE email=?";
    $stmt = pdo_get_connection()->prepare($sql);
    $result = $stmt->execute([$reset_token, $reset_token_ex, $email]);
    
    if ($result) {
        return $stmt->rowCount(); // Số dòng đã cập nhật
    } else {
        return false;
    }
}
function process_reset_password($reset_token, $reset_token_ex, $password,$id){
    $sql = "UPDATE user SET reset_token = NULL, reset_token_ex = NULL, password = ? WHERE id = ?";
    $stmt = pdo_get_connection()->prepare($sql);
    $result = $stmt->execute([$password, $id]);
    
    if ($result) {
        return $stmt->rowCount(); // Số dòng đã cập nhật
    } else {
        return false;
    }
}
function get_reset_token($reset_token) {
    $sql = "SELECT * FROM user WHERE reset_token = ?";
    $stmt = pdo_get_connection()->prepare($sql);
    $stmt->execute([$reset_token]);

    // Sử dụng fetch để lấy dữ liệu từ kết quả truy vấn
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result; // Trả về dữ liệu từ CSDL
    } else {
        return false;
    }
}

function get_user($id){
    $sql = "SELECT * FROM user WHERE id=?";
    return pdo_query_one($sql,$id);
}
function user_insert($username, $email, $password)
{
    $sql = "INSERT INTO user(username,email,password) VALUES (?, ?, ?)";
    pdo_execute($sql, $username, $email, $password);
}

function user_update($img, $fullname, $password, $email, $phone, $address, $status, $role, $id)
{
    $sql = "UPDATE user SET user_img=?, full_name=?, password=?, email=?, phone=?, address=?, status=?, role=? WHERE id=?";
    pdo_execute($sql, $img, $fullname, $password, $email, $phone, $address, $status, $role, $id);
}
// checkmail 
function user_email_exists($email)
{
    $sql = "SELECT count(*) FROM user WHERE email=?";
    return pdo_query_value($sql, $email) > 0;
}
function user_delete($id)
{
    $sql = "DELETE FROM user  WHERE id=?";
    if (is_array($id)) {
        foreach ($id as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id);
    }
}

function user_select_all()
{
    $sql = "SELECT * FROM user";
    return pdo_query($sql);
}

function user_select_by_username($username)
{
    $sql = "SELECT * FROM user WHERE username=?";
    return pdo_query_one($sql, $username);
}

function user_exist($ma_kh)
{
    $sql = "SELECT count(*) FROM user WHERE $ma_kh=?";
    return pdo_query_value($sql, $ma_kh) > 0;
}

function user_select_by_role($vai_tro)
{
    $sql = "SELECT * FROM user WHERE vai_tro=?";
    return pdo_query($sql, $vai_tro);
}

function user_change_password($ma_kh, $mat_khau_moi)
{
    $sql = "UPDATE user SET mat_khau=? WHERE ma_kh=?";
    pdo_execute($sql, $mat_khau_moi, $ma_kh);
}

function user_count_all()
{
    $sql = "SELECT count(*) FROM user";
    return pdo_query_value($sql);
}
function user_select_by_id($id)
{
    $sql = "SELECT * FROM user WHERE id=?";
    return pdo_query_one($sql, $id);
}

