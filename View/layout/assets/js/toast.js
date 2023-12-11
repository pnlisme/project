// const Inputsearch = document.querySelector(".InputSearch");

// hande Click btn
// Inputsearch.onclick = function () {
//   handleShowAndHideToast("success");
// };

function handleShowAndHideToast(type) {
  // Create card div
  var toast = document.createElement("div");
  // add class toast
  toast.classList.add("toast", type);

  if (type === "success") {
    toast.innerHTML = `
                <i class="fa-solid fa-circle-check"></i>
                <p class="text-toast">Lọc sản phẩm thành công!</p>
                <div class="cout-down">
        `;
  }
  if (type === "error") {
    toast.innerHTML = `
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p class="text-toast">Không có sản phẩm được lọc!</p>
            <div class="cout-down">
    `;
  }
  // get parentElement is #toast
  const toastList = document.querySelector("#toast");
  toastList.appendChild(toast);

  // hide Toast
  setTimeout(() => {
    // add animation hide for toast
    toast.style.animation = `hideToast ease 3s forwards`;
  }, 3000);

  // delete Toast in DOM
  setTimeout(() => {
    toast.remove();
  }, 3000 + 3000);
}
