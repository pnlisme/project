<?php
include_once '../model/pdo.php';
include_once '../model/product.php';
include_once './global.php';

$output = '';


$conn = pdo_get_connection();
if (isset($_POST['action'])) {
    $sql='';    
      
    $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
    $cate = isset($_POST['category']) ? $_POST['category'] : '';

    $sql = "SELECT p.*, b.name AS brand_name, c.name AS category_name
            FROM product p
            JOIN brand b ON p.id_brand = b.id
            JOIN category c ON p.id_category = c.id
            WHERE 1";

    if (!empty($brand)) {
        $sql .= " AND b.name = '" . $brand . "'";
    }

    if (!empty($cate)) {
        $sql .= " AND c.name = '" . $cate . "'";
    }
        
    $result = $conn->query($sql);
    if ($result->rowCount()>0) {
        while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
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
            $output .=
                ' <div class="overflow-hidden group">
    
        <div class="bg-box relative z-10 flex items-center  h-3/4 lg:h-96  justify-center pb-20">
        <input type="hidden" class="inputImg" name="img" value="'.$img.'">
        <input type="hidden" name="name" value="'.$name.'">
        <input type="hidden" name="price" value="'.$price.'">
        <input type="hidden" name="price_sale" value="'.$price_sale.'"> 
            <a href="' . $link . '" >
                    <img class="group-hover:scale-125 h-64 object-contain group-hover:blur-sm  transition duration-500" 
            src="' . $img . '" alt="">
            </a>
            <div
                class="absolute z-99 bottom-0 flex gap-2  mb-4 xl:mb-0 items-center justify-center lg:flex xl:block xl:bottom-1/2 xl:right-1/2 xl:translate-x-1/2 xl:translate-y-1/2  xl:opacity-0 xl:group-hover:opacity-100 transition-all duration-300">
                <button onclick="addToCart(this)"
                    class="cursor-pointer hover:scale-125 transition duration-300 addToCart flex items-center justify-center gap-2 bg-primary text-white h-8 w-8 xl:h-auto xl:w-auto  p-2 rounded-box xl:translate-x-4 group-hover:translate-x-0 transition duration-300 delay-75">
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
        <p class="my-2 text-center text-sm">' . $brand . '</p>
        <div class="flex flex-col lg:flex-row justify-center gap-1 lg:gap-4  items-center">
            <del class="font-del text-sm lg:text-lg ">' . $price . 'VNĐ</del>
            <p class="text-sm lg:text-lg font-bold">' . $price_sale . 'VNĐ</p>
        </div>
    </div>
    ';
        
    
        
        }
    }
    else {
        $output= '<h3 class="absolute top-1/2 left-1/2 text-xl font-bold
        -translate-x-1/2 
        -translate-y/1/2"> Không có sản phẩm được lọc</h3>';
        // echo '<script>handleShowAndHideToast("success");</script>';
        // echo $output;
    // print_r($sql);   
    }
    echo $output; 
    // echo '<script>handleShowAndHideToast("error", "Item has been deleted.");</script>';
    // print_r($sql);   

}