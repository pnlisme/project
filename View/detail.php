<?php
// extract($product_detail);
if ($img != "") $img = PATH_IMG . $img;
if ($img_1 != "") $img_1 = PATH_IMG . $img_1;
if ($img_2 != "") $img_2 = PATH_IMG . $img_2;
if ($img_3 != "") $img_3 = PATH_IMG . $img_3;
if ($img_4 != "") $img_4= PATH_IMG . $img_4;
$display_price = (
    isset($product_detail['price_sale']) &&
    $product_detail['price_sale'] !== null &&
    (float)$product_detail['price_sale'] !== 0.00
) ? $product_detail['price_sale'] : $product_detail['price'];
$html_product_relate = show_product($product_relate);
?>

<section>
    <div class="bg-detail -translate-y-36 relative -z-20 py-56">
        <div class="container flex items-center gap-2">
            <!-- INFOR -->
            <div class="w-1/4">
                <h1><?=$brand_name?></h1>
                <h1 class="text-h1 my-8 font-bold"><?=$name?></h1>
                <p class="">
                    <?=$des?>
                </p>
            </div>
            <!-- IMG -->
            <div class="relative w-1/2 flex justify-center items-center flex-col b">
                <div class="rounded-lg">
                    <img src="<?=$img?>" alt="">
                </div>
                <div class="flex gap-4 w-3/5 mt-8 absolute -bottom-32">
                    <div>
                        <img src="<?=$img_1?>" alt="">
                    </div>

                    <div>
                        <img src="<?=$img_2?>" alt="">
                    </div>

                    <div>
                        <img src="<?=$img_3?>" alt="">
                    </div>
                    <div>
                        <img src="<?=$img_4?>" alt="">
                    </div>
                </div>

            </div>
            <!-- BUY OR WHAT -->
            <div>
                <!-- REVIEW -->
                <!-- <div class="flex">
                    <div>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="text-customGray">
                        (82 Review)
                    </div>
                </div> -->
                <!-- VIEW -->
                <div class="mt-2">
                    <ion-icon name="eye-outline" class="mr-1"></ion-icon>
                    <span class="text-customGray"><?=$view?> View</span>
                </div>
                <div class="flex flex-col">

                    <h1 class="font-bold mt-2 mb-4 text-h2"><?=number_format($display_price)?> VNĐ</h1>
                </div>
                <!-- BUTTON -->
                <div class="flex gap-1">
                    <div class="px-4 py-2 bg-primary rounded-button flex items-center">
                        <i class="fa-solid fa-heart text-white"></i>
                    </div>
                    <div class="px-6 py-2 bg-primary font-bold text-white rounded-button text-center">BUY NOW</div>
                    <div class="px-4 py-2 bg-primary rounded-button">
                        <ion-icon name="cart-outline" class="text-2xl text-white flex items-center"></ion-icon>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<!-- BOX COMMENT -->
<section>
        <div>
            <div class="container">
                <h1 class="text-h3 font-bold mb-4">Đánh giá sản phẩm</h1>

                <!-- HEAD COMMENT -->
                <div class="flex justify-between items-center py-6 px-6 rounded-md" style="background-color: #f7f7f7;">
                    <div class="flex justify-between items-center gap-4">
                        <div class="star-container flex gap-1">
                            <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                            <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                            <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                            <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                            <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                        </div>
                        <p>Based on 2 reviews</p>
                    </div>

                    <button class="review-button bg-primary text-white text-sm font-semibold px-8 py-2 rounded-md transform hover:scale-110 transition duration-300">Đánh giá ngay</button>
                </div>

                <div class="cmt">
                    <iframe src="comment.php?idsp=<?=$_GET['id']?>" width="100%" height="400px" frameborder="0"></iframe>
                </div>

                <!-- WRITE A REVIEW -->
                <div class="write-review-section">
                    <h2 class="text-lg font-bold my-4">Viết đánh giá</h2>

                    <iframe src="comment.php?" frameborder="0"></iframe>

                    
                
                    <form action="" method="POST">
                        <div>
                            <label for="">Rating</label>
                            <div class="star-container flex gap-1 mb-4 mt-2">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                            </div>
                        </div>

                        <div class="mt-8">
                            <label for="">Đánh giá</label> <br>
                            <textarea class="w-full border mt-2 px-4 py-4" name="" id="" cols="30" rows="10" placeholder="Nội dung đánh giá"></textarea>
                        </div>
                    </form>
                </div>

                <!-- BODY COMMENT -->
                <div>
                    <div class="flex gap-2 mt-6 pb-4" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                        <div class="w-8 h-8 rounded-full bg-blue-500"></div>

                        <div class="">
                            <div class="flex items-center gap-4">
                                <p class="font-bold">Anh Tèo Non</p>
                                <p class="text-sm color-777">9/12/2023</p>
                            </div>

                            <div class="star-container flex gap-1 mb-4 mt-1">
                                <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                            </div>

                            <p>Hàng dỏm đừng có mua!</p>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-6 pb-4" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                        <div class="w-8 h-8 rounded-full bg-blue-500"></div>

                        <div class="">
                            <div class="flex items-center gap-4">
                                <p class="font-bold">Chị thuồn luồn</p>
                                <p class="text-sm color-777">9/12/2023</p>
                            </div>

                            <div class="star-container flex gap-1 mb-4 mt-1">
                                <img class="w-4" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                                <img class="w-4 grayscale" src="./View/layout/assets/img/newstar.png" alt="">
                            </div>

                            <p>Sản phẩm cùi bắp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="mt-32">
    <div>
        <div class="container flex flex-col">
            <div class="flex gap-2 items-center ml-4 md:ml-0 pb-4">
                <div class="h-12 w-12 bg-primary rounded-full text-white grid place-content-center">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <h2 class="text-h3 font-bold my-4 ml-4 md:ml-0 ">Sản phẩm liên quan</h2>

            </div>

            <div class="p-4 lg:p-0 grid grid-cols-2  xl:grid-cols-4 gap-4 ">
                <!-- SINGLE PRODUCT -->
                <?=$html_product_relate?>
            </div>

        </div>
</section>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy phần tử chứa phần WRITE A REVIEW
            const reviewSection = document.querySelector('.write-review-section');

            // Lấy nút Đánh giá ngay
            const reviewButton = document.querySelector('.review-button');

            // Thêm sự kiện click cho nút
            reviewButton.addEventListener('click', function () {
                // Toggle lớp 'hidden' cho phần tử chứa phần WRITE A REVIEW
                reviewSection.classList.toggle('hidden');
            });
        });
    </script>