@extends('layouts.v1.dashboard')
@section('content')	
<div class="main-panel---">
  <div class="content-wrapper">
    <div class="row"> 
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-6 mb-4 mb-xl-0">
            <div class="patient-details ">
              <div class="media">
                <div class="title-heading-icon-box-cus">
                  <i class="far fa-calendar-alt"></i>
                </div>
                <div class="media-body">
                  <h3 class="font-weight-bold"> My Pet Consultations</h3>
                 
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card card-body">
          <div class="all-consultations-box  p-3">
            
            <ul class="nav nav-tabs pet-consul-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == 'all') ? 'active' : '' }}" href="{{ url('pet-consultations') }}">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link new {{ (Request::segment(2) == 'new') ? 'active ' : '' }}" href="{{ url('pet-consultations/new') }}">New</a>
              </li>
              <li class="nav-item">
                <a class="nav-link inprogress {{ (Request::segment(2) == 'inprogress') ? 'active ' : '' }}" href="{{ url('pet-consultations/inprogress ') }}">In Progress</a>
              </li>
              <li class="nav-item">
                <a class="nav-link completed {{ (Request::segment(2) == 'complete') ? 'active ' : '' }}" href="{{ url('pet-consultations/complete') }}">Complete</a>
              </li>
              <li class="nav-item">
                <a class="nav-link cancelled {{ (Request::segment(2) == 'canceled') ? 'active ' : '' }}" href="{{ url('pet-consultations/canceled') }}">Canceled</a>
              </li>
            </ul>
            
            <div class="tab-content pt-1">	

			
			
					<div class="consultation-detail pet-consul-v51">

						
						<div class="title-th">
							<div class="cons-title">
								<p>Pet</p>
							</div>
							<div class="cons-title">
								<p>Veterinarian</p>
							</div>
							<div class="pat-title">
								<p>Date</p>
							</div>
							
							<div class="status-title">
								<p>Status</p>
							</div>
							<div class="action-title">
								<p>Consultation Details</p>
							</div>
						</div>

						
			@if($consultations)
                @foreach ($consultations as $consultation)
					<?php $gender =  $consultation['gender']=='m' ? 'Male' : 'Female'; ?>
					@include('consultation.pets.my-pet-consultations-list')		
				@endforeach		
			@else 
				
				<div class="table-detail">
					<p>Sorry No Records</p>
				</div>	
			@endif		
		</div>
			
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
function toggleDiv(userConsultation_id) {
    const div = document.getElementById("myDiv-"+userConsultation_id);
    const btn = document.getElementById("toggleBtn-"+userConsultation_id);
	if (div.style.display === "none" || div.style.display === "") {
        div.style.display = "block";
        btn.classList.add("show"); 
    } else {
        div.style.display = "none";
        btn.classList.remove("show");
    }
}
</script>
<div class="modal fade Edit-Pet common-pet" id="cancelPetConsult" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg-color">
                    <h3 class="modal-title" id="schedulepopup">Cancel Pet Consultation</h3>
                </div>
                <form action="{{ route('pets.schedule-cancel') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h4>Cancel Consulting </h4>
                        <br>
                        <input type="hidden" name="pet_id" value="">
                        <input type="hidden" name="petConsultId" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" required rows="8"
                                        name="cancellationExplanation"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer common-footer-btn">
                            <input type="submit" class="btn" value="Send" />
                            <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<?php /*

@extends('layouts.dashboard')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">My Pet Consultations</h3>
                                    <h6 class="font-weight-normal mb-0">All Consultations</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == 'all') ? 'active' : '' }}"
                                    href="{{ url('pet-consultations') }}">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(2) == 'new') ? 'active' : '' }}"
                                    href="{{ url('pet-consultations/new') }}">New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(2) == 'inprogress') ? 'active' : '' }}"
                                    href="{{ url('pet-consultations/inprogress ') }}">In Progress</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(2) == 'complete') ? 'active' : '' }}"
                                    href="{{ url('pet-consultations/complete') }}">Complete</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(2) == 'canceled') ? 'active' : '' }}"
                                    href="{{ url('pet-consultations/canceled') }}">Canceled</a>
                            </li>
                        </ul>
                       
					   
					   

                        <div class="tab-content pt-1">
                            <div id="all" class=" tab-pane active">
                                <br>
                                <h3>All</h3>
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered pet-all-data" id="pet-consultations">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Pet
                                                </th>
                                                <th>
                                                    Scheduled For
                                                </th>
                                                <th>
                                                    Veterinarian
                                                </th>
                                                <th>Consultation Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($consultations)
                                            @foreach ($consultations as $consultation)
                                            <?php $gender =  $consultation['gender']=='m' ? 'Male' : 'Female'; ?>
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td> 													
                                                    {{ ($consultation['statusName'] == 'inactive' )?'Cancel':ucfirst($consultation['statusName']); }}
                                                    @if( $consultation['statusName'] == 'new' )
                                                    <button class="btn btn-danger cancelPetConsult"
                                                        pet_id="{{ $consultation['pet_id'] }}"
                                                        petConsult="{{ $consultation['petconsultation_id'] }}">Cancel</button>
                                                    @endif
                                                </td>
                                                <td>{{ $consultation['name']. ' ('. $consultation['species'].' | '.$gender.')' }}<br />{{ 'Age: '.$consultation['years']. 'Year(s) old' }}<br />{{ 'Breed: '.$consultation['breed'] }}
                                                </td>
                                                <td>{{ jsConvertPhpDate($consultation['whenScheduled']); }}</td>
                                                <td>{{ $consultation['vet'] ? $consultation['vet']['firstName']." ".$consultation['vet']['lastName'] : " Dr. Patricia Simon "; }}
                                                </td>
                                                <td class=" table-action text-left"><span  class="details-control" ><a class="toggle-ico" href="javascript:;" data-uniqueId="{{ $no }}" ></a></span></td>
                                            </tr>
                                            <tr class="show show-{{ $no }}">
                                              <td colspan="6">
                                                <div class="row">
                                                  <form class="col-sm-12">
                                                    <div class="alert alert-default nomargin">
                                                    <div class="row">
                                                      <div class="col-sm-6" style="margin:0;">
                                                        <h4>{{ ($consultation['outcome'] && isset($consultation['outcome'][0]['outcome']))?$consultation['outcome'][0]['outcome']:'NO OUTCOME LISTED'; }}</h4>
                                                      </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <h4>Reason for the Consult <small>( patient request )</small></h4>
                                                    <p>
                                                      <?php 
                                                        if( isset($consultation['consultNotes'][0]['subjective']) && !empty($consultation['consultNotes'][0]['subjective']) ){
                                                            echo $consultation['consultNotes'][0]['subjective'];
                                                        }else{
                                                             echo 'No Answer';
                                                        }
                                                      ?> 
                                                    </p>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <h4>Consult Notes</h4>
                                                    <p><?php 
                                                        if( isset($consultation['consultNotes'][0]['plan']) && !empty($consultation['consultNotes'][0]['plan']) ){
                                                            echo $consultation['consultNotes'][0]['plan'];
                                                        }else{
                                                             echo 'No Answer';
                                                        }
                                                      ?>  </p>
                                                    <div class="clearfix"></div>
                                                    </div>
                                                  </form>
                                                </div>
                                              </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="7">
                                                    No matching records found
                                                </td>
                                            </tr>
                                                @endif
                                        </tbody>
                                    </table>
                                    <!--  <ul class="pagination">
                    <li><a href="#" class="prev">< Prev</a></li>
                    <li class="pageNumber active"><a href="#">1</a></li>
                    <li class="pageNumber"><a href="#">2</a></li>
                    <li class="pageNumber"><a href="#">3</a></li>
                    <li class="pageNumber"><a href="#">4</a></li>
                    <li class="pageNumber"><a href="#">5</a></li>
                    <li class="pageNumber"><a href="#">6</a></li>
                    <li><a href="#" class="next">Next ></a></li>
                    </ul> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade Edit-Pet common-pet" id="cancelPetConsult" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg-color">
                    <h3 class="modal-title" id="schedulepopup">Cancel Pet Consultation</h3>
                </div>
                <form action="{{ route('pets.schedule-cancel') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h4>Cancel Consulting </h4>
                        <br>
                        <input type="hidden" name="pet_id" value="">
                        <input type="hidden" name="petConsultId" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" required rows="8"
                                        name="cancellationExplanation"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer common-footer-btn">
                            <input type="submit" class="btn" value="Send" />
                            <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
*/ ?>