@extends('layouts.v1.dashboard')
@section('content')
<div class="content-wrapper">
	
	<div class="row">
			<div class="col-12 col-xl-6 mb-4 mb-xl-0">
				<div class="patient-details">
					<div class="media">
						<div class="title-heading-icon-box-cus"><i class="fas fa-user-md"></i></div>
						<div class="media-body"><h3 class="font-weight-bold">Mental Health Screenings</h3></div>
					</div>	
				</div>	
			</div>	
	</div>
	
	
	@include('app.mental-health-screening.form')
	@include('app.mental-health-screening.question-ans-option')
	@include('app.mental-health-screening.result-thank-you')
	
</div>	


<script>
var step = 'consent';
var q_type = "<?= $quiz_type ?>";
var user_inp, message;
var exp = 1;
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

      
      message = '';
      var alcohol = "";
      if (q_type == 1) {
		  
         if (total < 5) {
			exp = 1;
			message = "This represents a minimal anxiety";
		} else if (total <= 9) {
			exp = 2;
			message = "This represents a mild level of anxiety";
		} else if (total <= 14) {
			exp = 3;
			message = "This represents a moderate level of anxiety";
		} else {
			exp = 4;
			message = "This represents a severe level of anxiety";
		}

      } else if(q_type == 2) {
		  
         
		 
			if (total < 5) {
				exp = 1;
				message = "This represents a none / minimal depression";
			} else if (total <= 9) {
				exp = 2;
				message = "This represents a mild level of depression";
			} else if (total <= 14) {
				exp = 3;
				message = "This represents a moderate level of depression";
			} else if (total <= 19) {
				exp = 4;
				message = "This represents a moderately severe level of depression";
			} else {
				exp = 5;
				message = "This represents a severe level of depression";
			}

      } else if(q_type == 3) {
		
         if (total < 7) {
            exp = 1;
            message = 'Your results indicate low-risk alcohol consumption, meaning your current drinking pattern is not likely to cause health problems.'
         } else if (total < 15) {
            exp = 3;
            message = 'Your results suggest hazardous or harmful drinking, which can increase the risk of health issues and may require lifestyle changes.'
         } else {
            exp = 6;
            message = 'Your results indicate alcohol dependence, also known as moderate to severe alcohol use disorder, which typically requires professional support and treatment.'
         }
      }
	 
	$("#result-msg").html(message); 
	 
}
   

function nextStep(type) {
      
	
	let count_radio_checked = $(".quiz-type-div-list input[type='radio']:checked").length;
    let count_radion_class = $(".quiz-type-div-list").length;
    console.log(count_radio_checked +' '+count_radion_class);
    if(count_radio_checked !== count_radion_class) {
        toastr.error("All Field is Required");
        return false;
    }

    <?php if($quiz_type!=3) { ?>
        
        const isChecked = $('input[name="review_feedback"]:checked').length > 0;
        if (!isChecked) {
            toastr.error('Please select your feedback.');
            return false;
        }

    <?php } ?>
	
      $.ajax({
         method: "POST",
         url: `${SITE_URL}/save-quiz-result`,
         dataType: "json",
         data: {
            "_token": $('#csrf-token')[0].content,
            'answers': user_inp,
            'visitor_id': $("#visitor_id").val(),
            'school_id': $("#school_id").val(),
            'review': $("input[name='review_feedback']:checked").val()
         },
         success: function(data) {
            if (data.status == 1) {

               $("#message").html(message);
               $("#result-img").attr("src", "<?= asset('assets/services/images/') ?>" + "/" + exp + '.png');
               $("#quiz-" + "<?= $quiz_type ?>").hide();
               $("#result-page").show();
                var topHeightResult = document.getElementById("result-page").offsetTop;
                setTimeout(() => {
                    $("html, body").animate({ scrollTop: topHeightResult }, "slow");
                },50);


            }
         },
      });

}
   
</script>
@push('scripts')
<?php /*
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(function() {
    $("#created_dated").datepicker({
        dateFormat: "mm/dd/yy",
        beforeShowDay: function(date) {
            const today = new Date();
            return [
                date.getDate() === today.getDate() &&
                date.getMonth() === today.getMonth() &&
                date.getFullYear() === today.getFullYear()
            ];
        }
    });
});
</script>
*/ ?>
@endpush
@endsection