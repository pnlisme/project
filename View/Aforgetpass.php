<div id="container">
    <!-- HEAD -->
    <div class="head flex justify-between items-center absolute w-full px-24 mt-8">
        <a href="index.php"><img class="ml-4" src="./View/layout/assets/img/logo.png" alt=""></a>

        <div class="flex justify-between items-center gap-12">
            <p class="text-sm font-bold">Đã có tài khoản?</p>
            <a href="index.php?pg=signin"
                class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300"
                style="background-color: #FF497c;">Đăng nhập ngay</a>
        </div>
    </div>

    <div class="flex justify-between">
        <!-- LEFT COL -->
        <div class="left w-1/2">
            <div class="img" style="width: 460px; height: 775px;">
                <img class="h-full w-full object-cover" src="./Uploads/bg-image-10.jpg" alt="">
            </div>
        </div>

        <!-- SIGNIN FORM -->
        <div class="right w-1/2 flex items-center">
            <div class="w-2/4">
                <h1 class="text-4xl font-bold">Quên mật khẩu?</h1>
                <p class="text-sm mt-6 leading-6 opacity-50 tracking-2">Nhập địa chỉ email đã đăng kí. Chúng mình sẽ gửi
                    cho bạn hướng dẫn đặt lại mật khẩu qua email này.</p>
                <form action="index.php?pg=send-password-reset" method="post">
                    <div class="mt-8">
                        <label class="text-sm">Email</label> <br>
                        <input name="email" class="w-full border px-6 py-4 rounded-md mt-2" type="email"
                            placeholder="etrade@gmail.com" style="border: 1px solid #ccd3d8;">
                    </div>


                    <div class="flex justify-between items-center mt-8">
                        <input type="submit" name="resetpass"
                            class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300"
                            style="background-color: #4676e8;" value="Đặt lại mật khẩu">
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