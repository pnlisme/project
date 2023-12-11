// Load table comment
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/comment.php?func=show",
    method: "POST",
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data.html);
    },
  });
});

function loadCommentsInPage(e) {
  var page = $(e).val();
  $.ajax({
    url: "http://localhost/Project-E/admin/data/comment.php?func=show",
    method: "POST",
    dataType: "json",
    data: { page: page },
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-body").html(data.html);
    },
  });
}

// show page index
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/Project-E/admin/data/comment.php?func=page",
    method: "POST",
    dataType: "json",
    cache: false,
    success: function (data) {
      // console.log(data);
      $(".table-page").html(data.html);
    },
  });
});
