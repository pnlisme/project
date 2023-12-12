// ===== LIST =====
// 1. SMOOTH SCROLL
// 2. NAV HEADER ANIMATION
// 3. FOOTER ANIMATION MOBILE
// 4. CART - CART AJAX
// 5.SLIDE IN CART

// == 1. SMOOTH SCROLL ==
const lenis = new Lenis();

function raf(time) {
  lenis.raf(time);
  requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// == 2. NAV HEADER ==
const navIcon = $(".nav-off");
const pathTop = $("#path-top");
const pathMiddle = $("#path-middle");
const pathBottom = $("#path-bottom");

navIcon.click(function () {
  pathTop.toggleClass("nav-active-top");
  pathMiddle.toggleClass("nav-active-middle");
  pathBottom.toggleClass("nav-active-bottom");
  $("body").toggleClass("overflow-hidden");
  navIcon.toggleClass("nav-off");
  $(".nav-mobile").toggleClass("blurAnimate");
  $(".nav-mobile").toggle("slidein");
  navIcon.removeClass("nav-off");
  navIcon.toggleClass("nav-on");
  navIcon.attr("data-lenis-stop");

  $(this).toggleClass("stop-scroll");
  if ($(this).hasClass("stop-scroll")) {
    lenis.stop();
  } else {
    lenis.start();
  }
});

// == 3. ANIMATION FOOTER MOBILE ==
const footerBtnShow = document.querySelectorAll(".footer-btn-show");
const footerShow = document.querySelectorAll(".footer-show");

footerBtnShow.forEach((button, index) => {
  button.addEventListener("click", () => {
    button.classList.toggle("rotate-180");
    footerShow[index].classList.toggle("h-44");
  });
});

// == 4. CART ==
const cartBtn = $(".addToCart");
const itemsCart = $(".items-cart");
const totalCartModal = $(".totalCart-modal");
const totalCart = $(".totalCart");
const productHtml = document.querySelector(".cart-box");
const totalCartAfterDiscount = $(".total-cart-discounted");
var totalPrice = 0;

$.ajax({
  type: "GET",
  url: "model/addtocart.php",
  dataType: "json",
  success: function (sessionData) {
    itemsCart.text(sessionData.length);
    updateCartContent(sessionData);
  },
  error: function (error) {
    console.log("Lỗi khi lấy dữ liệu session:", error);
  },
});

function addToCart(button) {
  let productImg = $(button).parent().parent().children().eq(0).val();
  let productName = $(button).parent().parent().children().eq(1).val();
  let productBrand = $(button).parent().parent().children().eq(2).val();
  let productPrice = $(button).parent().parent().children().eq(3).val();
  let productSalePrice = $(button).parent().parent().children().eq(4).val();

  // AJAX
  $.ajax({
    type: "POST",
    url: "model/addtocart.php",

    data: {
      img: productImg,
      name: productName,
      brand: productBrand,
      price: productPrice,
      saleprice: productSalePrice,
    },
    success: function (response) {
      totalCartModal.text(response.length);
      itemsCart.text(response.length);
      updateCartContent(response);
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function updateCartContent(cartData) {
  let htmlCode = "";
  let price = "";
  let lastprice = 0;
  let VND = "";
  totalPrice = 0;

  if (cartData.length == 0) {
    productHtml.innerHTML =
      '<img class="w-full mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">';
    $(".cart-items-container").html(
      '<img class="w-2/4 mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">'
    );
  } else {
    productHtml.innerHTML = htmlCode;
  }

  for (let index = 0; index < cartData.length; index++) {
    if (cartData[index].saleprice == "") {
      lastprice = cartData[index].price;
      price = "";
      VND = "";
    } else {
      lastprice = cartData[index].saleprice;
      price = cartData[index].price;
      VND = "VND";
    }
    totalPrice += lastprice * cartData[index].quantity;
    htmlCode += `
            <div class="flex gap-4 my-2 ">
                <div class="w-1/4 bg-box rounded-box">
                      <img src="${cartData[index].img}" alt="">
                  </div>
                  <div class="flex flex-col justify-between">
                      <div>
                          <div class="text-p font-bold">${
                            cartData[index].name
                          }</div>
                          <div class="text-sm text-customGray">${
                            cartData[index].brand
                          }</div>
                      </div>
                      <div class="flex flex-col">
                          <div class=" text-lg text-primary font-bold">${lastprice} VND</div>
                          <del class=" text-sm text-customGray">${
                            price + VND
                          }</del>
                      </div>
                  </div>
                  <div class="ml-auto flex flex-col justify-between items-center">
                  <button onclick="handleDeleteButtonClick(this)">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="delete-cart ml-auto text-primary hover:scale-125 delay-75 h-5 w-5 cursor-pointer duration-150">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
    
                          <div class="flex items-center justify-center gap-3 text-sm py-1.5 w-20 text-customGray border-2 border-box rounded-lg">
                          <button onclick="minusQuantity(this)">
                            <i class="minus-quantity fa-solid fa-minus"></i>
                          </button>
                          <span class="">${cartData[index].quantity}</span>
                          <button onclick="plusQuantity(this)">
                            <i class="plus-quantity fa-solid fa-plus"></i>
                          </button>
                      </div>
                      <p>Tổng: ${cartData[index].quantity * lastprice} VND</p>
                  </div>
              </div>
          `;
  }

  if (cartData.length == 0) {
    productHtml.innerHTML =
      '<img class="w-full mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">';
    $(".cart-items-container").html(
      '<img class="w-2/4 mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">'
    );
  } else {
    productHtml.innerHTML = htmlCode;
  }

  $(".total-price").text(totalPrice + " VND");
  totalCart.text(totalPrice);
  totalCartAfterDiscount.text(totalPrice);
}

// == 5. MODAL CART ==
const openBtn = $(".open-cart");
const overlayCart = $(".modal-cart");
const closeBtn = $(".close-cart");
const cartNofication = $(".cart-nofi");

overlayCart.click(() => {
  lenis.start();
  $("body").toggleClass("overflow-hidden");
  overlayCart.toggleClass("hidden");
  cartNofication.toggleClass("cart-hide");
});

openBtn.on("click", () => {
  lenis.stop();
  $("body").toggleClass("overflow-hidden");
  overlayCart.toggleClass("hidden");
  overlayCart.toggleClass("overflow-hidden");
  cartNofication.toggleClass("cart-hide");
});

closeBtn.on("click", () => {
  lenis.start();
  $("body").toggleClass("overflow-hidden");
  overlayCart.toggleClass("hidden");
  cartNofication.toggleClass("cart-hide");
});

// == 6. REMOVE CART ==
function handleDeleteButtonClick(button) {
  let productBox = $(button).parent().parent();
  let productName = $(button)
    .parent()
    .parent()
    .children()
    .eq(1)
    .children()
    .eq(0)
    .children()
    .eq(0)
    .text();
  let action = "action";

  productBox.slideUp("slow");

  setTimeout(function () {
    $.ajax({
      type: "POST",
      url: "model/action.php",

      data: {
        action: action,
        productName: productName,
      },
      success: function (response) {
        console.log(response);
        updateCartContent(response);
        itemsCart.text(response.length);
        totalCartModal.text(response.length);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }, 500);
}

$(".clear-cart-btn").click(() => {
  let clear = "clear";
  let emtyCartHtml = `<img class="w-2/4 mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">`;
  let emtyCartModalHtml = `<img class="w-full mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">`;

  $.ajax({
    type: "POST",
    url: "model/action.php",

    data: {
      clear: clear,
    },
    success: function () {
      $(".cart-items-container").html(
        `<img class="w-2/4 mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">`
      );
      $(".cart-box").html(
        `<img class="w-full mx-auto filter grayscale" src="uploads/empy-cart.png" alt="emty-cart">`
      );
      totalCartModal.text(0);
      itemsCart.text(0);
      $(".totalCart").text(0);
    },
    error: function (error) {
      console.log(error);
    },
  });
});
// == 7. UPDATE QUANTITY CART ==

// MINUS
function minusQuantity(button) {
  // Identifier for the operation (minus)
  let minus = "minus";

  // Get the price of the product
  let productPrice = $(button)
    .parent()
    .parent()
    .parent()
    .parent()
    .children()
    .eq(1)
    .children()
    .eq(1)
    .children()
    .eq(0)
    .text();

  // Get the parent container of the product
  let boxProduct = $(button).parent().parent().parent();

  // Get the name of the product
  let productName = $(button)
    .parent()
    .parent()
    .prev()
    .children()
    .eq(0)
    .children()
    .eq(0)
    .text();

  // Get the current quantity of the product and convert it to an integer
  let productQuantity = parseInt($(button).next().text());

  // Decrement the product quantity if it's greater than 0
  if (productQuantity > 0) {
    productQuantity--;
  } else {
    // If the quantity is already 0, hide the product container
    boxProduct.slideUp("slow");
  }

  // Update the total price for the product
  $(button)
    .parent()
    .next()
    .text(productPrice * productQuantity + " VND");

  // Update the displayed quantity
  $(button).next().text(productQuantity);

  // Send an AJAX request to update the cart on the server
  $.ajax({
    type: "POST",
    url: "model/action.php",
    data: {
      minus: "minus",
      productQuantity: productQuantity,
      productName: productName,
    },
    success: function (response) {
      // Handle the successful response from the server
      updateCartContent(response);

      // Update the total number of items in the cart
      itemsCart.text(response.length);
      totalCartModal.text(response.length);
    },
    error: function (error) {
      // Log any errors that occur during the AJAX request
      console.log(error);
    },
  });
}

function plusQuantity(button) {
  // Get the parent container of the product
  let boxProduct = $(button).parent().parent().parent();

  // Get the current quantity of the product and convert it to an integer
  let productQuantity = parseInt($(button).prev().text());

  // Get the name of the product
  let productName = $(button)
    .parent()
    .parent()
    .prev()
    .children()
    .eq(0)
    .children()
    .eq(0)
    .text();

  // Identifier for the operation (plus)
  let plus = "plus";

  // Get the price of the product
  let productPrice = $(button)
    .parent()
    .parent()
    .parent()
    .parent()
    .children()
    .eq(1)
    .children()
    .eq(1)
    .children()
    .eq(0)
    .text();

  // Increment the product quantity if it's less than 10
  if (productQuantity < 10) {
    productQuantity++;
  }

  // Update the displayed quantity
  $(button).prev().text(productQuantity);

  // Update the total price for the product
  $(button)
    .parent()
    .next()
    .text(productPrice * productQuantity + " VND");

  // Send an AJAX request to update the cart on the server
  $.ajax({
    type: "POST",
    url: "model/action.php",
    data: {
      plus: "plus",
      productQuantity: productQuantity,
      productName: productName,
    },
    success: function (response) {
      // Handle the successful response from the server
      updateCartContent(response);
    },
    error: function (error) {
      // Log any errors that occur during the AJAX request
      console.log(error);
    },
  });
}

// == 8. VOUCHER ==
// FOR USER
function applyPromoCode() {
  let promoCode = $(".promoteCode").val();
  let totalPriceNum = totalCart.text();
  let tl1 = gsap.timeline({ repeat: 0, repeatDelay: 1 });
  let tl2 = gsap.timeline({ repeat: 0, repeatDelay: 1 });

  tl1.fromTo(".total-cart-discounted", { y: -24 }, { y: 13, duration: 1 });
  tl1.restart();
  tl2.fromTo(".totalCart", { y: 3 }, { y: 40, duration: 1 });
  tl2.restart();

  let totalCartAfterDiscount = $(".total-cart-discounted");

  $.ajax({
    type: "POST",
    url: "model/action.php",
    data: {
      discard: "discard",
      promoCode: promoCode,
      totalCart: totalPriceNum,
    },
    success: function (response) {
      switch (response[0]) {
        case 1:
          totalCartAfterDiscount.text(response[1]);
          $(".priceDiscount").text(response[2] - response[1]);
          $(".alert-text").text("");
          break;
        case 2:
          $(".alert-text").text("Voucher đã được sử dụng");
          totalCartAfterDiscount.text(response[2]);
          $(".priceDiscount").text(0);
          console.log("Voucher đã được sử dụng");
          break;
        case 3:
          $(".alert-text").text("Voucher không tồn tại hoặc quá hạn");
          totalCartAfterDiscount.text(response[2]);
          $(".priceDiscount").text(0);
          console.log("Voucher đã chimto");
          break;
      }
      console.log(response);
    },
    error: function (error) {
      console.log(error);
    },
  });
}

// CLICK
$(".promodeApply").on("click", applyPromoCode);

// PRESS ENTER
$(".promoteCode").on("keyup", function (event) {
  if (event.key === "Enter") {
    applyPromoCode();
  }
});

// FOR mấy thằng xài voucher chùa

function applyPromoCodeNotUser() {
  $(".promoteCodeNotUser").css({ "border-color": "red" });
  $(".notUser-text").removeClass("hidden");
}

$(".promodeApplyNotUser").on("click", applyPromoCodeNotUser);

// PRESS ENTER
$(".promoteCodeNotUser").on("keyup", function (event) {
  if (event.key === "Enter") {
    applyPromoCodeNotUser();
  }
});

// == 9. CHECK OUT

function isValidEmail(email) {
  // Regular expression for a simple email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  const phonePattern = /^\d{10}$/;
  return phonePattern.test(phone);
}

function validateForm(
  receiverName,
  receiverAddress,
  receiverEmail,
  receiverPhone
) {
  const $alertInputName = $(".alertInputName");
  const $alertInputAddress = $(".alertInputAddress");
  const $alertInputEmail = $(".alertInputEmail");
  const $alertInputPhone = $(".alertInputPhone");

  const isBlank = (value, $alert) => {
    if (value.trim() === "") {
      $alert.text("Vui lòng nhập thông tin.");
      return true;
    }
    $alert.text("");
    return false;
  };

  if (isBlank(receiverName, $alertInputName)) return false;
  if (isBlank(receiverAddress, $alertInputAddress)) return false;
  if (isBlank(receiverEmail, $alertInputEmail)) return false;

  if (!isValidEmail(receiverEmail)) {
    $alertInputEmail.text("Vui lòng nhập một địa chỉ email hợp lệ.");
    return false;
  }
  $alertInputEmail.text("");

  if (!isValidEmail(receiverPhone)) {
    $alertInputPhone.text("Vui lòng nhập số điện thoại hợp lệ.");
    return false;
  }
  $alertInputPhone.text("");

  return true;
}

function placeOrder() {
  let receiverName = $(".inputName").val(),
    receiverAddress = $(".inputAddress").val(),
    receiverEmail = $(".inputEmail").val(),
    receiverPhone = $(".inputPhone").val(),
    receiverNote = $(".inputNote").val(),
    otherReceiverName = $(".other-receiver-name").val(),
    otherReceiverEmail = $(".other-receiver-name").val(),
    otherReceiverPhone = $(".other-receiver-phone").val(),
    otherReceiverAddress = $(".other-receiver-address").val();

  // If otherReceiver fields are empty, use receiver fields
  if (
    otherReceiverName === "" &&
    otherReceiverAddress === "" &&
    otherReceiverPhone === "" &&
    otherReceiverEmail === ""
  ) {
    otherReceiverName = receiverName;
    otherReceiverEmail = receiverEmail;
    otherReceiverPhone = receiverPhone;
    otherReceiverAddress = receiverAddress;
  }

  // CHECK FORM

  if (
    !validateForm(receiverName, receiverAddress, receiverEmail, receiverPhone)
  ) {
    return;
  }

  // MODAL
  $(".name").text(receiverName);
  $(".address").text(receiverAddress);
  $(".email").text(receiverEmail);
  $(".phone").text(receiverPhone);
  $(".note").text(receiverNote);
  $(".receiver-name").text(otherReceiverName);
  $(".receiver-email").text(otherReceiverEmail);
  $(".receiver-phone").text(otherReceiverPhone);
  $(".receiver-address").text(otherReceiverAddress);

  $(".modal-sumary").addClass("sumaryCartShow");
  $(".sumary-box").addClass("sumaryBoxShow");

  setTimeout(gsapButton, 1000);
  // setInterval(gsapButton,300)

  $.ajax({
    type: "POST",
    url: "model/action.php",

    data: {
      order: "order",
      receiverName: receiverName,
      receiverAddress: receiverAddress,
      receiverEmail: receiverEmail,
      receiverPhone: receiverPhone,
      receiverNote: receiverNote,
      otherReceiverName: otherReceiverName,
      otherReceiverEmail: otherReceiverEmail,
      otherReceiverPhone: otherReceiverPhone,
      otherReceiverAddress: otherReceiverAddress,
    },
    success: function (response) {
      console.log(response);
    },
    error: function (error) {
      console.log(error);
    },
  });
}

$(".placeOrder").click(placeOrder);

$(".notForMe").click(() => {
  $(".notFotMe-hidden").toggleClass("h-96");
});

function gsapButton() {
  document.querySelectorAll(".truck-button").forEach((button) => {
    // e.preventDefault();
    let box = button.querySelector(".box"),
      truck = button.querySelector(".truck");
    if (!button.classList.contains("done")) {
      if (!button.classList.contains("animation")) {
        button.classList.add("animation");
        gsap.to(button, {
          "--box-s": 1,
          "--box-o": 1,
          duration: 0.3,
          delay: 0.5,
        });
        gsap.to(box, {
          x: 0,
          duration: 0.4,
          delay: 0.7,
        });
        gsap.to(button, {
          "--hx": -5,
          "--bx": 50,
          duration: 0.18,
          delay: 0.92,
        });
        gsap.to(box, {
          y: 0,
          duration: 0.1,
          delay: 1.15,
        });
        gsap.set(button, {
          "--truck-y": 0,
          "--truck-y-n": -26,
        });
        gsap.to(button, {
          "--truck-y": 1,
          "--truck-y-n": -25,
          duration: 0.2,
          delay: 1.25,
          onComplete() {
            gsap
              .timeline({
                onComplete() {
                  button.classList.add("done");
                },
              })
              .to(truck, {
                x: 0,
                duration: 0.4,
              })
              .to(truck, {
                x: 40,
                duration: 1,
              })
              .to(truck, {
                x: 20,
                duration: 0.6,
              })
              .to(truck, {
                x: 96,
                duration: 0.4,
              });
            gsap.to(button, {
              "--progress": 1,
              duration: 2.4,
              ease: "power2.in",
            });
          },
        });
      }
    } else {
      button.classList.remove("animation", "done");
      gsap.set(truck, {
        x: 4,
      });
      gsap.set(button, {
        "--progress": 0,
        "--hx": 0,
        "--bx": 0,
        "--box-s": 0.5,
        "--box-o": 0,
        "--truck-y": 0,
        "--truck-y-n": -26,
      });
      gsap.set(box, {
        x: -24,
        y: -6,
      });
    }
  });
}

// == 10. MORDAL SEACH ==
$(".search-open").click(function () {
  $(".modal-search").toggleClass("hidden");
  $(".search-box").toggleClass("hidden");
  lenis.stop();
});

$(".close-search").click(function () {
  $(".modal-search").toggleClass("hidden");
  $(".search-box").toggleClass("hidden");
  lenis.start();
});

// == 11. FORM VALIDATION ==
//  CHECK FORM SIGN IN
function validateFormSignIn(event) {
  console.log("validateForm called");
  event.preventDefault(); // Prevent the form from submitting by default

  var username = document.getElementById("username").value;
  var password = document.getElementById("passwordInput").value;
  var usernameError = document.getElementById("username-error");
  var passwordError = document.getElementById("password-error");

  // Reset error messages
  usernameError.textContent = "";
  passwordError.textContent = "";

  // Check if fields are empty
  if (username.trim() === "") {
    usernameError.textContent = "Vui lòng nhập tên đăng nhập.";
  }
}

// == 10. PASSWORD TOGGLE ==

// == 11. FORM VALIDATION ==

//  CHECK FORM SIGN IN
function validateFormSignIn(event) {
  console.log("validateForm called");
  event.preventDefault(); // Prevent the form from submitting by default

  var username = document.getElementById("username").value;
  var password = document.getElementById("passwordInput").value;
  var usernameError = document.getElementById("username-error");
  var passwordError = document.getElementById("password-error");

  // Reset error messages
  usernameError.textContent = "";
  passwordError.textContent = "";

  // Check if fields are empty
  if (username.trim() === "") {
    usernameError.textContent = "Vui lòng nhập tên đăng nhập.";
  }

  const passwordInput = document.getElementById("passwordInput");
  const togglePassword = document.getElementById("togglePassword");

  if (password.trim() === "") {
    passwordError.textContent = "Vui lòng nhập mật khẩu.";
  }

  // If there are any errors, prevent form submission
  if (usernameError.textContent !== "" || passwordError.textContent !== "") {
    return false;
  }

  // If validation passed, you can submit the form
  return true;
}

// CHECK FORM SIGN UP
function validateFormSignUp(event) {
  console.log("validateForm called");
  event.preventDefault(); // Prevent the form from submitting by default

  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("passwordInput").value;
  var usernameError = document.getElementById("username-error");
  var emailError = document.getElementById("email-error");
  var passwordError = document.getElementById("password-error");

  // Reset error messages
  usernameError.textContent = "";
  emailError.textContent = "";
  passwordError.textContent = "";

  // Check if fields are empty
  if (username.trim() === "") {
    usernameError.textContent = "Vui lòng nhập tên đăng nhập.";
  }

  if (email.trim() === "") {
    emailError.textContent = "Vui lòng nhập email.";
  }

  if (password.trim() === "") {
    passwordError.textContent = "Vui lòng nhập mật khẩu.";
  }

  // If there are any errors, prevent form submission
  if (
    usernameError.textContent !== "" ||
    emailError.textContent !== "" ||
    passwordError.textContent !== ""
  ) {
    return false;
  }

  // If validation passed, you can submit the form
  return true;
}
// == 10. PASSWORD TOGGLE ==
const passwordInput = document.getElementById("passwordInput");
const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    togglePassword.setAttribute("name", "eye-off-outline");
  } else {
    passwordInput.type = "password";
    togglePassword.setAttribute("name", "eye-outline");
  }
});
