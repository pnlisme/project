<div id="container">
        <!-- HEAD -->
        <div class="head flex justify-between items-center absolute w-full px-24 mt-8">
            <img class="ml-4" src="./View/layout/assets/img/logo.png" alt="">

            <div class="flex justify-between items-center gap-12">
                <p class="text-sm font-bold">Đã có tài khoản?</p>
                <a href="index.php?pg=signin" class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300" style="background-color: #FF497c;">Đăng nhập ngay</a>
            </div>
        </div>

        <div class="flex justify-between">
            <!-- LEFT COL -->
            <div class="left w-1/2">
                <div class="img" style="width: 460px; height: 775px;">
                    <img class="h-full w-full object-cover" src="./Uploads/bg-image-10.jpg" alt="">
                </div>
            </div>

            <!-- SIGNUP FORM -->
            <div class="right w-1/2 flex items-center">
                <div class="w-2/4">
                    <h1 class="text-4xl font-bold">Đăng kí</h1>
                    <!-- FORM HERE -->
                    <form action="index.php?pg=adduser" method="post" onsubmit="return validateForm()">
                        <div class="mt-10">
                            <label for="username" class="text-sm">Tên đăng nhập</label> <br>
                            <input class="w-full border px-6 py-4 rounded-md mt-2" type="text" id="username" name="username" placeholder="admin123" style="border: 1px solid #ccd3d8;">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="text-sm">Email</label> <br>
                            <input class="w-full border px-6 py-4 rounded-md mt-2" type="email" id="email" name="email" placeholder="etrade@gmail.com" style="border: 1px solid #ccd3d8;">
                        </div>

                        <div class="mt-4">
                            <label for="ForgotPassword" class="text-sm">Mật khẩu</label> <br>
                            <div class="w-full px-6 py-4 rounded-md mt-2 flex justify-between items-center" style="border: 1px solid #ccd3d8;">
                                <input class="w-full" type="password" name="ForgotPassword" placeholder="****" id="forgotPasswordInput" placeholder="****" style="border: none;"> 
                                <!-- <i class="fa-regular fa-eye-slash"></i> -->
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-8">
                            <input type="submit" name="dangky" class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300" style="background-color: #4676e8;" value="Tạo tài khoản">
                        </div>
                    </form>

                    
                </div>
                
            </div>
        </div>
        
    </div>  


    <script>
        // CHECK FORM
        function validateForm() {
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('forgotPasswordInput').value;

            // Kiểm tra xem các trường có được nhập đầy đủ không
            if (email === '' || password === '') {
                alert('Vui lòng điền đầy đủ thông tin.');
                return false; // Ngăn chặn form được gửi đi nếu có lỗi
            }

            // Các điều kiện kiểm tra khác nếu cần

            return true; // Cho phép form được gửi đi nếu không có lỗi
        }
        
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