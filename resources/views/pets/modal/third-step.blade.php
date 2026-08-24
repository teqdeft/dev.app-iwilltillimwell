<div class="tab-pane third-step d-none petAllSteps attachments-pets" id="step3">
    <div class="panel-heading">
        <h2>Attachments:</h2>
    </div>
    <div class="third-stepinner">
        <div class="third-sec">
        <p> Upload your files quickly and easily to share with the veterinarian.</p>
        <span>Accepted formats: JPEG, PNG, GIF, PDF</span>
        <span>Max File Size: 5 MB</span>
        </div>
        <div class="row info third-info">
            <!-- <div class="form-group inputDnD"> -->
            <form action="{{ url('pets/schedule') }}" enctype="multipart/form-data" class="dropzone " id="SaveScheduleForm">
                @csrf
            <div class="form-control-file" id="inputDnD">								
				<input class="imageupload" type="file" id="filessss" name="file[]" multiple="" accept="image/*">	
                
            </div>
            </form>
        </div>
    </div>
</div>
