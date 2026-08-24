@if(!Auth::user()->parentId)
		
<div id="dependents" class=" tab-pane fade">
    <br>
    <div class="dependents-top-content">
        <h3 class="mb-1"> Manage Dependents and Other Household Users</h3>
        <p>Here you can add and edit your dependent information.</p>
		<p>You may add up to 7 dependents. Your spouse and any dependents over 18 years of age will receive a registration email and must register to use the system. Your spouse will have access to all of your dependents records who are under the age of 18 but will not have access to your records or any dependents records who are over the age of 18.
        </p>
    </div>
	
	@if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan')))
        @if($user->total_dependents < Config::get('constants.allowed_dependents') && (!$user->parentId)) 
			<div class=" add_dependent my-4 ">
				<button onclick="addNewDependent()" type="button" class="btn btn-primary mr-3 add-new-dependent"><i class="fas fa-plus mr-1"></i>Add A Dependent</button>
			</div>
        @endif
		<div class="viewing-records-box">
		
			@include('auth.dependents.dependent-section')
									
        </div>
			
	
	@else
		<div class="alert alert-info custom-alert-info"><strong>Info!</strong> Please purchase a Family Plan.</div>
	@endif	
</div>

@endif