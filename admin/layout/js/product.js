CKEDITOR.replace("editor-add");
// Add product
var addProduct = document.querySelector(".product-add");
var prodForms = document.querySelectorAll(".product-form");

if (prodForms[0]) {
  function openForm() {
    var prodFormContainer = prodForms[0].querySelector(
      ".product-form-container"
    );
    prodFormContainer.classList.remove("remove-form");
    prodForms[0].style.display = "block";
    prodFormContainer.classList.add("open-form");
  }
  addProduct.addEventListener("click", openForm);
}

if (prodForms[0]) {
  var prodFormContainer = prodForms[0].querySelector(".product-form-container");
  var prodFormClose = prodForms[0].querySelector(".product-form-close");
  function closeForm() {
    prodFormContainer.classList.remove("open-form");
    prodFormContainer.classList.add("remove-form");
    setTimeout(() => {
      prodForms[0].style.display = "none";
    }, 250);
  }
  prodFormClose.addEventListener("click", closeForm);

  prodForms[0].addEventListener("click", (e) => {
    if (e.target == prodForms[0]) {
      closeForm();
    }
  });
}

// Load product image
function loadImgInput(e) {
  if (e.files && e.files[0]) {
    var reader = new FileReader();
    var imgLoad = $(e).next().children();
    // console.log(imgLoad);
    reader.onload = function (e) {
      imgLoad.attr("src", e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
    // $(e).next().css("display", "block");
  }
}
function removeImgInput(e) {
  $(e).prev().attr("src", "../upload/product/no-image.jpeg");
  // $(e).parent().css("display", "none");
  $(e).parent().prev().val("");
}

// Load Img Add Product
function loadImgInputAdd(e) {
  if (e.files && e.files[0]) {
    var reader = new FileReader();
    var imgLoad = $(e).next().children();
    // console.log(imgLoad);
    reader.onload = function (e) {
      imgLoad.attr("src", e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
    $(e).next().css("display", "block");
  }
}
function removeImgInputAdd(e) {
  $(e).prev().attr("src", "../upload/product/no-image.jpeg");
  $(e).parent().css("display", "none");
  $(e).parent().prev().val("");
}

// Load product
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/product.php?func=show",
    method: "POST",
    cache: false,
    dataType: "",
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data);
    },
  });
});

function loadProductInPage(e) {
  var page = $(e).attr("value");
  $.ajax({
    url: "http://localhost/Project-E/admin/data/product.php?func=show",
    method: "POST",
    cache: false,
    data: { page: page },
    // dataType: "json",
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data);
    },
  });
}

function loadProductInInput(e) {
  var name = $(e).val();
  $.ajax({
    url: "http://localhost/Project-E/admin/data/product.php?func=show",
    method: "POST",
    cache: false,
    data: { name: name },
    dataType: "",
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data);
    },
  });
}
// Show page index
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/product.php?func=page",
    method: "POST",
    cache: false,
    dataType: "",
    success: function (data) {
      // console.log(data);
      $(".table-page").html(data);
    },
  });
});

// Open form update
if (prodForms[1]) {
  function openFormUp(e) {
    var prodFormContainer = prodForms[1].querySelector(
      ".product-form-container"
    );
    prodFormContainer.classList.remove("remove-form");
    prodForms[1].style.display = "block";
    prodFormContainer.classList.add("open-form");
    var id = $(e).attr("value");
    $.ajax({
      url: "http://localhost/Project-E/admin/data/product.php?func=up",
      method: "POST",
      cache: false,
      dataType: "",
      data: { id: id },
      success: function (data) {
        // console.log(data);
        $("#formUpProduct").html(data);
        CKEDITOR.replace("editor-up");
        var prodFormContainer = prodForms[1].querySelector(
          ".product-form-container"
        );
        var prodFormClose = prodForms[1].querySelector(".product-form-close");
        function closeForm() {
          prodFormContainer.classList.remove("open-form");
          prodFormContainer.classList.add("remove-form");
          setTimeout(() => {
            prodForms[1].style.display = "none";
          }, 250);
        }
        prodFormClose.addEventListener("click", closeForm);

        prodForms[1].addEventListener("click", (e) => {
          if (e.target == prodForms[1]) {
            closeForm();
          }
        });
      },
    });
  }
}

//Update product
function updateProduct(e) {
  var id = $(e).attr("id");
  var descriptionData = CKEDITOR.instances["editor-up"].getData();
  var formData = new FormData($("#formUpdateProduct")[0]);
  formData.append("description", descriptionData);
  // console.log(id);
  $.ajax({
    url:
      "http://localhost/Project-E/admin/data/product.php?func=upProd&id=" + id,
    data: formData,
    dataType: "json",
    method: "post",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      if (data.imgmain == "fail") {
        Swal.fire({
          icon: "error",
          title: "Trùng lặp hình ảnh!",
          text: "Vui lòng cập nhật lại tên ảnh chính!",
        });
        var notimain = "fail";
      } else {
        var notimain = "success";
      }
      if (data.imgsub == "fail") {
        Swal.fire({
          icon: "error",
          title: "Trùng lặp hình ảnh!",
          text: "Vui lòng cập nhật lại tên ảnh phụ!",
        });
        var notisub = "fail";
      } else {
        var notisub = "success";
      }
      if (data.imgmain == "fail" && data.imgsub == "fail") {
        Swal.fire({
          icon: "error",
          title: "Trùng lặp hình ảnh!",
          text: "Vui lòng cập nhật lại tên ảnh chính và ảnh phụ!",
        });
      }
      // console.log(data.result);
      // console.log(data.imgmain);
      // console.log(data.imgsub);
      // console.log(notimain);
      // console.log(notisub);
      if (notimain == "success" && notisub == "success") {
        if (data.result == "success") {
          $(".table-body").html(data.html);
          $(".product-form-container").removeClass("open-form");
          $(".product-form-container").addClass("remove-form");
          setTimeout(() => {
            $(".product-form").css("display", "none");
          }, 250);
          Swal.fire({
            icon: "success",
            title: "Chỉnh sửa thành công!",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Chỉnh sửa thất bại!",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      }
    },
  });
}

function addProductBtn() {
  var descriptionData = CKEDITOR.instances["editor-add"].getData();
  var formData = new FormData($("#formAddProduct")[0]);
  formData.append("description", descriptionData);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/product.php?func=addProd",
    data: formData,
    dataType: "json",
    method: "post",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      // console.log(data.imgmain);
      // console.log(data.imgsub);
      if (data.imgmain == "fail") {
        Swal.fire({
          icon: "error",
          title: "Trùng lặp hình ảnh!",
          text: "Vui lòng cập nhật lại tên ảnh chính!",
        });
        var notimain = "fail";
      } else {
        var notimain = "success";
      }
      if (data.imgsub == "fail") {
        Swal.fire({
          icon: "error",
          title: "Trùng lặp hình ảnh!",
          text: "Vui lòng cập nhật lại tên ảnh phụ!",
        });
        var notisub = "fail";
      } else {
        var notisub = "success";
      }
      if (data.imgmain == "fail" && data.imgsub == "fail") {
        Swal.fire({
          icon: "error",
          title: "Trùng lặp hình ảnh!",
          text: "Vui lòng cập nhật lại tên ảnh chính và ảnh phụ!",
        });
      }
      if (notimain == "success" && notisub == "success") {
        if (data.result == "success") {
          // console.log(noti);

          Swal.fire({
            icon: "success",
            title: "Thêm sản phẩm thành công!",
            showConfirmButton: false,
            timer: 1500,
          });

          $(".table-body").html(data.html);
          $(".product-form-container").removeClass("open-form");
          $(".product-form-container").addClass("remove-form");
          setTimeout(() => {
            $(".product-form").css("display", "none");
          }, 250);
          $('select[name="category"]').val("-- Danh mục --");
          $('select[name="brand"]').val("-- Thương hiệu --");
          $('input[name="name"]').val("");
          $('input[type="file"]').val("");
          $(".show-image").css("display", "none");
          $('input[name="price"]').val("");
          $('input[name="price_sale"]').val("");
          $('input[name="entry-date"]').val("");
          $('input[name="quantity"]').val("");
          $('input[name="view"]').val("");
          $('input[name="sale"][value="1"]').prop("checked", true);
          $('input[name="hot"][value="1"]').prop("checked", true);
          $('input[name="status"][value="1"]').prop("checked", true);
          CKEDITOR.instances["editor-add"].setData("");
        } else {
          Swal.fire({
            icon: "error",
            title: "Thêm sản phẩm thất bại!",
            text: "Vui lòng kiểm tra lại và điền đầy đủ thông tin!",
          });
        }
      }
    },
    error: function () {
      Swal.fire({
        icon: "error",
        title: "Thêm sản phẩm thất bại!",
        text: "Vui lòng kiểm tra lại và điền đầy đủ thông tin!",
      });
    },
  });
}

function deleteProduct(e) {
  var id = $(e).attr("value");
  // console.log(id);
  Swal.fire({
    title: "Bạn có chắc muốn xóa?",
    text: "Bạn sẽ không thể khôi phục lại sản phẩm này!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url:
          "http://localhost/Project-E/admin/data/product.php?func=delProd&id=" +
          id,
        method: "POST",
        cache: false,
        dataType: "json",
        success: function (data) {
          // console.log(data);
          if (data.result == "success") {
            Swal.fire({
              icon: "success",
              title: "Xóa thành công!",
              showConfirmButton: false,
              timer: 1500,
            });
            $(".table-body").html(data.html);
            $(".table-page").html(data.page);
          }
        },
      });
    }
  });
}
