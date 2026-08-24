@extends('layouts.v1.dashboard')
@section('content')
@if(LoginUserBToBVerification())
<div class='moodContainer content-wrapper'>
	@include('services.moods.what-is-mood-content')
    <div class="card--white full-height feels-view">
		<div class="cust-heading-wrap">
            <h3 class="cust-heading cust-heading-view"></h3>
            <div class="mood-cta">
				<a class="mood-view-icon" href="{{ url('my-mood-feeling-history')}}">View log <i class="fas fa-eye" aria-hidden="true"></i></a>
			</div>
		</div>
		
        <form action="{{ url('my-mood-feeling-save') }}" method="POST">
            @csrf
            <input type="hidden" name="mood_number" >
            
            <p class="sub-heading"></p>
            <div id="mood-faces-row" class="mood-feels-row row">
                <div class="mood-feels-row-left">
                    <div class="mood-feels-scroll remove-scroll">
                        @if ( $physically )
                        @foreach ($physically as $key => $value )
                        <div class="mood-feels-cell col">
                            <div class="mood-feels-icons mood-face-max-row">
                                <div class="mood-feels-img-wrap" key-type="physically"
                                    key-name="{{ str_replace(':','',$key) }}" emojino="{{ $value['number'] }}">
                                    <img src="{{ asset($value['image']) }}">
                                    <input type="radio" value="{{ $key }}" name="physicallyParent" id="{{ $key }}"
                                        style="display:none;">
                                    <label title="" for="{{ $key }}" class="mood-face-label">
                                        {{ ucfirst(str_replace(':','',$key)) }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                    <div class="cust-moods-block">
                        <div class="selectedMoodParent">
                        </div>
                        @foreach ($physically as $key => $value )
                        <div
                            class="moods-face-dynamic moods-child-physically mood-child-physically-{{ str_replace(':','',$key) }}">

                            <div class="mood-face-l-one">
                                @foreach ($value['child'] as $childKey => $childValue )
                                <div class="moods-radiobtn">
                                    <input type="radio" id="phy-{{ str_replace(':','',$childKey) }}"
                                        name="physicallyChild" value="{{ $childKey }}" />
                                    <label for="phy-{{ str_replace(':','',$childKey) }}"
                                        keyname="{{ str_replace(':','',$childKey) }}" key-type="physically"
                                        class="childMoodfaces @if( str_replace(':','',$childKey) == 'OTHER' ) otherChildMood @endif" @if( str_replace(':','',$childKey) == 'OTHER' ) data-toggle="modal"   data-backdrop="static" data-target="#exampleModalOther" @endif mainMood="{{ str_replace(':','',$key) }}" >{{ str_replace(':','',$childKey) }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <div class="selectedMoodChild">
                        </div>
                        @foreach ($physically as $key => $value )
                        @foreach ($value['child'] as $childKey => $childValue )
                        <div
                            class="moods-face-dynamic moods-face-subChild-physically mood-subChild-physically-{{ str_replace(':','',$key) }}-{{ str_replace(':','',$childKey) }}" >
                            <div class="mood-face-l-one ">
                                @foreach ($childValue as $subChildKey => $subChildValue )
                                <div class="moods-radiobtn ">
                                    <input type="radio" id="phy-sub-{{ $subChildValue }}" name="physicallySubChild"
                                        value="{{ $subChildKey }}" />
                                    <label for="phy-sub-{{ $subChildValue }}" class="subChildMood @if( str_replace(':','',$subChildValue) == 'OTHER' ) otherSubChildMood @endif"
                                        key-type="physically" keynamechild="{{ $subChildValue }}" @if( $subChildValue == 'OTHER' ) data-toggle="modal" data-backdrop="static" data-target="#exampleModalOtherChild" @endif mainMood="{{ str_replace(':','',$key) }}" >{{ $subChildValue }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        <div class="selectedMoodSubChild">
                        </div>
                    </div>
                </div>
            </div>
            <div class="link-btn-wrap common-view-foot">
                <button type="submit" class="theme-dark__btn btn btn-primary floatRight saveMood" style="display: none;">Save</button>
            </div>
        </form>
        
    </div>


    <!-- Modal -->
    <div class="modal fade my-mood-feeling-custom-mood" id="exampleModalOther" tabindex="-1" role="dialog" aria-labelledby="exampleModalOtherTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Your Custom Mood</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="customMood" class="form-control" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary submitOtherMood">Save</button>
            </div>
            </div>
        </div>
    </div>

       <!-- Modal -->
    <div class="modal fade my-mood-feeling-custom-mood" id="exampleModalOtherChild" tabindex="-1" role="dialog" aria-labelledby="exampleModalOtherChildTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Your Custom Mood</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="customMoodChild" class="form-control" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary submitOtherMood">Save</button>
            </div>
            </div>
        </div>
    </div>

    <!--  mood journal popup -->
    <div class="modal modal-MoodJournal fade my-mood-feeling-main" id="moodJournal" tabindex="-1" role="dialog" aria-labelledby="moodJournalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onClick="(function(){
                                                    location.reload()
                                                })();return false;" >&times;</span>
                </button>
                
            </div>
			
			<div class="mood-detail">
				<div class="card-image">
                    <img src="{{ asset('assets/assets/images/tick-mark-icon.png') }}" alt="icon" />
				</div>
				
                    
<h5 class="modal-title" id="moodJournalLabel" style="color:#5E2E8A;">Today's mood and feelings have been saved</h5>
					
					
					
					<div class="text">
                    <p>Please add a journal entry here that captures why you're feeling this way (Optional)</p>
					</div>
            </div>
				
            <form class="post-form" action="javascript:void(0)" method="post" id="corporateJournal"
                novalidate="novalidate">
                @csrf
                <div class="modal-body">
                    <div class="form-group">

                    <input type="hidden" name="mood_id" id="mood_id">
                    <input placeholder="Create your today's mood topic" name="title" id="mood_title" class="form-control" value="">

                    </div>
                    <div class="form-group">
                        <div class="journalDesc">
                            <textarea placeholder="Type your thoughts" name="description"
                                id="mood_description" class="cust-textarea form-control" spellcheck="false"
                                rows="5"></textarea>
                        </div>
                    </div>
                    <div class="mood-journa-s51">
                        <button type="button" class="btn btn-secondary btn-sm outline-button" data-dismiss="modal" onClick="(function(){
                                                        location.reload()
                                                    })();return false;">Skip</button>
                        <input type="button" class="btn btn-primary moodTopic btn-sm" value="Save" onClick="SaveMoodMsgFinal()">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div>

<style> 
.MoodJournal-top img {
    max-width: 80px;
}
.modal-MoodJournal .modal-dialog button.close {
    position: absolute;
    right: 30px;
}
.MoodJournal-top h5 {
    font-size: 30px;
    margin: 15px 0 12px;
    font-weight: 600;
    line-height: 1.3;
}
.MoodJournal-top p {
    font-size: 20px !important;
}
.modal-header .close {
    padding: 1rem 1rem;
    margin: -25px -26px -25px auto;
}
</style>

@else

<div class="main-panel">
    <div class="content-wrapper">
		<div class="row">
        <div class="col-12 grid-margin stretch-card btob-admin">
                <div class="card card-body">
                 {{ LoginUserBToBVerificationMSG() }}
             </div>
        </div>
    </div>
@endif

<script>
function SaveMoodMsgFinal() {


    let title  = $("#mood_title").val();
    let description  = $("#mood_description").val();
    let mood_id  = $("#mood_id").val();

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
@push('scripts')
<script>
$(document).on("keyup", "input[name=customMoodChild]", function(e) {
    e.preventDefault();
    let customValue = $(this).val().toUpperCase();
    if (customValue.length > 0) {
        $(".subChildMood").each(function() {
            if ($(this).attr("keynamechild") == "OTHER") {
                $(this)
                    .siblings("input[name=physicallySubChild]")
                    .val(`:${customValue}:`);
                $(this).text(customValue);
            }
        });
    } else {
        $(this)
            .siblings("input[name=physicallySubChild]")
            .val(`:OTHER:`);
        $(`.otherSubChildMood`).text("OTHER");
    }
    $(".submitOtherMood").attr("data-dismiss", "modal");
});
$(document).on("keyup", "input[name=customMood]", function(e) {
    e.preventDefault();
    let customValue = $(this).val().toUpperCase();
    if (customValue != '') {
        $(".childMoodfaces").each(function() {
            if ($(this).attr("keyname") == "OTHER") {
                $(this)
                    .siblings("input[name=physicallyChild]")
                    .val(`:${customValue}:`);
                $(this).html(customValue);
                $(".selectedMoodChild").html(
                    `<h3> I Feel ${customValue} because I feel </h3>`
                );
            }
        });
    } else {
        $(this).siblings("input[name=physicallyChild]").val(`:OTHER:`);
        $(`.otherChildMood`).text("OTHER");
        $(".selectedMoodChild").html(`<h3> I Feel OTHER because I feel </h3>`);
    }
    $(".submitOtherMood").attr("data-dismiss", "modal");
});
</script>
@endpush
@endsection
