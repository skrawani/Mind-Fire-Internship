// for Drap And Drop
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

async function drop(ev) {
  ev.preventDefault();

  var data = ev.dataTransfer.getData("text");
  var link = document.getElementById(data).getAttribute("href");
  // console.log(link);

  // check if browser Supports local Storage
  if (typeof Storage !== "undefined") {
    // Store
    var lat = localStorage.getItem("lat");
    var lng = localStorage.getItem("lng");

    // check if lattitude  and longitude is present in Local Storage of not
    if (!lng || !lng) {
      var status = await navigator.permissions.query({
        name: "geolocation",
      });

      console.log(status, "A");
      // Check if Permission for location is denied
      if (status.state === "denied") {
        alert("Please Allow Location Permission");
      } else {
        alert("please wait Locations is being fetched..");
      }
      return;
    }

    var addr = link + "?q=" + lat + "," + lng;
    window.location.href = addr;
  } else {
    alert("Sorry, your browser does not support Web Storage...");
  }
  document.getElementById(data).style.display = "none";
}
