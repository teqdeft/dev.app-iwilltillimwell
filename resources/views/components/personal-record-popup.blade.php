<div class="modal fade congrats-modal" id="personal-record-modal" tabindex="-1" role="dialog" aria-labelledby="congrats-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="check-icon"><img src="{{ asset('assets/services/images/check-icon.png') }}" alt="check-icon"></div>
            <h2 class="text-center">Congratulations! </h2>
            <p class="text-center">You’ve successfully completed your profile.</p>
            @php $url = url('share/add/setting'); @endphp
            @if( menu_access('medical-care') )
                <p class="text-center"> Next, please complete your personal health records.</p>
                @php $url = url('personal-record'); @endphp
            @endif
            <div class="modal-btn-wrapper text-center">
                <a href="{{ $url }}" class="btn btn-default">Get Started</a>
            </div>
        </div>
    </div>
</div>
