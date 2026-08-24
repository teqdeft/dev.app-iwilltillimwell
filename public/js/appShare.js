//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");
var voiceRecModal = $('#voiceRecModal');
var noData = $('#no-data');
var fd = new FormData();

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);

function startRecording() {
    var visitorName = $("#visitor_name").val();
    var visitorEmail = $("#visitor_email").val();
    var pattern = "/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i";
    $(".errormsg-vjshare").html('');
	if ((visitorName.length < 3) || (visitorEmail.length < 5) ) {
		$(".errormsg-vjshare").html("<div class='alert alert-danger'><strong>Error! </strong>Enter your name and email.</div>");
        return false;
    }
    
    if (content.length) {
        content += ' ';
    }
    
    recognization.start();
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	pauseButton.disabled = false;

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log(stream + "---getUserMedia() success, stream created, initializing Recorder.js ...");
        startStopwatch();
		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
// 		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()
        
		console.log("Recording started");

	}).catch(function(err) {
	    if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError' || err.name === 'NotReadableError' && err.message === 'AVAudioSessionCaptureDevice') {
	        alert("Please connect a microphone and try again.");
	    } else {
	        alert("Error: " + err.message); // For other errors, display default error message
	    }
	  	//enable the record button if getUserMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	pauseButton.disabled = true
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	pauseResumeStopwatch();
	if (rec.recording){
		//pause
	setTimeout( function() {
		recognization.stop();
        instructions.text('Voice recognition paused.').css("color", "orange");
		
		rec.stop();
		pauseButton.innerHTML="Resume";
		recordButton.disabled = true;
	}, 900);
	}else {
		//resume
		recognization.start();
		rec.record();
		pauseButton.innerHTML="Pause";
		instructions.text('Voice recognition Resumed.').css("color", "orange");
	}
}

function stopRecording() {
    
	$("#loader-wrapper").css("display","flex");
    //voiceRecModal.modal("show");
    stopStopwatch();
    setTimeout( function() {
    	console.log("stopButton clicked");
    	
    	//disable the stop button, enable the record too allow for new recordings
    	stopButton.disabled = true;
    	recordButton.disabled = false;
    	pauseButton.disabled = true;
    
    	//reset button just in case the recording is stopped while paused
    	pauseButton.innerHTML="Pause";
    	
    	//tell the recorder to stop the recording
    	rec.stop();
        
    	//stop microphone access
    	gumStream.getAudioTracks()[0].stop();
    	
    	//create the wav blob and pass it on to createDownloadLink
    	rec.exportWAV(createDownloadLink);
    }, 2000);
}

function createDownloadLink(blob) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	    li.className = "all-detail";
	var link = document.createElement('a');
	var div = document.createElement('div');
        div.className = "detail";
	var dateDiv = document.createElement('div');
	var deleteRec = document.createElement('a');
	var submitButton = document.createElement("button");
	
	var audioDiv = document.createElement('div');
	    audioDiv.className = "autio-con12";
	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	link.innerHTML = '<i class="fas fa-download"></i>';
	
	deleteRec.href = "javascript:void(0);";
	deleteRec.className = "delete-button";
	deleteRec.innerHTML = '<i class="fas fa-trash-alt"></i>';
	
    // save button for recording
        submitButton.id = "submit-button";
        submitButton.textContent = "Submit";
        submitButton.type = "submit";
    // end of save button for recording
    
    //add the new audio text to li
	li.appendChild(div);
	
	audioDiv.appendChild(deleteRec);
	audioDiv.appendChild(submitButton);
	//add the new audio element to li
	li.appendChild(au);
	
    // Use a regular expression to check for consecutive dots
    var hasConsecutiveDots = /\.{2,}/.test(content);
    
    recognization.stop();
    
    if (content.length > 6 && !hasConsecutiveDots) {
        // disabled once recording is paused
            $("#recordButton").prop("disabled", true);
        // end of disabled once the audio is paused
        
        instructions.text('Voice recognition stopped. Click submit to save....').css("color", "green");
        div.innerHTML = "<b>" + content + "</b>";
        
        fd.append("_token", $('meta[name="csrf-token"]').attr('content'));
        fd.append("audio_data",blob, filename);
        fd.append("audio_text", content);
        
        fd.append("link_visitor", $("#visitor_name").val());
        fd.append("link_visitor_email", $("#visitor_email").val());
        fd.append("visitor_token", $("#visitor_token").val());
        
        // recording save function
        // saveAudioRec(fd, deleteRec);
        // Start of element for stop recording
            content = '';
            output.val('');    
            voiceRecModal.modal('hide').data('bs.modal', null);
            $('.modal-backdrop').remove();
            noData.hide();
        // End of element for stop recording
        // li.appendChild(deleteRec);
        li.appendChild(audioDiv);
        recordingsList.insertBefore(li, recordingsList.firstChild);
    } else {
        instructions.text('No voice detected, Please try again. ').css("color", "red").delay(5000).fadeOut('slow', function() { instructions.text('').show(); });
        
        content = "";
        output.val("");
        voiceRecModal.modal('hide').data('bs.modal', null);
        
        alert(content + 'Not received any input. Please try again');
        location.reload();
    }
}

function saveAudioRec(check) {
    if (!check) {
        alert('Something went wrong. Please try again.');
        return false;
    }
    // Send the FormData object to Laravel backend
        fetch('/upload-audio', {
            method: 'POST',
            body: fd,
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var recordingId = data.saved_id;
                // Reset variables and update UI.
                content = '';
                output.val('');    
                
                voiceRecModal.modal('hide').data('bs.modal', null);
                $('.modal-backdrop').remove();
                noData.hide();
                alert('Thankyou, Your Voice Journal send to owner.');
                location.href = "/";
            }
        })
        .catch(error => {
            content = '';
            output.val('');
            instructions.text('Something went wrong. Please try again.').css("color", "red").delay(5000).fadeOut('slow', function() { instructions.text('').show(); });
            voiceRecModal.modal('hide').data('bs.modal', null);
            
            console.error('Error during file upload:', error);
        });
}

$(document).on('click', '#submit-button', function() {
    $("#submit-button").prop("disabled", true);
    voiceRecModal.modal("show");
    saveAudioRec(true);
});

function createListItem(recordingId, audioSrc) {
  // Create li element
  var listItem = document.createElement("li");
  listItem.className = "all-detail";

  // Create div with class "detail"
  var detailDiv = document.createElement("div");
  detailDiv.className = "detail";
  var textNode = document.createTextNode("hello this is my voice general I am testing this the second time thank you ");
  detailDiv.appendChild(textNode);
  listItem.appendChild(detailDiv);

  // Create div with class "autio t-center align-self-center"
  var audioDiv = document.createElement("div");
  audioDiv.className = "autio t-center align-self-center";

  // Create audio element
  var audioElement = document.createElement("audio");
  audioElement.controls = true;

  // Create source element inside audio
  var sourceElement = document.createElement("source");
  sourceElement.src = audioSrc;
  sourceElement.type = "audio/wav";
  audioElement.appendChild(sourceElement);

  audioDiv.appendChild(audioElement);
  listItem.appendChild(audioDiv);

  // Create div with class "download t-center align-self-center"
  var downloadDiv = document.createElement("div");
  downloadDiv.className = "download t-center align-self-center";

  // Create a element inside downloadDiv
  var downloadLink = document.createElement("a");
  downloadLink.href = audioSrc;
  downloadLink.download = "";
  var downloadIcon = document.createElement("i");
  downloadIcon.className = "fas fa-download";
  downloadLink.appendChild(downloadIcon);

  downloadDiv.appendChild(downloadLink);
  listItem.appendChild(downloadDiv);

  // Create div with class "delete t-center align-self-center"
  var deleteDiv = document.createElement("div");
  deleteDiv.className = "delete t-center align-self-center";

  // Create a element inside deleteDiv
  var deleteLink = document.createElement("a");
  deleteLink.href = "javascript:void(0);";
  deleteLink.setAttribute("data-recording-id", recordingId);
  deleteLink.className = "delete-button";
  var deleteIcon = document.createElement("i");
  deleteIcon.className = "fas fa-trash-alt";
  deleteLink.appendChild(deleteIcon);

  deleteDiv.appendChild(deleteLink);
  listItem.appendChild(deleteDiv);

  return listItem;
}

// Add a click event listener to the delete button
$(document).on('click', '.delete-button', function() {
    voiceRecModal.modal("show");
    var confirmDelete = confirm('Audio will be deleted permanently.');
    if (!confirmDelete) {
        voiceRecModal.modal('hide').data('bs.modal', null);
        return false;
    }
    
    $(this).closest('li').remove();
    instructions.text('');
    
    // enable once recording is paused
        $("#recordButton").prop("disabled", false);
    // end of enable once the audio is paused
        
    // start for soft delete
        fd = new FormData();
        voiceRecModal.modal('hide').data('bs.modal', null);
        alert('Recording deleted successfully');
    // end of soft delete
    
    // Assuming each recording has an ID stored in a data attribute
    // var recordingId = $(this).data('recordingId');
    // Make a DELETE request to the server to delete the recording
    // $.ajax({
    //     url: '/delete-recording/' + recordingId,
    //     type: 'DELETE',
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //     },
    //     success: function(data) {
    //         console.log(data);

    //         // Handle the response as needed
    //         if (data.success) {
    //             // The recording was successfully deleted, you can update your UI or take other actions
                
    //             voiceRecModal.modal('hide').data('bs.modal', null);
    //             alert('Recording deleted successfully');
    //         } else {
    //             // There was an error deleting the recording, handle it accordingly
    //             alert('Error deleting recording');
    //         }
    //     },
    //     error: function(error) {
    //         console.error('Error during delete request:', error);
    //     }
    // });
});

// Custom Code for adding the duration for the recording
  var timer; 
  var startTime;
  var elapsedTime = 0;
  var isRunning = false;

  function updateDisplay() {
    var currentTime = new Date().getTime();
    var currentTimeElapsed = currentTime - startTime + elapsedTime;

    // Convert elapsed time to hours, minutes, and seconds
    var hours = Math.floor(currentTimeElapsed / 3600000);
    var minutes = Math.floor((currentTimeElapsed % 3600000) / 60000);
    var seconds = Math.floor((currentTimeElapsed % 60000) / 1000);

    // Format the time with leading zeros
    var displayTime = 
      (hours < 10 ? "0" : "") + hours + ":" +
      (minutes < 10 ? "0" : "") + minutes + ":" +
      (seconds < 10 ? "0" : "") + seconds;

    if (displayTime == "00:03:01") {
        clearInterval(timer);
        recognization.stop();
        rec.stop();
        alert("You've reached the 3 minute recording limit.");
        $('#stopButton').trigger('click');
    }
    
    // Update the display
    $("#display").text(displayTime);
  }

  function startStopwatch() {
    startTime = new Date().getTime();
    timer = setInterval(updateDisplay, 1000);
    isRunning = true;

    // Disable start button, enable pause/resume and stop buttons
    $("#display").show();
    $("#recordButton").prop("disabled", true);
    $("#pauseButton, #stopButton").prop("disabled", false);
    $("#pauseButton").text("Pause");
  }

  function pauseResumeStopwatch() {
    if (isRunning) {
      clearInterval(timer);
      isRunning = false;

      // Change button text to "Resume" and enable start button
      $("#pauseButton").text("Resume");
      $("#recordButton").prop("disabled", false);

      // Save the elapsed time
      elapsedTime += new Date().getTime() - startTime;
    } else {
      startTime = new Date().getTime();
      timer = setInterval(updateDisplay, 1000);
      isRunning = true;

      // Change button text to "Pause" and enable stop button
      $("#pauseButton").text("Pause");
      $("#stopButton").prop("disabled", false);
    }
  }

  function stopStopwatch() {
    clearInterval(timer);
    isRunning = false;

    // Enable start button, disable pause/resume and stop buttons
    $("#recordButton").prop("disabled", false);
    $("#pauseButton, #stopButton").prop("disabled", true);

    // Reset the display and elapsed time
    $("#display").text("00:00:00").hide();
    elapsedTime = 0;
  }




