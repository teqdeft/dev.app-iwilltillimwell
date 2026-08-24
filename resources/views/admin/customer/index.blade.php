@extends('admin.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>  
                                <div class="media-body theme-title-box">
                                     <h3 class="font-weight-bold">Customer List</h3>
                                     <div class="theme-btn-cont organization-btn-cont">
                                            <div class="organization_drop_cont">
                                                <select class="form-control" id="organization-filter" onchange="getorganization(this.value)">
                                                    <option value="">Select Organization</option>
                                                    @if($organization)
                                                        @foreach($organization as $value)
                                                            <option value="{{ $value->id }}" {{ request('organization') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                                        @endforeach
                                                    @endif
                                                 </select>
                                            </div>  
                                            <div class="dropdown uploadSubsSheet">
                                                <a class="btn btn-custom dropdown-toggle" type="button" id="enrolled_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        Action
                                                </a>
                                                <div class="dropdown-menu uploadSbsContainer" aria-labelledby="enrolled_user" >
                                                    <a class="" href="javascript:void(0)" onclick="user_enroll_disernrolled('Enroll')">Enroll</a>
                                                    <br/>
                                                    <a class="" href="javascript:void(0)" onclick="user_enroll_disernrolled('Disenroll')">Disenroll</a>                                
                                                </div>
                                            </div> 
                                     </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">
                        <div id="all">
                        
                        <div class="row">
                        
                        <div class="col-md-12">
                        <div class="col-md-4">   
                                
                        </div>
                        


                        
                            <div class="col-md-4 offset-md-8"><div id="affirmation-type-table_filter" class="dataTables_filter">
                                <label style="width: 100%;">Search:
                                    <input onkeyup="searchCustomers()" name="search" id="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="affirmation-type-table" style="max-width: 100%;" value="{{$search}}"></label>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive pt-3" id="customer-table">
                                @include('admin.customer.customer_table', ['customer_list' => $customer_list])
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<script>
    var request_type = "";
function searchCustomers() {

    var searchTerm = document.getElementById("search").value;
    var currentUrl = window.location.href;
    var newUrl = new URL(currentUrl);
    newUrl.searchParams.set('search', searchTerm);
    window.history.pushState({}, '', newUrl);
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let url = "{{ url('admin/customers-search') }}?status={{$status}}&search="+searchTerm+"";
    let requestData = {search: searchTerm,_token: csrfToken,sort_by: 'id',sort_order: 'ASC'};
    let ids_show ="customer-table";
    callUserSearchAjax(url,requestData,ids_show,'searchCustomers');
}
function callUserSearchAjax(url,requestData,ids_show,request_from){
    $.ajax({
                url:url, 
                method: "POST",
                data:requestData,
                success: function(data) {
                    document.getElementById(ids_show).innerHTML = data.html;
                    if(request_from=="user_enroll_disernrolled_countinus") {
                        startNowCallingAPI(0);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
    });
}
function user_enroll_disernrolled(request_types) {
    request_type = request_types;
    let checkedValues = getSelectedUserList();
    
    if(checkedValues.length == 0) {
        toastr.error("Please select at least one Value")
        return false;
    }    

    $("#user_enroll_disernrolled_modal").modal("show");
    $("#user_enroll_disernrolled_modal .modal-dialog").attr("style","max-width: 500px !important;");
    $("#user_enroll_disernrolled_modal .heading_title").html('<h4 class="modal-title">'+request_type+' Confirmation</h4>');
    let user_message = '<div class="alert alert-info message">';
    user_message  +='<strong>Confirm !</strong> Dear Admin You Selected '+checkedValues.length+' Customers . Are you sure continue ???</div>';
    user_message += '<button class="btn btn-success" onclick="user_enroll_disernrolled_countinus()">Continue</button>';
    $("#user_enroll_disernrolled_modal .user_message").html(user_message);

} 
function user_enroll_disernrolled_countinus() {

    let user_ids = getSelectedUserList();
   
    $("#user_enroll_disernrolled_modal").modal("show");
    $("#user_enroll_disernrolled_modal .modal-dialog").removeAttr("style");
    $(".user_message").html("Report");
    let url = "{{ url('admin/customers-enroll-disernrolled') }}";
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let requestData = {user_ids: user_ids,_token: csrfToken};
    let ids_show = "user_message";
    $("#user_enroll_disernrolled_modal .heading_title").html('<h4 class="modal-title">Please Wait...</h4>');
    callUserSearchAjax(url,requestData,ids_show,'user_enroll_disernrolled_countinus');
}     
function startNowCallingAPI(number = 0) {

    let user_ids = getSelectedUserList();
    user_ids.sort((a, b) => a - b);

    if (number < user_ids.length) {
        let u_id = user_ids[number];
        $("#customer_"+u_id+" .status_api").html('<span class="badge badge-info">Running</span>');
        let url = "{{ url('admin/customers-enroll-disernrolled-api') }}";
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.post(url,{u_id:u_id,_token:csrfToken,request_type:request_type},function(response){
                let result = JSON.parse(response);
                setTimeout(function(){
                if(result.success=="success") {
                    $("#customer_"+u_id+" .status_api").html('<span class="badge badge-success">Completed</span>');
                    
                    if(request_type=="Disenroll") {
                        $("#customer_"+u_id+" .current-status").html('<span class="badge badge-warning">InActive</span>');
                        $("#tabl-list-"+u_id+" .table-status").html('<span class="badge badge-warning">InActive</span>');
                    } else {
                        $("#customer_"+u_id+" .current-status").html('<span class="badge badge-success">Active</span>');
                        $("#tabl-list-"+u_id+" .table-status").html('<span class="badge badge-success">Active</span>');
                    }
                     

                } else {
                    $("#customer_"+u_id+" .status_api").html('<span class="badge badge-danger">Faild</span>');
                }     
               
                $("#customer_"+u_id+" .remark_api").html(result.remark);
                startNowCallingAPI(number + 1);

            }, 500);

        });

    } else {
        console.log("Completed");
    }
}
function getSelectedUserList(){
    return  $("#customer-table input[type='checkbox']:checked").map(function() {
            return this.value; // or return $(this).val();
        }).get();
}
function toggleCheckboxes(source) {
        let checkboxes = document.querySelectorAll(".checkbox-item");
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }
function getorganization(organizationId){
    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.delete('organization');
    currentUrl.searchParams.set('page', 1); 
    if (organizationId) {
        currentUrl.searchParams.set('organization', organizationId); 
    }
    window.location.href = currentUrl.toString();
}    
</script>

<div id="user_enroll_disernrolled_modal" class="modal fade" role="dialog" data-backdrop="static">

  <div class="modal-dialog modal-sm" style="max-width: 500px !important;">
    <div class="modal-content">
      <div class="modal-header heading_title"></div>
      <div class="modal-body user_message" id="user_message">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')
    
@endsection