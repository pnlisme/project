<?php
echo var_dump($_SESSION['promodeCode']);

$html_cart = "";
$lastprice = 0;
$totalPrice = 0;
$VND = "";
$discountPercentage = $_SESSION['voucherSalePercent']['sale'];
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
    <div class="flex flex-col rounded-lg sm:flex-row">
    <img class="bg-box m-2 h-24 w-1/5 rounded-md object-contain object-center" src="' . $img . '"" />
    <div class="flex w-full flex-col px-4">
        <div class="flex justify-between">
            <span class="font-semibold text-h2 text-white">' . $name . '</span>
        </div>
        <p class="text-white">' . $brand . '</p>
        <p class="text-white text-sm my-1" >Số lượng: ' . $quantity . '</p>
        <div class="flex gap-4">
        
            <span class="text-sm font-bold text-white ">' . $lastprice . ' VND</span>
            <del class="font-bold text-white text-sm">' . $price . " " . $VND . '</del>
            <p class="text-white ml-auto text-sm ">Tổng: '.$quantity * $lastprice.' VND</p>

        </div>


    </div>
</div>
';
}



// print_r($_SESSION['voucherSalePercent']['sale']);




?>


<form action="" method="" class="my-8">
    <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
        <a href="#" class="text-2xl font-bold text-gray-800">
            <img src="/layout/assets/img/logo.png" alt="">
        </a>
        <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
            <div class="relative">
                <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-xs font-semibold text-emerald-700"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </a>
                        <span class="font-semibold text-gray-900">Shop</span>
                    </li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-600 text-xs font-semibold text-white ring ring-gray-600 ring-offset-2"
                            href="#">2</a>
                        <span class="font-semibold text-gray-900">Shipping</span>
                    </li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white"
                            href="#">3</a>
                        <span class="font-semibold text-gray-500">Complete</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
        <div class="px-4 pt-8">
            <p class="text-xl font-medium">Order Summary</p>
            <p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
            <div class="mt-8 space-y-3 rounded-lg border bg-primary px-2 py-4 sm:px-6">
                <!-- PRODUCT -->
                <!-- SINGLE -->
                <?= $html_cart ?>
                <!-- SINGLE -->
                <!-- PRODUCT -->
            </div>
            <p class="mt-8 text-lg font-medium mb-5">Shipping Methods</p>
            <form class="mt-5 grid gap-6 " method="post" action="">
                <div class="relative">
                    <input class="peer hidden" id="radio_1" type="radio" name="radio" value="0" checked />
                    <span
                        class="peer-checked:opacity-100 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-primary opacity-50 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                        for="radio_1">
                        <img class="w-14 object-contain" src="/images/naorrAeygcJzX0SyNI4Y0.png" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">Tiền mặt </span>
                            <p class="text-slate-500 text-sm leading-6">Thanh toán khi nhận hàng</p>
                        </div>
                    </label>
                </div>
                <div class="relative mt-4">
                    <input class="peer hidden" id="radio_2" type="radio" name="radio" value="1" />
                    <span
                        class="peer-checked:opacity-100 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-primary opacity-50 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                        for="radio_2">
                        <img class="w-14 object-contain" src="/images/oG8xsl3xsOkwkMsrLGKM4.png" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">Thẻ ngân hàng</span>
                            <p class="text-slate-500 text-sm leading-6">Dùng thẻ ngân hàng thanh toán</p>
                        </div>
                    </label>
                </div>
            </form>

        </div>

        <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
            <p class="text-xl font-medium">Thông tin thanh toán</p>
            <p class="text-gray-400">Điền thông tin để đến bước tiếp theo.</p>
            <div class="">
                <label for="email" class="mt-4 mb-2 block text-sm font-medium">Họ tên</label>
                <div class="relative">
                    <input required value="" type="text" name="name"
                        class="inputName w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Họ tên">
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-customGray" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                        </svg>
                    </div>
                </div>

                <p class="text-red-500 opacity-100 transition duration-100 alertInputName"></p>
                <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Địa chỉ</label>
                <div class="relative">
                    <input required type="text" id="card-holder" name="location"
                        class="inputAddress w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm  shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Địa chỉ" />

                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <img src="uploads/location.png" class="h-4 w-4 text-gray-400" alt="">
                    </div>
                </div>
        
                <p class="text-red-500 opacity-100 transition duration-100 alertInputAddress"></p>

                <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                <div class="relative">
                    <input required value="" type="text" id="email" name="email"
                        class="inputEmail w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="your.email@gmail.com" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <img src="uploads/mail.png" class="h-4 w-4 text-gray-400" alt="">
                    </div>
                </div>
                <p class="text-red-500 opacity-100 transition duration-100 alertInputEmail"></p>

                <label for="phone" class="mt-4 mb-2 block text-sm font-medium">Điện thoại</label>
                <div class="relative">
                    <input required value="" placeholder="xxxx-xxx-xxx" type="text" name="phone"
                        class="inputPhone w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500">
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <img src="Uploads/phone.png" class="h-4 w-4 text-gray-400" alt="">
                    </div>
                </div>
                <p class="text-red-500 opacity-100 transition duration-100 alertInputPhone"></p>


                <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Ghi chú</label>
                <textarea rows="4"  type="text" name="note" aria-placeholder="Ghi chú"
                    class="inputNote mt-4 w-full rounded-md border border-gray-200 px-4 py-3 pl-2 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500">
          </textarea>
            <div>
                <div class="notForMe text-customGray font-bold cursor-pointer mt-2 select-none hover:text-primary transition duration-300">Giao đến địa chỉ khác</div>
                <div class="mt-2 notFotMe-hidden flex flex-col overflow-y-hidden h-0 transition-all duration-300">
                <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium" >Họ tên</label>
                <div class="relative">
                    <input  tabindex="-1" value="" type="text" id="card-holder" name="location" 
                        class="other-receiver-name w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm  shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Họ tên" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-customGray" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"></path>
                        </svg>
                    </div>
                </div>
                <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                <div class="relative">
                    <input  tabindex="-1" value="" type="text" id="card-holder" name="location"
                        class="other-receiver-mail w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm  shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Email" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <img src="uploads/mail.png" class="h-4 w-4 text-gray-400" alt="">
                    </div>
                </div>
                <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Điện thoại</label>
                <div class="relative">
                    <input  tabindex="-1" value="" type="text" id="card-holder" name="location"
                        class="other-receiver-phone w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm  shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="xxxx-xxx-xx" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <img src="uploads/phone.png" class="h-4 w-4 text-gray-400" alt="">
                    </div>
                </div>
                <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Địa chỉ</label>
                <div class="relative">
                    <input tabindex="-1" value="" type="text" id="card-holder" name="location"
                        class="other-receiver-address w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm  shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Địa chỉ" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                        <img src="uploads/location.png" class="h-4 w-4 text-gray-400" alt="">
                    </div>
                </div>
                </div>
            </div>
                <!-- Total -->
                <div class="mt-6 border-b py-2">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Tiền giảm</p>
                        <p class="salePrice font-semibold text-gray-900"><?=round($totalPrice * ($discountPercentage / 100))?> VND</p>
                        
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Tổng</p>
                    <div class="flex gap-1 items-center text-2xl font-semibold">
                        <p class="priceDiscount"><?=
                     round($totalPrice = $totalPrice - ($totalPrice * ($discountPercentage / 100)));
                        
                        ?></p>
                        <p class="text-2xl font-semibold text-gray-900">VND</p>
                    </div>
                </div>
                <!-- END TOTAL -->
            </div>
            <a  href="#"
                class="placeOrder block text-center cursor-pointer hover:bg-transparent hover:text-primary border-2 hover:border-primary transition duration-300 placeOrder mt-4 mb-8 w-full rounded-md bg-primary px-6 py-3 text-white font-bold">
            Đặt Hàng
            </a>
        </div>
    </div>
</form>

<div class="modal-sumary fixed top-0 left-0 right-0 bottom-0  flex items-center justify-center bg-black  hidden transition-all duration-300">

</div>

<div class="sumary-box fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-primary mx-auto w-1/4 rounded-box px-8 py-2 hidden ">
    <div class="">
        <a class="text-sm text-customGray hover:text-white transition duration-300" href="index.php">
        Về trang chủ
        </a>
        <h1 class="text-white text-h3 mt-4">Thông tin đơn hàng:</h1>
        <div class="text-white border-b-2 border-customGray mb-4 name">Họ tên: Phan Văn Tèo</div>
        <div class="text-white border-b-2 border-customGray mb-4 address">Địa chỉ: 195 Hàm Tử</div>
        <div class="text-white border-b-2 border-customGray mb-4 email">Email: babdu@gmail.com</div>
        <div class="text-white border-b-2 border-customGray mb-4 phone">Phone: 090880980</div>
        <div class="text-white border-b-2 border-customGray mb-4 note">Ghi chú: </div>
        <div class="text-white border-b-2 border-customGray mb-4 receiver-name">Họ tên người nhận: Ba Tèo</div>
        <div class="text-white border-b-2 border-customGray mb-4 receiver-email">Email người nhận: bateo@gmail.com</div>
        <div class="text-white border-b-2 border-customGray mb-4 receiver-phone">Số điện thoại người nhận: 09080099</div>
        <div class="text-white border-b-2 border-customGray mb-4 receiver-address">Địa chỉ nhận: 199 Hàm Tử</div>
    </div>
    <div class="w-fit mx-auto mt-12">
    <button class="truck-button bg-box">
    <span class="default ">Complete Order</span>
    <span class="success ">
        Order Placed
        <svg viewbox="0 0 12 10">
            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
        </svg>
    </span>
    <div class="truck">
        <div class="wheel"></div>
        <div class="back"></div>
        <div class="front"></div>
        <div class="box"></div>
    </div>
</button>
    </div>                
</div>
