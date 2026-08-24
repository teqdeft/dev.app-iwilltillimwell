@extends('layouts.dashboard')
@section('content')

<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Medication Allergies</h3>
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
                     <h4 class="card-title">Add Medication Allergy</h4>
                     <form class="forms-sample" method="post" action="{{ route('store.medication.allergy', $user->id) }}" id="medication-allergy-form">
                        {{ csrf_field() }}
                        <div class=" row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Indicate any known drug allergies that you may have.</label>
                                 <input type="text" class="form-control" name="medicationAllergySearch" id="medicationAllergySearch"  placeholder="Add one allergy at a time and click Save">
                                 <div class="form-group" id="allergySearchFilter"></div>

                                 <input type="hidden" name="medicationAllergyForeignId" id="medicationAllergyForeignId">
                                 <input type="hidden" name="medicationAllergyDamConceptIdType" id="medicationAllergyDamConceptIdType">
                                 <input type="hidden" name="medicationAllergyDamConceptId" id="medicationAllergyDamConceptId">
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
                                 <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" href="{{ url('/medication-allergies/') }}">{{ Auth::user()->name }}</a>
                              </li>
                              @if ($dependents)
                              @foreach ($dependents as $dependent)
                              <li class="nav-item">

                                 @if ($dependent->age < Config::get('constants.minor_age'))
                                 <a class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}" href="{{ url('/medication-allergies/'.$dependent->id) }}" role="tab"> {{ $dependent->name }}</a>
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
                                             <h4 class=" mb-0 mr-2 lh-2 "> Indicate any known drug allergies that you may have.</h4>
                                          </div>
                                          @if (count($allergies))
                                          <div class="card-body px-0">
                                             <div class="table-responsive">
                                                <table class="table table-hover table-striped medication-table-box table-bordered">
                                                   <thead>
                                                      <tr>
                                                         <th> Medication Allergies</th>
                                                         <th> Actions</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @foreach ($allergies as $allergy)
                                                      <tr>
                                                         <td>{{ @$allergy->name }}</td>
                                                         <td>
                                                            @if (@$allergy->deleted_at == '')
                                                            <a href="{{ url('/medication-allergy-inactive/'. $allergy->addedAllergyId .'/' . $allergy->userId) }}"> <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  This medication allergy is not valid for me.</label></a>
                                                            @else
                                                            {{ 'Inactive - no actions allowed' }}
                                                            @endif
                                                            <a class="deleteByAjax" href="javascript:;" number="{{ $allergy->id }}" data-url="/medication-allergies/delete"  data-toggle="tooltip" title="Delete"><label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label></a>
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
                                             <h4 class=" mb-0 mr-2 lh-2 "> Indicate any known drug allergies that you may have.</h4>
                                          </div>
                                          @php $allergies = $dependent->user_allergies; @endphp
                                          @if (count($allergies))
                                          <div class="card-body px-0">
                                             <div class="table-responsive">
                                                <table class="table table-hover table-striped medication-table-box table-bordered">
                                                   <thead>
                                                      <tr>
                                                         <th>Medication Allergies</th>
                                                         <th>Actions</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @foreach ($allergies as $allergy)
                                                      <tr>
                                                         <td>{{ @$allergy->name }}</td>
                                                         <td>
                                                            @if (@$allergy->deleted_at == '')
                                                            <a href="{{ url('/medication-allergy-inactive/'. $allergy->addedAllergyId .'/' . $allergy->userId) }}"> <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  This medication allergy is not valid for me.</label></a>
                                                            @else
                                                            {{ 'Inactive - no actions allowed' }}
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
               <h3 class="card-title mb-0">Update  Medication Allergy</h3>
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
                              <label>Indicate any known drug allergies that you may have</label>
                              <input type="text" class="form-control"  placeholder="Medication Name" value="poria mushroom">
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
