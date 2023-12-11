<?php
include_once('../../model/pdo.php');
include_once('../../model/user.php');
session_start();
ob_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $admin = user_select_by_username($username);

  if ($admin['password'] == $password) {
    if ($admin['status'] == 0) {
      echo '<script>
              alert("Tài khoản của bạn đã bị khóa!");
              window.location.href = "login.php";
            </script>';
    } else if ($admin['role'] == 0) {
      echo '<script>
              alert("Bạn không có quyền truy cập vào trang này!");
              window.location.href = "../../index.php";
            </script>';
    } else {
      $_SESSION['admin'] = $admin;
      header("location: ../index.php");
    }
  } else {
    echo '<script>
            alert("Sai tên đăng nhập hoặc mật khẩu!");
            window.location.href = "login.php";
          </script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500&amp;display=swap" rel="stylesheet">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/40.0.0/ckeditor.min.js" integrity="sha512-Zyl/SvrviD3rEMVNCPN+m5zV0PofJYlGHnLDzol2kM224QpmWj9p5z7hQYppmnLFhZwqif5Fugjjouuk5l1lgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../layout/js/app.js"> </script>
  <link rel="stylesheet" href="../layout/css/app.css">
  <link rel="stylesheet" href="../layout/css/login.css">
</head>

<body>
  <header class="header">
    <div class="header-image"> <img srcSet="../layout/images/logo.png 2x" alt="logo"></div>
  </header>
  <div class="login">
    <div class="login-header">
      <h3 class="title">Đăng nhập</h3>
    </div>
    <div class="login-container">
      <form id="form-login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return validate()">
        <div class="form-group">
          <label for="username">Tên đăng nhập:</label>
          <input class="form-control" id="username" type="text" name="username" placeholder="Nhập tên người dùng của bạn">
        </div>
        <div class="form-group">
          <label for="password">Mật khẩu:</label>
          <input class="form-control" id="password" type="password" name="password" placeholder="Nhập mật khẩu của bạn">
        </div>
        <button class="button" type="submit" name="login">Đăng nhập</button>
      </form>
    </div>
  </div>
  <footer class="footer">
    <div class="footer-copyright">
      <p>© 2023. Mọi bản quyền được bảo lưu.</p>
    </div>
    <div class="footer-brand">
      <span>Chấp nhận cho</span>
      <div class="footer-item"><img srcset="../layout/images/footer-1.png 2x" alt="brand"></div>
      <div class="footer-item"><img srcset="../layout/images/footer-2.png 2x" alt="brand"></div>
      <div class="footer-item"><img srcset="../layout/images/footer-3.png 2x" alt="brand"></div>
      <div class="footer-item"><img srcset="../layout/images/footer-4.png 2x" alt="brand"></div>
    </div>
  </footer>
  <script src="../layout/js/login.js"> </script>
</body>

</html>