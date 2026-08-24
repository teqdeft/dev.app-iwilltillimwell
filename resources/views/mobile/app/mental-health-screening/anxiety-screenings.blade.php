<div id="<?php if($quiz_type==1) { ?>anxiety<?php } ?><?php if($quiz_type==2) { ?>depression<?php } ?><?php if($quiz_type==3) { ?>alcohol<?php } ?>" class="tab-content active">

    @include('mobile.app.mental-health-screening.form')
    
    <div class="midical-form v1 detail anxiety-step-two" id="quiz-<?php echo $quiz_type?>" style="display: none;">
        <div class="midical-form v1 detail">
            <form class="sfty-pln-v1">
                <div class="form-row">

                    <div class="col-100 form-group">
                        <div class="inner-title mt-0">
                            <p>Over the last two weeks, how often have you been bothered by the following problems?</p>
                        </div>
                    </div>

                    <?php
                     $ind = 0;
                     foreach ($questions as $key => $q) {
                        if ($q->quiz_type == $quiz_type) { ?>

                        <?php  
                        if ($quiz_type == 3) {  
                            ?>

                            <div class="col-100 form-group gad-7 quiz-type-div-list">
                                <label class="question-list-class"><strong><?= $key + 1 ?>.</strong>. {{$q->question}}.</label>
                                <div class="custom-radio-group indicate-radio">   
                                        
                                    <label class="custom-radio">
                                        <p>No</p>
                                        <input type="radio" onclick="updateCount({{$ind}}, 0, 0, {{$q->id}})" name="radio{{$key}}">
                                        <span class="custom-radio-button"></span>
                                    </label>

                                    <label class="custom-radio">
                                        <p>Yes</p>
                                        <input type="radio" onclick="updateCount({{$ind}}, 1, 1, {{ $q->id }})" name="radio{{$key}}">
                                        <span class="custom-radio-button"></span>
                                    </label>

                                </div>   
                            </div>

                            <?php 

                        } else {?>


                        <div class="col-100 form-group gad-7 quiz-type-div-list">
                            <label class="question-list-class"><strong><?= $key + 1 ?>.</strong>. {{$q->question}}.</label>
                            <div class="custom-radio-group indicate-radio">
                                                    <label class="custom-radio">
                                                        <p>Not at all <span>0</span></p>
                                                        <input type="radio" name="radio{{$key}}" value="1" onclick="updateCount({{$ind}}, 0, 0, {{$q->id}})">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                    <label class="custom-radio">
                                                        <p>More than half the days <span>1</span></p>
                                                        <input type="radio" name="radio{{$key}}" value="2" onclick="updateCount({{$ind}}, 1, 1, {{$q->id}})">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                    <label class="custom-radio">
                                                        <p>Several days <span>2</span></p>
                                                        <input type="radio" name="radio{{$key}}" value="3" onclick="updateCount({{$ind}}, 2, 2, {{$q->id}})">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                    <label class="custom-radio">
                                                        <p>Nearly every day <span>3</span></p>
                                                        <input type="radio" name="radio{{$key}}" value="4" onclick="updateCount({{$ind}}, 3, 3, {{$q->id}})">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                            </div>
                        </div>

                         <?php } ?>   

                        <?php $ind++; } 
                     }
                     ?>    

                     <?php if ($quiz_type != 3) {   ?>


    
                     <div class="column-totals">
                                            <div class="title-col">
                                                <p>Column totals</p>
                                            </div>
                                            <div class="col-row">
                                                <div class="col-45">
                                                    <p class="sum-0">0</p>
                                                </div>
                                                <div class="col-13">
                                                    <p>+</p>
                                                </div>
                                                <div class="col-45">
                                                    <p class="sum-1">0</p>
                                                </div>
                                                <div class="col-13">
                                                    <p>+</p>
                                                </div>
                                                <div class="col-45">
                                                    <p class="sum-2">0</p>
                                                </div>
                                                <div class="col-13">
                                                    <p>+</p>
                                                </div>
                                                <div class="col-45">
                                                    <p class="sum-3">0</p>
                                                </div>
                                                <div class="col-13">
                                                    <p>=</p>
                                                </div>
                                                <div class="col-45 total">
                                                    <p class="total">0</p>
                                                </div>
                                            </div>
                                        </div>

                     <div class="col-100 form-group">
                                            <div class="inner-title mb-0">
                                                <p>If you checked any problems, how difficult have they made it for you
                                                    to do your work, take care of things at home, or get along with
                                                    other people?</p>
                                            </div>
                    </div>

                    <div class="col-100 form-group patient-tab-content">
                                            <div class="consut-dr">
                                                <div class="custom-radio-group">
                                                    <label class="custom-radio">
                                                        <div class="gr-p">
                                                            <span>Not difficult at all</span>
                                                        </div>
                                                        <input type="radio" name="review_feedback" value="not_difficult">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-100 form-group patient-tab-content">
                                            <div class="consut-dr">
                                                <div class="custom-radio-group">
                                                    <label class="custom-radio">
                                                        <div class="gr-p">
                                                            <span>Somewhat difficult</span>
                                                        </div>
                                                        <input type="radio" name="review_feedback" value="difficult">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-100 form-group patient-tab-content">
                                            <div class="consut-dr">
                                                <div class="custom-radio-group">
                                                    <label class="custom-radio">
                                                        <div class="gr-p">
                                                            <span>Very difficult</span>
                                                        </div>
                                                        <input type="radio" name="review_feedback" value="very_difficult">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-100 form-group patient-tab-content">
                                            <div class="consut-dr">
                                                <div class="custom-radio-group">
                                                    <label class="custom-radio">
                                                        <div class="gr-p">
                                                            <span>Extremely difficult</span>
                                                        </div>
                                                        <input type="radio" name="review_feedback" value="extremely_difficult">
                                                        <span class="custom-radio-button"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                        <?php } ?>
                    <div class="col-100 cta">
                        <button type="button" onclick="nextStep('result')" class="primary-button">Next</button>
                    </div>
                </div>    
        </div>
    </div>
    @include('mobile.app.mental-health-screening.result-page')
</div>


<script>

var step = 'consent';
   var q_type = "<?= $quiz_type ?>";
   var user_inp, message;
   var exp = 1;

$(document).on("click", ".move-next", function(e) {
    e.preventDefault();
	const nameRegex = /^[A-Za-z\s]{2,100}$/;
    if(!$('input[name=visitor_permission]').is(':checked')){
        toastr.error("Please choose one option.");
        return false;
    }
    if(!$("#name_of_school").val()) {
        toastr.error("Name is required.");
        return false;
    }
	/* if (!nameRegex.test($("#name_of_school").val())) {
        toastr.error("Name Only alphabetic characters are allowed");
        return false;
    } */
	
	
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

var answer_arr = {};
var user_inp = [];
function updateCount(ind, row, val, id) {

answer_arr[ind] = {};
user_inp[id] = val;
answer_arr[ind][row] = val;
var sum0 = sum1 = sum2 = sum3 = total = 0;
for (let k in answer_arr) {
   for (let sk in answer_arr[k]) {
      switch (sk) {
         case '0':
            sum0 = sum0 + answer_arr[k][sk];
            break;
         case '1':
            sum1 = sum1 + answer_arr[k][sk];
            break;
         case '2':
            sum2 = sum2 + answer_arr[k][sk];
            break;
         case '3':
            sum3 = sum3 + answer_arr[k][sk];
            break;
      }

   }

}

total = sum0 + sum1 + sum2 + sum3;

$(".sum-0").html(sum0);
$(".sum-1").html(sum1);
$(".sum-2").html(sum2);
$(".sum-3").html(sum3);
$(".total").html(total);

exp = 1;
message = '';
var alcohol = "";
if (q_type == 1) {
   if (total < 5) {
      exp = 1;
      message = "This represents a minimal anxiety";
   } else if (exp >= 5 && exp <= 9) {
      exp = 2;
      message = "This represents a mild level of anxiety";
   } else if (exp >= 10 && exp <= 14) {
      exp = 3;
      message = "This represents a moderate level of anxiety";
   } else if (exp >= 15 && exp < 21) {
      exp = 4;
      message = "This represents a severe level of anxiety";
   } else {
      exp = 4;
      message = "This represents a severe level of anxiety";
   }

} else if(q_type == 2) {
   if (total < 5) {
      exp = 1;
      message = "This represents a minimal depression";
   } else if (exp >= 5 && exp <= 9) {
      exp = 2;
      message = "This represents a mild level of depression";
   } else if (exp >= 10 && exp <= 14) {
      exp = 3;
      message = "This represents a moderate level of depression";
   } else if (exp >= 15 && exp <= 19) {
      exp = 4;
      message = "This represents a moderately severe level of depression";
   } else {
      exp = 5;
      message = "This represents a severe level of depression";
   }

} else if(q_type == 3) {

   if (total < 2) {
      exp = 1;
      message = 'Your responses have not identified risks or possible abuse or dependence.'
   } else {
      exp = 5;
      message = 'Your responses identify risks and indicate possible abuse or dependence. Further assessment is strongly recommended.'
   }
}
}


function nextStep(type) {
	
	$('.question-list-class').removeClass('error-title'); 
	$('.quiz-type-div-list').each(function (index) {
		console.log(index);
		const hasChecked = $(this).find('input[type="radio"]:checked, input[type="checkbox"]:checked').length > 0;
		if (!hasChecked) {
			
			const errorTarget = $(this).find('.question-list-class');
			if (errorTarget.length) {
				errorTarget.addClass('error-title');
				
				$('html, body').animate({
                    scrollTop:errorTarget.offset().top - 100
                }, 600);
				return false;
			
			}
		} 
	});
	
    let count_radio_checked = $(".quiz-type-div-list input[type='radio']:checked").length;
    let count_radion_class = $(".quiz-type-div-list").length;
    console.log(count_radio_checked +' '+count_radion_class);
    if(count_radio_checked !== count_radion_class) {
        toastr.error("All Field is Required");
        return false;
    }
	console.log("===============");
	//return false;	
    <?php if($quiz_type!=3) { ?>
        
        const isChecked = $('input[name="review_feedback"]:checked').length > 0;
        if (!isChecked) {
            toastr.error('Please select your feedback.');
            return false;
        }

    <?php } ?>


    toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            });

      $.ajax({
         method: "POST",
         url: `${SITE_URL}/save-quiz-result`,
         dataType: "json",
         data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            'answers': user_inp,
            'visitor_id': $("#visitor_id").val(),
            'school_id': $("#school_id").val(),
            'review': $("input[name='review_feedback']:checked").val()
         },
         success: function(data) {
            toastr.clear();
            if (data.status == 1) {
                toastr.success("You have successfully completed the survey.");
               $("#message").html(message);
               $("#result-img").attr("src", "<?= asset('assets/services/images/') ?>" + "/" + exp + '.png');
               $("#quiz-" + "<?= $quiz_type ?>").hide();
               $("#result-page").show();
                
            }
         },
      });

   }
</script>