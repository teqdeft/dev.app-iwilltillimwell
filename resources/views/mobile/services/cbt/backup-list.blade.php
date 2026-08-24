@extends("mobile.layouts.dashboard")

@section("content")



    

<section class="msg-special-header">

        <div class="cust-container-md">

            <div class="rec-row">

                <div class="back">

                    <a href="{{ route('cbt-therapy')}}" class="back-btn">

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"

                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>

                        </svg>

                    </a>

                </div>

                <div class="top-title">

                    <h2 class="title" style="display:none;">CBT Therapy</h2>

                    <h2 class="title">My Thought Analysis</h2>

                </div>

            </div>

        </div>

    </section>





<section class="cbd-therapy-main">

        <div class="cust-container-md">

            <div class="cbd-ther-list">

				

				<div class="search-form">

					<form class="form-row">

						<div class="col-100 form-group">

							<input class="form-control" type="text" name="searchInput" id="searchInput" placeholder="Search">

						</div>

					</form>

				</div>

				

            @if ( $dataArray )

                 @foreach ($dataArray as $header )

                        <div class="cbd-list-card">

                            <div class="cbd-title">

                                <p>{{ $header['header'] }}</p>

                            </div>

                            @foreach ($header['list'] as $value )

                                    <div class="cbd-list-row" >

                                        <div class="cont" onclick="ViewTopupList('{{$value->id}}')">

                                            <p>



                                            @if( $value->automatic_thought )

                                                    {{ $value->automatic_thought }}

                                                @elseif ( $value->challenge_thought )

                                                    {{ $value->challenge_thought }}

                                                @elseif ( $value->alternative_thought )

                                                    {{ $value->alternative_thought }}

                                                @else

                                                    N/A

                                                @endif

                                            </p>

                                        </div>

                                        <div class="action">

                                            <a href="{{ route('cbt-therapy-edit')}}?id={{$value->id}}">

                                                <img src="{{ asset('assets/dashboard/assets/images/edit-icon-v1.png') }}" alt="icon">

                                            </a>

                                            <a href="javascript:void(0)" class="open-modal delete-m" data-modal="DeleteCbdThap" deleted_id='{{$value->id}}'>

                                                <img src="{{ asset('assets/dashboard/assets/images/delete-icon.png') }}" alt="icon">

                                            </a>

                                        </div>

                                    </div>

                            @endforeach

                        </div>

                @endforeach

            @else 



                <div class="cbd-list-card">

                        <p>Sorry no records.</p>

                </div>



            @endif



                

            </div>

        </div>

</section>







@include('mobile.includes.foooter-tab')





<div class="popup" id="cbt-feeling-popup-confirmation">

    <div class="popup-content">

      <span class="popup-close-icon" onclick="close_consemt_popup('cbt-feeling-popup-confirmation')">&times;</span>

  

      <div class="popu-content delete-pup">

          <div class="delete-alert" >

              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png') }}" />

          </div>

          <div class="complete-form">

             <h2 class="text-center">Are you sure ? </h2>

             <p class="text-center" style="padding: 10px 0 0 0;">Are you sure you want to delete this record?</p>

          </div>

          <div class="popup-cta">

              <a class="primary-button confirm_btn" href="javascript:void(0)">Yes</a>

              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('cbt-feeling-popup-confirmation')">No</a>

          </div>

      </div>

    </div>

</div>



<div class="popup" id="cbt-view-popup-list">

    <div class="popup-content">

      <span class="popup-close-icon" onclick="close_consemt_popup('cbt-view-popup-list')">&times;</span>

      <div class="popu-content delete-pup">

            <div class="form" id="content-area" style="height: 50vh; overflow: auto; padding-right:15px;">

            </div>

      </div>

    </div>

</div>



<script>

$(document).on("click", ".delete-m", function() {

        $("#cbt-feeling-popup-confirmation").addClass("show");

        let id = $(this).attr("deleted_id");

        $(".confirm_btn").attr("onclick","OnClickCBTDeletedConfirm('"+id+"')");

});

function ViewTopupList(id) {

    $("#cbt-view-popup-list").addClass("show");
    let formData = new FormData();
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
    formData.append("id", id); 
    $('#content-area').html('<p>Please wait....</p>');
    $.ajax({
               method: "POST",
               url: "{{ route('cbt-therapy-list-view') }}",
               data:formData,
               processData: false, 
               contentType: false,
               success: function(response) {
                $('#content-area').html(response.data);
               },
    });
}

function OnClickCBTDeletedConfirm(id) {

    toastr.info('Please wait...', 'Processing', {

               timeOut: 0,

               extendedTimeOut: 0,

     });

    let formData = new FormData();

    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

    formData.append("id", id); 



    $.ajax({

               method: "POST",

               url: "{{ route('cbt-therapy-deleted') }}",

               data:formData,

               processData: false, 

               contentType: false,

               success: function(data) {

                   

                  location.reload();



               },

    });

 }



$(document).ready(function () {

    $("#searchInput").on("keyup", function () {

        var searchText = $(this).val().toLowerCase();

		var matchCount = 0;

        $(".cbd-list-card").each(function () {

            var titleText = $(this).find(".cont p").text().toLowerCase();



            if (titleText.includes(searchText)) {

                $(this).show();

				matchCount++;

            } else {

                $(this).hide();

            }

			console.log(matchCount);

			if (matchCount === 0) {

				if ($("#noResults").length === 0) {

					$(".cbd-ther-list").append('<div id="noResults" style="position: relative;border: 1px solid #E9E7EB;border-radius: 20px;padding: 20px;margin-bottom: 20px;"><div  class="no-results">No records found</div></div>');

				}

			} else {

				$("#noResults").remove();

			}

			

        });

    });

});

 

</script>

@endsection 