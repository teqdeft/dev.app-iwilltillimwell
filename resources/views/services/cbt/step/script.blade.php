<script>
    let cbtData = @json(config('constants.CBT_DETAILS'));

    function SeeDescriptionMore(id) {

        let data = cbtData[id];
        if (!data) return;
        $(".cbt-modal-heading").html(data.title);
        $(".cbt-short-text-modal").html(data.short);
        $(".cbt-modal-ex-heading").html(data.ex_heading);
        $(".cbt-modal-long").html(data.long);
        $("#SeeDescriptionMore").modal("show");

    }
    $(document).on('change', '.form-check-input', function() {

        let card = $(this).closest('.patterns_card');
        if($(this).is(':checked')) {
            card.addClass('active');
        } else {
            card.removeClass('active cbt-error-card');
            card.find('input[type="radio"]').prop('checked', false);
        }
        
    });


    function getCBTFeel(value) {

        $('input[name="cbt_feel"][value="' + value + '"]').prop('checked', true);

        $('input[name="cbt_feel"][value="' + value + '"]').trigger('change');


        let message = "";
        let ico = "";
        let class_name = "";
        if (value === "better") {

            message = "That’s a great step forward. You’re learning to see things differently—keep going.";
            ico = `
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 33C26.2843 33 33 26.2843 33 18C33 9.71573 26.2843 3 18 3C9.71573 3 3 9.71573 3 18C3 26.2843 9.71573 33 18 33Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /><path d="M12 22.5C12.6986 23.4315 13.6045 24.1875 14.6459 24.7082C15.6873 25.2289 16.8357 25.5 18 25.5C19.1643 25.5 20.3127 25.2289 21.3541 24.7082C22.3955 24.1875 23.3014 23.4315 24 22.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /><path d="M12.0135 13.5H12M24 13.5H23.9865" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
            `;
            class_name = "better-feel";

        } else if (value === "same") {

            message = "That’s okay. Change takes time—what matters is that you showed up and tried.";
            ico = `
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30 54.8545C25.0842 54.8545 20.2787 53.3968 16.1913 50.6657C12.1039 47.9346 8.91822 44.0528 7.03701 39.5111C5.15579 34.9695 4.66358 29.972 5.62261 25.1506C6.58165 20.3292 8.94886 15.9004 12.4249 12.4244C15.9009 8.94837 20.3297 6.58116 25.1511 5.62212C29.9725 4.66309 34.97 5.1553 39.5116 7.03652C44.0533 8.91773 47.9351 12.1035 50.6662 16.1908C53.3973 20.2782 54.855 25.0837 54.855 29.9995C54.8478 36.5893 52.2268 42.907 47.5671 47.5666C42.9075 52.2263 36.5898 54.8473 30 54.8545ZM30 7.64454C25.5786 7.64454 21.2565 8.95564 17.5803 11.412C13.904 13.8684 11.0387 17.3598 9.3467 21.4447C7.65471 25.5295 7.212 30.0243 8.07458 34.3608C8.93715 38.6972 11.0663 42.6805 14.1927 45.8069C17.3191 48.9333 21.3023 51.0624 25.6388 51.925C29.9752 52.7876 34.4701 52.3449 38.5549 50.6529C42.6398 48.9609 46.1311 46.0956 48.5875 42.4193C51.0439 38.7431 52.355 34.4209 52.355 29.9995C52.3497 24.0723 49.9928 18.3892 45.8016 14.198C41.6103 10.0068 35.9273 7.64984 30 7.64454Z" fill="black" /><path d="M22.5024 25.5996C24.2283 25.5996 25.6274 24.2005 25.6274 22.4746C25.6274 20.7487 24.2283 19.3496 22.5024 19.3496C20.7766 19.3496 19.3774 20.7487 19.3774 22.4746C19.3774 24.2005 20.7766 25.5996 22.5024 25.5996Z" fill="black" />
                <path d="M37.5024 25.5996C39.2283 25.5996 40.6274 24.2005 40.6274 22.4746C40.6274 20.7487 39.2283 19.3496 37.5024 19.3496C35.7766 19.3496 34.3774 20.7487 34.3774 22.4746C34.3774 24.2005 35.7766 25.5996 37.5024 25.5996Z" fill="black" />
                <path d="M21.095 39.8477H38.9075C39.239 39.8477 39.5569 39.716 39.7914 39.4815C40.0258 39.2471 40.1575 38.9292 40.1575 38.5977C40.1575 38.2661 40.0258 37.9482 39.7914 37.7138C39.5569 37.4794 39.239 37.3477 38.9075 37.3477H21.095C20.7634 37.3477 20.4455 37.4794 20.2111 37.7138C19.9767 37.9482 19.845 38.2661 19.845 38.5977C19.845 38.9292 19.9767 39.2471 20.2111 39.4815C20.4455 39.716 20.7634 39.8477 21.095 39.8477Z" fill="black" /></svg>
            `;
            class_name = "same-feel";

        } else if (value === "worse") {

            message = "It’s okay to feel this way. You’re facing tough thoughts, and that takes real strength.";
            ico = `
                <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.875 24.667C15.1854 23.6957 16.781 23.1253 18.5 23.1253C20.219 23.1253 21.8146 23.6957 23.125 24.667M14.6458 16.1878V15.417M22.3542 16.1878V15.417" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /><path d="M32.375 18.5C32.375 20.3221 32.0161 22.1263 31.3188 23.8097C30.6215 25.4931 29.5995 27.0227 28.3111 28.3111C27.0227 29.5995 25.4931 30.6215 23.8097 31.3188C22.1263 32.0161 20.3221 32.375 18.5 32.375C16.6779 32.375 14.8737 32.0161 13.1903 31.3188C11.5069 30.6215 9.97731 29.5995 8.68889 28.3111C7.40048 27.0227 6.37846 25.4931 5.68117 23.8097C4.98389 22.1263 4.625 20.3221 4.625 18.5C4.625 14.8201 6.08683 11.291 8.68889 8.68889C11.291 6.08683 14.8201 4.625 18.5 4.625C22.1799 4.625 25.709 6.08683 28.3111 8.68889C30.9132 11.291 32.375 14.8201 32.375 18.5Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            `;
            class_name = "worse-feel";
        }

        let img = '{{url("/assets/dashboard/htmlv/assets/images/iwilltilimwell-h-headerbar-mini.png")}}';
        $("#feel_message").html('<p><span class="' + class_name + '">' + ico + '</span>' + message + '</p>').show();

    };

    @if(!empty($data['cbt_feel']))

    getCBTFeel("{{ $data['cbt_feel'] }}");

    @endif


    let currentStep = 1;
    const totalSteps = 4;

    function showStep(step) {

        document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
        document.getElementById('step-' + step).classList.remove('d-none');

    }

    function Step_One_Validation(isValid) {

        let automatic_thought = $("#automatic_thought").val();
        if (automatic_thought == "") {
            isValid = false;
            toastr.error("Automatic Thought required");
        }
        $(".automatic_thought_display").html(automatic_thought);
        return isValid;
    }

    function Step_Two_Validation(isValid) {

        let atLeastOneChecked = false;
        let firstErrorCard = null;

        $('.patterns_card').removeClass('cbt-error-card');

        $('.patterns_card').each(function() {

            let checkbox = $(this).find('input[type="checkbox"]');
            let isChecked = checkbox.is(':checked');

            if (isChecked) {
                atLeastOneChecked = true;

                let intensityChecked = $(this).find('input[type="radio"]:checked').length > 0;

                if (!intensityChecked) {
                    isValid = false;

                    $(this).addClass('cbt-error-card');

                    if (!firstErrorCard) {
                        firstErrorCard = $(this);
                    }
                }
            }
        });



        if (!atLeastOneChecked) {
            toastr.error("Please select at least one option");
            return false;
        }
        if (!isValid) {
            toastr.error("Please select intensity for all selected options");
            return false;
        }
        return true;
    }

    function Step_three_Validation(isValid) {

        let challenge_thought = $("#challenge_thought").val();
        if (challenge_thought == "") {
            isValid = false;
            toastr.error("Challenge thought required");
        }
        return isValid;

    }

    function Step_four_Validation(isValid) {

        let alternative_thought = $("#alternative_thought").val();
        let cbt_feel = $('input[name="cbt_feel"]:checked').val();

        console.log(cbt_feel);

        if (!cbt_feel) {
            isValid = false;
            toastr.error("Please confirm how do you feel");
        } else if (alternative_thought == "") {
            isValid = false;
            toastr.error("Alternative thought required");
        }

        return isValid;
    }

    function validateStep(step) {

        let isValid = true;
        if (step == 1) {
            isValid = Step_One_Validation(isValid);
        } else if (step == 2) {
            isValid = Step_Two_Validation(isValid);
        } else if (step == 3) {
            isValid = Step_three_Validation(isValid);
        } else if (step == 4) {
            isValid = Step_four_Validation(isValid);
        }

        return isValid;
    }

    function nextStep() {

        if (!validateStep(currentStep)) {
            return;
        }
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        } else {
            callSaveInfomoration()
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function callSaveInfomoration() {

        let selectedData = [];
        $('.patterns_card').each(function() {
            let checkbox = $(this).find('input[type="checkbox"]');
            let isChecked = checkbox.is(':checked');
            if (isChecked) {
                let distortion_id = checkbox.val();
                let intensity = $(this).find('input[type="radio"]:checked').val();
                selectedData.push({
                    distortion_id: distortion_id,
                    intensity: intensity
                });
            }
        });

        console.log(selectedData);

        let cbt_feel = $('input[name="cbt_feel"]:checked').val();
        let formData = new FormData();
        formData.append("automatic_thought", $("#automatic_thought").val());
        formData.append("challenge_thought", $("#challenge_thought").val());
        formData.append("alternative_thought", $("#alternative_thought").val());
        formData.append("cbt_feel", cbt_feel);
        formData.append("distortion_information", JSON.stringify(selectedData));
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("id", @json($data['id'] ?? 0));

        showLoaderPageLoad('show');
        $.ajax({
            url: "{{ url('cbt-therapy-save') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success("Saved successfully");
                window.location.href = "/cbt-therapy-list";
            },
            error: function(xhr) {
                showLoaderPageLoad('hide');
                toastr.error("Something went wrong");
                console.log(xhr.responseText);
            }
        });
    }



    $(document).ready(function() {

        let expanded = false;
        let defaultCount = 3;

        let $cards = $('.patterns_card');
        let $btn = $('.distortions_load');
        let $btnText = $('.btn-text-more');

        function updateView() {

            $cards.each(function(index) {
                if (!expanded && index >= defaultCount) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });

            $btnText.text(expanded ? 'Show Less' : 'Load More');

            if (expanded) {
                $btn.removeClass('more').addClass('less');
            } else {
                $btn.removeClass('less').addClass('more');
            }

            $btn.toggleClass('active', expanded);
        }

        // Initial load
        updateView();

        $btn.on('click', function() {
            expanded = !expanded;
            updateView();

            if (!expanded) {
                $('html, body').animate({
                    scrollTop: $('.all_cards').offset().top
                }, 500);
            }
        });

        // Hide button if <= 6 cards
        if ($cards.length <= defaultCount) {
            $btn.hide();
        }

    });

    $(document).on('change', '.patterns_card .select_option input[type="radio"]', function() {
        $(this).closest('.patterns_card').removeClass('cbt-error-card');
    });
</script>
<style>
    .patterns_card {
        display: none;
    }

    .patterns_card.show {
        display: block;
    }

    .cbt-error-card .error-intensity-section {
        display: block !important;
    }
</style>