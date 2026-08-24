<!--add pet model start-->

<div class="modal-dialog edit-pet-v51" role="document">

         <div class="modal-content">

      <div class="modal-header theme-bg-color">

         <h3 class="modal-title" id="schedulepopup">{{ isset($edit)?'Edit':'Add'; }} Pet</h3>

      </div>

      <form id="pet-{{ isset($edit)?'edit':'add'; }}" action="{{ route('pets.store') }}" method="post" enctype="multipart/form-data">

            @csrf

      <div class="modal-body">

         <h4>{{ isset($edit)?'Edit':'Add'; }} your pet profile</h4>

         <p>Please be as detailed as possible for the consulting veterinarian.</p>

         <br>

         <input type="hidden" name="pet_id" value="{{ $data['pet_id']??'' }}">

         <input type="hidden" name="id" value="{{ $edit??'' }}">

         <div class="row">

            <div class="col-sm-4">

               <div class="form-group">

                  <label>Pet Name <span class="required-ico">*</span></label>

                  <input name="name" id="pet_name" value="<?= $data['name']??'' ?>" type="text" class="form-control" placeholder="Pet Name">

               </div>

            </div>

            <div class="col-sm-4">

               <div class="form-group">

                  <label>Species</label>



                     <select name="species" id="species" class="form-control">

                        @foreach($species as $value => $label)

                           <option value="{{ $value }}" 

                                 {{ old('species', $data['species'] ?? '0') == $value ? 'selected' : '' }}>

                                 {{ $label }}

                           </option>

                        @endforeach

                     </select>



                    <?php /* 

                  {!! Form::select('species', $species, old('species', $data['species'] ?? '0'), [

						'class' => 'form-control',

						'id' => 'species'

					]) !!}

                     */ ?>

               </div>

            </div>

            <div class="col-sm-4">

               <div class="form-group">

                  <label>Breed <span class="required-ico">*</span></label>

                  <input name="breed" id="breed" type="text" value="<?= $data['breed']??'' ?>" class="form-control" placeholder="Breed"></input>

               </div>

            </div>

         

            <div class="col-sm-4">

               <div class="form-group">

                  <label>

                  Approximate Age <i class="fa fa-info-circle" aria-hidden="true"></i>

                  </label>

                  <input name="years" id="app_age" value="<?= $data['years']??'' ?>" type="text" class="form-control" placeholder="Years"

				  onkeyup="lengthValidation(this,'2')" 

				  >

               </div>

            </div>

            <div class="col-sm-4">
                  <div class="form-group">

                              <label>Months</label>

                              <input name="months" id="editMonths" value="<?= $data['months']??'' ?>" type="text" class="form-control" placeholder="Months(Required) *"

                           onkeyup="lengthValidation(this,'2')" 

                           >

                  </div>

            </div>

            <div class="col-sm-4">

               <label for="gender">Gender</label>



               <?php /*

               {!! Form::select('gender', $gender, old('gender', $data['gender'] ?? '0'), ['class' => 'form-control', 'id' => 'editGender']) !!}

               */ ?>



               <select name="gender" id="editGender" class="form-control">

                     @foreach($gender as $value => $label)

                        <option value="{{ $value }}" 

                              {{ old('gender', $data['gender'] ?? '0') == $value ? 'selected' : '' }}>

                              {{ $label }}

                        </option>

                     @endforeach

                  </select>



            </div>

			<div class="col-sm-4">               

				<label>Profile upload (Upload jpg,png).</label>               

				<input name="petBioImage" id="petBioImage" type="file" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png">            

			</div>			

            <div class="col-sm-4">

               <div class="checkbox pet-check">

                  <label>

                  <input  name="Neutered/Spayed" id="Neutered/Spayed" type="hidden">

                  <input type="checkbox" <?php if( isset($data['sterilization']) && ($data['sterilization'] == 1) ){ echo 'checked'; } ?> id="sterilizationCB" name="sterilization" > Neutered/Spayed

                  </label>

               </div>

            </div>	


            <div class="col-sm-12 mt-3 " id="petimgresponse">
            </div>

			<?php /* if( isset($data)){ ?>

				<div class="col-sm-4">

					<div class="pet-delete-ico">

						<label>Delete</label>	

						<a class="deleteByAjax" data-resource="" href="#!" number="88" data-url="" data-toggle="tooltip" title="" data-bs-original-title="Delete" aria-describedby="tooltip323826">

						<label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label>

						</a>

					 

					</div>

				</div>			

			<?php }  */?>						

         </div>

      </div>

      <div class="modal-footer common-footer-btn">

         <input type="button" class="btn" value="Save" onclick="return savePetFun('pet-{{ isset($edit)?'edit':'add'; }}')" />

         <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>

      </div>

      </form>

   </div>

</div>



