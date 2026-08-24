<div class="modal fade congrats-modal" id="congrats-modal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="congrats-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="check-icon"><img src="{{ asset('assets/services/images/profile-setting-icon.png') }}" alt="profile-setting-icon"/></div>
            <p class="text-center">Welcome to the iWILL'til i'mWELL  App - Please complete your profile</p>
            <div class="modal-btn-wrapper text-center">
                @if( $showAnchor == 'true' )
                    <a href="{{ url('share/user/general-information') }}" class="btn btn-default">Get Started</a>
                @else
                    <button type="button" class="btn btn-default" data-dismiss="modal">Get Started</button>
                @endif
            </div>
        </div>
    </div>
</div>
