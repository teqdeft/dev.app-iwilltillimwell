<!DOCTYPE html>
<html>
<head>
  <title>Urgent Care Finder</title>
  <style>
    #map {
      height: 400px;
      width: 100%;
      display: none;
      margin-top: 10px;
    }
  </style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnxBLm9Xmwe7r6LIZ-RrZw8LrsrAtI5sY&libraries=places" async defer></script>

</head>

<body>



<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapModal">
  Find Urgent Care Near Me
</button>

<div class="modal fade" id="mapModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Nearby Urgent Care</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div id="map" style="height:400px;"></div>
      </div>

    </div>
  </div>
</div>



<script>
let map;
let service;
let infowindow;
let userLocation;
let markers = [];
let mapInitialized = false;

// When modal opens
document.getElementById('mapModal').addEventListener('shown.bs.modal', function () {

  if (!mapInitialized) {
    initMap();
    mapInitialized = true;
  }

  getUserLocation();
});

// Init map
function initMap() {
  const defaultLocation = { lat: 45.5152, lng: -122.6784 };

  map = new google.maps.Map(document.getElementById("map"), {
    center: defaultLocation,
    zoom: 13,
  });

  infowindow = new google.maps.InfoWindow();
}

// Get user location
function getUserLocation() {

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {

        userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        map.setCenter(userLocation);

        // User marker
        new google.maps.Marker({
          position: userLocation,
          map: map,
          title: "You are here",
          icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
        });

        // Fix modal hidden map issue
        setTimeout(() => {
          google.maps.event.trigger(map, "resize");
        }, 300);

        findUrgentCare();

      },
      () => {
        alert("Location permission denied.");
      }
    );
  }
}

// Find urgent care
function findUrgentCare() {

  clearMarkers();

  const request = {
    location: userLocation,
    radius: 5000,
    keyword: "urgent care"
  };

  service = new google.maps.places.PlacesService(map);

  service.nearbySearch(request, function(results, status) {

    if (status === google.maps.places.PlacesServiceStatus.OK) {

      results.forEach(place => {
        createMarker(place);
      });

    }
  });
}

// Create marker
function createMarker(place) {

  const marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location,
  });

  markers.push(marker);

  google.maps.event.addListener(marker, "click", function() {
    infowindow.setContent(`
      <strong>${place.name}</strong><br>
      ${place.vicinity}
    `);
    infowindow.open(map, this);
  });
}

// Clear markers
function clearMarkers() {
  markers.forEach(marker => marker.setMap(null));
  markers = [];
}
</script>


<?php /*
<button id="findBtn" onclick="startSearch()">Find Urgent Care Near Me</button>

<div id="map"></div>

<script>
let map;
let service;
let infowindow;
let userLocation;
let markers = [];
let mapInitialized = false;

// ✅ AUTO LOAD IF ALREADY ALLOWED
window.onload = function () {
  if (localStorage.getItem("locationAllowed") === "true") {
    startSearch(true); // auto run
  }
};

// Step 1: Button Click OR Auto
function startSearch(auto = false) {

  document.getElementById("map").style.display = "block";

  if (!mapInitialized) {
    initMap();
    mapInitialized = true;
  }

  getUserLocation(auto);
}

// Step 2: Init Map
function initMap() {
  const defaultLocation = { lat: 45.5152, lng: -122.6784 };

  map = new google.maps.Map(document.getElementById("map"), {
    center: defaultLocation,
    zoom: 13,
  });

  infowindow = new google.maps.InfoWindow();
}

// Step 3: Get User Location
function getUserLocation(auto) {

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {

        userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        // ✅ Save permission
        localStorage.setItem("locationAllowed", "true");

        map.setCenter(userLocation);

        // User marker
        new google.maps.Marker({
          position: userLocation,
          map: map,
          title: "You are here",
          icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
        });

        // Fix hidden map issue
        setTimeout(() => {
          google.maps.event.trigger(map, "resize");
        }, 300);

        findUrgentCare();

      },
      (error) => {
        if (!auto) {
          alert("Location permission denied.");
        }
        localStorage.removeItem("locationAllowed");
      }
    );
  }
}

// Step 4: Find Urgent Care
function findUrgentCare() {

  clearMarkers();

  const request = {
    location: userLocation,
    radius: 5000,
    keyword: "urgent care"
  };

  service = new google.maps.places.PlacesService(map);

  service.nearbySearch(request, function(results, status) {

    if (status === google.maps.places.PlacesServiceStatus.OK) {

      results.forEach(place => {
        createMarker(place);
      });

    }
  });
}

// Step 5: Marker
function createMarker(place) {
  const marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location,
  });

  markers.push(marker);

  google.maps.event.addListener(marker, "click", function() {
    infowindow.setContent(`
      <strong>${place.name}</strong><br>
      ${place.vicinity}
    `);
    infowindow.open(map, this);
  });
}

// Step 6: Clear markers
function clearMarkers() {
  markers.forEach(marker => marker.setMap(null));
  markers = [];
}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnxBLm9Xmwe7r6LIZ-RrZw8LrsrAtI5sY&libraries=places&callback=initMap" async defer></script>

</body>
</html>

*/ ?>