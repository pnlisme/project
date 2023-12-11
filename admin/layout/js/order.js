var detailBtns = document.querySelectorAll(".order-detail");
var orderForm = document.querySelector(".order-form");
var orderFormContainer = document.querySelector(".order-form-container");

// show order detail
function showMore(e) {
  orderFormContainer.classList.remove("remove-form");
  orderForm.style.display = "block";
  orderFormContainer.classList.add("open-form");
  var id = $(e).attr("id");
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=open",
    method: "POST",
    data: { id: id },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.user);
      $(".order-form-content").html(data.html);
    },
  });
}

var orderFormClose = document.querySelector(".order-form-close");
function closeForm() {
  orderFormContainer.classList.remove("open-form");
  orderFormContainer.classList.add("remove-form");
  setTimeout(() => {
    orderForm.style.display = "none";
  }, 250);
}
orderFormClose.addEventListener("click", closeForm);
orderForm.addEventListener("click", (e) => {
  if (e.target == orderForm) {
    closeForm();
  }
});

// load order
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=show",
    method: "POST",
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.html);
      $(".table-body").html(data.html);
    },
  });
});

// show page index
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=page",
    method: "POST",
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-page").html(data.html);
    },
  });
});

function loadOrderInPage(e) {
  var page = $(e).attr("value");
  // console.log(page);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=show",
    method: "POST",
    data: { page: page },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.html);
      $(".table-body").html(data.html);
    },
  });
}

// filter
function filterOrder(e) {
  var filter = $(e).val();
  // console.log(filter);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=show",
    method: "POST",
    data: { filter: filter },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.filter);
      $(".table-body").html(data.html);
    },
  });
}

// search
function searchOrder(e) {
  var search = $(e).val();
  // console.log(search);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=show",
    method: "POST",
    data: { search: search },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.html);
      $(".table-body").html(data.html);
    },
  });
}

// update order
function updateOrder(e) {
  var id = $(e).attr("id");
  var formUpOrder = new FormData($("#formUpdateOrder")[0]);
  // console.log(id);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/order.php?func=update&id=" + id,
    method: "POST",
    data: formUpOrder,
    dataType: "json",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      if (data.result == "success") {
        Swal.fire({
          title: "Cập nhật thành công",
          icon: "success",
          showConfirmButton: false,
          timer: 1500,
        });
        closeForm();
        $(".table-body").html(data.html);
      } else {
        Swal.fire({
          title: "Cập nhật thất bại",
          icon: "error",
          text: "Vui lòng nhập đầy đủ thông tin!",
        });
      }
    },
  });
}
