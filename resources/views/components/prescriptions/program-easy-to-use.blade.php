@if($pagename=="platinum")
	<div class="program-row mt-4">
		<div class="program-title">
			<p>The Program is easy to use:</p>
		</div>
	</div>
	<div class="easy-to-use-1">
		<div class="easy-detail">
			<p>You will receive an email from iWILL 'til i'mWELL to help you set up your BestChoiceRx account. The email will include your Member/Group ID along with all further instructions. Just click on the "Download PDF Now" button to get started.</p>
		</div>
	</div>
@endif

@if($pagename=="gold")
	<div class="program-row">
                <div class="easy-title program-title">
                    <p>The Program is easy to use:</p>
                </div>
                <div class="easy-detail">
                    <p>You will receive an electronic member card that can be presented at any retail pharmacy — over 70,000 in network. If the medication is on the formulary, you only pay $5.00. If your medication is not on the $5.00 formulary, your out-of-pocket cost will be based on a significantly discounted price.</p>
					
                    <p>All future recurring medications will be mailed directly to you for just ${{$payamount}} (see subscription details). Plus, get discounts on diabetic supplies, pet medications, and other prescription medication savings.</p>
					
                </div>
    </div>
@endif

@if($pagename=="silver")
	<div class="program-row">
                <div class="easy-title program-title">
                    <p>The Program is easy to use:</p>
                </div>
                <div class="easy-detail">
                    <p>You will receive an electronic membership card that can be presented at any retail pharmacy (over 70,000 in network) and, if on the formulary, you pay nothing. If it is not on the $0.00 formulary, your out-of-pocket cost will be based on a deeply discounted price.</p>
                    <p>Present your Rx Card to the pharmacy of your choice. Your Rx Card will display your BIN, Group Number and PCN to present to the pharmacist. You will pay nothing at the pharmacy.</p>
                </div>
    </div>
@endif	