@extends('layouts.v1.dashboard')
@section('content')
<div class='moodContainer content-wrapper'>	
	<div class="row">      
		<div class="col-md-12 grid-margin">        
			<div class="row">          
				<div class="col-12 col-xl-6 mb-4 mb-xl-0">            
					<div class="patient-details ">              
						<div class="media">                
							<div class="title-heading-icon-box-cus">                  
								<i class="far fa-calendar-alt"></i>                
							</div>               
							<div class="media-body">                  
								<h3 class="font-weight-bold"> My Voice Journal</h3>                  
								<h6 class="font-weight-normal mb-0"></h6>                
							</div>              
						</div>            
					</div>          
				</div>        
			</div>      
		</div>    
	</div>	
    <div class="card--white full-height feels-view voice-journal">
       
        @if(!LoginUserBToBVerification())
            {{ LoginUserBToBVerificationMSG() }}
        @else           


        <!-- start generate link -->
        <div class="generate-min">
            <div class="left">
                <div class="hear-send-link">
                    <h3 class="here-send">Hear from friends and family</h3>
                    <p class="detail">Send an invitation to someone that enables the recording of a brief affirmation or uplifting message of encouragement.</p>
                </div>
            </div>
            <div class="right">
                <div class="genert-link">
                    <button id="generateLink" title='Clicking here sends a secure automated link allowing the recipient to record an uplifting message that populates into the "Requested Affirmations" section in your Mental Health Menu.'><i class="fas fa-link"></i> Send Link</button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="shareableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <form id="form-submit-mail=share">
                    @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send shareable link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <p id="showLink"></p>
                      <div class="test-12">
                        <div class="form-group">
                            <label for="email">Name*</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required >
                            <p id="email-error"></p>
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required >
                            <p id="email-error"></p>
                            <small id="emailHelp" class="form-text text-muted">We'll share link to this email.</small>
                            
                            <label for="email">Message</label>
                            <textarea class="form-control" rows="4" cols="50" name="message" id="emailMsg" placeholder="Enter message here..."></textarea>
                            <input type="hidden" value="" name="share_token" id="showLinkText">
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" id="subscribeForm" class="btn btn-primary" value="Send" onclick="ShareNow()">
                  </div>
                </form>
            </div>
          </div>
        </div>
        <!-- end start generate link -->
        
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

          	<ol id="recordingsList" class="all-recordings">
      	    <?php if (!empty($data)) { ?>
              	<?php foreach($data as $row): ?>
                        <li class="all-detail">
                            <div class="detail"><p><?= $row['voice_text'] ?> </p></div>
                            <div class="name"><p><?= $row['link_visitor'] ?> </p></div>
                            <div class="vj-time">
                                <b><?= convertDateToUserTimeZone($row['created_at']); ?></b>
                            </div>
                            <audio controls id="cust-audio-control">
                              <source src="<?= asset('audio/' . $row['file_name']) ?>" type="audio/wav">
                            </audio>
                            <div class="autio-con12">
                                <a href="<?= asset('audio/' . $row['file_name']) ?>" download><i class="fas fa-download"></i> </a>
                                
								<a href="javascript:void(0);" data-recording-id="<?= $row['id'] ?>"  class="deleteByAjax" data-url="{{url('my-journal-audio-deleted')}}/<?= $row['id'] ?>">
									<i class="fas fa-trash-alt"></i>
								</a>
                            </div>
                        </li>
                <?php endforeach ?>
            <?php } ?>
            </ol>
            <?php if(empty($data)) { ?>
      	        <p id="no-data">
                  <b>No Voice Journal Found.</b>
                </p>
            <?php } ?>
        </div>
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
        @endif
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
<script src="{{ asset('assets/dashboard/assets/js/recorder/app.js') }}" defer></script>
<script src="https://www.imwell.app/js/recorder/recorder.js" defer></script>

<script>
    
 function ShareNow() {

var share_token = generateToken();
$("#showLinkText").val(share_token);
 let name=$("#name").val();   
 let email=$("#email").val();   
 let message = $("#emailMsg").val();
if(!name) {
    toastr.warning("Name Required");
    return false;
}
if(!email) {
    toastr.warning("Email Required");
    return false;
}

toastr.info('Please wait...', 'Processing', {
        timeOut: 0,
        extendedTimeOut: 0,
    });

$(".primary-button").hide();    
let formData = new FormData(); 
formData.append("_token", $('meta[name="csrf-token"]').attr("content")); 
formData.append("name",name); 
formData.append("email",email);
formData.append("message",message);
formData.append("share_token",share_token);    

console.log(formData);


$.ajax({
        url: "{{ url('voice-journal/send-link')}}",
        type: "POST",
        data: formData,
        processData: false, 
        contentType: false, 
        success: function(response) {
            toastr.clear();
             if(response.success) {
                toastr.success(response.message);    
                location.reload();
             }   else {
                $(".primary-button").show();    
                toastr.error(response.message);    
             } 
          
            
        },
        error: function(xhr) {
            console.log("Error:", xhr.responseText);
        }
    });

}
</script>
<style>

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
@endsection
