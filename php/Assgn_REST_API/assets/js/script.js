// Function to Convert Address to Latitude and Logitude and then find Elevation of the Address
const handleSubmit = async () => {
  let addr = document.getElementById("addr");
  try {
    let geocodeApi = await fetch(
      `http://www.mapquestapi.com/geocoding/v1/address?key=${apiKeys.maps}&location=${addr.value}`
    );
    let geocodeResp = await geocodeApi.json();
    let latLng = geocodeResp.results[0].locations[0].latLng;
    let elevationApi = await fetch(
      `http://open.mapquestapi.com/elevation/v1/profile?key=${apiKeys.maps}&shapeFormat=raw&latLngCollection=${latLng.lat},${latLng.lng}`
    );
    let elevationResp = await elevationApi.json();
    let elevation = elevationResp.elevationProfile[0].height;
    document.getElementById("res").classList.remove("d-none");
    document.getElementById("elev").innerHTML = elevation;
  } catch (error) {
    console.log(error);
  }
};
