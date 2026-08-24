@extends("mobile.layouts.dashboard")
@section("content")

<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">My Moods & Feelings</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())
<section class="consul-my-v1 whats-mood">
        <div class="cust-container-md">
		
				<x-moods.header />
		
			
		
        <form action="{{ route('my-mood-feeling-save') }}" method="POST">
            @csrf
            <input type="hidden" name="mood_number" >
            <div class="mood-log-top">
                <div class="title-m">
                    <p>How is your mood & feeling today?</p>
                </div>
                <div class="mod-ct">
                    <a href="{{ route('my-mood-feeling-history')}}" class="outline-button">View Log</a>
                </div>
            </div>

                @include("mobile.services.moods.mood-section.top-mood-list")
                @include("mobile.services.moods.mood-section.open-mood-modal")
            
    

        </form>
    </div>
</section>




<script>
    var mood_number = 0; 
    $(document).on("click", ".mood-feels-img-wrap", function() {
        $('#happy-modal input[type="radio"]').prop('checked', false); 
        $(this).find('input[type="radio"][name="physicallyParent"]').prop('checked', true);
        let getMoodKey = $(this).attr('key-name');
        let getTypeMood = $(this).attr('key-type');
        let getNumber = $(this).attr('emojino');
        console.log(" Parent "+getMoodKey+" "+getTypeMood+" "+getNumber);

        $('.moods-child-'+getTypeMood+'').hide();
        $('.moods-face-subChild-'+getTypeMood+'').hide();
        $('.mood-child-'+getTypeMood+'-'+getMoodKey+'').show();
        $("input[name=mood_number]").val(getNumber);
        let moodtext = getMoodKey.toLowerCase();
        $(".selectedMoodParent").html('<p> I feel '+moodtext+' because I feel </p>');
        $(".selectedMoodChild").html('').hide();
        $(".other-option-div").hide();
        $('.saveMood').hide();
        $(".customMood").val(null);
        
    });
    $(document).on("click", ".childMoodfaces", function() {
        
        $('#happy-modal input[name="physicallySubChild"]').prop('checked', false); 
        
        $(this).closest(".moods-face-dynamic").find('.childMoodfaces').removeClass("checkedRadioMood");
        $(this).closest(".mood-feels-row-left").find('.subChildMood').removeClass('checkedRadioMood');

        $(this).addClass("checkedRadioMood");
        let getMoodKey = $(this).attr("keyname");
        let getTypeMood = $(this).attr("key-type");
        let mainMood = $(this).attr("mainmood");
        mood_number = $(this).attr("mood_number");
        let moodtext = getMoodKey.toLowerCase();
        if(getMoodKey=="OTHER") {
            console.log("============"+mood_number);
            $(".other-option-div").show();
            $(".moods-face-subChild-physically").hide();
            $(".selectedMoodChild").html('<p> I Feel '+moodtext+' because I feel </p>').show();
            $('.mood-subChild-'+getTypeMood+'-'+mainMood+'-'+getMoodKey+'').show();
            $(".other-option-div-sub-child").hide();
        } else {

            $('.moods-face-subChild-'+getTypeMood+'').hide();
            $('.mood-subChild-'+getTypeMood+'-'+mainMood+'-'+getMoodKey+'').show();
            $(".other-option-div").hide();
            
            $(".selectedMoodChild").html('<p> I Feel '+moodtext+' because I feel </p>').show();
        }
        $('.saveMood').hide();
        $(".other-option-div-sub-child").hide();
    });



$(document).on("click", ".parent_sub_child", function(event) {
       event.stopPropagation(); 
        $('.saveMood').show();
        $(".other-option-div").hide();
        let getMoodKey = $(this).attr("keyname");
        if(getMoodKey=="OTHER") {
            $(".customMood-sub").val(null);
            $(".other-option-div-sub-child").show();
        } else {
            $(".other-option-div-sub-child").hide();
        }
});

    
function show_popup_mood(){
    $("#happy-modal").css("display","flex");
}    
function save_function_custome() {
    $(".other-option-div").hide();
    $(".other-option-div-sub-child").hide();
}
function close_popup_mood(id){

    if(id){
        $("#"+id).css("display","none");
    } else {
        $("#happy-modal").css("display","none");
    }
    
}
function skipe_function() {
    location.reload();
}


$(function(){

    $('.customMood').on('keyup', function(e) {
        e.preventDefault();
        let customValue = $(this).val().toUpperCase();
        if (customValue != '') {
            console.log(mood_number);
            $(".childMoodfaces").each(function() {
                console.log($(this).attr("keyname"))
                if($(this).attr("keyname") == "OTHER") {
                   
                    $(this)
                    .closest("#mood-"+mood_number+"") // Adjust this to target the correct parent
                    .find("input[name=physicallyChild]")
                    .val(':' + customValue + ':');
                    $("#mood-"+mood_number+" .other_name").html(customValue);
                }
            });
        } else {

            $(this).closest(".other-option-div") .find("input[name=physicallyChild]").val(':OTHER:');
            $(".other_name").html("OTHER");
            
        }
    });

    $('.customMood-sub').on('keyup', function(e) {
        e.preventDefault();
        console.log("Here");
        let customValue = $(this).val().toUpperCase();
        let selectedValue = $('input[name="physicallySubChild"]:checked').attr("counter_id"); 
        if (customValue != '') {
            $("#parent_child_sub_child_"+selectedValue+" input").val(':' + customValue + ':');
            $("#parent_child_sub_child_"+selectedValue+" .subchildname").html(customValue);
        } else {
            $("#parent_child_sub_child_"+selectedValue+" input").val(':OTHER:');
            $("#parent_child_sub_child_"+selectedValue+" .subchildname").html('OTHER');
        }
    });

});


const saveMood = document.querySelector(".saveMood");
if (saveMood) {
    saveMood.addEventListener("click", function(e) {
        e.preventDefault();
        var physically = document.querySelector(
            "input[name=physicallyParent]:checked"
        );
        var physicallyChild = document.querySelector(
            "input[name=physicallyChild]:checked"
        );
        var physicallySubChild = document.querySelector(
            "input[name=physicallySubChild]:checked"
        );
        if (!physically) {
            toastr.error("Please select your mood");
        } else if (!physicallyChild) {
            toastr.error("Please select second step of your mood");
        } else if (!physicallySubChild) {
            toastr.error("Please select third step of your mood");
        } else {

            toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            });

            $.ajax({
                url:'{{ route("my-mood-feeling-save")}}',
                method:'POST',
                data:{
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    mood_number:$('input[name=mood_number]').val(),
                    physicallyParent:$('input[name=physicallyParent]:checked').val(),
                    physicallyChild:$('input[name=physicallyChild]:checked').val(),
                    physicallySubChild:$('input[name=physicallySubChild]:checked').val(),
                },
                error:(error) => {
                    toastr.clear();
                    toastr.error("Internal Server Error");
                    
                },
                success:(result) => {
                    toastr.clear();
                    var data = JSON.parse(result)
                    if( data.status ){
						$("#mood_id").val(data.mood_id);
                        close_popup_mood();
                        $("#save-modal-msg").css("display","flex");
                    }else{
                        toastr.error(data.message);
                    }
                }

            })

        }
    });
}
function SaveMoodMsgFinal() {


    let title  = $("#save-modal-msg #mood-model-title").val();
    let description  = $("#save-modal-msg #mood-model-description").val();
    let mood_id  = $("#save-modal-msg #mood_id").val();

    let formData = new FormData(); // Create FormData object
    formData.append("_token", $('meta[name="csrf-token"]').attr("content")); // Add CSRF token
    formData.append('title',title);
    formData.append('description',description);
    formData.append('mood_id',mood_id);
    formData.append('page','mood');
	
    toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            });
			
    $.ajax({
            url: "{{ url('store-save-mode-message')}}",
            type: "POST",
            data: formData,
            processData: false, // Prevent jQuery from processing data
            contentType: false, // Prevent jQuery from setting content-type
            success: function(response) {
				toastr.clear();
                toastr.success("Mood Successfully Saved");
                location.reload();  
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
            }
        });

}
</script>    
<style>
    .happy-mood-modal .custom-checkbox input[type="radio"]:checked+label::before {
        background-image: none;
        background-color: #8462A8 !important;
        background-size: contain;
        border: 0;
    }
    .custom-checkbox input[type="radio"]:checked+label::before {
        background-image: url(../images/checkbox-check.png);
        background-size: contain;
        border: 0;
    }

    .happy-mood-modal .custom-checkbox input[type="radio"]:checked+label span {
        color: #fff !important;
    }
</style>

<div id="save-modal-msg" class="modal happy-modal-v1">
    <div class="modal-content">
        <span class="close-modal">
            <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="close icon" onclick="close_popup_mood('save-modal-msg')"/>
        </span>
        <div class="happy-modal-content">
            <div class="form-row happy-mood-modal">

               <div class="col-100 form-group">
                    <div class="fel-title">
                        <p>Please add a journal entry here that captures why you're feeling this way (Optional)</p>
                     </div>
                </div>
           
                <div class="col-100 form-group t-l">
                        <label>Mood topic.</label>
                        <input type="hidden" name="mood_id" id="mood_id">
                        <input class="form-control" type="text" name="title" id="mood-model-title">
                </div>
                <div class="col-100 form-group t-l">
                        <label>Your thoughts</label>
                        <textarea  rows="4" name="description"  id="mood-model-description"></textarea>
                </div>
                <div class="hap-cta">
                        <button class="primary-button" type="button" onclick="SaveMoodMsgFinal()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div> 

@else 
<section class="written-journal">
    <div class="cust-container-md">
        {{ LoginUserBToBVerificationMSG() }}
    </div>
</section>               
@endif
@include('mobile.includes.foooter-tab')


<script>
    const headers = document.querySelectorAll('.accordion-header');
    headers.forEach(header => {
      header.addEventListener('click', () => {
        const item = header.parentElement;
        const openItem = document.querySelector('.accordion-item.active');
        if (openItem && openItem !== item) {
          openItem.classList.remove('active');
        }
        item.classList.toggle('active');
      });
    });
</script>


@endsection