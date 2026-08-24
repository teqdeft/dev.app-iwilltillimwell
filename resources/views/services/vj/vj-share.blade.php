@extends('layouts.v1.guest')
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
								           
							</div>              
						</div>            
					</div>          
				</div>        
			</div>      
		</div>    
	</div>	
    <div class="card--white full-height feels-view voice-journal vj-sharing-child">
       
        <div class="generate-min">
		
			<div class="title-heading">	
				<h4>Record Voice Journal for ( <?= $owner['name'] ?> )</h4>
			</div>
			
			<div class="form-vj">	
				<form class="forms-sample" method="post" id="" action="/" novalidate="novalidate">
                                                              
								
					<div class="row ">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="visitor_name">Enter Your Name</label>
								<input type="text" name="visitor_name" class="form-control" id="visitor_name"  autocomplete="off">
								<input type="hidden" id="visitor_token" value="<?= $data['token'] ?>" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="visitor_email">Enter Your Email</label>
								<input type="email" class="form-control" name="visitor_email" id="visitor_email" autocomplete="off">
																		</div>
						</div>
						
						<div class="col-sm-12 errormsg-vjshare">
							
						</div>
						
						
					</div>
				   
				</form>		
		
            
			</div>
        </div>
        
       
        
        
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
        <!-- The Modal -->
        
        
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
<script src="{{ asset('js/appShare.js') }}" defer></script>
<script src="{{ asset('js/recorder.js') }}" defer></script>

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

    
    #loader-wrapper {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #00000080;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

 
    .loader {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #604377;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }

  
    @keyframes  spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    #content {
      display: none1;
    }
  </style>	

<div id="voiceRecModal" class="custom-modal journal-modal">
    <div class="modal-content">
        <div class="modal-body">
            <div class="complete-form">	
				<div class="upgrade-text">	
					<div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                            <p>Please wait...</p>
                    </div>	
				</div> 
			</div>
        </div>
    </div>
</div>	

<div id="loader-wrapper" style="display:none;"><div class="loader"></div></div>


		
@endsection 