@extends('layouts.default')
@section('content')

<div class="banner-sec tele-counseling-banner inner-main-banner">
  <div class="cust-container">
    <div class="banner-cont">
      <h1 class=" wow fadeInUp animated">
        @if(isset($formatedData['section0-left']) && $formatedData['section0-left']['type'] == 'text')
        {!! html_entity_decode($formatedData['section0-left']['content']) !!}
        @endif
      </h1>
    </div>
  </div>
</div>
<section class="information-sec">
  <div class="cust-container">
    <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">

      <div class="row">
        <div class="col-sm-6">
          <div class="content-inner-box wow fadeInLeft animated">
            @if(isset($formatedData['section1-left']) && $formatedData['section1-left']['type'] == 'single-image')
            <img src="{{ url($formatedData['section1-left']['section_file']) }}" alt="banner-rgt-img">
            @endif
          </div>
        </div>
        <div class="col-sm-6">
          @if(isset($formatedData['section1-right']) && $formatedData['section1-right']['type'] == 'text')
          {!! html_entity_decode($formatedData['section1-right']['content']) !!}
          @endif
          <div class="talk-to-therapist">
              <div class="register-link mt-3">
                  <!--@if (Route::has('login'))-->
                  @auth
                  <a href="{{ url('behavioral-health') }}">Talk To Therapist</a>
                  
                  @else
                  <a href="{{ url('login') }}">Talk To Therapist</a>
                  @endauth
                  <!--@endif-->
            </div>
          </div>
        </div>


      </div>

      <div class="content-box-main wow fadeInUp animated">

        <div class="row">
          @if($formatedData['section2']['type'] == 'gallery')
          @foreach($formatedData['section2']['children'] as $key => $eachValue)
          <div class="col-sm-4">
            <div class="inner-content-box-main main-content-one">
              <img src="{{  url($eachValue->section_file) }}" alt="light-img" />

              <h5>{{ $eachValue->section_title }}</h5>
            </div>

          </div>

          @endforeach
          @endif




        </div>
      </div>
      <hr>
      <div class="content-box-tc wow fadeInUp animated">
        @if(isset($formatedData['section3']) && $formatedData['section3']['type'] == 'text')
        {!! html_entity_decode($formatedData['section3']['content']) !!}
        @endif


        <hr>

        <div class="inner-content-box-tc mt-5">
          @if(isset($formatedData['section4']) && $formatedData['section4']['type'] == 'text')
          {!! html_entity_decode($formatedData['section4']['content']) !!}
          @endif


          <div class="bg-color-cus">

            <div class="emergency-contact-form-box mt-4">
              <h2 class="theme-heading-text fs-30 lh-1-4">Emergency Contact:</h2>
              <form class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter full name">

                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="">Relationship</label>
                    <select class="form-control theme-select ">
                      <option selected="">Select a relationship</option>
                      <option>Spouse </option>
                      <option>Child</option>
                      <option>Other</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPhonenumber">Phone Number</label>
                    <input type="number" class="form-control" id="exampleInputPhonenumber" aria-describedby="numberHelp" placeholder="Enter phone number">

                  </div>
                </div>
                <div class="col-md-12">
                  <h4 class="mb-0">Acknowledgement</h4>
                  <div class="form-group">
                    <label><input type="checkbox" name="agreementwithabove" value="Yes i have read and understand above information"> I have read and understand above information.</label>
                    <br>
                    <label><input type="checkbox" name="consenttoiwtiw" value="I hereby give my informed consent to IWTIW to use Counseling/TeleCounseling Treatment in my care."> I hereby give my informed consent to IWTIW to use Counseling/TeleCounseling Treatment in my care.</label>
                  </div>

                </div>
                <div class="col-sm-12">
                  <div class="register-link mt-3"><a href="#0">Submit</a></div>
                </div>




              </form>

            </div>



            <div class="emergency-contact-form-box mt-5">
              <h2 class="theme-heading-text fs-30 lh-1-4">Client's current location for TCT Appointments:</h2>
              <form>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputPhonenumber1">Phone Number</label>
                      <input type="number" class="form-control" id="exampleInputPhonenumber1" aria-describedby="numberHelp" placeholder="Enter phone number">

                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">State</label>
                      <select class="form-control theme-select ">
                        <option value="">Select a state</option>
                        <option value="1">Alabama</option>
                        <option value="2">Alaska</option>
                        <option value="53">American Samoa</option>
                        <option value="3">Arizona</option>
                        <option value="4">Arkansas</option>
                        <option value="61">Armed Forces Americas</option>
                        <option value="60">Armed Forces Non-Americas</option>
                        <option value="62">Armed Forces Pacific</option>
                        <option value="5" selected="selected">California</option>
                        <option value="6">Colorado</option>
                        <option value="7">Connecticut</option>
                        <option value="8">Delaware</option>
                        <option value="9">District of Columbia</option>
                        <option value="54">Federated States of Micronesia</option>
                        <option value="10">Florida</option>
                        <option value="11">Georgia</option>
                        <option value="55">Guam</option>
                        <option value="12">Hawaii</option>
                        <option value="13">Idaho</option>
                        <option value="14">Illinois</option>
                        <option value="15">Indiana</option>
                        <option value="16">Iowa</option>
                        <option value="17">Kansas</option>
                        <option value="18">Kentucky</option>
                        <option value="19">Louisiana</option>
                        <option value="20">Maine</option>
                        <option value="56">Marshall Islands</option>
                        <option value="21">Maryland</option>
                        <option value="22">Massachusetts</option>
                        <option value="23">Michigan</option>
                        <option value="24">Minnesota</option>
                        <option value="25">Mississippi</option>
                        <option value="26">Missouri</option>
                        <option value="27">Montana</option>
                        <option value="28">Nebraska</option>
                        <option value="29">Nevada</option>
                        <option value="30">New Hampshire</option>
                        <option value="31">New Jersey</option>
                        <option value="32">New Mexico</option>
                        <option value="33">New York</option>
                        <option value="34">North Carolina</option>
                        <option value="35">North Dakota</option>
                        <option value="57">Northern Mariana Islands</option>
                        <option value="36">Ohio</option>
                        <option value="37">Oklahoma</option>
                        <option value="38">Oregon</option>
                        <option value="58">Palau</option>
                        <option value="39">Pennsylvania</option>
                        <option value="52">Puerto Rico</option>
                        <option value="40">Rhode Island</option>
                        <option value="41">South Carolina</option>
                        <option value="42">South Dakota</option>
                        <option value="43">Tennessee</option>
                        <option value="44">Texas</option>
                        <option value="45">Utah</option>
                        <option value="46">Vermont</option>
                        <option value="59">Virgin Islands</option>
                        <option value="47">Virginia</option>
                        <option value="48">Washington</option>
                        <option value="49">West Virginia</option>
                        <option value="50">Wisconsin</option>
                        <option value="51">Wyoming</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Street address1</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter address1"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Street address2</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter address2"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <h4 class="mb-0">Acknowledgement</h4>
                    <div class="form-group">
                      <label><input type="checkbox" name="agreementwithabove" value="Yes i have read and understand above information"> I have read and understand above information.</label>
                      <br>
                      <label><input type="checkbox" name="consenttoiwtiw" value="I hereby give my informed consent to IWTIW to use Counseling/TeleCounseling Treatment in my care."> I hereby give my informed consent to IWTIW to use Counseling/TeleCounseling Treatment in my care.</label>
                    </div>

                  </div>
                  <div class="col-sm-12">
                    <div class="register-link mt-3"><a href="#0">Submit</a></div>
                  </div>
                </div>
              </form>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>
@endsection