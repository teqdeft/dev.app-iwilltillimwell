$(document).ready(function() {
    // let phone_pattern = "([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})";
    // let phone_pattern = "^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$";
    // let phone_pattern = "^[\+\d]?(?:[\d-.\s()]*)$";
    let phone_pattern = "^(?=.*[0-9])[+()0-9]+$";
    let onlyText = "^[a-zA-Z]*$";
    
    
    $.validator.addMethod("validate_email", function(value, element) {

        if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
            return true;
        } else {
            $('.emailFieldContainer').children('.spinner-border').addClass('d-none');
            $('.emailFieldContainer').children('.register-check').addClass('d-none');
            $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
            return false;
        }
    }, function(params, element) {
        return trans('lang.validation.email', { attribute: trans('lang.labels.' + element.name) })
    });


	/* $.validator.addMethod("onlyCharacters", function(value, element) {
		return this.optional(element) || /^[a-zA-Z]+$/.test(value);
	}, "Only alphabets are allowed."); */
	
	$.validator.addMethod("onlyCharacters", function(value, element) {
		return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
	}, "Only alphabets are allowed.");

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    });

    $.validator.addMethod("in_list", function(value, element, params) {
        return params.split(",").map(Number).includes(parseInt(value))
    }, function(params, element) {
        return trans('lang.validation.in', { attribute: trans('lang.labels.' + element.name) })
    });

    $.validator.addMethod("string_in_list", function(value, element, params) {
        return params.split(",").map(String).includes(value);
    }, function(params, element) {
        return trans('lang.validation.in', { attribute: trans('lang.labels.' + element.name) });
    });

    $.validator.addMethod('matches', function(value, element, param) {
        let re = new RegExp(param);
        return this.optional(element) || re.test(value);
    }, function(params, element) {
        return trans('lang.validation.regex', { attribute: trans('lang.labels.' + element.name) });
    });

    $.validator.addMethod("date_format", function(value, element, param) {
        console.log(moment(value, param, true).isValid())
        return this.optional(element) || moment(value, param, true).isValid();
    }, function(params, element) {
        return "The date format does not match the format yyyy-mm-dd";
    });

    $.validator.addMethod("notEqualTo", function(value, element, param) {
        var target = $(param);
        if (this.settings.onfocusout) {
            target.unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
                $(element).valid();
            });
        }
        return this.optional(element) || value !== target.val();
    }, function(params, element) {
        return trans('lang.validation.different', { attribute: trans('lang.labels.' + element.name), other: params });
    });

    $.validator.addMethod("pwcheck", function(value) {
        return /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9!@#$%&*]+$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
    });
    
    

    $.validator.addMethod("phoneNumberOnly", function(value) {
        return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value);
    });   
    
     $.validator.addMethod("onlyText", function(value) {
        return /^([a-zA-Z]+)$/.test(value);
    });
    jQuery.validator.addMethod("alphaCheck", function(value, element) {
        return this.optional(element) || onlyAlpha(value);
        }, "Please enter only letters");
       
    function onlyAlpha(values) {
            let r = /\d+/;
            return !values.match(r);
    }


    // Register Form for mobile
    $('.step-button-back').click( function() {
        let val = $(this).attr('value');		let prevStep = 0;		if(val==5) {			prevStep = parseInt(val) - 2;		} else {			prevStep = parseInt(val) - 1;		}
        
        showHideDiv(val, prevStep);
    });

    const showHideDiv = (hideId, showId) => {
        if (hideId > 0 && showId > 0) {
            $("#step-" + hideId).hide();
            $("#step-" + showId).show();
        }
    }

    function updateHiddenField() {
        var digit1 = $('#digit1').val();
        var digit2 = $('#digit2').val();
        var digit3 = $('#digit3').val();
        var digit4 = $('#digit4').val();
        var concatenatedValue = digit1 + digit2 + digit3 + digit4;

        $('#digit5').val(concatenatedValue);
    }

    let login_otp_form = $("#login-otp-form"); 
    let login_otp_otp_form = $("#login-otp-verification-form");
    
    if (login_otp_form) {
        login_otp_form.validate({
            rules: {
                phone_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 11,
                }
            },
            messages: {
                phone_number: {
                    required: "Please enter phone number",
                }
            },errorPlacement: function (error, element) {
                toastr.error(error.text());
                //error.insertAfter(element.parent());
            }
        });
    }
    if (login_otp_otp_form) {
        let hasShownToastr = false;
        login_otp_otp_form.validate({
            rules: {
                digit1: {
                    required: true,
                },
                digit2: {
                    required: true,
                },
                digit3: {
                    required: true,
                },
                digit4: {
                    required: true,
                }
            },
            messages: {
                digit1: {
                    required: "Please enter valid OTP",
                },
                digit2: {
                    required: "Please enter valid OTP",
                },
                digit3: {
                    required: "Please enter valid OTP",
                },
                digit4: {
                    required: "Please enter valid OTP",
                }
            },errorPlacement: function (error, element) {
              
                return false;
            },
            invalidHandler: function (event, validator) {
                if (!hasShownToastr && validator.numberOfInvalids()) {
                    hasShownToastr = true;
                    toastr.error("Please enter valid OTP.");
    
                    // Reset flag after a short delay
                    setTimeout(() => {
                        hasShownToastr = false;
                    }, 500); // adjust delay as needed
                }
            }
        });
    }


    let registerFormEleStep1 = $("#step2-form");
    let registerFormEleStep2 = $("#step21-form");
    let registerFormEleStep3 = $("#step3-form");
    let registerFormEleStep5 = $("#step5-form");
    let personalinfoform = $("#personal-info-form");
	
	if(personalinfoform) {
		personalinfoform.validate({
			rules: {
				fname: {
                    required: true,
					onlyCharacters: true,
					minlength: 2,
					maxlength: 20
                },
				lname: {
                    required: true,
					onlyCharacters: true,
					minlength: 2,
					maxlength: 20
                },
				timezoneId: {
                    required: true
                },
				stateid: {
                    required: true
                },
				gender: {
                    required: true
                }	
			},
			messages: {
				
                fname: {
                    required: "First Name Required"
                },
                lname: {
                    required: "Last Name Required"
                },
                timezoneId: {
                    required: "Time Zone Required"
                },
                gender: {
                    required: "Gender Required"
                },
                stateid: {
                    required: "State Required"
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
		});
	}

    if (registerFormEleStep1) {
        registerFormEleStep1.validate({
            rules: {
                phone: {
                    required: true,
                    phoneNumberOnly:true,
                    minlength: 10,
                    maxlength: 12,
                    remote: {
                        url:`${SITE_URL}/checkPhoneExist`,
                        type:'POST',
                        cache: false,
                        data: {
                            _token: $('meta[name=csrf-token]').attr('content'),
                            phone: function() {
                                return $( "#phone" ).val();
                            }
                        },
                        beforeSend: function(){
                            console.log("Here");
                            /* $('.emailFieldContainer').children('.spinner-border').removeClass('d-none');
                            $('.emailFieldContainer').children('.register-check').addClass('d-none');
                            $('.emailFieldContainer').children('.register-triangle').addClass('d-none');

                            
                            $('.emailFieldContainer .register-spin').show(); */
                            $('.emailFieldContainer .step-button-next').prop('disabled', true);
                            
                        },
                        complete: function(response){
                            console.log( {response} );
                            $('.emailFieldContainer .register-spin').hide();
                            $('.emailFieldContainer .step-button-next').prop('disabled', false);
							
                            /* $('.emailFieldContainer').children('.spinner-border').addClass('d-none');
                            $('.emailFieldContainer').children('.register-check').addClass('d-none');
                             $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                            if (response.responseJSON){
                                $('.emailFieldContainer').children('.register-check').removeClass('d-none');
                                $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                            }else{
                                $('.emailFieldContainer').children('.register-check').addClass('d-none');
                                $('.emailFieldContainer').children('.register-triangle').removeClass('d-none');
                            } */
                        },
                    }
                }
            },
            messages: {
                phone: {
                    required: "Please enter your phone number",
                    remote: "Phone number already exist. Please try another",
                    phoneNumberOnly : "Please enter a valid phone number"
                }
            },
            errorPlacement: function (error, element) {
                //error.insertAfter(element.parent());
                element.closest('.cust-form').find('.error-message').html(error);
            }
        });
    }

    if (registerFormEleStep2) {
        registerFormEleStep2.validate({
            rules: {
                digit1: {
                    required: true,
                },
                digit2: {
                    required: true,
                },
                digit3: {
                    required: true,
                },
                digit4: {
                    required: true,
                }
            },
            messages: {
                digit1: {
                    required: "Please enter your passcode",
                }
            }
        });
    }

    if (registerFormEleStep3) {
        registerFormEleStep3.validate({
            rules: {
                digit1: {
                    required: true,
                },
                digit2: {
                    required: true,
                },
                digit3: {
                    required: true,
                },
                digit4: {
                    required: true,
                }
            },
            messages: {
                digit1: {
                    required: "Please enter valid OTP",
                },
                digit2: {
                    required: "Please enter valid OTP",
                },
                digit3: {
                    required: "Please enter valid OTP",
                },
                digit4: {
                    required: "Please enter valid OTP",
                }
            },
            errorElement: 'label',
            errorPlacement: function(error, element) {
                console.log(error);
                if(error) {
                    $("#errorMessages").html(error);
                }
               
                //error.insertAfter(element);
                //error.insertAfter(element.parent());
            }
        });
    }

    if (registerFormEleStep5) {
        registerFormEleStep5.validate({
            rules: {
                fname: {
                    required: true,
					onlyCharacters: true,
					minlength: 2,
					maxlength: 20
                },
                lname: {
                    required: true,
					onlyCharacters: true,
					minlength: 2,
					maxlength: 30
                },
                email: {
                    required: true,
                    validate_email: function(element){
                        if( typeof $(element).attr('aria-invalid') !== 'undefined' && $(element).attr('aria-invalid') ){
                            $('.emailFieldContainer').children('.register-check').addClass('d-none');
                            $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                        }
                    },
                    remote: {
                       url:`${SITE_URL}/checkEmailExist`,
                         type:'POST',
                         cache: false,
                         data: {
                             _token: $('meta[name=csrf-token]').attr('content'),
                             email: function() {
                                 return $( "#email" ).val();
                             }
                         },
                         beforeSend: function(){
                             $('.emailFieldContainer').children('.spinner-border').removeClass('d-none');
                             $('.emailFieldContainer').children('.register-check').addClass('d-none');
                             $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                         },
                         complete: function(response){
                             console.log( {response} );
							 
							 const isAvailable = response.responseJSON === true;
							 if(!isAvailable) {
								 
								 $("#email-error").html("The email already exists. Please try another");
							 }
							 
                            $('.emailFieldContainer').children('.spinner-border').addClass('d-none');
                             $('.emailFieldContainer').children('.register-check').addClass('d-none');
                              $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                             if (response.responseJSON){
                                 $('.emailFieldContainer').children('.register-check').removeClass('d-none');
                                 $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                             }else{
                                 $('.emailFieldContainer').children('.register-check').addClass('d-none');
                                 $('.emailFieldContainer').children('.register-triangle').removeClass('d-none');
                             }
                         },
                     }
                },
                password : {
                    required: true,
                    minlength: 8
                },
                address : {
                    required: true
                },
                gender : {
                    required: true
                }
            },
            messages: {
                fname: {
                    required: "The first name field is required",
                    onlyText: 'Only characters is allowed.',
					minlength: "First name must be at least 2 characters",
					maxlength: "First name cannot exceed 20 characters"
                },
                lname: {
                    required: "The last name field is required",
                    onlyText: 'Only characters is allowed.',
					minlength: "Last name must be at least 2 characters",
					maxlength: "Last name cannot exceed 30 characters"
                },
                email: {
                    required: "The email field is required",
                    // remote: `The email already exist. Please try another`
                },
                password: {
                    required: "The password field is required",
                    minlength: "Password must have at least 8 characters"
                },
				gender: {
                    required: "Please Choose Gender",
                    
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                console.log(error);
                //error.insertAfter(element);
                //error.insertAfter(element.parent());
                //element.parent().append('<div class="error-message">'+error+'</div>');

                const errorWrapper = $('<div class="error-message"></div>').append(error);
                 element.parent().append(errorWrapper);

            }
        })
    }

// document ready end


let invoiceFormEle = $("#invoice-form");
if (invoiceFormEle) {

    invoiceFormEle.validate({
        ignore: '.ignore',
        rules: {
            fname: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            lname: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            email: {
                required: true,
                validate_email: true,
                maxlength: 255
            },
            primaryPhone: {
                required: true,
                // digits: true,
                matches: phone_pattern,
                minlength: 10,
                maxlength: 19
            },
            zipCode: {
                required: true,
            },
            dob: {
                required: true,
                /*  date_format: 'm/d/Y' */
            },
            gender: {
                required: true,
            },
            timezoneId: {
                required: true,
            },
			stateid: {
                required: true,
            },
            address: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            city: {
                required: true,
            }

        },
        messages: {
            fname: {
                required: "The first name field is required",
            },
            lname: {
                required: "The last name field is required",
            },
            email: {
                required: "The email field is required",
            },
            primaryPhone: {
                required: "The phone field is required",
            },
            zipCode: {
                required: "The zipcode field is required"
            },
            stateid: {
                required: "The state field is required",
            },
            gender : {
                required: "Gender field is required",
            },
            address: {
                required: "The address field is required",
            },
            city: {
                required: "The city field is required",
            },
            timezoneId: {
                required: "Time Zone is required",
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {

            let type = $(element).attr("type");
            //error.insertAfter(element.parent());
           
            if (element.is(":radio")) {
                $("#gender-error").html(error);
               
            } else {
                 error.insertAfter(element.parent());
            }
               /*  
            else if (type === "checkbox") {
                error.insertAfter(element.next());
            } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                error.insertAfter(element.next());
            } else {
                error.insertAfter(element);
            }
            */
        }
    });
}

let updatePasswordFrom = $("#update-password-form");
if (updatePasswordFrom[0]) {
        updatePasswordFrom.validate({
            ignore: ":not(:visible)",
            rules: {
                current_password: {
                    required: true,
                    minlength: 6
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                current_password: {
                    required: "The old password field is required",
                },
                password: {
                    required: "The password field is required",
                },
                password_confirmation: {
                    required: "The confirm password field is required",
                    equalTo: "The confirm password not same as password"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

let petaddformsection = $("#pet-add-form-section");
	if(petaddformsection[0]) {
		petaddformsection.validate({
			ignore: ":not(:visible)",
			rules: {
				
				name: {
                    required: true
                },
				species: {
                    required: true
                },
				years: {
                    required: true
                },
				gender: {
                    required: true
                },
				months: {
                    required: true
                }
				
				
			},
			messages: {
				
			},
			errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
		});
}
let supporterDetails = $("#supporterDetails");
	if(supporterDetails[0]) {
		supporterDetails.validate({
			ignore: ":not(:visible)",
			rules: {
				
				first_name: {
                    required: true,
					onlyCharacters: true,
					minlength: 2,
					maxlength: 20
                },
				last_name: {
                    required: true,
					onlyCharacters: true,
					minlength: 2,
					maxlength: 30
                },
				relation: {
                    required: true
                },
				email: {
                    required: true
                },
				phone: {
                    required: true
                }
			},
			messages: {
				fname: {
                    required: "The first name field is required",
                    onlyText: 'Only characters is allowed.',
					minlength: "First name must be at least 2 characters",
					maxlength: "First name cannot exceed 20 characters"
                },
				lname: {
                    required: "The last name field is required",
                    onlyText: 'Only characters is allowed.',
					minlength: "Last name must be at least 2 characters",
					maxlength: "Last name cannot exceed 30 characters"
                }
			},
			errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
		});
}
 
 let newDependentForm = $("#add-dependent-form");
    if (newDependentForm[0]) {
        newDependentForm.validate({
            ignore: ":not(:visible)",
            rules: {
                fname: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                lname: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                email: {
                    required: true,
                    validate_email: true,
                    maxlength: 255
                },
                primaryPhone: {
                    required: true,
                    matches: phone_pattern,
                    minlength: 10,
                    maxlength: 19
                },
                status: {
                    required: true,
                },
                address: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                /* password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }, */
                dob: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                timezoneId: {
                    required: true,
                },
                city: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                stateid: {
                    required: true,
                },
                relationship: {
                    required: true,
                },
                zipCode: {
                    required: true,
                },
                gender: {
                    required: true,
                },
            },
            messages: {
                fname: {
                    required: "The first name field is required",
                },
                lname: {
                    required: "The last name field is required",
                },
                email: {
                    required: "The email field is required",
                },
                primaryPhone: {
                    required: "The primary phone field is required",
                },
                status: {
                    required: "The status field is required",
                },
                address: {
                    required: "The address field is required",
                },
                /* password: {
                    required: "The password field is required",
                },
                password_confirmation: {
                    required: "The confirm password field is required",
                    equalTo: "The confirm password not same as password"
                }, */
                dob: {
                    required: "The date of birth field is required",
                },
                gender: {
                    required: "The gender field is required"
                },
                timezoneId: {
                    required: "The timezone field is required"
                },
                city: {
                    required: "The city field is required",
                },
                stateid: {
                    required: "The state field is required",
                },
                relatioship: {
                    required: "The relatioship field is required",
                },
                zipCode: {
                    required: "The zipcode field is required"
                },
                gender: {
                    required: "The gender field is required"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

});
// 30 second time interval set
function counterIntervalFun () {
    const counterInterval = setInterval( () => {
        let counter = ($("#countdown").text()) ? $("#countdown").text() :  30;
        if (counter > 0) {
            $("#countdown").text(parseInt(counter) - 1);
        } else {
            $("#button-step3-resend").show();
            $("#seconds-interval").hide();
            clearInterval(counterInterval);
            console.log("interval cleared");
        }
    }, 1000);
}

$(document).ready(function () {
    
    if ($('#user-medical-consent').length) {

    $('#user-medical-consent').validate({
        rules: {

            mc_first_name: {
                required: true,
                alphaCheck:true
            },
            mc_last_name: {
                required: true,
                alphaCheck:true
            },
            mc_phone_number: {
                required: true,
                phoneNumberOnly:true,
                minlength: 10,
                maxlength: 12
            },
            mc_street_address: {
                required: true,
            },
            mc_city_state: {
                required: true,
                alphaCheck:true
            },
            "mc_acknowledgment_1[]": {
                required: true,
                minlength: 2
            },
            mc_emergency_first_name: {
                required: false,
                alphaCheck:true
            },
             mc_emergency_last_name: {
                required: false,
                alphaCheck:true
            },
        },
        messages:{
             mc_first_name: {
                 required:'Please enter valid first name',
            },
            mc_last_name: {
               required:'Please enter valid last name',
            },
            "mc_acknowledgment_1[]": {
                required:'You must provide your consent to participate in the program',
                minlength: 'You must provide your consent to participate in the program'
            },
            mc_phone_number:{
                required: "The phone field is required",
                phoneNumberOnly : "Please enter a valid phone number"
            },
            mc_emergency_first_name: {
                alphaCheck:"Please enter valid first name"
            },
             mc_emergency_last_name: {
                alphaCheck:"Please enter valid last name"
            },
        },
        
        
        errorElement: 'span',
        errorPlacement: function(error, element) {
            let type = $(element).attr("type");
            let id = $(element).attr("id");
            if (type === "checkbox" || type === "radio") {
                error.css({'margin-left':'11px'});
                error.insertAfter(element.parent().parent());
            } else if (id == "valid_to" || id == "valid_from") {
                error.insertAfter(element.parent());
            } else if (type === "file") {
                error.insertAfter(element.next());
            } else if ($(element).is("select")) {
                error.css({'position':'relative','top':'0px'})
                error.insertAfter(element.next());
            } else {

                error.insertAfter(element);
            }
        }
    });

};
    

if ($('#user-counseling-consent').length) {


    $('#user-counseling-consent').validate({
        rules: {
            cc_phone_number: {
                required: true,
            },
             cc_first_name: {
                required: true,
                alphaCheck:true
            },
            cc_last_name: {
                required: true,
                alphaCheck:true
            },
            cc_street_address: {
                required: true,
            },
            mc_acknowledgment_1: {
                required: true,
            },
            cc_city_state: {
                required: true,
                alphaCheck:true
            },
            cc_only_state: {
                required: true,
                alphaCheck:true
            },
            "cc_acknowledgment_1[]": {
                required: true,
                minlength: 2
            },
        },
        messages:{
            "cc_acknowledgment_1[]": {
                required:"You must provide your consent to participate in the program",
                minlength: 'You must provide your consent to participate in the program'
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            let type = $(element).attr("type");
            let id = $(element).attr("id");
            if (type === "checkbox" || type === "radio") {
                error.css({'margin-left':'11px'});
                error.insertAfter(element.parent().parent());
            } else if (id == "valid_to" || id == "valid_from") {
                error.insertAfter(element.parent());
            } else if (type === "file") {
                error.insertAfter(element.next());
            } else if ($(element).is("select")) {
                error.css({'position':'relative','top':'0px'})
                error.insertAfter(element.next());
            } else {

                error.insertAfter(element);
            }
        }
    });

}
});


