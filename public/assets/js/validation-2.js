$(document).ready(function() {
    // let phone_pattern = "([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})";
    // let phone_pattern = "^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$";
    // let phone_pattern = "^[\+\d]?(?:[\d-.\s()]*)$";
    let phone_pattern = "^(?=.*[0-9])[+()0-9]+$";
    let onlyText = "^[a-zA-Z]*$";
    let registerFormEle = $("#sign-up-form");	let loginForm = $("#user-login-form");

    let registerFormAwmi = $("#awmi-store");
    
    let invoiceFormEle = $("#invoice-form");
    let loginFormEle = $("#sign-in-form");
    let contactUsEle = $("#contact-us-form");
    let forgotPasswordFormEle = $("#forgot-password-form");
    let resetPasswordFormEle = $("#reset-password-form");
    let userProfileFormEle = $("#user-profile-form");
    let paymentFrom = $("#payment-form");
    let personalInfoFrom = $("#personal-info-form");
    let updatePasswordFrom = $("#update-password-form");
    let personlRecordForm = $("#personl-record-form");
    let medicationForm = $("#medication-form");
    let medicationAllergyForm = $("#medication-allergy-form");
    let medicationConditionForm = $("#medication-condition-form");

    let newDependentForm = $("#add-dependent-form");
    let updateDependentForm = $("#update-dependent-form");
    let uploadDocumentForm = $("#upload-document");
    let promoCodeForm = $("#promo-code-form");
    let promoCodeApplyForm = $("#promo-code-apply-form");
    let counselingForm = $("#counseling-add-edit-form");
    let subscribeToCounseling = $("#subscribe-to-counseling");
    let influencerForm = $("#influencer-form");
    let plansForm = $("#plans-form");
    let categoriesForm = $("#categories-form");
    let petssform = $("#pets-form");
    let adminUser = $("#admin-user");
    let roles = $("#roles");
    let permission = $("#permission");
    let blog = $("#blog");

    let rssFeeds = $("#rss-feed-forms");
    let planType = $("#planType");

    let serviceform = $("#serviceform");
    let serviceform2 = $("#serviceform2");
    let visitorDetails = $("#visitor-detail");
    let schoolDetails = $("#school-details");
    let affirmationTypeForm = $("#affirmation-type-form");
    let affirmationForm = $("#affirmation-form");

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

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    });
	
	$.validator.addMethod("onlyCharacters", function(value, element) {
		return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
	}, "Only alphabets are allowed.");
	
	

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
		
        return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&^._-]+$/.test(value)
            && /[a-z]/.test(value) 
            && /\d/.test(value) 
			
    });
    
    

    $.validator.addMethod("phoneNumberOnly", function(value) {
        return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value);
    });   
    
     $.validator.addMethod("onlyText", function(value) {
        return /^([a-zA-Z]+)$/.test(value);
    });
    
    

    // Register Form
    if (registerFormEle[0]) {
        registerFormEle.validate({
            ignore: ".ignore" ,
            rules: {
                fname: {
                    required: true,
                    onlyCharacters:true,
                    minlength: 2,
                    maxlength: 15,
                },
                lname: {
                    required: true,
                    onlyCharacters : true,
                    minlength: 2,
                    maxlength: 15
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
                            $('.emailFieldContainer').children('.spinner-border-div').removeClass('d-none');
                            $('.emailFieldContainer').children('.register-check').addClass('d-none');
                            $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                        },
                        complete: function(response){
                            console.log( {response} );
                            $('.emailFieldContainer').children('.spinner-border-div').addClass('d-none');
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
                primaryPhone: {
                    required: true,
                    // digits: true,
                    // matches: phone_pattern,
                    phoneNumberOnly:true,
                    minlength: 10,
                    maxlength: 12
                },
                password: {
                    required: true,
                    minlength: 8,
                    pwcheck:true
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
                access_code: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
                dob: {
                    required: true,
                    /* date_format: 'm/d/Y' */
                },
                gender: {
                    required: true,
                },
                timezoneId: {
                    required: true,
                },
                hiddenRecaptcha: {
                    required: function () {
                        if (grecaptcha.getResponse() == '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            },
            messages: {
                fname: {
                    required: "The first name field is required",
                    onlyText: 'Only characters  is allowed.'
                },
                lname: {
                    required: "The last name field is required",
                    onlyText: 'Only characters  is allowed.'
                },
                email: {
                    required: "The email field is required",
                    remote: `The email already exist. Please try another`
                },
                primaryPhone: {
                    required: "The phone field is required",
                    phoneNumberOnly : "Please enter a valid phone number"
                },
                password: {
                    required: "The password field is required",
                    pwcheck: "The password field is required",
                    minlength: "The password field is required"
                },
                password_confirmation: {
                    required: "The confirm password field is required",
                    equalTo: "The confirm password not same as password"
                },
                access_code: {
                    required: "The access code field is required",
                },
                dob: {
                    required: "The date of birth field is required",
                },
                gender: {
                    required: "The Gender field is Required"
                },
                timezoneId: {
                    required: "The timezone field is required"
                },
                hiddenRecaptcha:{
                    required: "Captcha field is required"
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
	if (loginForm[0]) {        loginForm.validate({            ignore: ":not(:visible)",            rules: {                email: {                    required: true,                },                password: {                    required: true,                },            },			messages: {                email: {                    required: "The email field is required",                },				password: {                    required: "The password field is required",                },							},			            errorElement: 'span',            errorPlacement: function(error, element) {                error.insertAfter(element);            }        });    }	
    if (registerFormAwmi[0]) {
        registerFormAwmi.validate({
            ignore: ".ignore" ,
            rules: {
                fname: {
                    required: true,
                    minlength: 2,
                    maxlength: 10
                },
                lname: {
                    required: true,
                    minlength: 2,
                    maxlength: 10
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
                                return $( "#emailsec" ).val();
                            }
                        },
                        beforeSend: function(){
                            $('.emailFieldContainer').children('.spinner-border').removeClass('d-none');
                            $('.emailFieldContainer').children('.register-check').addClass('d-none');
                            $('.emailFieldContainer').children('.register-triangle').addClass('d-none');
                        },
                        complete: function(response){
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
                        }
                    }
                },
                primaryPhone: {
                    required: true,
                    // digits: true,
                    matches: phone_pattern,
                    minlength: 10,
                    maxlength: 19
                },
                password: {
                    required: true,
                    minlength: 8,
                    pwcheck:true
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
                access_code: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
                dob: {
                    required: true,
                    /* date_format: 'm/d/Y' */
                },
                gender: {
                    required: true,
                },
                timezoneId: {
                    required: true,
                },
                hiddenRecaptcha: {
                    required: function () {
                        if (grecaptcha.getResponse() == '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
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
                    remote: `The email already exist. Please try another`
                },
                primaryPhone: {
                    required: "The phone field is required",
                },
                password: {
                    required: "The password field is required",
                    pwcheck: "The password field is required",
                    minlength: "The password field is required"
                },
                password_confirmation: {
                    required: "The confirm password field is required",
                    equalTo: "The confirm password not same as password"
                },
                access_code: {
                    required: "The access code field is required",
                },
                dob: {
                    required: "The date of birth field is required",
                },
                gender: {
                    required: "The Gender field is Required"
                },
                timezoneId: {
                    required: "The timezone field is required"
                },
                hiddenRecaptcha:{
                    required: "Captcha field is required"
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

    if (roles[0]) {
        roles.validate({
            ignore: ":not(:visible)",
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "The name field is required",
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
    }			if (loginForm[0]) {        loginForm.validate({            ignore: ":not(:visible)",            rules: {                email: {                    required: true,                },            },            messages: {                email: {                    required: "The name field is required",                },            },            errorElement: 'span',            errorPlacement: function(error, element) {                error.insertAfter(element);            }        });    }

    if (permission[0]) {
        permission.validate({
            ignore: ":not(:visible)",
            rules: {
                role_id: {
                    required: true,
                },
            },
            messages: {
                role_id: {
                    required: "The assign to field is required",
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

    if (blog[0]) {
        blog.validate({
            ignore: ":not(:visible)",
            rules: {
                category_id: {
                    required: true,
                },
                title: {
                    required: true,
                },
            },
            messages: {
                category_id: {
                    required: "The categories field is required",
                },
                title: {
                    required: "The title field is required",
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

    if (adminUser[0]) {
        adminUser.validate({
            ignore: ":not(:visible)",
            rules: {
                first_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                email: {
                    required: true,
                    validate_email: true,
                    maxlength: 255
                },
                primaryphone: {
                    required: true,
                    matches: phone_pattern,
                    minlength: 10,
                    maxlength: 19
                },
                genders: {
                    required: true,
                },
                timezone: {
                    required: true,
                },
                zipcode: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
            },
            messages: {
                first_name: {
                    required: "The first name field is required",
                },
                last_name: {
                    required: "The last name field is required",
                },
                email: {
                    required: "The email field is required",
                },
                primaryphone: {
                    required: "The phone field is required",
                },
                genders: {
                    required: "The gender field is required"
                },
                timezone: {
                    required: "The timezone field is required"
                },
                zipcode: {
                    required: "The zipcode field is required"
                },
                state: {
                    required: "The state field is required",
                },
                city: {
                    required: "The city field is required",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    // invoice details
    // Register Form
    if (invoiceFormEle[0]) {
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
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {

                let type = $(element).attr("type");
                if (element.is(":radio")) {
                    error.insertAfter(element.parent());
                } else if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }

            }
        });
    }

    // Login Form
    if (loginFormEle[0]) {
        loginFormEle.validate({
            rules: {
                email: {
                    required: true,
                    validate_email: true,
                    maxlength: 255
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.email') }),
                    email: trans('lang.validation.email', { attribute: trans('lang.labels.email') }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.email'), max: 255 })
                },
                password: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.password') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.password'), min: 6 })
                }
            },
            errorElement: 'span'
        });
    }

    // Forgot Password Form
    if (forgotPasswordFormEle[0]) {
        forgotPasswordFormEle.validate({
            rules: {
                email: {
                    required: true,
                    validate_email: true,
                    maxlength: 255
                }
            },
            messages: {
                email: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.email') }),
                    email: trans('lang.validation.email', { attribute: trans('lang.labels.email') }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.email'), max: 255 })
                }
            },
            errorElement: 'span'
        });
    }

    // Reset Password Form
    if (resetPasswordFormEle[0]) {
        resetPasswordFormEle.validate({
            rules: {
                email: {
                    required: true,
                    validate_email: true,
                    maxlength: 255
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
                email: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.email') }),
                    email: trans('lang.validation.email', { attribute: trans('lang.labels.email') }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.email'), max: 255 })
                },
                password: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.password') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.password'), min: 6 })
                },
                password_confirmation: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.confirm_password') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.confirm_password'), min: 6 }),
                    equalTo: trans('lang.validation.confirmed', { attribute: trans('lang.labels.password') })
                }
            },
            errorElement: 'span'
        });
    }

    // User profile Form
    if (userProfileFormEle[0]) {
        userProfileFormEle.validate({
            ignore: [],
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                role: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                sector: {
                    required: true
                },
                country: {
                    required: true
                },
                currency: {
                    required: true
                },
                tax_id: {
                    required: true
                },
                address: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                city: {
                    // required: true,
                    minlength: 3,
                    maxlength: 255
                },
                state: {
                    // required: true,
                    minlength: 3,
                    maxlength: 255
                },
                phone: {
                    required: true,
                    // digits: true,
                    matches: phone_pattern,
                    minlength: 10,
                    maxlength: 19
                },
                /*fax: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 10
                },*/
                mobile: {
                    // required: true,
                    matches: phone_pattern,
                    minlength: 10,
                    maxlength: 19
                }
            },
            messages: {
                name: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.name') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.name'), min: 3 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.name'), max: 255 })
                },
                role: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.role') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.role'), min: 3 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.role'), max: 255 })
                },
                sector: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.sector') })
                },
                country: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.country') })
                },
                currency: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.currency') })
                },
                tax_id: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.tax') })
                },
                address: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.address') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.address'), min: 3 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.address'), max: 255 })
                },
                city: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.city') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.city'), min: 3 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.city'), max: 255 })
                },
                state: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.state') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.state'), min: 3 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.state'), max: 255 })
                },
                phone: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.phone') }),
                    // digits: trans('lang.validation.numeric', {attribute: trans('lang.labels.phone')}),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.phone'), min: 10 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.phone'), max: 19 })
                },
                /*fax: {
                    required: trans('lang.validation.required', {attribute: trans('lang.labels.fax')}),
                    digits: trans('lang.validation.numeric', {attribute: trans('lang.labels.fax')}),
                    minlength: trans('lang.validation.min.string', {attribute: trans('lang.labels.fax'), min: 5}),
                    maxlength: trans('lang.validation.max.string', {attribute: trans('lang.labels.fax'), max: 10})
                },*/
                mobile: {
                    required: trans('lang.validation.required', { attribute: trans('lang.labels.mobile') }),
                    minlength: trans('lang.validation.min.string', { attribute: trans('lang.labels.phone'), min: 10 }),
                    maxlength: trans('lang.validation.max.string', { attribute: trans('lang.labels.phone'), max: 19 })
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    // Payment Form
    if (paymentFrom[0]) {
        paymentFrom.validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
            },
            messages: {
                username: {
                    required: "The card owner name field is required",
                },
            },
            errorElement: 'span'
        });
    }

    // Personal Info Form
    if (personalInfoFrom[0]) {
        personalInfoFrom.validate({
            ignore: ":not(:visible)",
            rules: {
                /*  fname: {
                     required: true,
                     minlength: 3,
                     maxlength: 255
                 },
                 lname: {
                     required: true,
                     minlength: 3,
                     maxlength: 255
                 }, */
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
                    maxlength: 10
                },
                address: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                city: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                stateid: {
                    required: true,
                },
                zipCode: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                timezoneId: {
                    required: true,
                }
            },
            messages: {
                /*  fname: {
                     required: "The first name field is required",
                 },
                 lname: {
                     required: "The last name field is required",
                 }, */
                email: {
                    required: "The email field is required",
                },
                primaryPhone: {
                    required: "The phone field is required",
                },
                address: {
                    required: "The address field is required",
                },
                city: {
                    required: "The city field is required",
                },
                stateid: {
                    required: "The state field is required",
                },
                zipCode: {
                    required: "The zipcode field is required"
                },
                gender: {
                    required: "The gender field is required"
                },
                timezoneId: {
                    required: "The timezone field is required"
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

    // Register Form
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


    // personl health Record Form
    if (personlRecordForm[0]) {
        personlRecordForm.validate({
            ignore: [],
            rules: {
                weight: {
                    maxlength: 3,
                    number: true,
                },
                bloodPressureSystolic: {
                    maxlength: 3,
                    number: true,
                },
                bloodPressureDiastolic: {
                    maxlength: 3,
                    number: true,
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    // medication Form
    if (medicationForm[0]) {
        medicationForm.validate({
            ignore: [],
            rules: {
                medicationSearch: {
                    required: true,
                },
                medicationName: {
                    required: true,
                },
                /*medicationComment: {
                    required: true,
                },*/
                medicationCurrentUse: {
                    required: true,
                },
                medicationFrequency: {
                    required: true,
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if (type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    // New Dependent Form
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
                    validate_email: true
                    
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

    // Update Dependent Form
    if (updateDependentForm[0]) {
        updateDependentForm.validate({
            ignore: ":not(:visible)",
            rules: {
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
                zipCode: {
                    required: true,
                },
                gender: {
                    required: true,
                },
            },
            messages: {
                primaryPhone: {
                    required: "The primary phone field is required",
                },
                status: {
                    required: "The status field is required",
                },
                address: {
                    required: "The address field is required",
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


if (medicationAllergyForm[0]) {
        medicationAllergyForm.validate({
            rules: {
                states: {
                    required: true,
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class")) {
                    error.insertAfter(element.parent().next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }


    if (medicationConditionForm[0]) {
        medicationConditionForm.validate({
            ignore: ":not(:visible)",
            rules: {
                medicalConditionName: {
                    required: true,
                },
                medicalConditionDescription: {
                    required: true,
                },
                medicalConditionStatus: {
                    required: true,
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if (type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    // Promo Code Form
    if (promoCodeApplyForm[0]) {
        promoCodeApplyForm.validate({
            ignore: [],
            rules: {
                code: {
                    required: true,
                },
            },
            messages: {
                code: {
                    required: "Please fill your promo code",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "text") {
                    error.insertAfter(element.next());
                }
            }
        });
    }

    // Upload Document Form
    if (uploadDocumentForm[0]) {
        uploadDocumentForm.validate({
            ignore: ":not(:visible)",
            rules: {
                file: {
                    required: true,
                    extension: "pdf|png|gif|jpg"
                },
            },
            messages: {
                file: {
                    required: "Please upload your document",
                    extension: "Please upload jpg,pdf,gif,png files only",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
			submitHandler: function(form) {
				showLoaderPageLoad('show');
				form.submit();

				
			}
        });
    }



    //admin promo code form validations
    if (promoCodeForm[0]) {
        promoCodeForm.validate({
            rules: {
                influencerType: {
                    required: true,
                },
                influencer_id: {
                    required: true,
                },
                code: {
                    required: true,
                    //maxlength: 20,
                },
                valid_from: {
                    required: true,
                    //maxlength: 20,
                },
                valid_to: {
                    required: true,
                    //maxlength: 20,
                },
                influencer_commission_type: {
                    required: true,
                    //maxlength: 20,
                },
                influencer_commission_amount: {
                    required: true,
                    //maxlength: 20,
                },
                allowed_members: {
                    required: true,
                    //maxlength: 20,
                },
                member_discount_type: {
                    required: true,
                    //maxlength: 20,
                },
                member_discount_amount: {
                    required: true,
                    //maxlength: 20,
                }
            },
            messages: {
                influencerType: {
                    required: "The influencer type field is required",
                },
                influencer_id: {
                    required: "The influencer field is required",
                },
                code: {
                    required: "Code is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                valid_from: {
                    required: "Valid From Date is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                valid_to: {
                    required: "Valid To Date is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                influencer_commission_type: {
                    required: "Discount Type is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                influencer_commission_amount: {
                    required: "Discount Amount is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                allowed_members: {
                    required: "Allowed Members is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                member_discount_type: {
                    required: "Member Discount Type is required",
                    //maxlength: "Code cannot be more than 20 characters"
                },
                member_discount_amount: {
                    required: "Member Discount Amount is required",
                    //maxlength: "Code cannot be more than 20 characters"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }
    //admin counselng code form validations

    if (counselingForm[0]) {
        counselingForm.validate({
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                minimum_number_of_users: {
                    required: true
                },
                maximum_number_of_users: {
                    required: true
                },
                registration_fee: {
                    required: true
                },
                counseler_id: {
                    required: true
                },
                last_registration_date: {
                    required: true
                },
            },
            messages: {
                title: {
                    required: "Title is required"
                },
                description: {
                    required: "Description is required"
                },
                minimum_number_of_users: {
                    required: "Minimum number of user is required"
                },
                maximum_number_of_users: {
                    required: "Maximum number of user is required"
                },
                registration_fee: {
                    required: "Reistration fee is required"
                },
                counseler_id: {
                    required: "Please select any counseler."
                },
                last_registration_date: {
                    required: "Last registration date is required."
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    if (subscribeToCounseling[0]) {
        subscribeToCounseling.validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true
                },
                phone_number: {
                    required: true
                },
                select_counseling: {
                    required: true
                }

            },
            messages: {
                first_name: {
                    required: "First Name is required."
                },
                last_name: {
                    required: "Last Name is required."
                },
                email: {
                    required: "Email is required."
                },
                phone_number: {
                    required: "Phone Number is required."
                },
                select_counseling: {
                    required: "Please select counseling."
                },
            },
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }



    // Influencer Form
    if (influencerForm[0]) {
        influencerForm.validate({
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
                    // digits: true,
                    matches: phone_pattern,
                    minlength: 10,
                    maxlength: 19
                },
                password: {
                    required: true,
                    minlength: 6
                },
                influencerType: {
                    required: true,
                },
                organization: {
                    required: true,
                },
                user_role: {
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
                    required: "The phone field is required",
                },
                influencerType: {
                    required: "The influencer type field is required",
                },
                organization: {
                    required: "The organization field is required",
                },
                user_role: {
                    required: "The user type field is required",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    //admin plans form validations
    if (plansForm[0]) {
        plansForm.validate({
            rules: {
                type: {
                    required: true,
                },
                name: {
                    required: true,
                },
                interval: {
                    required: true,
                },
                amount: {
                    required: true,
                },
                description: {
                    required: true,
                }
            },
            messages: {
                type: {
                    required: "The type field is required",
                },
                name: {
                    required: "The name field is required",
                },
                interval: {
                    required: "The interval field is required",
                },
                amount: {
                    required: "The amount field is required",
                },
                description: {
                    required: "The description field is required",
                }

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }
    if (categoriesForm[0]) {
        categoriesForm.validate({
            rules: {
                name: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The name field is required",
                }
            },
            errorElement: 'span',
        });
    }

    if (planType[0]) {
        planType.validate({
            rules: {
                title: {
                    required: true,
                }
            },
            messages: {
                title: {
                    required: "The title field is required",
                }
            },
            errorElement: 'span',
        });
    }

    if (rssFeeds[0]) {
        rssFeeds.validate({
            ignore: [],
            rules: {
                "tab_name[]": {
                    required: true,
                },
                "rss_link[]": {
                    required: true,
                }
            },
            messages: {
                "tab_name[]": {
                    required: "The tab name field is required",
                },
                "rss_link[]": {
                    required: "The Rss link field is required",
                }
            },
            errorElement: 'span',
        });
    }
    //pets form validations
    if (petssform[0]) {
        petssform.validate({
            rules: {
                name: {
                    required: true,
                },
                species: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                months: {
                    required: true,
                },
                years: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "The name field is required",
                },
                species: {
                    required: "The species field is required",
                },
                gender: {
                    required: "The gender field is required",
                },
                months: {
                    required: "The months field is required",
                },
                years: {
                    required: "The years field is required",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    //pets form validations
    if (serviceform[0]) {
        serviceform.validate({
            errorClass: "error error-help-inline",
            rules: {
                "company-details": {
                    required: true,
                },
                "company-details[title]": {
                    required: true,
                },
                "company-details[slug]": {
                    required: true,
                },
                "services[emotional-wellness][title]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][first][title]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][first][description]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][second][title]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][second][description]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[medical-care][title]": {
                    required: function(){
                        if($('input[name="services[medical-care][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[tele-pet-now][title]": {
                    required: function(){
                        if($('input[name="services[tele-pet-now][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[banner][title]": {
                    required: true,
                },
                services: {
                    required: true,
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (type === "file") {
                    //console.log(error);
                    error.insertAfter(element.closest(".avatar-upload"));
                } else if (
                    $(element).is("select") &&
                    $(element).attr("class")
                ) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
        });
    }


 /*     if (serviceform2[0]) {
        serviceform2.validate({
            rules: {
                "company-details": {
                    required: true,
                },
                "company-details[title]": {
                    required: true,
                },
                "services[emotional-wellness][title]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][first][title]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][first][description]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][second][title]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[emotional-wellness][child][second][description]": {
                    required: function(){
                        if($('input[name="services[emotional-wellness][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[medical-care][title]": {
                    required: function(){
                        if($('input[name="services[medical-care][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[tele-pet-now][title]": {
                    required: function(){
                        if($('input[name="services[tele-pet-now][status]"]').is(':checked')){
                            return true
                        }else{
                            return false
                        }
                    },
                },
                "services[banner][title]"   : {
                    required: true,
                },
                services: {
                    required: true,
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                let type = $(element).attr("type");
                let id = $(element).attr("id");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.parent().parent());
                } else if (id == "valid_to" || id == "valid_from") {
                    error.insertAfter(element.parent());
                } else if (
                    $(element).is("select") &&
                    $(element).attr("class")
                ) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
        });
    } */

    if (visitorDetails[0]) {
        visitorDetails.validate({
            ignore: [],
            rules: {
                visitor_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                visiting_date: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                }

            },
            messages: {
                visitor_name: {
                    required: "Required.",
                },
                visiting_date: {
                    required: "Required.",
                },


            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                console.log(error, 'sd 654 45');
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    if (schoolDetails[0]) {
        schoolDetails.validate({
            ignore: [],
            rules: {
                name_of_school: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                student_id: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                printed_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                created_dated: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                }

            },
            messages: {
                name_of_school: {
                    required: "Required.",
                },
                student_id: {
                    required: "Required.",
                },
                printed_name: {
                    required: "Required.",
                },
                created_dated: {
                    required: "Required.",
                },


            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

    $('#journal').validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            title: {
                required: "The title field is required"
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            let type = $(element).attr("type");
            if (type === "checkbox" || type === "radio") {
                error.insertAfter(element.next());
            } else if (
                $(element).is("select") &&
                $(element)
                    .attr("class")
                    .includes("search-selection")
            ) {
                error.insertAfter(element.next());
            } else {
                error.insertAfter(element);
            }
        }
    });

        $("#corporateJournal").validate({
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "The title field is required"
                },
                description: {
                    required: "The title field is required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if (
                    $(element).is("select") &&
                    $(element)
                        .attr("class")
                        .includes("search-selection")
                ) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });


        $("#safetyPlan").validate({
            rules: {
                title: {
                    required: true
                },
                type: {
                    required: true
                },
                icon: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "The title field is required"
                },
                type: {
                    required: "The type field is required"
                },
                icon: {
                    required: "The icon field is required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes("search-selection")) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });


        $(affirmationTypeForm[0]).validate({
            rules: {
                type: {
                    required: true
                }
            },
            messages: {
                message: {
                    required: "The field is required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes("search-selection")) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $(affirmationForm[0]).validate({
            rules: {
                message: {
                    required: true
                },
                parent_type: {
                    required: true
                }
            },
            messages: {
                message: {
                    required: "The field is required"
                },
                parent_type: {
                    required: "The field is required"
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes("search-selection")) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });

            $.validator.addMethod('emailCheck', function (value) {
            return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, 'Please enter a valid email');

        $.validator.addMethod('phoneCheck', function (value) {
            return /^[\+][0-9-_.]{5,20}$/.test(value);
        }, 'Please enter a valid phone number');

        $.validator.addMethod('phoneMaxCheck', function (value) {
            let phone = value.replace('+1','').replace('(','').replace(')','').replaceAll('-','');
            if( phone.length == 10 ){
                return true;
            }
        }, 'Please enter a valid phone number');

        jQuery.validator.addMethod("alphaCheck", function(value, element) {
        return this.optional(element) || onlyAlpha(value);
        }, "Please enter only letters");

    jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
        phone_number.match(/^(\+?)?$/);
    }, "Please specify a valid phone number");

    function onlyAlpha(values) {
    let r = /\d+/;
    return !values.match(r);
}

    $('#user-general-information').validate({
        rules: {
            fullname: {
                required: true,
            },
            gender: {
                required: true,
            },
            dob: {
                required: true,
            },
            home_address: {
                required: true,
            },
            About_iWILLtilimWELL: {
                required: true,
            },
            medical_care: {
                required: true,
            },
            counseling: {
                required: true,
            },
            pet_care: {
                required: true,
            },
            phone: {
                required:true,
                minlength:7,
            },
            country_origin:{
                alphaCheck:true
            }
        },
        messages: {
            fullname: {
                required: "The name field is required",
            },
            gender: {
                required: "The gender field is required",
            },
            dob: {
                required: "The dob field is required",
            },
            home_address: {
                required: "The home address field is required",
            },
            About_iWILLtilimWELL: {
                required: "This field is mandatory",
            },
            medical_care: {
                required: "The medical care check is required",
            },
            counseling: {
                required: "The mental health check is required",
            },
            pet_care: {
                required: "The pet care check is required",
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            let type = $(element).attr("type");
            let id = $(element).attr("id");
            if (type === "checkbox" || type === "radio") {
                error.css({'margin-left':'11px'});
                console.log( element );
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
            "mc_phone_number":{
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
                required: true
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
    
     if (contactUsEle[0]) {
        contactUsEle.validate({
            ignore: ":not(:visible)",
            rules: {
                  first_name: {
                     required: true,
                     alphaCheck:true,
                     minlength: 3,
                     maxlength: 20
                 },
                 last_name: {
                     required: true,
                     alphaCheck:true,
                     minlength: 3,
                     maxlength: 20
                 },
                email: {
                    required: true,
                    validate_email: true,
                    maxlength: 100
                },
                phone: {
                    required: true,
                    // digits: true,
                   phoneNumberOnly:true,
                    minlength: 10,
                    maxlength: 12
                },
                message: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                }
            },
            messages: {
                  first_name: {
                     required: "The first name field is required",
                 },
                 last_name: {
                     required: "The last name field is required",
                 }, 
                email: {
                    required: "The email field is required",
                },
                phone: {
                    required: "The phone field is required",
                    phoneNumberOnly:"Please enter a valid phone number."
                },
                message: {
                    required: "The message field is required",
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
    
    let selectConEle = $("#select-consulation");
    if (selectConEle[0]) {
        selectConEle.validate({
            ignore: ":not(:visible)",
            rules: {phoneNumber: {
                    required: true,
                    // digits: true,
                   phoneNumberOnly:true,
                    minlength: 10,
                    maxlength: 12
                },
                roi: {
                    required: true
                }
            },
            messages: {
                
                phoneNumber: {
                    required: "The phone field is required",
                    phoneNumberOnly:"Please enter a valid phone number."
                },
                roi: {
                    required: "The message field is required",
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
    
     let scheduleFormEle = $("#schedule-form");
    if (scheduleFormEle[0]) {
        scheduleFormEle.validate({
            ignore: ":not(:visible)",
            rules: {
                whenScheduled: {
                    required: true,
                }
            },
            messages: {
                
                whenScheduled: {
                    required: "This field is required",
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
    
      let spfEle = $("#submit-pharmacy-form");
    if (spfEle[0]) {
        spfEle.validate({
            ignore: [],
            rules: {
                sureScriptPharmacy_id: {
                    required: true,
                }
            },
            messages: {
                
                sureScriptPharmacy_id: {
                    required: "Please select a pharmacy before moving to next step.",
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

});



