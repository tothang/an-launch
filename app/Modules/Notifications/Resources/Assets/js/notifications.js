$(function () {
  $(".btn-delete").click(function(){
    if (!confirm("Are you sure you want to delete this notification ?")){
      return false;
    }
  });
});
