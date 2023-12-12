<?php
session_start();
ob_start();

include_once './pdo.php';
include_once './product.php';
include_once './global.php';

// DELETE ONE
if (isset($_POST['action'])) {
    $productName = $_POST['productName'];

    // Find the index of the item in the cart
    $index = array_search($productName, array_column($_SESSION['cart'], 'name'));


    // Check if the index is valid before attempting to unset
    if ($index !== false) {
        unset($_SESSION['cart'][$index]);
        // Reset the array keys to ensure they are in sequential order
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    header('Content-Type: application/json');
    echo json_encode($_SESSION['cart']);
}

// DELETE ALL
if (isset($_POST['clear'])) {
    $_SESSION['cart'] = [];

    header('Content-Type: application/json');
    echo json_encode($_SESSION['cart']);
}

// MINUS QUANTITY
if (isset($_POST['minus'])) {
    $productName = $_POST['productName'];

    // Find the index of the item in the cart
    $index = array_search($productName, array_column($_SESSION['cart'], 'name'));

    if ($_SESSION['cart'][$index]['quantity'] > 0) {
        $_SESSION['cart'][$index]['quantity'] -= 1;
    } else {
        unset($_SESSION['cart'][$index]);

        // Reset the array keys to ensure they are in sequential order
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    header('Content-Type: application/json');
    echo json_encode($_SESSION['cart']);
}

// PLUS QUANTITY

if (isset($_POST['plus'])) {
    $productName = $_POST['productName'];

    // Find the index of the item in the cart
    $index = array_search($productName, array_column($_SESSION['cart'], 'name'));

    if ($_SESSION['cart'][$index]['quantity'] < 10) {
        $_SESSION['cart'][$index]['quantity'] += 1;
    }


    header('Content-Type: application/json');
    echo json_encode($_SESSION['cart']);
}


// DISCOUNT
$conn = pdo_get_connection();

if (isset($_POST['discard'])) {
    $promoCode = $_POST['promoCode'];
    $totalCart = $_POST['totalCart'];
    $currentDate = date("Y-m-d");
    $totalCartAfterDiscount = 0;
    $discountPrice = 0;
    $voucherStatus = 1;
    // 1 là chưa sử dụng
    // 2 là sử dụng r
    // 3 là quá hạn hoặc k tồn tại


    // SQL to retrieve voucher information
    $sql = "SELECT * FROM `voucher` WHERE `promo_code` = '$promoCode' AND `date` >= '$currentDate'";

    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $voucherId = $row['id'];

        // Check if both the voucher ID and user ID exist in voucher_used
        $userId = $_SESSION['s_user']['id'];
        $checkUsedSql = "SELECT * FROM `voucher_used` WHERE `id_user` = $userId AND `id_voucher` = $voucherId";
        $checkUsedResult = $conn->query($checkUsedSql);

        if ($checkUsedResult->rowCount() == 0) {
            // Voucher is valid and has not been used by this user
            $discountPercentage = $row['discount'];
            $_SESSION['voucherSalePercent']['sale'] = $discountPercentage;
            $discountedAmount = $totalCart * ($discountPercentage / 100);
            $totalCartAfterDiscount = $totalCart - $discountedAmount;
            $_SESSION['promodeCode'] = $voucherId;
        } else {
            // Voucher has already been used by this user
            $_SESSION['promodeCode'] = NULL;
            $_SESSION['voucherSalePercent']['sale'] = 0;
            $voucherStatus = 2;

        }
    } else {
        $voucherStatus = 3;
        $_SESSION['voucherSalePercent']['sale'] = 0;
        $_SESSION['promodeCode'] = NULL;

    }
    header('Content-Type: application/json');
    echo json_encode(array($voucherStatus,$totalCartAfterDiscount , $totalCart));
}

// ORDER



if (isset($_POST['order'])) {
    // Assuming you have sanitized user inputs to prevent SQL injection
    $idUser = count($_SESSION['s_user']) > 0 ? $_SESSION['s_user']['id'] : NULL;
    $idVoucher = isset($_SESSION['promodeCode']) ? $_SESSION['promodeCode'] : NULL;
    $receiverName = $_POST['receiverName'];
    $receiverAddress = $_POST['receiverAddress'];
    $receiverEmail = $_POST['receiverEmail'];
    $receiverPhone = $_POST['receiverPhone'];
    $receiverNote = $_POST['receiverNote'];
    $otherReceiverName = $_POST['otherReceiverName'];
    $otherReceiverEmail = $_POST['otherReceiverEmail'];
    $otherReceiverPhone = $_POST['otherReceiverPhone'];
    $otherReceiverAddress = $_POST['otherReceiverAddress'];

    // If otherReceiver fields are empty, use receiver fields
    if (
        $otherReceiverName === "" &&
        $otherReceiverAddress === "" &&
        $otherReceiverPhone === "" &&
        $otherReceiverEmail === ""
    ) {
        $otherReceiverName = $receiverName;
        $otherReceiverEmail = $receiverEmail;
        $otherReceiverPhone = $receiverPhone;
        $otherReceiverAddress = $receiverAddress;
    }

    // Insert data into the 'order' table
    $sql = "INSERT INTO `order` (
        `id_user`,
        `id_voucher`,
        `full_name`,
        `email`,
        `phone`,
        `address`,
        `fullname_receiver`,
        `email_receiver`,
        `phone_receiver`,
        `address_receiver`,
        `note`
    ) VALUES (
        " . ($idUser !== null ? "'$idUser'" : 'NULL') . ",
    " . ($idVoucher !== null ? "'$idVoucher'" : 'NULL') . ",
        '$receiverName',
        '$receiverEmail',
        '$receiverPhone',
        '$receiverAddress',
        '$otherReceiverName',
        '$otherReceiverEmail',
        '$otherReceiverPhone',
        '$otherReceiverAddress',
        '$receiverNote'
    )";

    $result = $conn->query($sql);

    if ($idUser !== NULL) {
        // Insert data into the 'voucher_used' table
        $voucherID = $_SESSION['promodeCode'];
        $sqlVoucherUsed = "INSERT INTO `voucher_used` (`id_user`, `id_voucher`) VALUES ('$idUser', '$voucherID')";
        $resultVoucherUsed = $conn->query($sqlVoucherUsed);
    }


    if ($result) {
        echo $idVoucher;
    } else {
        echo "Error: ";
    }
}

if (isset($_GET['idpro'])) {
    $idpro = $_GET['idpro'];
    echo json_encode(['idpro' => $idpro]);
}



