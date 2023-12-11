// open form add
var cataAdd = document.querySelector(".category-add");

var cataForms = document.querySelectorAll(".category-form");
if (cataForms[0]) {
  function openForm() {
    var cataFormContainer = cataForms[0].querySelector(
      ".category-form-container"
    );
    cataFormContainer.classList.remove("remove-form");
    cataForms[0].style.display = "block";
    cataFormContainer.classList.add("open-form");
  }
  cataAdd.addEventListener("click", openForm);
}

// close the form
cataForms.forEach((cataForm) => {
  var cataFormContainer = cataForm.querySelector(".category-form-container");
  var cataFormClose = cataForm.querySelector(".category-form-close");
  function closeForm() {
    cataFormContainer.classList.remove("open-form");
    cataFormContainer.classList.add("remove-form");
    setTimeout(() => {
      cataForm.style.display = "none";
    }, 250);
  }
  cataFormClose.addEventListener("click", closeForm);
  cataForm.addEventListener("click", (e) => {
    if (e.target == cataForm) {
      closeForm();
    }
  });
});

// show
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/category.php?func=show",
    dataType: "json",
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      // console.log(data);
      $(".category-form-show").html("");
      for (i = 0; i < data.length; i++) {
        category = data[i];
        if (category["hidden"] == 1) {
          hide = "checked";
        } else {
          hide = "";
        }
        var lt_str = `<tr>
                      <td> <span>${category["name"]}</span></td>
                      <td>
                        <input type="checkbox" id="${category["id"]}" class="switch-input" name="hidden" ${hide} onchange="upStatus(this)"/>
                        <label for="${category["id"]}" class="switch"></label>
                      </td>
                      <td> <a class="category-action category-update" href="#" category_id="${category["id"]}" onclick="upID(this)">
                          <ion-icon name="create-outline"></ion-icon></a><span>|</span><a class="category-action category-remove" category_id="${category["id"]}" onclick=delID(this) href="#">
                          <ion-icon name="trash-outline"></ion-icon></a></td>
                    </tr>`;
        $(".category-form-show").append(lt_str);
      }
    },
  });
});

// add
$(".btnAddCategory").click(categoryAdd);
$("#formAddCategory").on("keypress", function (e) {
  if (e.which === 13) {
    e.preventDefault();
    categoryAdd();
  }
});
function categoryAdd() {
  var url = "http://localhost/Project-E/admin/data/category.php?func=add";
  $.ajax({
    url: url,
    data: $("#formAddCategory").serialize(),
    dataType: "json",
    method: "post",
    cache: false,
    success: function (data) {
      // console.log(data);

      if (data.result == "success") {
        // Close form
        $(".category-form-container").removeClass("open-form");
        $(".category-form-container").addClass("remove-form");
        setTimeout(() => {
          $(".category-form").css("display", "none");
        }, 250);
        // Show alert
        Swal.fire({
          icon: "success",
          title: "Thêm thành công!",
          showConfirmButton: false,
          timer: 1500,
        });
        // Reset form
        $("#category_add").val("");
        // Load data
        $.ajax({
          url: "http://localhost/Project-E/admin/data/category.php?func=show",
          dataType: "json",
          cache: false,
          success: function (data) {
            // console.log(data);
            $(".category-form-show").html("");
            for (i = 0; i < data.length; i++) {
              category = data[i];
              if (category["hidden"] == 1) {
                hide = "checked";
              } else {
                hide = "";
              }
              var lt_str = `<tr>
                              <td> <span>${category["name"]}</span></td>
                              <td>
                                <input type="checkbox" id="${category["id"]}" class="switch-input" name="hidden" ${hide} onchange="upStatus(this)"/>
                                <label for="${category["id"]}" class="switch" ></label>
                              </td>
                              <td> <a class="category-action category-update" href="#" category_id="${category["id"]}" onclick="upID(this)">
                                  <ion-icon name="create-outline"></ion-icon></a><span>|</span><a class="category-action category-remove" category_id="${category["id"]}" onclick=delID(this) href="#">
                                  <ion-icon name="trash-outline"></ion-icon></a></td>
                            </tr>`;
              $(".category-form-show").append(lt_str);
            }
          },
        });
      } else if (data.result == "null") {
        Swal.fire({
          icon: "error",
          title: "Thêm thất bại!",
          text: "Vui lòng nhập tên danh mục.",
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Thêm thất bại!",
          text: "Có lẽ bạn đã thêm trùng tên danh mục.",
        });
      }
    },
  });
}

// xoa
function delID(obj) {
  var category_id = obj.getAttribute("category_id");
  var url =
    "http://localhost/Project-E/admin/data/category.php?func=del&id=" +
    category_id;
  $.ajax({
    url: url,
    dataType: "json",
    method: "post",
    cache: false,
    success: function (data) {
      // console.log(data);
      if (data.result == "success") {
        obj.parentNode.parentNode.remove();
        Swal.fire({
          icon: "success",
          title: "Xóa thành công!",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Xóa thất bại!",
          text: "Có lỗi xảy ra khi xóa danh mục.",
        });
      }
    },
    error: function (data) {
      // data = JSON.parse(data);
      Swal.fire({
        icon: "error",
        title: "Xóa thất bại!",
        text: "Tồn tại sản phẩm thuộc danh mục này.",
      });
    },
  });
}

// open form up and up
if (cataForms[1]) {
  function upID(obj) {
    var cataFormContainer = cataForms[1].querySelector(
      ".category-form-container"
    );
    cataFormContainer.classList.remove("remove-form");
    cataForms[1].style.display = "block";
    cataFormContainer.classList.add("open-form");
    var category_id = obj.getAttribute("category_id");
    var category_name =
      obj.parentNode.parentNode.querySelector("span").textContent;
    var category_input = cataForms[1].querySelector("#category_up");
    var category_button = cataForms[1].querySelector("#btnUpCategory");
    // console.log(category_button);
    category_input.value = category_name;
    category_button.setAttribute("value", category_id);
  }
  $("#formUpCategory").on("keypress", function (e) {
    if (e.which === 13) {
      e.preventDefault();
      // categoryUp(e);
    }
  });
  function categoryUp(e) {
    var category_id = e.getAttribute("value");
    var url =
      "http://localhost/Project-E/admin/data/category.php?func=up&id=" +
      category_id;
    $.ajax({
      url: url,
      data: $("#formUpCategory").serialize(),
      // dataType: "json",
      method: "post",
      cache: false,
      success: function (data) {
        data = JSON.parse(data);
        // console.log(data);
        if (data.result == "success") {
          // Close form
          $(".category-form-container").removeClass("open-form");
          $(".category-form-container").addClass("remove-form");
          setTimeout(() => {
            $(".category-form").css("display", "none");
          }, 250);
          // Show alert
          Swal.fire({
            icon: "success",
            title: "Chỉnh sửa thành công!",
            showConfirmButton: false,
            timer: 1500,
          });
          // Reset form
          $("#category_add").val("");
          // Load data
          $.ajax({
            url: "http://localhost/Project-E/admin/data/category.php?func=show",
            dataType: "json",
            cache: false,
            success: function (data) {
              // console.log(data);
              $(".category-form-show").html("");
              for (i = 0; i < data.length; i++) {
                category = data[i];
                if (category["hidden"] == 1) {
                  hide = "checked";
                } else {
                  hide = "";
                }
                var lt_str = `<tr>
                            <td> <span>${category["name"]}</span></td>
                            <td>
                              <input type="checkbox" id="${category["id"]}" class="switch-input" name="hidden" ${hide} onchange="upStatus(this)"/>
                              <label for="${category["id"]}" class="switch" ></label>
                              </td>
                              <td> <a class="category-action category-update" href="#" category_id="${category["id"]}" onclick="upID(this)">
                              <ion-icon name="create-outline"></ion-icon></a><span>|</span><a class="category-action category-remove" category_id="${category["id"]}" onclick=delID(this) href="#">
                              <ion-icon name="trash-outline"></ion-icon></a></td>
                              </tr>`;
                $(".category-form-show").append(lt_str);
              }
            },
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Chỉnh sửa thất bại!",
            text: "Có lẽ bạn đã thêm trùng tên danh mục.",
          });
        }
      },
    });
  }
}

// up status
function upStatus(obj) {
  var category_id = obj.getAttribute("id");
  var url =
    "http://localhost/Project-E/admin/data/category.php?func=upStatus&id=" +
    category_id;
  $.ajax({
    url: url,
    data: { hidden: obj.checked },
    method: "post",
    cache: false,
    success: function (data) {
      data = JSON.parse(data);
      // console.log(data);
      if (data.result == "success") {
        Swal.fire({
          icon: "success",
          title: "Thay đổi thành công!",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Thay đổi thất bại!",
          text: "Có lỗi xảy ra khi thay đổi trạng thái.",
        });
      }
    },
    error: function (error) {
      console.error("Error updating status:", error);
    },
  });
}
