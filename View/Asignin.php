<div id="container">
    <!-- HEAD -->
    <div class="head flex justify-between items-center absolute w-full px-24 mt-8">
        <a href="index.php"><img class="ml-4" src="./View/layout/assets/img/logo.png" alt=""></a>
        <div class="flex justify-between items-center gap-12">
            <p class="text-sm font-bold">Chưa có tài khoản?</p>
            <a href="index.php?pg=signup"
                class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300"
                style="background-color: #FF497c;">Đăng kí ngay</a>
        </div>
    </div>

    <div class="flex justify-between">
        <!-- LEFT COL -->
        <div class="left w-1/2">
            <div class="img" style="width: 460px; height: 775px;">
                <img class="h-screen w-full object-cover" src="Uploads/bg-image-9.JPG" alt="">
            </div>
        </div>

        <!-- SIGNIN FORM -->
        <div class="right w-1/2 flex items-center">
            <div class="w-2/4">
                <h1 class="text-4xl font-bold">Đăng nhập</h1>
                <?php if (isset($_SESSION['reset_password_success']) && ($_SESSION['reset_password_success'] != "")) {
                echo '<p class="text-green-500">' . $_SESSION['reset_password_success'] . '</p>';
                unset($_SESSION['reset_password_success']);
                }
                ?>
                <form action="index.php?pg=dangnhap" method="POST" onsubmit="return validateFormSignIn(event)">
                    <h2 class="text-red-600 text-sm">

                        <?php
                            if (isset($_SESSION['tb_dangnhap']) && ($_SESSION['tb_dangnhap'] != "")) {
                                echo $_SESSION['tb_dangnhap']; 
                                unset($_SESSION['tb_dangnhap']);
                            } 
                        ?>
                    </h2>

                    <!-- USERNAME -->
                    <div class="mt-10">
                        <label for="username">Tên đăng nhập</label> <br>

                        <input class="w-full border px-6 py-4 rounded-md mt-2" type="text" id="username" name="username"
                            placeholder="admin123" style="border: 1px solid #ccd3d8;">
                        <p class="text-red-600 text-sm" id="username-error"></p> <!-- Display error message here -->
                        
                    </div>

                    <!-- MẬT KHẨU -->
                    <div class="mt-6">
                        <label for="password">Mật khẩu</label> <br>
                        <div class="w-full px-6 py-4 rounded-md mt-2 flex justify-between items-center" style="border: 1px solid #ccd3d8;">
                            <input class="w-full" type="password" name="password" id="passwordInput" placeholder="****" style="border: none;">
                            <!-- <i class="fa-regular fa-eye-slash"></i> -->
                        </div>
                        <p class="text-red-600 text-sm" id="password-error"></p> <!-- Display error message here -->
                    </div>

                    <div class="flex justify-between items-center mt-8">

                        <input type="submit" name="login"
                            class="cursor-pointer px-8 py-4 rounded-md text-white font-bold px-8 text-white text-center transform hover:scale-110 transition duration-300"
                            style="background-color: #4676e8;" value="Đăng nhập">
                        <a style="font-size: 14px; color: #4676e8;" href="index.php?pg=forgetPass">Quên mật khẩu?</a>
                    </div>
                </form>
                

            </div>
        </div>
    </div>
</div>
</div>

<script>
// ẨN HEADER
var hideHeader = <?php echo isset($hideHeader) && $hideHeader ? 'true' : 'false'; ?>;
if (hideHeader) {
    document.addEventListener('DOMContentLoaded', function() {
        var header = document.getElementById('container-header');
        if (header) {
            header.style.display = 'none';
        }
    });
}

// ẨN FOOTER
var hideFooter = <?php echo isset($hideFooter) && $hideFooter ? 'true' : 'false'; ?>;
if (hideFooter) {
    document.addEventListener('DOMContentLoaded', function() {
        var footer = document.getElementById('container-footer');
        if (footer) {
            footer.style.display = 'none';
        }
    });
}
</script>