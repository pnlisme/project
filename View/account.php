<?php
function displayProfileImage($userImage)
{
    if (!empty($userImage)) {
        echo '<img class="rounded-full" src="' . $userImage . '" alt="User Image" />';
    } else {
        echo '<img class="rounded-full" src="./Uploads/noimg.jpg" alt="No Image" />';
    }
}

if (isset($_SESSION['s_user']) && count($_SESSION['s_user']) > 0) {
    extract($_SESSION['s_user']);
    $user_img = isset($user_img) ? $user_img : '';
    if ($user_img != "") {
        $user_img = PATH_IMG . $user_img;
    }
}
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
<section class="container pb-40">
    <div class="profile flex flex-col gap-1">
        <div class="profile-img rounded-full w-24"><?php displayProfileImage($user_img); ?>
        </div>
        <p class="profile-title text-third font-bold">Xin chào <?=$username?></p><span
            class="text-gray font-bold">eTrade Member
            Since Sep <?=$date?></span>
    </div>
    <div class="grid grid-flow-row-dense grid-cols-8 gap-10 pt-5">
        <div class="navbar col-span-2 bg-primary rounded-xl">
            <navbar>
                <ul class="p-5 flex flex-col gap-3">
                    <li
                        class="group list-none flex items-center gap-5 py-3 px-6 rounded-lg transition duration hover:bg-white">
                        <ion-icon class="text-white text-lg group-hover:text-primary" name="grid"></ion-icon><a
                            class="text-white text-xs fw-500 group-hover:text-primary" href="">Dashboad</a>
                    </li>
                    <li
                        class="group list-none flex items-center gap-5 py-3 px-6 rounded-lg transition duration hover:bg-white">
                        <ion-icon class="text-white text-lg group-hover:text-primary" name="cart"></ion-icon><a
                            class="text-white text-xs fw-500 group-hover:text-primary" href="">Order</a>
                    </li>
                    <li
                        class="group list-none flex items-center gap-5 py-3 px-6 rounded-lg transition duration hover:bg-white">
                        <ion-icon class="text-white text-lg group-hover:text-primary" name="home"></ion-icon><a
                            class="text-white text-xs fw-500 group-hover:text-primary" href="">Addresses</a>
                    </li>
                    <li class="list-none flex items-center gap-5 py-3 px-6 bg-white rounded-lg">
                        <ion-icon class="text-primary text-lg" name="person"></ion-icon><a
                            class="text-primary text-xs fw-500" href="">Account Details</a>
                    </li>
                    <li
                        class="group list-none flex items-center gap-5 py-3 px-6 rounded-lg transition duration hover:bg-white">
                        <ion-icon class="text-white text-lg group-hover:text-primary" name="log-out"></ion-icon><a
                            class="text-white text-xs fw-500 group-hover:text-primary" href="">Logout</a>
                    </li>
                </ul>
            </navbar>
        </div>
        <form class="col-span-6 flex flex-col gap-8" action="index.php?pg=updateUser" method="post">
            <div class="grid grid-cols-2 gap-8">
                <label class="flex relative flex-col">
                    <span class="pb-2">Họ và tên</span>
                    <input
                        class="w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary"
                        type="text" name="fullname" value="<?=$full_name?>" />

                </label>
                <label class="flex relative  flex-col pb-2">
                    <span class="pb-2">Số điện thoại</span>
                    <input
                        class="w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary"
                        type="text" name="phone" value="<?=$phone?>" />
                </label>
                <label class="flex relative flex-col">
                    <span class="pb-2">Email</span>
                    <input
                        class="w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary"
                        type="text" name="email" value="<?=$email?>" />
                </label>
                <label class="flex relative flex-col">
                    <span class="pb-2">Mật khẩu</span>
                    <input
                        class="w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary"
                        type="password" name="password" value="<?=$password?>" />
                </label>
            </div>
            <label class="flex relative flex-col">
                <span class="pb-2">Địa chỉ</span>
                <input
                    class="pass-new w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary"
                    type="text" name="address" value="<?=$address?>" />
            </label>
            <!-- <label class="flex">
                <select
                    class="w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary">
                    <option value="1">VietNam </option>
                    <option value="1">USA</option>
                </select> -->
            </label><span class="text-gray">Đây sẽ là cách tên của bạn sẽ được hiển thị trong phần tài khoản và trong
                đánh giá</span>
            <p class="text-third font-bold">Thay đổi mật khẩu</p>
            <label class="flex relative flex-col">
                <span class="pb-2">Thay đổi mật khẩu</span>
                <input
                    class="pass-new w-full text-sm bg-white rounded-lg border-gray border-opacity-50 py-3 px-3 outline-none border-2 transition duration-200 focus:border-blue-500 focus:text-primary"
                    type="password" name="updatepassword" value="<?=$password?>" />
            </label>
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="submit" name="updateAccount"
                class="bg-primary py-2 rounded-lg font-bold w-36 inline-block px-8 text-white text-center transition duration motion-safe:hover:scale-110"
                value="Cập nhật">
        </form>
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