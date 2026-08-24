<div class="reset-email">

	<div class="reset-ahref">
		<a href="javascript:void(0)" onclick="changeEmailDependent()">Click Here to Update Email Address</a>
	</div>

	<div class="email-section" style="display:none;">
		<form class="row personal-info-value-box" id="update-dependent-form" action="{{ route('update-dependent', $dependent->id) }}" method="post" enctype="multipart/form-data">
			@csrf												
			<input type="hidden" name="dependent-id" value="{{ $dependent->id }}" />
			<input type="text" name="email" value="{{$dependent->email}}" class="form-control" />
			<input type="hidden" name="fname" value="{{$dependent->fname}}"/>	
			<input type="hidden" name="lname" value="{{$dependent->lname}}"/>	
			<input type="hidden" name="primaryPhone" value="{{ $dependent->primaryPhone }}" />
			<input type="hidden" name="secondaryPhone" value="{{ $dependent->secondaryPhone }}" />
			<input type="radio"  name="gender" value="m" style="display:none;" {{ ($dependent->gender=="m") ? "checked" : ""}} />
			<input type="radio"  name="gender" value="f" style="display:none;"  {{ ($dependent->gender=="f") ? "checked" : ""}} />
						
			<input type="hidden" name="address" value="{{ $dependent->address }}" />
			<input type="hidden" name="address2" value="{{ $dependent->address2 }}" />
			
			<input type="hidden" name="city" value="{{ $dependent->city }}" />
			
			<select name="stateid" style="display:none;">
				<option value="">Please select state</option>
				@foreach ($states as $state)
						<option value="{{ $state->id }}" {{ ($state->id == $dependent->stateid) ? 'selected' : '' }}>{{ $state->name }}</option>
				@endforeach
			</select>
			
			<input type="hidden" name="zipCode" value="{{ $dependent->zipCode }}">
			
			<select name="timezoneId" style="display:none;">
				@foreach ($timezones as $timezone)
					<option value="{{ $timezone->id }}" {{ ($timezone->id == $dependent->timezoneId) ? 'selected' : '' }}>
						{{ $timezone->name }}</option>
				@endforeach
			</select>
			
			<button type="submit" class="btn btn-primary mb-0">Submit</button>		
																
		</form>
	</div>
</div>