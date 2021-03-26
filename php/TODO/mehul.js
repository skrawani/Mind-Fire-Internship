function calculateTotalPrice() {
  let price = document.getElementById("price").value;
  let qty = document.getElementById("qty").value;
  document.getElementById("totalprice").innerHTML =
    parseFloat(price) * parseInt(qty);
  return false;
}
