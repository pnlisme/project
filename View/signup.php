<div id="toast-container" class="fixed top-0 right-0 p-4 mb-4 mr-4  text-white rounded">
    <!-- Toast message will appear here -->
</div>
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
<div>
    <div>
        <div class="container grid grid-cols-2 bg-detail">
            <div class="flex items-center justify-center p-16">
                <form class="h-fit w-fit" action="index.php?pg=adduser" method="post" onsubmit="return validateForm()">
                    <div
                        class="py-12 px-16 h-fit w-fit flex flex-col gap-2 bg-detail border rounded-lg border-white shadow-primary">
                        <div class="images"> <img class="w-6/12" src="./Uploads/logo.png" alt="" /></div>
                        <h1 class="text-h1 color-primary font-bold">ĐĂNG KÍ</h1>
                        <label class="flex flex-col gap-2" for="username"><span class="text-small">Tên đăng nhập</span>
                            <input
                                class="bg-white w-80 border border-slate-300 rounded-md py-2 px-3 shadow-sm .focus:outline-none.focus:border-sky-500.focus:ring-sky-500.focus:ring-1.sm:text-sm"
                                type="text" id="username" name="username" placeholder="Tên đăng nhập" />
                        </label>
                        <label class="flex flex-col gap-2" for="email"><span class="text-small">Email</span>
                            <input
                                class="bg-white w-80 border border-slate-300 rounded-md py-2 px-3 shadow-sm .focus:outline-none.focus:border-sky-500.focus:ring-sky-500.focus:ring-1.sm:text-sm"
                                type="email" id="email" name="email" placeholder="Email" required />
                        </label>
                        <label class="flex flex-col gap-2" for="password"><span class="text-small">Mật khẩu</span>
                            <div

                                class="input-field bg-white w-80 border border-slate-300 rounded-md py-2 pl-6 pr-6 shadow-sm flex items-center justify-between">
                                <input type="password" name="passworddemo" placeholder="Password" id="passwordInput"
                                    required />
                                <ion-icon name="eye-outline" id="togglePassword"></ion-icon>
                            </div>
                        </label>
                        <label class="flex flex-col gap-2 pb-4" for="ForgotPassword"><span class="text-small">Nhập lại mật khẩu</span>
                            <div
                                class="input-field bg-white w-80 border border-slate-300 rounded-md py-2 px-3 shadow-sm flex items-center justify-between">
                                <input type="password" name="ForgotPassword" placeholder="Nhập lại mật khẩu"
                                    id="forgotPasswordInput" />
                                <ion-icon name="eye-outline" id="togglePassword"></ion-icon>
                            </div>
                        </label>
                        <input type="submit" name="dangky"
                            class="bg-primary py-2 rounded-lg font-bold w-100 inline-block px-8 text-white text-center transition duration border-hover hover:bg-detail hover:text-primary"
                            value="Đăng ký">
                        <a class="text-center text-sky-600 font-semibold pt-2" href="index.php?pg=signin">Đăng nhập</a>
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
<!-- BANNER-->
<div class="pt-20">
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
                <div class="flex flex-center gap-3 bg-white w-fit px-6 py-3 rounded-button"><i
                        class="fa-solid fa-envelope text-xl"></i>
                    <input type="text" placeholder="example@gmail.com" />
                </div>
                <div class="w-fit px-6 py-4 bg-primary text-white rounded-button">Subcribe</div>
            </div>
        </div>
    </div>
</div>
<script>
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
    var forgotPassword = document.getElementById("forgotPasswordInput").value;

    if (passworddemo !== forgotPassword) {
        showToast("Mật khẩu không khớp hoặc yếu", 'bg-red-500');
        return false;
    }

    return true;
}
</script>