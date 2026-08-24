@extends("mobile.layouts.dashboard")
@section("content")
<section class="written-journal-head">
        <div class="cust-container-md">
            <div class="header">
                <div class="back">
                    <a href="{{ route('my-journal-audio')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="title">
                    <p>Requested Affirmation.</p>
                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())
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
							
							
								<div class="title">

                                   <p>{{ $row['link_visitor'] }}</p>
                                   
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
@endsection 