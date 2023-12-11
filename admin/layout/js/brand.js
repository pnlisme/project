// open form add
var cataAdd = document.querySelector(".brand-add");

var cataForms = document.querySelectorAll(".brand-form");
if (cataForms[0]) {
  function openForm() {
    var cataFormContainer = cataForms[0].querySelector(".brand-form-container");
    cataFormContainer.classList.remove("remove-form");
    cataForms[0].style.display = "block";
    cataFormContainer.classList.add("open-form");
  }
  cataAdd.addEventListener("click", openForm);
}

// close the form
cataForms.forEach((cataForm) => {
  var cataFormContainer = cataForm.querySelector(".brand-form-container");
  var cataFormClose = cataForm.querySelector(".brand-form-close");
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
    url: "http://localhost/Project-E/admin/data/brand.php?func=show",
    dataType: "json",
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      // console.log(data);
      $(".brand-form-show").html("");
      for (i = 0; i < data.length; i++) {
        brand = data[i];
        if (brand["hidden"] == 1) {
          hide = "checked";
        } else {
          hide = "";
        }
        var lt_str = `<tr>
                      <td> <span>${brand["name"]}</span></td>
                      <td>
                        <input type="checkbox" id="${brand["id"]}" class="switch-input" name="hidden" ${hide} onchange="upStatus(this)"/>
                        <label for="${brand["id"]}" class="switch"></label>
                      </td>
                      <td> <a class="brand-action brand-update" href="#" brand_id="${brand["id"]}" onclick="upID(this)">
                          <ion-icon name="create-outline"></ion-icon></a><span>|</span><a class="brand-action brand-remove" brand_id="${brand["id"]}" onclick=delID(this) href="#">
                          <ion-icon name="trash-outline"></ion-icon></a></td>
                    </tr>`;
        $(".brand-form-show").append(lt_str);
      }
    },
  });
});

// add
$(".btnAddbrand").click(brandAdd);
$("#formAddbrand").on("keypress", function (e) {
  if (e.which === 13) {
    e.preventDefault();
    brandAdd();
  }
});
function brandAdd() {
  var url = "http://localhost/Project-E/admin/data/brand.php?func=add";
  $.ajax({
    url: url,
    data: $("#formAddbrand").serialize(),
    // dataType: 'json',
    method: "post",
    cache: false,
    success: function (data) {
      data = JSON.parse(data);
      // console.log(data);

      if (data.result == "success") {
        // Close form
        $(".brand-form-container").removeClass("open-form");
        $(".brand-form-container").addClass("remove-form");
        setTimeout(() => {
          $(".brand-form").css("display", "none");
        }, 250);
        // Show alert
        Swal.fire({
          icon: "success",
          title: "Thêm thành công!",
          showConfirmButton: false,
          timer: 1500,
        });
        // Reset form
        $("#brand_add").val("");
        // Load data
        $.ajax({
          url: "http://localhost/Project-E/admin/data/brand.php?func=show",
          dataType: "json",
          cache: false,
          success: function (data) {
            // console.log(data);
            $(".brand-form-show").html("");
            for (i = 0; i < data.length; i++) {
              brand = data[i];
              if (brand["hidden"] == 1) {
                hide = "checked";
              } else {
                hide = "";
              }
              var lt_str = `<tr>
                              <td> <span>${brand["name"]}</span></td>
                              <td>
                                <input type="checkbox" id="${brand["id"]}" class="switch-input" name="hidden" ${hide} onchange="upStatus(this)"/>
                                <label for="${brand["id"]}" class="switch" ></label>
                              </td>
                              <td> <a class="brand-action brand-update" href="#" brand_id="${brand["id"]}" onclick="upID(this)">
                                  <ion-icon name="create-outline"></ion-icon></a><span>|</span><a class="brand-action brand-remove" brand_id="${brand["id"]}" onclick=delID(this) href="#">
                                  <ion-icon name="trash-outline"></ion-icon></a></td>
                            </tr>`;
              $(".brand-form-show").append(lt_str);
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
          text: "Có lẽ bạn đã thêm trùng tên thương hiệu.",
        });
      }
    },
  });
}

// xoa
function delID(obj) {
  var brand_id = obj.getAttribute("brand_id");
  var url =
    "http://localhost/Project-E/admin/data/brand.php?func=del&id=" + brand_id;
  $.ajax({
    url: url,
    method: "post",
    cache: false,
    success: function (data) {
      data = JSON.parse(data);
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
          text: "Có lỗi xảy ra khi xóa thương hiệu.",
        });
      }
    },
    error: function (data) {
      // data = JSON.parse(data);
      Swal.fire({
        icon: "error",
        title: "Xóa thất bại!",
        text: "Tồn tại sản phẩm thuộc thương hiệu này.",
      });
    },
  });
}

// open form up and up
if (cataForms[1]) {
  function upID(obj) {
    var cataFormContainer = cataForms[1].querySelector(".brand-form-container");
    cataFormContainer.classList.remove("remove-form");
    cataForms[1].style.display = "block";
    cataFormContainer.classList.add("open-form");
    var brand_id = obj.getAttribute("brand_id");
    var brand_name =
      obj.parentNode.parentNode.querySelector("span").textContent;
    var brand_input = cataForms[1].querySelector("#brand_up");
    var brand_button = cataForms[1].querySelector("#btnUpbrand");
    brand_input.value = brand_name;
    brand_button.setAttribute("value", brand_id);
  }
  $("#formUpbrand").on("keypress", function (e) {
    if (e.which === 13) {
      e.preventDefault();
      // brandUp(e);
    }
  });
  function brandUp(e) {
    var brand_id = e.getAttribute("value");
    var url =
      "http://localhost/Project-E/admin/data/brand.php?func=up&id=" + brand_id;
    $.ajax({
      url: url,
      data: $("#formUpbrand").serialize(),
      // dataType: "json",
      method: "post",
      cache: false,
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        if (data.result == "success") {
          // Close form
          $(".brand-form-container").removeClass("open-form");
          $(".brand-form-container").addClass("remove-form");
          setTimeout(() => {
            $(".brand-form").css("display", "none");
          }, 250);
          // Show alert
          Swal.fire({
            icon: "success",
            title: "Chỉnh sửa thành công!",
            showConfirmButton: false,
            timer: 1500,
          });
          // Reset form
          $("#brand_add").val("");
          // Load data
          $.ajax({
            url: "http://localhost/Project-E/admin/data/brand.php?func=show",
            dataType: "json",
            cache: false,
            success: function (data) {
              // console.log(data);
              $(".brand-form-show").html("");
              for (i = 0; i < data.length; i++) {
                brand = data[i];
                if (brand["hidden"] == 1) {
                  hide = "checked";
                } else {
                  hide = "";
                }
                var lt_str = `<tr>
                            <td> <span>${brand["name"]}</span></td>
                            <td>
                              <input type="checkbox" id="${brand["id"]}" class="switch-input" name="hidden" ${hide} onchange="upStatus(this)"/>
                              <label for="${brand["id"]}" class="switch" ></label>
                              </td>
                              <td> <a class="brand-action brand-update" href="#" brand_id="${brand["id"]}" onclick="upID(this)">
                              <ion-icon name="create-outline"></ion-icon></a><span>|</span><a class="brand-action brand-remove" brand_id="${brand["id"]}" onclick=delID(this) href="#">
                              <ion-icon name="trash-outline"></ion-icon></a></td>
                              </tr>`;
                $(".brand-form-show").append(lt_str);
              }
            },
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Chỉnh sửa thất bại!",
            text: "Có lẽ bạn đã thêm trùng tên thương hiệu.",
          });
        }
      },
    });
  }
}

// up status
function upStatus(obj) {
  var brand_id = obj.getAttribute("id");
  var url =
    "http://localhost/Project-E/admin/data/brand.php?func=upStatus&id=" +
    brand_id;
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
