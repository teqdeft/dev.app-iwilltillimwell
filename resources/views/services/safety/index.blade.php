@extends('layouts.dashboard')
@section('content')
<div class="main-panel main-panel-for-modal-page">
<div class='content-wrapper'>
    <div class="card--white full-height">
        <div class='moodContainer safety-outer-wrapper'>
            <div class="card--white full-height safety-conent-wrap">
                

                <div class="cust-heading-wrap">
                    <h3 class="cust-heading cust-heading-view">SAFETY PLAN</h3>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs safety-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="plans-tab" data-bs-toggle="tab" data-bs-target="#plans"
                            type="button" role="tab" aria-controls="plans" aria-selected="true">Plan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Guide-tab" data-bs-toggle="tab" data-bs-target="#Guide"
                            type="button" role="tab" aria-controls="Guide" aria-selected="false">Guide</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Crisis-tab" data-bs-toggle="tab" data-bs-target="#Crisis"
                            type="button" role="tab" aria-controls="Crisis" aria-selected="false">Crisis</button>
                    </li>
                </ul>

                <!-- Tab panes -->

                <div class="tab-content safety-tab-content">

                    <div class="tab-pane active" id="plans" role="tabpanel" aria-labelledby="plans-tab">
                        <div class="safety-conent-inner">
                            <!-- <span>Press the ? icon in the upper right corner for instructions on how to fill out this safety plan.</span> -->
                            <div class="plans-row">
                                @if ( $safetyPlans )
                                    @foreach ($safetyPlans as $value )
                                        @if ( $value->type == 'plan' )
                                            <div class="plans-item">
										
											 <?php $datadb = getSafetyPlanData($value->title) ?>
                                                <i><img src="{{ config('app.IWILLTILL') }}/{{ $value->icon }}" alt=""></i>
                                                <div class="plans-content">
                                                    <h3 class="plans-heading"><?= ucfirst(html_entity_decode($value->title)) ?></h3>
                                                    <div class="mt-2"><?= ucfirst(html_entity_decode($value->description)) ?></div>

                                                    <div class="warning-signs-block plans-form-content">
                                                        <span><?= ucfirst(html_entity_decode($value->inner_description)) ?></span>
                                                        <h3><?= ucfirst(html_entity_decode($value->title)) ?></h3>
														
                                                    </div>
													
													<input type="hidden" value="<?php echo $datadb?>" class="db_content">
													
                                        
										
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="plans-guide-block">
                                <a href="javascript:void();" class="back-arrow emptyAllField"> Back</a>
                                <div class="warning-signs-block plans-form-content">

                                </div>

                                <form class="custom-saf-plans-form" id="custom-saf-plans-form" action="{{ url('my-safety-plan-save') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plan_type" id="safty_plan_type" value="">
                                    <div class="control-group">
                                        <div id="teamArea" class="controls custom-safe-field-control">
                                            
                                        </div>
                                        <div class="btn-box">
                                            <a id="addNewTeam" class="cust-dark-btn add-btn">Add another</a>
                                            <a id="removeLastTeam" style="display:none;"
                                                class="cust-dark-btn remove-btn">Remove
                                                Last</a>
                                        </div>

                                        <div class="btn-box custom-saf-plans-foot">
                                            <a class="cust-dark-btn cancel-safety-warning emptyAllField">Cancel</a>
                                            <input class="cust-dark-btn save-safety-warning" type="submit" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Guide" role="tabpanel" aria-labelledby="Guide-tab">
                        <div class="guide-content">
                            <div class="plans-row">
                                 @if ( $safetyPlans )									
                                 <?php $counter=1; ?>
                                    @foreach ($safetyPlans as $value )
                                        @if ( $value->type == 'guide' )
                                            <div class="plans-item">
                                                <i><img src="{{ config('app.IWILLTILL') }}/{{ $value->icon }}" alt=""></i>
                                                <div class="plans-content">
                                                    <h3 class="plans-heading">
													<?= ucfirst(html_entity_decode($value->title)) ?>
													</h3>
                                                </div>
                                                <div class="guide-detail-content">																									
                                                    @if($counter == 7)														
                                                    <div class="guide-moment-care-v1">																
                                                        @include('consultation.in-the-moment-care-form')														
                                                    </div>														
                                                    @else														 
                                                    <?= ucfirst(html_entity_decode($value->description)) ?>													
                                                    @endif
                                                </div>
                                            </div>											
                                            <?php $counter++; ?>
                                        @endif
                                    @endforeach
                                @endif
                            </div> 
                        </div>
                        <div class="guide-descrip-content ">
                            <a href="javascript:void();" class="back-arrow"> Back</a>
                            <h3></h3>
                            <div class="guide-dynamic-box">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Crisis" role="tabpanel" aria-labelledby="Crisis-tab">
                        <div class="crisis-call-box">
                            <div class="plans-row">
                                 @if ( $safetyPlans )
										 <?php $counter=1; ?>
                                    @foreach ($safetyPlans as $value )
                                        @if ( $value->type == 'crisis' )
                                            <div class="plans-item">

                                                
                                                
                                                <i><img src="{{ config('app.IWILLTILL') }}/{{ $value->icon }}" alt=""></i>
                                                <div class="plans-content">

                                                    <a 
													
                                                    {{-- Urgent care / emergency room now open Google Maps in a new tab,
                                                         the same way the other "near me" entries do. The old in-page
                                                         #mapModal never rendered its map. --}}
                                                    @if($value->id==14 || $value->id==13)

                                                        class="googleNearMe"
                                                        href="javascript:;"
                                                        data-link="https://www.google.com/maps/search/{{ urlencode(trim(strip_tags(html_entity_decode($value->title)))) }}"

													@elseif($counter==9)
														
														href="sms:741741?body=The Trevor Project Text ( LGBTQ )"
													
													@elseif( !empty( $value->number ) && str_contains($value->number,'tel:') !== true )
                                                         class="googleNearMe" href="javascript:;" data-link="<?= $value->number ?>" @else class="healthPhone" href="javascript:;" data-call="<?= $value->number ?>"
                                                    @endif >
                                                    
                                                    <h3 class="plans-heading"><?= html_entity_decode($value->title) ?></h3>
                                                
                                                </a>
                                                </div>
                                            </div>
											<?php $counter++; ?>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal modal-safetyPhoneCenter fade safty-plan-call-model" id="safetyPhoneCenter" tabindex="-1" role="dialog" aria-labelledby="safetyPhoneCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>

            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary" id="callPopup" >Call</a>
            </div>
            </div>
        </div>
</div>


<div class="modal fade safety_map_modal" id="mapModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"> 


  <div class="modal-dialog modal-dialog-centered">
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


<div class="modal modal-safetyPhoneCenter fade safty-plan-call-model" id="safetyPhoneCenter" tabindex="-1" role="dialog" aria-labelledby="safetyPhoneCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>

            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary" id="callPopup" >Call</a>
            </div>
            </div>
        </div>
</div>

@push('scripts')
   



<script>
$(document).on("click", ".save-safety-warning", function(e) {
    e.preventDefault(); // Prevent default behavior
    let isValid = false;
    $("#custom-saf-plans-form input[name='fields[]']").each(function() {
        if($(this).val().trim() !== "") {
            isValid = true;
            return false; 
        }
    });

    if (!isValid) {
        toastr.error("Please fill at least one field");
        return false;
    }
    $(this).closest('form').submit(); 
    /*
    var checkfields = false;

    $('.saftyplanfield').each(function() {
        if ($(this).val().trim() !== '') { // Use trim() to avoid spaces counting as value
            checkfields = true;
        }
    });
   
    if (checkfields) {
        $(this).closest('form').submit(); // Submit the closest form
    } else {
        toastr.error("Please fill at least one field");
    }
    */ 
});

function SafetyPlanModalFun(id) {
    var text = $("#plan-"+id+" .plans-heading").html();
    console.log($(text).text());
    // title  = $("<div>").html(title).find("p").text().trim();
    $("#safty_plan_type").val($(text).text().trim());

 }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnxBLm9Xmwe7r6LIZ-RrZw8LrsrAtI5sY&libraries=places&callback=initMap" async defer></script>
<script>
let map, service, infowindow;
let userLocation;
let markers = [];
let mapReady = false;
let selectedSearchType = "urgent care";


if (typeof bootstrap !== 'undefined') {
    bootstrap.Modal.prototype._enforceFocus = function () {};
}


// INIT MAP
function initMap() {

  const defaultLocation = { lat: 28.6139, lng: 77.2090 }; // India default

  map = new google.maps.Map(document.getElementById("urgent_care_finder_map"), {
    center: defaultLocation,
    zoom: 13
    
  });

  infowindow = new google.maps.InfoWindow();
  mapReady = true;

  // ✅ FIX 2: Prevent modal close when interacting with map
  google.maps.event.addListenerOnce(map, 'idle', function () {

    const mapDiv = document.getElementById("urgent_care_finder_map");

    mapDiv.addEventListener("mousedown", function (e) {
        e.stopPropagation();
    });

    mapDiv.addEventListener("click", function (e) {
        e.stopPropagation();
    });

  });
}


// MODAL OPEN
document.getElementById('mapModal').addEventListener('shown.bs.modal', function () {

  document.body.classList.add('modal-open');

  // Reset UI
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


// DETECT BUTTON TYPE (Emergency / Urgent)
document.getElementById('mapModal').addEventListener('show.bs.modal', function (event) {

  let button = event.relatedTarget;
  selectedSearchType = button.getAttribute("data-type") || "urgent care";

  document.querySelector(".modal-title").innerText =
    selectedSearchType === "emergency"
      ? "Nearby Emergency Rooms"
      : "Nearby Urgent Care";
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


// GET USER LOCATION
function getUserLocation() {

  navigator.geolocation.getCurrentPosition(

    (position) => {

      userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

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

      setTimeout(findPlaces, 500);
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


// SEARCH PLACES (DYNAMIC)
function findPlaces() {

  clearMarkers();

  service = new google.maps.places.PlacesService(map);

  let keyword = selectedSearchType === "emergency"
    ? "hospital emergency"
    : "urgent care";

  const request = {
    location: userLocation,
    radius: 10000,
    keyword: keyword
  };

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

@endpush

@endsection