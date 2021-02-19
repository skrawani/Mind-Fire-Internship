$(document).ready(function () {
  $(".accordion div h5").click(function () {
    $(`#${this.id} ~  p`).toggle("fast");
  });
});
