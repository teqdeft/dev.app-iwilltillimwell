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
								<h3 class="font-weight-bold"> Requested Affirmation</h3>                  
								                
							</div>              
						</div>            
					</div>          
				</div>        
			</div>      
		</div>    
	</div>	
    <div class="card--white full-height feels-view voice-journal">
       
        <div class="recording-sample-wrap">
        @if(!LoginUserBToBVerification())
            {{ LoginUserBToBVerificationMSG() }}
        @else  
          	<p><strong>Recordings:</strong></p>
          	<ol id="recordingsList" class="all-recordings">
      	    <?php if (!empty($data)) { ?>
              	<?php foreach($data as $row): ?>
                        <li class="all-detail">
                            <div class="detail"><p><?= $row['voice_text'] ?> </p></div>
                            <div class="name"><p><strong><?= $row['link_visitor'] ?></strong></p></div>
                            <div class="vj-time">
                                <b><?= convertDateToUserTimeZone($row['created_at']); ?>
                                </b>
                            </div>
                            <audio controls id="cust-audio-control">
                              <source src="<?= asset('audio/' . $row['file_name']) ?>" type="audio/wav">
                            </audio>
                            <div class="autio-con12">
                                <a href="<?= asset('audio/' . $row['file_name']) ?>" download><i class="fas fa-download"></i> </a>
                                <a href="javascript:void(0);" data-recording-id="<?= $row['id'] ?>"  class="delete-button"> <i class="fas fa-trash-alt"></i> </a>
                            </div>
                        </li>
                <?php endforeach ?>
            <?php } ?>
            </ol>
            <?php if(empty($data)) { ?>
      	        <p id="no-data">
                  <b>No Requested Affirmation</b>
                </p>
            <?php } ?>

            @endif
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
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
// Add a click event listener to the delete button
$(document).on('click', '.delete-button', function() {
    var voiceRecModal = $('#voiceRecModal');
    voiceRecModal.modal("show");
    var confirmDelete = confirm('Audio will be deleted permanently.');
    if (!confirmDelete) {
        voiceRecModal.modal('hide').data('bs.modal', null);
        return false;
    } else {
    
        $(this).closest('li').remove();
        
        // Assuming each recording has an ID stored in a data attribute
        var recordingId = $(this).data('recordingId');
        
        // Make a DELETE request to the server to delete the recording
        $.ajax({
            url: '/delete-recording/' + recordingId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                console.log(data);
    
                // Handle the response as needed
                if (data.success) {
                    // The recording was successfully deleted, you can update your UI or take other actions
                    
                    voiceRecModal.modal('hide').data('bs.modal', null);
                    alert('Recording deleted successfully');
                } else {
                    // There was an error deleting the recording, handle it accordingly
                    alert('Error deleting recording');
                }
            },
            error: function(error) {
                console.error('Error during delete request:', error);
            }
        });
    }
});

</script>

</div>
@endsection
