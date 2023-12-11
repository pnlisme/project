<section class="my-16">
    <div class="bg-primary">
        <div class="container py-4 flex justify-between items-center">
            <div>
                <!-- UPPER -->
                <div class="flex text-gray-400">
                    <a class="mr-4 text-grey-500 relative after:content-[''] after:absolute after:top-1/4 after:-right-2 after:w-px after:px-px after:h-4 after:bg-gray-500 after:block"
                        href="#">Home</a>
                    <p class="text-white"> Home</p>
                </div>
                <!-- LOWER -->
                <div>
                    <h1 class="text-h1 text-white font-bold">Signin</h1>
                </div>
            </div>
            <!-- IMG -->
            <div class="w-2/12">
                <img src="/layout/assets/img/cucShit.png" alt="">
            </div>
        </div>
    </div>
</section>



<div>
    <div>
        <div class="container grid grid-cols-2 bg-detail">
            <div class="flex items-center justify-center p-16">
                <form class="h-fit w-fit" action="index.php?pg=dangnhap" method="POST">
                    <div
                        class="py-12 px-16 h-fit w-fit flex flex-col gap-2 bg-detail border rounded-lg border-white shadow-primary">
                        <div class="images">
                            <img class="w-6/12" src="/layout/assets/img/logo.png" alt="" />
                        </div>
                        <h2 class="text-red-600">
                            <?php
                                if (isset($_SESSION['tb_dangnhap']) && ($_SESSION['tb_dangnhap'] != "")) {
                                echo $_SESSION['tb_dangnhap']; 
                                unset($_SESSION['tb_dangnhap']);
                                } 
                            ?>
                        </h2>
                        <h1 class="text-h1 color-primary font-bold">ĐĂNG NHẬP</h1>
                        <label class="flex flex-col gap-2" for="email">
                            <span class="text-small">Email</span>
                            <input
                                class="bg-white w-80 border border-slate-300 rounded-md py-2 pl-6 pr-6 shadow-sm .focus:outline-none.focus:border-sky-500.focus:ring-sky-500.focus:ring-1.sm:text-sm"
                                type="email" id="email" name="email" placeholder="Tên đăng nhập" required />
                        </label>
                        <label class="flex flex-col gap-2" for="password">
                            <span class="text-small">Mật khẩu</span>
                            <div
                                class="input-field bg-white w-80 border border-slate-300 rounded-md py-2 pl-6 pr-6 shadow-sm flex items-center justify-between">
                                <input type="password" name="password" id="passwordInput" placeholder="Password"
                                    required />
                                <ion-icon name="eye-outline" id="togglePassword"></ion-icon>
                            </div>
                        </label>
                        <a class="text-span pb-4" href="index.php?pg=forgotpass">Quên mật khẩu?</a>
                        <input type="submit" name="login"
                            class="bg-primary py-2 rounded-lg font-bold w-100 inline-block px-8 text-white text-center transition duration border-hover hover:bg-detail hover:text-primary"
                            value="Đăng nhập">

                        <a href="index.php?pg=signup" class="text-center mt-2 text-sky-600">Đăng kí</a>
                        <span class="text-span font-normal text-primary text-center pt-2">or continue with</span>
                        <div class="social grid grid-cols-3 gap-2">
                            <a class="social-item rounded-full bg-white flex items-center justify-center" href="#">
                                <img class="p-2" src="./Uploads/google.svg" alt="Google" />
                            </a>
                            <a class="social-item rounded-full bg-white flex items-center justify-center" href="#">
                                <img class="p-2" src="./Uploads/github.svg" alt="GitHub" />
                            </a>
                            <a class="social-item rounded-full bg-white flex items-center justify-center" href="#">
                                <img class="p-2" src="./Uploads/facebook.svg" alt="Facebook" />
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex items-center justify-center">
                <div class="images">
                    <div class="images-item"><img src="./Uploads/thaytu.png" alt="alt" /></div>
                </div>
            </div>
        </div>
    </div>
</div>