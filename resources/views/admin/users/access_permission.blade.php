<input type="hidden" name="user_id" value="{{ $userId }}" >
<div class="accessPermissionContainer">
    <div class="accessSite">
        <h5>Permission</h5>
        <div class="form-group">
            <input type="checkbox" name="access_permission[]" @if ( !empty($accessSite) && in_array('iwilltilimwell',$accessSite) )
                checked
            @endif value="iwilltilimwell" id="access-permssion-iwilltill" >
            <label for="access-permssion-iwilltill" > Iwilltilimwell </label>
                        
            <input type="checkbox" name="access_permission[]" @if ( !empty($accessSite) && in_array('imwell',$accessSite) )
                checked
            @endif value="imwell" id="access-permssion-imwell" >
            <label for="access-permssion-imwell" > Imwell </label>
        </div>
        <div class="form-group">
            <label>Company</label>
            <select class="form-control" name="company_id">
                <option value="">Select Company</option>
                @if ( $company )
                    @foreach ($company as $value )
                        <option value="{{ $value->id }}"
                            @if( $user->company_id ==  $value->id )
                                selected
                            @endif
                        >{{ $value->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>