 @extends('admin.layouts.dashboard')
 @section('content')
 <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
 <div class="main-panel main-panel-for-modal-page">
     <div class="content-wrapper">
         <div class="row">
             <div class="col-md-12 grid-margin">
                 <div class="row">
                     <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                         <h3 class="font-weight-bold">Admin Dashboard</h3>
                         <h6 class="font-weight-normal mb-0">Your Personalized Portal</h6>
                     </div>
                 </div>
             </div>
             <div class="quick-link-box w-100">
                 @if(permission_exist('dashboard_view'))
                 <div class="row">
                     <div class="col-md-6 col-xl-3 stretch-card transparent">
                         <div class="card card-tale">
                             <a href="{{ url('personal-record') }}">
                                 <div class="card-body text-white user-info-box">
                                     <div class="inner-user-info-box">
                                         <p class="fs-30 mb-4"><i class="fas fa-users"></i></p>
                                         <p class="fs-20">Total Users</p>
                                     </div>

                                     <h2 class="text-white">{{ $users }}</h2>
                                 </div>
                             </a>
                         </div>
                     </div>
                     <div class="col-md-6 col-xl-3 stretch-card transparent">
                         <div class="card card-light-danger">
                             <a href="{{ url('medical-history') }}">
                                 <div class="card-body text-white user-info-box">
                                     <div class="inner-user-info-box">
                                         <p class="fs-30 mb-4"><i class="fas fa-hospital-user"></i></p>
                                         <p class="fs-20">Total Consultations</p>
                                     </div>
                                     <h2 class="text-white">{{ $consultation }}</h2>
                                 </div>
                             </a>
                         </div>
                     </div>
                     <div class="col-md-6 col-xl-3 stretch-card transparent">
                         <div class="card card-tale">
                             <a href="{{ url('personal-record') }}">
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
                     <div class="col-md-6 col-xl-3 stretch-card transparent">
                         <div class="card card-light-danger">
                             <a href="{{ url('medical-history') }}">
                                 <div class="card-body text-white user-info-box">
                                     <div class="inner-user-info-box">
                                         <p class="fs-30 mb-4"><i class="fas fa-hospital-user"></i></p>
                                         <p class="fs-20">Weekly Consultations</p>
                                     </div>
                                     <h2 class="text-white">{{ $weekly_consultations }}</h2>
                                 </div>
                             </a>
                         </div>
                     </div>
                 </div>


                 <div class="row marginTop60">
                      <div class="col-md-12">
                        <div class="graphButtonContent">
                            <div class="graphButton">
                                <a href="{{ url('admin/dashboard') }}" class="btn btn-primary @if ( !isset($_GET['graph']) )
                                    active
                                @endif ">Month</a>
                                <a href="{{ url('admin/dashboard?graph=Week') }}" class="btn btn-primary @if ( isset($_GET['graph']) && $_GET['graph'] == 'Week' )
                                    active
                                @endif ">Week</a>
                                <a href="{{ url('admin/dashboard?graph=Year') }}" class="btn btn-primary @if ( isset($_GET['graph']) && $_GET['graph'] == 'Year' )
                                    active
                                @endif">Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="moodheaderGraph">
                            <h3> Fellings ( 
                                    @php $type = ''; @endphp
                                    @if (isset($_GET['graph']))
                                        @php $type = $_GET['graph']; @endphp
                                    @endif
                                    {{ graphDataBydate($type) }}
                                ) </h3>
                        </div>
                        <div id="chart">
                        </div>
                        <div id="chartEmo">
                        </div>
                    </div>
                 </div>

                 @endif
             </div>
         </div>
     </div>
     <!-- update modal  end-->
     <script src="https://unpkg.com/frappe-charts@1.6.1/dist/frappe-charts.min.umd.js"></script>

     <script>
         @if ( isset($physically) && !empty($physically) )
            var frappeData = JSON.parse('<?= $physically ?>');

            var dataSetsGraph = [];
        
            const data = {
                labels: frappeData.labals,
                datasets: frappeData.graphData
            }
            
            new frappe.Chart("#chart", {
                title: "Physically Mood",
                data: data,
                type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 600,
                colors: frappeData.graphColor,
                lineOptions: {
                    dotSize: 8 // default: 4
                },
            })

             
         @endif

         @if ( isset($emotionally) && !empty($emotionally) )
            var frappeDataemotionally = JSON.parse('<?= $emotionally ?>');
            const dataemotionally = {
                labels: frappeDataemotionally.labals,
                datasets: frappeDataemotionally.graphData
            }
            new frappe.Chart("#chartEmo", {
                title: "Emotionally Feel",
                data: dataemotionally,
                type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 600,
                colors: frappeDataemotionally.graphColor,
                lineOptions: {
                    dotSize: 8 // default: 4
                },
            })

             
         @endif
            
    </script>
     @endsection