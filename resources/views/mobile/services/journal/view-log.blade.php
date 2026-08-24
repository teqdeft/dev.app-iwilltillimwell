@extends("mobile.layouts.dashboard")
@section("content")

<section class="written-journal-head">
        <div class="cust-container-md">
            <div class="header">
                <div class="back">
                    <a href="{{ route('my-journal-written')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="title">
                    <p>Journal log</p>
                </div>
            </div>
        </div>
</section>


<section class="written-journal">
        <div class="cust-container-md">

            <div class="search-form">
                <form class="form-row">
                    <div class="col-100 form-group">
                        <input class="form-control" type="text" name="searchInput" id="searchInput" placeholder="Search">
                    </div>
                </form>
            </div>

            <div class="jour-list-r journal-his-card-response">

                

            </div>
        </div>
</section>


@include('mobile.includes.foooter-tab')
<div class="popup" id="view-log-popup-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('view-log-popup-confirmation')">&times;</span>
  
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
              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('view-log-popup-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>
<script>
 $(document).on("click", ".delete-m", function() {
    $("#view-log-popup-confirmation").addClass("show");
    let id = $(this).attr("deleted_id");
    $(".confirm_btn").attr("onclick","OnClickViewLogDeletedConfirm('"+id+"')");
 });
 function OnClickViewLogDeletedConfirm(id) {
	 showLoaderPageLoad('show');
    $("#view-log-popup-confirmation").removeClass("show");
    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
     });
    let formData = new FormData();
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
    formData.append("id", id); 

    $.ajax({
               method: "POST",
               url: "{{ route('view-journal-log-post-deleted')}}",
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
        $(".journal-log-card").each(function () {
            var titleText = $(this).find(".title p").text().toLowerCase();

            if (titleText.includes(searchText)) {
                $(this).show();
				matchCount++;
            } else {
                $(this).hide();
            }
			console.log(matchCount);
			if (matchCount === 0) {
				if ($("#noResults").length === 0) {
					$(".journal-his-card-response").append('<div id="noResults" style="position: relative;border: 1px solid #E9E7EB;border-radius: 20px;padding: 20px;margin-bottom: 20px;"><div  class="no-results">No records found</div></div>');
				}
			} else {
				$("#noResults").remove();
			}
			
        });
    });
});


function getViewLogs() {

let formData = new FormData(); // Create FormData object
formData.append("_token", $('meta[name="csrf-token"]').attr("content")); // Add CSRF token

$.ajax({
        url: "{{ route('view-journal-log-post')}}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {

            let html = "";
            if(response.data.length) {
                    for(var i=0;i<response.data.length;i++) {
                        html +='<div class="journal-log-card">';  
                            html +='<div class="top">'+response.data[i].top+'</div>';
                            html +='<div class="time-r">'+response.data[i].timmer+'</div>';
                            html +='<div class="content">'+response.data[i].content+'</div>';
                            /*
                            html +='<div class="image">'+response.data[i].image+'</div>';
                            html +=' <div class="detail">';
                                html +='<div class="title"><p>'+response.data[i].title+'</p></div>';
                                html +='<div class="date"><div class="icon">';
                                    html +=''+response.data[i].watch_ico+'</div>';
                                    html +='<div class="value"><p>'+response.data[i].date+'</p></div>';
                                html +="</div>";
                            html +='</div>';
                            html +=' <div class="del-icon">'+response.data[i].deleted_ico+'</div>';
                            */ 
                        html +='</div>';
                        //console.log(response.data[i].title);
                    }
            }
            console.log(html);
            $(".journal-his-card-response").append(html);
            //console.log(html);
            //let data = JSON.parse(response);
            //console.log(response.data.length);
            
        },
        error: function(xhr) {
            console.log("Error:", xhr.responseText);
        }
    });

}
getViewLogs();
</script>    

@endsection