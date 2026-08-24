@extends("mobile.layouts.dashboard")
@section("content")
<section class="written-journal-head">
        <div class="cust-container-md">
            <div class="header">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="title">
                    <p>My Voice Journal.</p>
                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())

<div class="record-new-journal send-link">
        <div class="cust-container-md">
            <div class="link-gen">
                <div class="left">
                    <div class="link-title app-heading">
                        <p>My Voice Journal Hear from friends and family.</p>
                    </div>
                    <div class="link-detail">
                        <p>Send an invitation to someone that enables the recording of a brief affirmation or uplifting
                            message of encouragement.</p>
                    </div>
                </div>
                <div class="right">
                    <div class="link-v">
                        <a href="javascript:void(0)" class="open-modal" data-modal="CreateShareLink" onclick="OpenModel('CreateShareLink','flex')">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.197 3.35462C16.8703 1.67483 19.4476 1.53865 20.9536 3.05046C22.4596 4.56228 22.3239 7.14956 20.6506 8.82935L18.2268 11.2626M10.0464 14C8.54044 12.4882 8.67609 9.90087 10.3494 8.22108L12.5 6.06212"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M13.9536 10C15.4596 11.5118 15.3239 14.0991 13.6506 15.7789L11.2268 18.2121L8.80299 20.6454C7.12969 22.3252 4.55237 22.4613 3.0464 20.9495C1.54043 19.4377 1.67609 16.8504 3.34939 15.1706L5.77323 12.7373"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </span>
                            <span>Send Link</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="record-new-journal">
        <div class="cust-container-md">
            <div class="new-jurn">
                <div class="title">
                    <p>Record new journal</p>
                </div>

                <input type="hidden" id="visitor_token" value="" />
                <input type="hidden" id="visitor_name" name="visitor_name" value=""/>
                <input type="hidden" id="visitor_email" name="visitor_email" value="" />

                <div id="controls" class="new-jun-row">
                    <button id="pauseButton"  class="voice">
                        <img class="pauseButton_pause" src="{{ asset('assets/dashboard/assets/images/play-voice-v2-icon-svg.svg') }}" alt="icon">
                        <img class="pauseButton_play" src="{{ asset('assets/dashboard/assets/images/recordings-paused.svg') }}" alt="icon" style="display: none;">
                    </button>
                    <button id="recordButton" class="voice pause"><img src="{{ asset('assets/dashboard/assets/images/voice-show-icon-svg.svg') }}" alt="icon"></button>
                    <button id="stopButton" class="voice stop"><img src="{{ asset('assets/dashboard/assets/images/pouse-icon-svg.svg')}}" alt="icon"></button>
                </div>
                <p id="display" style="display:none;text-align: center;">00:00:00</p>
                 <?php /*
                <div id="controls">
          	 <button id="recordButton"><i class="fas fa-microphone-alt"></i> Record</button>
          	 <button id="pauseButton" disabled=""><i class="fas fa-pause"></i> Pause</button>
          	 <button id="stopButton" disabled=""><i class="fas fa-stop"></i> Stop</button>
            </div>
            */ ?>


            </div>
        </div>
</div>


<section class="written-journal">
        <div class="cust-container-md">
            <!-- 
            <div class="search-form">
                <form class="form-row">
                    <div class="col-100 form-group">
                        <input class="form-control" type="text" name="Search" placeholder="Search">
                    </div>
                </form>
            </div> -->
            <div id="recordingsList" style="display:none;"></div>
            <div class="jour-list-r">

             
            <?php if (!empty($data)) { ?>
				<?php foreach($data as $row): ?>
						<div class="journal-log-card">
							<div class="top">
							
							
								<div class="title" style="">
									@if(Auth::check())
										<p>{{ Auth::user()->name }}</p>
									@endif
								</div>
								<div class="right">
									<a href="<?= asset('audio/' . $row['file_name']) ?>" download>
										<img src="{{ asset('assets/dashboard/assets/images/download-icon-svg.svg') }}" alt="icon">
									</a>
									<a deleted_id="<?php echo $row['id']?>" href="javascript:void(0)"  class="delete-journal open-modal">
										<img src="{{ asset('assets/dashboard/assets/images/delete-vector.svg') }}" alt="icon" />
									</a>
								</div>
							</div>
							<div class="time-r">
								<div class="wat">
									<img src="{{ asset('assets/dashboard/assets/images/watch-gray-icon.svg') }}" alt="icon" />
								</div>
								<div class="time">
									<p><?= convertDateToUserTimeZone($row['created_at']); ?></p>
								</div>
							</div>
							<div class="content g">
								<p>
									<?= $row['voice_text'] ?>
								</p>
							</div>
							<div class="record-voice">
								<audio controls="" id="cust-audio-control">
									<source src="<?= asset('audio/' . $row['file_name']) ?>" type="audio/wav">
								</audio>
							</div>
						</div>
					<?php endforeach ?>	
            <?php } ?>
            
    
            <?php if(empty($data)) { ?>
                <div class="journal-log-card">
                    <p id="no-data">
                    <b>No Voice Journal Found.</b>
                    </p>
                </div>    
            <?php } ?>
            
            </div>

        </div>
    </section>

@else 
<section class="written-journal">
    <div class="cust-container-md">
        {{ LoginUserBToBVerificationMSG() }}
    </div>
</section>            
@endif
   
@include('mobile.includes.foooter-tab')
@include('mobile.services.vj.recording-model')
@include('mobile.services.vj.recording-script')
@endsection 