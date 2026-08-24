@if($pagename=="silver")
	<div class="add_pdf_main">
		<div class="download_pdf">
			<a class="btn <?php if(ismobile()){ ?>primary-button<?php } else { ?>btn-primary<?php } ?>" download href="{{ asset('assets/pdf/prescriptions/silver-prescriptions.pdf') }}" >
				Download PDF Now 
				<span>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17M7 11L12 16M12 16L17 11M12 16V4" stroke="#EEEFF4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				</span>


			</a>
		</div>
	</div>
@endif

@if($pagename=="gold")
	<div class="add_pdf_main">
				<div class="download_pdf">
					<a class="btn <?php if(ismobile()){ ?>primary-button<?php } else { ?>btn-primary<?php } ?>" download href="{{ asset('assets/pdf/prescriptions/gold-prescriptions.pdf') }}" >Download PDF Now 
						<span>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17M7 11L12 16M12 16L17 11M12 16V4" stroke="#EEEFF4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				</span>

					</a>
				</div>
	</div>
@endif


@if($pagename=="platinum")
	<div class="add_pdf_main">
		<div class="download_pdf">
				<a class="btn <?php if(ismobile()){ ?>primary-button<?php } else { ?>btn-primary<?php } ?>" download href="{{ asset('assets/pdf/prescriptions/platinum-prescriptions.pdf') }}" >Download PDF Now 
					<span>
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17M7 11L12 16M12 16L17 11M12 16V4" stroke="#EEEFF4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
				</span>
			</a>
		</div>
	</div>
@endif

