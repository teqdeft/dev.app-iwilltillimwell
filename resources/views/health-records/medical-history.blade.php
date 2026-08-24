@extends('layouts.dashboard')
@section('content')

<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Medical History</h3>
                  <h6 class="font-weight-normal mb-0">Your Personalized Health Portal</h6>
               </div>
            </div>
         </div>
      </div>
      <div class="main-content-box">
         <div class="row">
            <div class="col-12 grid-margin stretch-card">
               <div class="card">
                  <div class="card-body personal-info-card-box">
                     <h4 class="card-title">Add New Medical History Record</h4>
                     <form class="forms-sample" method="post" action="{{ route('store.medicalcondition', $user->id) }}" id="medication-condition-form">
                        {{ csrf_field() }}
                        <div class=" row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Condition Name</label>
                                 <input type="text" class="form-control" placeholder="Condition Name" name="medicalConditionName">
                              </div>
                           </div>
                        </div>
                        <div class=" row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label>Description</label>
                                 <textarea class="form-control" id="exampleTextarea1" rows="6" placeholder="Description" name="medicalConditionDescription"></textarea>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label>Status</label>
                                 <div class="d-flex custom-check-box">
                                    <div class="form-check mr-5">
                                       <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="medicalConditionStatus" id="optionsRadios3" value="1">
                                          Current Condition
                                          <i class="input-helper"></i></label>
                                       </div>
                                       <div class="form-check">
                                          <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="medicalConditionStatus" id="optionsRadios4" value="2" >
                                               Previous Condition 
                                             <i class="input-helper"></i></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="record-tabs-box">
               <div class="inner-record-tab-box">
                  <div class="container-fluid mt-3">
                     <div class="row">
                        <div class="col-md-12 ml-auto col-xl-12 mr-auto px-0">
                           <div class="card">
                              <div class="card-header ">
                                <div class="ip-hamburger-icon d-flex align-items-center">
                                  <ul>
                                      <li></li>
                                      <li></li>
                                      <li></li>

                                   </ul>
                                   <h5 class="fs-16 mb-0">Members</h5>
                                 </div>
                                <div class="menu-tabs-cus">
                                 <ul class="nav nav-tabs nav-tabs-neutral nav-tabs-responsive theme-bg-color" role="tablist" data-background-color="orange">
                                    <li class="nav-item">
                                       <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" href="{{ url('/medical-history/') }}">{{ Auth::user()->name }}</a>
                                    </li>
                                    @if ($dependents)
                                    @foreach ($dependents as $dependent)
                                    <li class="nav-item">

                                       @if ($dependent->age < Config::get('constants.minor_age'))
                                       <a class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}" href="{{ url('/medical-history/'.$dependent->id) }}" role="tab"> {{ $dependent->name }}</a>
                                       @else
                                       <a class="nav-link" href="javascript:void(0)" title="This Dependent is over 18 and must manage their own records"> <span class="text-danger">*</span> {{ $dependent->name }}</a>
                                       @endif
                                    </li>
                                    @endforeach
                                    @endif
                                 </ul>
                               </div>
                              </div>
                              <div class="card-body add-margin-cus adds">
                                 <!-- Tab panes -->
                                 <div class="tab-content p-0">
                                    <div class="tab-pane {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" id="user{{ Auth::user()->id }}" role="tabpanel">
                                       <div class="row">
                                         <div class="user-name-cus-box w-100">
                                           <h4 class="px-3"><?= $user->fname." ".$user->lname ?></h4>

                                         </div>
                                          <div class="col-lg-12 grid-margin stretch-card">
                                             <div class="card ">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Describe any chronic or acute medical issues that you have experienced. Be as detailed as possible.</h4>
                                                </div>
                                                @if (count($medicalConditions))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Condition Name</th>
                                                               <th width="20%">Status</th>
                                                               <th>Description</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($medicalConditions as $medicalCondition)
                                                            <tr>
                                                               <td>{{ $medicalCondition->name }}</td>
                                                               <td>{{ ($medicalCondition->status == 1) ? 'Current Condition' : 'Previous Condition' }}</td>
                                                               <td>{{ $medicalCondition->description }}</td>
                                                               <!-- <td>
                                                                  <div class="d-flex ">
                                                                     <a href="#0" class=" mr-2 medicalHistoryPopupClick" data-toggle="modal" data-id="{{ $medicalCondition->medicalConditionId }}" data-target="#updatemodal2"><label class="badge badge-success badge-danger-cus"><i class="fas fa-edit mr-1 "></i> Update</label></a>
                                                                     <a href="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}" class="beforeRedirect"> <label class="badge badge-danger-cus"><i class="far fa-trash-alt mr-2"></i>Delete</label></a>
                                                                  </div>
                                                               </td> -->
                                                               <td>
                                                                  <div class="d-flex ">
                                                                      <a href="#0" class=" mr-2 medicalHistoryPopupClick" data-toggle="modal" data-id="{{ $medicalCondition->medicalConditionId }}" data-target="#updatemodal2"><label class="badge badge-success badge-danger-cus"><i class="fas fa-edit mr-1 "></i> Update</label></a>
                                                                     <a class="delete_resource"
                                                                           data-resource="{{ 'destroy-medical-history-form-'.$medicalCondition->medicalConditionId }}"
                                                                           href="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"><label
                                                                              class="badge badge-danger-cus"><i
                                                                                 class="far fa-trash-alt mr-2"></i>Delete</label></a>
                                                                     </li>
                                                                     <form method="post"
                                                                           id="destroy-medical-history-form-{{$medicalCondition->medicalConditionId}}"
                                                                           action="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"
                                                                           style="display:none">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                     </form>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                            @endforeach
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                                @endif
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    @if ($dependents)
                                    @foreach ($dependents as $dependent)
                                    <div class="tab-pane {{ ($user->id == $dependent->id) ? 'active' : '' }}" id="user{{ $dependent->id }}" role="tabpanel">
                                       <div class="row">
                                          <div class="col-lg-12 grid-margin stretch-card">
                                             <div class="card ">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Describe any chronic or acute medical issues that you have experienced. Be as detailed as possible.</h4>
                                                </div>
                                                @php $medicalConditions = $dependent->user_medical_condition; @endphp
                                                @if (count($medicalConditions))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Condition Name</th>
                                                               <th width="20%">Status</th>
                                                               <th>Description</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($medicalConditions as $medicalCondition)
                                                            <tr>
                                                               <td>{{ $medicalCondition->name }}</td>
                                                               <td>{{ ($medicalCondition->status == 1) ? 'Current Condition' : 'Previous Condition' }}</td>
                                                               <td>{{ $medicalCondition->description }}</td>
                                                               <td>
                                                                  <div class="d-flex ">
                                                                     <a href="#0" class=" mr-2 medicalHistoryPopupClick" data-id="{{ $medicalCondition->medicalConditionId }}" data-toggle="modal" data-target="#updatemodal2"><label class="badge badge-success badge-danger-cus"><i class="fas fa-edit mr-1 "></i> Update</label></a>
                                                                     <a class="delete_resource"
                                                                           data-resource="{{ 'destroy-medical-history-form-'.$medicalCondition->medicalConditionId }}"
                                                                           href="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"><label
                                                                              class="badge badge-danger-cus"><i
                                                                                 class="far fa-trash-alt mr-2"></i>Delete</label></a>
                                                                     </li>
                                                                     <form method="post"
                                                                           id="destroy-medical-history-form-{{$medicalCondition->medicalConditionId}}"
                                                                           action="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"
                                                                           style="display:none">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                     </form>
                                                                  </div>
                                                               </td>
                                                         </tr>
                                                         @endforeach
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 @endforeach
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- update modal  start-->
      <div class="modal fade" id="updatemodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content" id="showMedicalHistoryPopup"></div>
         </div>
      </div>
      @endsection
