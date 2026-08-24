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
                    <h2 class="title">My Pet Consultations</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
</section>


<section class="custom-tab">
        <div class="cust-container-lg">
            <div class="tab-container pet-health">
                <div class="tab-header">

                    <!-- Tab Buttons -->
                    <div class="tab-buttons patient-details">

                        <a href="{{ url('pet-consultations/all')}}" class="tab-link {{ (Request::segment(2) == '' || Request::segment(2) == 'all') ? 'active' : '' }}" data-tab="tab-all">All</a>
                        <a href="{{ url('pet-consultations/new')}}" class="tab-link {{ (Request::segment(2) == 'new') ? 'active' : '' }}" data-tab="tab-progress">New</a>
                        <a href="{{ url('pet-consultations/inprogress')}}" class="tab-link {{ (Request::segment(2) == 'inprogress') ? 'active' : '' }}" data-tab="tab-progress">In Progress</a>
                        <a href="{{ url('pet-consultations/complete')}}" class="tab-link {{ (Request::segment(2) == 'complete') ? 'active' : '' }}" data-tab="tab-complete">Complete</a>
                        <a href="{{ url('pet-consultations/canceled')}}" class="tab-link {{ (Request::segment(2) == 'canceled') ? 'active' : '' }}" data-tab="tab-canceled">Canceled</a>
                        
                    </div>
                </div>

                <div class="tab-content-detail">

                    <!-- Tab Content -->
                    <div id="tab-all" class="tab-content active">
                        <div class="health-tab-content">
                            <div class="helath-title">
                                <p>All</p>
                            </div>
                            <div class="helth-card-row">
							
	<div class="search-form">
		<form class="form-row">
			<div class="col-100 form-group">
				<input class="form-control" type="text" name="searchInput" id="searchInput" placeholder="Search">
			</div>
		</form>
	</div>


     @if($consultations)
        @foreach ($consultations as $consultation)

        <?php $gender =  $consultation['gender']=='m' ? 'Male' : 'Female'; ?>

                                <div class="card-pet-health">

                

                                    <div class="top">
                                        <div class="pet-img">
                                            <img src="{{ asset('assets/dashboard/assets/images/pet-image-card.svg') }}" alt="image">
                                        </div>
                                        <div class="crd-right">
                                            <div class="name">
                                                <p>{{ $consultation['name'] }} ( {{ $consultation['species'] }}  | {{ $gender }})</p>
                                            </div>
                                            <div class="date">
                                                <p>{{ jsConvertPhpDate($consultation['whenScheduled']); }}</p>
                                            </div>
                                            <div class="age">
                                                <p>Age: {{$consultation['years']}} Year(s) old</p>
                                            </div>
                                            <div class="brid">
                                                <p>Breed: {{$consultation['breed']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="no-outcome">
                                        <div class="out-title">
                                            <p>{{ ($consultation['outcome'] && isset($consultation['outcome'][0]['outcome']))?$consultation['outcome'][0]['outcome']:'NO OUTCOME LISTED'; }}</p>
                                        </div>
                                        <div class="out-content">
                                            <div class="cont-title">
                                                <p>Reason for the Consult ( patient request )</p>
                                            </div>
                                            <div class="cont-detail">
                                                <p>test 3434</p>
                                            </div>
                                        </div>
                                        <div class="out-content">
                                            <div class="cont-title">
                                                <p>Consult Notes</p>
                                            </div>
                                            <div class="cont-detail">
                                                <p>

                                                <?php 
                                                        if( isset($consultation['consultNotes'][0]['subjective']) && !empty($consultation['consultNotes'][0]['subjective']) ){
                                                            echo $consultation['consultNotes'][0]['subjective'];
                                                        }else{
                                                             echo 'No Answer';
                                                        }
                                                      ?> 
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <div class="left">
                                            <p>Veterinarian : <span>
                                                {{ $consultation['vet'] ? $consultation['vet']['firstName']." ".$consultation['vet']['lastName'] : " Dr. Patricia Simon "; }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="right-button">
                                            <button class="pent-helth-btn canceled">
                                                {{ ($consultation['statusName'] == 'inactive' )?'Cancel':ucfirst($consultation['statusName']); }}

                                            </button>
                                        </div>
                                    </div>
									
									<div class="bottom"> 
										<div class="left"></div>
										<div class="right-button">
											@if( $consultation['statusName'] == 'new' )
															
											<button class="pent-helth-btn canceled cancelPetConsult"
												pet_id="{{ $consultation['pet_id'] }}"
												petConsult="{{ $consultation['petconsultation_id'] }}"> Cancel Schedule</button>
												
											@endif
										</div>				
									</div>				
													
                                </div>
        @endforeach
    @else

    <div class="card-pet-health">
        <p>Sorry No Records</p>
    </div>

    @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>   
@include('mobile.includes.foooter-tab')


<script>
        // JavaScript for tab functionality
const tabLinks = document.querySelectorAll('.tab-link');
const tabContents = document.querySelectorAll('.tab-content');
const tabButtonsContainer = document.querySelector('.tab-buttons');
function scrollToActiveTab() {
        const activeLink = document.querySelector('.tab-link.active');
        if (activeLink && tabButtonsContainer) {
            const buttonRect = activeLink.getBoundingClientRect();
            const containerRect = tabButtonsContainer.getBoundingClientRect();
            const offset = buttonRect.left - containerRect.left - containerRect.width / 2 + buttonRect.width / 2;
            tabButtonsContainer.scrollBy({
                left: offset,
                behavior: 'smooth'
            });
        }
    }   
    
    window.addEventListener('DOMContentLoaded', () => {
       
        scrollToActiveTab();
    });

$(document).ready(function () {
    $("#searchInput").on("keyup", function () {
		
        var searchText = $(this).val().toLowerCase();
		var matchCount = 0;
        $(".card-pet-health").each(function () {
            var titleText = $(this).find("p").text().toLowerCase();

            if (titleText.includes(searchText)) {
                $(this).show();
				matchCount++;
            } else {
                $(this).hide();
            }
			console.log(matchCount);
			if (matchCount === 0) {
				if ($("#noResults").length === 0) {
					$(".helth-card-row").append('<div id="noResults" style="position: relative;border: 1px solid #E9E7EB;border-radius: 20px;padding: 20px;margin-bottom: 20px;"><div  class="no-results">No records found</div></div>');
				}
			} else {
				$("#noResults").remove();
			}
			
        });
    });
});
$(document).on("click", ".cancelPetConsult", function() {
	
	let pet_id = $(this).attr('pet_id');
	let petconsultation_id = $(this).attr('petconsult');
	
	$("#pet_idc").val(pet_id);
	$("#petConsultIdc").val(petconsultation_id);
	
    $("#pet-consultation-cancel").css("display","flex");
});
function cancel_tab() {
	$("#pet-consultation-cancel").css("display","none");
}
function submit_cancel() {
	
	let cancellationExplanation = $("#cancellationExplanation").val();
	
}
</script>


<div id="pet-consultation-cancel" class="modal journal-modal pet-modal-edit">
        <div class="modal-content">
            <span class="close-modal"  onclick="cancel_tab()">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="form-ed form-max-v1">
					<div class="mod-step">
						<div class="title-ed">
							<p>Cancel Pet Consultation</p>
						</div>
					</div>
                    <div class="patient-tab-content v2">
                        <form class="form-row" id="pet-swhatSeems" action="{{ route('pets.schedule-cancel') }}" method="post">
							@csrf
							
							<input type="hidden" name="pet_id" id="pet_idc" value="">
							<input type="hidden" name="petConsultId" id="petConsultIdc" value="">
						
                            <div class="col-100 form-group">
                                <label>Cancel Consulting.</label>
                                <textarea name="cancellationExplanation" id="cancellationExplanation" rows="5"></textarea>
                            </div>
                            <div class="what-seems">
                                <div class="next">
                                    <button type="submit" class="open-modal outline-button">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection  