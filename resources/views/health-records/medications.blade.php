@extends('layouts.dashboard')
@section('content')

<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Medications Health Records</h3>
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
                     <h4 class="card-title">Add Medication Record</h4>
                     <form class="forms-sample" method="post" action="{{ route('store.medication', $user->id) }}" id="medication-form">
                        {{ csrf_field() }}
                        <div class=" row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Medication Search</label>
                                 <input type="text" class="form-control" name="medicationSearch" placeholder="Medication Search" id="medicationSearch">
                                 <div class="form-group" id="searchFilter"></div>
                                 <input type="hidden" name="medicationForeignId" id="medicationForeignId" value="">
                                 <input type="hidden" name="medicationNDC" id="medicationNDC" value="">
                              </div>
                           </div>
                        </div>
                        <div class=" row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Frequency</label>
                                 <input type="text" class="form-control" name="medicationFrequency" placeholder="Frequency">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="exampleTextarea1">Comment</label>
                                 <textarea class="form-control" id="exampleTextarea1" name="medicationComment" rows="7"></textarea>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label>Currently Using</label>
                                 <div class="d-flex custom-check-box">
                                    <div class="form-check mr-5">
                                       <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="medicationCurrentUse" id="optionsRadios1" value="true">
                                          Yes
                                          <i class="input-helper"></i></label>
                                       </div>
                                       <div class="form-check">
                                          <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="medicationCurrentUse" id="optionsRadios2" value="false">
                                             No
                                             <i class="input-helper"></i></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
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
                                         <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" href="{{ url('/medications/') }}">{{ Auth::user()->name }}</a>
                                      </li>
                                      @if ($dependents)
                                      @foreach ($dependents as $dependent)
                                      <li class="nav-item">

                                         @if ($dependent->age < Config::get('constants.minor_age'))
                                         <a class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}" href="{{ url('/medications/'.$dependent->id) }}" role="tab"> {{ $dependent->name }}</a>
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
                                             <div class="card-box card">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Please indicate the drug type, dosage, and frequency of any medications you have taken/are currently taking.</h4>
                                                </div>
                                                @if (count($medications))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Medication</th>
                                                               <th>Frequency</th>
                                                               <th>Currently taking?</th>
                                                               <th>Comment</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($medications as $medication)
                                                            <tr>
                                                               <td>{{ @$medication->name }}</td>
                                                               <td>{{ @$medication->frequency }}</td>
                                                               <td class="{{ ($medication->currentlyUse == true) ? 'text-danger' : 'text-success' }}">
                                                                  {{ (@$medication->currentlyUse == 'true') ? 'Yes' : 'No' }}
                                                               </td>
                                                               <td>{{ @$medication->comment }}</td>
                                                               <td>
                                                                  @if (@$medication->currentlyUse == 'true')
                                                                  <a href="{{ url('/medication-inactive/'. $medication->medicationId .'/' . $medication->userId) }}" id="medication-inactive"> <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  I"m no longer taking this medication</label></a>
                                                                  @else
                                                                  <span>-</span>
                                                                  @endif
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
                                             <div class="card">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Indicate the drug type, dosage, and frequency of any medications you have taken/are currently taking.</h4>
                                                </div>
                                                @php $medications = $dependent->user_medications; @endphp
                                                @if (count($medications))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Medication</th>
                                                               <th>Frequency</th>
                                                               <th>Currently taking?</th>
                                                               <th>Comment</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($medications as $medication)
                                                            <tr>
                                                               <td>{{ @$medication->name }}</td>
                                                               <td>{{ @$medication->frequency }}</td>
                                                               <td class="{{ ($medication->currentlyUse == true) ? 'text-danger' : 'text-success' }}">
                                                                  {{ (@$medication->currentlyUse == 'true') ? 'Yes' : 'No' }}
                                                               </td>
                                                               <td>{{ @$medication->comment }}</td>
                                                               <td>
                                                                  @if (@$medication->currentlyUse == 'true')
                                                                  <a href="{{ url('/medication-inactive/'. $medication->medicationId .'/' . $medication->userId) }}"> <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  I"m no longer taking this medication</label></a>
                                                                   @else
                                                                  <span>-</span>
                                                                  @endif
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
               <div class="modal-content">
                  <div class="modal-header theme-bg-color">
                     <h3 class="card-title mb-0">Update Medication Record</h3>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="card-body personal-info-card-box p-0">
                        <form class="forms-sample">
                           <div class=" row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Medication Name</label>
                                    <input type="text" class="form-control"  placeholder="Medication Name" value="parachlorophenol (bulk) 100 % powder">
                                 </div>
                              </div>
                           </div>
                           <div class=" row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Frequency</label>
                                    <input type="text" class="form-control"  placeholder="Frequency">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <label for="exampleTextarea1">Comment</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="7"></textarea>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <label>Currently Using</label>
                                    <div class="d-flex custom-check-box">
                                       <div class="form-check mr-5">
                                          <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                                             Yes
                                             <i class="input-helper"></i></label>
                                          </div>
                                          <div class="form-check">
                                             <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked="">
                                                No
                                                <i class="input-helper"></i></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                     </div>
                  </div>
               </div>
               @endsection
