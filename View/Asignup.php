<div id="container">
        <!-- HEAD -->
        <div class="head flex justify-between items-center absolute w-full px-24 mt-8">
            <div class="flex">
                <i class='bx bx-chevron-left'></i>
                <img class="ml-4" src="./View/layout/assets/img/logo.png" alt="">
            </div>

            <div class="flex justify-between items-center gap-12">
                <p class="text-sm font-bold">Đã có tài khoản?</p>
                <a href="index.php?pg=signin" class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300" style="background-color: #FF497c;">Đăng nhập ngay</a>
            </div>
        </div>

        <div class="flex justify-between">
            <!-- LEFT COL -->
            <div class="left w-1/2">
                <div class="img" style="width: 460px; height: 775px;">
                    <img class="h-screen w-full object-cover" src="./Uploads/bg-image-10.jpg" alt="">
                </div>
            </div>

            <!-- SIGNUP FORM -->
            <div class="right w-1/2 flex items-center">
                <div class="w-2/4">
                    <h1 class="text-4xl font-bold">Đăng kí</h1>
                    <!-- FORM HERE -->
                    <form action="index.php?pg=adduser" method="post" onsubmit="return validateFormSignUp(event)">

                        <!-- USERNAME -->
                        <div class="mt-10">
                            <label for="username">Tên đăng nhập</label> <br>
                            <input class="w-full border px-6 py-4 rounded-md mt-2" type="text" id="username" name="username" placeholder="admin123" style="border: 1px solid #ccd3d8;">
                            <p class="text-red-600 text-sm" id="username-error"></p> <!-- Display error message here -->
                        </div>

                        <!-- EMAIL -->
                        <div class="mt-6">
                            <label for="email">Email</label> <br>
                            <input class="w-full border px-6 py-4 rounded-md mt-2" type="email" id="email" name="email" placeholder="etrade@gmail.com" style="border: 1px solid #ccd3d8;">
                            <p class="text-red-600 text-sm" id="email-error"></p> <!-- Display error message here -->
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
                            <input type="submit" name="dangky" class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300" style="background-color: #4676e8;" 
                            value="Tạo tài khoản">
                        </div>
                    </form>

                    
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