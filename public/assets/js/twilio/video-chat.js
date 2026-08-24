(() => {
    'use strict';
    
    const Video = Twilio.Video;
 
    let videoRoom, localStream;
    const video = document.getElementById("video");
    const video_host = document.getElementById("video-host");
    const muteAudio = document.getElementById('muteAudio');
    const stopVideo = document.getElementById('stopVideo');
    
    let lastSpeakerSID = null;

    if (!Video.isSupported) {
      alert('Please try other browser.');
    }

    // alert(IS_HOST);
    

    if(IS_HOST){
      document.getElementById("general-message").style.display = 'none';
      navigator.mediaDevices.getUserMedia({video: true, audio: true})
      .then(vid => {
        video_host.srcObject = vid;
          localStream = vid;
      });
    } 
    
    // buttons
    const joinRoomButton = document.getElementById("button-join");
    const leaveRoomButton = document.getElementById("button-leave");
    var site = `${TWILIO_DOMAIN}/public/api.php?type=access_token&channel_name=`+encodeURIComponent(ROOM_NAME)+'&identity='+ encodeURIComponent(USER_NAME);
    console.log(`site ${site}`);
    joinRoomButton.onclick = () => {
      joinRoomButton.disabled  = true;
      // get access token
      axios.get(site).then(async (body) => {
        const token = body.data.token;
        console.log(token);

        Video.connect(token, {
            name: ROOM_NAME,
            audio: { name: 'microphone' },
            video: { name: 'camera' },
            dominantSpeaker: true
            
        }).then((room) => {


          console.log(`Connected to Room ${room.localParticipant}`);
          videoRoom = room;

          console.log('local parcipant object', room.localParticipant);
          LOCAL_PARTICIPANT_ID = room.localParticipant.sid;
          room.localParticipant.tracks.forEach((publication) => {
            console.log(publication, 'publication');
              
          });

          room.participants.forEach(participantConnected);
          
          room.on("participantConnected", participantConnected);

          room.on("participantDisconnected", participantDisconnected);
          room.once("disconnected", (error) =>
            room.participants.forEach(participantDisconnected)
          );
          room.on('dominantSpeakerChanged', participant => {
            console.log('The new dominant speaker in the Room is:', participant);
            handleSpeakerChange(participant);
          });

          document.getElementById('muteAudio').onclick = function(e){
            document.getElementById("muteAudio").parentNode.classList.toggle("show-control1");
              let lastValue = document.getElementById('Audio').getAttribute("data-type");
              room.localParticipant.tracks.forEach((publication) => {
                console.log(publication, 'publication');
                  if(publication.track.kind == 'audio'){
                      if(lastValue == 'enable'){
                          publication.track.disable();
                          document.getElementById('muteAudio').setAttribute("data-type","disable");
                      }else{
                          publication.track.enable();
                          document.getElementById('muteAudio').setAttribute("data-type","enable");
                      }
                  }
              });
          };          
            
          document.getElementById('stopVideo').onclick = function(e){
            document.getElementById("stopVideo").parentNode.classList.toggle("show-control2");

              let lastValue = document.getElementById('stopVideo').getAttribute("data-type");
              room.localParticipant.tracks.forEach((publication) => {
                  if(publication.track.kind == 'video'){
                      if(lastValue == 'enable'){
                          publication.track.disable();
                          document.getElementById('stopVideo').setAttribute("data-type","disable");
                      }else{
                          publication.track.enable();
                          document.getElementById('stopVideo').setAttribute("data-type","enable");
                      }
                  }
              });
          };
          
          joinRoomButton.style.display = 'none';
          leaveRoomButton.disabled = false;
          leaveRoomButton.style.display = 'block';
          muteAudio.disabled  = false;
          stopVideo.disabled  = false;
        });
      });
    };
    leaveRoomButton.onclick = () => {
      videoRoom.disconnect();
      console.log(`Disconnected from Room ${videoRoom.name}`);
      joinRoomButton.disabled = false;
      joinRoomButton.style.display = 'block';
      leaveRoomButton.disabled = true;
      leaveRoomButton.style.display = 'none';

      muteAudio.disabled  = true;
      stopVideo.disabled  = true;
    };
})();

const participantConnected = (participant) => {
    console.log(`Participant ${participant.identity} connected'`);
    total_participant++ ;
    if(total_participant > 1){
      $(".user-control-cont").show();
    }
    document.getElementById("total_count").textContent = total_participant;

    const div = document.createElement('div');
    div.id =  participant.sid;
    div.className = 'video-custom-class';

    const innerDiv = document.createElement('div');
    innerDiv.className  =  'control-single-video';
    
    const mute_span = document.createElement('span');
    mute_span.className  = "stopAllParticipanAudioIcon";
    mute_span.id = "audio_"+participant.sid;
    mute_span.textContent = "";
    innerDiv.appendChild(mute_span);

    const pause_video = document.createElement('span');
    pause_video.className  = "stopAllParticipanVideoIcon";
    pause_video.id = "video_"+participant.sid;
    pause_video.textContent = "";
    innerDiv.appendChild(pause_video);

    participant.on('trackSubscribed', track => trackSubscribed(div, track));
    participant.on('trackUnsubscribed', trackUnsubscribed);
  
    participant.tracks.forEach(publication => {
      if (publication.isSubscribed) {
        trackSubscribed(div, publication.track);
      }
    });

    console.log(!IS_HOST, participant, AUTHOR, 'IS_HOST');

    if(participant.identity == AUTHOR && !IS_HOST){
      document.getElementById("general-message").style.display = 'none';
      document.getElementById("video-host").style.display = 'none';
      document.getElementById("video").appendChild(div); 
    }

    if(participant.identity != AUTHOR){
      div.appendChild(innerDiv);
      document.getElementById("general-message").style.display = 'none';
      document.getElementById("users-videos").appendChild(div);
    }
    
}

const participantDisconnected = (participant) => {
  total_participant--;

  if(total_participant == 0){
    $(".user-control-cont").hide();
  }
  
  document.getElementById("total_count").textContent = total_participant;
    console.log(`Participant ${participant.identity} disconnected.`);
    document.getElementById(participant.sid).remove();
}

const trackSubscribed = (div, track) => {
  console.log('Tracked Subscribed', div, track);
  div.appendChild(track.attach());
}

const trackUnsubscribed = (track) => {
    track.detach().forEach(element => element.remove());
}

function handleSpeakerChange(participant) {
    removeDominantSpeaker();
    if (participant !== null)
        assignDominantSpeaker(participant);
}

let lastSpeakerSID = null; // add this at the top with the other variable declarations


function removeDominantSpeaker() {
    console.log(lastSpeakerSID, 'last speaker Id');
}

function assignDominantSpeaker(participant) {
    let domSpeakerNameLabel;
    lastSpeakerSID = "N_" + participant.sid;
    console.log(lastSpeakerSID, 'assign current speaker');
}

function muteAllAudio(){
$("#muteAudio").trigger('click');

}
function stopAllVideo(){
  $("#stopVideo").trigger('click');  
}

function muteSigleAudio(id){ 
  if(LOCAL_PARTICIPANT_ID == id){
    $("#muteAudio").trigger('click');
  }
}

function pauseSigleVideo(id){
  if(LOCAL_PARTICIPANT_ID == id){
    $("#stopVideo").trigger('click');
  }
}


