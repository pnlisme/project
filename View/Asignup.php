<div id="toast-container" class="z-50 fixed top-0 right-0 p-4 mb-4 mr-4  text-white rounded">
    <!-- Toast message will appear here -->
</div>
<div id="container">
    <!-- HEAD -->
    <div class="head flex justify-between items-center absolute w-full px-24 mt-6">
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
                <img class="h-screen w-full object-cover" src="./Uploads/bg-image-10.jpg" alt="">
            </div>
        </div>

        <!-- SIGNUP FORM -->
        <div class="right w-1/2 flex items-center">
            <div class="w-2/4">
                <h1 class="text-4xl font-bold">Đăng kí</h1>
                <!-- FORM HERE -->
                <form class="mt-8 flex flex-col " action="index.php?pg=adduser" method="post"
                    onsubmit="return validateFormm()">
                    <label class="pb-4" for="username"><span class="text-lg">Tên đăng nhập</span>
                        <input class="input-field w-full border px-6 py-4 rounded-md mt-2 border-gray " type="text"
                            id="username" name="username" placeholder="Tên đăng nhập" />
                    </label>
                    <label class="pb-4" for="email"><span class="text-lg">Email</span>
                        <input class="input-field w-full border px-6 py-4 rounded-md mt-2 border-gray " type="email"
                            id="email" name="email" placeholder="Email" required />
                    </label>
                    <label class="pb-4" for="password"><span class="text-lg">Mật khẩu</span>
                        <div
                            class=" border-gray input-field w-full border px-6 py-4 rounded-md mt-2 flex justify-between">
                            <input type="password" name="passworddemo" placeholder="Password" id="passwordInput"
                                required />
                            <ion-icon name="eye-outline" id="togglePassword" class="text-xl text-gray"></ion-icon>
                        </div>
                    </label>
                    <label class="pb-4 pb-4" for="ForgotPassword"><span class="text-lg">Nhập lại
                            mật khẩu</span>
                        <div
                            class=" border-gray input-field w-full border px-6 py-4 rounded-md mt-2 flex justify-between">
                            <input type="password" name="ForgotPassword" placeholder="Nhập lại mật khẩu"
                                id="forgotPasswordInput" />
                            <ion-icon name="eye-outline" id="togglePassword" class="text-xl text-gray"></ion-icon>
                        </div>
                    </label>
                    <div class="flex justify-between items-center mt-8">
                        <input type="submit" name="dangky"
                            class="px-8 py-4 rounded-md text-white font-bold transform hover:scale-110 transition duration-300"
                            style="background-color: #4676e8;" value="Đăng ký">
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>


<script>
// CHECK FORM
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

function validateFormm() {
    var passworddemo = document.getElementById("passwordInput").value;
    var forgotPassword = document.getElementById("forgotPasswordInput").value;

    // Check if passwords match
    if (passworddemo !== forgotPassword) {
        showToast("Mật khẩu không khớp ", 'bg-red-500');
        return false;
    }

    // Password strength validation using regular expression
    var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if (!passwordRegex.test(passworddemo)) {
        showToast("Mật khẩu không được mạnh", 'bg-red-500');
        return false;
    }

    return true;
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