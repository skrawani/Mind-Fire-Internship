//  Multi Select
/*for without holding ctrl/command key*/
$("select").selectpicker();

var array = [];
var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");

for (var i = 0; i < checkboxes.length; i++) {
  array.push(checkboxes[i].value);
}
