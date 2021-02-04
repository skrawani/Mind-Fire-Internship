// for Geolocation
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(storePosition);
  } else {
    alert("Geolocation is not supported by this browser");
  }
}

function storePosition(position) {
  if (typeof Storage !== "undefined") {
    // Store
    localStorage.setItem("lat", position.coords.latitude);
    localStorage.setItem("lng", position.coords.longitude);
  } else {
    alert("Sorry, your browser does not support Web Storage...");
  }
  // console.log(position.coords.latitude, position.coords.longitude);
}
document.body.onload = function () {
  getLocation();
};
