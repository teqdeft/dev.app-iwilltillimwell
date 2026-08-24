<div class="modal fade upload-image common-pet" id="petImageDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header theme-bg-color">
        <h3 class="modal-title" id="petImageLabel">Add / Update Profile Image for  </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('pets/profile-upload') }}" enctype="multipart/form-data" method="post">
          @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 upload-left">
                <h5>Profile Image</h5>
                <p>Only JPG or PNG files accepted. Image should be no larger than 200px X 200px</p>
                <input class="upload-img-dog" type="file" accept='image/*' name="petBioImage" id="file" required="" onchange="readUrl(event)">
                <input type="hidden" name="petIdImage">
                </div>
                <div class="col-md-6 upload-right">
                <h5>Current Profile Image</h5>
                <img id="petProfileLink" src="" style="width:192px;height:192px;"  >
                </div>
            </div>
        </div>
        <div class="modal-footer common-footer-btn">
            <input type="submit" class="btn btn-primary" value="Upload">
            <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>