 @extends('counsellor.layouts.dashboard')
 @section('content')
 <div class="main-panel main-panel-for-modal-page">
     <div class="content-wrapper">
         <div class="row">
             <div class="col-md-12 grid-margin">
                 <div class="row">
                     <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                         <h3 class="font-weight-bold">Counsellor Dashboard</h3>
                         <h6 class="font-weight-normal mb-0">Your Personalized Portal</h6>
                     </div>
                 </div>
             </div>
         <div class="quick-link-box w-100">
             <div class="row">
                 <div class="col-md-6 col-xl-3 stretch-card transparent">
                     <div class="card card-tale">
                         <a href="{{ url('personal-record') }}">
                             <div class="card-body text-white user-info-box">
                               <div class="inner-user-info-box">
                                 <p class="fs-30 mb-4"><i class="fas fa-users"></i></p>
                                 <p class="fs-20">Total Sessions</p>
                               </div>
                               <h2 class="text-white">{{ $total_sessions }}</h2>
                             </div>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
<!-- update modal  end-->
@endsection
