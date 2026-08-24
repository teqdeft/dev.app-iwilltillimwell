<?php 
if(ismobile()) {
	?>
	<div class="accordion">
		<div class="accordion-item mod-emot-card active">
			<button class="accordion-header">Primary Emotions.<span class="accordion-icon">+</span></button>
			<div class="accordion-content">
				<div class="detail"><p>Primary emotions are the body's first responses to something that has happened. They are adaptive because they make us react a certain way without being influenced or examined. These emotions are very easy to identify because they are so strong. They are instinctual, primal, survival responses.</p></div>
				<div class="image"><img src="{{ asset('assets/dashboard/assets/images/emotion-v1.png')}}" alt="image" /></div>
			</div>
		</div>
		<div class="accordion-item mod-emot-card">
			<button class="accordion-header">Secondary Emotions.<span class="accordion-icon">+</span></button>
			<div class="accordion-content">
				<div class="detail"><p>Secondary emotions are much more complex because they often refer to the feelings you have about a primary emotion. These are learned emotions that we acquire from our parents or primary caregivers as we grow up.</p></div>
				<div class="image"><img src="{{ asset('assets/dashboard/assets/images/emotion-v2.png')}}" alt="image" /></div>
			</div>
		</div>
		<div class="accordion-item mod-emot-card">
			<button class="accordion-header">Instrumental Emotions.<span class="accordion-icon">+</span></button>
			<div class="accordion-content">
			
				<div class="detail"><p>Secondary emotions can also be further categorized as instrumental emotions. These are unconscious and habitual. We learn instrumental emotions during childhood as a form of conditioning. For example, when we cry, a parent comes to soothe us, so we learn to use the facial expressions and responses associated with crying when we need that soothing or sense of security.</p></div>
				
				<div class="image"><img src="{{ asset('assets/dashboard/assets/images/emotion-v3.png')}}" alt="image" /></div>
			</div>
		</div>
	</div>
	<?php 
} else { 
?>
<div class="row">
					<div class="col-md-12">
						<div class="clinical-service-content-box mb-4">
							<div class="inner-clinical-service-content-box">
							<h3 class="theme-color">Primary Emotions</h3>
							<p class="fs-18">Primary emotions are the body's first responses to something that has happened. They are adaptive because they make us react a certain way without being influenced or examined. These emotions are very easy to identify because they are so strong. They are instinctual, primal, survival responses.</p>
							</div>
						</div>
						<div class="clinical-service-content-box mb-4">
							<div class="inner-clinical-service-content-box">
								<h3 class="theme-color">Secondary Emotions</h3>
								<p class="fs-18">Secondary emotions are much more complex because they often refer to the feelings you have about a primary emotion. These are learned emotions that we acquire from our parents or primary caregivers as we grow up.</p>
							</div>
						</div>
						<div class="clinical-service-content-box">
							<div class="inner-clinical-service-content-box">
								<h3 class="theme-color">Tertiary Emotions</h3>
								<p class="fs-18">Secondary emotions can also be further categorized as instrumental emotions. These are unconscious and habitual. We learn instrumental emotions during childhood as a form of conditioning. For example, when we cry, a parent comes to soothe us, so we learn to use the facial expressions and responses associated with crying when we need that soothing or sense of security.</p>
							</div>
						</div>
					</div>
</div>
<?php } ?>