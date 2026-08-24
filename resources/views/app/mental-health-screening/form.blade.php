<div class="consent-gad7" id="consent">
      <div class="midical-form v1 detail">
         <div class="top-main-title andpal-title">
			<?php if($quiz_type==1) {?>
				<p class="title-heading">Anxiety Test - GAD 7</p>	
			<?php } else if($quiz_type==3) {?>
				<p class="title-heading">AUDIT - The Alcohol Use Disorders Identification Test</p>
			<?php } else {?>
				<p class="title-heading">PHQ-9 (Patient Health Questionnaire - 9)</p>
				<p class="phq-sub-heading">The PHQ-9 is a multipurpose instrument for screening, diagnosing, monitoring and measuring the severity of depression.</p>
			<?php } ?>
			
			<div class="sub-heading">
				<p>iWILL ’til i’mWELL Release of Records Consent</p>
			</div>
         </div>
		 
		 
         <form class="sfty-pln-v1">
		 
		<input type="hidden" class="form-control" id="q_type" value="<?= $quiz_type ?>">
		<input type="hidden" class="form-control" id="visitor_id">
		<input type="hidden" class="form-control" id="school_id">
		<input type="hidden" name="test_type" value="<?php if($quiz_type==1) { ?>anxiety<?php } else if($quiz_type==2) { ?>depression<?php } else if($quiz_type==3) {?>alcohol<?php } ?>" >
	
	
            <div class="form-row">
			
               <div class="col-100 form-group">
                  <div class="custom-radio-group indicate-radio">
				  
                    <label class="custom-radio">
                        I authorize iWILL ’til i’mWELL to release, disclose, and/or exchange my Medical and Mental Health Records.
                        <input type="radio" name="visitor_permission" value="1" checked onclick="getVPermission()">
                        <span class="custom-radio-button"></span>
                    </label>
					 
						<div class="col-100 form-group content-form consent-content-v1">
							 
							<div class="inner-title mb-0 agree-consent">
								<ul>
									<li>I understand this authorization is voluntary and may be revoked in writing at any time, except where action has already been taken.</li>
									<li>I understand that records disclosed may no longer be protected under federal privacy regulations.</li>
									<li>Unless I specify otherwise, this consent expires one (1) year from today.</li>
								</ul>
							</div>
							  
						</div>
						
						 <label class="custom-radio">
							I do not authorize iWILL ’til i’mWELL to release, disclose, and/or exchange my Medical and Mental Health Records.
							<input type="radio" name="visitor_permission" value="2" onclick="getVPermission()">
							<span class="custom-radio-button"></span>
						 </label>
					 
                  </div>
				  
               </div> 
			   
               <div class="col-50 form-group">
                  <label>Name <span class="required-ico">*</span></label>
                  <input class="form-control"  type="text" name="name_of_school" id="name_of_school" value="{{ Auth::user()->fname }} {{ Auth::user()->lname }}">
               </div>

               <div class="col-50 form-group" style="display:none;">
                  <label>Signature <span class="required-ico">*</span></label>
                  <input class="form-control" placeholder="Signature" type="text" name="student_id" id="student_id" value="Signature">
               </div>

               <div class="col-50 form-group" style="display:none;">
                    <label>Premises <span class="required-ico">*</span></label>
					<select class="form-control" name="printed_name" id="printed_name">
						<option value="On Campus">On Campus</option>
						<option value="Off Campus">Off Campus</option>
						<option value="Remote">Remote</option>
					</select> 
               </div>

               <div class="col-50 form-group">
                  <label>Date <span class="required-ico">*</span></label>
                  <input class="form-control" placeholder="24-02-2025" type="text" name="created_dated" id="created_dated" value="<?php echo date('Y-m-d')?>" disabled>
               </div>

               <div class="col-100 cta">
                  <button type="button" class="primary-button move-next">Next</button>
               </div>

            </div>

         </form>

      </div>
</div>

<script>
function getVPermission(){
	
	$(".content-form .inner-title").hide();
	let visitor_permission = $('input[name="visitor_permission"]:checked').val();
	if(visitor_permission==1) {
		$(".agree-consent").show();
	} else {
		$(".disagree-consent").show();
	}
	console.log(visitor_permission);

}
</script>