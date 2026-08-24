@extends('layouts.dashboard')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin top-header-page">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"><i class="fas fa-file-upload"></i> Upload Medical Documents.</h3>

                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-box">
			<div class="record-tabs-box">
            <div class="row">
                <div class="col-12 stretch-card mb-3">
                    <div class="card">
						@include('HealthRecord::medications-card-header',['slug'=>'document-manager'])
                            <div class="card-body personal-info-card-box">
                                <form class="forms-sample clickOffSubmitBtn" method="post" action="{{ route('store.NottakeMedication', $user->id) }}">
                                    {{ csrf_field() }}
									<div class="docu-title">
										<label><h4 class="card-title" style="text-transform: unset;">Would you like to upload any medical documents?</h4></label>
									</div>
									
									<div class="tak-form">
										<div class="form-check-inline">
											<input class="form-check-input take_medication-check" type="radio" name="take_medication" id="take_medication-yes"
												value="yes" >
											<label class="form-check-label" for="take_medication-yes">Yes</label>
										</div>
										<div class="form-check-inline">
											<input class="form-check-input take_medication-check" type="radio" name="take_medication" id="take_medication-no"
												value="no"
												checked
												>
											<input type="hidden" name="segment" value="{{ getSegment(1) }}" >
											<label class="form-check-label" for="take_medication-no">No</label>
										</div>
									</div>
                                    <p class="errorMedicalCheck mt-3 mb-0 alert alert-danger displayNone"></p>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="col-12 stretch-card medical_show-check" id="medical_show-check" @if ( empty($inComplete) ) style="display:none;" @endif>
                    <div class="card">
                        <div class="card-body personal-info-card-box">
                            <h4 class="card-title">Attach Photos, Lab Results, X-Rays, or any medically relevant
                                documents (if any)</h4>
                            <form class="forms-sample clickOnSubmitBtn " id="upload-document" method="POST"
                                action="{{ route('upload-document', $user)}}" enctype="multipart/form-data">
                                @csrf
                                <div class=" row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="">

                                            </div>
                                            <label>File upload (Upload jpg, png, gif, pdf files only) </label>
                                            <input type="file" name="file" class="file-upload-default"
											
												    accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
													
											>
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" id="file-health-uploaded" disabled=""
                                                    placeholder="Upload Image" >
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
									
									
									
                                </div>

                                 <div class="row">
                                    <div class="col-12">
                                        <button name="save_attachement" type="submit" value="save" class="btn btn-primary mr-2">Save Attachment</button>
                                    </div>
                                </div> 
                            </form>
                        </div>
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
                                   <!-- <div class="menu-tabs-cus">
                                    <ul class="nav nav-tabs nav-tabs-neutral nav-tabs-responsive theme-bg-color" role="tablist"
                                        data-background-color="orange">
                                        <li class="nav-item">
                                            <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}"
                                                href="{{ url('/document-manager/') }}">{{ Auth::user()->name }}</a>
                                        </li>
                                        @if ($dependents)
                                        @foreach ($dependents as $dependent)
                                        <li class="nav-item">

                                            @if ($dependent->age < Config::get('constants.minor_age')) <a
                                                class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}"
                                                href="{{ url('/document-manager/'.$dependent->id) }}" role="tab">
                                                {{ $dependent->name }}</a>
                                                @else
                                                <a class="nav-link" href="javascript:void(0)"
                                                    title="This Dependent is over 18 and must manage their own records">
                                                    <span class="text-danger">*</span> {{ $dependent->name }}</a>
                                                @endif
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div> -->
                                </div>
                                <div class="card-body add-margin-cus adds">
                                    <!-- Tab panes -->
                                    <div class="tab-content p-0">
                                        <div class="tab-pane active" id="user1" role="tabpanel">
                                            <div class="row">
                                              <div class="user-name-cus-box w-100">
                                                
                                              </div>
                                                <div class="col-lg-12 grid-margin stretch-card">
                                                    <div class="card ">
                                                        <div class=" d-flex  align-items-center">
                                                            <h4 class=" mb-0 mr-2 lh-2 ">Attached Documents</h4>
                                                        </div>
                                                        <div class="card-body px-0">
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-hover table-striped medication-table-box table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="30%">Document</th>
                                                                            <th width="30%">Document Name</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse ($documents as $document)
                                                                        <tr>
                                                                            <td>
                                                                                <a href="{{ asset('uploads/documents/'.$document->name) }}"
                                                                                    target="_blank">
                                                                                    @if(pathinfo($document->name,
                                                                                    PATHINFO_EXTENSION)=="pdf")
                                                                                    <img src="{{ asset('images/pdf-icon.png') }}"
                                                                                        alt="pdf-img">
                                                                                    @else
                                                                                    <img src="{{ asset('uploads/documents/'.$document->name) }}"
                                                                                        alt="img">
                                                                                    @endif
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                            {{$document->name}}
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex mr-10">
                                                                                    
																					
																				<a class="deleteByAjax mr-10"
                                                                                    
                                                                                    data-url="{{route('documents.destroy', $document)}}"><label
                                                                                    class="badge badge-danger-cus">
																					<i class="far fa-trash-alt fa-2x"></i></label>
																				</a>
																								
																								
																								
                                                                                    
                                                                                    <form method="post"
                                                                                        id="destroy-document-form-{{$document->id}}"
                                                                                        action="{{ route('documents.destroy',$document) }}"
                                                                                        style="display:none">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                    </form>
                                                                                     <a class="download_resource userdocument mr-10"
                                                                                        data-resource="{{ asset('uploads/documents/'.$document->name) }}"
                                                                                        download
                                                                                        href="{{ asset('uploads/documents/'.$document->name) }}" target="_blank"><label
                                                                                            class="badge badge-danger-cus"><i class="fa fa-download fa-2x" aria-hidden="true"></i></label></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @empty
                                                                        <tr>
                                                                            <td colspan="7">
                                                                                No matching records found
                                                                            </td>
                                                                        </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="containerNext text-right">
									
										@if(request()->has('user_id'))
											
                                         <a href="{{ url('surgical-conditions') }}?user_id={{ request()->get('user_id') }}" class="btn btn-primary showLoaderPageLoad"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
									 
										@else 
                                         <a href="{{ url('surgical-conditions') }}" class="btn btn-primary showLoaderPageLoad"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
										 
										@endif 
										
                                        <a href="#!" next-step="{{ url('document-manager') }}" form-type="document-manager" class="btn btn-primary saveAndNextHealth ">Save & Finish</a>
										
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
    <div class="modal fade" id="updatemodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg-color">
                    <h3 class="card-title mb-0">Update Documentt</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="main-content-box">
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card mb-0">
                                <div class="card">
                                    <div class="card-body personal-info-card-box ">
                                        <h4 class="card-title">Attach Photos, Lab Results, X-Rays, or any medically
                                            relevant documents (if any)</h4>
                                        <form class="forms-sample">
                                            <div class=" row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="">

                                                        </div>
                                                        <label>File upload (Upload jpg,pdf,gif,pdf files only) </label>
                                                        <input type="file" name="img[]" class="file-upload-default">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info"
                                                                disabled="" placeholder="Upload Image">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary"
                                                                    type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save Attachment</button>
                </div>
            </div>
        </div>
    </div>


@if(count($documents))
  @push('scripts')
    <script>
    $(function(){
        $('input[name="take_medication"][value="yes"]').prop('checked', true).trigger('click').trigger('change');
    });
    </script>
   @endpush
@endif

@endsection
