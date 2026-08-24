<div id="pharmacy-info" class="tab-content">



                        <div class="midical-form v1 detail">



                            <div class="preferred-pharmacy">



                            @if ($user->user_pharmcay)

                            

                                <div class="smal">

                                    <p>Preferred Pharmacy</p>

                                </div>

                                <div class="app-heading">

                                    <p>{{ $user->user_pharmcay->name }}</p>

                                </div>

                                <address>

                                     {{ $user->user_pharmcay->address }}

                                     {{ $user->user_pharmcay->city }}, 

									 {{ $pharmacy_state->abbreviation ?? '' }} 

									 {{ $user->user_pharmcay->zipCode }}

                                    P: {{ $user->user_pharmcay->phone }}

                                </address>

                                @endif

                                

                            </div>



                            <div class="preferred-pharmacy-form">

                            <form class="forms-sample" method="post" id="search-pharmacy">

                            @csrf

                                <div class="form">

                                    <div class="form-row">



                                        <div class="col-100 form-group">

                                            <label>Name</label>

                                            <input class="form-control" type="text" name="name" placeholder="Name">

                                        </div>



                                        <div class="col-100 form-group">

                                            <label>Address</label>

                                            <input class="form-control" type="text" name="address"

                                                placeholder="Your Address" value="{{ $user->address }}">

                                        </div>



                                        <div class="col-50 form-group">

                                            <label>City</label>

                                            <input class="form-control" type="text" name="city"

                                            value="{{ $user->city }}">

                                        </div>



                                        <div class="col-50 form-group">

                                            <label>State</label>

                                            <select class="form-control theme-select" name="stateid">

                                                                <option value="">Please select state</option>

                                                                @foreach ($states as $state)

                                                                <option value="{{ $state->id }}"

                                                                    {{ ($state->id == $user->stateid) ? 'selected' : '' }}>

                                                                    {{ $state->name }}</option>

                                                                @endforeach

                                                            </select>

                                        </div>



                                        <div class="col-100 form-group">

                                            <label>Zip Code</label>

                                            <input class="form-control" type="text" name="zipCode"

                                            value="{{ $user->zipCode }}">

                                        </div>



                                        <div class="col-100 cta">

                                            <button type="Search" class="primary-button search-pharmacy-btn">Search</button>

                                        </div>

                                        



                                    </div>



                                    



                                </div>

                            </form>

                            

                            <div class="pre-pharmacy-location" id="showPharmacies"></div>

                                    <div class="map-record">

                                    <div class="col-100 small"><p>The map only shows pharmacies that accept e-prescriptions.</p></div>

                                    <iframe

                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3432.0628908401054!2d76.85824131552589!3d30.660357496167308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390f95081cd506f7%3A0x8b83dff814c0f93b!2sTEQ%20DEFT!5e0!3m2!1sen!2sin!4v1625203297924!5m2!1sen!2sin"

                                                    width="600" height="450" style="border:0;" allowfullscreen=""

                                                    loading="lazy"></iframe>



                                    </div>





                            </div>



                        </div>



<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".search-pharmacy-btn").click(function(e) {
    
        e.preventDefault();


        let formData = $('#search-pharmacy').serializeArray();

        formData.push(
            { name: "userid", value: 1 },
            { name: "modality", value: 1 }
        
        );


       // $(this).attr("disabled", "disabled");

        $("#showPharmacies").html("<div class='pre-pharmacy-location'><div class='loca-phar-card' style='display: block;padding-bottom: 20px;'>Please wait...</div></div>");

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

</script>

</div>