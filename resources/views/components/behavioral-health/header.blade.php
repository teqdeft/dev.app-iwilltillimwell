<?php 
if(ismobile()){
	?>
	<div class="content">
		<h2 class="top-title therap">Behavioral Health Virtual Counseling PLUS</h2>
        <div class="detail-v1">
		
			<p>Whether you have questions about handling stress at work or at home; parenting or child care; or managing money or health care, you can turn to your behavioral health virtual counseling team for confidential support you can trust. We offer short-term therapy and behavioral health support for your mental and emotional well-being.</p>

        </div>
        <div class="image therap"><img src="{{ asset('assets/dashboard/assets/images/therapist.png') }}" alt="image" /></div>
        <div class="repeat-content">
			<div class="title"><p>When life gets complicated, let us help. Speak with a professional counselor via phone or video call.</p></div>
        </div>
    </div>
	<?php 
} else {
?>
<div class="bhhavioral-contact-wrapper  mb-4">
    <div class="row">
        <div class="col-sm-12"></div>
        <div class="col-xl-5">
                       <div class="inner-behavior-img mb-3 mb-xl-0">
                          <img src="{{ asset('assets/assets/images/call-img.jpg') }}"  alt="call-img"/>
                       </div>
        </div>
        <div class="col-xl-7">
                       <div class="inner-behavior-content">
                         <div class="behavior-heading-title mb-3">
                           <h3 class="theme-color text-capitalize">When life gets complicated, let us help. Speak with a professional counselor via phone or video call.</h3>
						   <div class="content">
							<p class="fs-18">Whether you have questions about handling stress at work or at home; parenting or child care; or managing money or health care, you can turn to your behavioral health virtual counseling team for confidential support you can trust. We offer short-term therapy and behavioral health support for your mental and emotional well-being.</p>
						   </div>

                         </div>

						
                       </div>
        </div>
    </div>
</div>
<?php } ?>