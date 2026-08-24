@extends('layouts.default')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/twilio.css') }}">
<section class="video-chat-sec">
    <div id="room-controls">
        <div class="main-wrapper">
            <section class="video-chat-box">
                <div class="inner-sec">
                    <div class="custom-container2">
                        <div class="cus-row">
                            <div class="cus-col-video">
                                <div class="video-box">
                                    <div class="live-users">
                                        <div class="inner-live-user">
                                            <i class="far fa-eye"></i> <span id="total_count">0</span>
                                        </div>
                                    </div>

                                    <div id="general-message">
                                        <div class="message_div">
                                            <span> Session will begin soon...</span>
                                        </div>
                                    </div>
                                    <video id="video-host" autoplay muted="true">
                                    </video>
                                    <div id="video"></div>
                                    <div id="users-videos">
                                        <?php if ($isHost) { ?>
                                            <div class="user-control-cont" style="display: none;">
                                                <button id="muteAllParticipanVideo" data-stop-all="false" class="mute-all">
                                                    <i class="fas fa-microphone-alt-slash"></i>
                                                    <i class="fas fa-microphone-alt"></i>
                                                </button>
                                                <button id="stopAllParticipanAudio" data-mute-all="false" class="pause-all">
                                                    <i class="fas fa-pause"></i>
                                                    <i class="fas fa-play"></i>

                                                </button>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="all-controls-box">
                                        <button id="button-join" title="Join Call" class="join-call"><i class="fas fa-phone-alt"></i></button>
                                        <button id="button-leave" style="display:none" disabled title="Leave Call" class="leave-call"><i class="fas fa-phone-alt"></i></button>
                                        <button id="muteAudio" disabled title="Mute Call" class="self-mute" data-type="enable">
                                            <i class="fas fa-microphone-alt-slash"></i>
                                            <i class="fas fa-microphone-alt"></i>
                                        </button>
                                        <button id="stopVideo" disabled title="Pause Call" class="pause-call" data-type="enable">
                                            <i class="fas fa-pause"></i>
                                            <i class="fas fa-play"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="cus-chat-col">
                                <div id="channel">
                                    <div id="channel-body">
                                        <div id="channel-chat">
                                            <div id="channel-messages">
                                                <ul></ul>
                                            </div>
                                            <div id="channel-message-send">
                                                <div id="typing-indicator"><span></span></div>
                                                <div class="send-mgs">
                                                    <input type="textbox" id="message-body-input" placeholder="Enter Message....."></input>
                                                    <button id="send-message" class="red-button"><i class="fas fa-paper-plane"></i> </button>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="channel-join-panel">
                                            <button id="join-channel" class="red-button">Join this Channel
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="javascript:void(0)" class="mobile-chat-icon">
                            <i class="far fa-comment-dots"></i>
                                    </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

</section>

<script>
    const HOST_EMAIL = "<?php echo $host_email; ?>";
    const USER_EMAIL = "<?php echo $user_email; ?>";
    const IS_HOST = "<?php echo $isHost; ?>";
    const ROOM_NAME = "<?php echo $counseling->link; ?>";
    const TWILIO_DOMAIN = "<?php echo url('/'); ?>";
    const USER_NAME = "<?php echo $user->fname . ' ' . $user->lname; ?>";
    const IDENTITY = "<?php echo $user->email; ?>";
    const stopAllParticipanVideo = document.getElementById('stopAllParticipanVideo');
    const stopAllParticipanAudio = document.getElementById('stopAllParticipanAudio');
    var total_participant = 0;
    var LOCAL_PARTICIPANT_ID = '';


    const AUTHOR = "<?php echo $host_identity; ?>";
    //console.log(HOST_EMAIL, USER_EMAIL, AUTHOR, 'iiiiii');
</script>
<script src="//media.twiliocdn.com/sdk/js/video/releases/2.3.0/twilio-video.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/twilio/video-chat.js') }}"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="{{ asset('assets/js/twilio/superagent.js') }}"></script>
<script src="https://media.twiliocdn.com/sdk/js/chat/v3.3/twilio-chat.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/twilio/chat.js') }}"></script>
@endsection