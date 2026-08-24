@extends("mobile.layouts.dashboard")
@section("content")
<section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">
                        @if(request()->has('action') && request('action') == 'talk-to-veterinarian')
                             Talk To Veterinarian
                        @else 
                            My Pets
                        @endif
                             
                    </h2>
                </div>
            </div>
        </div>
</section>

@if(!request()->has('action') && request('action') != 'talk-to-veterinarian')
<x-pets.header />
  
@endif

<section class="cbd-therapy-main">
        <div class="cust-container-md">
            <div class="cbd-top">
                <div class="title">
                    <p>List</p>
                </div>
                <div class="view-log">
                    <a href="{{ route('pet-health-add')}}" class="primary-button">Add new</a>
                </div>
            </div>

            <div class="pet-health-row">

            @if(!$pets->isEmpty())
                @foreach($pets as $key => $value)

                <?php
                    $image = '';
                    if($value->profile && file_exists(public_path($value->profile))) {
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

                <div id="pe_list_{{$value->id}}" class="pet-health-card" my_pet_id='{{$value->id}}' pet_profile='{{ asset($image) }}'>

                    <div class="pet-image">
                        <img src="{{ asset($image) }}" alt="image" />
                    </div>
                    <div class="pet-helath-detail">
                        <div class="helath-top">
                            <div class="st-d">
                                <p>{{ ucfirst($value->name) }}</p>
                            </div>
                            <div class="edit-bt">
                                <a href="{{ route('pet-health-edit')}}?id={{ $value->id }}">
                                    <img src="{{ asset('assets/dashboard/assets/images/edit_pencil.svg') }}" alt="icon">
                                </a>
                            </div>
                        </div>
                        <div class="title-v">
                            <p>{{ $value->years }} year(s) old {{ $value->gender() }} {{ $value->breed }}</p>
                        </div>
                        <div class="neutered">
                            <div class="icon">
                                <img src="{{ asset('assets/dashboard/assets/images/right-vector.svg') }}" alt="ion">
                            </div>
                            <div class="nut-t">
                                <p>{{ $value->sterilizate() }}</p>
                            </div>
                        </div>
                        <div class="pet-cta">
                            @if(request()->has('action') && request('action') == 'talk-to-veterinarian')
                                <button onclick="OpenModel('schedule-term-condition','flex')" class="outline-button open-modal" data-modal="schedule-term-condition">Schedule
                                consultion</button>
                            @endif    
                        </div>
                    </div>
                </div>

                @endforeach
                @endif

                @if($pets->isEmpty())

                    <div class="pet-health-card no-record">   
                            <p>Sorry No Pet</p> 
                    </div>    

                @endif
            </div>

        </div>
</section>

@include('mobile.pets.schedule-model-list')
@include('mobile.includes.foooter-tab')
<script>
var my_pet_id = 0; 
function OpenModel(id,display_type,request=null) {
	if(request==null) {
		$('#pet-sterm-condition')[0].reset();
		$('#pet-swhatSeems')[0].reset();
		$('#pet-form-scheduling-type')[0].reset();
		$('#SaveScheduleForm')[0].reset();
		$('#preview').html('');
	}
    $("#"+id).css("display",display_type);
	
}

function CloseModel(id,display_type) {
    $("#"+id).css("display","none");
}

function UploadPetProfile(pet_id){

    let profile = $("#pe_list_"+pet_id).attr("pet_profile");
    $("#petIdImage").val(pet_id);
    $("#previewProfile").html('<img src="'+profile+'" style="width:100%;" />');
    OpenModel('uploadPetProfile','flex')
}


function NextTab(request) {

    if(request==1) {

        let isChecked = $('#term-condition').is(':checked');
        if(!isChecked) {
            toastr.error("Term & conditions required");
            return false;
        }
        OpenModel('whatSeems','flex','tab-request')
        CloseModel('schedule-term-condition','none')

    } else if(request==2) {

        if($('input[name="petProblem"]:checked').length <= 0) {
            toastr.error("Select One  value");
            return false;
        }
       let additional_notes = $("#additional_notes").val();
       if(!additional_notes) {
            toastr.error("Addition Notes Required");
            return false;
       } 

        OpenModel('scheduling-type','flex','tab-request')
        CloseModel('whatSeems','none')
        
    } else if(request==3) {

        let phone_number = $("#phone_number").val();
        if(!phone_number){
            toastr.error("Phone Number Required");
            return false;
        }


        OpenModel('Attachments1','flex','tab-request')
        CloseModel('scheduling-type','none')
    }

}
function BackToScreen(request){
    if(request==1) {
        OpenModel('schedule-term-condition','flex','tab-request')
        CloseModel('whatSeems','none')
    } else if(request==2) {
        OpenModel('scheduling-type','flex','tab-request')
        CloseModel('whatSeems','none')
    }
}
function cancel_tab() {

    CloseModel('scheduling-type','none')
    CloseModel('whatSeems','none');
    CloseModel('Attachments1','none');
    CloseModel('congratulation','none');
    CloseModel('uploadPetProfile','none');
    
}
function SaveSchedule() {

    var files = $("#file")[0].files;
    console.log(files.length);
    if (files.length == "0") {
        toastr.error("Please upload Image");
        return false;
    }


    let modality = $('input[name="whatseems_type[]"]:checked').val();
    let problemId = $('input[name="petProblem"]:checked').val();
    let description = $("#additional_notes").val();
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
                        OpenModel('congratulation','flex','tab-request')
                        CloseModel('Attachments1','none')
                        $(".congratulation-response").html(response.message);   
                        window.location.href="{{url('pet-consultations/all')}}";
                    } else {
                        toastr.error(response.message);
                    }

               },
    });

}
$(document).on("click", ".pet-health-card", function() {
    my_pet_id = $(this).attr("my_pet_id");
});
</script>  
<script>
        const preview = document.getElementById('preview');
        const imageUpload = document.getElementById('file');

        imageUpload.addEventListener('change', function (event) {
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const closeBtn = document.createElement('button');
                    closeBtn.innerText = '✕';
                    closeBtn.classList.add('close-btn');
                    closeBtn.onclick = function () {
                        preview.removeChild(imageContainer);
                    };

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(closeBtn);
                    preview.appendChild(imageContainer);
                };
                reader.readAsDataURL(file);
            });
            //imageUpload.value = "";
        });
    </script> 
@endsection  
