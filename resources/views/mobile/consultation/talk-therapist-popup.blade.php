<?php 
if(ismobile()){
?>
	<div id="PsyWelcome" class="modal psychology phy-welcome-v51 inthemomntcare" style="display:flex;">
        <div class="modal-content">
			<div class="welcome-header">
				<div class="psy-header">
					<p><strong>Mental Health Crisis & Emergency Resources</strong></p>
				</div>
				<div class="welcome-close">
					<span class="close-modal" onclick="closePsyWelcome('PsyWelcome');">&times;</span>
				</div>
			</div>
			
			<x-modal.mental-health-crisis-emergency-modal />
			 
			<div class="welcome-cta">
				<button type="button" class="primary-button" onclick="closePsyWelcome('PsyWelcome');">
					Close
				</button>
			</div>
        </div>
	</div>
<?php } else { ?>


<div id="upgrade-alert" class="custom-modal journal-modal psy-welcome-v51 inthemomntcare" style="display:flex;">
    <div class="modal-content">
			<div class="welcome-header">
				<div class="psy-header">
					<p><strong>Mental Health Crisis & Emergency Resources</strong></p>
				</div>
				<div class="welcome-close">
					<span class="close-modal" onclick="closePsyWelcome('upgrade-alert');">&times;</span>
				</div>
			</div>
			
			<div class="welcome-v51 ">
				<x-modal.mental-health-crisis-emergency-modal />
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
