<?php
$html_news_highligh = showNewsHighligh($ds_news_hot);
$html_news_latest  = showNewsLatest($ds_news_lasest);

?>

<section class="my-16">
    <div class="bg-primary">
        <div class="container py-4 flex justify-between items-center">
            <div>
                <!-- UPPER -->
                <div class="flex text-gray-400">
                    <a class="mr-4 text-grey-500 relative after:content-[''] after:absolute after:top-1/4 after:-right-2 after:w-px after:px-px after:h-4 after:bg-gray-500 after:block"
                        href="#">Home</a>
                    <p class="text-white"> Contact</p>
                </div>
                <!-- LOWER -->
                <div>
                    <h1 class="text-h1 text-white font-bold">Account Detail</h1>
                </div>
            </div>
            <!-- IMG -->
            <div class="w-2/12">
                <img src="./Uploads/cucShit.png" alt="">
            </div>
        </div>
    </div>
</section>
<section class="container pb-14">
    <h3 class="text-h1 font-bold text-third pb-8">Highlighted</h3>
    <div class="blog-item grid grid-cols-2 gap-5">
        <?=$html_news_highligh?>
    </div>
</section>
<section class="container">
    <h3 class="text-h1 font-bold text-third pb-8 border-b-2 border-gray">Latest Post</h3>
    <?=$html_news_latest?>
    <div class="news-lists flex items-center gap-4 justify-center py-8">
        <ion-icon class="text-third p-2 bg-slate-200 rounded" name="chevron-back"></ion-icon><span
            class="text-third">1</span><span class="text-third">2</span><span class="text-third">3</span><span
            class="text-third">...</span>
        <ion-icon class="text-third p-2 bg-slate-200 rounded" name="chevron-forward"></ion-icon>
    </div>
</section>
<!-- BANNER-->
<div>
    <div class="container banner-container p-16">
        <div>
            <!-- UPPER-->
            <div class="text-white flex items-center gap-3 font-bold">
                <div class="w-12 rounded-full flex items-center justify-center h-12 bg-primary text-white"><i
                        class="fa-solid fa-envelope text-xl"></i></div>
                <p>Newsletter</p>
            </div>
            <h1 class="text-primary text-h1 font-bold">Get weekly update</h1>
            <!-- LOWER-->
            <div class="mt-4 flex gap-2">
                <div class="flex gap-3 bg-white w-fit px-6 py-3 rounded-button"><i
                        class="fa-solid fa-envelope text-xl"></i>
                    <input type="text" placeholder="example@gmail.com" />
                </div>
                <div class="w-fit px-6 py-4 bg-primary text-white rounded-button">Subcribe</div>
            </div>
        </div>
    </div>
</div>