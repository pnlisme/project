// Chart
var xValues = [
  "Tháng 1",
  "Tháng 2",
  "Tháng 3",
  "Tháng 4",
  "Tháng 5",
  "Tháng 6",
  "Tháng 7",
  "Tháng 8",
  "Tháng 9",
  "Tháng 10",
  "Tháng 11",
  "Tháng 12",
];
var yValues = [55, 49, 44, 24, 15, 12, 35, 90, 100, 120, 150, 200];
var barColors = "#3577F0";

var chart = new Chart("chartStatistic", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [
      {
        backgroundColor: barColors,
        data: yValues,
      },
    ],
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "Biểu đồ doanh thu trong năm 2023",
      fontFamily: "Plus Jakarta Sans, sans-serif",
      fontSize: 20,
      fontStyle: "italic",
      fontWeight: "400",
    },
  },
});

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
