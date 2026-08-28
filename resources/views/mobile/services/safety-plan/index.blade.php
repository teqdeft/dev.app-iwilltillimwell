@extends("mobile.layouts.dashboard")
@section("content")


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<section class="written-journal-head">
    <div class="cust-container-md">
        <div class="header">
            <div class="back">
                <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
            <div class="title">
                <p>Safety Plan.</p>
            </div>
        </div>
    </div>
</section>
@if(LoginUserBToBVerification())
<section class="safety-plan-v1 custom-tab">
    <div class="cust-container-lg">
        <div class="tab-container">
            <div class="tab-header">
                <!-- Tab Buttons -->
                <div class="tab-buttons patient-details">
                    <button class="tab-link {{ request()->get('active-tab') == 'plan-tab' || !request()->has('active-tab') ? 'active' : '' }}" data-tab="plan-tab">
                        <span>
                            Plan
                        </span>
                    </button>
                    <button class="tab-link {{ request()->get('active-tab') == 'guide-tab' ? 'active' : '' }}" data-tab="guide-tab">
                        <span>
                            Guide
                        </span>
                    </button>
                    <button class="tab-link {{ request()->get('active-tab') == 'crises-tab' ? 'active' : '' }}" data-tab="crises-tab">
                        <span>
                            Crisis
                        </span>
                    </button>
                </div>
            </div>

            <div class="tab-content-detail">
                <!-- Tab Content -->
                <div id="plan-tab" class="tab-content active">

                    <div class="safety-plan-detail">

                        @if ( $safetyPlans )
                        <?php $counter = 1; ?>
                        @foreach ($safetyPlans as $value )
                        @if ( $value->type == 'plan' )


                        <?php $datadb = getSafetyPlanData($value->title) ?>


                        <a id="plan-<?php echo $counter ?>" href="javascript:void(0)" class="safety-plan-card open-modal" data-modal="SafetyPlanModal" onclick="SafetyPlanModalFun('<?php echo $counter ?>')">
                            <div class="top">
                                <div class="icon">
                                    <img src="{{ asset($value->icon) }}" alt="icon" style="width: 100%;">
                                </div>
                                <div class="title">
                                    <p><?= ucfirst(html_entity_decode($value->title)) ?></p>

                                    <input type="hidden" value="<?php echo $datadb ?>" id="db_value_<?php echo $counter ?>">
                                </div>
                            </div>
                            <div class="detail">
                                <p><?= ucfirst(html_entity_decode($value->description)) ?></p>
                            </div>
                        </a>
                        <?php $counter++; ?>
                        @endif
                        @endforeach
                        @endif



                    </div>
                </div>

                <div id="guide-tab" class="tab-content">

                    <div class="safety-plan-detail guide-plan-list">


                        @if ( $safetyPlans )
                        <?php $counter = 1; ?>
                        @foreach ($safetyPlans as $value )
                        @if ( $value->type == 'guide' )

                        <a id="guide-<?php echo $counter ?>" href="javascript:void(0)" class="safety-plan-card open-modal" <?php if ($counter != 7) { ?> data-modal="GuidePlanModal" <?php } ?> onclick="showContent('<?php echo $counter ?>')">
                            <div class="top">
                                <div class="icon">
                                    <img src="{{ asset($value->icon) }}" alt="icon" style="width: 100%;">
                                </div>
                                <div class="title">
                                    <p><?= ucfirst(html_entity_decode($value->title)) ?></p>
                                </div>
                            </div>

                            <div class="detail content" style="display: none;">
                                <?= ucfirst(html_entity_decode($value->description)) ?>
                            </div>

                        </a>
                        <?php $counter++; ?>
                        @endif
                        @endforeach
                        @endif

                    </div>
                    <div class="guide-moment-care-v1" style="display:none;">
                        <section class="written-journal-head">
                            <div class="cust-container-md">
                                <div class="header">
                                    <div class="back">
                                        <a href="javascript:void(0)" class="back-btn" onclick="backBtn()">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg> Back </a>
                                    </div>
                                </div>
                            </div>
                        </section> @include('mobile.consultation.in-the-moment-care-form')
                    </div>

                </div>

                <div id="crises-tab" class="tab-content">

                    <div class="safety-plan-detail">

                        @if ( $safetyPlans )
                        <?php $counter = 1; ?>
                        @foreach ($safetyPlans as $value )
                        @if ( $value->type == 'crisis' )


                        <a id="safety-plan-<?php echo $counter ?>"

                            {{-- Urgent care / emergency room now open Google Maps in a new
                                 tab, matching the other "near me" entries. --}}
                            @if($value->id==14 || $value->id==13)

                                class="safety-plan-card no-modal googleNearMe"
                                href="javascript:;"
                                data-link="https://www.google.com/maps/search/{{ urlencode(trim(strip_tags(html_entity_decode($value->title)))) }}"

                            @elseif($counter==9)

                            href="sms:741741?body=The Trevor Project Text ( LGBTQ )"
                            class="safety-plan-card no-modal"

                            @elseif ( !empty( $value->number ) && str_contains($value->number,'tel:') !== true )
                            class="safety-plan-card no-modal"
                            href="<?php echo str_replace("javascript", "javascript:void(0)", $value->number) ?>"
                            data-link="<?= $value->number ?>"

                            @else
                            class="safety-plan-card open-modal"
                            href="javascript:void(0);"
                            data-call="<?= $value->number ?>"
                            data-modal="CrisesPlanModal"
                            onclick="SafetyPlanContent('<?php echo $counter ?>')"

                            @endif

                            >
                            <div class="top">
                                <div class="icon">
                                    <img src="{{ asset($value->icon) }}" alt="icon" style="width: 100%;">
                                </div>
                                <div class="title">
                                    <p><?= ucfirst(html_entity_decode($value->title)) ?></p>
                                </div>
                            </div>
                            <div class="detail">
                                <p></p>
                            </div>
                        </a>
                        <?php $counter++; ?>
                        @endif
                        @endforeach
                        @endif


                    </div>

                </div>

            </div>

        </div>
    </div>
</section>





<div id="SafetyPlanModal" class="modal safety-v1 journal-modal">
    <div class="modal-content">
        <form method="post" action="{{ route('my-safety-plan-save') }}" id="warning-triggers">
            @csrf
            <span class="close-modal">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="modal-title text-left">
                    <p>Warning Signs / Triggers</p>
                </div>
                <div class="modal-detail">
                    <p>What sort of thoughts, images, moods, situations, or behaviors indicate to you that a crisis may be developing? (Ex. Urges to drink, sleeping more than usual, skipping responsibilities, etc.)</p>

                    <div class="type-specialist" style="margin: 20px 0 0 0;">



                        <div class="form">
                            <input type="hidden" name="plan_type" id="safty_plan_type" value="Warning Signs / Triggers">
                            <div id="teamArea" class="form-row">

                                <div class="col-100 form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="fields[]">
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-form">

                    <div class="col-100 cta">
                        <button type="button" class="outline-button" id="addNewTeam">Add New</button>
                        <button type="button" class="outline-button" id="removeLastTeam" style="display:none;">Remove</button>
                    </div>
                </div>
                <div class="modal-form">
                    <div class="col-100 cta">
                        <button onclick="return FormSubmit()" type="button" class="primary-button" id="addNewTeam">Save</button>

                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<div id="GuidePlanModal" class="modal safe-guide journal-modal">
    <div class="modal-content">
        <span class="close-modal"><img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon"></span>
        <div class="modal-body">
            <div class="modal-title text-left">
                <p class="title-heading"></p>
            </div>
            <div class="modal-detail model-guide-content"></div>
        </div>
    </div>
</div>

<div id="CrisesPlanModal" class="modal are-you-gu journal-modal">
    <div class="modal-content">
        <span class="close-modal">
            <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
        </span>
        <div class="modal-body">
            <div class="modal-title text-left">
                <p>Are you sure ?</p>
            </div>
            <div class="modal-detail">
                <p>&nbsp;</p>
            </div>
            <div class="modal-form">
                <form>
                    <div class="col-100 cta">
                        <a id="callPopup" href="javascript:void(0)" class="primary-button">Call</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="mapModal" class="modal fade safety_map_modal" > 
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <span class="close-modal" class="btn-close" data-bs-dismiss="modal">
            <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
        </span>
      <div class="modal-header">
        <h5 class="modal-title mapModal-title">Nearby Urgent Care</h5>
      </div>
      <div class="modal-body">
        <div id="mapLoader" class="text-center">
          <div class="spinner-border text-primary"></div>
          <p>Fetching your location...</p>
        </div>
        <div id="urgent_care_finder_map"></div>
      </div>
    </div>
  </div>
</div>



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

  document.querySelector(".mapModal-title").innerText =
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



<script>
    // Get all elements with the class 'open-modal'
    const openModalButtons = document.querySelectorAll('.open-modal');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    const modals = document.querySelectorAll('.modal');

    openModalButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = button.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        });
    });

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });

    window.addEventListener('click', (e) => {
        modals.forEach(modal => {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });
</script>

<script>
    // JavaScript for tab functionality
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const tabButtonsContainer = document.querySelector('.tab-buttons');

    tabLinks.forEach(link => {
        link.addEventListener('click', () => {

            // Remove active class from all buttons and tabs
            tabLinks.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to the clicked button and corresponding tab
            link.classList.add('active');
            document.getElementById(link.dataset.tab).classList.add('active');

            // Scroll to center the active button
            const buttonRect = link.getBoundingClientRect();
            const containerRect = tabButtonsContainer.getBoundingClientRect();
            const offset = buttonRect.left - containerRect.left - containerRect.width / 2 + buttonRect.width / 2;
            tabButtonsContainer.scrollBy({
                left: offset,
                behavior: 'smooth'
            });

            const url = new URL(window.location);
            url.searchParams.set('active-tab', link.getAttribute("data-tab"));
            window.history.pushState({}, '', url);


        });
    });

    function SafetyPlanModalFun(id) {

        let title = $("#plan-" + id + " .title").html();
        title = $("<div>").html(title).find("p").text().trim();
        console.log(title);
        $("#safty_plan_type").val(title);
        $("#SafetyPlanModal .modal-body .modal-title p").html(title);

        let db_data = $("#db_value_" + id).val();
        let items = db_data.split(','); // ["h", "h2", "h3"]
        console.log(items);

        let loopCount = Math.max(items.length, 1);
        $("#teamArea").empty();




        for (var i = 0; i < loopCount; i++) {
            let value = items[i] ?? '';
            let input = '<div class="col-100 form-group"><label></label><input type="text" class="form-control" name="fields[]" value="' + value + '"  /></div>';
            $("#teamArea").append(input);

        }
        /*
        items.forEach(function(item, index) {
                let input = '
                    <div>
                        <label></label>
                        <input type="file" name="fields[]" />
                    </div>
                ';
                $("#file_inputs_wrapper").append(input);
            });
            */

    }

    function showContent(id) {
        if (id == 7) {
            $(".guide-plan-list").hide();
            $(".guide-moment-care-v1").show();
            return false;
        } else {
            let title = $("#guide-" + id + " .title").html();
            let content = $("#guide-" + id + " .content").html();

            $(".title-heading").html(title);
            $(".model-guide-content").html(content);
        }
    }

    function backBtn() {
        $(".guide-plan-list").show();
        $(".guide-moment-care-v1").hide();
    }

    function SafetyPlanContent(id) {
        let datacall = $("#safety-plan-" + id).attr("data-call");
        $('#CrisesPlanModal').find('#callPopup').attr('href', datacall);
        console.log(id);
    }

    $("#addNewTeam").on('click', function(e) {
        console.log("Add new value");
        e.preventDefault();
        let newField = $('#teamArea .col-100.form-group:first').clone();
        newField.find('input').val("");
        $("#teamArea").append(newField);
        removeButtonShowOrHide();
    });
    $('#removeLastTeam').on('click', function(e) {
        $("#teamArea .col-100.form-group:last-child").remove();
        removeButtonShowOrHide();
    });



    function removeButtonShowOrHide() {
        if ($('#teamArea .col-100.form-group').length > 3) {
            $('#removeLastTeam').show();
        } else {
            $('#removeLastTeam').hide();
        }
    }

    function FormSubmit() {

        var isValid = false;

        $("#SafetyPlanModal input[name='fields[]']").each(function() {
            if ($(this).val().trim() !== "") {
                isValid = true;
                return false;
            }
        });

        if (!isValid) {
            toastr.error("Please fill at least one field");
            return false;
        }

        callAjaxFormSubmit();
    }

    function callAjaxFormSubmit() {
        showLoaderPageLoad('show');
        let form = document.getElementById('warning-triggers');
        let formData = new FormData(form);

        $.ajax({
            url: "{{ url('my-safety-plan-save') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(response) {
                showLoaderPageLoad('hide');
                if (response.success) {
                    close_popup('SafetyPlanModal')
                    showLoaderPageLoad('hide');
                    toastr.success(response.message);
                    location.reload();
                } else {
                    showLoaderPageLoad('hide');
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                showLoaderPageLoad('hide');
                toastr.error(response.message);
            }
        });

        return false;


    }

    function nextTab() {
        $(".tab-link.active").trigger("click");
    }
    nextTab();
</script>


@else
<section class="written-journal">
    <div class="cust-container-md">
        {{ LoginUserBToBVerificationMSG() }}
    </div>
</section>
@endif
@include('mobile.includes.foooter-tab')
@endsection