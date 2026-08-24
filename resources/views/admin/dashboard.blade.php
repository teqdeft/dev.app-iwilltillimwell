 @extends('admin.layouts.dashboard')
 @section('content')
 <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
 <div class="main-panel main-panel-for-modal-page all-member">
     <div class="content-wrapper">
         <div class="row">
             <div class="col-md-12 grid-margin">
                 <div class="row">
                     <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                         <h3 class="font-weight-bold">Super Admin Dashboard</h3>
                         <h6 class="font-weight-normal mb-0">Your Personalized Portal</h6>
                     </div>
                 </div>
             </div>
             <div class="quick-link-box w-100">
                 @if(permission_exist('dashboard_view'))
                 <div class="row">
                     <div class="col-md-6 col-xl-4 stretch-card transparent">
                         <div class="card card-tale v1">
                            <a href="{{ url('admin/users/subscriber') }}">
                                <div class="card-body text-white user-info-box">
                                     <div class="inner-user-info-box">
                                         <p class="fs-30 mb-4">
                                             <i class="fas fa-users"></i>
                                             </p>
                                         <p class="fs-20">Total Active Users</p>
                                     </div>

                                     <h2 class="text-white">{{ $users }}</h2>
                                </div>
                            </a>
                         </div>
                     </div>
                     <div class="col-md-6 col-xl-4 stretch-card transparent">
                         <div class="card card-light-danger v1">
                             <a href="{{ url('admin/group-counseling') }}">
                                 <div class="card-body text-white user-info-box">
                                     <div class="inner-user-info-box">
                                         <p class="fs-30 mb-4"><i class="fas fa-hospital-user"></i></p>
                                         <p class="fs-20">Total Group Counseling</p>
                                     </div>
                                     <h2 class="text-white">{{ $consultation }}</h2>
                                 </div>
                             </a>
                         </div>
                     </div>
                     <div class="col-md-6 col-xl-4 stretch-card transparent">
                         <div class="card card-tale v1">
                             <a href="{{ url('admin/users/subscriber') }}">
                                 <div class="card-body text-white user-info-box">
                                     <div class="inner-user-info-box">
                                         <p class="fs-30 mb-4"><i class="fas fa-users"></i></p>
                                         <p class="fs-20">Weekly Users</p>
                                     </div>
                                     <h2 class="text-white">{{ $weekly_users }}</h2>
                                 </div>
                             </a>
                         </div>
                     </div>
                 </div>

                 @endif
             </div>
         </div>
     </div>

     @endsection
