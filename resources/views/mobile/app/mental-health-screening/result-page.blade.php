<div class="midical-form v1 detail" id="result-page" style="display: none;">
    <div class="disorder-v7">

    <div class="ucessfully">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 20.292969 5.2929688 L 9 16.585938 L 4.7070312 12.292969 L 3.2929688 13.707031 L 9 19.414062 L 21.707031 6.7070312 L 20.292969 5.2929688 z"/></svg>
                                    </div>
                                    <div class="title">
                                        <p>THANK YOU!</p>
                                    </div>
                                    <div class="text">
                                        <p>You have successfully completed the survey.</p>
                                    </div>
    </div>

        <div class="preferred-pharmacy">
            <div class="app-heading anxiety">
                <?php if ($quiz_type == 1) {   ?><p>GAD-7 (Generalized Anxiety Disorder - 7)</p> <?php } ?>
                <?php if ($quiz_type == 2) {   ?><p>PHQ-9 (PATIENT HEALTH QUESTIONNAIRE - 9)</p> <?php } ?>
                <?php if ($quiz_type == 3) {   ?><p>( UNCOPE ) Alcohol & Substance Abuse</p><?php } ?>
            </div>
        </div>
        <div class="your-score">
            <div class="image"><img src="./assets/images/sad-imozi-svg.svg" id="result-img"></div>
            <div class="score score-result"><p>Your score is <span class="total">0</span></p></div>
            <div class="your-n"><p id="message"></p></div>
        </div>
        <div class="your-score-cta">
			<?php /*
            <a href="{{ route('talk-to-therapist')}}" class="primary-button">Learn more</a>
			*/ ?>
            <a href="{{ route('talk-to-therapist')}}"  class="primary-button">Talk to therapist</a>
            <a href="{{ route('my-screening-history-graph')}}"  class="primary-button">Screening history</a>

        </div>
    </div> 
</div>