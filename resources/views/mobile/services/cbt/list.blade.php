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
        <section class="edit_cbd_thoughts">
            <div class="edit_cbd_row">

                    @include('services.cbt.cbt-component.filter-section')

                    <div class="cbt-content-list">
                            <?php /*
                           @include('services.cbt.left-section')
                           @include('services.cbt.cbt-component.right-section')
                            */ ?>

                    </div>
            </div>
        </section>
    </div>
</section>
@include('mobile.includes.foooter-tab')
@include('services.cbt.cbt-component.common-script')
<script>
$(document).on("click", ".delete-button", function() {

        $("#cbt-feeling-popup-confirmation").addClass("show");
        let id = $(this).attr("deleted_id");
        $(".confirm_btn").attr("onclick","OnClickCBTDeletedConfirm('"+id+"')");

});
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

function fullReflection(id) {
    $("#cbt-view-popup-list").addClass("show");
    $('#content-area').html("<p>Please wait....</p>");
    $.ajax({
        url: "/cbt/get-reflection",
        type: "POST",
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#content-area').html(response);
        },
        error: function (xhr) {
             $('#content-area').html("Please Try again.");
        }
    });
}

</script>

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


<div class="popup full_reflection_modal" id="cbt-view-popup-list">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('cbt-view-popup-list')">&times;</span>
      <div class="popu-content">
            <div class="modal-body" id="content-area" style="height: 50vh; overflow: auto; padding-right:15px;">

                    <p>Please wait....</p>

            </div>
      </div>
    </div>
</div>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

<script>
$(function() {
    $('#cbt_date_filter').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true,
        maxDate: 0    
    });
});
</script> 

@endsection 