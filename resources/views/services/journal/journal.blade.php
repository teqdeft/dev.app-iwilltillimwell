@extends('layouts.dashboard')
@section('content')
@if(LoginUserBToBVerification())

<div class="main-panel">
<div class="moodContainer journal-container content-wrapper">
	
   
   <div class="row">
      <div class="col-12 grid-margin stretch-card">
         <div class="card card-body">
            <div class="all-consultations-box all-consultations-box2  p-3">
               <div class="row">
                  <div class="col-md-12">

                 
                        <div class="cust-heading-wrap">
                           <h3 class="cust-heading cust-heading-view">SELECT YOUR JOURNAL PROMPT</h3>
                           <a class="mood-view-icon" href="{{ url('view-journal-log')  }}">View log <i class="fas fa-eye" aria-hidden="true"></i></a>
                        </div>
                        <div class="journal-post-block">
                           <form class="post-form" action="{{ url('my-journal-written-save') }}" method="post" id="corporateJournal">
                              @csrf
                              <div class="journal-custom-post">
                                 <div class="journal-select-btn-wrap"><button type="button" class="theme-dark__btn select-btn btn btn-primary addFontPlus" data-toggle="modal" data-target="#adminTitleModal"><i class="fa fa-plus" aria-hidden="true"></i>Select</button></div>
                                 <div class='journalTitle'>
                                    <input placeholder="Write Your Custom Journal Prompt:" name="title" class="form-control" value="">
                                 </div>
                              </div>
                              <div class="form-group">
                                    <div class="journalDesc">
                                       <textarea placeholder="Type your thoughts or put pen to paper" name="description" id="description" class="cust-textarea form-control" spellcheck="false" rows="20"></textarea>
                                    </div>
                              </div>
                              <div class="text-right form-group"><button type="submit" class="theme-dark__btn submit-btn btn btn-primary">Submit</button></div>
                           </form>
                     </div>

                  

                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
<style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
</style>
@include('services.journal.adminTitle')

@else

<div class="main-panel">
    <div class="content-wrapper">
		<div class="row">
        <div class="col-12 grid-margin stretch-card btob-admin">
                <div class="card card-body">
                 {{ LoginUserBToBVerificationMSG() }}
             </div>
        </div>
    </div>

@endif
</div>

@endsection
