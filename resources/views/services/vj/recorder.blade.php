@extends('layouts.v1.dashboard')
@section('content')
{{-- Voice journal, redesigned. Every id and class app.js binds to is kept
     exactly as it was (#controls, #recordButton, #pauseButton, #stopButton,
     #action, #output, #display, #recordingsList, li.all-detail, .detail,
     .autio-con12, #no-data, #voiceRecModal) - this is presentation only. --}}
<div class='moodContainer content-wrapper vj-page'>

	<div class="vj-topbar">
		<span class="vj-topbar__icon"><i class="far fa-calendar-alt"></i></span>
		<h3>My Voice Journal</h3>
	</div>

	<div class="card--white full-height feels-view voice-journal">

		@if(!LoginUserBToBVerification())
			{{ LoginUserBToBVerificationMSG() }}
		@else

		<!-- start generate link -->
		<div class="generate-min vj-invite">
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

		<div class="recording-sample-wrap vj-studio">

			<div class="vj-studio__grid" id="vjStage">

				<div class="vj-studio__controls">
					<div id="controls">
						<button id="recordButton"><i class="fas fa-microphone-alt"></i> Record</button>
						<button id="pauseButton" disabled><i class="fas fa-pause"></i> Pause</button>
						<button id="stopButton" disabled><i class="fas fa-stop"></i> Stop</button>
					</div>
					<h4 class="vj-studio__lead">Speak from the heart</h4>
					<p class="vj-studio__sub">Your voice matters. Record a short message of support, love or encouragement.</p>
					<p id="action" style="display:block;color:grey;font-weight: 800;"></p>
				</div>

				<div class="vj-studio__stage">
					<div class="vj-stage__visual">
						<span class="vj-wave" aria-hidden="true">
							<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
						</span>
						<span class="vj-mic" aria-hidden="true"><i class="fas fa-microphone"></i></span>
						<span class="vj-wave" aria-hidden="true">
							<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
						</span>
					</div>
					{{-- app.js writes the elapsed time here and toggles it with
					     show()/hide(), so the id and inline display must stay. --}}
					<p id="display" style="display:none;">00:00:00</p>
					<p class="vj-stage__hint">Recording limit 3:00</p>
				</div>

				<aside class="vj-tips">
					<h5 class="vj-tips__head"><span class="vj-tips__icon"><i class="far fa-lightbulb"></i></span> Quick Tips</h5>
					<ul>
						<li><i class="fas fa-check"></i> Find a quiet place</li>
						<li><i class="fas fa-check"></i> Keep it short (10&ndash;60 seconds)</li>
						<li><i class="fas fa-check"></i> Speak naturally</li>
						<li><i class="fas fa-check"></i> Share from the heart &#128156;</li>
					</ul>
				</aside>

			</div>

			<!-- Custom Code for showing text -->
			<textarea id="output" style="display:none;" placeholder="Create a new note by typing or using voice recognition." rows="6" cols="100"></textarea>
			<!-- End of custom Code for showing text -->

			<div class="vj-list">
				<div class="vj-list__head">
					<div class="vj-list__title">
						<h4>Recordings</h4>
						<p>Your recorded messages will appear here.</p>
					</div>
					<select id="vjSortOrder" class="vj-sort" aria-label="Sort recordings">
						<option value="newest">Newest first</option>
						<option value="oldest">Oldest first</option>
					</select>
				</div>

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
						<span class="vj-empty__icon"><i class="far fa-comment-dots"></i></span>
						<b>No Voice Journal Found.</b>
						<span class="vj-empty__sub">Start by recording or ask someone to send you a message.</span>
					</p>
				<?php } ?>
			</div>
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
</div>

<script>
// Presentation only - these listeners are additive and never stop, alter or
// re-order anything app.js does with the same buttons.
(function () {
	function ready(fn) {
		if (document.readyState !== 'loading') { fn(); }
		else { document.addEventListener('DOMContentLoaded', fn); }
	}

	ready(function () {
		var stage = document.getElementById('vjStage');
		var recordBtn = document.getElementById('recordButton');
		var pauseBtn = document.getElementById('pauseButton');
		var stopBtn = document.getElementById('stopButton');

		// Animate the waveform only while a recording is actually running.
		if (stage && recordBtn && pauseBtn && stopBtn) {
			recordBtn.addEventListener('click', function () {
				stage.classList.add('is-recording');
			});
			pauseBtn.addEventListener('click', function () {
				stage.classList.toggle('is-recording');
			});
			stopBtn.addEventListener('click', function () {
				stage.classList.remove('is-recording');
			});
		}

		// Reorder the existing list items; nothing is fetched or re-rendered.
		var sort = document.getElementById('vjSortOrder');
		var list = document.getElementById('recordingsList');
		if (sort && list) {
			sort.addEventListener('change', function () {
				var items = Array.prototype.slice.call(list.children);
				items.reverse();
				items.forEach(function (li) { list.appendChild(li); });
			});
		}
	});
})();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
var content = "";
var output = $('#output');
var instructions = $('#action');

var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
var recognization = new SpeechRecognition();
    // Chrome only finalises a result once it hears a clear silence, so a
    // continuous session returned one unbroken block of text however long the
    // user spoke. Ending the session after each utterance instead gives one
    // result per phrase - which formatVoiceTranscript() turns into a sentence -
    // so we restart it ourselves for as long as the user is still recording.
    recognization.continuous = false;

    // Does the user still expect dictation to be running? app.js drives
    // recording through recognization.start()/stop(), so wrap those rather
    // than reaching into the recorder logic.
    var vjListening = false;
    var vjStart = recognization.start.bind(recognization);
    var vjStop = recognization.stop.bind(recognization);

    recognization.start = function() {
      vjListening = true;
      try { vjStart(); } catch (e) { /* already running */ }
    };

    recognization.stop = function() {
      vjListening = false;
      vjStop();
    };

    recognization.onend = function() {
      if (!vjListening) { return; }
      // Chrome throws if restarted in the same tick that ended the session.
      setTimeout(function() {
        if (!vjListening) { return; }
        try { vjStart(); } catch (e) { /* restart raced with stop */ }
      }, 250);
    };

    // This block is called every time the Speech APi captures a line. 
    // The Web Speech API returns bare words - no punctuation, no spacing - so
    // every segment used to run straight into the previous one. This tidies the
    // transcript as it arrives: a space between segments, a capital letter to
    // start each sentence, and a full stop where the speaker paused. Spoken
    // punctuation ("comma", "full stop", "question mark", "new line") is
    // honoured too, the way dictation tools normally behave.
    function formatVoiceTranscript(existing, transcript) {
      var text = (transcript || '').trim();
      if (!text) { return existing; }

      // Spoken punctuation -> the real mark.
      text = text
        .replace(/\b(full stop|period)\b/gi, '.')
        .replace(/\bcomma\b/gi, ',')
        .replace(/\bquestion mark\b/gi, '?')
        .replace(/\bexclamation (mark|point)\b/gi, '!')
        .replace(/\bnew (line|paragraph)\b/gi, '\n');

      // Tidy the spacing those replacements leave behind.
      text = text.replace(/\s+([.,?!])/g, '$1')
                 .replace(/([.,?!])(?=[^\s])/g, '$1 ')
                 .replace(/[^\S\n]{2,}/g, ' ')
                 .replace(/[^\S\n]*\n[^\S\n]*/g, '\n')
                 .replace(/\bi\b/g, 'I')
                 .trim();
      if (!text) { return existing; }

      var out = existing || '';

      // A pause between segments reads as the end of a sentence.
      if (out && !/[.,?!\n]\s*$/.test(out)) {
        out = out.replace(/\s+$/, '') + '.';
      }
      if (out && !/\n$/.test(out)) { out += ' '; }

      // Capitalise only where a fresh sentence is starting.
      if (!out || /(^|[.?!]\s|\n)$/.test(out)) {
        text = text.charAt(0).toUpperCase() + text.slice(1);
      }

      out += text;

      // app.js refuses to save any transcript containing consecutive dots, so
      // make sure this formatting can never produce them.
      return out.replace(/\.{2,}/g, '.');
    }

    recognization.onresult = function(event) {
    
      // We only need the current one.
      var current = event.resultIndex;
    
      // Get a transcript of what was said.
      var transcript = event.results[current][0].transcript;
    
      var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);
    
      if(!mobileRepeatBug) {
        content = formatVoiceTranscript(content, transcript);
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
      if (event.error == 'not-allowed' || event.error == 'service-not-allowed') {
        // Microphone blocked - stop restarting, or onend would loop forever.
        vjListening = false;
      }

      // Short silences are normal now that the session restarts after every
      // utterance, so only warn once dictation has genuinely stopped.
      if(event.error == 'no-speech' && !vjListening) {
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
<script src="{{ asset('js/recorder.js') }}" defer></script>
<script src="{{ asset('assets/dashboard/assets/js/recorder/app.js') }}" defer></script>

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
/* Voice journal - everything is scoped under .vj-page so no other screen that
   shares these class names (.detail, .all-detail, .generate-min) is affected. */
.vj-page {
	--vj-purple: #6B2FA0;
	--vj-purple-dark: #4E1E78;
	--vj-purple-soft: #F3EDFA;
	--vj-ink: #1F1A2B;
	--vj-muted: #6E6880;
	--vj-line: #E7E1F0;
}

.vj-page .vj-topbar {
	display: flex;
	align-items: center;
	gap: 12px;
	margin-bottom: 18px;
}
.vj-page .vj-topbar__icon {
	width: 40px;
	height: 40px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 10px;
	background: var(--vj-purple-soft);
	color: var(--vj-purple);
	font-size: 17px;
}
.vj-page .vj-topbar h3 {
	margin: 0;
	font-size: 22px;
	font-weight: 700;
	color: var(--vj-ink);
}

.vj-page .card--white.voice-journal {
	background: #fff;
	border-radius: 16px;
	padding: 22px;
	box-shadow: 0 2px 14px rgba(31, 26, 43, .06);
}

/* ---- invite ---- */
.vj-page .vj-invite {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 24px;
	flex-wrap: wrap;
	padding: 0 0 20px;
}
.vj-page .vj-invite .here-send {
	margin: 0 0 6px;
	font-size: 24px;
	font-weight: 700;
	color: var(--vj-ink);
}
.vj-page .vj-invite .detail {
	margin: 0;
	max-width: 560px;
	color: var(--vj-muted);
	font-size: 14px;
	line-height: 1.5;
}
.vj-page .vj-invite #generateLink {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	border: 0;
	border-radius: 10px;
	padding: 12px 22px;
	background: var(--vj-purple);
	color: #fff;
	font-size: 15px;
	font-weight: 600;
	white-space: nowrap;
	transition: background .2s ease;
}
.vj-page .vj-invite #generateLink:hover { background: var(--vj-purple-dark); }

/* ---- studio ---- */
.vj-page .vj-studio {
	border: 1px solid var(--vj-line);
	border-radius: 14px;
	padding: 20px;
	background: #fff;
}
.vj-page .vj-studio__grid {
	display: grid;
	grid-template-columns: minmax(240px, 1fr) minmax(260px, 1.1fr) minmax(220px, .9fr);
	gap: 24px;
	align-items: center;
}

.vj-page #controls {
	display: flex;
	gap: 10px;
	flex-wrap: wrap;
	margin-bottom: 16px;
}
.vj-page #controls button {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	border: 1px solid var(--vj-line);
	border-radius: 10px;
	padding: 11px 18px;
	background: var(--vj-purple-soft);
	color: var(--vj-ink);
	font-size: 14px;
	font-weight: 600;
	transition: background .2s ease, color .2s ease, opacity .2s ease;
}
.vj-page #controls #recordButton {
	background: var(--vj-purple);
	border-color: var(--vj-purple);
	color: #fff;
}
.vj-page #controls button:disabled { opacity: .55; cursor: not-allowed; }
.vj-page #controls button:not(:disabled):hover { border-color: var(--vj-purple); }

.vj-page .vj-studio__lead {
	margin: 0 0 4px;
	font-size: 17px;
	font-weight: 700;
	color: var(--vj-ink);
}
.vj-page .vj-studio__sub {
	margin: 0;
	font-size: 13px;
	line-height: 1.5;
	color: var(--vj-muted);
}
.vj-page #action { margin: 10px 0 0; font-size: 13px; }

/* ---- stage ---- */
.vj-page .vj-studio__stage { text-align: center; }
.vj-page .vj-stage__visual {
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 14px;
}
.vj-page .vj-mic {
	width: 74px;
	height: 74px;
	flex: 0 0 auto;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 50%;
	background: var(--vj-purple);
	color: #fff;
	font-size: 26px;
	box-shadow: 0 0 0 10px rgba(107, 47, 160, .10);
}
.vj-page .vj-wave {
	display: flex;
	align-items: center;
	gap: 4px;
	height: 56px;
}
.vj-page .vj-wave i {
	display: block;
	width: 4px;
	height: 14px;
	border-radius: 4px;
	background: #C9B4E4;
}
.vj-page .vj-wave i:nth-child(2) { height: 26px; }
.vj-page .vj-wave i:nth-child(3) { height: 38px; }
.vj-page .vj-wave i:nth-child(4) { height: 50px; }
.vj-page .vj-wave i:nth-child(5) { height: 34px; }
.vj-page .vj-wave i:nth-child(6) { height: 44px; }
.vj-page .vj-wave i:nth-child(7) { height: 22px; }
.vj-page .vj-wave i:nth-child(8) { height: 12px; }

/* Bars only move while a recording is running. */
.vj-page .is-recording .vj-mic { animation: vjPulse 1.6s ease-in-out infinite; }
.vj-page .is-recording .vj-wave i {
	background: var(--vj-purple);
	animation: vjBar 1s ease-in-out infinite;
}
.vj-page .is-recording .vj-wave i:nth-child(2) { animation-delay: .1s; }
.vj-page .is-recording .vj-wave i:nth-child(3) { animation-delay: .2s; }
.vj-page .is-recording .vj-wave i:nth-child(4) { animation-delay: .3s; }
.vj-page .is-recording .vj-wave i:nth-child(5) { animation-delay: .15s; }
.vj-page .is-recording .vj-wave i:nth-child(6) { animation-delay: .25s; }
.vj-page .is-recording .vj-wave i:nth-child(7) { animation-delay: .35s; }
.vj-page .is-recording .vj-wave i:nth-child(8) { animation-delay: .05s; }

@keyframes vjBar {
	0%, 100% { transform: scaleY(.45); }
	50%      { transform: scaleY(1.25); }
}
@keyframes vjPulse {
	0%, 100% { box-shadow: 0 0 0 10px rgba(107, 47, 160, .10); }
	50%      { box-shadow: 0 0 0 18px rgba(107, 47, 160, .18); }
}
@media (prefers-reduced-motion: reduce) {
	.vj-page .is-recording .vj-wave i,
	.vj-page .is-recording .vj-mic { animation: none; }
}

.vj-page #display {
	margin: 14px 0 2px;
	font-size: 20px;
	font-weight: 700;
	color: var(--vj-ink);
	letter-spacing: .5px;
}
.vj-page .vj-stage__hint {
	margin: 0;
	font-size: 12px;
	color: var(--vj-muted);
}

/* ---- tips ---- */
.vj-page .vj-tips {
	border: 1px solid var(--vj-line);
	border-radius: 12px;
	padding: 16px 18px;
	background: #FBF9FE;
}
.vj-page .vj-tips__head {
	display: flex;
	align-items: center;
	gap: 8px;
	margin: 0 0 12px;
	font-size: 15px;
	font-weight: 700;
	color: var(--vj-ink);
}
.vj-page .vj-tips__icon {
	width: 28px;
	height: 28px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 8px;
	background: var(--vj-purple-soft);
	color: var(--vj-purple);
	font-size: 13px;
}
.vj-page .vj-tips ul { margin: 0; padding: 0; list-style: none; }
.vj-page .vj-tips li {
	display: flex;
	align-items: center;
	gap: 9px;
	padding: 5px 0;
	font-size: 13px;
	color: var(--vj-ink);
}
.vj-page .vj-tips li i { color: var(--vj-purple); font-size: 12px; }

/* ---- recordings ---- */
.vj-page .vj-list { margin-top: 26px; }
.vj-page .vj-list__head {
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	gap: 16px;
	flex-wrap: wrap;
	margin-bottom: 14px;
}
.vj-page .vj-list__title h4 {
	margin: 0 0 3px;
	font-size: 18px;
	font-weight: 700;
	color: var(--vj-ink);
}
.vj-page .vj-list__title p {
	margin: 0;
	font-size: 13px;
	color: var(--vj-muted);
}
.vj-page .vj-sort {
	border: 1px solid var(--vj-line);
	border-radius: 9px;
	padding: 9px 12px;
	background: #fff;
	font-size: 13px;
	color: var(--vj-ink);
}

.vj-page .all-recordings {
	margin: 0;
	padding: 0;
	list-style: none;
}
/* Also matches the item app.js builds on save, which has .detail, <audio> and
   .autio-con12 but no .name or .vj-time. */
.vj-page .all-recordings .all-detail {
	display: flex;
	align-items: center;
	gap: 16px;
	flex-wrap: wrap;
	border: 1px solid var(--vj-line);
	border-radius: 12px;
	padding: 14px 18px;
	margin-bottom: 12px;
	background: #fff;
}
.vj-page .all-recordings .all-detail .detail {
	flex: 1 1 240px;
	min-width: 0;
}
.vj-page .all-recordings .all-detail .detail p {
	margin: 0;
	font-size: 15px;
	font-weight: 600;
	color: var(--vj-ink);
	word-break: break-word;
}
.vj-page .all-recordings .all-detail .name p {
	margin: 0;
	font-size: 13px;
	color: var(--vj-muted);
}
.vj-page .all-recordings .all-detail .name p:empty { display: none; }
.vj-page .all-recordings .all-detail .vj-time b {
	font-size: 12px;
	font-weight: 500;
	color: var(--vj-muted);
	white-space: nowrap;
}
.vj-page .all-recordings .all-detail audio {
	height: 38px;
	max-width: 100%;
}
.vj-page .all-recordings .all-detail .autio-con12 {
	display: flex;
	align-items: center;
	gap: 16px;
	margin-left: auto;
}
.vj-page .all-recordings .all-detail .autio-con12 a {
	color: var(--vj-purple);
	font-size: 17px;
	line-height: 1;
}
.vj-page .all-recordings .all-detail .autio-con12 a:hover { color: var(--vj-purple-dark); }
.vj-page .all-recordings .all-detail .autio-con12 .deleteByAjax { color: #D64550; }

/* ---- empty state ---- */
.vj-page #no-data {
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 6px;
	border: 1px dashed var(--vj-line);
	border-radius: 12px;
	padding: 34px 20px;
	margin: 0;
	text-align: center;
}
.vj-page #no-data .vj-empty__icon {
	width: 52px;
	height: 52px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 14px;
	background: var(--vj-purple-soft);
	color: var(--vj-purple);
	font-size: 20px;
	margin-bottom: 4px;
}
.vj-page #no-data b {
	font-size: 16px;
	color: var(--vj-ink);
}
.vj-page #no-data .vj-empty__sub {
	font-size: 13px;
	color: var(--vj-muted);
}

/* ---- narrow screens ---- */
@media (max-width: 1199px) {
	.vj-page .vj-studio__grid { grid-template-columns: 1fr 1fr; }
	.vj-page .vj-tips { grid-column: 1 / -1; }
}
@media (max-width: 767px) {
	.vj-page .vj-studio__grid { grid-template-columns: 1fr; }
	.vj-page .vj-studio__stage { order: -1; }
	.vj-page #controls button { flex: 1 1 auto; justify-content: center; }
	.vj-page .all-recordings .all-detail .autio-con12 { margin-left: 0; }
	.vj-page .vj-invite #generateLink { width: 100%; justify-content: center; }
}
</style>
@endsection
