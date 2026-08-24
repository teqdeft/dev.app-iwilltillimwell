@extends("mobile.layouts.dashboard")
@section("content")

<section class="written-journal-head">
        <div class="cust-container-md">
            <div class="header">
                <div class="back">
                    <a href="{{ route('mobile-dashboard') }}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="title">
                    <p>Journal</p>
                </div>
            </div>
        </div>
</section>


<section class="written-journal">
        <div class="cust-container-md">
        @if(LoginUserBToBVerification())

            <div class="my-jounr toggle-main min-left">
                <div class="left-t">
                    <p>My journal</p>
                </div>
				<div class="edit-or-replace">
					<div class="download">
						<a href="{{ route('view-journal-log') }}">View journal</a>
					</div>
					<div class="delete">
						<a href="{{ route('journal-affirmation')}}">Requested affirmations</a>
					</div>
				</div>
            </div>
			
            <div class="your-thoughts">
                <a href="#" class="outline-button open-modal" data-modal="CereateJournalModal">Create Topic</a>
                <div class="or">
                    <p>or</p>
                </div>
                <a href="#" class="outline-button open-modal select-topic" data-modal="TopicJournalModal">Select Topic</a>
            </div>
			
            <div class="write-thought">
                <form id="journal-topic" method="post" class="form-row post-form-journal" action="{{ route('my-journal-written-save') }}">
                @csrf
				
                    <div class="col-100 form-group">
                        <label>Topic</label>
                        <input name="title" id="title" type="text" class="form-control post-form-journal-title" >
                       
                    </div>
					
                    <div class="col-100 form-group">
                        <label>Type your thoughts</label>
                        <textarea placeholder="Enter here" rows="6" spellcheck="false" name="description" id="description"></textarea>
                    </div>

                    <div class="cta-save">
                        <button type="button" class="primary-button" onclick="return SaveTopic()">Save</button>
                    </div>

                </form>
            </div>

            @else
            {{ LoginUserBToBVerificationMSG() }}

            @endif
        </div>
    </section>


    <div id="CereateJournalModal" class="modal create journal-modal">
        <div class="modal-content">
            <span class="close-modal">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="modal-title">
                    <p>Topic</p>
                </div>
                <div class="modal-form">
                    <form>

                        <div class="col-100 form-group enth">
                            
                            <input class="form-control" type="text" name="create_topick" id="create_topick">
                        </div>

                        <div class="col-100 cta">
                            <button type="button" class="primary-button" onclick="CereateJournalNext();">Next</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<div id="TopicJournalModal" class="modal create journal-modal">
        <div class="modal-content">
            <span class="close-modal">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="modal-title">
                    <p>Journal topic.</p>
                </div>
                <div class="modal-form">
                   

                        <div class="col-100 form-group enth">
                            <div class="custom-radio-group indicate-radio">
                               
                            @if (!$journal->isEmpty())   
                                 @foreach ($journal as $value)                        
                                        <label class="custom-radio">
                                                <input type="radio" name="titleName" value="{{ $value->title }}">
                                                <span class="custom-radio-button"></span>
                                                {{ $value->title  }}
                                        </label>
                                @endforeach
                            @endif

                            </div>
                        </div>

                        <div class="col-100 cta">
                            
                            <button type="button" class="primary-button selectJournal">Next</button>
                        </div>

                    
                </div>
            </div>
        </div>
</div>

@include('mobile.includes.foooter-tab')


<script>
        const openModalButtons = document.querySelectorAll('.open-modal');
        const closeModalButtons = document.querySelectorAll('.close-modal');
        const modals = document.querySelectorAll('.modal');
    
        openModalButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const modalId = button.getAttribute('data-modal');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }
            });
        });
    
        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                const modal = button.closest('.modal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        });
    
        window.addEventListener('click', (e) => {
            modals.forEach(modal => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        });
    </script>

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

$(document).on("click", ".selectJournal", function(e) {
    e.preventDefault();
    $(".journalTitle").children('input').val('');
    let titleValue = $('input[name=titleName]:checked').val();
    console.log(titleValue);
    $(".post-form-journal-title").val(titleValue);
    $(".close-modal").trigger("click");
});

/* $(document).on("click", ".post-form-journal-title", function(e) {
   $("#TopicJournalModal").css("display","flex");
   console.log("//////////////");
}); */

function CereateJournalNext() {

    let create_topick = $("#create_topick").val();
    $(".post-form-journal-title").val(create_topick);
    $("#create_topick").val(null);
    $(".close-modal").trigger("click");
}

function SaveTopic(){
    let title = $("#title").val();
    let description = $("#description").val();
    if(!title) {
        toastr.error("Topic Missing");
        return false;
    }
    if(!description) {
        toastr.error("Description Missing");
        return false;
    }
    SaveTopicCallAjax();
}
function SaveTopicCallAjax(){
	
	showLoaderPageLoad('show');
	let title = $("#title").val();
	let form = document.getElementById('journal-topic');
    let formData = new FormData(form);
	formData.append("title",title);
    $.ajax({
        url: "{{ url('my-journal-written-save') }}",
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
@endsection