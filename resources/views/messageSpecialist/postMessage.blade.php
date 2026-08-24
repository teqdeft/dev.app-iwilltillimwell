<div class="modal fade" id="message-smodal" tabindex="-1" role="dialog" aria-labelledby="message-smodal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('postMessage') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" style="display:none;">
                                <input type="hidden" name="PatientId" value="{{ Auth::user()->userid }}" >
                                <div class="form-group">
                                    <label>Type of specialist</label>
                                    <select class="form-control popupSpecialist" name="Route">
                                        @if( $data )
                                            @foreach ($data as $key => $value )
                                                <option  value="{{ $value['idNo'] }}">{{ $value['title'] }}</option>                        
                                            @endforeach 
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Subject <span class="required-ico">*</span></label>
                                    <input type="text" class="form-control" name="Subject" id="Subject" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message <span class="required-ico">*</span></label>
                                    <textarea name="Body" id="Body" class="form-control" rows="10" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn outline-button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="return SendMessage();">Send</button>
                    </div>
                </form>
            </div>
        </div>
</div>