<?php
$html_product_search= show_product_search($product_search_hot);

if ((count($_SESSION['s_user']) > 0)) {
    extract($_SESSION['s_user']);
    $html_account = ' <ul class="space-y-3">
        <li class="font-medium">
            <a href="index.php?pg=account"
                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                <div class="mr-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                    </svg>
                </div>
                ' . $username . '
            </a>
        </li>
        <li class="font-medium">
            <a href="index.php?pg=account"
                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                <div class="mr-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                Setting
            </a>
        </li>
        <hr class="t" />
        <li class="font-medium">
            <a href="index.php?pg=logout"
                class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-600">
                <div class="mr-3 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </div>
                Đăng xuất
            </a>
        </li>
    </ul>';
} else {
    $html_account = ' <ul class="space-y-3">
    <li class="font-medium">
        <a href="index.php?pg=signin"
            class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
            <div class="mr-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
            </div>
            Đăng nhập
        </a>
    </li>
    <li class="font-medium">
        <a href="index.php?pg=signup"
            class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
            <div class="mr-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
            </div>
            Đăng ký
        </a>
    </li>
</ul>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="View/layout/assets/css/app.css" />
    <!-- PLUGIN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js"></script>
    <script src="View/layout/assets/js/toast.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.27/bundled/lenis.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/e5ff98b392.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>


    <div id="container-header">
        <!-- SEARCH -->
        <!-- Toast Message  -->
        <div id="toast">


        </div>
        <!-- SEARCH -->
        <header>
            <div>
                <div class="md:w-3/4 px-8 container rounded-15 mt-8 flex items-center justify-between">
                    <!-- LOGO -->
                    <div class="w-32 md:w-auto">
                        <img src="view/layout/assets/img/logo.png" alt="Logo Web" />
                    </div>
                    <!-- NAV -->
                    <div class="hidden xl:block">
                        <ul class="flex text-lg gap-12">
                            <li class="nav-items group">
                                <a class="nav-links relative before:content[''] before:absolute before:w-0 before:h-0.5 before:-bottom-1 group-hover:before:w-full before:transition-all before:duration-500 before:bg-primary" href="index.php?pg=home">Trang chủ</a>
                            </li>
                            <li class="nav-items group">
                                <a class="nav-links relative before:content[''] before:absolute before:w-0 before:h-0.5 before:-bottom-1 group-hover:before:w-full before:transition-all before:duration-500 before:bg-primary" href="index.php?pg=product">Sản phẩm</a>
                            </li>
                            <li class="nav-items group">
                                <a class="nav-links relative before:content[''] before:absolute before:w-0 before:h-0.5 before:-bottom-1 group-hover:before:w-full before:transition-all before:duration-500 before:bg-primary" href="index.php?pg=contact">Liên hệ</a>
                            </li>
                            <li class="nav-items group">
                                <a class="nav-links relative before:content[''] before:absolute before:w-0 before:h-0.5 before:-bottom-1 group-hover:before:w-full before:transition-all before:duration-500 before:bg-primary" href="index.php?pg=about">Giới thiệu</a>
                            </li>
                            <li class="nav-items group">
                                <a class="nav-links relative before:content[''] before:absolute before:w-0 before:h-0.5 before:-bottom-1 group-hover:before:w-full before:transition-all before:duration-500 before:bg-primary" href="index.php?pg=blog">Tin tức</a>
                            </li>
                        </ul>
                    </div>
                    <!-- SITE LINK -->
                    <div>
                        <ul class="flex items-center gap-2 md:gap-6">
                            <li class="w-6">
                                <a href="#" class="search-open group flex relative site-container items-center">
                                    <ion-icon name="search-outline" class="site-link_search group-hover:text-white transition duration-300"></ion-icon>
                                </a>
                            </li>

                            <li class="w-6">
                                <a href="#" class="group relative site-container block flex items-center rounded-full">
                                    <!-- <div class="absolute -z-10 top-0 -translate-x-1 left-px rounded-full scale-0 group-hover:scale-125 transition duration-300 bg-primary w-7 h-7 "></div> -->
                                    <ion-icon name="heart-outline" class="site-link_heart text-2xl group-hover:text-white transition duration-300">
                                    </ion-icon>
                                    <!-- <i class="mb-px fa-regular fa-heart text-xl text-primary group-hover:text-white transition duration-300 site-link_heart"></i> -->
                                </a>
                            </li>

                            <li class="w-6">

                                <a href="#" class="open-cart group text-2xl relative site-container flex items-center">
                                    <div class="items-cart text-sm absolute -top-2 -right-3 bg-box w-5 h-5 rounded-full text-center">

                                        <?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                                    </div>
                                    <ion-icon name="cart-outline" class="site-link_cart group-hover:text-white transition duration-300"></ion-icon>
                                </a>
                            </li>

                            <li class="">
                                <div class="flex justify-center relative z-10 mt-1 -mr-2">
                                    <div x-data="{ open: false }" class="">
                                        <div @click="open = !open" class="relative border-b-4 border-transparent" :class="{'.$html_user. ': open}" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100">
                                            <div class="flex justify-center items-center space-x-3 cursor-pointer">
                                                <div class="w-6 h-6 rounded-full overflow-hidden border-2 border-gray-900">
                                                    <img src="view/layout/assets/img/icon-user.png" alt="" class="w-full h-full object-cover" />
                                                </div>
                                            </div>
                                            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="right-0 absolute w-40 md:w-60 px-5 py-3 bg-white rounded-lg shadow border mt-5">
                                                <?= $html_account ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li data-lenis-toggle class="block xl:hidden mt-2 relative  z-50">
                                <div class="svgContainer cursor-pointer nav-off">
                                    <svg class="fancynavbar-toggler-icon" viewBox="0 0 70 70" xmlns="http://www.w3.org/2000/svg" data-zanim-lg='{"from":{"opacity":0,"x":45},"to":{"opacity":1,"x":0},"ease":"CubicBezier","duration":0.8,"delay":0.5}' style="transform: translate(0px, 0px); opacity: 1">
                                        <path id="path-top" class="transition-all duration-500 delay-75" d="M20,25c0,0,22,0,30,0c16,0,18.89,40.71-.15,21.75C38.7,35.65,19.9,16.8,19.9,16.8" style="
                            stroke-dasharray: 30px, 88px;
                            stroke-dashoffset: 0px;
                        "></path>
                                        <path id="path-middle" d="M20,32h30" class="transition-all duration-500 delay-100 " style="
                            stroke-dasharray: 30px, 30px;
                            stroke-dashoffset: 0px;
                        "></path>
                                        <path id="path-bottom" class="transition-all duration-500 delay-125" d="M19.9,46.98c0,0,18.8-18.85,29.95-29.95C68.89-1.92,66,38.78,50,38.78c-8,0-30,0-30,0" style="
                            stroke-dasharray: 30px, 88.1px;
                            stroke-dashoffset: -88px;
                        "></path>
                                    </svg>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- NAV MOBILE -->
            <div>
                <!-- <div class="absolute nav-modal top-0 right-0 left-0 bottom-0 w-screen bg-white z-10 opacity-75 "></div> -->
                <div class="nav-mobile top-0 absolute h-screen w-screen z-20 hidden">
                    <div class="flex flex-col gap-8 text-primary font-bold h-screen mx-auto text-5xl justify-center items-center">
                        <p class="text-lg">Menu</p>
                        <a href="index.php">Trang chủ</a>
                        <a href="index.php?pg=product">Sản phẩm</a>
                        <a href="index.php?pg=contact">Liên hệ</a>
                        <a href="index.php?pg=about">Giới thiệu</a>
                        <a href="index.php?pg=blog">Tin tức</a>
                    </div>
                </div>
            </div>

            <!-- MODAL SEARCH -->
            <div>
                                <div class="hidden modal-search fixed top-0 left-0 h-screen w-full bg-primary z-40 opacity-25"></div>
                                <div class="hidden search-box fixed top-0 left-0 right-0 h-3/4 bg-white z-40 text-center">
                                    <div class="w-3/4 mx-auto">
                                        <div>
                                            <div class="relative mt-12 ">
                                            <span class="text-h1 font-bold text-center ">Bạn đang tìm gì ?</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class=" absolute top-0 right-24 close-search text-primary hover:scale-125 delay-75 h-5 w-5 cursor-pointer duration-150">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </div>


                                                <div class="model mt-2 border-2 border-primary w-2/4 text-left mx-auto py-2 px-6 rounded-full">
                                                    <form class="flex justify-between" action="index.php?pg=product" method="post">
                                                        <input class="w-full" type="text" name="kyw" id="" placeholder="Nhập sản phẩm muốn tìm kiếm">
                                                        <button class="InputSearch ml-auto" type="submit" name="timkiem">
                                                            <ion-icon name="search-outline" class="site-link_search group-hover:text-white transition duration-300"></ion-icon>
                                                        </button>
                                                        <!-- <input class="InputSearch" type="submit" name="timkiem" value="Tìm kiếm"> -->
                                                    </form>
                                                </div>
                                        </div>
                                        <div class="mt-4">
                                            <h1 class="text-left text-h1 font-bold">Sản phẩm nổi bật:</h1>
                                            <div class="grid grid-cols-6 mt-4 gap-4">
                                                <!-- SINGLE PRODUCT HERE -->
                                        <?$html_product_search?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

            <div class="">
                <!-- MODAL CART -->
                <div class="modal-cart fixed top-0 left-0 h-screen w-full bg-primary z-40 opacity-25 hidden"></div>
                <!-- CART NOFICATION -->
                <div data-lenis-prevent-wheel>
                    <div class="w-full lg:w-1/4 fixed top-0 h-screen right-0 bg-white z-50 cart-nofi transition-all duration-500 delay-75 cart-hide">
                        <div class="flex flex-col h-screen">
                            <div class="bg-box px-8 py-4 flex items-center gap-12 text-3xl">
                                Giỏ hàng
                                <div class="text-sm w-fit h-fit py-2 px-4 bg-white rounded-box">
                                    <span class="totalCart-modal">
                                        <?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>

                                    </span>
                                    <span>
                                        Sản phẩm
                                    </span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="close-cart ml-auto text-primary hover:scale-125 delay-75 h-5 w-5 cursor-pointer duration-150">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>

                            <div class="p-8 flex-col flex  relative overflow-y-auto cart-box">
                                <!-- BOX CART HERE -->
                            </div>

                            <div class="bg-box w-full mt-auto px-8 py-12">
                                <div class="flex justify-between  text-xl font-bold">
                                    <h1 class="">Subtotal</h1>
                                    <p class="font-medium total-price"></p>


                                </div>
                                <div class="flex flex-col items-center gap-2 mt-4">
                                    <a href="index.php?pg=cart" class="w-full text-white text-center font-bold text-xl bg-primary rounded-button px-4 py-2">GIỎ
                                        HÀNG</a>
                                    <a href="index.php?pg=checkout" class="w-full text-white text-center font-bold text-xl bg-primary rounded-button px-4 py-2">THANH
                                        TOÁN</a>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


            </div>
        </header>
    </div>