<?php 


//product_hot
$html_product_hot = show_product($product_hot);
//product_new
$html_product_new = show_product_new($product_new);
//product_new_secondary
$html_product_new_secondary = show_product_new_secondary($product_new);
// //product_sale
$html_product_sale=show_product($product_sale);
//product_view
$html_product_view=show_product($product_view);
//product_view_secondary
$html_product_view_secondary = show_product_view_secondary($product_view);
$binhluan = binh_luan_select_all();
$binhluan_html = '';

foreach ($binhluan as $key) {
    extract($key);
    if ($img != "") $img = PATH_IMG . $img;
    $binhluan_html.= '
    <div class="swiper-slide">
    <div class="flex flex-col lg:flex-row bg-white mt-8 shadow-2xl rounded-box justify-between">
        <!-- CONTENT -->
        <div class="px-4 py-4 flex flex-col justify-center">
            <p class="w-50 my-4 text-customGray text-sm lg:w-80">
                '.$content.'
            </p>
            <div>
                <h3 class="font-bold text-h2">'.$username.'</h3>
                <span class="text-small text-customGray">'.$date.'</span>
            </div>
        </div>
        <!-- IMG -->

        <div class="bg-white lg:bg-box lg:w-60 w-full">
            <img src="'.$img.'" alt="" />

            <p class="text-center font-bold my-4">'.$name.'</p>
        </div>
    </div>
</div>
    ';
}

?>

<p class="totalPriceEach hidden"></p>
<section class="mt-12">
    <div>
        <div class="">
            <div class="">
                <div class="">
                    <div class="hidden lg:block swiper swiperXL bg-box py-24">
                        <div class="swiper-wrapper mx-auto">
                            <?=$html_product_new?>
                        </div>
                        <div class="swiper-button-prev text-primary"></div>
                        <div class="swiper-button-next text-primary"></div>
                    </div>

                    <div class="lg:hidden block swiper heroSwiper w-full p-8">
                        <div class="swiper-wrapper">
                            <?=$html_product_new_secondary?>
                        </div>
                        <div class="swiper-pagination hero-swiper-pagination"></div>
                    </div>

                    <a hred="#" class="block lg:hidden cursor-pointer border-2 hover:bg-transparent 
                        hover:text-primary hover:border-primary transition 
                        duration-300 px-20 py-4 text-h2 bg-primary text-white 
                        font-bold w-fit rounded-button mx-auto lg:mx-0 block mt-4">SHOP
                        NOW</a>
                </div>

                <div>
                </div>
            </div>

            <!-- RIGHT -->
        </div>
    </div>
</section>


<section class="mt-20">
    <div>
        <div class="container">
            <div class="text-center text-h2">
                Mua sản phẩm theo danh mục
                <h1 class="text-h2 lg:text-h1 font-bold pt-2">BỘ SƯU TẬP CÔNG NGHỆ</h1>
            </div>
            <div
                class="mt-8 xl:grid flex flex-wrap items-center justify-center xl:grid-cols-5 place-items-center gap-12">
                <div class="cate-big h-96 rounded-button w-3/4 lg:w-1/4 xl:w-full cate-laptop flex justify-center py-2">
                    <div class="mb-2 py-4 px-4 rounded-box flex gap-4 bg-box self-end">
                        <h1>Laptop</h1>
                        <span class="text-customGray">12 Items</span>
                    </div>
                </div>

                <div
                    class="cate-small h-96 xl:h-64 w-3/4 lg:w-1/4 xl:w-full rounded-button cate-phone flex justify-center py-2">
                    <div class="mb-2 py-4 px-4 rounded-box flex gap-4 bg-box self-end">
                        <h1>Phone</h1>
                        <span class="text-customGray">12 Items</span>
                    </div>
                </div>
                <div class="cate-big h-96  rounded-box w-3/4 lg:w-1/4 xl:w-full cate-keyboard flex justify-center py-2">
                    <div class="mb-2 py-4 px-4 rounded-box flex gap-4 bg-box self-end">
                        <h1>Keyboard</h1>
                        <span class="text-customGray">12 Items</span>
                    </div>
                </div>
                <div
                    class="cate-small h-96 xl:h-64 rounded-box w-3/4 xl:w-full lg:w-1/4 cate-headphone flex justify-center py-2">
                    <div class="mb-2 py-4 px-4 rounded-box flex gap-4 bg-box self-end">
                        <h1>Headphone</h1>
                        <span class="text-customGray">12 Items</span>
                    </div>
                </div>
                <div class="cate-big h-96 rounded-box  w-3/4 lg:w-1/4 xl:w-full cate-mouse flex justify-center py-2">
                    <div class="mb-2 py-4 px-4 rounded-box flex gap-4 bg-box self-end">
                        <h1>Mouse</h1>
                        <span class="text-customGray">12 Items</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SALE BANNER -->
<section class="mt-56">
    <div>
        <div class="container bg-box rounded-box w-5/6 lg:w-full mx-auto">
            <div
                class="flex flex-col lg:grid lg:grid-cols-12 lg:px-12 py-8 lg:justify-between items-center justify-center">
                <div class=" lg:col-start-1 lg:col-span-4">
                    <!-- ICON -->
                    <div class="flex items-center gap-2 font-medium justify-center lg:justify-start">
                        <div class="h-12 w-12 grid place-content-center bg-primary text-white rounded-full">
                            <i class="fa-solid fa-headphones"></i>
                        </div>
                        <span class="font-bold">Đừng bỏ lỡ !!</span>
                    </div>

                    <h1 class="text-h3 mx-auto lg:mx-0 text-center lg:text-left md:text-h1 font-bold w-4/5  mt-8">
                        Enhance Your Music Experience
                    </h1>
                    <div class="mt-4 flex gap-2 justify-center lg:justify-start	">
                        <div
                            class="bg-white w-14 h-14 lg:w-20 lg:h-20 flex flex-col justify-center items-center rounded-full">
                            <span class="lg:text-h3 font-bold">16</span>
                            <p class="text-sm lg:text-md">Days</p>
                        </div>
                        <div
                            class="bg-white w-14 h-14 lg:w-20 w-14 h-14 lg:h-20 flex flex-col justify-center items-center rounded-full">
                            <span class="lg:text-h3 font-bold">16</span>
                            <p>Days</p>
                        </div>
                        <div
                            class="bg-white w-14 h-14 lg:w-20 w-14 h-14 lg:h-20 flex flex-col justify-center items-center rounded-full">
                            <span class="lg:text-h3 font-bold">16</span>
                            <p>Days</p>
                        </div>
                        <div
                            class="bg-white w-14 h-14 lg:w-20 lg:h-20 flex flex-col justify-center items-center rounded-full">
                            <span class="lg:text-h3 font-bold">16</span>
                            <p>Days</p>
                        </div>
                    </div>

                    <a href="#"
                        class="block w-fit mx-auto lg:mx-0 hover:text-primary hover:bg-transparent hover:border-primary border-2 transition duration-300 px-6 py-4 bg-primary text-white font-bold rounded-button mt-8">CHECK
                        IT OUT</a>
                </div>

                <div class="col-start-8 col-span-5 sale-banner-img-container lg:-mt-44">
                    <div>

                        <img class="sale-banner-img " src="view/layout/assets/img/image-removebg-preview 3.png"
                            alt="" />

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-32">
    <div>
        <div class="container flex flex-col">
            <div class="flex gap-2 items-center ml-4 md:ml-0">
                <div class="h-12 w-12 bg-primary rounded-full text-white grid place-content-center">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <span class="font-bold text-h2 ">Sản phẩm</span>
            </div>
            <h2 class="text-h3 font-bold my-4 ml-4 md:ml-0 ">Nổi bật nhất của Etrade </h2>
            <div class="p-4 lg:p-0 grid grid-cols-2  xl:grid-cols-4 gap-4 ">
                <!-- SINGLE PRODUCT -->
                <?=$html_product_hot?>
            </div>

            <a href="#"
                class="relative group text-white transition duration-300 w-fit block px-6 py-4 hover:text-primary cursor-pointer text-primary font-bold rounded-button mx-auto mt-12 overflow-hidden border-2 border-primary">
                VIEW ALL
                <div
                    class="absolute top-0 left-0 w-32 h-20 bg-primary -z-10 group-hover:bg-transparent transition duration-300">
                </div>
            </a>
        </div>
</section>

<section class="mt-24">
    <div>
        <div class="container bg-box p-12 w-5/6 rounded-box lg:w-full">
            <div class="">
                <!-- TITLE -->
                <div class="flex flex-col gap-4 md:flex-row items-center justify-between">
                    <h1 class="text-xl font-bold text-primary">
                        Happy customer words
                    </h1>
                    <div class="flex gap-3">
                        <i class="fa-solid fa-arrow-left review-slider-prev"></i>
                        <i class="fa-solid fa-arrow-right review-slider-next"></i>
                    </div>
                </div>

                <div class="container swiper mySwiper">
                    <div class="swiper-wrapper">
                        <!-- BOX -->
                            <?=$binhluan_html?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-24">
    <div>
        <div class="container">
            <div class="mx-auto w-fit flex flex-col justify-center items-center mb-4">
                <div class="text-primary flex gap-2 mr-8">
                    <div class="w-8 h-8 bg-primary rounded-full text-white flex items-center justify-center">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    Xem nhiều nhất
                </div>
                <h1 class="font-bold text-xl lg:text-h1 mt-4">Xem Nhiều Nhất Của eTrade</h1>
                <div class="flex lg:hidden gap-3 mt-2">
                    <i class="fa-solid fa-arrow-left review-slider-prev"></i>
                    <i class="fa-solid fa-arrow-right review-slider-next"></i>
                </div>
            </div>

            <div>
                <div class="mt-12 hidden justify-center lg:grid lg:grid-cols-2 xl:grid-cols-4 gap-4">
                    <!-- SINGLE PRODUCT -->
                    <?=$html_product_view?>


                </div>

                <div class="container block lg:hidden swiper mySwiper p-8">
                    <div class="swiper-wrapper">
                        <!-- BOX -->
                        <?=$html_product_view_secondary?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-24">
    <div>
        <div class="container">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 p-4 lg:p-0">
                <div class="relative group overflow-hidden rounded-box ">
                    <div class="group-hover:scale-125 transition duration-300 ">
                        <img class="w-full" src="view/layout/assets/img/banner-1.png" alt="">
                    </div>
                    <div
                        class="text-white absolute bottom-1/2 translate-x-1/2 translate-y-1/2 left-1/4 xl:right-1/4 text-sm md:text-h3 ">
                        Âm thanh phong phú
                        <div
                            class="pt-4 flex items-center gap-2 text-gray hover:gap-4 transition-all duration-300 mt-px text-sm">
                            <p class="text-gray  text-lg">Bộ sưu tập</p>
                            <i class="fa-solid fa-arrow-right text-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="relative group overflow-hidden rounded-box">
                    <div class="group-hover:scale-125 transition duration-300">
                        <img class="w-full" src="view/layout/assets/img/banner-2.png" alt="">
                    </div>
                    <div
                        class="text-white absolute top-1/2 -translate-x-1/2 -translate-y-1/2 left-1/4 text-sm md:text-h3">
                        Âm thanh phong phú
                        <div
                            class="pt-4 flex items-center gap-2 text-gray hover:gap-4 transition-all duration-300 mt-px text-sm">
                            <p class="text-gray  text-lg">Bộ sưu tập</p>
                            <i class="fa-solid fa-arrow-right text-lg"></i>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BANNER -->
<section class="mt-24 p-3 lg:p-0">
    <div class="container banner-container p-16 rounded-box">
        <div>
            <!-- UPPER -->
            <div class="text-white justify-center lg:justify-start flex items-center gap-3 font-bold">
                <div class="w-12 rounded-full flex items-center justify-center h-12 bg-primary text-white">
                    <i class="fa-solid fa-envelope text-xl"></i>
                </div>
                <p class="text-white md:text-primary">Newsletter</p>
            </div>
            <h1 class="text-center lg:text-left text-white md:text-primary md:text-h1 font-bold text-xl my-8">
                Get weekly update
            </h1>

            <!-- LOWER -->
            <div class="mt-4 flex flex-col lg:flex-row gap-2 items-center w-fit mx-auto lg:mx-0">
                <div class="text-sm lg:text-xl flex gap-3 bg-white  lg:w-fit p-4 py-3 rounded-button items-center">
                    <i class="fa-solid fa-envelope text-sm lg:text-xl  mt-1"></i>
                    <input type="text" placeholder="example@gmail.com" />
                </div>
                <div
                    class="hover:bg-transparent hover:text-primary  font-bold cursor-pointer border-2 border-primary transition duration-300 w-full text-center lg:w-fit h-full px-0 md:px-4 py-2 xl:py-3 bg-primary text-white rounded-button">
                    Subcribe
                </div>
            </div>
        </div>
    </div>
</section>