$(document).ready(function () {
  $(".accordion div").click(function () {
    var id = this.id;
    $(`#${id} p`).toggle("fast");
  });
});
