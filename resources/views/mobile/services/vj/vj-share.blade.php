@extends("mobile.layouts.guest")
@section("content")
<section class="written-journal-head">
        <div class="cust-container-md">
            <div class="header">
                <div class="back">
                    
                </div>
                <div class="title">
                    <p>Record Voice Journal</p>
                </div>
            </div>
        </div>
</section>
<section class="care-cordin my-setting" style="margin-bottom:0px;">
    <div class="cust-container-md">
        <div class="sup-t">
            <p>Record Voice Journal for ( <?= $owner['name'] ?> )</p>
        </div>
        <form>
            <div class="form patient-tab-content">
                <div class="form-row">

                    <div class="col-100 form-group">
                        <label>Enter Your Name</label>
                        <input class="form-control" type="text" id="visitor_name" name="visitor_name" value="<?= @$user['name'] ?>">
                        <input type="hidden" id="visitor_token" value="<?= $data['token'] ?>" />
                    </div>

                    <div class="col-100 form-group">
                        <label>Enter Your Email</label>
                        <input class="form-control" type="text" id="visitor_email" name="visitor_email" value="<?= @$user['email'] ?>">
                    </div>


                </div>
            </div>
        </form>
		
		
		<section class="record-new-journal vj-share-record">
			<div class="cust-container-md">
				<div class="new-jurn">
					<div class="title"><p>Record new journal</p></div>
					<div id="controls" class="new-jun-row">
							<button id="recordButton"  class="voice"><img src="{{ asset('assets/dashboard/assets/images/play-voice-v2-icon-svg.svg') }}" alt="icon"></button>
							<button id="pauseButton" class="voice pause"><img src="{{ asset('assets/dashboard/assets/images/voice-show-icon-svg.svg') }}" alt="icon"></button>
							<button id="stopButton" class="voice stop"><img src="{{ asset('assets/dashboard/assets/images/pouse-icon-svg.svg')}}" alt="icon"></button>
						</div>
						<p id="display" style="display:none;text-align: center;">00:00:00</p>  
						<ol id="recordingsList" class="all-recordings rec-for-visitor recordingsList-v1"></ol>
				</div>
			</div>
		</section>
		
	</div>	
</section>	

<div class='moodContainer content-wrapper'>	
		
    <div class="card--white full-height feels-view voice-journal vj-sharing-child">
       
        
        
       
        
        <?php /*
        <div class="recording-sample-wrap">
            <div id="controls">
          	 <button id="recordButton"><i class="fas fa-microphone-alt"></i> Record</button>
          	 <button id="pauseButton" disabled><i class="fas fa-pause"></i> Pause</button>
          	 <button id="stopButton" disabled><i class="fas fa-stop"></i> Stop</button>
            </div>
            <p id="action" style="display:block;color:grey;font-weight: 800;"></p>
            
            <!-- Custom Code for showing text -->
            <textarea id="output" style="display:none;" placeholder="Create a new note by typing or using voice recognition." rows="6" cols="100"></textarea>
            <p id="display" style="display:none;">00:00:00</p>
            <!-- End of custom Code for showing text -->
            
          	<p><strong>Recordings:</strong></p>

            
			<ol id="recordingsList" class="all-recordings rec-for-visitor"></ol>

           
        </div>
		*/ ?>
        <!-- The Modal -->
        <div class="modal" id="voiceRecModal"  tabindex="-1" role="dialog" aria-labelledby="voiceRecModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Loader icon -->
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
var content = "";
var output = $('#output');
var instructions = $('#action');

var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
var recognization = new SpeechRecognition();
    recognization.continuous = true;

    // This block is called every time the Speech APi captures a line. 
    recognization.onresult = function(event) {
    
      // We only need the current one.
      var current = event.resultIndex;
    
      // Get a transcript of what was said.
      var transcript = event.results[current][0].transcript;
    
      var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);
    
      if(!mobileRepeatBug) {
        content += transcript;
        output.val(content);
      }
    };    
    
    // recognization.onstart = function() { 
    //   instructions.text('Voice recognition activated. Try speaking into the microphone.').css("color", "orange");
    // }
    
    // recognization.onspeechend = function() {
    //   instructions.text('You were quiet for a while so voice recognition turned itself off.').css("color", "red");
    // }
    
    recognization.onerror = function(event) {
      if(event.error == 'no-speech') {
        instructions.text('No speech was detected. Try again.').css("color", "red");  
      };
    }
    
    // Sync the text inside the text area with the noteContent variable.
    output.on('input', function() {
      content = $(this).val();
    });
    
    // start of generate a randome token
    
        $(document).ready(function() {
            $("#form-submit").validate();
            $("#generateLink").click(function() {
                var token = generateToken();
                var fullToken = window.location.origin + '/voice-journal/' + token
                // $("#showLink").text(fullToken);
                $("#showLinkText").val(token);
                $("#shareableModal").modal('show');
            });
            
            $(document).on('hidden.bs.modal', '#shareableModal', function () {
                $("#email").val("");
            });
        });

        function generateToken() {
            // Generate a random token
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var tokenLength = 30;
            var token = '';
            for (var i = 0; i < tokenLength; i++) {
                token += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return token;
        }
        
        // Start of AJAX share link
        $(document).on('submit', '#form-submit', function(e) {
            e.preventDefault();
            // Get form data
            $("#subscribeForm").prop("disabled", true);
            var formData = $("#form-submit").serialize();
            $.ajax({
                type: 'POST',
                url: '/voice-journal/send-link',
                data: formData,
                success: function(response) {
                    var json = response;
                    alert(json.message);
                    $("#subscribeForm").prop("disabled", false);
                    if (json.success){
                        window.location.reload();
                    }
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
        // End of AJAX share link
    // end of generate a randome token

</script>
<script src="https://app.iwilltilimwell.com/assets/js/appShareMobile.js" defer></script>
<script src="https://www.imwell.app/js/recorder/recorder.js" defer></script>

<style>
.main-panel { width: 100% !important;margin: 0px !important;}
.generate-min {
    position: relative;
    display: grid;
    grid-template-columns: 35% 1fr;
    gap: 75px;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    padding-top: 15px;
    border-top: 1px solid gray;
}

.recording-sample-wrap {
    padding: 40px 30px;
    border: 1px solid var(--blue-magenta);
    overflow: hidden;
}
.recording-sample-wrap #controls {
    position: relative;
    margin-bottom: 20px;
}
.recording-sample-wrap #controls button:first-child {
    border-radius: 10px 0 0 0;
}
.recording-sample-wrap #controls button:not(:disabled) {
    color: #fff;
    background-color: var(--blue-magenta);
    border-color: #fff;
}
.recording-sample-wrap #controls button {
    background: #f6eff5;
    border: 1px solid #fff;
    color: #160f18;
    transition: all 200ms ease-in;
    padding: 12px 32px;
    font-size: 15px;
    font-weight: 600;
}
.cust-heading, .cust-heading-center {
    font-size: 26px;
    line-height: 50px;
    color: #160f18;
    position: relative;
    text-transform: uppercase;
    font-weight: 700;
    display: block;
    margin-bottom: 26px;
    padding-bottom: 8px;
}
.generate-min #generateLink {
    background: var(--blue-magenta);
    color: #fff;
    border: 1px solid #fff;
    border-radius: 5px;
    transition: all 200ms ease-in;
    padding: 8px 25px;
    font-size: 15px;
    font-weight: 600;
}
.recording-sample-wrap .all-recordings {
    position: relative;
    max-height: 550px;
    overflow-x: auto;
    padding: 0 20px 0 40px;
}
.recording-sample-wrap .all-recordings .all-detail {
    display: grid
;
    grid-template-columns: 57% 26% 17%;
    row-gap: 10px;
    justify-content: center;
    align-items: self-start;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--blue-magenta);
    position: relative;
}
.recording-sample-wrap .all-recordings .all-detail div:first-child {
    max-height: 115px;
    padding-right: 10px;
    overflow-x: auto;
    margin-bottom: 5px;
    font-family: var(--body-font);
    font-size: var(--body-font-size);
    line-height: var(--body-line-height);
    line-height: 22px;
    text-align: justify;
    padding-top: 11px;
}
.recording-sample-wrap .all-recordings .vj-time {
    font-size: 14px;
    text-align: center;
    padding-top: 12px;
}
.recording-sample-wrap #cust-audio-control {
    width: 75%;
    height: 45px;
    margin: 0 auto;
}
.recording-sample-wrap .all-recordings audio {
    text-align: center !important;
    margin: 0 auto;
    padding-bottom: 10px;
}
.recording-sample-wrap .all-recordings .all-detail .autio-con12 {
    display: flex
;
    justify-content: space-evenly;
    align-items: center;
}
.recording-sample-wrap .all-recordings .all-detail a {
    color: var(--blue-magenta) !important;
    font-size: 20px;
    text-align: center !important;
}
.recording-sample-wrap .all-recordings .all-detail .detail {
    grid-row: 1 / span 2;
}
.recording-sample-wrap .all-recordings .all-detail div:nth-child(2) {
    font-size: 12px;
    text-align: center;
}
</style>	

<div class="modal" id="voiceRecModal"  tabindex="-1" role="dialog" aria-labelledby="voiceRecModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Loader icon -->
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?php /*



<section class="care-cordin my-setting" style="margin-bottom:0px;">
    <div class="cust-container-md">
        <div class="sup-t">
            <p>Record Voice Journal for ( <?= $owner['name'] ?> )</p>
        </div>
        <form>
            <div class="form patient-tab-content">
                <div class="form-row">

                    <div class="col-100 form-group">
                        <label>Enter Your Name</label>
                        <input class="form-control" type="text" id="visitor_name" name="visitor_name" value="<?= @$user['name'] ?>">
                        <input type="hidden" id="visitor_token" value="<?= $data['token'] ?>" />
                    </div>

                    <div class="col-100 form-group">
                        <label>Enter Your Email</label>
                        <input class="form-control" type="text" id="visitor_email" name="visitor_email" value="<?= @$user['email'] ?>">
                    </div>


                </div>
            </div>
        </form>
		
		<section class="record-new-journal vj-share-record">
			<div class="cust-container-md">
				<div class="new-jurn">
					<div class="title"><p>Record new journal</p></div>
					<div id="controls" class="new-jun-row">
							<button id="recordButton"  class="voice"><img src="{{ asset('assets/dashboard/assets/images/play-voice-v2-icon-svg.svg') }}" alt="icon"></button>
							<button id="pauseButton" class="voice pause"><img src="{{ asset('assets/dashboard/assets/images/voice-show-icon-svg.svg') }}" alt="icon"></button>
							<button id="stopButton" class="voice stop"><img src="{{ asset('assets/dashboard/assets/images/pouse-icon-svg.svg')}}" alt="icon"></button>
						</div>
						<p id="display" style="display:none;text-align: center;">00:00:00</p>  
				</div>
			</div>
		</section>

    </div>
</section>


@include('mobile.services.vj.recording-script')
*/?>
@endsection 