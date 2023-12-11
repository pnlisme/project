<?php
print_r(
    $_SESSION['voucherSalePercent']['sale']
);
$html_checkout = "";
$html_cart = "";
$lastprice = 0;
$totalPrice = 0;
$priceAfterSale = 0;
$discountPercentage = $_SESSION['voucherSalePercent']['sale'];
$VND = "";



foreach ($_SESSION['cart'] as $key) {
    extract($key);
    if ($saleprice == "") {
        $lastprice = $price;
        $price = "";
        $VND = "";
    } else {
        $lastprice = $saleprice;
        $price = $price;
        $VND = "VND";
    }

    $totalPrice += $lastprice * $quantity;


    $html_cart .= '
    <div class="flex gap-4 my-2 lg:h-44 ">
              <div class="w-16 p-1 lg:w-1/6 bg-box rounded-box">
                  <img class=" h-full object-contain" src="' . $img . '" alt="">
               </div>
               <div class="flex flex-col justify-between">
                   <div>
                       <div class="font-bold text-sm lg:text-2xl">' . $name . '</div>
                       <div class="text-sm lg:text-xl text-customGray">' . $brand . '</div>
                   </div>
                   <div class="">
                   
                       <span class=" lg:my-0 text-sm lg:text-lg text-primary font-bold">' . $lastprice . '</span>
                       <span class="font-bold test-sm lg:text-lg">VND</span>
                       <del class=" block text-sm lg:text-md text-customGray">' . $price . " " . $VND . '</del>
                   </div>
               </div>
               <div class="ml-auto flex flex-col justify-between">
               <button onclick="handleDeleteButtonClick(this)">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="delete-cart ml-auto text-primary hover:scale-125 delay-75 h-5 w-5 cursor-pointer duration-150">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                   </svg>
               </button>

            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center gap-3 text-sm py-1.5 w-20 text-customGray border-2 border-box rounded-lg">
                    <button onclick="minusQuantity(this)">
                        <i class="minus-quantity fa-solid fa-minus" aria-hidden="true"></i>
                    </button>
                    <span class="">' . $quantity . '</span>
                    <button onclick="plusQuantity(this)">
                        <i class="plus-quantity fa-solid fa-plus" aria-hidden="true"></i>
                    </button>
               </div>
                <p class="totalPriceEach text-sm lg:text-md font-bold mt-2" >'.$totalPrice.' VND</p>
            </div>

               </div>
           </div>
    ';
}



?>

<section class="my-16">
    <div class="banner-content bg-primary">
        <div class="container py-4 flex justify-between items-center">
            <div>
                <!-- UPPER -->
                <div class="flex text-white">
                    <a class="mr-4 text-grey-500 relative after:content-[''] after:absolute after:top-1/4 after:-right-2 after:w-px after:px-px after:h-4 after:bg-gray-500 after:block" href="#">Home</a>
                    <p class="text-white">Shop</p>
                </div>
                <!-- LOWER -->
                <div>
                    <h1 class="banner-text text-h1 text-white font-bold mt-2">Explore All Products</h1>
                </div>
            </div>
            <!-- IMG -->
            <div class="w-2/12">
                <img src="uploads/cucShit.png" alt="">
            </div>
        </div>
    </div>
</section>

<!-- CONTENT -->
<div id="content">
    <div class="cart-container flex flex-col justify-between lg:flex-row max-[640px]:m-4 md:m-4 lg:mx-16 ">
        <!-- CART -->
        <div class="cart lg:w-2/3 py-8 px-8 w-full">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl">Your Cart</h2>
                <span class="opacity-70 text-sm font-bold clear-cart-btn cursor-pointer hover:opacity-100 transition duration-300 delay-75"><i class='bx bx-x'></i> Clear cart</span>
            </div>

            <!--START: SINGLE PRODUCT -->
            <div class="cart-items-container">
                <?= $html_cart ?>
            </div>


        </div>

        <!-- TOTAL BOARD -->
        <div class="mt-8 lg:flex lg:items-start lg:w-1/3 lg:ml-8 ">
            <div class="checkout w-full">
                <div class="relative">
                    <?php
                    if (isset($_SESSION['s_user']) && (count($_SESSION['s_user']) > 0)) {
                        echo   $html_checkout = '
                        <p class="font-semibold text-lg">Promo code</p>
                        <input class="border-2 rounded-button px-4 py-1 mt-4 promoteCode" type="text" name="promoteCode"
                            placeholder="Type here...">
                            <span class="transition duration-300 alert-text absolute -bottom-6 left-1 text-red-500"></span>
                        <button class="promodeApply">
                            <div
                                class=" ml-4 px-6 py-1.5 bg-primary rounded-button hover:bg-transparent border-2 hover:border-primary  transition duration-300 text-white hover:text-primary">
                                Apply
                            </div>
                        </button>';
                    } else {
                        echo   $html_checkout = '
                        <p class="font-semibold text-lg">Promo code</p>
                        <input class="border-2 rounded-button px-4 py-1 mt-4 promoteCodeNotUser" type="text" name="promoteCodeNotUser"
                            placeholder="Type here...">
                        <span class="hidden transition duration-300 notUser-text absolute -bottom-6 left-1 text-red-500">Bạn phải đăng nhập mới có thể nhập voucher</span>
                        <button class="promodeApplyNotUser">
                            <div
                                class=" ml-4 px-6 py-1.5 bg-primary rounded-button hover:bg-transparent border-2 hover:border-primary  transition duration-300 text-white hover:text-primary">
                                Apply
                            </div>
                        </button>';
                    }
                    ?>
                </div>


                <div class="border-t-2 pt-6 mt-6">

                    <div class="text-lg font-bold flex justify-between items-center  my-5">
                        <p>Giảm giá</p>
                        <div class="flex">
                            <p class="priceDiscount mr-1 ">0</p>
                            <p>VND</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-lg font-bold ">
                        <p>Tổng</p>
                        <div class="flex w-fit  items-center">
                            <div class="overflow-y-hidden text-right">
                                <p class="total-cart-discounted -translate-y-8 mr-1">450000</p>
                                <p class="totalCart  -translate-y-3.5 mr-1"><?=
                                                                            round($totalPrice = $totalPrice - ($totalPrice * ($discountPercentage / 100)));
                                                                            ?></p>
                            </div>
                            <span class=" top-0 right-0">VND</span>
                        </div>

                    </div>
                </div>

                <a class="block border-2 rounded-md bg-bl text-white text-sm font-semibold py-3 text-center mt-7 border-2 hover:bg-transparent hover:border-primary hover:text-primary transitio duration-300" href="index.php?pg=checkout">CHECK OUT</a>
            </div>

        </div>
    </div>

</div>