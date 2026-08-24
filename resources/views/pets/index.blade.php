@extends('layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
<div class="content-wrapper">
   <div class="container-fluid page-body-wrapper container1">
      <div class="my-pets">
         <div class="">					<x-pets.header />			
            
            <div class="mypets-popupsec" id="pets-listing-sec">
               <div class="row" id="pets-listing-sec-v1">
                  <div class="col-12 mb-4">
                     <h3 class="font-weight-bold">My Pets</h3>
                  </div>
@php	
$mypackageservicelist = GetMyPackageServiceList();	
$telepets = checkServiceEnabled($mypackageservicelist, 9);
@endphp
@if($telepets)					
	<div class="pet_row_v1">
                  @if(!$pets->isEmpty())
                     @foreach($pets as $key => $value)
                        <div class="cust-col">
                           <div class="inner-sec-one cust-card">
								
                              <div class="modal-sec first-img"  data-toggle="modal" data-target="#petImage">
                                 <?php
                                    $image = '';
                                    if( $value->profile ){
                                       $image = $value->profile;
                                    }else{
                                       if( $petImage ){
                                          foreach($petImage as $imgKey => $imgValue ){
                                                if( $imgValue['type'] == $value->species ){
                                                   $image = "{$imgValue['image']}";
                                                }
                                          }
                                       }
                                    }
                                 ?>
                                 <div class="img-sec-popup" style="background:url({{ $image }})">
                                 </div>
								 <?php /*
                                 <div class="imag-icon">
                                    <a href="javascript:;" id="imageModel" petId="{{ $value->id }}"><i class="fas fa-image"></i></a>
                                 </div>
								 */ ?>
                              </div>
                              <div class="heading-mypet">
                                 <h3>{{ ucfirst($value->name) }}</h3>
                              </div>
                              <div class="my-bottom-text">
                                 <p>{{ $value->years }} year(s) old {{ $value->gender() }} {{ $value->breed }}</p>
                                 <span><i class="fas fa-check-circle"></i>{{ $value->sterilizate() }} </sapn>
                              </div>
                              <div class="schedule-btn">
                                 <button onclick="ScheduleButton({{ $value->id }})" class="theme-btn-v2" data-toggle="modal" petId="{{ $value->id }}" data-target="#schedulepopup"><i class="fas fa-phone-alt"></i>&nbsp; Schedule Consultation</button>
                              </div>
                              <div class="edit-pet">
                                 <button class="allDetails" petId="{{ $value->id }}"><i class="fas fa-paw"></i>&nbsp; Edit Pet</button>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  @endif
                  
                  <div class="cust-col">
                     <div class="add-newpet">
                        <button data-toggle="modal" data-target="#Edit-Pet"><i class="fas fa-plus"></i></button>
                        <h5>Add New Pet</h5>
                     </div>
                  </div>
                  </div>				
				@else
					  
					  
					<div class="alert alert-info custom-alert-info">							  						
                  <strong>Info!</strong> Please upgrade your plan. Click <a href="{{ url('dashboard?action=change-plan&active-tab=package') }}">							
                     <strong>here</strong>						
                  </a> to upgrade.										
               </div>

				  @endif					
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('pets.modal.pet-image')
@include('pets.modal.schedule')
<div class="modal fade Edit-Pet common-pet" id="Edit-Pet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">       
   @include('pets.add-pet')
</div>

<div id="editPet">
   <div class="modal fade Edit-Pet common-pet" id="Edit-my-Pet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   </div>
</div>

<script>
var my_pet_id = "0";
function ScheduleButton(mypetid) {
	my_pet_id = mypetid;
}
function SaveSchedule() {

    var files = $("#filessss")[0].files;
    console.log(files.length);
    if (files.length == "0") {
        toastr.error("Please upload Image");
        return false;
    }

    let modality = $('input[name="modality"]:checked').val();
    let problemId = $('input[name="petProblem[]"]:checked').val();
    let description = $("#pet-description").val();
    let optIn = $('input[name="optIn"]:checked').val();

    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });

    let url = '{{ route("pet-schedule-save")}}';
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(document.getElementById("SaveScheduleForm")); 
    

    console.log(formData);
    
	formData.append('_token', csrfToken);
    formData.append('id', 0);
    formData.append('phone', $("#phone_number").val());   
    formData.append('modality', modality);
    formData.append('problemId', problemId);
    formData.append('description', description);
    formData.append('optIn', optIn);
    formData.append('my-pet-id', my_pet_id);
    
    $.ajax({
               method: "POST",
               url:url,
               data:formData,
               processData: false, 
               contentType: false,
               success: function(response) {
                toastr.clear();
                    if (response.success) {
						$("#fisrt-step-inner .tab-pane").removeClass("active").addClass("d-none");	
						$("#fisrt-step-inner .pets-consultation").removeClass("d-none").addClass("active");	
                        //OpenModel('congratulation','flex')
                        //CloseModel('Attachments1','none')
                        //$(".congratulation-response").html(response.message);   
                        window.location.href='{{url("pet-consultations")}}';
                    } else {
                        toastr.error(response.message);
                    }

               },
    });

}
function lengthValidation(input,max_number) {
    let value = input.value.replace(/\D/g, ''); 
    if (value.length > max_number) {
        value = value.substring(0, max_number);
    }
    input.value = value;
}
function savePetFun(form_id) {
	
	const form = $("#" + form_id);
	let pet_name = $("#"+form_id+" #pet_name").val();
	if(pet_name==""){
		toastr.error("Pet name required");
		return false;
	}
	let species = $("#"+form_id+" #species").val();
	if(species==""){
		toastr.error("Species required");
		return false;
	}
	let breed = $("#"+form_id+" #breed").val();
	if(breed==""){
		toastr.error("Breed required");
		return false;
	}
	
	let app_age = $("#"+form_id+" #app_age").val();
	if(app_age==""){
		toastr.error("Age required");
		return false;
	}
	let editMonths = $("#"+form_id+" #editMonths").val();
	if(editMonths==""){
		toastr.error("Month required");
		return false;
	}
	let editGender = $("#"+form_id+" #editGender").val();
	if(editGender==""){
		toastr.error("Gender required");
		return false;
	}
	
	let formData = new FormData(form[0]);

    $("#petimgresponse").html('');

    $.ajax({
        url: form.attr("action"),
        type: "POST",
        data: formData,
        processData: false, 
        contentType: false, 
        beforeSend: function() {
           showLoaderPageLoad('show');
        },
        success: function(response) {
            
            toastr.success("Pet saved successfully!");
            console.log(response);

            form[0].reset();
            $(".modal").modal("hide");
			location.reload();
        },
        error: function(xhr) {

			showLoaderPageLoad('hide');

           if (xhr.status === 422) {

				const errors = xhr.responseJSON.errors;
				$.each(errors, function(key, value) {

            $("#petimgresponse").html('<div class="alert alert-danger"><strong>Error! </strong>' + value[0] + '</div>');
					//toastr.error(value[0]);


				});
			} else {

            let msg = xhr.responseJSON?.message || "Something went wrong!";
            $("#petimgresponse").html('<div class="alert alert-danger"><strong>Error! </strong>' + msg + '</div>');
				
			}


        }
    });
} 
</script>

@if(request('action'))
<script>
   /*
    document.addEventListener("DOMContentLoaded", function () {
        const section = document.getElementById("{{ request('action') }}");
        if (section) {
            section.scrollIntoView({ behavior: "smooth" });
        }
    });
    */
</script>
@endif

@endsection