<div class="patient-tab-content  reason-visite-content" style="display:none">
    <div class="pat-title"><p>What Is the Reason for Today’s Visit?</p></div>
    <div class="sub-detail"></div>
    <form>
        <div class="col-100 form-group">
            <label>Please describe the reason(s) in detail<span class="required-ico">*</span>:</label>
            <textarea placeholder="(required)" rows="5" id="reason_for_visit"></textarea>
        </div>
		
		@if($action === 'dermatology')
			
			<div class="dermat-main-v1">
				<div class="dermat-title">
					<p>Please upload at least two images.(JPG, PNG, JPEG)</p>
				</div>
						
				<div class="dermatology-img-section">
					<div class="col-100 form-group">
						
						<div class="image-group">
							<div id="uploadStatus_html"></div>
						</div>
							
						<div class="upload-file">
							<input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" required>
						</div>
								
						<div class="progres-area">
							<div class="progress mt-2" style="height: 20px; display: none;">
								<div id="uploadProgress" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
							</div>
						</div>
								
						<div class="error-message">
							<div id="uploadStatus"></div>
						</div>
					</div>
							
				</div>
			</div>
		
		@endif
		
		<div class="col-100 cta mt-2">
            <div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                <a href="javascript:void(0)" class="outline-button " onclick="backtophone()">Back</a>
                <button class="primary-button" type="button" onclick="return reasonforvisitSubmit()">Next</button>
            </div>
        </div>
    </form>
</div>