
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
        
        // End of AJAX share link
    // end of generate a randome token

</script>

<script src="{{ asset('assets/dashboard/assets/js/recorder/app.js') }}" defer></script>
<script src="https://www.imwell.app/js/recorder/recorder.js" defer></script>

<script>
$(document).on("click", ".delete-journal", function() {
    $("#audio-deleted-popup-confirmation").addClass("show");
    let id = $(this).attr("deleted_id");
    $(".confirm_btn").attr("onclick","OnClickAudioDeletedConfirm('"+id+"')");
});
function OnClickAudioDeletedConfirm(id) {
	close_consemt_popup('audio-deleted-popup-confirmation')
    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
     });
    let formData = new FormData();
    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
    formData.append("id", id); 
	formData.append("_method", "DELETE");

    $.ajax({
               method: "POST",
               url: "{{ url('my-journal-audio-deleted')}}/"+id,
               data:formData,
               processData: false, 
               contentType: false,
               success: function(data) {
                   
                  location.reload();

               },
    });

 } 


 function ShareNow() {

    var share_token = generateToken();
    $("#showLinkText").val(share_token);
     let name=$("#name").val();   
     let email=$("#email").val();   
     let message = $("#message").val();
    if(!name) {
        toastr.error("Name Required");
        return false;
    }
    if(!email) {
        toastr.error("Email Required");
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