@extends('mobile.layouts.dashboard')
@section('content')

   <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">Supporters</h2>
                </div>
                
            </div>
        </div>
   </section>
   @if(LoginUserBToBVerification())
    <section class="care-cordin my-setting">
        <div class="cust-container-md">
            <div class="set-row">
                <div class="left-title">
                    <p>Supporter’s</p>
                </div>
                <div class="add-more">
                    <a  href="{{ url('share/supporter-add')}}" class="outline-button">Add more</a>
                </div>
            </div>
			
			<div class="search-form">
				<form class="form-row">
					<div class="col-100 form-group">
						<label>Search Supporters</label>
						<input class="form-control" type="text" name="Search" placeholder="Search" id="searchInput">
					</div>
				</form>
			</div>
			
			<div class="support-his-card">
            @if ( $friendContact )
                @foreach ($friendContact as $key => $value )
                    <div class="support-card">
						
						
                        <div class="top">
                            <div class="name">
                                <p>Name</p>
                            </div>
                            <div class="value">
                                <p>{{ ucfirst($value['name']) }}</p>
                            </div>
                            <div class="icon">
                                <a class="edit" href="{{ url('share/supporter-add')}}?id={{$value['id']}}">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.6665 14H13.3332M3.77717 8.79133C3.49291 9.07622 3.33324 9.46221 3.33317 9.86466V12H5.48184C5.8845 12 6.2705 11.84 6.55517 11.5547L12.8885 5.218C13.1727 4.93306 13.3322 4.54707 13.3322 4.14466C13.3322 3.74225 13.1727 3.35626 12.8885 3.07133L12.2632 2.44466C12.1221 2.30356 11.9547 2.19164 11.7704 2.11531C11.5861 2.03897 11.3885 1.99971 11.189 1.99977C10.9895 1.99983 10.792 2.03922 10.6078 2.11567C10.4235 2.19212 10.2561 2.30414 10.1152 2.44533L3.77717 8.79133Z" stroke="#8462A8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <div class="delete" onclick="OnClickFriendContactDeleted({{$value['id']}})">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 1.6875C7.35082 1.6875 7.20774 1.74676 7.10225 1.85225C6.99676 1.95774 6.9375 2.10082 6.9375 2.25V2.8125H3.75C3.60082 2.8125 3.45774 2.87176 3.35225 2.97725C3.24676 3.08274 3.1875 3.22582 3.1875 3.375C3.1875 3.52418 3.24676 3.66726 3.35225 3.77275C3.45774 3.87824 3.60082 3.9375 3.75 3.9375H14.25C14.3992 3.9375 14.5423 3.87824 14.6477 3.77275C14.7532 3.66726 14.8125 3.52418 14.8125 3.375C14.8125 3.22582 14.7532 3.08274 14.6477 2.97725C14.5423 2.87176 14.3992 2.8125 14.25 2.8125H11.0625V2.25C11.0625 2.10082 11.0032 1.95774 10.8977 1.85225C10.7923 1.74676 10.6492 1.6875 10.5 1.6875H7.5ZM7.5 7.9875C7.64918 7.9875 7.79226 8.04676 7.89775 8.15225C8.00324 8.25774 8.0625 8.40082 8.0625 8.55V13.8C8.0625 13.9492 8.00324 14.0923 7.89775 14.1977C7.79226 14.3032 7.64918 14.3625 7.5 14.3625C7.35082 14.3625 7.20774 14.3032 7.10225 14.1977C6.99676 14.0923 6.9375 13.9492 6.9375 13.8V8.55C6.9375 8.40082 6.99676 8.25774 7.10225 8.15225C7.20774 8.04676 7.35082 7.9875 7.5 7.9875ZM11.0625 8.55C11.0625 8.40082 11.0032 8.25774 10.8977 8.15225C10.7923 8.04676 10.6492 7.9875 10.5 7.9875C10.3508 7.9875 10.2077 8.04676 10.1023 8.15225C9.99676 8.25774 9.9375 8.40082 9.9375 8.55V13.8C9.9375 13.9492 9.99676 14.0923 10.1023 14.1977C10.2077 14.3032 10.3508 14.3625 10.5 14.3625C10.6492 14.3625 10.7923 14.3032 10.8977 14.1977C11.0032 14.0923 11.0625 13.9492 11.0625 13.8V8.55Z" fill="#8462A8"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.49319 5.93775C4.50852 5.80012 4.57407 5.67297 4.67731 5.58067C4.78055 5.48837 4.91421 5.43739 5.05269 5.4375H12.9472C13.0857 5.43739 13.2193 5.48837 13.3226 5.58067C13.4258 5.67297 13.4914 5.80012 13.5067 5.93775L13.6567 7.28925C13.9289 9.738 13.9289 12.2093 13.6567 14.6588L13.6417 14.7915C13.5895 15.2641 13.3812 15.7059 13.0498 16.0468C12.7183 16.3878 12.2827 16.6085 11.8117 16.674C9.94631 16.9355 8.05357 16.9355 6.18819 16.674C5.71723 16.6085 5.28156 16.3878 4.95012 16.0468C4.61867 15.7059 4.41038 15.2641 4.35819 14.7915L4.34319 14.6588C4.07115 12.2098 4.07115 9.73822 4.34319 7.28925L4.49319 5.93775ZM5.55594 6.5625L5.46144 7.413C5.19856 9.77947 5.19856 12.1678 5.46144 14.5343L5.47644 14.667C5.50088 14.8913 5.59954 15.101 5.75674 15.2628C5.91395 15.4246 6.1207 15.5293 6.34419 15.5603C8.10669 15.807 9.89394 15.807 11.6557 15.5603C11.8791 15.5294 12.0857 15.4248 12.2429 15.2631C12.4001 15.1014 12.4988 14.8919 12.5234 14.6678L12.5384 14.5343C12.8009 12.168 12.8009 9.77925 12.5384 7.413L12.4439 6.5625H5.55594Z" fill="#8462A8"/>
                                    </svg>    
                                </div>
                            </div>
                        </div>
                        <div class="sup-crd-row">
                            <div class="col-50">
                                <div class="title">
                                    <p>Relation</p>
                                </div>
                                <div class="value">
                                    <p>{{ ucfirst($value['relation']) }}</p>
                                </div>
                            </div>
                            <div class="col-50">
                                <div class="title">
                                    <p>Email</p>
                                </div>
                                <div class="value">
                                    <p>{{ $value['email'] }}</p>
                                </div>
                            </div>
                            <div class="col-50">
                                <div class="title">
                                    <p>Frequency</p>
                                </div>
                                <div class="value">
                                    <p>{{ $value['frequency'] }}</p>
                                </div>
                            </div>
                            <div class="col-50">
                                <div class="title">
                                    <p>Phone</p>
                                </div>
                                <div class="value">
                                    <p>{{ $value['phone'] }}</p>
                                </div>
                            </div>
                            <div class="col-100">
                                <div class="title">
                                    <p>Share Information</p>
                                </div>
                                <div class="value">
                                    <p><?= ($value['information'])?ucfirst(str_replace("_"," ",implode(',',(array_keys(json_decode($value['information'],true)))))):'N/A'; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach   
            @endif
			</div>
        </div>

<div class="popup" id="setting-add-deleted-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('setting-add-deleted-confirmation')">&times;</span>
  
      <div class="popu-content delete-pup">
          <div class="delete-alert" >
              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png')}}" />
          </div>
          <div class="complete-form">
             <h2 class="text-center">Are you sure ? </h2>
             <p class="text-center" style="padding: 10px 0 0 0;">Are you sure you want to delete this record?</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button confirm_btn" href="javascript:void(0)">Yes</a>
              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('setting-add-deleted-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>  

</section>   
<script>
function OnClickFriendContactDeleted(request_id) {
    $("#setting-add-deleted-confirmation").addClass("show");
    $(".confirm_btn").attr("onclick","OnClickDeletedConfirm('"+request_id+"')");
}
function OnClickDeletedConfirm(id){

    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
    let url = "{{ url('share/deleteFriendContact')}}";
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(); 
	formData.append('_token', csrfToken);
    formData.append('id', id);
    //formData.append('_method', 'DELETE');
    $.ajax({
               method: "POST",
               url:url,
               data:formData,
               processData: false, 
               contentType: false,
               success: function(data) {
                   
                   location.reload();

               },
    });

}
</script>    
    @include('mobile.includes.foooter-tab') 

    @else 

    <section class="written-journal">
    <div class="cust-container-md">
    {{ LoginUserBToBVerificationMSG() }}
    </div>
</section>  
@endif



<script>
$("#searchInput").on("keyup", function () {
    var searchText = $(this).val().toLowerCase();
    var matchCount = 0;

     console.log("////////////");
	$(".support-card").each(function () {
			var titleText = $(this).find("p").text().toLowerCase();
			if (titleText.includes(searchText)) {
				$(this).show();
				matchCount++;
			} else {
				$(this).hide();
			}
	});

    if (matchCount === 0) {
        if ($("#noResults").length === 0) {
            $(".support-his-card").append('<div id="noResults" style="position: relative; border: 1px solid #E9E7EB; border-radius: 20px; padding: 20px; margin-bottom: 20px;"><div class="no-results">No records found</div></div>'
            );
        }
    } else {
        $("#noResults").remove();
    }
	
});
</script>
@push('script')@endpush

@endsection