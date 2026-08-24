<div class="singleMsgContainer">
    <div class="replaymsg mr-2">
        <div class="messageSumContainer">
            <div class="messageSummary">
                <p>{{ $getMessage['viewData']['FromName'] }}</p>
                <p>{{ $getMessage['viewData']['Rcvd'] }}</p>
                <p>{{ $getMessage['viewData']['Subject'] }}</p>
            </div>
            <div class="messageActions">
                <a class="messageReplayButton" title="Reply">Reply</a>
                <a class="messageArchiveButton" messageId="{{ $getMessage['viewData']['ID'] }}" count="single" title="Archive">Archive</a>
            </div>
        </div>
        <div class="messageSendContainer" style="display:none;">
            <form action="{{ url('postMessageReply') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $getMessage['viewData']['DoctorID'] }}" name="DoctorID" >
                <input type="hidden" value="{{ $getMessage['viewData']['PatientID'] }}" name="PatientID" >
                <input type="hidden" value="{{ $docType[$getMessage['viewData']['RouteName']]??'' }}" name="Route" >
                <input type="hidden" value="{{ $getMessage['viewData']['ThreadID'] }}" name="ThreadID" >
                <input type="hidden" value="{{ $getMessage['viewData']['Subject'] }}" name="Subject" >
                <input type="hidden" value="{{ $getMessage['viewData']['FromName'] }}" name="FromName" >
                <input type="hidden" value="{{ $getMessage['viewData']['ID'] }}" name="Original_msg_id" >
                <div class="messageReplay">
                    <textarea name="Body" rows="8" class="form-control" placeholder="Type your message here..."></textarea>
                </div>
                <div class="messageSendButton">
                    <a class="cancelReply" title="Cancel">Cancel</a>
                    <button type="submit" class="btn btn-primary mr-2">Send</button>
                </div>
            </form>
        </div>
    </div>
    <div class="messaeBody">
        <?= html_entity_decode($getMessage['viewData']['Body']); ?>
    </div>
</div>