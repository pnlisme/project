<?php
$uniqueCategories = [];
foreach ($dsdm as $dm) {
    extract($dm);
    $uniqueCategories[$category_name] = true;
}

$uniqueBrands = [];
foreach ($dsbrand as $brand) {
    extract($brand);
    $uniqueBrands[$brand_name] = true;
}

$html_dm = '<option value="">All Categories</option>';
foreach (array_keys($uniqueCategories) as $category) {
    $html_dm .= '<option class="product-checkk" id="category" value="' . $category . '">' . $category . '</option>';
}

$html_brand = '<option value="">All Brands</option>';
foreach (array_keys($uniqueBrands) as $brand) {
    $html_brand .= '<option class="product-checkk" id="brand" value="' . $brand . '">' . $brand . '</option>';
}

$html_dssp = show_product($dssp);
if ($titlepage!="")  $title=$titlepage;
else $title='Tất cả sản phẩm'

?>

<!-- BREADCRUMB -->
<section class="my-16">
    <div class="bg-primary">
        <div class="container py-4 flex justify-between items-center">
            <div>
                <!-- UPPER -->
                <div class="flex text-gray-400">
                    <a class="mr-4 text-grey-500 relative after:content-[''] after:absolute after:top-1/4 after:-right-2 after:w-px after:px-px after:h-4 after:bg-gray-500 after:block"
                        href="#">Home</a>
                    <p class="text-white">Shop</p>
                </div>
                <!-- LOWER -->
                <div>
                    <h1 class="text-h1 text-white font-bold mt-2">Explore All Products</h1>
                </div>
            </div>
            <!-- IMG -->
            <div class="w-2/12">
                <img src="./Uploads/cucShit.png" alt="">
            </div>
        </div>
    </div>
</section>

<!-- CONTENT -->
<div class="container shop-content p-4 lg:p-0">
    <div class="content-inner">
        <!-- FILTER -->
        <div class="filter-container lg:flex lg:justify-between lg:items-center">
            <div class="letf-filter sm:flex sm:justify-between sm:items-center sm:gap-4 sm:mb-4 lg:mb-0 lg:w-2/4">
                <!-- SELECT OPTIONS -->

                <div class="  select-container w-full mb-4 lg:mb-0">

                    <select class="select-box border-2 border-primary w-full rounded-box w-1/2">
                        <?=$html_dm?>
                    </select>

                    <div class="icon-container">
                        <i class='bx bx-chevron-down'></i>
                    </div>
                </div>
                <!-- SELECT OPTIONS -->
                <div class="select-container w-full">
                    <select class="select-box border-2 border-primary w-full rounded-box">
                        <?=$html_brand?>
                    </select>

                    <div class="icon-container">
                        <i class='bx bx-chevron-down'></i>
                    </div>
                </div>
                <!-- SELECT OPTIONS -->
                <!-- <div class="select-container w-full mt-4 sm:mt-0">
                    <select class="select-box">
                        <option value="">Price Range</option>
                        <option value="">Macbook</option>
                        <option value="">Iphone</option>
                        <option value="">Keyboard</option>
                        <option value="">Headphone</option>
                    </select>

                    <div class="icon-container">
                        <i class='bx bx-chevron-down'></i>
                    </div>
                </div> -->
            </div>

            <!-- SELECT OPTIONS RIGHT COL-->
            <!-- <div class="select-container w-full mt-4 sm:mt-0 lg:w-1/5">
                <select class="select-box">
                    <option value="">Sort by Latest</option>
                    <option value="">Macbook</option>
                    <option value="">Iphone</option>
                    <option value="">Keyboard</option>
                    <option value="">Headphone</option>
                </select>

                <div class="icon-container">
                    <i class='bx bx-chevron-down'></i>
                </div>
            </div> -->
        </div>

        <h3 class="text-center text-lg pt-5 font-semibold" id="change-text"><?=$title?></h3>
        <!-- PRODUCT ROW -->
        <!-- <div class="container loading flex-center">
            <img src="./Uploads/Loading.gif" alt="" id="loader" style="display: none;">
        </div> -->

        <div class="grid grid-cols sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-12 relative" id="result_filter">

            <?=$html_dssp?>
        </div>


    </div>

</div>

<!-- BANNER -->
<section class="mt-24">
      <div class="container banner-container p-16">
        <div>
          <!-- UPPER -->
          <div class="text-white flex items-center gap-3 font-bold">
            <div
              class="w-12 rounded-full flex items-center justify-center h-12 bg-primary text-white"
            >
              <i class="fa-solid fa-envelope text-xl"></i>
            </div>
            <p>Newsletter</p>
          </div>
          <h1 class="text-primary md:text-h1 font-bold text-xl my-8">
            Get weekly update
          </h1>

          <!-- LOWER -->
          <div class="mt-4 flex flex-col items-center md:flex-row gap-2">
            <div
              class="flex gap-3 bg-white w-full md:w-fit px-4 py-3 rounded-button"
            >
              <i class="fa-solid fa-envelope text-xl mt-1"></i>
              <input type="text" placeholder="example@gmail.com" />
            </div>
            <div
              class="w-full text-center md:w-fit px-6 py-4 bg-primary text-white rounded-button"
            >
              Subcribe
            </div>
          </div>
        </div>
      </div>
    </section>