<div id="result-page" class="gad7-thanku" style="display: none;">

      <div class="ucessfully">
         <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
               <path
                  d="M 20.292969 5.2929688 L 9 16.585938 L 4.7070312 12.292969 L 3.2929688 13.707031 L 9 19.414062 L 21.707031 6.7070312 L 20.292969 5.2929688 z">
               </path>
            </svg>
         </div>
         <div class="title">
            <p>THANK YOU!</p>
         </div>
         <div class="text">
            <p>You have successfully completed the survey.</p>
         </div>
      </div>


      <div class="anxiety-card-thank">

         <div class="preferred-pharmacy">
            <div class="app-heading anxiety">
               <p class="app-heading-">
			   
					<?php if($quiz_type=="1"){?>
						GAD-7 (Generalized Anxiety Disorder - 7)
					<?php } else if($quiz_type=="2"){?>
						PHQ-9 (Patient Health Questionnaire - 9)
					<?php } else if($quiz_type=="3"){?>
						AUDIT - The Alcohol Use Disorders Identification result
					<?php } ?>
					
				</p>
			   
			  
            </div>
         </div>
         <div class="your-score">
            <div class="image">
               <!-- <img src="https://198.38.90.166/assets/services/images/4.png" id="result-img"> -->
               <img  src="" id="result-img">
            </div>

            <div class="score score-result">
               <p>Your score is <span class="total">0</span></p>
            </div>
            <div class="your-n">
               <p id="result-msg"></p>
            </div>

         </div>
         
      </div>
      <div class="your-score-cta">
		<?php /*
         <a href="{{ route('talk-to-therapist')}}" class="primary-button">Learn more</a>
		 */ ?>
         <a href="{{ route('talk-to-therapist')}}" class="primary-button">Talk to therapist</a>
         <a href="{{ route('my-screening-history-graph')}}" class="primary-button">Screening history</a>

      </div>
</div>