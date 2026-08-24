

/*  step form end  */


$(function() {

    $(".mood-face-label").on('click', function() {
        var facecontent = $(this).parents('.mood-face-max-row').find(".moods-face-dynamic").html();
        $("#moods-nesting-row .mood-face-cell").html(facecontent);
    });
  $('.plans-guide-block').hide();
   $("#plans .plans-content").on('click',function(e) {
	   
        e.preventDefault();
		
		let title = $(this).find('.plans-heading').html();
		title  = $("<div>").html(title).find("p").text().trim();
		$("#safty_plan_type").val(title);
		
		
		let db_content = $(this).find('.db_content').val();
		db_content = db_content.split(','); // ["h", "h2", "h3"]
		console.log(db_content);
		let loopCount = Math.max(db_content.length, 1);
		
		$("#teamArea").html('');
		for(var i = 0; i< loopCount;i++) {
			
			let value = db_content[i] ?? '';
			let input = '<input type="text" name="fields[]" class="form-control saftyplanfield" value="'+value+'">';
			$("#teamArea").append(input);

		}
	
		
        var facecontent = $(this).parents('.plans-item').find(".warning-signs-block").html();
        $(".plans-guide-block .warning-signs-block").html(facecontent);
        $(this).parents('.plans-row').hide();
        $('.plans-guide-block').show();
        $('.plans-guide-block').addClass("active-plans-guide-block");
		
    });

    $('.plans-guide-block .back-arrow').on('click', function(e) {
        e.preventDefault();
        $('.safety-conent-inner .plans-row').show();
        $('.safety-conent-inner .plans-row').addClass("active-plans-row");
        $('.plans-guide-block').hide();
        $('.plans-guide-block').removeClass("active-plans-guide-block");
    });



    $('.guide-descrip-content').hide();
    $(".guide-content .plans-content").on('click',function(e) {
         e.preventDefault();
         var facecontent = $(this).parents('.plans-item').find(".guide-detail-content").html();
         var plansheading  = $(this).find(".plans-heading").html();
         $(".guide-descrip-content .guide-dynamic-box").html(facecontent);
         $(".guide-descrip-content h3").html(plansheading);

         $(this).parents('.plans-row').hide();
         $('.guide-descrip-content').show();
         $('.guide-descrip-content').addClass("active-guide-descrip-content");

     });

     $('.guide-descrip-content .back-arrow').on('click', function(e) {
         e.preventDefault();
         $('.guide-content .plans-row').show();
         $('.guide-content .plans-row').addClass("active-plans-row");
         $('.guide-descrip-content').hide();
         $('.guide-descrip-content').removeClass("active-guide-descrip-content");
     });


    $("#addNewTeam").on('click', function(e) {
        //Append new field
        e.preventDefault();
        var newField = $('#teamArea input:first').clone();
        newField.val("");
        $("#teamArea").append(newField);
      });

    $('#removeLastTeam').on('click', function(e) {
        e.preventDefault();

        if ($('div.custom-safe-field-control').find('input').length > 1)
        {
            $("#teamArea input:last-child").remove();
        }
    });

    $('.control-group').on('click', function(e) {
        e.preventDefault();
        if ($('div.custom-safe-field-control').find('input').length > 1)
        {
            $('#removeLastTeam').show();
        }
    });

});

jQuery(function($) {

    /* upgradeMyPlan start */

    $("#upgradeMyPlan").modal('hide');


    /* upgradeMyPlan end */

    var rows_to_delete = [];
    $('[data-toggle="tooltip"]').tooltip();
    /* if (USER_PAYMENT_STATUS && USER_PAYMENT_STATUS != 1) {
        $("#dashboard-popup").modal({ backdrop: "static", keyboard: true });
    } */

    var lis = $(".register-number li");
    var dataArray = [];
    //  submit first step
    $("#sign-up-form").submit(function(e) {
        e.preventDefault();
        $form = $("#sign-up-form");
        if ($("#sign-up-form").valid()) {
            $("#sign-up-form .custom-button")
                .val("Please wait...")
                .attr("disabled", true);
            $.post(
                $form.attr("action"),
                $(this).serialize(),
                function(response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    $("#sign-up-form .custom-button")
                        .val("Submit")
                        .attr("disabled", false);
                    if (response.original.status) {
                        if (response.original.data) {
                            let res = response.original.data;
                            location.href = SITE_URL + "/dashboard";

                            if (res.step_position == 4) {
                                setPaymentFields(res);
                            }
                        } else {
                            location.href = SITE_URL + "/dashboard";
                        }
                    } else {
                        if (response.original.payment_status == 1 && response.original.user_status == 1 && response.original.tele_userid) {
                            $(".set-error")
                                .html(
                                    "You are already registered, please login <a href='" +
                                    SITE_URL +
                                    "/login'>here</a>"
                                )
                                .show();
                        } else if (response.original.payment_status == 2) {
                            $(".set-error").hide();
                            $("#access-code-div").show("");
                        } else {
                            $(".register-form").prepend(
                                '<div class="alert alert-danger" role="alert">' +
                                response.original.message +
                                "</div>"
                            );
                            $(".alert-danger").fadeOut(5000, function() {
                                $(this).remove();
                            });
                        }
                    }
                }
            );
        }else{
            console.log( $("#sign-up-form").valid() );
        }
    });

    $('.ip-hamburger-icon ul').click(function() {
        $('.ip-hamburger-icon ul').toggleClass('active');
        $('.menu-tabs-cus ').toggleClass('show');

    })
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });
        return false;
    });

    $(".selectPlan").click(function(e) {

        console.log("----");
        e.preventDefault();
        if ($(this).hasClass('disabledPlan')) {
            return false;
        }
        var planId = $(this).attr('planId');
        var dataId = $(this).attr('data-id');
        $('input[name="select_plan"]').val(planId)
        $('input[name="select_plan"]').attr('data-id', dataId);
        $form = $("#sign-up2-form");
        var getval = $('input[name="select_plan"]').val();
        var getPlanDetail = $("#getPlanDetail").val();
        var email = $("#email").val();
        if ($(this).attr('upgradePlanSelect') != 1) {
            $.post(
                $form.attr("action"),
                $form.serialize() +
                "&email=" +
                email +
                "&getPlanDetail=" +
                getPlanDetail,
                function(response) {
                    var response = JSON.parse(response);
                    if (response.original.status) {
                        let res = response.original.data;
                        $("#plan").val(getval);
                        gotoStep("step3", "step2");
                        lis.slice(0, 3).attr("class", "active");
                        dataArray["fname"] = res.fname;
                        dataArray["lname"] = res.lname;
                        dataArray["email"] = res.email;
                        dataArray["phone"] = res.primaryPhone;
                        invoiceForm(dataArray);
                    } else {
                        $("#res-msg").text(response.original.message);
                    }
                }
            );
            return false;
        } else {
            $("#plan").val(getval);
            gotoStep("step3", "step2");
            lis.slice(0, 3).attr("class", "active");
        }

    });






// AWMI select plan

    // goto payment page
    $("#invoice-form").submit(function(e) {
        e.preventDefault();
        $form = $("#invoice-form");
        if ($form.valid()) {
            $.ajax({
                method: "POST",
                url: $form.attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {					
                    if (data.original.status) {
                        let res = data.original.data;				
                        getPaymentStatus(data.original);                        setPaymentFields(res);
                        gotoStep("step4", "step3");

                        lis.slice(0, 4).attr("class", "active");
                    } else {
                        //$("#res-msg").text(data.original.message);
                        // alert(data.original.message);
                        $("#res-msg").append(
                            '<div class="alert alert-danger" role="alert">' +
                            data.original.message +
                            "</div>"
                        );
                        $(".alert-danger").fadeOut(5000, function() {
                            $(this).remove();
                        });
                    }
                },
            });
        }
    });

    // information intake page forms save
    $(".general-info").click(function(e) {
        e.preventDefault();
        $form = $("#general-info-form");
        $.post($form.attr("action"), $form.serialize(), function(response) {
            var response = JSON.parse(response);
            alert(response.original.message);
            if (response.original.status) {
                let res = response.original.message;
            }
        });
        return false;
    });

    // dependent information intake page forms save
    $(".dependent-info").click(function(e) {
        e.preventDefault();
        $form = $("#dependent-info-form");
        $.post($form.attr("action"), $form.serialize(), function(response) {
            var response = JSON.parse(response);
            alert(response.original.message);
            if (response.original.status) {
                let res = response.original.message;
            }
        });
        return false;
    });

    // medical condition page forms save
    $(".medicalConditionSubmit").click(function(e) {
        e.preventDefault();
        $form = $("#medical-condition-form");
        $.post($form.attr("action"), $form.serialize(), function(response) {
            var response = JSON.parse(response);
            alert(response.original.message);
            if (response.original.status) {
                let res = response.original.message;
            }
        });
        return false;
    });

    // medication condition page forms save
    $(".medicationSubmit").click(function(e) {
        e.preventDefault();
        $form = $("#medication-form");
        $.post($form.attr("action"), $form.serialize(), function(response) {
            var response = JSON.parse(response);
            alert(response.original.message);
            if (response.original.status) {
                let res = response.original.message;
            }
        });
        return false;
    });

    // medication condition page forms save
    $(".medicationAllergySubmit").click(function(e) {
        e.preventDefault();
        $form = $("#medication-allergy-form");
        $.post($form.attr("action"), $form.serialize(), function(response) {
            var response = JSON.parse(response);
            alert(response.original.message);
            if (response.original.status) {
                let res = response.original.message;
            }
        });
        return false;
    });

    // medication condition page forms save
    $(".consultationSubmit").click(function(e) {
        e.preventDefault();
        $form = $("#consultation-form");
        $.post($form.attr("action"), $form.serialize(), function(response) {
            var response = JSON.parse(response);
            alert(response.original.message);
            if (response.original.status) {
                let res = response.original.message;
            }
        });
        return false;
    });

    var timer = null;

    // medication condition page forms save
    $(document).on("keyup", "#medicationSearch", function(e) {
        e.preventDefault();
        $("#searchFilter").html("Please wait...");
        clearTimeout(timer);
        timer = setTimeout(medicationSearch, 500);
    });

    function medicationSearch() {
        $form = SITE_URL + "/search-medication";
        let keyword = $("#medicationSearch").val();

        if (keyword.length > 1) {
            $.get($form, { keyword: keyword }, function(response) {
                $("#searchFilter").html(response.data);
            });
            return false;
        } else {
            $("#searchFilter").html("");
        }
    }

    $(document).on("change", ".medication-option", function(e) {
        e.preventDefault();
        let foreign = $(this).find(":selected").data("foreign");
        let ndc = $(this).find(":selected").data("ndc");
        $("#medicationForeignId").val(foreign);
        $("#medicationNDC").val(ndc);
    });

    //  for medication allergy filter

    $(document).on("keyup", "#medicationAllergySearch", function(e) {
        e.preventDefault();
        $("#allergySearchFilter").html("Please wait...");
        clearTimeout(timer);
        timer = setTimeout(medicationAllergySearch, 500);
    });

    function medicationAllergySearch() {
        $form = SITE_URL + "/search-medication-allergy";
        let keyword = $("#medicationAllergySearch").val();

        if (keyword.length > 1) {
            $.get($form, { keyword: keyword }, function(response) {
                $("#allergySearchFilter").html(response.data);
            });
            return false;
        } else {
            $("#allergySearchFilter").html("");
        }
    }

    $(document).on("change", ".allergy-option", function(e) {
        e.preventDefault();
        let foreign = $(this)
            .find(":selected")
            .data("medicationallergyforeignid");
        let damConceptId = $(this).find(":selected").data("damconceptid");
        let type = $(this).find(":selected").data("damconceptidtype");

        $("#medicationAllergyForeignId").val(foreign);
        $("#medicationAllergyDamConceptId").val(damConceptId);
        $("#medicationAllergyDamConceptIdType").val(type);
    });

    $(".prevStep").click(function() {
        var stepTo = $(this).data("prev");
        var stepFrom = $(this).data("current");
        gotoStep(stepTo, stepFrom);
    });

    $(".click-here").click(function() {
        $(".main-phone-box").toggleClass("Show");
    });

    $(
        "#personal-info-form, #update-password-form, #update-dependent-form, #add-dependent-form, #medication-form, #medication-allergy-form, #medication-condition-form, #upload-document, #resend-register-email, #update-user-status, #update-relatioship, #submit-pharmacy-form, #user-login-form, #forgot-password-email-form, #reset-password-form, #promo-code-form, #counseling-add-edit-form, #categories-form"
    ).submit(function(e) {
        if ($(this).valid()) {
            //$("#loading").show();
        }
    });

    $(document).on("submit", "#personl-record-form, #medication-condition-form, #medication-form, #medication-allergy-form", function(e) {
        if($(this).valid()) {
           showLoaderPageLoad('show');
        }
    });

    // Subscribe to Counseling
    $(document).on("submit", "#subscribe-to-counseling", function(e) {
        if ($(this).valid()) {
            //$("#loading").show();
        }
    });

    // New Denedent tab hide show
    $(".add-new-dependent").click(function() {
        $(".tabs-new-dependent ul.nav-tabs li.nav-item a")
            .not($(".add-new-dependent-tab"))
            .removeClass("active");
        $(".dependent-content-cnt .tab-pane")
            .not($("#new-dependent"))
            .removeClass("active show");
        $(".add-new-dependent-content").show();
        $(".add-new-dependent-tab").show();
        $(this).attr("disabled", "disabled");
    });
    // $(".movetoStep").click(function() {
    //   var stepTo = $(this).data('prev');
    //   var stepFrom = $(this).data('current');
    //   gotoStep(stepTo, stepFrom);
    // });

    $('a[data-toggle="tab"]').on("show.bs.tab", function(e) {
        //localStorage.setItem("activeTab", $(e.target).attr("href"));
    });

    var activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
        //$('#myTab a[href="' + activeTab + '"]').tab("show");
        //$('#myTabs a[href="' + activeTab + '"]').tab("show");
    }



    // personal popup load
    $(".health-modal-call").click(function(e) {
        e.preventDefault();
        let id = $(this).data("id");

        $action = SITE_URL + "/load-personal-popup/" + id;
        $.get($action, "", function(response) {
            $("#personal-info-popup").html(response.data);
            $("#personalRecordModalCenter").modal("show");
        });
        return false;
    });

    // Add Dynamic Date Column
    var del_count = 1;
    $(".add-new-day").click(function(e) {
        e.preventDefault();
        let divCopy = document.getElementById("div-1").cloneNode(true);
        divCopy.setAttribute("id", del_count + '_delete');
        let delete_button = document.createElement("button");

        let icon = document.createElement("i");
        icon.setAttribute("class", "fas fa-trash-alt");
        delete_button.appendChild(icon);
        let textNode = document.createTextNode('Delete');
        delete_button.setAttribute('content', 'Delete');
        delete_button.setAttribute('class', 'btn btn-danger delete-date-time');
        delete_button.appendChild(textNode);

        delete_button.addEventListener('click', function(ev) {
            ev.preventDefault();
            if (confirm('Are you sure youwant to delete it?')) {
                document.getElementById(ev.currentTarget.del_id).remove();
            }
        }, false);
        delete_button.del_id = del_count + '_delete';
        console.log(delete_button)
        divCopy.childNodes[7].replaceChild(delete_button, divCopy.childNodes[7].childNodes[1])
        document.getElementById("date-time-section1").appendChild(divCopy);
        del_count++;
        reinitializeDateTimePicker();
        return false;
    });

    function reinitializeDateTimePicker() {
        let pickerOptsGeneral = {
            uiLibrary: 'bootstrap4',
            date: getDateInFormat(today),
            autoclose: true,
            minView: 2,
            maxView: 2,
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="fa fa-chevron-left"></i>',
                rightArrow: '<i class="fa fa-chevron-right"></i>',
            },
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
                today: "fa fa-clock-o",
                clear: "fa fa-trash-o"
            },
        };

        $('.conferene_start_time_mk').mdtimepicker({
            timeFormat: 'hh:mm', // format of the time value (data-time attribute)
            format: 'hh:mm', // format of the input value
            readOnly: false, // determines if input is readonly
            hourPadding: false,
            theme: 'green',
            okLabel: 'Ok',
            cancelLabel: 'Cancel',
        });

        $('.conferene_end_time_mk').mdtimepicker({
            timeFormat: 'hh:mm', // format of the time value (data-time attribute)
            format: 'hh:mm', // format of the input value
            readOnly: false, // determines if input is readonly
            hourPadding: false,
            theme: 'green',
            okLabel: 'Ok',
            cancelLabel: 'Cancel',
        });

        $('.conference_day').datepicker(Object.assign({}, {}, pickerOptsGeneral));
        $('.conferene_start_time').datetimepicker({
            format: "HH:mm "
        });
        $('.conferene_end_time').datetimepicker({
            format: "HH:mm "
        });
    }



    // personal popup load
    $(".medicalHistoryPopupClick").click(function(e) {
        e.preventDefault();
        let id = $(this).data("id");

        $action = SITE_URL + "/load-history-popup/" + id;
        $.get($action, "", function(response) {
            $("#showMedicalHistoryPopup").html(response.data);
            $("#updatemodal2").modal("show");
        });
        return false;
    });

    // show pharmacy
    $(".search-pharmacy-btn").click(function(e) {
        e.preventDefault();
        $(this).attr("disabled", "disabled");
        $(".btn-loading").show();
        $action = SITE_URL + "/search-pharmacy/";
        $.post($action, $('#search-pharmacy').serialize(), function(response) {
            $("#showPharmacies").html(response.data);
            $(".search-pharmacy-btn").removeAttr("disabled");
            $(".btn-loading").hide();
        });

        return false;
    });

    $(".beforeRedirect").on("click", function() {
        return confirm("Are you sure?");
    });

    $(document).on(
        "click",
        ".medication-users-cnt li a.nav-link",
        function(e) {
            let userid = $(this).attr("userid");
            $("#teleUserId").val(userid);
        }
    );

    $(document).on(
        "click",
        ".consultation-show-custom-state-btn",
        function(e) {
            $(".consultation-state-cnt").hide();
            $(".consultation-custom-state-cnt").show();
        }
    );
    // For Schedule Consultation Tabs
    $(document).on("change", "input[type=radio][name=consultation-user]", function(e) {
        let userid = $(this).val();
        let modality = $("#modality").val();
        $.ajax({
            method: "POST",
            url: SITE_URL + "/create-consultation",
            dataType: "json",
            data: {
                "_token": $('#csrf-token')[0].content,
                "userid": userid,
                "modality": modality,
            },
            success: function(data) {
                if (data.original.status) {
                    let consult_id = data.original.consultation_id;
                    location.href = SITE_URL + "/schedule-consultation/" + modality + "/step-2/" + consult_id;
                }
            },
        });
        /*  $("#discover").hide();
         $("#discove-tab").removeClass("active");
         $("#ehr").show();
         $("#ehr-tab").addClass("active"); */
    });

    // Checkbox in EHR
    var checkBoxes = $('input.compulsory-policy'),
        submitButton = $('#submit-policy');
    checkBoxes.change(function() {
        submitButton.attr("disabled", checkBoxes.is(":not(:checked)"));
        if (checkBoxes.is(":not(:checked)")) {
            submitButton.addClass('disabled');
        } else {
            submitButton.removeClass('disabled');
        }
    });

    $(document).on("change", ".select-schedule-time", function(e) {
        let val = $(this).val();
        let toTime = addTimeToString(val, 2);
        $(".scheduled-from-time").text(val);
        $(".scheduled-to-time").text(toTime);
    });

    $(document).on("click", "a.delete_resource", function(e) {
        e.preventDefault();
        formId = $(e.currentTarget).data("resource");
        $.confirm({
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function() {
                        document.getElementById(formId).submit()
                    }
                },
                cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function() {}
                },
            },
            icon: 'fa fa-exclamation-triangle',
            title: 'Are you sure?',
            content: 'Are you sure you want to delete this record?',
            type: 'red',
            typeAnimated: true,
            boxWidth: '30%',
            useBootstrap: false,
            theme: 'modern',
            animation: 'scale',
            backgroundDismissAnimation: 'shake',
            draggable: false
        });
    });

    // Cancel Consultation //
    $(document).on("click", "a.cancel_resource", function(e) {
        e.preventDefault();
        formId = $(e.currentTarget).data("resource");
        $.confirm({
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function() {
                        document.getElementById(formId).submit()
                    }
                },
                cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function() {}
                },
            },
            icon: 'fa fa-exclamation-triangle',
            title: 'Are you sure?',
            content: 'Are you sure you want to cancel this consultation?',
            type: 'red',
            typeAnimated: true,
            boxWidth: '30%',
            useBootstrap: false,
            theme: 'modern',
            animation: 'scale',
            backgroundDismissAnimation: 'shake',
            draggable: false
        });
    });

    // Block User //
    $(document).on("click", "a.block_resource", function(e) {
        var titleConf = $(this).attr('data-confirm-title');
        e.preventDefault();
        formId = $(e.currentTarget).data("resource");
        $.confirm({
            buttons: {
                tryAgain: {
                    text: 'Block',
                    btnClass: 'btn-red',
                    action: function() {
                        document.getElementById(formId).submit()
                    }
                },
                cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function() {}
                },
            },
            icon: 'fa fa-exclamation-triangle',
            title: 'Are you sure?',
            content: `Are you sure you want to block this ${titleConf}?`,
            type: 'red',
            typeAnimated: true,
            boxWidth: '30%',
            useBootstrap: false,
            theme: 'modern',
            animation: 'scale',
            backgroundDismissAnimation: 'shake',
            draggable: false
        });
    });

    // UnBlock User //
    $(document).on("click", "a.unblock_resource", function(e) {
        var titleConf = $(this).attr('data-confirm-title');
        e.preventDefault();
        formId = $(e.currentTarget).data("resource");
        $.confirm({
            buttons: {
                tryAgain: {
                    text: 'Unblock',
                    btnClass: 'btn-green',
                    action: function() {
                        document.getElementById(formId).submit()
                    }
                },
                cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function() {}
                },
            },
            icon: 'fa fa-exclamation-triangle',
            title: 'Are you sure?',
            content: `Are you sure you want to unblock this ${titleConf}?`,
            type: 'green',
            typeAnimated: true,
            boxWidth: '30%',
            useBootstrap: false,
            theme: 'modern',
            animation: 'scale',
            backgroundDismissAnimation: 'shake',
            draggable: false
        });
    });

    // influencer_pay //
    $(document).on("click", "a.influencer_pay", function(e) {
        e.preventDefault();
        formId = $(e.currentTarget).data("resource");
        var amount = $(this).data("amount");
        $.confirm({
            buttons: {
                tryAgain: {
                    text: 'Paid',
                    amount: '0',
                    btnClass: 'btn-green',
                    action: function() {
                        document.getElementById(formId).submit()
                    }
                },
                cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function() {}
                },
            },
            icon: 'fa fa-exclamation-triangle',
            title: 'Are you sure?',
            content: 'Are you sure you have been paid $' + amount + ' to this user?',
            type: 'green',
            typeAnimated: true,
            boxWidth: '30%',
            useBootstrap: false,
            theme: 'modern',
            animation: 'scale',
            backgroundDismissAnimation: 'shake',
            draggable: false
        });
    });

    // Update User Pharmacy Details
    $(document).on("click", "#update-user-pharmacy", function(e) {
        let pharmacyName = $(this).parents("tr").find("#pharmacy-name").text();
        let pharmacyAddress = $(this).parents("tr").find("#pharmacy-address").text();
        let pharmacyCity = $("#pharmacy-city").text();
        let pharmacyZipCode = $(this).parents("tr").find("#pharmacy-zipcode").text();
        let pharmacystateId = $(this).parents("tr").find("#pharmacy-state").attr("stateid");
        let pharmacyphone = $(this).parents("tr").find("#pharmacy-phone").attr("phone");
        let selectedPharmacyId = $(this).parents("tr").find("#pharmacy-id").val();
        let latitude = $(this).parents("tr").find("#latitude").val();
        let longitude = $(this).parents("tr").find("#longitude").val();
        console.log('32');
        $.ajax({
            method: "POST",
            url: SITE_URL + "/update-pharmacy",
            dataType: "json",
            data: {
                "_token": $('#csrf-token')[0].content,
                "name": pharmacyName,
                "address": pharmacyAddress,
                "city": pharmacyCity,
                "zipCode": pharmacyZipCode,
                "stateid": pharmacystateId,
                "phone": pharmacyphone,
                "sureScriptPharmacy_id": selectedPharmacyId,
                "latitude":latitude,
                "longitude":longitude
            },
            success: function(res) {
                if (res.success) {
                    toastr.success(res.success);
                    window.location.reload();
                } else {
                    toastr.error(res.error);
                }
            },
        });
    });
    
    // AWMI Promocode Start
    
      $(document).on("click", ".awmi-promo-code-apply-btn", function(e) {
          e.preventDefault();
        
        let promoCode = $("#awmiinputPromoCode").val();
        // alert(promoCode);
        $(".promo-error").hide();
        $("input[name='promo_code_id']").val("");
        if (promoCode !== "") {
            $.ajax({
                method: "POST",
                url: SITE_URL + "/apply-promo-code",
                dataType: "json",
                data: {
                    "_token": document.getElementById('awmi_token').value,
                    "promoCode": promoCode,
                },
                success: function(data) {
                    if (data.original.status) {
                        var promo_data = data.original.data;
                        $(".promo-code-apply-btn").text("Applied");
                        $(".promo-code-apply-btn").attr("disabled", true);
                        $(".promo-code-applied-text").show();

                        $(".price-coll").find(".price-info").each(function(i, el) {
                            var stripe_amount = parseFloat($(this).data("awmiprice"));
                             var id = $(this).data("key");
                            var discount_amount = promo_data.member_discount_type == "fixed" ? promo_data.member_discount_amount : (stripe_amount * promo_data.member_discount_amount / 100).toFixed(2);
                            var after_discount_amount = (stripe_amount - discount_amount).toFixed(2);
                            // $(this).text(`$${after_discount_amount}`);
                            // $('#price'+id).text(`$${after_discount_amount}`);
                            document.getElementById('price'+id).innerHTML = `$${after_discount_amount}`;
                            
                        });

                        $("input[name='promo_code_id']").val(promo_data.id);


                    } else {
                        $(".promo-error").text("Your code is not valid");
                        $(".promo-error").show();
                        $(".promo-code-apply-btn").attr("disabled", false);
                    }
                },
            });
        } else {
            $(".promo-error").show();
        }
    });
    // END

    // Promo code //
    $(document).on("click", ".promo-code-apply-btn", function(e) {
        
        //let promoCode = $("#promo-code-apply-form").find("input[name='code']").val();
        let promoCode = $("#inputPromoCode").val();
        // alert( promoCode ); //
        $(".promo-error").hide();
        $("input[name='promo_code_id']").val("");
        if (promoCode !== "") {
            $.ajax({
                method: "POST",
                url: SITE_URL + "/apply-promo-code",
                dataType: "json",
                data: {
                    "_token": $('#csrf-token')[0].content,
                    "promoCode": promoCode,
                },
                success: function(data) {
                    if (data.original.status) {
                        promo_data = data.original.data;
						
                        $(".promo-code-apply-btn").text("Applied");
                        $(".promo-code-apply-btn").attr("disabled", true);
                        $(".promo-code-applied-text").show();
						
						let coupon_mode = promo_data.coupon_mode;
						console.log(" ---- --- "+coupon_mode);
						if(coupon_mode=="holiday") {
							console.log(" ---- --- matched");
							$(".user-package-list").hide();
							$(".user-holidy-list").show();
							$(".four-month-tab").trigger("click");
						} else {
							$(".allUserPlan").find(".stripe-amount").each(function(i, el) {
								var stripe_amount = parseFloat($(this).data("amount"));
								var discount_amount = promo_data.member_discount_type == "fixed" ? promo_data.member_discount_amount : (stripe_amount * promo_data.member_discount_amount / 100).toFixed(2);
								console.log("Discount Amount " + discount_amount);
								var after_discount_amount = (stripe_amount - discount_amount).toFixed(2);
								$(this).text(`$${after_discount_amount}`);
								$("#package_discount_amount").val(discount_amount);
								GetPackageFinalAmount();
							});

							$("input[name='promo_code_id']").val(promo_data.id);

							$('button.but_text.selectPlan').click(function(){
							});
						}
	
                    } else {
                        $(".promo-error").text("Your code is not valid");
                        $(".promo-error").show();
                        $(".promo-code-apply-btn").attr("disabled", false);
                    }
                },
            });
        } else {
            $(".promo-error").show();
        }
    });
    // Update Page code //
    $(document).on("click", "#update-page", function(e) {
        e.preventDefault();
        console.log('Get Form Fields');
        let updateDataArr = [];
        let page_id;
        var formData = new FormData();
        $('.editor1').each(function() {
            page_id = this.getAttribute('data-pageid');
            div_id = this.getAttribute('data-editor-index');
            let rawStr = CKEDITOR.instances['summary-ckeditor' + div_id].getData();
            var encodedStr = String(rawStr).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
            let tempObj = {
                section_id: this.getAttribute('data-pageid'),
                column: 'section_content',
                section_data: encodedStr
            }
            updateDataArr.push(tempObj);
        });
        //
        var image_array = [];
        var image_id_arr = [];

        $('.borrowerImageFile').each(function() {
            if ($(this)[0].files[0]) { // chek is checked variable for changes
                let tempObj = {
                    section_id: this.getAttribute('data-page-id'),
                    section_data: $(this)[0].files[0]
                }
                image_array.push(tempObj);
                image_id_arr.push(this.getAttribute('data-page-id'));
                formData.append('files[]', $(this)[0].files[0]);
            }
        });
        formData.append('files_id', JSON.stringify(image_id_arr));


        $('.get-description').each(function() {
            let tempObj = {
                section_id: this.getAttribute('data-page-id'),
                column: 'section_content',
                section_data: $(this).val()
            }
            updateDataArr.push(tempObj);
        });

        $('.get-title').each(function() {
            let tempObj = {
                section_id: this.getAttribute('data-page-id'),
                column: 'title',
                section_data: $(this).val()
            }
            updateDataArr.push(tempObj);
        });
        formData.append("_token", $('#csrf-token')[0].content);
        formData.append("page_id", page_id);
        formData.append("rows_to_delete", JSON.stringify(rows_to_delete));
        formData.append("text-data", JSON.stringify(updateDataArr));
        $.ajax({
            method: "POST",
            url: SITE_URL + "/admin/manage-page/update-page",
            cache: false,
            headers: { 'X-CSRF-TOKEN': $('#csrf-token')[0].content },
            contentType: "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2),

            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                toastr.success('Data successfully Updated');
                window.location.reload();

            },
        });
    });

    $(document).on("click", ".new_entry", function(e) {
        e.preventDefault();
        let section_id = $(this).data("section-id");
        let section_ele = document.getElementById("section-" + section_id);
        console.log(section_id, 'ELEMENt');
        let tempDiv = section_ele.childNodes[1].cloneNode(true);
        let dte = new Date();
        let time = dte.getTime();

        tempDiv.setAttribute('data-main-id', "div-" + time);
        tempDiv.setAttribute('id', "div-" + time);

        tempDiv.childNodes[1].childNodes[1].childNodes[1].childNodes[1].childNodes[1].setAttribute("data-page-id", time);
        tempDiv.childNodes[1].childNodes[1].childNodes[1].childNodes[1].childNodes[1].setAttribute("id", "title-" + time);
        tempDiv.childNodes[1].childNodes[1].childNodes[1].childNodes[1].childNodes[1].setAttribute("data-element-type", "new");

        tempDiv.childNodes[1].childNodes[1].childNodes[1].childNodes[3].childNodes[1].setAttribute("data-row-id", time);

        tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[1].setAttribute("data-page-id", time);
        tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[1].setAttribute("id", "description-" + time);
        tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[1].setAttribute("data-element-type", "new");


        if (tempDiv.getAttribute("data-page-type") == 'galleryt2') {
            tempDiv.childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].setAttribute("data-page-id", time);
            tempDiv.childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].setAttribute("id", "filePhoto" + time);
            tempDiv.childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[1].setAttribute("data-element-type", 'new');
            tempDiv.childNodes[1].childNodes[1].childNodes[5].childNodes[1].childNodes[3].setAttribute("for", "filePhoto" + time);
            tempDiv.childNodes[1].childNodes[1].childNodes[5].childNodes[3].childNodes[1].setAttribute("id", "previewHolder" + time);

        } else {
            tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[1].setAttribute("data-page-id", time);
            tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[1].setAttribute("id", "filePhoto" + time);
            tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[1].setAttribute("data-element-type", 'new');
            tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[1].childNodes[3].setAttribute("for", "filePhoto" + time);
            tempDiv.childNodes[1].childNodes[1].childNodes[3].childNodes[3].childNodes[1].setAttribute("id", "previewHolder" + time);

        }






        //         let section_ele = document.getElementById("section-23");
        // let tempDiv = section_ele.childNodes[1].cloneNode(true);
        // let type = tempDiv.getAttribute("data-page-type")
        // console.log(tempDiv.childNodes[1].childNodes[1].childNodes[1]);

        // tempDiv.childNodes[1].childNodes[1]

        console.log(tempDiv.getAttribute("data-page-type"), '------');

        // console.log(tempDiv.childNodes);

        // tempDiv.childNodes[5].setAttribute("data-row-id", time);
        // tempDiv.childNodes[3].setAttribute("id", 'title'+time);
        // tempDiv.childNodes[7].setAttribute("data-element-type", 'new');
        // tempDiv.childNodes[7].setAttribute("data-page-id",time );
        // tempDiv.childNodes[11].setAttribute("id", 'previewHolder'+time);
        section_ele.appendChild(tempDiv);
    });
    $(document).on("click", ".delete_entry", function(e) {
        e.preventDefault();
        let vm = this;
        $.confirm({
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function() {
                        let delete_id = $(vm).data("row-id");
                        rows_to_delete.push(delete_id);
                        $("#div-" + $(vm).data("row-id")).hide();

                    }
                },
                cancel: {
                    text: 'Cancel',
                    btnClass: 'btn-default',
                    action: function() {
                        alert('No');
                    }
                },
            },
            icon: 'fa fa-exclamation-triangle',
            title: 'Are you sure?',
            content: 'Are you sure you want to delete this?',
            type: 'red',
            typeAnimated: true,
            boxWidth: '30%',
            useBootstrap: false,
            theme: 'modern',
            animation: 'scale',
            backgroundDismissAnimation: 'shake',
            draggable: false
        });
        // let delete_id = $(this).data("row-id");
        // rows_to_delete.push(delete_id);
        // console.log(rows_to_delete);
        // $("#div-"+$(this).data("row-id")).hide();
    });

    $(document).on("click", ".borrowerImageFile", function(e) {
        // e.preventDefault();
    });
    $(document).on("change", ".borrowerImageFile", function(e) {
        e.preventDefault();
        $(this).attr('data-is-changed', "yes");
        let element_id = $(this).data('page-id');
        console.log(this, 'full element');
        console.log(element_id, 'My Element');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewHolder' + element_id).attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            alert('select a file to see preview');
            $('#previewHolder' + element_id).attr('src', '');
        }
    });

    // Check if Promo code field empty //
    $('.promo-text').on('keyup blur', function(event) {
        if ($(this).val().length == 0) {
            $('.promo-code-apply-btn').prop('disabled', false);
            $(".promo-code-apply-btn").text("Apply");
            $(".promo-code-applied-text").hide();
            $("input[name='promo_code_id']").val("");
            $("table").find("td .stripe-amount").each(function(i, el) {
                var stripe_amount = parseFloat($(this).data("amount"));
                $(this).text(stripe_amount);
            });
        }
    });

    // Influender type change //
    $(document).on("change", "#select-inc-type", function(e) {
        let val = $(this).val();
        if (val == 2) {
            $(".individual-inc-cnt").hide();
            $(".organization-inc-cnt").show();
        } else {
            $(".individual-inc-cnt").show();
            $(".organization-inc-cnt").hide();
        }
    });


    $(document).on("change", "#select-promo-type", function(e) {
        e.preventDefault();
        let val = $(this).val();
        if (val == 2) {
            $(".commission-from-date-cal-box").show();
            $(".commission-to-date-cal-box").show();
        } else {
            $(".commission-from-date-cal-box").hide();
            $(".commission-to-date-cal-box").hide();
        }
        $action = SITE_URL + "/admin/influencers/type/" + val;
        $.get($action, "", function(res) {
            var response = JSON.parse(res);
            if (response.original.status) {
                var html = '';
                var data = response.original.data;
                html += '<option value="">Please select affiliate</option>';
                for (let single of data) {
                    if (val == 2) {
                        html += '<option value="' + single.id + '">' + single.organization.name + ' (' + single.name + ')</option>';
                    } else {
                        html += '<option value="' + single.id + '">' + single.name + '</option>';
                    }
                }
                $("#select-influencer").html(html);
            } else {
                html = '<option value="">Influencers not found</option>';
                $("#select-influencer").html(html);
            }
        });
        return false;
    });

    function addTimeToString(timeString, addHours, addMinutes) {
    // The third argument is optional.
    if (addMinutes === undefined) {
        addMinutes = 0;
    }
    // Parse the time string. Extract hours, minutes, and am/pm.
    var match = /(\d+):(\d+)\s+(\w+)/.exec(timeString),
        hours = parseInt(match[1], 10) % 12,
        minutes = parseInt(match[2], 10),
        modifier = match[3].toLowerCase();
    // Convert the given time into minutes. Add the desired amount.
    if (modifier[0] == 'p') {
        hours += 12;
    }
    var newMinutes = (hours + addHours) * 60 + minutes + addMinutes,
    newHours = Math.floor(newMinutes / 60) % 24;
    // Now figure out the components of the new date string.
    newMinutes %= 60;
    var newModifier = (newHours < 12 ? 'AM' : 'PM'),
    hours12 = (newHours < 12 ? newHours : newHours % 12);
    if (hours12 == 0) {
        hours12 = 12;
    }
    // Glue it all together.
    var minuteString = (newMinutes >= 10 ? '' : '0') + newMinutes;
    return hours12 + ':' + minuteString + newModifier;
}


//  move to step
function gotoStep(stepTo, stepFrom) {
    $("#" + stepFrom).hide();
    $("#" + stepTo).show();
}

// disable fields on invoice form
// set values for invoice form
function invoiceForm(data = []) {
    /*  $("#fname_inv").val(data["fname"]).attr("readonly", "readonly");
     $("#lname_inv").val(data["lname"]).attr("readonly", "readonly");
     $("#phone_inv").val(data["phone"]); */
    $("#email_inv").val(data["email"]).attr("readonly", "readonly");
}

function setPaymentFields(res) {
    $("#card-button").attr("data-secret", res.client_secret);
    $("#getPlan").val(res.stripe_planid);
    $("#getPlanName").val(res.stripe_plan_name);
    $("#getPrice").val(res.stripe_plan_price);
    $("#card-holder-name").val(res.fname + " " + res.lname);
    $("#step4-email").val(res.email);
}

// stripe integration

var style = {
    base: {
        color: "#fff",
        fontWeight: 600,
        fontFamily: "Quicksand, Open Sans, Segoe UI, sans-serif",
        fontSize: "16px",
        fontSmoothing: "antialiased",

        ":focus": {
            color: "#424770",
        },

        "::placeholder": {
            color: "#9BACC8",
        },

        ":focus::placeholder": {
            color: "#CFD7DF",
        },
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a",
    },
};
//  Stripe card elements fetch code
/* const stripe = Stripe(STRIPE_KEY);
const elements = stripe.elements();
const cardElement = elements.create("card", { style: style });
cardElement.mount("#card-element"); */
//  End of stripe elemnt fetch code
/* const cardButton = document.getElementById("card-button");

cardButton.addEventListener("click", async(e) => {
    if ($("#payment-form").valid()) {
        e.preventDefault();
        const cardHolderName = document.getElementById("card-holder-name");
        const clientSecret = cardButton.dataset.secret;
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value },
                },
            }
            );

            if (error) {
                // Display "error.message" to the user...
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = error.message;
                errorElement.classList.add("error-cus-mgs-txt");
            } else {
                // The card has been verified successfully...
                paymentMethodHandler(setupIntent.payment_method);
            }
        }
    }); */

    /* function paymentMethodHandler(payment_method) {
        $("#loading").show();
        var form = document.getElementById("payment-form");
        var hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", "payment_method");
        hiddenInput.setAttribute("value", payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    } */

    $(document).ready(function() {
        /* var dialogShown = $.cookie('dialogShown');

        // On newer versions of js-cookie, API use:
        // var dialogShown = Cookies.get('dialogShown');

        if (!dialogShown) {
            $(window).load(function() {
                $(".covid-spread-modal-box").dialog();
                $.cookie('dialogShown', 1);
                // On newer versions of js-cookie, API use:
                // Cookies.set('dialogShown', 1);

            });
        } else {
            $(".covid-spread-modal-box").hide();
        } */
    });

    $(document).ready(function() {
        $('.cust-file-upload :file').on('fileselect', function(event, numFiles, label) {
            console.log("teste");
            var input_label = $(this).closest('.input-group').find('.file-input-label'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input_label.length) {
            input_label.text(log);
        } else {
            if (log) alert(log);
        }
    });

    $("#imageUpload").change(function(data) {

        var imageFile = data.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);

        reader.onload = function(evt) {
            $('#imagePreview').attr('src', evt.target.result);
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }

    });

    $(document).on('change', '#user-affiliate', function() {
        if ($(this).val() == 'influencer') {
            $('#orgType').css({ 'display': 'block' });
        } else {
            $('#orgType').css({ 'display': 'none' });
        }
    })



    $('.healthy_food_content p').each(function() {
        var $this = $(this);
        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
    });

    $(document).on('click', '.add_more_rss', function() {
        var rssClone = $('#rssClone').clone();
        rssClone.find('input').val('');
        rssClone.find('#rss-feeds-add').remove();
        rssClone.find('#rss-feeds-delete').show();
        $('#rss-feed-section').prepend(rssClone);
    })

    $(document).on('click', '.delete_rss', function() {
        $(this).closest('#rssClone').remove();
    })
    $(document).on('click', '#submit-form-rss', function() {
        $('#rss-feed-forms').submit();
    })

    $(document).on('change', '.planTypeSelection', function() {
        $('input[name=plan_type]').val($('.planTypeSelection option:selected').attr('planid'));
    })

    $(document).on('click', '.monthPlan', function() {
        var monthKey = $(this).attr('mpName');
        var tabPlanId = $(`#tabs-${monthKey} ul`).first('li').find('a').attr('href');
        $(`#tabs-${monthKey} ul`).find('a').removeClass('active');
        $(`#tabs-${monthKey} ul li:first`).find('a').addClass('active');

        $('.allUserPlan').hide();
        $(`${tabPlanId}`).show();
    })

    $(document).on('click', '.userPlanType', function() {
        var getId = $(this).children('a').attr('href');
        $('.allUserPlan').hide();
        $(`${getId}`).show();
    })

    $(document).on('click','#checkPetSchedule',function(){
        var id = $(this).attr("petId");
        $.ajax({
            url: `${SITE_URL}/pets/pet-name/${id}`,
            method: "GET",
            data: { id: id },
            error: (error) => console.log(error),
            success: (result) => {
                var data = JSON.parse(result);
                $("input[name=myPetId]").val(id);
                $("#myPetName").html('');
                $("#myPetName").html(data.name);
            },
        });
    })

    $(document).on('click', '.informed-pet', function() {
        $('.closeSchedulepopup').trigger('click');
        $(this).prop('checked', false);
    })

    $(document).on('click', '.pet-problem', function() {
        $(".pet-problem").parent(".cb").removeClass("petProblemSelected");
        $(this).parent(".cb").addClass("petProblemSelected");
        $('#nextAndComplete .next').show();
        getStepForm(1)
    });
    
    // for pet problem checkbox select/unselect
    $(document).on('click', '.petPoblem', function() {
        // $(".pet-problem").parent(".cb").removeClass("petProblemSelected");
        // $(this).parent(".cb").addClass("petProblemSelected");
        
        if ($(this).is(':checked')) {
            $(this).closest('.cb').addClass('petProblemSelected');
        } else {
            $(this).closest('.cb').removeClass('petProblemSelected');
        }
        
        $('#nextAndComplete .next').show();
        getStepForm(1)
    });

    $(document).on('click', '#nextAndComplete .next', function() {
        $('#backAndCancel').children('.back').attr('pre-step', $(this).attr('next-step'));

        $('#backAndCancel .back').show();
        if ($(this).attr('next-step') == 2) {
            var number = $('.ownerPhoneNumber').val();
            if (number == '') {
                $('.errorMsg').html('Please enter a valid phone number.');
                return false;
            }
            $('.errorMsg').html('');

            $('#backAndCancel .back').show();
            $('#nextAndComplete .next').hide();
        }
        getStepForm(parseInt($(this).attr('next-step')) + 1);
    })

    $(document).on('click', '#backAndCancel .back', function() {

        var preStep = $(this).attr('pre-step');
        $(this).hide();
        if (preStep >= 1) {
            getStepForm(parseInt(preStep));

        }
    })

    $(document).on("click",'#backAndCancel .cancel,#nextAndComplete .closeModal',function () {
        location.reload();
    });




    function getStepForm(step = "") {

        $('#backAndCancel .back').hide();
        $('#nextAndComplete .complete').hide();

        $('.petAllSteps').addClass('d-none');
        $('.petAllSteps').removeClass('active');
        $('.mysteps').removeClass('active');
        $('.mysteps').each(function() {
            if ($(this).attr('data-step') <= step) {
                $(this).addClass('active');
            }
            if ($(this).attr('href') == `#step${step}`) {
                $('.mysteps').removeClass('activeStep');
                $(this).addClass('activeStep');
            }
        })
        if (step > 1) {
            $('#backAndCancel .back').attr('pre-step', (parseInt(step) - 1));
            $('#backAndCancel .back').show();
        }
        if (step == 4 ){
            $("#nextAndComplete .closeModal").show();
            $("#nextAndComplete .complete").hide();
            $("#nextAndComplete .next").hide();
            $("#backAndCancel .back").hide();
            $("#backAndCancel .cancel").hide();
        }else{
            if (step == 3) {
                $("#nextAndComplete .complete").show();
            } else {
                $("#nextAndComplete .next").show();
            }
        }
        $(`#step${step}`).removeClass('d-none');
        $('.petAllSteps').removeClass('active');
        $(`#step${step}`).addClass('active');
        $('#nextAndComplete .next').attr('next-step', step);
    }



    Dropzone.autoDiscover = false;
    /* var myDropzone = new Dropzone(".dropzone", {
        autoProcessQueue: false,
        maxFilesize: 10,
        uploadMultiple: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            var myDropzone = this;
            
            // Update selector to match your button
            $(".complete").click(function (e) {
                e.preventDefault();
                
                if (myDropzone.getQueuedFiles().length === 0) {
                    alert('Please select at least one image to upload.');
                    return false;
                }
                
                if (confirm('Are you sure you want to schedule the call?')) {
                    myDropzone.processQueue();
                } else {
                    return false;
                }
                
            });

            this.on("sending", function (file, xhr, formData) {
                var myPetId = $('input[name="myPetId"]').val();
                var petProblem = $('input[name="petProblem[]"]:checked').map(function() {
                                    return this.value;
                                }).get();
                var petDescription = $("#pet-description").text();
                var phone = $('input[name="phone"]').val();
                var modality = $('input[name="modality"]:checked').val();
                var optIn = $('input[name="optIn"]').val();

                formData.append("my-pet-id", myPetId);
                formData.append("problemId", petProblem);
                formData.append("description", petDescription);
                formData.append("phone", phone);
                formData.append("modality", modality);
                formData.append("optIn", optIn);
            });
        },
        success: function (file, response) {
            if (response) {
                getStepForm(
                    parseInt($("#nextAndComplete .next").attr("next-step")) + 1
                    );
                }
            },
        }); */

        $(document).on('click','.allDetails',function(){
            var id = $(this).attr('petId');
            $.ajax({
                url: `${SITE_URL}/pets/edit/${id}`,
                method:'GET',
                data:{id:id},
                error:(error) => console.log( error ),
                success:(result) => {
                    $("#Edit-my-Pet").html(result);
                    $("#Edit-my-Pet").modal("show");
                }
            })
        })

        $(document).on("click", "#imageModel", function () {
            $("input[name=aipPetIdImage]").val('');
            var id = $(this).attr("petId");
            $.ajax({
                url: `${SITE_URL}/pets/pet-name/${id}`,
                method: "GET",
                data: { id: id },
            error: (error) => console.log(error),
            success: (result) => {
                var data = JSON.parse(result);
                $("input[name=petIdImage]").val(id);
                if( data.profile != null ){
                    $("#petProfileLink").attr("src",`${SITE_URL}/${data.profile}`);
                    $("#petImageDetail").modal("show");
                }
            },
        });
    });

    $(document).on("click",".cancelPetConsult",function(){
        var petId = $(this).attr('pet_id');
        var petConsult = $(this).attr("petConsult");

        $("input[name=pet_id]").val(petId);
        $("input[name=petConsultId]").val(petConsult);
        $("#cancelPetConsult").modal('show');
    });


});

function readUrl(file) {
    var input = file.target;
    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById("petProfileLink");
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}


/*  services dropzone  */


    $(document).on("click", '.toggle-ico',function(){
        var id = $(this).attr("data-uniqueId");
      $(`.show-${id}`).toggle("slow");
    });

    $(document).on("click", ".add-more-slider", function () {
        var countDiv = $(".avatar-upload").length;

        var imageUrl = `${SITE_URL}/images/dummy.jpg`;
        var sliderHtml = $(this).closest(".sliderContainer").find(".sliderImages").eq(0).clone();
        sliderHtml.find("input[type=file]").attr("data-page-id", `section${countDiv}`);
        sliderHtml.find("input[type=file]").attr("data-editor-index", `section${countDiv}`);
        sliderHtml.find("input[type=file]").attr("id", `filePhotosection${countDiv}`);
        sliderHtml.find("input[type=file]").removeAttr("image-id");

        sliderHtml.find(".serviceimagesRemove").html('<i class="fas fa-times"></i>');

        sliderHtml.find("label").attr("for", `filePhotosection${countDiv}`);
        sliderHtml.find("img").attr("id", `previewHoldersection${countDiv}`);
        sliderHtml.find("img").attr("src", imageUrl);
        $(this).closest(".sliderContainer").find(".row").append(sliderHtml);
    });

    $(document).on("click", ".serviceimagesRemove",function(){
        var image_id = $(this).siblings(".avatar-edit").children("input").attr("image-id");
        var removeData = $(this).parent().parent();
        if (typeof image_id != 'undefined'){
            deleteServicesData(image_id, removeData);
        }else{
            removeData.remove();
        }
    });

    $(document).on("click", ".deletetestimonial", function () {
        var image_id = $(this).attr("image-id");
        var removeData = $(this).closest(".clonetestimonial");
        if (typeof image_id != "undefined") {
            deleteServicesData(image_id, removeData);
        } else {
            removeData.remove();
        }
    });

    ;


    function deleteServicesData(image_id,removeData) {
        $.confirm({
            buttons: {
                tryAgain: {
                    text: "Yes",
                    btnClass: "btn-red",
                    action: function () {
                        $.ajax({
                            url: `${SITE_URL}/admin/corporate/deleteImages`,
                            method: "POST",
                            data: {
                                _token: $("#csrf-token")[0].content,
                                id: image_id,
                            },
                            error: (error) => console.log(error),
                            success: (response) => {
                                if (response) {
                                    removeData.remove();
                                }
                            },
                        });
                    },
                },
                cancel: {
                    text: "Cancel",
                    btnClass: "btn-default",
                    action: function () {},
                },
            },
            icon: "fa fa-exclamation-triangle",
            title: "Are you sure?",
            content: "Are you sure you want to delete this record?",
            type: "red",
            typeAnimated: true,
            boxWidth: "30%",
            useBootstrap: false,
            theme: "modern",
            animation: "scale",
            backgroundDismissAnimation: "shake",
            draggable: false,
        });
    }

     $("#update-service-page").click(function (e) {
         e.preventDefault();
         $("#serviceform").submit();
     });

     $(document).on("click", ".add-more-testimonail", function () {
        var sliderHtml = $('.clonetestimonial').eq(0).clone();
        sliderHtml.find('input').val('');
        sliderHtml.find("textarea").val("");
        sliderHtml.find(".testimonialDelete").html('<button type="button" class="btn btn-danger deletetestimonial">Delete</button>');
        $('.testimonialRow').append(sliderHtml);
    });

    $(document).on("change", ".changeExistImage",function(){
        var imageId = $(this).attr('image-id');
        $(this).removeClass('required');
        $(this).removeClass('error');
        $(this).closest(".avatar-upload").siblings('.error').remove();
        if (imageId != ''){
            var htmlInput = `<input type="hidden" name="removeImages[]" value="${imageId}">`;
            $("#serviceform").append(htmlInput);
        }
    });

    /* $(document).on("change", ".servicesStatus input",function(){
        if($(this).is(':checked')){
            $(this).closest(".dashb-home-row").children(".col-md-6").show();
        }else{
            $(this).closest('.dashb-home-row').children(".col-md-6").hide();
        }
    }); */

});

    $(document).ready(function () {
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target);
            output = list.data("output");
            //console.log(list.nestable("serialize"));
            if (window.JSON) {
                var data = window.JSON.stringify(list.nestable("serialize")); //, null, 2));
                $.ajax({
                    url:`${SITE_URL}/admin/menu-create`,
                    method:'post',
                    data:{
                        '_token':$('#csrf-token')[0].content,
                        data:data
                    },
                })
                //console.log(data);

            } else {
                output.val("JSON browser support required for this demo.");
            }
        };

        $(document).on("click", ".editButton",function(e){
            e.stopPropagation();
            console.log( 'dksjfklsdfj' );
        });

        $("#nestable").nestable({
                group: 1,
            }).on("change", updateOutput);


        $(document).on('click','.editMenuItem',function(){
            var thisContant = $(this);
            var menuName = $(this).attr("data-menu_name");
            $.confirm({
                title: "",
                content:
                    menuName +
                    '<form class="formName">' +
                    '<div class="form-group">' +
                    "<label>Enter Menu Name</label>" +
                    `<input type="text" placeholder="Your name" class="name form-control" value="${menuName}" required />` +
                    "</div>" +
                    "</form>",
                buttons: {
                    formSubmit: {
                        text: "Save",
                        btnClass: "badge badge-danger-cus",
                        action: function () {
                            var name = this.$content.find(".name").val();
                            if (!name) {
                                $.alert("Provide a valid name");
                                return false;
                            }
                            $(thisContant)
                                .parent("li")
                                .attr("data-menu_name", name);
                            $(thisContant).attr("data-menu_name", name);
                            $(thisContant)
                                .siblings("div")
                                .children(".liMenuname")
                                .text(name);
                            updateOutput(
                                $("#nestable").data(
                                    "output",
                                    $("#nestable-output")
                                )
                            );
                        },
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find("form").on("submit", function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger("click"); // reference the button and click it
                    });
                },
            });
        })


        // activate Nestable for list 1


    });


// Vistor End

// goto payment page
$(document).on("click", ".move-next", function(e){
   
    e.preventDefault();
	let textRegex = /^[A-Za-z\s]+$/; // only letters and spaces
	let studentId = $("#student_id").val().trim();


    if(!$('input[name=visitor_permission]').is(':checked')){
        toastr.error("Please choose one option.");
        return false;
    }
    if(!$("#name_of_school").val()) {
        toastr.error("Name is required.");
        return false;
    }
    
	if (!studentId) {
		toastr.error("Signature is required.");
		return false;
	} else if (!textRegex.test(studentId)) {
		toastr.error("Only alphabets are allowed in Signature.");
		return false;
	}
	
    if(!$("#printed_name").val()) {
        toastr.error("Student is required.");
        return false;
    }
    if(!$("#created_dated").val()) {
        toastr.error("Created Date is required.");
        return false;
    }
	
	toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            });
			
	$.ajax({
            method: "POST",
            url: `${SITE_URL}/save-visitor`,
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                visitor_permission: $("input[name=visitor_permission]").val(),
                school_name: $("#name_of_school").val(),
                student_id: $("#student_id").val(),
                prined_date: $("#printed_name").val(),
                register_date: $("#created_dated").val(),
                test_type: $('input[name=test_type]').val(),
            },
            success: function(data) {
                toastr.clear();
                if (data.status == 1) {
                    let q_type = $("#q_type").val();
                    $("#quiz-" + q_type).show();
                    $("#" + "consent").hide();
                    $("#visitor_id").val(data.data.visitor_id);
                    $("#school_id").val(data.data.school_id);
                    toastr.success(data.msg);
                } else {
                    toastr.warning(data.msg);
                }
            },
        });		
    
});

$(document).on('submit','#invoice-form',function(e){
    e.preventDefault();
    var formId = $("#invoice-form");
    $.ajax({
        method: "POST",
        url: formId.attr("action"),
        data: $(this).serialize(),
        dataType: "json",
        success: function(data) {
            if (data.original.status) {
                let res = data.original.data;
                setPaymentFields(res);
                gotoStep("step4", "step3");
                lis.slice(0, 4).attr("class", "active");
            } else {
                //$("#res-msg").text(data.original.message);
                // alert(data.original.message);
                $("#res-msg").append(
                    '<div class="alert alert-danger" role="alert">' +
                    data.original.message +
                    "</div>"
                );
                $(".alert-danger").fadeOut(5000, function() {
                    $(this).remove();
                });
            }
        },
    });
})



// Visitor End

$(document).on("click", ".cust-modal .close",function(){
    $(".cust-modal").modal('hide');
});

$(document).on("click", ".all-emoji-img ul li",function(){
    $(".all-emoji-img ul li").removeClass('active');
    $(this).addClass('active');
    $(this).parent('ul').siblings('input[name=emoji-code]').val($(this).attr('emoji-key') );
});

$(document).on("click", ".submitEmoji",function(e){
    e.preventDefault();
    $(".error-emoji-select").css('display','none');
    $(".error-emoji-name").css("display", "none");
    var closestModel = $(this).closest(".cust-modal");
    var error = false;
    var emojiSelected = $(closestModel).find("input[name=emoji-code]").val();
    var emojiName = $(closestModel).find("input[name=chosenEmojiName]").val();
    if( emojiSelected == '' ){
        $(".error-emoji-select").css('display','block');
        error = true;
    }
    if (emojiName == "") {
        $(".error-emoji-name").css('display','block');
        error = true;
    }
    if( error ){
        return false;
    }

    var findModalId = $(closestModel).attr("id");
    if ($(".addCustomEmoji").hasClass(findModalId)) {
        $(`.addCustomEmoji.${findModalId}`).html($(closestModel).find('.active').html());
        $(`.addCustomEmoji.${findModalId}`).siblings('input[type=radio]').val(`${emojiSelected}__${emojiName}`);
        $(`.addCustomEmoji.${findModalId}`).siblings('input[type=radio]').prop("checked", true);
    }
    $(".cust-modal").modal("hide");
});
/* 
const saveMood = document.querySelector(".saveMood");
if (saveMood){
    saveMood.addEventListener("click", function(e) {
        e.preventDefault();
        var physically = document.querySelector(
            "input[name=physicallyParent]:checked"
        );
        var physicallyChild = document.querySelector(
            "input[name=physicallyChild]:checked"
        );
        var physicallySubChild = document.querySelector(
            "input[name=physicallySubChild]:checked"
        );
        if (!physically) {
            toastr.error("Please select your mood");
        } else if (!physicallyChild) {
            toastr.error("Please select second step of your mood");
        } else if (!physicallySubChild) {
            toastr.error("Please select third step of your mood");
        }else {
            this.closest("form").submit();
        }

    });
} */

$(document).on("click", ".mood-feels-img-wrap",function(){

    let getMoodKey = $(this).attr('key-name');
    let getTypeMood = $(this).attr('key-type');

    $(this).closest(".mood-feels-scroll").find('.mood-feels-img-wrap').removeClass('iconCheckedMood');
    $(`input[name=${getTypeMood}Child]`).siblings(".childMoodfaces").removeClass('checkedRadioMood');
    $(this).addClass("iconCheckedMood");

    $(`input[name=${getTypeMood}Parent]`).prop("checked", false);
    $(`input[name=${getTypeMood}Child]`).prop('checked',false);
    $(`input[name=${getTypeMood}SubChild]`).prop("checked", false);
    $(this).find(`input[name=${getTypeMood}Parent]`).prop('checked',true);

    $(`.moods-child-${getTypeMood}`).hide();
    $(`.moods-face-subChild-${getTypeMood}`).hide();
    $(`.mood-child-${getTypeMood}-${getMoodKey}`).show();
    let moodtext = getMoodKey.toLowerCase();

    $(".selectedMoodChild").html('');
    $(".selectedMoodSubChild").html('');
    $(".cust-moods-block").show();
    $(".selectedMoodParent").html(`<h3> I am ${moodtext} because I am </h3>`);

});

$(document).on("click", ".childMoodfaces", function() {

    $(this).closest(".moods-face-dynamic").find('.childMoodfaces').removeClass("checkedRadioMood");
    $(this).closest(".mood-feels-row-left").find('.subChildMood').removeClass('checkedRadioMood');

    $(this).addClass("checkedRadioMood");
    let getMoodKey = $(this).attr("keyname");
    let getTypeMood = $(this).attr("key-type");

    $(`input[name=${getTypeMood}Child]`).prop("checked", false);
    $(`input[name=${getTypeMood}SubChild]`).prop("checked", false);



    $(this).siblings(`input[name=${getTypeMood}Child]`).prop('checked',true);
    $(`.moods-face-subChild-${getTypeMood}`).hide();
    $(`.mood-subChild-${getTypeMood}-${getMoodKey}`).show();

    let moodtext = getMoodKey.toLowerCase();
    $(".selectedMoodSubChild").html("");
    $(".selectedMoodChild").html(`<h3> I am ${moodtext} because I am </h3>`);

});

$(document).on("click", ".subChildMood",function(){
    $(this).closest(".mood-feels-row-left").find('.subChildMood').removeClass('checkedRadioMood');
    $(this).addClass("checkedRadioMood");
    let getTypeMood = $(this).attr("key-type");
    $(`input[name=${getTypeMood}SubChild]`).prop("checked", false);
    $(this).siblings(`input[name=${getTypeMood}SubChild]`).prop('checked',true);
});


$(document).on('click','.deleteMood',function(){
    let ids = $(this).attr("moodnumber");
    $.ajax({
        url: `${SITE_URL}/feels/mood-delete`,
        method: "POST",
        data: { _token: $("#csrf-token")[0].content, id: ids },
        error: error => console.log(error),
        success: data => {
            location.reload();
        }
    });
});

$(document).on("click", ".returnUserMood",function(){
    window.location.href = `${SITE_URL}/feels/user-mood`;
});

$(".btn-default").on("click", function() {
    $(".default-menu").slideToggle();
    $(".dropdown-overlay").show();
});

$(".dropdown-overlay").on("click", function() {
    $(".default-menu").hide();
    $(this).hide();
});

$(".btn-danger").on("click", function() {
    $(".slide-menu").slideToggle();
    $(".dropdown-overlay").show();
});

$(".dropdown-overlay").on("click", function() {
    $(".slide-menu").hide();
    $(this).hide();
});

$(document).on("click", ".selectJournal",function(e){
    e.preventDefault();
    $(".journalTitle").children('input').val('');
    let titleValue = $('input[name=titleName]:checked').val();
    $(".journalTitle").children('input[name=title]').val(titleValue);
});

$(document).on("click", ".readMoreJournal", function() {
    $(this).closest("td").find('.journalDescription').toggle();
    if($(this).children('i').hasClass('fa-plus')){
        $(this).children('i').removeClass('fa-plus');
        $(this).children('i').addClass('fa-minus');
    }else{
        $(this).children('i').removeClass('fa-minus');
        $(this).children('i').addClass('fa-plus');
    }
});


$(document).on('click','.deletePermission',function(){
    let id = $(this).attr('data-id');
    $.confirm({
        title: "Confirm!",
        content: "Are You Sure! Role And permission will be deleted",
        buttons: {
            confirm: function() {
               $.ajax({
                   url: `${SITE_URL}/admin/roles/delete/`,
                   method: "post",
                   data: { _token: $("#csrf-token")[0].content, id: id },
                   error: error => console.log(error),
                   success: data => {
                       window.location.href = `${SITE_URL}/admin/permission`;
                   }
               });
            },
            cancel: function() {

            },
        }
    });

})

$(document).on('click','.deleteByAjax',function(){
    var id = $(this).attr('number');
    var urlName = $(this).attr('data-url');
    $.confirm({
        title: "Confirm!",
        content: "Are You Sure!",
        buttons: {
            confirm: function() {
				showLoaderPageLoad('show');
               $.ajax({
                   url: `${urlName}`,
                   method: "post",
                   data: { _token: $("#csrf-token")[0].content, id: id },
                   error: error => console.log(error),
                   success: data => {
                       location.reload();
                   }
               });
            },
            cancel: function() {

            },
        }
    });
})

$(document).on("click", ".returnBackuser",function(){
    window.location.href = $(this).attr('data-url');
});

$(document).on('change','.saftyPlanType',function(e){
    let type = $(".saftyPlanType option:selected").val();
    if( type == 'crisis' ){
        $(".plan-guide-des").hide();
        $(".crisis-number").removeClass("displayNone");
        $(".crisis-number").css("display", "block");
    }else{
        $(".plan-guide-des").show();
        $(".crisis-number").addClass("displayNone");
        $(".crisis-number").css("display",'none');
    }

})

$(document).on("click", ".roleName",function(){
    let selectRole = $(this).children(".dropdown-item").text();
    $(".roleDropDownSelect").text(selectRole);
});

$(document).on('click','.editRoleName',function(e){
    e.stopPropagation();
    let roleText = $(this).siblings(".dropdown-item").text();
    let roleId = $(this).siblings(".dropdown-item").attr('data-roleid');

    $(".roleNameUpdate").val(roleText);
    $(".roleIdUpdate").val(roleId);
    $("#addRoleModal").modal('show');
    return false;
})

$(document).on("click", ".roleIdDrop",function(){
    let id = $(this).attr("data-roleid");
    $("input[name=role_id]").val(id);
});

$(document).ready(function() {
    $(".selectToolOption").select2();
});

$(document).on('click','.specialist-box',function(){
    let spcName = $(this).attr('specialistId');
    $(`.popupSpecialist option`).removeAttr("selected", "selected");
    $(`.popupSpecialist option[value=${spcName}]`).attr("selected", "selected");
})

$(document).on('click','.getMessageHeaders',function(){
    let page = $(this).attr('pageId');
    let passUrl = $(this).attr('passUrl');
    let title = $(this).attr('title');
    $.ajax({
        url:`${SITE_URL}/${passUrl}`,
        method:'GET',
        data:{"_token": $('#csrf-token')[0].content,page:page,sortField:'date',sortOrder:'desc' },
        context:this,
        error:(error) => console.log( error ),
        beforeSend: function(){
           showLoaderPageLoad('show');
        },
        complete: function(){
            showLoaderPageLoad('hide');
        },
        success:(result) => {
            $('.getMessageHeadersData').html(result);
            $(this).text(title);
            $('.getMessageHeaders').removeClass('activeButtonProperty');
            $(this).addClass('activeButtonProperty');
        }
    })
})

$(document).on('click','.singleMessage',function(){
    let msgId = $(this).attr('messageId');
    $.ajax({
        url:`${SITE_URL}/getSingleMessage`,
        method:'GET',
        data:{"_token": $('#csrf-token')[0].content,messageId:msgId},
        error:( error ) => console.log( error ),
        beforeSend: function(){
            $('#loading').show();
        },
        complete: function(){
            $('#loading').hide();
        },
        success:( data ) => {
            console.log( data )
            $('#getMessageReply').modal('show');
            $('#getMessageReply .modal-body').html(data);
        },

    })
})

$(document).on('click','.messageReplayButton',function(){
    $(this).parent('.messageActions').hide();
    $('.messageSendContainer').css('display','block');
})

$(document).on('click','.messageArchiveButton',function(){
    let type = $(this).attr('count');
    var messageId = [];
    if( type == 'single' ){
        messageId = [$(this).attr('messageId')];
    }else{
        $('.checkBoxSingle').each(function(){
            if($(this).is(':checked')){
                let msgId = $(this).siblings('.singleMessage').attr('messageId');
                messageId.push(msgId);
            }
        })

    }

    $.confirm({
        title: "Confirm!",
        content: "Are you sure you want to archive this message?",
        buttons: {
            confirm: function() {
               $.ajax({
                   url: `${SITE_URL}/archiveMsg`,
                   method: "post",
                   data: { _token: $("#csrf-token")[0].content, msg_id: messageId },
                   error: error => console.log(error),
                   success: (data) => {
                       location.reload()
                   }
               });
            },
            cancel: function() {

            },
        }
    });
})

$(document).on('change','.checkAllBoxArc',function(){
    if($(this).is(':checked')){
        $('.checkBoxSingle').prop('checked',true);
    }else{
        $('.checkBoxSingle').prop('checked',false);
    }
})

$(document).on('change','.checkBoxSingle',function(){
    $('.checkAllBoxArc').prop('checked',false);
})

$(document).on('click','.cancelReply',function(){
    $('.messageSendContainer').hide();
    $('.messageActions').show();
});


$(document).on('click','.accessPermissionUsers',function(){
    let id = $(this).attr('uid');
    $.ajax({
        url:`${SITE_URL}/admin/accessPermissionUserData`,
        method:'POST',
        data:{"_token":$('#csrf-token')[0].content,id:id},
        error:(error) => console.log( error ),
        success:( data ) => {
            $('#accessPermissionModal').find('.modal-body').html(data);
            $('#accessPermissionModal').modal('show');
        }
    })
})

/* step medical script start */


$(document).on('change','.user_date_of_birth',function(){
    let dob = new Date($(this).val());
    let difDate = Date.now() - dob.getTime();
    let convertDate = new Date(difDate);
    $('input[name=age]').val(Math.abs(convertDate.getUTCFullYear() - 1970));
})
const __addStepList = () => {
    let stepCard = document.querySelectorAll('.stepCard');
    var stepNumber = `<ul class="stepCounter">`;
    for(var i = 1;i <= stepCard.length;i++){
        var stepActive = ( i == 1 )?'stepActive':'';
        stepNumber += `<li class="${stepActive}">
                            <a href="#!" >
                                <span>${i}</span>
                            </a>
                        </li>`;

    }
    stepNumber += '</ul>';
    if( document.getElementsByClassName('stepContainer')[0] ){
        document.getElementsByClassName('stepContainer')[0].innerHTML = stepNumber;
    }

}

__addStepList();

if( document.getElementById('__nextStep') ){
    document.getElementById('__nextStep').addEventListener('click',  function(){
        var __nextStep = this;
        let stepCard = document.querySelectorAll('.stepCard');
        let nextStep = parseInt(__nextStep.getAttribute('step-no'));
        let setpSubOne = __validateStepForm('user-general_info',['fullname','gender','dob','home_address','email','phone','counseling','medical_care','family_plan']);
        if( nextStep == 0 && setpSubOne ){
            return false;
        }


        if( nextStep == (parseInt(stepCard.length) - 1 ) ){
            return false;
        }
        let prevStep = document.getElementById('__previewStep');

        __nextStep.setAttribute('step-no',nextStep + 1 );
        if( __nextStep.getAttribute('step-no') > 0 ){
            document.getElementById('__previewStep').classList.remove('displayNone');
        }

        if( __nextStep.getAttribute('step-no') > 1 ){
            prevStep.setAttribute('step-no',parseInt(parseInt(prevStep.getAttribute('step-no')) + 1));
        }

        let getStep = __nextStep.getAttribute('step-no');

        __activeSteplayout(getStep,stepCard);

        setTimeout(function(){
            if( getStep == (parseInt(stepCard.length) - 1 ) ){
                __nextStep.setAttribute('type','submit');
                __nextStep.classList.add('submitFormSteps');
                __nextStep.innerHTML = 'Finish';
            }

        },100);
        __stepActive(parseInt(__nextStep.getAttribute('step-no')));

        document.getElementById('madicalFormModal').scrollTop = 0;

    });

}



$(document).on('click','.submitFormSteps',function(e){
    e.preventDefault();
    let stepTwo = __onlyRadioCheck('user-counseling_behavioral',['seeking_counseling','health_concerns','medication_concerns','hospitalized_concerns','so_when','alcohol_or_drug','alcohol_or_drug_so_when']);
    if( !stepTwo ){
        $(this).closest('form').submit();
    }
})


if(document.getElementById('__previewStep')){
document.getElementById('__previewStep').addEventListener('click',function(){
    var prevStep = this.getAttribute('step-no');
    var nextStep = document.getElementById('__nextStep');

    if( prevStep == 0 ){
        document.getElementById('__previewStep').classList.add('displayNone');
    }

    nextStep.setAttribute('step-no',parseInt(nextStep.getAttribute('step-no') - 1));
    let stepCard = document.querySelectorAll('.stepCard');

    __activeSteplayout(prevStep,stepCard);

    if( parseInt(nextStep.getAttribute('step-no')) < (parseInt(stepCard.length) - 1) ){
        if( this.getAttribute('step-no') > 0 ){
            this.setAttribute('step-no',parseInt(this.getAttribute('step-no')) - 1);
        }
        nextStep.setAttribute('type','button');
        nextStep.innerHTML = 'Continue';
    }
     __stepActive(parseInt(nextStep.getAttribute('step-no')));

    document.getElementById('madicalFormModal').scrollTop = 0;

});
}
const __activeSteplayout= (getStep,stepCard) => {
    for(var i = 0; i < stepCard.length; i++   ){
        if( getStep == i ){
            stepCard[i].classList.remove('displayNone');
        }else{
            stepCard[i].classList.add('displayNone');
        }
    }
}

const __stepActive = (nextStepNo) => {
    var countStepLi = document.querySelectorAll('.stepCounter li');
    for(var i = 0; i < countStepLi.length; i++){
        if( nextStepNo == i ){
            countStepLi[i].classList.add('stepActive');
        }else{
            countStepLi[i].classList.remove('stepActive');
        }
    }
}
/* valiation start */

const __validateStepForm = (className,ignoreField = [])=> {
    var error = false;
    $.each(ignoreField,function(i,v){
        let classData =  $(`.${className}`);
        let inputData = classData.find(`input[name=${v}]`);
        let textArea = classData.find(`textarea[name=${v}]`);
        let selectArea = classData.find(`select[name=${v}]`);
        if( typeof inputData != 'undefined' && inputData.val() == '' && inputData.attr('type')== 'text'  ){
            let text = inputData.siblings('label').text();
            toastr.error('error',`Please fill ${text} filled` );
            error = true;
        }
        if( typeof inputData != 'undefined' && inputData.attr('type')== 'radio' && inputData.is(':checked') == false ){
            let textCheck = v.replace("_"," ");
            toastr.error('error',`Please fill ${textCheck} check` );
            error = true;
        }
        if( typeof textArea != 'undefined' && textArea.val() == '' ){
            let textAreaCheck = v.replace("_"," ");
            toastr.error('error',`Please fill ${textAreaCheck}` );
            error = true;
        }
        if( typeof selectArea != 'undefined' && selectArea.val() == '' ){
            let selectAreaCheck = v.replace("_"," ");
            toastr.error('error',`Please fill ${selectAreaCheck}` );
            error = true;
        }
    })
    return error;
}

const __onlyRadioCheck = (className,ignoreField) => {
    var error = false;
    $.each(ignoreField,function(i,v){
        let classData =  $(`.${className}`);
        let inputData = classData.find(`input[name=${v}]`);
        if( typeof inputData != 'undefined' && inputData.attr('type')== 'radio' && inputData.is(':checked') == false ){
            error = true;
        }
    })
    if( error ){
        toastr.error('error',`Please fill all check` );
    }
    return error;
}

$(document).ready(function() {
    $("#congrats-modal").modal('show');
    $("#complete-medical-modal").modal('show');
    $("#complete-counseling-modal").modal('show');
});



$(document).on("click", ".cust-modal .close", function() {
    $(".cust-modal").modal('hide');
});

$(document).on('click', 'button', function() {

    if (typeof attr !== $(this).attr('data-dismiss') && $(this).attr('data-dismiss') !== false) {
        $(this).closest('.modal').modal('hide');
    }
});


/* valiation end */


/*  p[ersonl health  */

$(document).on('change', '.take_medication-check', function() {
    let checkValue = $('.take_medication-check:checked').val();
    if (checkValue == 'yes') {
        $('#medical_show-check').show();
        $('.record-tabs-box-div').show();
        $('.savemedicalForms').show();
        $('.errorMedicalCheck').addClass('displayNone');
    } else {
        $('#medical_show-check').hide();
		$('.record-tabs-box-div').hide();
        $('.savemedicalForms').show();
        $('.errorMedicalCheck').addClass('displayNone');
    }
})

$(document).on('click', '.medical_add-more', function() {
    var count = (parseInt($('.medical_history-record').length) + Math.random());
    let cloneData = $('.medical_history-record:first').clone();
    cloneData.find('input[type=text]').val('');
    cloneData.find('textarea').val('');
    cloneData.find('input[type=radio]').prop('checked', false);
    cloneData.find('input[name="medical[0][medicalConditionName]"]').attr('name', `medical[${count}][medicalConditionName]`);
    cloneData.find('textarea[name="medical[0][medicalConditionDescription]"]').attr('name', `medical[${count}][medicalConditionDescription]`);
    cloneData.find('input[name="medical[0][medicalConditionStatus]"]').attr('name', `medical[${count}][medicalConditionStatus]`);
    cloneData.find('.deleteButton').children('a').removeClass('displayNone');
    $('.medical_field-container').append(cloneData);
})

$(document).on('click', '.medical_history-record .deleteButton a', function() {
    $(this).closest('.medical_history-record').remove();
})

$(document).on('click', '.saveAndNextHealth', function() {
    if( $(this).hasClass('showAddInfoModalHealthStepOne') ){
        $('#intervalCompleteHealthStep').modal('hide');
        $('.nexttriggerModal').trigger('click');
        return false;
    }

    let checkValue = $('.take_medication-check:checked').val();
    let FormType = $(this).attr('form-type');
    var content;

    if (FormType == 'personal-record') {
        window.location.href = $(this).attr('next-step');

    }else{
        if( typeof checkValue == 'undefined' ){
            $('.errorMedicalCheck').text('Please check one option field');
            $('.errorMedicalCheck').removeClass('displayNone');
            }else if( checkValue == 'yes' ){
                if( FormType == 'medications' ){
                    var content    = 'You want to save medications health records';
                    medicationsForm();

                } else if (FormType == 'medication-allergies') {
                    var content = 'You want to save medication allergies';
                    if ($('#medicationAllergyDamConceptIdType').val() == '') {
                        $('#medication-allergy-form').submit();
                    }
                }else if (FormType == 'medical-history') {
                    var content = 'You want to save medical Conditions';
                    if($('input[name="medical[0][medicalConditionName]"]').val() == '' || $('input[name="medical[0][medicalConditionDescription]"]').val() == '' ){
                        toastr.error('Please fill all medical conditions fields');
                        return false;
                    }
                }else if (FormType == 'document-manager') {
                    var content = 'It is best practice to upload the photos of your current pill box or prescriptions.';
                    if ( document.getElementById("file-health-uploaded").value == '') {
                        $('#upload-document').submit();
                    }
                }

                if ($('.clickOnSubmitBtn').valid()) {
                    AreUSureHealthRecord({ className: 'clickOnSubmitBtn', content: content });
                }
        } else if (checkValue == 'no') {
            if( FormType == 'document-manager' ){
                var content = "You haven’t uploaded any documents. Are you sure you want to continue without uploading?";
            }
            AreUSureHealthRecord({ className: 'clickOffSubmitBtn', content: content });
        }
    }

})

const medicationsForm = () => {
    $('#medication-form').validate({
        ignore: [],
        rules: {
            medicationSearch: {
                required: true,
            },
            medicationName: {
                required: true,
            },
            medicationComment: {
                required: false,
            },
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

const AreUSureHealthRecord = (data) => {
    if(typeof data.content == 'undefined'){
        data.content = 'You want to go next step by updating it.';
    }
    let redirect = document.createElement("input");
    redirect.setAttribute('name', 'redirect');
    redirect.setAttribute('type', 'hidden');
    let nextStep = $('.saveAndNextHealth').attr('next-step');
    if( typeof nextStep != 'undefined' && nextStep != '' ){
        redirect.value = $('.saveAndNextHealth').attr('next-step');
    }
    $(`.${data.className}`).append(redirect);
    $.confirm({
        useBootstrap: true,
        buttons: {
            tryAgain: {
                text: 'Yes',
                btnClass: 'btn-red',
                action: function() {
                    if( typeof data.idName != 'undefined' ){
                        $(`#${data.idName}`).submit();
                    }else{
                        $(`.${data.className}`).submit();
                    }
                }
            },
            cancel: {
                text: 'Cancel',
                btnClass: 'btn-default',
                action: function() {
                    $("#loading").hide();
                }
            },
        },
        //icon: 'fa fa-exclamation-triangle',
        title: 'Are you sure?',
        content: data.content,
        type: 'red',
        typeAnimated: true,
        boxWidth: '30%',
        useBootstrap: false,
        theme: 'modern',
        animation: 'scale',
        backgroundDismissAnimation: 'shake',
        draggable: false
    });
}


const medicationStatus = document.querySelectorAll('.medication-status');
if (medicationStatus) {
    for (let i = 0; i < medicationStatus.length; i++) {
        medicationStatus[i].addEventListener('click', function() {
            let medicationId = this.getAttribute('medication-id');
            let uId = this.getAttribute('u-id');
            let urlString = this.getAttribute('url-string');
            passData({
                url: `${urlString}`,
                content: `You are no longer taking this medication`,
                arguments: {
                    medicationId: medicationId,
                    uId: uId
                }
            })
        })
    }
}

const medicationAllergiesInactive = document.querySelectorAll('.medication-allergies-inactive');
if (medicationAllergiesInactive) {
    for (let i = 0; i < medicationAllergiesInactive.length; i++) {
        medicationAllergiesInactive[i].addEventListener('click', function() {
            let allergyId = this.getAttribute('addedAllergyId');
            let uId = this.getAttribute('u-id');
            let urlString = this.getAttribute('url-string');
            passData({
                url: `${urlString}`,
                content: `You are no longer taking this medication`,
                arguments: {
                    allergyId: allergyId,
                    uId: uId
                }
            })
        })
    }
}

$(document).on('click','.appCompleteConfig',function(){
    $('#congratulation-popup').modal('hide');
    $.ajax({
    url:`${SITE_URL}/pages/updateCompleteSetup`,
        method:'GET',
        data: {
            "_token": $('meta[name=csrf-token]').attr('content'),
        },
    })
})


$(document).on('keyup','#inputPromoCode',function(){
    $(this).val($(this).val().toUpperCase());
})

$(document).on('focus','input[type=password]#password',function(){
    $(".register-meter_container").show();
});

$(document).on('blur','input[type=password]#password',function(){
    if($(this).val() === '' ){
        $(".register-meter_container").hide();
    }
});

$(document).on('keyup','input[type=password]#password',function(){
    let value = $(this).val();

    var stringCheck = {
            long:    false,
            upper:   false,
            lower:   false,
            number:  false,
            special: false,
        };

    let wrongIcon = `<svg xmlns="http://www.w3.org/2000/svg" style="color:red" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>`;

    let checkIcon = `<svg xmlns="http://www.w3.org/2000/svg" style="color:green" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>`;
    $('.register-meter_container #lower span').html(wrongIcon);
    $('.register-meter_container #upper span').html(wrongIcon);
    $('.register-meter_container #number span').html(wrongIcon);
    $('.register-meter_container #special span').html(wrongIcon);
    $('.register-meter_container #long span').html(wrongIcon);

    let i = 0;
    while (i <= value.length){
            let specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            let character = value.charAt(i);
            if( character !== '' ){
                if( isNaN(parseInt(character)) && typeof character === "string"  && character.toLowerCase() === character && !specialChars.test(character) ){
                    $('.register-meter_container #lower span').html('');
                    $('.register-meter_container #lower span').html(checkIcon);
                    stringCheck.lower = true;
                }
                if( isNaN(parseInt(character)) && typeof character === "string" && character.toUpperCase() === character && !specialChars.test(character) ){
                    $('.register-meter_container #upper span').html('');
                    $('.register-meter_container #upper span').html(checkIcon);
                    stringCheck.upper = true;
                }
                if ( !isNaN(parseInt(character)) && !isNaN(character * 1)){
                    $('.register-meter_container #number span').html('');
                    $('.register-meter_container #number span').html(checkIcon);
                    stringCheck.number = true;
                }
                if( specialChars.test(character) ){
                    $('.register-meter_container #special span').html('');
                    $('.register-meter_container #special span').html(checkIcon);
                    stringCheck.special = true;
                }
            }
            i++;
        }
        if( value.length > 7 ){
            $('.register-meter_container #long span').html('');
            $('.register-meter_container #long span').html(checkIcon);
            stringCheck.long = true;

        }
        let countTrue = Object.values(stringCheck).filter(item => item === true).length;
        let percante = '0%';
        let percanteWidth = '2%';
        let percanteColor = '0 0 5px rgba(246, 8, 110, 0.8)';
        if( countTrue == 1 && value.length > 4 ){
            percante = '20%';
            percanteWidth = '20%';
        }else if( ( countTrue > 1 && countTrue < 5 ) ){
            if( countTrue == 2 ){
                percante = '40%';
                percanteWidth = '40%';
            }else if( countTrue == 3 ){
                percante = '60%';
                percanteWidth = '60%';
            }else if( countTrue == 4 ){
                percante = '80%';
                percanteWidth = '80%';
            }
            percanteColor = '#ffad00';
        }else if( countTrue == 5  ){
             percante = '100%';
             percanteWidth = '100%';
             percanteColor = '#02b502';
        }
        $("#calcuate-password-per").html(percante);
        $('#password-slide-strong').css({'width':`${percanteWidth}`,'background':`${percanteColor}`});

});


$(document).on('click','.splan_awmi',function(){
        let awmiType = $(this).attr('awmitype');
        let awmiPrice = $(this).attr('awmiprice');
        $('#awmi-pricing-address').modal('show');
        $("input[name=awmitype]").val(awmiType)
        $("input[name=awmiprice]").val(awmiPrice);
})



$(document).on("click", ".cancel-safety-warning", function() {
    $(".safety-conent-inner .plans-row").show();
    $(".safety-conent-inner .plans-row").addClass("active-plans-row");
    $(".plans-guide-block").hide();
    $(".plans-guide-block").removeClass("active-plans-guide-block");
});
$(document).on("click", ".mood-feels-img-wrap", function() {

    let getMoodKey = $(this).attr('key-name');
    let getTypeMood = $(this).attr('key-type');
    let getNumber = $(this).attr('emojino');

    $(".otherChildMood").text('OTHER');
    $(".otherChildMood").siblings('input').val(':OTHER:');
    $("input[name=customMood]").val('');
    $("input[name=mood_number]").val(getNumber);


    $(".otherSubChildMood").text("OTHER");
    $(".otherSubChildMood").siblings("input").val(":OTHER:");
    $("input[name=customMood]").val("");

    $(this).closest(".mood-feels-scroll").find('.mood-feels-img-wrap').removeClass('iconCheckedMood');
    $(`input[name=${getTypeMood}Child]`).siblings(".childMoodfaces").removeClass('checkedRadioMood');
    $(this).addClass("iconCheckedMood");

    $(`input[name=${getTypeMood}Parent]`).prop("checked", false);
    $(`input[name=${getTypeMood}Child]`).prop('checked', false);
    $(`input[name=${getTypeMood}SubChild]`).prop("checked", false);
    $(this).find(`input[name=${getTypeMood}Parent]`).prop('checked', true);

    $(`.moods-child-${getTypeMood}`).hide();
    $(`.moods-face-subChild-${getTypeMood}`).hide();
    $(`.mood-child-${getTypeMood}-${getMoodKey}`).show();
    let moodtext = getMoodKey.toLowerCase();

    $(".selectedMoodChild").html('');
    $(".selectedMoodSubChild").html('');
    $(".cust-moods-block").show();
    $(".selectedMoodParent").html(`<h3> I feel ${moodtext} because I feel </h3>`);

});

$(document).on("click", ".childMoodfaces", function() {

    $(this).closest(".moods-face-dynamic").find('.childMoodfaces').removeClass("checkedRadioMood");
    $(this).closest(".mood-feels-row-left").find('.subChildMood').removeClass('checkedRadioMood');

    $(this).addClass("checkedRadioMood");
    let getMoodKey = $(this).attr("keyname");
    let getTypeMood = $(this).attr("key-type");
    let mainMood = $(this).attr("mainmood");

    $(".otherSubChildMood").text("OTHER");
    $(".otherSubChildMood").siblings("input").val(":OTHER:");
    $("input[name=customMood]").val("");

    $(`input[name=${getTypeMood}Child]`).prop("checked", false);
    $(`input[name=${getTypeMood}SubChild]`).prop("checked", false);

    $(this).siblings(`input[name=${getTypeMood}Child]`).prop('checked', true);
    $(`.moods-face-subChild-${getTypeMood}`).hide();
    $(`.mood-subChild-${getTypeMood}-${mainMood}-${getMoodKey}`).show();

    let moodtext = getMoodKey.toLowerCase();
    $(".selectedMoodSubChild").html("");


    $(".selectedMoodChild").html(`<h3> I Feel ${moodtext} because I feel </h3>`);

});

$(document).on("click", ".subChildMood", function() {
    $(this).closest(".mood-feels-row-left").find('.subChildMood').removeClass('checkedRadioMood');
    $(this).addClass("checkedRadioMood");
    let getTypeMood = $(this).attr("key-type");
    $(`input[name=${getTypeMood}SubChild]`).prop("checked", false);
    $(this).siblings(`input[name=${getTypeMood}SubChild]`).prop('checked', true);
    $('.saveMood').show();
});

const saveMood = document.querySelector(".saveMood");
if (saveMood) {
    saveMood.addEventListener("click", function(e) {
        e.preventDefault();
        var physically = document.querySelector(
            "input[name=physicallyParent]:checked"
        );
        var physicallyChild = document.querySelector(
            "input[name=physicallyChild]:checked"
        );
        var physicallySubChild = document.querySelector(
            "input[name=physicallySubChild]:checked"
        );
        if (!physically) {
            toastr.error("Please select your mood");
        } else if (!physicallyChild) {
            toastr.error("Please select second step of your mood");
        } else if (!physicallySubChild) {
            toastr.error("Please select third step of your mood");
        } else {
			showLoaderPageLoad('show');
            $.ajax({
                url:`${SITE_URL}/my-mood-feeling-save`,
                method:'POST',
                data:{
                    _token: $("#csrf-token")[0].content,
                    mood_number:$('input[name=mood_number]').val(),
                    physicallyParent:$('input[name=physicallyParent]:checked').val(),
                    physicallyChild:$('input[name=physicallyChild]:checked').val(),
                    physicallySubChild:$('input[name=physicallySubChild]:checked').val(),
                },
                error:(error) => {
					showLoaderPageLoad('hide');
                    toastr.clear();
                    toastr.error("Internal Server Error");
                    
                },
                success:(result) => {
					showLoaderPageLoad('hide');
                    var data = JSON.parse(result)
                    if( data.status ){
						$("#mood_id").val(data.mood_id);
                        $('#moodJournal').modal('show');
                    }else{
                        toastr.error(data.message);
                    }
                }

            })

        }
    });
}

$(document).on('click','.addNewSupporter',function(){
    $('.supportFormCard').removeClass('displayNone');
    $(this).closest('.card--white').hide();
})


$(document).on('click','.closeSupportForm',function(){
    $('.supportFormCard').addClass('displayNone');
    $('.addMoreSupporterContent').show();
})
$(document).on('click', '.healthPhone', function() {
    let phoneNumber = $(this).attr('phoneNo');
    let textdata = $(this).children('.plans-heading').text();
    $('#safetyPhoneCenter').find('.modal-body').html(`<p>Are you sure?</p>`);
    $('#safetyPhoneCenter').modal('show');
    $('#safetyPhoneCenter').find('#callPopup').attr('href', $(this).attr('data-call'));
    //window.open(`tel:${phoneNumber}`, '_self');
})

$(document).on('click', '.healthPhoneCall', function() {
    let phoneNumber = $(this).attr('phoneNo');
    window.open(`tel:${phoneNumber}`, '_self');
})

$(document).on("click", ".googleNearMe", function(e) {
    e.preventDefault();
	console.log("Google Near Me");
    var hrefLink = $(this).attr("data-link");
    if (hrefLink == 'javascript') {
        return false;
    } else {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }

        function showPosition(position) {
            window.open(`${hrefLink}/@${position.coords.latitude},${position.coords.longitude}`, "_blank");
        }
    }
});















