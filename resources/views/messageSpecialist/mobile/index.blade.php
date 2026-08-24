@extends("mobile.layouts.dashboard")
@section("content")
<div class="message-div">
    <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{url('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">Message a Specialist</h2>
                </div>
                
                <div class="msg-menu toggle-main">
                    <div class="edit-icon toggle-icon">
                        <img src="{{ asset('assets/dashboard/assets/images/upload-img-setting.png')}}" alt="icon">
                    </div>

                    <!-- Toggle div -->
                    <div class="toggle-content hidden">
                        <div class="msg-togl">
                            <div class="inbox" onclick="inbox_view('inbox')">
                                <a href="javascript:void(0);" class="getMessageHeaders" passUrl="getMessageHeaders" pageId="1">Inbox  @if( isset($getInboxInfo['viewData']['UnreadCount']) && !empty($getInboxInfo['viewData']['UnreadCount']) ) ( {{ $getInboxInfo['viewData']['UnreadCount'] }} ) @endif</a>
                            </div>
                            <div class="archive" onclick="inbox_view('archive')">
                                <a href="javascript:void(0);" class="getMessageHeaders" passUrl="getMessageHeadersByView" pageId="1">Show Archived</a>
                            </div>
                        </div>
                    </div>
                    <!-- end -->

                </div>
            </div>
        </div>
   </section>

   <section class="specilist-list">
    <div class="cust-container-md">
        <div class="title">
            <p>What type of Specialist would you like to message?</p>
        </div>

        <div class="list-row">

            
            @if($data)
                @foreach ($data as $key => $value )
                        <div class="list-card">
                            <a href="javascript:void(0)" onclick="show_popup_message('messagetospecialist',{{ $value['idNo'] }})">
                                <div class="icon">
                                    <img src="{{ $value['img'] }}" alt="{{ $value['title'] }}">
                                </div>
                                <div class="detail">
                                    <p>{{ $value['title'] }}</p>
                                </div>
                            </a>
                        </div>
                @endforeach
            @endif

        </div>

    </div>
   </section>


   <!-- Popup 1 -->
    <div class="popup" id="messagetospecialist">
        <div class="popup-content text-let">
            <span class="popup-close-icon" onclick="close_popup('messagetospecialist')">&times;</span>
            <div class="type-specialist">

                <div class="po-title">
                    <p>Type of Specialist</p>
                </div>
<form action="{{ url('postMessage') }}" method="POST" id="messageForm">
                            @csrf
                <div class="form">
                    <div class="form-row">

                        
                            <input type="hidden" name="PatientId" value="{{ Auth::user()->userid }}" >
                        <div class="col-100 form-group" style="display:none;">
                            
                            <select name="Route" id="Route">
                                @if($data)
                                    @foreach ($data as $key => $value )
                                    <option  value="{{ $value['idNo'] }}">{{ $value['title'] }}</option>   
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-100 form-group">
                            <label>Subject <span class="required-ico">*</span></label>
                            <input class="form-control" type="text" name="Subject" id="subject" >
                        </div>

                        <div class="col-100 form-group">
                            <label>Message <span class="required-ico">*</span></label>
                            <textarea name="Body" id="body_message" rows="4"></textarea>
                        </div>

                        <div class="col-100 cta">
                            <div class="recorc-cta">
							
                                <button type="button" class="outline-button" onclick="close_popup('messagetospecialist')">Cancel</button>
                                <button type="button" class="primary-button" onclick="return sendMessageSpecialist()">Send</button>
								
                            </div>
                        </div>
                    
                    </div>
                </div>
</form>
            </div>
        </div>
    </div>

</div>


<div class="inbox-div" style="display:none;">
    <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="javascript:void(0)" class="back-btn" onclick="inbox_view('message-div')">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Inbox</h2>
                </div>
            </div>
        </div>
   </section>
   <section class="specilist-list inbox">
        <div class="cust-container-md">
            <div class="title"><p>Messages</p></div>  
            <div class="inbox-row inbox-div-response" style="min-height: 50vh; max-height: max-content;">
            </div>
        </div>    
   </section>
</div>


<div class="archived-div" style="display: none">
    <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="javascript:void(0)" class="back-btn" onclick="inbox_view('message-div')">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Show Archived</h2>
                </div>
            </div>
        </div>
   </section>
   <section class="specilist-list inbox">
    <div class="cust-container-md">
        <div class="title"><p>Messages</p></div>  
        <div class="inbox-row inbox-div-response">
            
        </div>
    </div>    
</section>
</div>

<section class="popup-section">
    <div class="popup message-detail-main" id="open-message-popup-div"> 
        <div class="popup-content text-let">
            <span class="popup-close-icon" onclick="close_popup('open-message-popup-div')">
                &nbsp;
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_473_260)">
                    <path d="M16.36 3.634C15.5249 2.7973 14.5328 2.13378 13.4406 1.68151C12.3484 1.22924 11.1776 0.997126 9.9955 0.998495C5.0245 0.998495 0.994751 5.02825 0.994751 9.99925C0.994751 12.4847 2.00275 14.7355 3.63175 16.3645C4.46685 17.2012 5.45897 17.8647 6.55116 18.317C7.64335 18.7693 8.81412 19.0014 9.99625 19C14.9672 19 18.997 14.9702 18.997 9.99925C18.997 7.51375 17.989 5.263 16.36 3.634ZM15.2035 15.2042C14.5201 15.8887 13.7084 16.4316 12.8149 16.8017C11.9213 17.1719 10.9634 17.362 9.99625 17.3612C5.929 17.3612 2.632 14.0642 2.632 9.997C2.63124 9.0298 2.82138 8.07196 3.19152 7.17839C3.56167 6.28483 4.10453 5.4731 4.789 4.78975C5.47227 4.10537 6.28387 3.56255 7.1773 3.19241C8.07074 2.82227 9.02843 2.63208 9.9955 2.63275C14.062 2.63275 17.359 5.92975 17.359 9.99625C17.3597 10.9633 17.1695 11.921 16.7993 12.8144C16.4292 13.7079 15.8864 14.5195 15.202 15.2027L15.2035 15.2042Z" fill="white"/>
                    <path d="M11.1528 9.99999L14.044 7.10874C14.1866 6.95329 14.2637 6.74876 14.2591 6.53784C14.2545 6.32693 14.1687 6.12593 14.0195 5.9768C13.8702 5.82768 13.6692 5.74195 13.4583 5.73751C13.2474 5.73307 13.0429 5.81027 12.8875 5.95299L12.8883 5.95224L9.99701 8.84349L7.10576 5.95224C6.95031 5.80962 6.74577 5.73256 6.53486 5.73713C6.32394 5.7417 6.12294 5.82756 5.97382 5.97679C5.82469 6.12601 5.73896 6.32706 5.73453 6.53798C5.73009 6.7489 5.80729 6.95338 5.95001 7.10874L5.94926 7.10799L8.84051 9.99924L5.94926 12.8905C5.86791 12.9651 5.80251 13.0554 5.75698 13.156C5.71146 13.2566 5.68676 13.3653 5.68437 13.4757C5.68197 13.5861 5.70194 13.6958 5.74306 13.7982C5.78418 13.9007 5.84561 13.9938 5.92365 14.0718C6.00168 14.1499 6.09471 14.2114 6.19714 14.2526C6.29956 14.2938 6.40926 14.3138 6.51963 14.3115C6.63 14.3092 6.73876 14.2846 6.83936 14.2391C6.93996 14.1936 7.03033 14.1283 7.10501 14.047L7.10576 14.0462L9.99701 11.155L12.8883 14.0462C12.9629 14.1276 13.0532 14.193 13.1538 14.2385C13.2544 14.284 13.3631 14.3087 13.4735 14.3111C13.5838 14.3135 13.6936 14.2936 13.796 14.2524C13.8985 14.2113 13.9915 14.1499 14.0696 14.0719C14.1477 13.9938 14.2092 13.9008 14.2504 13.7984C14.2916 13.6959 14.3116 13.5862 14.3093 13.4759C14.307 13.3655 14.2823 13.2567 14.2369 13.1561C14.1914 13.0555 14.1261 12.9652 14.0448 12.8905L14.044 12.8897L11.1528 9.99999Z" fill="white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_473_260">
                    <rect width="18" height="18" fill="white" transform="translate(1 1)"/>
                    </clipPath>
                    </defs>
                </svg>                    
            </span>
            <div class="msg-det-reply-list" style="    height: 600px;overflow-x: scroll;">
            </div>
        </div>
    </div>
</section>


<script>
        document.querySelectorAll('.toggle-icon').forEach(icon => {
            icon.addEventListener('click', function (event) {
                document.querySelectorAll('.toggle-content').forEach(content => {
                    if (content !== this.nextElementSibling) {
                        content.classList.add('hidden');
                    }
                });
                const content = this.nextElementSibling;
                content.classList.toggle('hidden');

                event.stopPropagation();
            });
        });

        document.addEventListener('click', function () {
            document.querySelectorAll('.toggle-content').forEach(content => {
                content.classList.add('hidden');
            });
        });

        document.querySelectorAll('.toggle-content').forEach(content => {
            content.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
function show_popup_message(id,index) {

    $("#"+id).addClass("show");
    $("#Route").val(index);
}
function inbox_view(request){
    if(request=="message-div"){
        $(".inbox-div").hide();
        $(".archived-div").hide();
        $(".message-div").show();
        
    } else if(request=="archive"){
        $(".archived-div").show();
        $(".message-div").hide();
        CallAjaxForGetMessageHeaders(1,'getMessageHeadersByView');
    } else {
        $(".inbox-div").show();
        $(".message-div").hide();
        CallAjaxForGetMessageHeaders(1,'getMessageHeaders');
    }
}
function CallAjaxForGetMessageHeaders(page,passUrl) {
   
    $.ajax({
        url:`${SITE_URL}/${passUrl}`,
        method:'GET',
        data:{"_token": $('meta[name="csrf-token"]').attr('content'),page:page,sortField:'date',sortOrder:'desc' },
        context:this,
        error:(error) => console.log( error ),
        beforeSend: function(){
            $('.inbox-div-response').html("Please wait...");
        },
        complete: function(){
        },
        success:(result) => {
            $('.inbox-div-response').html(result);
        }
    })
}
function CallAjaxForGetMessageRplyView(passUrl,messageId) {
   
   $.ajax({
       url:`${SITE_URL}/${passUrl}`,
       method:'GET',
       data:{"_token": $('meta[name="csrf-token"]').attr('content'),messageId:messageId},
       context:this,
       error:(error) => console.log( error ),
       beforeSend: function(){
           $('.msg-det-reply-list').html("Please wait...");
       },
       complete: function(){
       },
       success:(result) => {
           $('.msg-det-reply-list').html(result);
       }
   })
}
$(document).on('click','.open-message-popup',function(){
   $("#open-message-popup-div").addClass("show");
   let messageId = $(this).attr("messageId");
   CallAjaxForGetMessageRplyView('getSingleMessage',messageId);
});

function sendMessageSpecialist() {

    let subject = $("#subject").val();
    let body_message = $("#body_message").val();

    if(!subject) {
        toastr.error("Subject is Required");
        return false;
    }
    if(!body_message) {
        toastr.error("Message is Required");
        return false;
    }
    showLoaderPageLoad('show');
	CallsendMessageSpecialist();
}
function CallsendMessageSpecialist() {
	
	let form = document.getElementById('messageForm');
    let formData = new FormData(form);

    $.ajax({
        url: "{{ url('postMessage') }}",
        type: "POST",
        data: formData,
        processData: false,   
        contentType: false, 
        beforeSend: function() {
            
        },
        success: function(response) {
			showLoaderPageLoad('hide');
			if(response.success) {
				close_popup('messagetospecialist')
				showLoaderPageLoad('hide');
				toastr.success(response.message);
				form.reset();
			} else {
				showLoaderPageLoad('hide');
				toastr.error(response.message);
			}
        },
        error: function(xhr) {
			showLoaderPageLoad('hide');
            toastr.error(response.message);
        }
    });

    return false;
	
}
</script>

@include('mobile.includes.foooter-tab')
@endsection

