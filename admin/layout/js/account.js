var form = document.querySelector(".account-form");
var formContainer = document.querySelector(".account-form-container");

// Load product image
function loadImgInput(e) {
  if (e.files && e.files[0]) {
    var reader = new FileReader();
    var imgLoad = $(e).next().children();
    // console.log(imgLoad);
    reader.onload = function (e) {
      imgLoad.attr("srcset", e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
    // $(e).next().css("display", "block");
  }
}
function removeImgInput(e) {
  $(e).prev().attr("srcset", "../upload/product/no-image.jpeg");
  // $(e).parent().css("display", "none");
  $(e).parent().prev().val("");
}

function removeImgInputAdd(e) {
  $(e).prev().attr("src", "../upload/product/no-image.jpeg");
  $(e).parent().css("display", "none");
  $(e).parent().prev().val("");
}

function upAcc(e) {
  formContainer.classList.remove("remove-form");
  form.style.display = "block";
  formContainer.classList.add("open-form");
  var id = $(e).attr("id");
  // console.log(id);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/account.php?func=open",
    method: "POST",
    data: { id: id },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.acc);
      $(".account-form-content").html(data.html);
    },
  });
}

var closeBtn = document.querySelector(".account-form-close");
function closeForm() {
  formContainer.classList.remove("open-form");
  formContainer.classList.add("remove-form");
  setTimeout(() => {
    form.style.display = "none";
  }, 250);
}
closeBtn.addEventListener("click", closeForm);
form.addEventListener("click", (e) => {
  if (e.target == form) {
    closeForm();
  }
});

// show acc
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/account.php?func=show",
    method: "POST",
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data.html);
    },
  });
});

// show page index
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/account.php?func=page",
    method: "POST",
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-page").html(data.html);
    },
  });
});

function selectAcc(e) {
  var filter = $(e).val();
  $.ajax({
    url: "http://localhost/Project-E/admin/data/account.php?func=show",
    method: "POST",
    data: { filter: filter },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data.filter);
      // console.log(data.html);
      $(".table-body").html(data.html);
    },
  });
}

function searchAcc(e) {
  var search = $(e).val();
  $.ajax({
    url: "http://localhost/Project-E/admin/data/account.php?func=show",
    method: "POST",
    data: { search: search },
    dataType: "json",
    cache: false,
    success: function (data) {
      console.log(data.search);
      console.log(data.html);
      $(".table-body").html(data.html);
    },
  });
}

function loadAccInPage(e) {
  var page = $(e).attr("value");
  $.ajax({
    url: "http://localhost/Project-E/admin/data/account.php?func=show",
    method: "POST",
    data: { page: page },
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data.html);
    },
  });
}

function btnUpAcc(e) {
  var pw = $("#account-password").val();
  var pwc = $("#account-password-confirm").val();
  if (pw != pwc) {
    Swal.fire({
      icon: "error",
      title: "Mật khẩu không khớp!",
      text: "Vui lòng kiểm tra lại mật khẩu!",
      showConfirmButton: false,
      timer: 1500,
    });
  } else {
    var id = $(e).attr("id");
    var formData = new FormData($("#formUpAcc")[0]);
    $.ajax({
      url:
        "http://localhost/Project-E/admin/data/account.php?func=update&id=" +
        id,
      method: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
        if (data.result == "success") {
          Swal.fire({
            icon: "success",
            title: "Chỉnh sửa thành công!",
            showConfirmButton: false,
            timer: 1500,
          });
          closeForm();
          $(".table-body").html(data.html);
        }
      },
      error: function (data) {
        Swal.fire({
          icon: "error",
          title: "Chỉnh sửa thất bại!",
          text: "Vui lòng kiểm tra lại thông tin!",
          showConfirmButton: false,
          timer: 1500,
        });
      },
    });
  }
}

function delAcc(e) {
  var id = $(e).attr("id");
  Swal.fire({
    title: "Bạn có chắc muốn xóa?",
    text: "Bạn sẽ không thể khôi phục lại tài khoản này!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url:
          "http://localhost/Project-E/admin/data/account.php?func=delete&id=" +
          id,
        method: "POST",
        dataType: "json",
        cache: false,
        success: function (data) {
          if (data.result == "success") {
            Swal.fire({
              icon: "success",
              title: "Xóa thành công!",
              showConfirmButton: false,
              timer: 1500,
            });
            $(".table-body").html(data.html);
            $(".table-page").html(data.page);
          } else {
            Swal.fire({
              icon: "error",
              title: "Xóa thất bại!",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
      });
    }
  });
}
