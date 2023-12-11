var username = document.getElementById("username");
var password = document.getElementById("password");

// kiểm lỗi form
function validate() {
  if (username.value == "") {
    alert("Vui lòng nhập tên đăng nhập");
    username.focus();
    return false;
  }
  if (password.value == "") {
    alert("Vui lòng nhập mật khẩu");
    password.focus();
    return false;
  }
  return true;
}
