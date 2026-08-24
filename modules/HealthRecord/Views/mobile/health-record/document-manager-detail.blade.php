<form class="forms-sample clickOnSubmitBtn " id="upload-document" method="POST" action="{{ route('upload-document', $user)}}" enctype="multipart/form-data">
   @csrf  
        <div class="midical-form v1">
            <div class="form-title detail">
                <p>Enter Your Details</p>
            </div>
            <div class="form">
                <div class="form-row">

                    <div class="col-100 form-group">
                        <label>Would you like to upload any medical documents?</label>
                        <select name="medicatical-document_upload" id="medicatical-document_upload" onchange="takeMedicationAllergies()" required>
                            
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        </select>
                    </div>

                    <div class="col-100 document-manager-section">
                        <div class="inner-title">
                            <p>Attach Photos, Lab Results, X-Rays, or any medically relevant documents (if any).</p>
                        </div>
                    </div>

                    <div class="col-100 form-group document-manager-section">
                        <label>File upload (Upload jpg,png,gif,pdf files only).</label>
                    </div>

                    <div class="col-100 custom-file-upload document-manager-section">
                        <label for="file-upload" class="file-label">
                            <span class="file-button">Upload image</span>
                            <span class="file-name">No file chosen</span>
                            <div class="file-icon">
                                <img src="{{ asset('assets/dashboard/assets/images/material-symbol.png')}}" alt="image">
                            </div>
                        </label>
                        <input id="file-upload" type="file" class="file-input" name="file"  required style="display: block;opacity: 0;" accept=".jpg,.jpeg,.png,image/jpeg,image/png"/>
                    </div>

                    <div class="col-100">
                        <div class="inner-title">
                            <p>Attached Documents.</p>
                        </div>
                    </div>

                    <div class="col-100 uploaded-image">
                        <div class="up-row">

                            @forelse ($documents as $document)
                            <!-- uploaded image -->
                            <div class="up-img-card toggle-main">
                                <div class="image">

                                @if(file_exists(public_path('uploads/documents/'.$document->name)))
                                        <a href="{{ asset('uploads/documents/'.$document->name) }}"
                                            target="_blank">
                                            @if(pathinfo($document->name,
                                            PATHINFO_EXTENSION)=="pdf")
                                            <img src="{{ asset('images/pdf-icon.png') }}"
                                                alt="pdf-img">
                                            @else
                                            <img src="{{ asset('uploads/documents/'.$document->name) }}"
                                                alt="img">
                                            @endif
                                        </a>
                                       
                                 @else
                                        <p>File not found</p>
                                @endif        

                                </div>
                                <div class="edit-icon toggle-icon">
                                    <img src="{{ asset('assets/dashboard/assets/images/upload-img-setting.png')}}" alt="icon">
                                </div>

                                <div class="toggle-content hidden">
                                    <div class="edit-or-replace">
                                        <div class="download">
                                             <a href="{{ asset('uploads/documents/'.$document->name) }}" download>Download</a>
                                        </div>
                                        <div class="delete">
                                            <a onclick="OnClickHealthDocumentDeleted('document-manager-tab')" href="javascript:void(0)">Deleted</a>
                                        
      
<input type="hidden" id="document-manager-tab-url" value="{{route('documents.destroy', $document)}}">
                                  
                                        </div>
                                    </div>
                                </div>

                                 
                               

                            </div>
                            <!-- end -->

                            @endforeach

                        </div>          
                    </div>
                    <div class="col-100 cta">
                         <div class="recorc-cta">   
                              <button type="button" class="outline-button" onclick="nextTabHealRecoards('preview')">Back</button>
                              <button type="button" class="primary-button" onclick="return SaveFinishedDocument()">Save & Finish</button>
                         </div>      
                    </div>

                </div>
            </div>
</form>
 
<style>.document-manager-section { display: none; } </style>

<script>
function SaveFinishedDocument(){

    let medicatical_document_upload = $("#medicatical-document_upload").val();
    if(medicatical_document_upload=="no"){

        
        $("#health-record-popup-confirmation .complete-form .heading").html("<p>Are you Sure.</p>");
        $("#health-record-popup-confirmation .complete-form .message").html("<p>You don't want to upload document ?.</p>");
        $("#health-record-popup-confirmation").addClass("show");
        $(".confirm_btn").attr("onclick","SaveFinishedDocumentConfirm('0')");

    } else {
		
		showLoaderPageLoad('show');
        $("#upload-document").submit();
		
    }
   
}
function SaveFinishedDocumentConfirm(){
	
	showLoaderPageLoad('show');
    $('<input>').attr({type: 'hidden',name: 'take_medication',value: 'no'}).appendTo('#upload-document');
    $('<input>').attr({type: 'hidden',name: 'segment',value: 'document-manager'}).appendTo('#upload-document');


    let url = $("#NottakeMedication").val();
    $("#upload-document").attr("action",url);
    $("#upload-document").submit(); 
}
</script>