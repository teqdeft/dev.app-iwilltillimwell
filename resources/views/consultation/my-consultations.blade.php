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

                  <h3 class="font-weight-bold"> My Consultations</h3>

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

            

			@php
        
      $check_value = 0; 
      $action = request()->get('action');
      if(empty($action)) {
        $action = "medical";
      }
      $categories = ($action == "medical") ? ['Urgent Care', 'Primary Care', 'Dermatology'] : ['Psychologist', 'Psychiatrist'];

      @endphp

			

            <ul class="nav nav-tabs" role="tablist">

              <li class="nav-item">

                <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == 'all') ? 'active' : '' }}" href="{{ url('my-consultations') }}?action={{$action}}">All</a>

              </li>

              <li class="nav-item">

                <a class="nav-link new {{ (Request::segment(2) == 'new') ? 'active ' : '' }}" href="{{ url('my-consultations/new') }}?action={{$action}}">New</a>

              </li>

              <li class="nav-item">

                <a class="nav-link inprogress {{ (Request::segment(2) == 'inprogress') ? 'active ' : '' }}" href="{{ url('my-consultations/inprogress') }}?action={{$action}}">In Progress</a>

              </li>

              <li class="nav-item">

                <a class="nav-link completed {{ (Request::segment(2) == 'complete') ? 'active ' : '' }}" href="{{ url('my-consultations/complete') }}?action={{$action}}">Complete</a>

              </li>

              <li class="nav-item">

                <a class="nav-link cancelled {{ (Request::segment(2) == 'canceled') ? 'active ' : '' }}" href="{{ url('my-consultations/canceled') }}?action={{$action}}">Canceled</a>

              </li>

            </ul>

            

            <div class="tab-content pt-1">	



			

			

					<div class="consultation-detail">



						

						<div class="title-th">

							<div class="cons-title">

								<p>Consultation</p>

							</div>

							<div class="pat-title">

								<p>Patient</p>

							</div>

							<div class="date-title">

								<p>Date</p>

							</div>

							<div class="status-title">

								<p>Status</p>

							</div>

							<div class="action-title">

								<p>Actions</p>

							</div>

						</div>




            

                @if($consultations)

                    @foreach ($consultations as $consultation)

                        @if(in_array($consultation['friendlySubTypeName'], $categories))

                            @php 
                                $check_value = 1; 

                                if(checkCurrentDatePass($consultation['whenScheduled'])) {
                                    $consultation['statusName'] = "Complete";
                                }
                            @endphp 

                            @include('consultation.my-consultations-list')

                        @endif       

                    @endforeach

                @endif 

                @if($check_value == 0)
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

@endsection