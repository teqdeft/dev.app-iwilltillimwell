{{-- resources/views/components/cbt-steps.blade.php --}}

<div class="view_logs">
    <a href="/cbt-therapy-list" type="button" class="btn btn-secondary" >View Log</a>
</div>
<div class="cbt_steps">

    <div class="icon">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 55C11.125 55 9.94833 54.5108 8.97 53.5325C7.99167 52.5542 7.50167 51.3767 7.5 50V15C7.5 13.625 7.99 12.4483 8.97 11.47C9.95 10.4917 11.1267 10.0017 12.5 10H15V5H20V10H40V5H45V10H47.5C48.875 10 50.0525 10.49 51.0325 11.47C52.0125 12.45 52.5017 13.6267 52.5 15V50C52.5 51.375 52.0108 52.5525 51.0325 53.5325C50.0542 54.5125 48.8767 55.0017 47.5 55H12.5ZM12.5 50H47.5V25H12.5V50ZM12.5 20H47.5V15H12.5V20ZM17.5 35V30H42.5V35H17.5ZM17.5 45V40H42.5V42.5V45H17.5Z"
                fill="#713D9C" />
        </svg>
    </div>

    {{-- Step Number --}}
    <div class="step_no">
        <p>
            <span class="step_no active">Step {{ $currentStep }}</span>
            <span>of {{ count($steps) }}</span>
            <span class="next_icon">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 3L16.8 7.5L39 30L16.8 52.5L21 57L48 30L21 3Z" fill="#683D81" />
                </svg>
            </span>
        </p>
    </div>

    {{-- Step Name Labels --}}
    @foreach ($steps as $stepNumber => $stepName)
        <div class="step_name {{ $currentStep === $stepNumber ? 'active' : '' }}">
            <p>
                <span>{{ $stepName }}</span>
                <span class="next_icon">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 3L16.8 7.5L39 30L16.8 52.5L21 57L48 30L21 3Z" fill="#683D81" />
                    </svg>
                </span>
            </p>
        </div>
    @endforeach

</div>
