@if (
    in_array(request('action'), ['psychiatry','psychology'])
)
<?php 
if(ismobile()){
?>
	<div id="PsyWelcome" class="modal psychology phy-welcome-v51" style="display:flex;">
        <div class="modal-content">
			<div class="welcome-header">
				<div class="psy-header">
					<p><strong>Mental Health Crisis & Emergency Resources</strong></p>
				</div>
				<div class="welcome-close">
					<span class="close-modal" onclick="closePsyWelcome('PsyWelcome');">&times;</span>
				</div>
			</div>
			
			<div class="cust-modal-body">
				<div class="psy-text">
					<div class="text">
						<p>This information is provided for you as resources that you may find beneficial. Close this popup to continue creating your appointment.</p>
					</div>
					
					<div class="title"><p><strong>Phone Support Lines.</strong></p></div>
					<div class="text"><p><strong>Emergency:</strong> <a href="tel:911">Dial 911.</a></p></div>
					<div class="text"><p><strong>National Suicide Prevention Lifeline:</strong> <a href="tel:18002738255">1-800-273-TALK (8255).</a></p></div>
					<div class="text"><p><strong>American Association of Poison Control Centers:</strong><a href="tel:18002221222">1-800-222-1222.</a></p></div>
					<div class="text"><p><strong>National Domestic Violence Hotline:</strong><a href="tel:18007997233">1-800-799-7233.</a></p></div>
					<div class="text"><p><strong>National Association of Anorexia Nervosa and Associated Disorders:</strong><a href="tel:16305771330">1-630-577-1330.</a></p></div>
					<div class="text"><p><strong>National Eating Disorders Association Helpline:</strong><a href="tel:18009312237">1-800-931-2237.</a></p></div>
					<div class="text"><p><strong>Overeaters Anonymous:</strong><a href="tel:15058912664">1-505-891-2664.</a></p></div>
					<div class="text"><p><strong>Planned Parenthood Hotline:</strong> 1-800-230-PLAN (7526).</p></div>
					<div class="text"><p><strong>LGBT Hotline:</strong><a href="tel:18888434564">1-888-843-4564.</a></p></div>
					<div class="text"><p><strong>Trevor Crisis Line (LGBTQ):</strong><a href="tel:18664887386">1-866-488-7386.</a></p></div>
					<div class="text"><p><strong>Substance Abuse and Mental Health Administration Helpline:</strong> <a href="tel:18006624357">1-800-662-HELP (4357).</a></p></div>
					<div class="text"><p><strong>Veterans Crisis Line:</strong><a href="tel:18002738255">1-800-273-8255.</a></p></div>

					<div class="title"><p><strong>Text Support Lines.</strong></p></div>
					<div class="text"><p><strong>Crisis Text Line:</strong> <a href="sms:741741?&body=HOME">Text "HOME" to 741-741.</a></p></div>
					<div class="text"><p><strong>Veterans Crisis Text Line:</strong> Text <a href="sms:838255">838255.</a></p></div>

					<div class="title"><p><strong>Online Resources.</strong></p></div>
					<div class="text"><p><strong>SAFE Network:</strong><a href="https://www.selfinjury.org/">www.selfinjury.org.</a></p></div>
					<div class="text"><p><strong>Veterans Crisis Line:</strong><a href="https://www.veteranscrisisline.net/">www.veteranscrisisline.net.</a></p></div>
					<div class="text"><p><strong>National Eating Disorders Association:</strong><a href="https://www.nationaleatingdisorders.org/">www.nationaleatingdisorders.org.</a></p></div>
					<div class="text"><p><strong>Suicide Prevention Wiki:</strong><a href="https://findahelpline.com/">www.findahelpline.com.</a></p></div>
				</div>
				
			</div>
			<div class="welcome-cta">
				<button type="button" class="primary-button" onclick="closePsyWelcome('PsyWelcome');">
					Close
				</button>
			</div>
        </div>
	</div>
<?php } else { ?>


<div id="upgrade-alert" class="custom-modal journal-modal psy-welcome-v51" style="display:flex;">
    <div class="modal-content">
			<div class="welcome-header">
				<div class="psy-header">
					<p><strong>Mental Health Crisis & Emergency Resources</strong></p>
				</div>
				<div class="welcome-close">
					<span class="close-modal" onclick="closePsyWelcome('upgrade-alert');">&times;</span>
				</div>
			</div>
			
			<div class="welcome-v51">
				<div class="cust-modal-body">
					<div class="psy-text">
						<div class="text">
							<p>This information is provided for you as resources that you may find beneficial. Close this popup to continue creating your appointment.</p>
						</div>						
						<div class="title"><p><strong>Phone Support Lines.</strong></p></div>
						<div class="text"><p><strong>Emergency:</strong> <a href="tel:911">Dial 911.</a></p></div>
						<div class="text"><p><strong>National Suicide Prevention Lifeline:</strong> <a href="tel:18002738255">1-800-273-TALK (8255).</a></p></div>
						<div class="text"><p><strong>American Association of Poison Control Centers:</strong> <a href="tel:18002221222">1-800-222-1222.</a></p></div>
						<div class="text"><p><strong>National Domestic Violence Hotline:</strong> <a href="tel:18007997233">1-800-799-7233.</a></p></div>
						<div class="text"><p><strong>National Association of Anorexia Nervosa and Associated Disorders:</strong><a href="tel:16305771330">1-630-577-1330.</a></p></div>
						<div class="text"><p><strong>National Eating Disorders Association Helpline:</strong><a href="tel:18009312237">1-800-931-2237.</a></p></div>
						<div class="text"><p><strong>Overeaters Anonymous:</strong><a href="tel:15058912664">1-505-891-2664.</a></p></div>
						<div class="text"><p><strong>Planned Parenthood Hotline:</strong> <a href="tel:18002307526">1-800-230-PLAN (7526).</a></p></div>
						<div class="text"><p><strong>LGBT Hotline:</strong><a href="tel:18888434564">1-888-843-4564.</a></p></div>
						<div class="text"><p><strong>Trevor Crisis Line (LGBTQ):</strong><a href="tel:18664887386">1-866-488-7386.</a></p></div>
						<div class="text"><p><strong>Substance Abuse and Mental Health Administration Helpline:</strong> <a href="tel:18006624357">1-800-662-HELP (4357).</a></p></div>
						<div class="text"><p><strong>Veterans Crisis Line:</strong><a href="tel:18002738255">1-800-273-8255.</a></p></div>

						<div class="title"><p><strong>Text Support Lines.</strong></p></div> 
						<div class="text"><p><strong>Crisis Text Line:</strong><a href="sms:741741?&body=HOME">Text "HOME" to 741-741.</a></p></div>
						<div class="text"><p><strong>Veterans Crisis Text Line:</strong> <a href="sms:838255">Text 838255.</a></p></div>

						<div class="title"><p><strong>Online Resources.</strong></p></div>
						<div class="text"><p><strong>SAFE Network:</strong><a href="https://www.selfinjury.org/">www.selfinjury.org.</a></p></div>
						<div class="text"><p><strong>Veterans Crisis Line:</strong><a href="https://www.veteranscrisisline.net/">www.veteranscrisisline.net.</a></p></div>
						<div class="text"><p><strong>National Eating Disorders Association:</strong> 
							<a href="https://www.nationaleatingdisorders.org/">www.nationaleatingdisorders.org.</a></p></div>
						<div class="text"><p><strong>Suicide Prevention Wiki:</strong> <a href="http://www.findahelpline.com/">www.findahelpline.com.</a></p></div>
					</div>
				</div>
				<div class="welcome-cta">
					<button type="button" class="btn primary-button" onclick="closePsyWelcome('upgrade-alert');">
						Close
					</button>
				</div>
			</div>
    </div>
</div>

<?php } ?>
<script>
function closePsyWelcome(type) {
	$("#"+type).removeAttr("style");
}
</script>
@endif