<div class="consent-gad7 table-main" id="quiz-<?php echo $quiz_type?>" style="display:none;">
      <div class="top-main-title">
	  
		<?php if($quiz_type==1) {?>
			<p>Anxiety Test - GAD 7</p>	
		<?php } else if($quiz_type==3) {?>
			<p>AUDIT - The Alcohol Use Disorders Identification Test</p>
		<?php } else {?>
			<p>PHQ-9 (Patient Health Questionnaire - 9)</p>
			<p class="phq-sub-heading">The PHQ-9 is a multipurpose instrument for screening, diagnosing, monitoring and measuring the severity of depression.</p>
		<?php } ?>
			
      </div>
      <div class="table-responsive">
	  
		
         <table class="table">
            <thead class="thead-dark">
               <tr>
					<?php if($quiz_type!=3){?>
                  <th>Over the last two weeks, how often have you been bothered
                     by the following problems?
                  </th>
                  <th class="na-th text-center">Not at all
                  </th>
                  <th class="sd-th text-center">Several days
                  </th>
                  <th class="mn-th text-center">More than half<br> the days
                  </th>
                  <th class="ned-th text-center">Nearly every day</th>
					<?php } ?>
               </tr>
            </thead>
            <tbody>
			
			<?php
            $ind = 0;
                foreach ($questions as $key => $q) {
                     if($q->quiz_type == 1) { ?>
                           <tr class="quiz-type-div-list">
                              <td>
                                 <div class="left-head-table anxiety-question"><strong><?= $key + 1 ?>.</strong> {{$q->question}}</div>
                              </td>
                              <td><label class="custom-radio">0
                                    <input type="radio" onclick="updateCount({{$ind}}, 0, 0, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                              <td><label class="custom-radio">1
                                    <input type="radio" onclick="updateCount({{$ind}}, 1, 1, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                              <td><label class="custom-radio">2
                                    <input type="radio" onclick="updateCount({{$ind}}, 2, 2, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                              <td><label class="custom-radio">3
                                    <input type="radio" onclick="updateCount({{$ind}}, 3, 3, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                           </tr>
                     <?php $ind++;
                        }
                     } ?>
					 
				<?php
            $ind = 0;
                foreach ($questions as $key => $q) {
                     if($q->quiz_type == 2) { ?>
                           <tr class="quiz-type-div-list">
                              <td>
                                 <div class="left-head-table"><strong><?= $key + 1 ?>.</strong> {{$q->question}}</div>
                              </td>
                              <td><label class="custom-radio">0
                                    <input type="radio" onclick="updateCount({{$ind}}, 0, 0, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                              <td><label class="custom-radio">1
                                    <input type="radio" onclick="updateCount({{$ind}}, 1, 1, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                              <td><label class="custom-radio">2
                                    <input type="radio" onclick="updateCount({{$ind}}, 2, 2, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                              <td><label class="custom-radio">3
                                    <input type="radio" onclick="updateCount({{$ind}}, 3, 3, {{$q->id}})" name="radio{{$key}}">
                                    <span class="checkmark"></span>
                                 </label>
                              </td>
                           </tr>
                     <?php $ind++;
                        }
                     } ?>


					<?php
                     $ind = 0;
                     foreach ($questions as $key => $q) {
                        if ($q->quiz_type == 3) { ?>
							
							@include('app.mental-health-screening.alcohol-question-option')
                           
                     <?php $ind++;
                        }
                     } ?>	
					 
               
            </tbody>
			<?php if($quiz_type!=3){?>
				<tfoot>
				   <tr>
					  <td class="text-right"><strong>Column totals</strong></td>
					  <td>
						 <div class="total-column sum-0">0</div>
						 <span class="plus-icon">+</span>
					  </td>
					  <td>
						 <div class="total-column sum-1">0</div>
						 <span class="plus-icon">+</span>
					  </td>
					  <td>
						 <div class="total-column sum-2">0</div>
						 <span class="plus-icon">+</span>
					  </td>
					  <td>
						 <div class="total-column sum-3">0</div>
					  </td>
				   </tr>
				</tfoot>
			<?php } ?>
         </table>
			<?php if($quiz_type!=3){?>
				<div class="total-score text-right">Total Score <span class="total">0</span></div>
			<?php } ?>
      </div>
	<?php if($quiz_type!=3){?>
      <div class="text-center box-btm">
         <div class="prob-title">
            <p>If you checked any problems, how difficult have they made it for you to do your work, take care of things at home, or get along with other people?</p>
         </div>

         <div class="row">
            <div class="col-md-3">
               <div class="radio-boxes">
                  <label class="custom-radio">
                     <input type="radio" value="not_difficult" name="review_feedback">
                     <span class="checkmark"></span>
                     <p>Not difficult at all </p>
                  </label>
               </div>
            </div>
            <div class="col-md-3">
               <div class="radio-boxes">
                  <label class="custom-radio">
                     <input type="radio" name="review_feedback" value="difficult">
                     <span class="checkmark"></span>
                     <p>Somewhat difficult</p>
                  </label>
               </div>
            </div>
            <div class="col-md-3">
               <div class="radio-boxes">
                  <label class="custom-radio">
                     <input type="radio" name="review_feedback" value="very_difficult">
                     <span class="checkmark"></span>
                     <p>Very difficult</p>
                  </label>
               </div>
            </div>
            <div class="col-md-3">
               <div class="radio-boxes">
                  <label class="custom-radio">
                     <input type="radio" name="review_feedback" value="extremely_difficult">
                     <span class="checkmark"></span>
                     <p>Extremely difficult</p>
                  </label>
               </div>
            </div>
         </div>

      </div>
	<?php } ?>
      <div class="col-100 cta">
         <button class="primary-button" onclick="nextStep('result')">Next</button>
      </div>

   </div>