<div class="modal fade congrats-modal" id="complete-medical-modal" tabindex="-1" role="dialog" aria-labelledby="congrats-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content medical_consent">
            <div class="check-icon"><img src="{{ asset('assets/services/images/check-icon.png') }}" alt="check-icon"></div>
            <p class="text-center">Hi {{ ucfirst(Auth::user()->fname) }}, please complete the Medical Consent Form</p>
            <div class="modal-btn-wrapper text-center">
               <button type="button" class="btn btn-primary" data-dismiss="modal">Get Started</button>
            </div>
        </div>
    </div>
</div>
