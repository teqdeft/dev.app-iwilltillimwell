<div id="pharmacy" class=" tab-pane fade">
    <br>
        @if ($user->user_pharmcay)
            <div class="preferred-pharmacy-box">
                <blockquote class="blockquote">
                    <p class="lead text-left">Preferred Pharmacy</p>
                    <address class="fs-16">
                        <strong>{{ $user->user_pharmcay->name }}</strong><br>
                                {{ $user->user_pharmcay->address }}.<br>
                                {{ $user->user_pharmcay->city }}, {{ $pharmacy_state->abbreviation ?? '' }}
                                {{ $user->user_pharmcay->zipCode }}<br>
                                <abbr title="Phone">P:</abbr> {{ $user->user_pharmcay->phone }}
                    </address>
                </blockquote>
            </div>
        @endif

                            <div class="map-address-main-box">


                                <hr>
                                <div class="innner-map-address-main-box">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <form class="forms-sample" method="post" id="search-pharmacy">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Name</label>
                                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                                        placeholder="Name" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputAddress">Address</label>
                                                    <input type="text" class="form-control" id="exampleInputAddress"
                                                        placeholder="Address" name="address"
                                                        value="{{ $user->address }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text" class="form-control" placeholder="City"
                                                                name="city" value="{{ $user->city }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">State</label>
                                                            <select class="form-control theme-select" name="stateid">
                                                                <option value="">Please select state</option>
                                                                @foreach ($states as $state)
                                                                <option value="{{ $state->id }}"
                                                                    {{ ($state->id == $user->stateid) ? 'selected' : '' }}>
                                                                    {{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Zip Code</label>
                                                    <input type="number" class="form-control" id="exampleInputUsername1"
                                                        placeholder="Zip Code" name="zipCode"
                                                        value="{{ $user->zipCode }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button
                                                            class="btn btn-primary  loader-btn-box search-pharmacy-btn-user"
                                                            type="button">
                                                            <i class="fa fa-spinner fa-spin btn-loading"
                                                                style="display:none"></i> Search
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class=" e-prescriptions-box mt-2">
                                                    <p class="mb-0 ">The map only displays pharmacies that accept e-prescriptions.</p>
                                                   
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="responsive-map">
                                                
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnxBLm9Xmwe7r6LIZ-RrZw8LrsrAtI5sY&callback=initMap" async defer></script>
                                               

                                                            <div id="map" style="height: 400px; width: 100%;"></div>
                                                            <?php /*
                                                            <button onclick="changeLocation(28.6139, 77.2090)">Delhi</button>
                                                            <button onclick="changeLocation(19.0760, 72.8777)">Mumbai</button>

                                                           */ ?>


                                                   



                                            </div>
                                        </div>
                                    </div>
                                    <div class="branch-pharmacy-box mt-4" id="showPharmacies">

                                    </div>
                                </div>
                            </div>

<script>
 let map;
let marker;
function initMap() {

   const defaultLocation = {
            lat: <?php echo optional($user->user_pharmcay)->latitude ?? 0 ?>,
            lng: <?php echo optional($user->user_pharmcay)->longitude ?? 0 ?>
        };



    map = new google.maps.Map(document.getElementById("map"), {
                                                                zoom: 10,
                                                                center: defaultLocation,
                                                                });

                                                                marker = new google.maps.Marker({
                                                                position: defaultLocation,
                                                                map: map,
                                                                });
}

function changeLocation(lat, lng) {
    const newLocation = { lat: lat, lng: lng };
    map.setCenter(newLocation);
    marker.setPosition(newLocation);
}


$(function(){

	$(".search-pharmacy-btn-user").click(function(e) {
        e.preventDefault();
         $(this).attr("disabled", "disabled");
         $("#showPharmacies").html("<div class='pre-pharmacy-location'><div class='loca-phar-card' style='display: block;padding-bottom: 20px;'>Please wait...</div></div>");
       let formData = $('#search-pharmacy').serializeArray();

        formData.push(
            { name: "userid", value: 1 },
            { name: "modality", value: 1 },
            { name: "_token", value: $('#csrf-token').attr('content') }
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "/search-pharmacy",
            data: formData,
            success: function(response) {

            $("#showPharmacies").html(response.data);
           $(".search-pharmacy-btn-user").removeAttr("disabled");
            $(".btn-loading").hide();

            },
        });
    });

});

</script>

</div>