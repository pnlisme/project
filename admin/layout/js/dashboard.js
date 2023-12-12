// Statistic
var statisticList = document.querySelectorAll(".statistic-content");
statisticList.forEach((statisticItem) => {
  statisticItem.addEventListener("click", function () {
    // this.classList.toggle("active");
    var statisticIcon = this.querySelector(".statistic-icon");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
      statisticIcon.style.rotate = "0deg";
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
      statisticIcon.style.rotate = "90deg";
    }
  });
});
