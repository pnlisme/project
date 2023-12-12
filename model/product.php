<?php
require_once 'pdo.php';

// function hang_hoa_insert($ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet, $so_luot_xem, $ngay_nhap, $mo_ta){
//     $sql = "INSERT INTO hang_hoa(ten_hh, don_gia, giam_gia, hinh, ma_loai, dac_biet, so_luot_xem, ngay_nhap, mo_ta) VALUES (?,?,?,?,?,?,?,?,?)";
//     pdo_execute($sql, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet==1, $so_luot_xem, $ngay_nhap, $mo_ta);
// }

// function hang_hoa_update($ma_hh, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet, $so_luot_xem, $ngay_nhap, $mo_ta){
//     $sql = "UPDATE hang_hoa SET ten_hh=?,don_gia=?,giam_gia=?,hinh=?,ma_loai=?,dac_biet=?,so_luot_xem=?,ngay_nhap=?,mo_ta=? WHERE ma_hh=?";
//     pdo_execute($sql, $ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $dac_biet==1, $so_luot_xem, $ngay_nhap, $mo_ta, $ma_hh);
// }

// function hang_hoa_delete($ma_hh){
//     $sql = "DELETE FROM hang_hoa WHERE  ma_hh=?";
//     if(is_array($ma_hh)){
//         foreach ($ma_hh as $ma) {
//             pdo_execute($sql, $ma);
//         }
//     }
//     else{
//         pdo_execute($sql, $ma_hh);
//     }
// }
function get_brand_namee()
{
    $sql = "SELECT p.*, b.name as brand_name 
            FROM product p
            JOIN brand b ON p.id_brand = b.id
            ORDER BY p.id ASC";

    return pdo_query($sql);
}


function get_brand_name()
{
    $sql = "SELECT DISTINCT b.name as brand_name 
        FROM product p
        JOIN brand b ON p.id_brand = b.id
        ORDER BY p.id ASC";
    return pdo_query($sql);
}

function get_category_name()
{
    $sql = "SELECT c.name as category_name
        FROM product p
        JOIN category c ON p.id_category = c.id
        ORDER BY p.id ASC";
    return pdo_query($sql);
}
function get_product_all($kyw, $limi)
{
    $sql = "SELECT p.*, b.name as brand_name 
            FROM product p
            JOIN brand b ON p.id_brand = b.id
            WHERE p.name LIKE '%" . $kyw . "%'
            ORDER BY p.id ASC
            LIMIT " . $limi;

    return pdo_query($sql);
}
function get_product_hot($limi)
{
    $sql = "SELECT p.*, b.name as brand_name 
        FROM product p
        JOIN brand b ON p.id_brand = b.id
        WHERE p.hot = 1
        ORDER BY p.id ASC
        LIMIT " . $limi;
    return pdo_query($sql);
}
function get_product_new($limi)
{
    $sql = "SELECT p.*, b.name as brand_name 
    FROM product p
    JOIN brand b ON p.id_brand = b.id
    ORDER BY p.id DESC
    LIMIT " . $limi;
    return pdo_query($sql);
}
function get_product_sale($limi)
{
    $sql = "SELECT * FROM product WHERE sale = 1 ORDER BY id ASC LIMIT " . $limi;
    return pdo_query($sql);
}
function get_product_view($limi)
{
    $sql = "SELECT p.*, b.name as brand_name 
    FROM product p
    JOIN brand b ON p.id_brand = b.id
    WHERE p.view > 99
    ORDER BY p.id ASC
    LIMIT " . $limi;
    return pdo_query($sql);
}
function get_product_relate($iddm, $id, $limi)
{
    $sql = "SELECT p.*, b.name as brand_name 
    FROM product p
    JOIN brand b ON p.id_brand = b.id
    WHERE p.id_category=? AND p.id<>?
    ORDER BY p.id ASC
    LIMIT " . $limi;
    return pdo_query($sql, $iddm, $id);
}

function get_product_by_id($id)
{
    $sql = "SELECT 
                product.*,
                brand.name AS brand_name,
                category.name AS category_name,
                product_detail.img_1,
                product_detail.img_2,
                product_detail.img_3,
                product_detail.img_4
            FROM 
                product
            JOIN 
                brand ON product.id_brand = brand.id
            JOIN 
                category ON product.id_category = category.id
            JOIN 
                product_detail ON product.id = product_detail.id_product
            WHERE 
                product.id=?";
    return pdo_query_one($sql, $id);
}
function show_product($dssp)
{
    $html_dssp = '';
    foreach ($dssp as $sp) {
        extract($sp);
        // Tính phần trăm giảm giá
        $percent_discount = ($price - $price_sale) / $price * 100;
        if ($sale > 0 && $sale < 100) {
            $item_sale = '<div class="absolute top-2 text-sm left-2 bg-primary w-fit rounded-box text-white p-2">
        Sale ' . round($percent_discount) . '%
    </div>';
        } else {
            $item_sale = '';
        }
        if ($img != "") $img = PATH_IMG . $img;
        $link = "index.php?pg=detail&idpro=" . $id;
        $html_dssp .=
            ' <div class="overflow-hidden group">

    <div class="bg-box relative z-10 flex items-center  h-3/4 lg:h-96  justify-center pb-20">
    <input type="hidden" class="inputImg" name="img" value="' . $img . '">
    <input type="hidden" name="name" value="' . $name . '">
    <input type="hidden" name="brand" value="' . $brand_name . '">
    <input type="hidden" name="price" value="' . $price . '">
    <input type="hidden" name="price_sale" value="' . $price_sale . '"> 
        <a href="' . $link . '" >
                <img class="group-hover:scale-125 h-64 object-contain group-hover:blur-sm  transition duration-500" 
        src="' . $img . '" alt="">
        </a>
        <div
            class="absolute z-99 bottom-0 flex gap-2  mb-4 xl:mb-0 items-center justify-center lg:flex xl:block xl:bottom-1/2 xl:right-1/2 xl:translate-x-1/2 xl:translate-y-1/2  xl:opacity-0 xl:group-hover:opacity-100 transition-all duration-300">
            <button onclick="addToCart(this)"
                class="cursor-pointer hover:scale-125 transition duration-300 addToCart flex items-center justify-center gap-2 bg-primary text-white h-8 w-8 xl:h-auto xl:w-36  p-2 rounded-box xl:translate-x-4 group-hover:translate-x-0 transition duration-300 delay-75">
                <i class="fa-solid fa-basket-shopping"></i>
                <p class="text-white hidden xl:block">Add To cart</p>
            </button>
            <div
                class="hover:scale-125 transition duration-300 flex items-center justify-center gap-2 xl:mt-2 bg-primary text-white h-8 w-8 xl:h-fit xl:w-fit p-2 rounded-box xl:-translate-x-4 xl:group-hover:translate-x-0 transition duration-300 delay-75">
                <i class="fa-regular fa-eye"></i>
                <a href="' . $link . '"  class=" text-white hidden xl:block">View Product</a>
            </div>
        </div>
        <div
            class="absolute xl:group-hover:-translate-x-2 xl:group-hover:opacity-100 xl:opacity-0  transition duration-300 delay-75 top-2 right-0 bg-primary text-white px-2 py-1 rounded-box">
            <i class="fa-regular fa-heart"></i>
        </div>
        ' . $item_sale . '
    </div>

    <!-- DES -->
    <p class="text-center font-bold mt-2 text-sm lg:text-xl">' . $name . '</p>
    <p class="my-2 text-center text-sm">' . $brand_name . '</p>
    <div class="flex flex-col lg:flex-row justify-center gap-1 lg:gap-4  items-center">
    <p class="text-sm lg:text-lg font-bold">' . $price_sale . 'VNĐ</p>
    <del class="font-del text-sm lg:text-lg ">' . $price . 'VNĐ</del>
    </div>
</div>';
    }
    return $html_dssp;
}
// show_product_new
function show_product_new($pr_new)
{
    $html_pr_new = '';
    foreach ($pr_new as $sp) {
        extract($sp);
        // $percent_discount = ($price - $price_sale) / $price * 100;
        // if ($sale > 0 && $sale < 100) {
        //     $item_sale = '<div class="absolute top-2 text-sm left-2 bg-primary w-fit rounded-box text-white p-2">
        //     Sale '. round($percent_discount).'%
        // </div>';
        // } else {
        //     $item_sale ='';
        // }
        if ($img != "") $img = PATH_IMG . $img;
        $link = "index.php?pg=detail&idpro=" . $id;
        $html_pr_new .= '<div class=" swiper-slide relative flex justify-center items-center gap-60">
        <div class="">
            <div>
                <div class="flex gap-2 items-center">
                    <div class="w-8 h-8 grid place-content-center rounded-full bg-primary ">
                        <i class="fa-solid fa-fire text-white"></i>
                    </div>
                    Hot deal this week
                </div>
                <h1 class="text-8xl font-bold mt-4 w-96">' . $name . '</h1>
            </div>
            
            <a href="' . $link . '"class=" mt-4 cursor-pointer border-2 hover:bg-transparent 
                                hover:text-primary hover:border-primary transition 
                                duration-300 px-20 py-4 text-h2 bg-primary text-white 
                                font-bold w-fit rounded-button mx-auto lg:mx-0 block mt-4">MUA NGAY
            </a>
        </div>
        <a href="' . $link . '" >
          <img class="w-96 object-contain " src="' . $img . '" alt="">
        </a>
    </div>';
    }
    return $html_pr_new;
}
// show_product_new
function show_product_new_secondary($pr_new)
{
    $html_pr_new = '';
    foreach ($pr_new as $sp) {
        extract($sp);
        $percent_discount = ($price - $price_sale) / $price * 100;
        // if ($sale > 0 && $sale < 100) {
        //     $item_sale = '<div class="absolute top-2 text-sm left-2 bg-primary w-fit rounded-box text-white p-2">
        //     Sale '. round($percent_discount).'%
        // </div>';
        // } else {
        //     $item_sale ='';
        // }
        if ($img != "") $img = PATH_IMG . $img;
        $link = "index.php?pg=sanphamchitiet&idpro=" . $id;
        $html_pr_new .= ' <div class="swiper-slide justify-between slider-box-hero bg-box rounded-box py-4 flex flex-col items-center">
        <img class="w-80 object-cover" src="' . $img . '" alt="" />
            <div>
            <p class="text-center font-bold mt-4">' . $name . '</p>
            <p class="text-center font-bold mb-6">' . $price_sale . '</p>
            </div>

    </div>';
    }
    return $html_pr_new;
}
//product_view_2
function show_product_view_secondary($dssp)
{
    $html_dssp = '';
    foreach ($dssp as $sp) {
        extract($sp);

        // Tính phần trăm giảm giá

        $percent_discount = ($price - $price_sale) / $price * 100;
        if ($sale > 0 && $sale < 100) {
            $item_sale = '<div
        class="absolute top-2 text-sm left-2 bg-primary w-fit rounded-box text-white p-2">
        Sale ' . round($percent_discount) . '%
    </div>';
        } else {
            $item_sale = '';
        }
        if ($img != "") $img = PATH_IMG . $img;
        $link = "index.php?pg=sanphamchitiet&idpro=" . $id;
        $html_dssp .=
            ' <div class="swiper-slide flex items-center justify-center">
    <!-- SINGLE PRODUCT -->
    <div class="overflow-hidden w-full group rounded-box">
        <div class="bg-box relative slider-box flex justify-center pb-16">
        <input type="hidden" name="img" value="' . $img . '">
        <input type="hidden" name="name" value="' . $name . '">
        <input type="hidden" name="brand" value="' . $brand_name . '">
        <input type="hidden" name="price" value="' . $price_sale . '">
        <input type="hidden" name="price_sale" value="' . $price . '"> 
        <a  href="' . $link . '" >
        <img class="group-hover:scale-125  group-hover:blur-sm  transition duration-500" 
src="' . $img . '" alt="">
</a>

            <div
                class="absolute bottom-0 flex gap-2  mb-4 xl:mb-0 items-center justify-center lg:flex xl:block xl:bottom-1/2 xl:right-1/2 xl:translate-x-1/2 xl:translate-y-1/2  xl:opacity-0 xl:group-hover:opacity-100 transition-all duration-300">
                <button onclick="addToCart(this)"
                    class="addToCart cursor-pointer flex items-center justify-center gap-2 bg-primary text-white h-8 w-8 xl:h-auto xl:w-auto  p-2 rounded-box xl:translate-x-4 group-hover:translate-x-0 transition duration-300 delay-75">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <p class="text-white hidden xl:block">Add To cart</p>

                </button>
                <div
                    class="cursor-pointer flex items-center justify-center gap-2 xl:mt-2 bg-primary text-white h-8 w-8 xl:h-fit xl:w-fit p-2 rounded-box xl:-translate-x-4 xl:group-hover:translate-x-0 transition duration-300 delay-75">
                    <i class="fa-regular fa-eye"></i>
                    <a href="' . $link . '" class="text-white hidden xl:block">View Product</a>
                </div>
            </div>
            <div
                class="absolute xl:group-hover:-translate-x-2 xl:group-hover:opacity-100 xl:opacity-0  transition duration-300 delay-75 top-1 right-2 bg-primary text-white px-2 py-1 rounded-box">
                <i class="fa-regular fa-heart"></i>
            </div>
            ' . $item_sale . '
        </div>

        <!-- DES -->
        <p class="text-center font-bold mt-4">' . $name . '</p>
        <p class="text-center text-sm">' . $brand_name . '</p>
        <div class="flex justify-center gap-4">
        <p>' . $price_sale . 'VNĐ</p>
        <del class="font-del">' . $price . 'VNĐ</del>
        </div>
    </div>
</div>';
    }
    return $html_dssp;
}

// function hang_hoa_exist($ma_hh){
//     $sql = "SELECT count(*) FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_value($sql, $ma_hh) > 0;
// }

// function hang_hoa_tang_so_luot_xem($ma_hh){
//     $sql = "UPDATE hang_hoa SET so_luot_xem = so_luot_xem + 1 WHERE ma_hh=?";
//     pdo_execute($sql, $ma_hh);
// }

// function hang_hoa_select_top10(){
//     $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
//     return pdo_query($sql);
// }

// function hang_hoa_select_dac_biet(){
//     $sql = "SELECT * FROM hang_hoa WHERE dac_biet=1";
//     return pdo_query($sql);
// }

// function hang_hoa_select_by_loai($ma_loai){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
//     return pdo_query($sql, $ma_loai);
// }

// function hang_hoa_select_keyword($keyword){
//     $sql = "SELECT * FROM hang_hoa hh "
//             . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
//             . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
//     return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%');
// }

// function hang_hoa_select_page(){
//     if(!isset($_SESSION['page_no'])){
//         $_SESSION['page_no'] = 0;
//     }
//     if(!isset($_SESSION['page_count'])){
//         $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
//         $_SESSION['page_count'] = ceil($row_count/10.0);
//     }
//     if(exist_param("page_no")){
//         $_SESSION['page_no'] = $_REQUEST['page_no'];
//     }
//     if($_SESSION['page_no'] < 0){
//         $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
//     }
//     if($_SESSION['page_no'] >= $_SESSION['page_count']){
//         $_SESSION['page_no'] = 0;
//     }
//     $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh LIMIT ".$_SESSION['page_no'].", 10";
//     return pdo_query($sql);
// }

function product_count_all()
{
    $sql = "SELECT COUNT(*) FROM product";
    return pdo_query_value($sql);
}
function product_detail($id)
{
    $sql = "SELECT p.*, d.* 
    FROM product p 
    JOIN product_detail d ON p.id = d.id_product
    WHERE p.id = " . $id;
    return pdo_query_one($sql);
}
function product_select_by_id($id)
{
    $sql = "SELECT * FROM product WHERE id = " . $id;
    return pdo_query_one($sql);
}
function product_detail_select_by_id($id)
{
    $sql = "SELECT * FROM product_detail WHERE id_product = " . $id;
    return pdo_query_one($sql);
}
function product_update($id, $img, $name, $price, $price_sale, $sale, $hot, $status, $view, $id_category, $id_brand, $des, $entry_date, $quantity)
{
    $sql = "UPDATE `product` SET `img` = ?, `name` = ?, `price` = ?, `price_sale` = ?, `sale` = ?, `hot` = ?, `status` = ?, `view` = ?, `id_category` = ?, `id_brand` = ?, `des` = ?, `entry_date` = ?, `quantity` = ? WHERE `product`.`id` = ?";
    pdo_execute($sql, $img, $name, $price, $price_sale, $sale, $hot, $status, $view, $id_category, $id_brand, $des, $entry_date, $quantity, $id);
}
function product_detail_update($img_1, $img_2, $img_3, $img_4, $id_product)
{
    $sql = "UPDATE `product_detail` SET `img_1` = ?, `img_2` = ?, `img_3` = ?, `img_4` = ? WHERE `product_detail`.`id_product` = ?";
    pdo_execute($sql, $img_1, $img_2, $img_3, $img_4, $id_product);
}
function product_insert($id, $img, $name, $price, $price_sale, $sale, $hot, $status, $view, $id_category, $id_brand, $des, $entry_date, $quantity)
{
    $sql = "INSERT INTO `product` (`id`, `img`, `name`, `price`, `price_sale`, `sale`, `hot`, `status`, `view`, `id_category`, `id_brand`, `des`, `entry_date`, `quantity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $id, $img, $name, $price, $price_sale, $sale, $hot, $status, $view, $id_category, $id_brand, $des, $entry_date, $quantity);
}
function product_detail_insert($img_1, $img_2, $img_3, $img_4, $id_product)
{
    $sql = "INSERT INTO `product_detail` (`img_1`, `img_2`, `img_3`, `img_4`, `id_product`) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $img_1, $img_2, $img_3, $img_4, $id_product);
}
function product_delete($id)
{
    $sql = "DELETE FROM `product` WHERE `product`.`id` = ?";
    if (is_array($id)) {
        foreach ($id as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id);
    }
}
function product_detail_delete($id)
{
    $sql = "DELETE FROM `product_detail` WHERE `product_detail`.`id_product` = ?";
    if (is_array($id)) {
        foreach ($id as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $id);
    }
}

function show_product_search($dssp)
{
    $html_dssp = '';
    $VND = "";
    $lastprice = '';
    foreach ($dssp as $sp) {
        extract($sp);

        // Tính phần trăm giảm giá
        if ($price_sale == "") {
            $lastprice = $price;
            $price = "";
            $VND = "";
        } else {
            $lastprice = $price_sale;
            $price = $price;
            $VND = "VND";
            $percent_discount = ($price - $price_sale) / $price * 100;
        }

        if ($sale > 0 && $sale < 100) {
            $item_sale = '<div class="absolute top-2 text-sm left-2 bg-primary w-fit rounded-box text-white p-2">
        Sale ' . round($percent_discount) . '%
    </div>';
        } else {
            $item_sale = '';
        }
        if ($img != "") $img = PATH_IMG . $img;
        $link = "index.php?pg=detail&idpro=" . $id;
        $html_dssp .=
            '<div class="flex flex-col justify-center">
                                                    <div class="bg-box  rounded-box flex items-center justify-center">
                                                        <a href="' . $link . '">
                                                            <img class="object-contain  h-3/4" src="' . $img . '" alt="">
                                                        </a>
                                                    </div>
                                                    <span class="mt-4 w-fit mx-auto" >' . $name . '</span>
                                                    <div class="w-fit mx-auto mt-1">
                                                        <p  class="w-fit font-bold mb-1">' . $lastprice . 'VND</p>
                                                        <p class="line-through	 w-fit"> ' . $price . 'VND</p>
                                                    </div>
                                                </div>';
    }
    return $html_dssp;
}

function product_count_now()
{
    $sql = "SELECT count(*) FROM product
    WHERE MONTH(entry_date) = MONTH(CURRENT_DATE())
        AND YEAR(entry_date) = YEAR(CURRENT_DATE());
    ";
    return pdo_query_value($sql);
}
