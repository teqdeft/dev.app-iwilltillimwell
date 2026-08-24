<?php 
use Carbon\Carbon;
 
$description_demo = array("I am a Clinical Psychologist who provides a safe, trusting, nonjudgmental, and respectful environment in which my clients are able to work through their difficult issues. My goal is to promote positive and lasting changes for my clients by helping them to develop insight and providing them with real tools and coping skills so that they can overcome their obstacles and achieve optimal mental and emotional health. I am direct, yet I allow my clients to set the pace of the therapeutic process. I strive to help my clients to feel good about themselves, their relationship, and their place in this world.I specialize in Cognitive Behavioral Therapy, which is a solution-focused therapy that teaches clients to change their negative and distorted thought patterns while learning positive behavioral techniques. Cognitive Behavioral Therapy requires the client and the therapist to work collaboratively as a team. This aim for Cognitive Behavioral Therapy is to help clients to learn how to be their own therapist so that they can cope with the difficult situation that is bringing them to therapy as well as situations that may arise in the future.My areas of expertise include depression, anxiety, weight management, eating disorders, grief/loss, substance abuse, LBGT issues, teen issues (school, emotional, behavioral/family), young adult issues (career, transition, relationships), and personal growth.","Women Focused Therapy and Issues. “Hope is the thing with feathers that perches in the soul and sings the tune without the words and never stops at all.” – Emily Dickinson Often when people are coping with difficult issues in their lives, they do so in silence and isolation. As a psychologist, I want my clients to know they are not alone, and that there is hope. It is important for clients to feel safe to express their feelings openly. It is vital that insight be gained into one’s behavior and how your thoughts and actions can impact the way you feel.Your feelings will be recognized and validated, and you will be supported throughout your journey. Often feelings of helplessness lead to hopelessness. I want you to know that these feelings can change, and be replaced by feelings of strength and excitement for the future.As a Licensed Psychologist I work with female clients to help them recognize their courage, power,and unimaginable resiliency. I utilize a very proactive approach and strongly believe learning
techniques you can utilize in real life helps us to feel that we are in control of our bodies and emotions and that we get to dictate the life we want to lead."); 
if ($doctore_list['success'] && $doctore_list['totalPages'] > 0) {
	foreach($doctore_list['available_providers'] as $data) {
		
		$name = $data['firstName']." ".$data['lastName'];
		$short_bio = Str::limit($data['bio'], 120);
		$full_description = $data['bio'];
		$provider_id  = $data['user_id'];
		$price = str_replace("$","",$data['fee']);
		if($price =="FREE") {
			$price = 0;
		}
		
		$baseUrl = "https://staging.getlyric.com";
		$bioImagePath = $data['bioImagePath'] ?? '';
		$doctore_profile = $baseUrl . $bioImagePath;

		$headers = @get_headers($doctore_profile);
		$isValid = $headers && strpos($headers[0], '200') !== false;

		if(!$isValid) {
			$doctore_profile = asset('assets/images/dr-profile-img.svg');
		}
		
		$full_description = $description_demo[array_rand($description_demo)];
		$short_bio = Str::limit($full_description, 120);
?>
<div class="select-doc-card">
	<div class="doc-row">

		<div class="dr-img">
			<img src="<?php echo $doctore_profile?>">
		</div>
		<div class="detal">
            <div class="name-row">
                <div class="name"><p><?php echo $name?></p></div>
                <div class="free"><p><?php echo ucfirst(strtolower($data['fee']))?></p></div>
            </div>
            <div class="deta-rw"><div class="col-d"><p><?php echo $data['specialties']?></p></div>
            <div class="col-d"><p></p></div>
            </div>
            <div class="ful-d bio-section">
				<p class="short-bio">
					<span><?php echo $short_bio?></span>
					<span><a class="read-more-bio" href="javascript:void(0)"> Read more</a></span>
				</p>
				<p class="full-bio" style="display:none;">
					<span><?php echo $full_description?></span>
					<span><a class="read-more-bio-less" href="javascript:void(0)"> Less</a></span>
				</p>
			</div>
            </div>
	</div>	
	
	
                                            
                                                
                                                
                                            

                                            <div class="slot-list">
                                                <div class="doc-mid">
                                                    <div class="left">
                                                        <p>Available time slot</p>
                                                    </div>
                                                    <div class="free">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="slot-row">
												<?php 
												foreach($data['available_time_slots'] as $item) {
													$time_slot_id  =  $item['providerschedule_id'];
													$startTime  =  $item['startTime'];
													?>
                                               <button 
											onclick="saveDoctore(<?php echo $provider_id?>,<?php echo $time_slot_id?>,'<?php echo $price?>','<?php echo $startTime?>')" type="button" class="cust-tag-btn  time-slot-<?php echo $time_slot_id?>">
														<?php echo $item['display']?>
													
													</button>
												<?php } ?>	
													
													
                                                </div>
                                            </div>
											
											<div class="no-more-dr">
												<p>** All times are in GMT+5:30</p>
											</div>                                     
</div>
<?php } 
} else {
?>
<div class="select-doc-card">
	<div class="doc-row no-doctore-list" style="display: block;">
		<span>Sorry, No Doctor Available</span>
	</div>
</div>	
<?php 	
	
}
?>