CKEDITOR.replace("editor-add");
// Add news
var addNews = document.querySelector(".news-add");
var prodForms = document.querySelectorAll(".news-form");

if (prodForms[0]) {
  function openForm() {
    var prodFormContainer = prodForms[0].querySelector(".news-form-container");
    prodFormContainer.classList.remove("remove-form");
    prodForms[0].style.display = "block";
    prodFormContainer.classList.add("open-form");
  }
  addNews.addEventListener("click", openForm);
}

if (prodForms[0]) {
  var prodFormContainer = prodForms[0].querySelector(".news-form-container");
  var prodFormClose = prodForms[0].querySelector(".news-form-close");
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
  $(e).prev().attr("src", "../upload/news/no-image.jpeg");
  $(e).parent().css("display", "none");
  $(e).parent().prev().val("");
}

// Load news
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/news.php?func=show",
    method: "POST",
    cache: false,
    dataType: "json",
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data.html);
    },
  });
});

function loadNewsInPage(e) {
  var page = $(e).attr("value");
  // console.log(page);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/news.php?func=show",
    method: "POST",
    cache: false,
    data: { page: page },
    dataType: "json",
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data.html);
    },
  });
}

function loadNewsInInput(e) {
  var search = $(e).val();
  // console.log(search);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/news.php?func=show",
    method: "POST",
    cache: false,
    data: { search: search },
    dataType: "json",
    success: function (data) {
      // console.log(data.html);
      $(".table-body").html(data.html);
    },
  });
}
// Show page index
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/news.php?func=page",
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
    var prodFormContainer = prodForms[1].querySelector(".news-form-container");
    prodFormContainer.classList.remove("remove-form");
    prodForms[1].style.display = "block";
    prodFormContainer.classList.add("open-form");
    var id = $(e).attr("value");
    $.ajax({
      url: "http://localhost/Project-E/admin/data/news.php?func=up",
      method: "POST",
      cache: false,
      dataType: "",
      data: { id: id },
      success: function (data) {
        // console.log(data);
        $("#formUpNews").html(data);
        CKEDITOR.replace("editor-up");
        var prodFormContainer = prodForms[1].querySelector(
          ".news-form-container"
        );
        var prodFormClose = prodForms[1].querySelector(".news-form-close");
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

//Update news
function updateNews(e) {
  var id = $(e).attr("id");
  var contentData = CKEDITOR.instances["editor-up"].getData();
  var formData = new FormData($("#formUpdateNews")[0]);
  formData.append("content", contentData);
  // console.log(id);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/news.php?func=upNews&id=" + id,
    data: formData,
    dataType: "json",
    method: "post",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      if (data.result == "success") {
        $(".table-body").html(data.html);
        $(".news-form-container").removeClass("open-form");
        $(".news-form-container").addClass("remove-form");
        setTimeout(() => {
          $(".news-form").css("display", "none");
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
    },
  });
}

function addNewsBtn() {
  var contentData = CKEDITOR.instances["editor-add"].getData();
  var formData = new FormData($("#formAddNews")[0]);
  formData.append("content", contentData);
  $.ajax({
    url: "http://localhost/Project-E/admin/data/news.php?func=addNews",
    data: formData,
    dataType: "json",
    method: "post",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      if (data.result == "success") {
        Swal.fire({
          icon: "success",
          title: "Thêm tin tức thành công!",
          showConfirmButton: false,
          timer: 1500,
        });

        $(".table-body").html(data.html);
        $(".news-form-container").removeClass("open-form");
        $(".news-form-container").addClass("remove-form");
        setTimeout(() => {
          $(".news-form").css("display", "none");
        }, 250);
        $('input[name="title"]').val("");
        $('input[type="file"]').val("");
        $(".show-image").css("display", "none");
        $('input[name="date"]').val("");
        $('input[name="hot"][value="1"]').prop("checked", true);
        CKEDITOR.instances["editor-add"].setData("");
      } else {
        Swal.fire({
          icon: "error",
          title: "Thêm tin tức thất bại!",
          text: "Vui lòng kiểm tra lại và điền đầy đủ thông tin!",
        });
      }
    },
    error: function () {
      Swal.fire({
        icon: "error",
        title: "Thêm tin tức thất bại!",
        text: "Vui lòng kiểm tra lại và điền đầy đủ thông tin!",
      });
    },
  });
}

function deleteNews(e) {
  var id = $(e).attr("value");
  // console.log(id);
  Swal.fire({
    title: "Bạn có chắc muốn xóa?",
    text: "Bạn sẽ không thể khôi phục lại tin tức này!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url:
          "http://localhost/Project-E/admin/data/news.php?func=delNews&id=" +
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
