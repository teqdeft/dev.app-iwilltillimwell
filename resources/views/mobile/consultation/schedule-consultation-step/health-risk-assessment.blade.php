@if(Request::segment(3) == 'step-7')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action');
    $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-8/' . Request::segment(4)) . '?action=' . request('action');
@endphp 
<div id="health-risk-assessment" class="tab-content">
                        <div class="patient-tab-content">
                           <form class="risk-assessment-form">
						   
						   
<?php
$questions = $eligible_members->consultation->available_questionnaires[0]->questions ?? '';

		if($questions) {
			foreach($questions as $data) {
				if($data->hide==0) {
	?>
                                <div class="col-100 form-group question-list question-list-<?php echo $data->question_id?>">
								<?php 
									/* echo "<pre>";
									print_r($options);
									echo "</pre>"; */
								?>
                                    <label class="question-title"><?php echo $data->question?></label>
                                    <div class="custom-radio-group indicate-radio input-list">
										<input type="hidden" name="question_id" value="<?php echo $data->question_id?>" />
                                        <?php foreach($data->choices as $options) {?>
											
											@if($options->type == 'textarea')
												<div class="mt-check">
													<label>{{$options->choice}}</label>
													<textarea rows="5" placeholder="{{$options->choice}}"></textarea>
												</div>
											@else
											
												<?php $class = ($options->type == 'radio') ? 'custom-radio' : 'custom-check'; ?>
													<label class="{{$class}}">
													
															<?php if($options->type=="radio") {?>
																<span class="order-2">{{$options->choice}}</span>
															<?php } ?>
							
							<input 
							type="{{$options->type}}" 
							name="option<?php echo $data->question_id?>" 
							value="<?php echo $options->choice_id?>" 
							lang_identifier="<?php echo $options->lang_identifier?>"
							question_id="<?php echo $data->question_id?>"
							choice_id="<?php echo $options->choice_id?>"
							
							>
							
							
																
															<?php if($options->type=="radio") {?>
																		<span class="custom-radio-button"></span>
															<?php } else {?>
																 <span class="checkmark"></span>
																	<span>{{$options->choice}}</span>
																<?php } ?>
																
																
													</label>
											@endif
												
										<?php } ?>
                                    </div>
                                </div>
			<?php } 
			}
		}
?>
                                
									
                               

                                <div class="col-100 cta">
                                    <div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">   
                                        <a href="{{$scheduleUrl}}" class="outline-button showLoaderPageLoad">Back</a>
                                        <button type="button" class="primary-button" type="button" onclick="return healthrisksubmit()">Next</button>
                                    </div>    
                                </div>
                                
                           </form>
                        </div>
                    </div>
<script>
$(function(){
	
    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	getCheckboxChecked();
	
	$('input[type="radio"], input[type="checkbox"]').on('change', function () {
		
		let question_id = $(this).attr('question_id');
		let choice_id = $(this).attr('choice_id');
		let lang_identifier = $(this).attr('lang_identifier');
		let type = $(this).attr('type');
		let newData = {
            question_id: question_id,
            choice: choice_id,
            lang_identifier:lang_identifier,
            type:type
        };
		if (!Array.isArray(scheduleConsultation.primarycare.health_risk)) {
			scheduleConsultation.primarycare.health_risk = [];
		}
		let existingIndex = scheduleConsultation.primarycare.health_risk.findIndex(item => item.question_id == question_id);
		console.log(existingIndex);
		if (existingIndex !== -1) {
			scheduleConsultation.primarycare.health_risk[existingIndex] = newData;
		} else {
			scheduleConsultation.primarycare.health_risk.push(newData);
		}
		localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
		//getCheckboxChecked();
	});
	
});
function healthrisksubmit() {
	let hasError = false;
	$('.question-list').removeClass('error-title'); 
	 $('.input-list').each(function (index) {
		const hasChecked = $(this).find('input:checked').length > 0;		
		if (!hasChecked) {
			toastr.error("Please complete questionnaire form");
			 const errorTarget = $(this).closest('.question-list');	
				errorTarget.addClass('error-title');
				
				$('html, body').animate({
                    scrollTop:errorTarget.offset().top - 100
                }, 600);
				hasError = true;
			return false; 			
		}
	 });
	if(!hasError){
		showLoaderPageLoad('show');
		window.location.href='<?php echo $next_url?>';
	}		
}
function getCheckboxChecked() {
	
	const storedUser = JSON.parse(localStorage.getItem("scheduleConsultation"));
	console.log(storedUser);
	console.log("-------------------");
	
	if(storedUser.primarycare.health_risk){
		
		for(var i=0;i < storedUser.primarycare.health_risk.length; i++) {
			
			let question_id = storedUser.primarycare.health_risk[i].question_id; 
			let choice = storedUser.primarycare.health_risk[i].choice; 
			
			$('.question-list-'+question_id+' input[value="'+choice+'"]').prop('checked', true);
		}
	}
		
		
}
document.querySelectorAll('input[type="selectall"]').forEach(input => {
  input.closest('.custom-check').style.display = 'none';
});
</script>	
<style>
.error-title .question-title { color :red !important}
</style>				
@endif					