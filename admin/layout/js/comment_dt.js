function delCmt(e) {
  Swal.fire({
    title: "Bạn có chắc chắn muốn xóa bình luận này?",
    text: "Bạn sẽ không thể khôi phục lại bình luận này!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Xóa",
    cancelButtonText: "Hủy",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(e).attr("id");
      $.ajax({
        url:
          "http://localhost/Project-E/admin/data/comment.php?func=del&id=" + id,
        method: "POST",
        dataType: "json",
        cache: false,
        success: function (data) {
          // console.log(data);
          if (data.result == "success") {
            Swal.fire({
              icon: "success",
              title: "Xóa thành công",
              showConfirmButton: false,
              timer: 1500,
            });
            $(e).parent().parent().parent().remove();
          } else {
            Swal.fire({
              icon: "error",
              title: "Xóa thất bại",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
      });
    }
  });
}
