@extends("mobile.layouts.dashboard")
@section("content")
    <section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('my-mood-feeling')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">My Moods & Feelings.</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
    </section>

    <section class="consul-my-v1 whats-mood">
        <div class="cust-container-md">
            <div class="how-did-i">
                <div class="search-form">
                  
                    <form class="form-row">
                        <div class="col-100 form-group">
                            <label>WHAT WAS YOUR MOOD? </label>
                            <input class="form-control" type="text" name="Search" placeholder="Search" id="searchInput">
                        </div>
                    </form>
                      
                </div> 

                <div class="mood-his-card-response">
                           
                </div>    
            </div>
        </div>
    </section>


@include('mobile.includes.foooter-tab')

<div class="popup" id="mood-feeling-popup-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('mood-feeling-popup-confirmation')">&times;</span>
  
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
              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('mood-feeling-popup-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>

<script>
$(document).on("click", ".delete-m", function() {
    $("#mood-feeling-popup-confirmation").addClass("show");
    let id = $(this).attr("deleted_id");
    $(".confirm_btn").attr("onclick","OnClickFeelingDeletedConfirm('"+id+"')");
});

$(document).on("click", ".mood-view", function() {
	
	let mood_id = $(this).attr("mood-id");
    $("#moodfeelingpopup_view").addClass("show");
    let formData = new FormData();
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
    formData.append("id", mood_id); 
    $('#content-area').html('<p>Please wait....</p>');
    $.ajax({
               method: "POST",
               url: "{{ route('mood-feeling-list-view') }}", 
               data:formData,
               processData: false, 
               contentType: false,
               success: function(response) {
                $('#content-area').html(response.data);
               },
				error: function (xhr, status, error) {
					$('#content-area').html('<p style="color:red;">Failed to load mood details. Please try again.</p>');
				},
    });
	
});

 function OnClickFeelingDeletedConfirm(id) {
    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
     });
    let formData = new FormData();
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
    formData.append("id", id); 

    $.ajax({
               method: "POST",
               url: "{{ route('my-mood-feeling-history-deleted')}}",
               data:formData,
               processData: false, 
               contentType: false,
               success: function(data) {
                   
                  location.reload();

               },
    });

 }
function getMoodLogs() {

    let formData = new FormData(); // Create FormData object
    formData.append("_token", $('meta[name="csrf-token"]').attr("content")); // Add CSRF token

    $.ajax({
            url: "{{ route('my-mood-feeling-history-logs')}}",
            type: "POST",
            data: formData,
            processData: false, // Prevent jQuery from processing data
            contentType: false, // Prevent jQuery from setting content-type
            success: function(response) {

                let html = "";
                if(response.data.length) {
                        for(var i=0;i<response.data.length;i++) {
                            html +='<div class="mood-his-card" >';    
                                html +='<div class="image mood-view" mood-id='+response.data[i].id+'>'+response.data[i].image+'</div>';
                                
                                html +=' <div class="detail mood-view" mood-id='+response.data[i].id+'>';

                                    html +='<div class="title"><p>'+response.data[i].title+'</p></div>';

                                    html +='<div class="date"><div class="icon">';
                                        html +=''+response.data[i].watch_ico+'</div>';
                                        html +='<div class="value"><p>'+response.data[i].date+'</p></div>';
                                    html +="</div>";

                                html +='</div>';

                                html +=' <div class="del-icon">'+response.data[i].deleted_ico+'</div>';

                            html +='</div>';
                            //console.log(response.data[i].title);
                        }
                }
                $(".mood-his-card-response").html(html);
                //console.log(html);
                //let data = JSON.parse(response);
                //console.log(response.data.length);
                
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
            }
        });

}
$(document).ready(function () {
    $("#searchInput").on("keyup", function () {
        var searchText = $(this).val().toLowerCase();
		var matchCount = 0;
        $(".mood-his-card").each(function () {
            var titleText = $(this).find(".title p").text().toLowerCase();

            if (titleText.includes(searchText)) {
                $(this).show(); 
				matchCount++;
            } else {
                $(this).hide();
            }
			
			
			if (matchCount === 0) {
				if ($("#noResults").length === 0) {
					$(".mood-his-card-response").append('<div id="noResults" style="position: relative;border: 1px solid #E9E7EB;border-radius: 20px;padding: 20px;margin-bottom: 20px;"><div  class="no-results">No records found</div></div>');
				}
			} else {
				$("#noResults").remove();
			}
			
			
			
        });
    });
});
getMoodLogs();
</script>
<div class="popup" id="moodfeelingpopup_view">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('moodfeelingpopup_view')">&times;</span>
      <div class="popu-content delete-pup">
            <div class="form" id="content-area" style="height: 50vh; overflow: auto; padding-right:15px;">
            </div>
      </div>
    </div>
</div>
@endsection