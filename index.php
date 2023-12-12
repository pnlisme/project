<?php
    session_start();
    ob_start();
    // session_unset();


include "View/global.php";
include "model/pdo.php";
include "model/product.php";
include "model/news.php";
include "model/user.php";
include "model/comment.php";

$product_hot = get_product_hot(4);
$product_new = get_product_new(4);
$product_view = get_product_view(4);
$product_search_hot = get_product_hot(6);


$hideHeader = true; 
$hideFooter = true; 


if(!isset($_SESSION['s_user'])) {
    $_SESSION['s_user'] = [];
}

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if(!isset($_SESSION['voucherSalePercent'])) {
    $_SESSION['voucherSalePercent'] = [
        'sale' => 0,
    ];
}

if(!isset($_SESSION['promodeCode'])) {
   $_SESSION['promodeCode'] = NULL;
}


$product_sale = get_product_sale(4);
include "View/header.php";
if (!isset($_GET['pg'])) {
    include "View/home.php";                                                
}
else {
    switch ($_GET['pg']) {
        case 'product':
            //search
                $kyw="";
                $titlepage="";
            if (isset($_POST["timkiem"])) {
                $kyw=$_POST["kyw"];
                $titlepage="Kết quả tìm kiếm với từ khóa: ".$kyw;
            }
            $dssp = get_product_all($kyw,12);
            $dsdm = get_category_name();
            $dsbrand =  get_brand_name();
            include "View/shop.php";
            break;

        case 'blog':
            $ds_news_hot = get_news_highligh(2);
            $ds_news_lasest = get_news_all(3);
            include "View/blog.php";
            break;
        case 'contact':
          
            include "View/contact.php";
            break;
        case 'newsdetail':
            if (isset($_GET['idnews'])) {
                $id = $_GET['idnews'];
                $blog_detail =get_news_by_id($id);
                include "View/blog_detail.php";
            } else {
                include "View/home.php";
            }
            break;
        case 'detail':
            $dsdm = get_category_name();
            if (isset($_GET['idpro'])) {
                $id = $_GET['idpro'];
                $product_detail = get_product_by_id($id);
                $iddm = $product_detail['id_category'];
                $product_relate =get_product_relate($iddm,$id,4);
                include "View/detail.php";
            } else {
                include "View/detail.php";
            }
            break;
            case 'comment':
                
                if (isset($_POST['comment'])) {
                    $idpro = $_POST['idpro'];
                    $commentContent = $_POST['contentComment'];
                    binh_luan_insert($idpro,$_SESSION['s_user']['id'],$commentContent);
                    header('Location: index.php?pg=detail&idpro=' . $idpro);
                    exit();
                }
                break;
        case 'about':
          
            include "View/about.php";
            break;

        

        case 'cart':
            include "View/cart.php";
            break;

        case 'checkout' :
            include "View/checkout.php";
            break;
        
        case 'dangnhap':
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Kiểm tra tài khoản
            $checkuser = checkuser($username, $password);

            if (is_array($checkuser) && count($checkuser) > 0) {
                // Đăng nhập thành công, thiết lập session và chuyển hướng
                $_SESSION['s_user'] = $checkuser;
                header('location:index.php?pg');
            } else {
                // Tài khoản không tồn tại, thiết lập thông báo lỗi và chuyển hướng
                $tb = "Tài khoản không tồn tại";
                $_SESSION['tb_dangnhap'] = $tb;
                header('location: index.php?pg=signin');
            }


        break;
        case 'signin':

            // output
            include "View/Asignin.php";
        break;
        case 'forgotpass':
            include "View/forgot-password.php";
        break;
        case 'process-reset-password':
            $token = $_POST['token'];
            $reset_token = hash("sha256", $token);

            $user_token = get_reset_token($reset_token);

            if (!is_array($user_token) || empty($user_token)) {
                die("Token not found");
            }
            
            if (strtotime($user_token["reset_token_ex"]) <= time()) {
                die("Token has expired");
            }
            $password = $_POST['password-confirm'];
            process_reset_password($reset_token, $user_token["reset_token_ex"], $password, $user_token["id"]);
            $_SESSION['reset_password_success'] = "Mật khẩu đã được cập nhật.";
            include 'View/Asignin.php';
        break;
        case 'reset-password':
            include "View/reset-password.php";
            break;
        case 'send-password-reset':
            if (isset($_POST['resetpass']) && ($_POST['resetpass'])) {
                $email = $_POST['email'];
                $token = bin2hex(random_bytes(16));
                $reset_token = hash("sha256", $token);
                $reset_token_ex = date("Y-m-d H:i:s", time() + 60 * 30);
                // Perform the database update
                $updateResult = reset_pass($reset_token, $reset_token_ex, $email);
                if ($updateResult) {
                    $mail = require __DIR__ . "/model/mailer.php";
        
                    $mail->setFrom("ht01252004@gmail.com","mailer");
                    $mail->addAddress($email);
                    $mail->Subject = "Password Reset";
                    $mail->Body = <<<END
                        Click <a href="http://localhost/project/index.php?pg=reset-password&token=$token">here</a> 
                        to reset your password.
                    END;
        
                    try {
                        $mail->send();
                        echo '<h3 class="container">Thư đã được gửi, vui lòng kiểm tra hộp thư đến của bạn.</h3>';
                    } catch (Exception $e) {
                        echo "Không thể gửi thư. Lỗi Mailer: {$mail->ErrorInfo}";
                    }
                }
                    else {
                    echo "Lỗi khi cập nhật cơ sở dữ liệu. Vui lòng thử lại.";
                }
            }
            break;
        case 'adduser':
            if (isset($_POST['dangky'])&&($_POST['dangky'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['ForgotPassword'];
                //xử lí
                user_insert($username, $password, $email);
                
            }
            
            include "View/Asignin.php";
            
            break;
        case 'signup':
            include_once "View/Asignup.php";
            break;
        case 'forgetPass':
            include_once "View/Aforgetpass.php";
            break;
        case 'logout':
            if (isset($_SESSION['s_user']) && count($_SESSION['s_user'])>0){
                $_SESSION['s_user'] = [];
            };
            header('location:index.php?pg');
            break;
        case 'account':
            if (isset($_SESSION['s_user']) && count($_SESSION['s_user'])>0){
                include "View/account.php";
            };
            break;
        case 'updateUser':
            if (isset($_POST['updateAccount'])&&($_POST['updateAccount'])){
            $fullname=$_POST["fullname"];
            $phone=$_POST["phone"];
            $address=$_POST["address"];
            $password=$_POST["updatepassword"];
            $id=$_POST["id"];
            $role=0;
            acount_update($fullname,$phone,$address,$password,$role,$id);
            include "View/account_confirm.php";
        }
        break;
            default:
        include "View/home.php";
            break;
    }
}

include "View/footer.php";

?>