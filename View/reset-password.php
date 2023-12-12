<?php
// reset-password.php

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $reset_token = hash("sha256", $token);
    $user_token = get_reset_token($reset_token);
    // echo var_dump($reset_token);
    if (!is_array($user_token) || empty($user_token)) {
        die("Token not found");
    }
    
    if (strtotime($user_token["reset_token_ex"]) <= time()) {
        die("Token has expired");
    }
    
    // Đoạn mã xử lý việc đặt lại mật khẩu sẽ được thêm ở đây
    // echo "Token is valid and hasn't expired. Add password reset logic here.";
} else {
    // Nếu không có tham số token, hiển thị thông báo hoặc chuyển hướng người dùng
    die("Token not provided");
}
?>
<div id="toast-container" class="fixed top-0 right-0 p-4 mb-4 mr-4  text-white rounded">
    <!-- Toast message will appear here -->
</div>
<div id="container">
    <!-- HEAD -->
    <div class="head flex justify-between items-center absolute w-full px-24 mt-8">
        <img class="ml-4" src="./View/layout/assets/img/logo.png" alt="">

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
                <h1 class="text-4xl font-bold">Nhập lại mật khẩu</h1>
                <p class="text-sm mt-6 leading-6 opacity-50 tracking-2">Nhập mật khẩu tôi sẽ giúp bạn thay đổi</p>
                <form action="index.php?pg=process-reset-password" method="post" onclick="return validateForm()">
                    <input type="hidden" name="token" value="<?=htmlspecialchars($token)?>">

                    <label class="mt-8" for="password"><span class="text-small">Mật khẩu</span>
                        <div class="input-field w-full border px-6 py-4 rounded-md mt-2 flex justify-between">
                            <input type="password" name="password" placeholder="Password" id="passwordInput" required />
                            <ion-icon name="eye-outline" id="togglePassword" class="text-gray text-xl"></ion-icon>
                        </div>
                    </label>
                    <label class=" mt-8" for="ForgotPassword"><span class="text-small">Nhập lại
                            mật khẩu</span>
                        <div class="input-field w-full border px-6 py-4 rounded-md mt-2 flex justify-between">
                            <input type="password" name="password-confirm" placeholder="Nhập lại mật khẩu"
                                id="password-confirm" />
                            <ion-icon name="eye-outline" id="togglePassword" class="text-gray text-xl">
                            </ion-icon>
                        </div>
                    </label>
                    <div class="flex justify-between items-center mt-8">
                        <input type="submit" name="dangky"
                            class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300"
                            style="background-color: #4676e8;" value="Xác nhận">
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
//toast mess
function showToast(message, bgColor = 'bg-blue-500') {
    var toastContainer = document.getElementById('toast-container');
    var toastMessage = document.createElement('div');
    toastMessage.className =
        `flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 ${bgColor} rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 toast`;
    toastMessage.id = 'toast-danger';
    toastMessage.role = 'alert';

    // Inner HTML for the toast message
    toastMessage.innerHTML = `
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">${message}</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    `;

    // Append the toast message to the container
    toastContainer.appendChild(toastMessage);

    // Automatically remove the toast after a few seconds (adjust as needed)
    setTimeout(function() {
        toastMessage.remove();
    }, 3000);
}

function validateForm() {
    var passworddemo = document.getElementById("passwordInput").value;
    var confirmPassword = document.getElementById("password-confirm").value;
    console.log(confirmPassword)
    if (passworddemo !== confirmPassword) {
        showToast("Mật khẩu không khớp hoặc yếu", 'bg-red-500');
        return false;
    }

    return true;
}
</script>