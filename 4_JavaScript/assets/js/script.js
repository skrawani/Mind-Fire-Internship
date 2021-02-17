// All Prices of products
const prices = {
  books: 250,
  furnitures: 500,
  appliances: 300,
};

// Cart Object with charges + Qty of Products in cart
var cart = {
  products: {
    books: 0,
    furnitures: 0,
    appliances: 0,
  },
  cost: 0,
  charges: 0,
  total: 0,
};

// increment function to increment qty of a product
const increment = (value) => {
  // increment
  cart.products[value] += 1;
  //   update qty in html
  document.getElementsByClassName(`qty ${value}`)[0].innerHTML =
    cart.products[value];
  // update amount in html
  document.getElementsByClassName(`amount ${value}`)[0].innerHTML =
    cart.products[value] * prices[value];
  // call updateCart function to update Cart values
  updateCart();
};
// decrement function to increment qty of a product
const decrement = (value) => {
  cart.products[value] =
    cart.products[value] === 0 ? 0 : cart.products[value] - 1;
  document.getElementsByClassName(`qty ${value}`)[0].innerHTML =
    cart.products[value];
  document.getElementsByClassName(`amount ${value}`)[0].innerHTML =
    cart.products[value] * prices[value];
  updateCart();
};

// Update Values in cart displayed in html
const updateCart = () => {
  var cost = 0;
  var qty = 0;
  var charges = 0;
  for (const c in cart.products) {
    qty += cart.products[c];
    cost += cart.products[c] * prices[c];
  }
  if (cost >= 1000 || qty == 0) charges = 0;
  else if (qty === 1) charges = 50;
  else charges = 25;

  document.getElementById("mrp").innerHTML = cost;
  document.getElementById("charges").innerHTML = charges;
  document.getElementById("amount").innerHTML = cost + charges;
};
