<div class="modal-header theme-bg-color">
   <h3 class="card-title mb-0">Update  Medical Condition Record</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<form class="forms-sample" method="post" action="{{ route('update.medical.history', $condition->medicalConditionId) }}" id="medication-condition-form">
   <div class="modal-body">
      <div class="card-body personal-info-card-box p-0">
         {{ csrf_field() }}
         <div class=" row">
            <div class="col-sm-6">
               <div class="form-group">
                  <label>Condition Name</label>
                  <input type="text" class="form-control" placeholder="Condition Name" name="medicalConditionName" value="{{ @$condition->name }}">
               </div>
            </div>
         </div>
         <div class=" row">
            <div class="col-sm-12">
               <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" id="exampleTextarea1" rows="6" placeholder="Description" name="medicalConditionDescription"> {{ @$condition->description }} </textarea>
               </div>
            </div>
            <div class="col-sm-12">
               <div class="form-group">
                  <label>Status</label>
                  <div class="d-flex custom-check-box">
                     <div class="form-check mr-5">
                        <label class="form-check-label">
                           <input type="radio" class="form-check-input" name="medicalConditionStatus" id="optionsRadios3" value="1" {{ (@$condition->status == 1) ? 'checked' : '' }} >
                           Currently in such condition
                           <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check">
                           <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="medicalConditionStatus" id="optionsRadios4" value="2"  {{ (@$condition->status == 2) ? 'checked' : '' }}>
                              Had condition in the past
                              <i class="input-helper"></i></label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
         </div>
      </form>