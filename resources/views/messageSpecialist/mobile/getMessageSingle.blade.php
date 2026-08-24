<div class="msg-det-reply">
    <div class="top-row">
        <div class="icon">
            <img src="{{ asset('assets/dashboard/assets/images/sports-medicine.png')}}" alt="image">
        </div>
        <div class="s-name">
            <p>{{ isset($getMessage['viewData']['FromName']) ? $getMessage['viewData']['FromName'] : 'Pharmacist Lois Coulter' }}</p>
        </div>
        <div class="detail">
            <p>
                <span class="date">
                    {{  isset($getMessage['viewData']['Rcvd']) ? date("m/d/y",strtotime($getMessage['viewData']['Rcvd'])) :'9/25/2024' }}
                </span>
                <span class="time">
                    {{  isset($getMessage['viewData']['Rcvd']) ? date("h:m:s A",strtotime($getMessage['viewData']['Rcvd'])) : '7:18:00 AM' }}
                </span>
            </p>
        </div>
    </div>
    <div class="summary">
        <p>
            <?php if(isset($getMessage['viewData']['Body'])) {?>    
                 <?= html_entity_decode($getMessage['viewData']['Body']); ?>
            <?php } else { ?>
                But/and, I also and specifically want to talk about how hard it can feel for those who come from relational trauma backgrounds
            <?php } ?>
        </p>
    </div>
    <div class="mes-footer">
        <div class="test">
            <p>{{ isset($getMessage['viewData']['Subject']) ? $getMessage['viewData']['Subject'] :'Subject' }}</p>
        </div>
        <div class="reply">
            <button type="button" class="outline-button" onclick="replymsgFunction('show')">Reply</button>
        </div> 
        <div class="reply">
            <button type="button" class="outline-button" >Archive</button>
        </div>    
    </div>
    <div class="form reply-div-section" style="display: none">
        <div class="form-row">
            <div class="col-100 form-group">
                <label>Message</label>
                <textarea name="Body" id="body-msg-replay-content" rows="4"></textarea>
            </div>
            <div class="col-100 form-group">
                <div class="msg-replay-ajax-response"></div>
                <div class="cta-v5">

                <button type="button" class="outline-button" onclick="replymsgFunction('hide')">Cancel</button>
                 <button type="button" class="outline-button" onclick="replymsgSendFunction()">Send</button>


                </div>
                

                 
                                 
            <input type="hidden" value="{{ isset($getMessage['viewData']['DoctorID']) ? $getMessage['viewData']['DoctorID'] :'0'}}" name="DoctorID">
            <input type="hidden" value="{{ isset($getMessage['viewData']['PatientID']) ? $getMessage['viewData']['PatientID'] : '0'}}" name="PatientID">
            
            <?php if(isset($getMessage['viewData']['Body'])) {?> 
            <input type="hidden" value="{{ $docType[$getMessage['viewData']['RouteName']]  }}" name="Route" >
            <input type="hidden" value="{{ isset($getMessage['viewData']['ThreadID']) ? $getMessage['viewData']['ThreadID'] : '0'}}" name="ThreadID">
            <input type="hidden" value="{{ isset($getMessage['viewData']['Subject']) ? $getMessage['viewData']['Subject'] : '0'}}" name="Subject">
            <input type="hidden" value="{{ isset($getMessage['viewData']['FromName']) ? $getMessage['viewData']['FromName'] : '0' }}" name="FromName">
            <input type="hidden" value="{{ isset($getMessage['viewData']['Original_msg_id']) ? $getMessage['viewData']['Original_msg_id'] : '0' }}" name="Original_msg_id">
              <?php } ?>     
                    
             


            </div>     
        </div>    
    </div>
</div>

<script>
    function replymsgFunction(toogle_type){
        
        if(toogle_type=="show") {
            $(".form.reply-div-section").show();
            $('.msg-det-reply-list').scrollTop($('.msg-det-reply-list')[0].scrollHeight+200);
        } else {
            $(".msg-replay-ajax-response").html("");
            $(".form.reply-div-section").hide();
        }
        
       
    }
    function replymsgSendFunction() {
        if($("#body-msg-replay-content").val()=="") {
            $(".msg-replay-ajax-response").html("<p class='error'>Please Enter your message.</p>")
            return false;
        }
        const formData = new FormData();
        formData.append('_token',$('meta[name="csrf-token"]').attr('content'));

        <?php if(isset($getMessage['viewData']['Body'])) {?>   

            formData.append('DoctorID',"{{$getMessage['viewData']['DoctorID']}}");
            formData.append('PatientID',"{{$getMessage['viewData']['PatientID']}}");
            formData.append('Route',"0");
            formData.append('ThreadID',"{{$getMessage['viewData']['ThreadID']}}");
            formData.append('Subject',"{{$getMessage['viewData']['Subject']}}");
            formData.append('FromName',"{{$getMessage['viewData']['FromName']}}");
            formData.append('Original_msg_id',"{{$getMessage['viewData']['Original_msg_id']}}");
            formData.append('Body',$("#body-msg-replay-content").val());

         <?php } ?>   

        $(".msg-replay-ajax-response").html("<p class='error'>Please wait...</p>")
        $.ajax({
                url:'{{ route("postMessageReply") }}',
                method:'POST',
                data:formData,
                processData:false,
                contentType:false,
                error:(error) => console.log( error ),
                beforeSend: function(){
                    //$('.msg-det-reply-list').html("Please wait...");
                },
                complete: function(){
                },
                success:(result) => {
                    if(result.success) {
                        $(".msg-replay-ajax-response").html("<p class='error' style='color:green;'>"+result.message+"</p>")
                        $("#body-msg-replay-content").val(null);
                        $('.msg-det-reply-list').scrollTop($('.msg-det-reply-list')[0].scrollHeight+200);
                    } else {
                        $(".msg-replay-ajax-response").html("<p class='error'>"+result.message+"</p>")
                    }
                   
                },error: function (xhr, status, error) {
                    $(".msg-replay-ajax-response").html("<p class='error'>Please Try Again Later.</p>")
                }
            });

    }
</script>

<?php /*
<?php 

?>

echo "<pre>";
    print_r($getMessage);
    echo "</pre>";

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
                    <textarea name="Body" rows="8" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="messageSendButton">
                    <a class="cancelReply" title="cancel">Cancel</a>
                    <button type="suubmit" class="btn btn-primary mr-2">Send</button>
                </div>
            </form>
        </div>
    </div>
    <div class="messaeBody">
        <?= html_entity_decode($getMessage['viewData']['Body']); ?>
    </div>
</div>
*/ ?>