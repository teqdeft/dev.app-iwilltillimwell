<form class="row" action="{{ route('subscribe-to-counseling') }}" id="subscribe-to-counseling" method="post" class="validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
   @csrf
<!--   <div class="col-sm-12">
     <div class="form-group">
        <label for="Counseling">Select Counseling </label>
        <select class="commanSelect2 form-control groupCounselingSelection" name="select_counseling">

           <option>Select Group Counseling</option>
            @foreach($allCounseling as $eachValue)
               <option value="{{ $eachValue->id}}">
                       {{ ucfirst($eachValue->title) }}&nbsp
                       @foreach($eachValue->timeTable as $subValue)
                         ( {{$subValue->date}} &nbsp {{ $subValue->startTime }} To {{$subValue->endTime}})&nbsp
                         <br>
                   @endforeach
               </option>
            @endforeach
        </select>
     </div>

   </div>-->

   <div class="col-sm-12">
      <div class="form-group">
         <h5 id="counseling-title" style="text-align:center;"></h5>
      </div>
   </div>

   <div class="col-sm-6">
      <div class="form-group">
         <label for="firs_name">First Name </label>
         <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="nameHelp" placeholder="Enter First name">
         <input type="hidden" name="select_counseling" id="select_counseling" >
      </div>
   </div>

   <div class="col-sm-6">
      <div class="form-group">
         <label for="last_name">Last Name </label>
         <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="nameHelp" placeholder="Enter Last name">

      </div>
   </div>

   <div class="col-sm-6">
      <div class="form-group">
         <label for="email">Email</label>
         <input type="text" class="form-control" id="email" name="email" aria-describedby="nameHelp" placeholder="Enter Email">
      </div>
   </div>

   <div class="col-sm-6">
      <div class="form-group">
         <label for="phone_number">Phone Number</label>
         <input type="number" class="form-control" id="phone_number" name="phone_number" aria-describedby="numberHelp" placeholder="Enter phone number">
      </div>
   </div>

   <div class="col-sm-6">
      <div class="form-group">

         <div id="dropin-container"></div>
         <input type="hidden" id="nonce" name="payment_method_nonce" />
      </div>
   </div>

   <div class="col-sm-12">
      <div class="form-group">
         <input type="submit" class="custom-button btn btn-primary" />
      </div>
   </div>

   <div class="col-sm-12">
     <div class="form-group preview-step-button">
        <button type="button" class="btn btn-primary" style="float:right;" />Preview</button>
     </div>
   </div>
</form>
