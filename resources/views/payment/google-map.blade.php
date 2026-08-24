<!DOCTYPE html>
<html>
<head>
<title>Urgent Care Finder</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnxBLm9Xmwe7r6LIZ-RrZw8LrsrAtI5sY&libraries=places&callback=initMap" async defer></script>

<style>
#urgent_care_finder_map {
  height: 400px;
  width: 100%;
  display: none; /* 👈 hidden by default */
}
</style>
</head>

<body>

<button class="btn btn-primary" data-type="urgent care" data-bs-toggle="modal" data-bs-target="#mapModal">
  Find Urgent Care Near Me
</button>

<button class="btn btn-danger" data-type="emergency" data-bs-toggle="modal" data-bs-target="#mapModal">
  Find Emergency Room Near Me
</button>



<div class="modal fade" id="mapModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Nearby Urgent Care</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <!-- Loader -->
        <div id="mapLoader" class="text-center">
          <div class="spinner-border text-primary"></div>
          <p>Fetching your location...</p>
        </div>

        <!-- Map -->
        <div id="urgent_care_finder_map"></div>

      </div>

    </div>
  </div>
</div>

<script>
let map, service, infowindow;
let userLocation;
let markers = [];
let mapReady = false;
let selectedSearchType = "urgent care";

document.getElementById('mapModal').addEventListener('show.bs.modal', function (event) {
  let button = event.relatedTarget;
  selectedSearchType = button.getAttribute("data-type");


  document.querySelector(".modal-title").innerText =
    selectedSearchType === "emergency"
      ? "Nearby Emergency Rooms"
      : "Nearby Urgent Care";


});


// INIT MAP
function initMap() {
  const defaultLocation = { lat: 45.5152, lng: -122.6784 };

  map = new google.maps.Map(document.getElementById("urgent_care_finder_map"), {
    center: defaultLocation,
    zoom: 13,
  });

  infowindow = new google.maps.InfoWindow();
  mapReady = true;
}

// MODAL OPEN
document.getElementById('mapModal').addEventListener('shown.bs.modal', function () {

  // Reset UI every time modal opens
  document.getElementById("urgent_care_finder_map").style.display = "none";
  document.getElementById("mapLoader").style.display = "block";
  document.getElementById("mapLoader").innerHTML = `
    <div class="spinner-border text-primary"></div>
    <p>Fetching your location...</p>
  `;

  if (!mapReady) return;

  setTimeout(() => {
    google.maps.event.trigger(map, "resize");
  }, 300);

  checkPermissionThenLocate();
});


// CHECK PERMISSION
function checkPermissionThenLocate() {

  if (!navigator.permissions) {
    getUserLocation();
    return;
  }

  navigator.permissions.query({ name: "geolocation" }).then((result) => {

    if (result.state === "denied") {
      showBlockedMessage();
    } else {
      getUserLocation();
    }

  });
}


// GET LOCATION
function getUserLocation() {

  navigator.geolocation.getCurrentPosition(

    (position) => {

      userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      // 👇 Show map, hide loader
      document.getElementById("urgent_care_finder_map").style.display = "block";
      document.getElementById("mapLoader").style.display = "none";

      setTimeout(() => {
        google.maps.event.trigger(map, "resize");
      }, 300);

      map.setCenter(userLocation);

      new google.maps.Marker({
        position: userLocation,
        map: map,
        title: "You are here",
        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
      });

      setTimeout(findUrgentCare, 500);
    },

    (error) => {

      if (error.code === error.PERMISSION_DENIED) {
        showBlockedMessage();
      } else {
        document.getElementById("mapLoader").innerHTML = `
          <p>Unable to fetch location.</p>
        `;
      }
    }
  );
}


// BLOCKED MESSAGE
function showBlockedMessage() {

  document.getElementById("urgent_care_finder_map").style.display = "none";
  document.getElementById("mapLoader").style.display = "block";

  document.getElementById("mapLoader").innerHTML = `
    <div class="text-center">
      <p><b>Location Access Blocked</b></p>
      <p>Please enable location permission in browser settings.</p>
      <button class="btn btn-sm btn-primary" onclick="openSettingsGuide()">How to Fix</button>
    </div>
  `;
}


// SETTINGS GUIDE
function openSettingsGuide() {
  alert("Go to browser settings → Site settings → Location → Allow this site");
}


// SEARCH PLACES
function findUrgentCare() {

  clearMarkers();

  service = new google.maps.places.PlacesService(map);

  const request = {
    location: userLocation,
    radius: 5000,
    keyword: selectedSearchType,
    type: "hospital"
  };

  console.log(selectedSearchType);

  service.nearbySearch(request, (results, status) => {

    if (status === google.maps.places.PlacesServiceStatus.OK) {
      results.forEach(createMarker);
    }
  });
}


// CREATE MARKER
function createMarker(place) {

  const marker = new google.maps.Marker({
    map,
    position: place.geometry.location,
  });

  markers.push(marker);

  marker.addListener("click", () => {
    infowindow.setContent(`
      <strong>${place.name}</strong><br>
      ${place.vicinity || ""}
    `);
    infowindow.open(map, marker);
  });
}


// CLEAR MARKERS
function clearMarkers() {
  markers.forEach(m => m.setMap(null));
  markers = [];
}
</script>

</body>
</html>