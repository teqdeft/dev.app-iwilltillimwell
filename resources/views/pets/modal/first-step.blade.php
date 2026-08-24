<div class="tab-pane first-sec-step active petAllSteps pets-problem" id="step1">
    <div class="panel-heading">
        <h2>What seems to be the problem with</h2>
        <h4 id="myPetName"></h4>
    </div>
    
    <!--<div class="panel-list new_list_v1">-->
    <!--    <div class="form-check cb petProblemSelected">-->
    <!--      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">-->
    <!--      <label class="form-check-label" for="flexCheckDefault">-->
    <!--        <i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="text pet-problem"> &nbsp;</span> Default checkbox-->
    <!--      </label>-->
    <!--    </div>-->
    <!--    <div class="form-check cb petProblemSelected">-->
    <!--      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>-->
    <!--      <label class="form-check-label" for="flexCheckChecked">-->
    <!--        <i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="text pet-problem"> &nbsp;</span> Checked checkbox-->
    <!--      </label>-->
    <!--    </div>-->
        
    <!--    <div class="form-check cb">-->
    <!--      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">-->
    <!--      <label class="form-check-label" for="flexCheckDefault1">-->
    <!--        <i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="text pet-problem"> &nbsp;</span> Default checkbox-->
    <!--      </label>-->
    <!--    </div>-->
    <!--    <div class="form-check cb">-->
    <!--      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked>-->
    <!--      <label class="form-check-label" for="flexCheckChecked1">-->
    <!--        <i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="text pet-problem"> &nbsp;</span> Checked checkbox-->
    <!--      </label>-->
    <!--    </div>-->
        
    <!--</div>-->
    
    <div class="list-v1">
        <div class="panel-list new_list_v1">
            @if( !empty($petProblem) )
                @foreach($petProblem as $key => $value)
                <div class="form-check cb">
                    <input type="checkbox" class="form-check-input petPoblem" name="petProblem[]" value="{{ $value['petproblem_id'] }}" id="chk_{{ $value['petproblem_id'] }}">
                    <label class="form-check-label" for="chk_{{ $value['petproblem_id'] }}">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="text pet-problem">{{ $value['name'] }} &nbsp;</span>
                    </label>
                </div>
                @endforeach
            @endif
        </div>
        
        
        <!--<div class="panel-list">-->
        <!--    @if( !empty($petProblem) )-->
        <!--        @foreach($petProblem as $key => $value)-->
        <!--            <label class="cb" for="chk_{{ $value['petproblem_id'] }}">-->
        <!--                <i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="text pet-problem">{{ $value['name'] }}</span>-->
        <!--                <input type="checkbox" class="petPoblem" style="display:none;" name="petProblem[]" value="{{ $value['petproblem_id'] }}" id="chk_{{ $value['petproblem_id'] }}">-->
        <!--            </label>-->
        <!--        @endforeach-->
        <!--    @endif-->
        <!--</div>-->
    </div>
    
    <div class="form">
        <input type="hidden" name="myPetId">
        <textarea name="petDescription" id="pet-description" class="form-control z-depth-1" rows="5" placeholder="Optional: Additional Notes for the Vet..."></textarea>
    </div>
</div>