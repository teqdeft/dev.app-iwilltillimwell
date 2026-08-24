<div class="modal fade congrats-modal" id="all-step-complete-document" tabindex="-1" role="dialog" aria-labelledby="congrats-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="check-icon"><img src="{{ asset('assets/services/images/check-icon.png') }}" alt="check-icon"></div>
           <h2 class="text-center">Congratulations!!</h2>
            <p class="text-center">Your Personal Health record has been updated.</p>
            <div class="modal-btn-wrapper text-center d-flex">
                <a href="{{ url('/') }}" class="btn btn-default">Back to main menu</a>
                <a href="{{ url('consultation-type') }}" class="btn btn-default ml-3">Schedule a Consultation</a>
            </div>
        </div>
    </div>
</div>
