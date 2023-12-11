// Khi cuộn trang
window.onscroll = function () {
  scrollFunction();
};
function scrollFunction() {
  var wrapper = document.getElementById("wrapper");
  var sidebar = document.getElementById("sidebar");
  // Nếu vị trí scroll lên hơn 10px, ẩn thanh header
  if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
    wrapper.classList.add("wrapper-hide-head");
  } else {
    // Nếu scroll xuống đủ ít, hiển thị lại thanh header
    wrapper.classList.remove("wrapper-hide-head");
  }
}
