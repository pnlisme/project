<head>
  <link rel="stylesheet" href="./layout/css/news.css">
</head>
<main class="main">
  <h1 class="title">Tin tức</h1>
  <div class="filter">
    <div class="filter-select">
      <!-- filter -->
    </div>
    <div class="filter-search">
      <input id="filter-search" type="text" placeholder="Nhập từ khoá" onkeyup="loadNewsInInput(this)" />
    </div>
  </div>
  <div class="table-container">
    <table class="news table">
      <thead class="table-head">
        <tr>
          <th>
            <ion-icon name="image-outline"></ion-icon>
          </th>
          <th>Tiêu đề</th>
          <th>Thời gian</th>
          <th>Người đăng</th>
          <th>Hàng động</th>
        </tr>
      </thead>
      <tbody class="table-body" id="show-news-in-table-body">
        <!-- show news in table body -->
      </tbody>
    </table>
  </div>
  <button class="table-button button news-add">
    <p>Thêm tin tức</p>
  </button>
  <div class="table-page">
    <!-- show page index -->
  </div>
  <form action="#" onsubmit="return false" id="formAddNews" enctype="multipart/form-data">
    <div class=" news-form">
      <div class="news-form-container">
        <h2 class="sub-title news-form-title">Thêm mới tin tức</h2><a class="news-form-close" href="#">
          <ion-icon name="close-circle-outline"></ion-icon></a>
        <div class="news-form-content">
          <label>Hình ảnh tin tức:</label>
          <input class="news-form-input" name="img" type="file" onchange="loadImgInputAdd(this)">
          <div class="show-image">
            <img id="news-img-show" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" alt="news-image">
            <div class="remove-img" onclick="removeImgInputAdd(this)"><ion-icon name="trash-outline"></ion-icon></div>
          </div>
          <label>Tiêu đề tin tức:</label>
          <input class="news-form-input" name="title" type="text" placeholder="Nhập tên tin tức">
          <label for="date">Ngày đăng:</label>
          <input type="text" name="date" placeholder="Ngày đăng tin:">
          <label>Nổi bật:</label>
          <div class="news-form-radio-container">
            <div>
              <input type="radio" name="hot" id="hot-y" value="1" checked>
              <label for="hot-y">Có!</label>
            </div>
            <div>
              <input type="radio" name="hot" id="hot-n" value="0">
              <label for="hot-n">Không!</label>
            </div>
          </div>
          <label>Mô tả:</label>
          <input class="news-form-input" name="short" type="text" placeholder="Mô tả tin tức">
          <label>Bài đăng chi tiết:</label><textarea id="editor-add" name="content"></textarea>
          <input type="hidden" name="id_user" value="<?= $_SESSION['admin']['id'] ?>">
          <button class="news-form-button button" type="submit" onclick="addNewsBtn()">Thêm tin tức</button>
        </div>
      </div>
    </div>
  </form>
  <form action="#" onsubmit="return false" id="formUpdateNews" enctype="multipart/form-data">
    <div class=" news-form">
      <div id="formUpNews" class="news-form-container">
        <!-- show form update news -->
      </div>
    </div>
  </form>
</main>
<script src="./layout/js/news.js"></script>