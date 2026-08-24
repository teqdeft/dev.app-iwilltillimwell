@extends("mobile.layouts.dashboard")

@section("content")



<section class="msg-special-header">

        <div class="cust-container-md">

            <div class="rec-row">

                <div class="back">

                    <a href="{{ route('pet-health') }}" class="back-btn">

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"

                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>

                        </svg>

                    </a>

                </div>

                <div class="top-title">

                    <h2 class="title">My Pets</h2>

                </div>

            </div>

        </div>

</section>



<section class="cbd-therapy-main">

        <div class="cust-container-md">

            <div class="add-pet-form">

                <div class="pet-form-title">

                    <div class="title">

                        <p>{{ $dataheading['title'] }}</p>

                    </div>

                    <div class="disc">

                        <p>Please be as detailed as possible for the consulting veterinarian.</p>

                    </div>

                </div>



                <div class="pet-add-form">

                    <form id="pet-add-form-section"  method="post" action="{{route('pet-health-save')}}" enctype="multipart/form-data"> 

                        @csrf



                        <input type="hidden" name="pet_id" @if(isset($data)) value="{{$data->pet_id}}" @endif>

                        <input type="hidden" name="id" @if(isset($data)) value="{{$data->id}}" @endif>



                    <div class="form-row">

                        

                        <div class="col-100 form-group">

                            <label>Pet Name <span class="required-ico">*</span></label>

                            <input class="form-control" type="text" name="name" placeholder="Enter here" @if(isset($data)) value="{{$data->name}}" @endif>

                        </div>



                        <div class="col-100 form-group">

                            <label>Species <span class="required-ico">*</span></label>



                            <select name="species" id="species">

                            @foreach($species as $key => $value)

                                <option value="{{ $key }}"

                                @if(isset($data) && $data->species == $key) selected @endif

                                >{{ $value }}</option>

                            @endforeach

                            </select>

                        </div>



                        <div class="col-100 form-group">

                            <label>Breed</label> 

                            <input class="form-control" type="text" name="breed" placeholder="Enter here"  @if(isset($data)) value="{{$data->breed}}" @endif>

                        </div>



                        <div class="col-50 form-group">

                            <label>Approximate Age  <span class="required-ico">*</span></label>

                            <input class="form-control" type="number" name="years" placeholder="Enter  year" @if(isset($data)) value="{{$data->years}}" @endif>

                        </div>



                        <div class="col-50 form-group">

                            <label>Month</label>

							<select class="form-control" name="months">

								@for ($i = 1; $i <= 11; $i++)

									<option value="{{ $i }}" @if(isset($data) && $data->months == $i) selected @endif>

										{{ $i }} Month{{ $i > 1 ? 's' : '' }}

									</option>

								@endfor

							</select>

							<?php /*	

                            <input class="form-control" type="text" name="months" placeholder="Enter month" @if(isset($data)) value="{{$data->months}}" @endif>

							*/ ?>

                        </div>



                       

                        <div class="col-100 form-group">

                            <label>Gender <span class="required-ico">*</span></label>

                            <select name="gender" id="gender">

                                @foreach($gender as $key => $value)

                                

                                    <option value="{{ $key }}"

                                    @if(isset($data) && $data->gender == $key) selected @endif

                                    >{{ $value }}</option>





                                @endforeach

                            </select>

                        </div>





						

                       

@php

$petBioImage = asset('assets/images/pet-types/pet-dog.svg');

if(!empty($data?->profile) && file_exists(public_path($data->profile))) {

    $petBioImage = asset($data->profile);

}

@endphp

						<div class="col-100 form-group custom-file-upload">

							<label>Profile upload (Upload jpg,png).</label>

							<label for="file-upload" class="file-label">

								<span class="file-button">Upload image</span>

								<span class="file-name">No file chosen</span>

								<div class="file-icon">

									<img src="<?php echo $petBioImage?>" alt="image">

								</div>

							</label>

							<input id="file-upload" type="file" class="file-input" name="petBioImage"   style="display: block;opacity: 0;"/>

						</div>

						

						<div class="col-100 mt-20">

                            <div class="custom-checkbox">

                            <input  name="Neutered/Spayed" id="Neutered/Spayed" type="hidden">

                                <input type="checkbox" name="sterilization" id="sterilization" 

                                @if(isset($data) && $data->sterilization == '1') checked @endif>

                                <label for="sterilization">Neutered/Spayed.</label>

                            </div>

                        </div>

						@if(isset($data))

                            <?php /*
							<div class="col-100 delete-pet-v1">

								<label>Delete</label>

								<div class="pet-delete-ico" class="icon">

									<a href="javascript:void(0)" onclick="DeletePetRecord()">

										<img src="{{ asset('assets/dashboard/assets/images/delete-icon.png')}}" alt="icon">

									</a>	

								</div>

							</div> 
                            */ ?>

						@endif	

						

                        <div class="col-100 cta">

                            <button class="outline-button" type="button" onclick="BackToList()">Cancel</button>

                            <button class="primary-button" type="submit" onclick="savePetInformation()">Save</button>

                        </div>

						

						                      

                    </div>

                    </form>

                </div>

            </div>

        </div>

</section>

@include('mobile.includes.foooter-tab')

<script>

function savePetInformation() {

	const form = $("#pet-add-form-section");

	if(form.valid()) {

		showLoaderPageLoad('show');

	}

}

function BackToList() {

    window.location.href="{{ route('pet-health') }}";

}

function DeletePetRecord(){

	

}

</script>   

@endsection  