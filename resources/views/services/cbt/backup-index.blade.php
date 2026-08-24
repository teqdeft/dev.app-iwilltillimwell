@extends('layouts.v1.dashboard')
@section('content')
@if(LoginUserBToBVerification())
<div class='moodContainer content-wrapper cbt-therapy-stands cbt-therapy-main'>    


	<div class="row">      
		<div class="col-md-12 grid-margin">        
			<div class="row">          
				<div class="col-12 col-xl-6 mb-4 mb-xl-0">            
					<div class="patient-details ">              
						<div class="media">                
							<div class="title-heading-icon-box-cus">                  
								<i class="far fa-calendar-alt"></i>                
							</div>                
							<div class="media-body"> 
							<?php /*<h3 class="font-weight-bold"> My Cognitive Behavioural Therapy</h3>*/ ?>
							<h3 class="font-weight-bold"> My Thought Analysis</h3>
							</div>              
						</div>           
					</div>          
				</div>        
			</div>      
		</div>    
	</div>



    <div class="card--white full-height feels-view">

			<div class="cust-heading-wrap">
			
				<h3 class="font-weight-bold page-heading"> Automatic Thoughts</h3>
				
                <h3 class="cust-heading cust-heading-view"></h3>
                <a class="mood-view-icon" href="{{ url('cbt-therapy-list') }}">View log <i class="fas fa-eye"
                        aria-hidden="true"></i></a>
            </div>
			
				<div class="ser-sum-main align-items-center">
				   <p class="mb-2 page-content-section">CBT (Cognitive Behavioral Therapy) helps to identify and rewire negative automatic thought patterns causing you distress. Your thinking shapes how you feel and how you act.</p>
				</div>
				
				
       
            
             <form class="cbt regForm" action="{{ url('cbt-therapy-save') }}" method="POST" id="regForm">
                @csrf
                <div class="tab">
                    <label>What's Your Automatic Thought ?</label>
					<p>(Just jot down the raw thought that exist within your head, e.g., "I'm a complete failure". Be specific and don't edit it right now.)</p>
                    <div class="form-input">
                        <input type="hidden" value="{{$data['id']}}" name="id" />
                        <textarea rows="5" placeholder="The plane might crash" name="automatic_thought" oninput="this.className = ''">{{$data['automatic_thought']}}</textarea>
                    </div>
                </div>
                <div class="tab">
                    <label>Select any distortions that apply</label>
                    <div class="form-input cust-form">
                        <label class="switch">
                            <input type="checkbox" id="distortions_apply" checked>
                            <span class="slider round"></span>
                        </label>
                        <h2>Show Detailed description</h2>
                        <div class="checkbox cbt-therapy-details-main">
                            @foreach (Config('constants.CBT_DETAILS') as $key => $value )
                                <div class="cust-check">
                                    <input type="checkbox" value="{{$key}}" id="check-{{ $key }}" name="thought_details[]" 
                                    @if (!empty($data['thought_details']) && in_array($key, json_decode($data['thought_details'])) )  checked  @endif
                                    >
                                    <label for="check-{{ $key }}">
                                        {{ $value['title'] }}
                                        <div class="check-para check-para-short">
                                            <p>{{ $value['short'] }}</p>
                                        </div>
                                        <div class="check-para check-para-long check-para-{{ $key }} displayNone">
                                            <?= $value['long'] ?>
                                        </div>

                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="tab">
                    <label>Challenge the thought</label>
                    <div class="form-input">
                    <textarea placeholder="it might not be true that" oninput="this.className = ''" name="challenge_thought" >{{$data['automatic_thought']}}</textarea>
                </div>
                </div>

                <div class="tab">
                    <label>Write an alternative thought</label>
                    <p>This is not challenge. it's a way to cement an alternative thought.</p>
                    <div class="form-input">
                        <textarea placeholder="What could we think instead..." oninput="this.className = ''" name="alternative_thought" >{{$data['alternative_thought']}}</textarea>
                    </div>

                </div>

                <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" class="prev-btn" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="prev-btn" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
                </div>
                <div style="display: none;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

                </form>
        
    </div>

@push('scripts')
    <script>
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
		console.log("/////"+n);
		
		
				var x = document.getElementsByClassName("tab");
				x[n].style.display = "block";
				if (n == 0) {
					document.getElementById("prevBtn").style.display = "none";
				} else {
					document.getElementById("prevBtn").style.display = "inline";
				}
				if (n == (x.length - 1)) {
					document.getElementById("nextBtn").innerHTML = "Save & Finish";
				} else {
					document.getElementById("nextBtn").innerHTML = "Next";
				}
				fixStepIndicator(n);
				
				if(n==1) {
					$(".page-heading").html("Select Cognitive Distortions");
					$(".page-content-section").html("Select the distortions that apply and select how much that distortion applies to your automatic thought? Low | Medium | High");
				}else if(n==3) {
					$(".page-heading").html("Realistic Alternative");
					$(".page-content-section").html("");
				}else if(n==2) {
					$(".page-heading").html("Challenge the Thoughts");
					$(".page-content-section").html("");
				}else if(n==0) {
					$(".page-heading").html("Automatic Thoughts");
					$(".page-content-section").html("CBT (Cognitive Behavioral Therapy) helps to identify and rewire negative automatic thought patterns causing you distress. Your thinking shapes how you feel and how you act.");
				}
    }

    function nextPrev(n) {
		
		
		var x = document.getElementsByClassName("tab");
		if (n == 1 && !validateForm()) return false;
		x[currentTab].style.display = "none";
		currentTab = currentTab + n;
		if (currentTab >= x.length) {
			document.getElementById("regForm").submit();
			return false;
		}
		
		
		showTab(currentTab);
    }

    function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("textarea");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
        y[i].className += " invalid";
        valid = false;
        }
    }
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;
    }

    function fixStepIndicator(n) {
				var i, x = document.getElementsByClassName("step");
				for (i = 0; i < x.length; i++) {
					x[i].className = x[i].className.replace(" active", "");
				}
				x[n].className += " active";
    }

    /* let distortions_apply = document.getElementById('distortions_apply');
    if( distortions_apply ){
        distortions_apply.addEventListener('change',function(){
            let shortDesc = document.getElementsByClassName('check-para-short');
            let longDesc = document.getElementsByClassName('check-para-long');
            for (let shortKey in shortDesc) {
                if( typeof shortDesc[shortKey].classList !== 'undefined'  ){
                    shortDesc[shortKey].classList.toggle('displayNone');
                }
            }
            for (let longKey in longDesc) {
                if( typeof longDesc[longKey].classList !== 'undefined'  ){
                    longDesc[longKey].classList.toggle('displayNone')
                }
            }
        })
    } */

let distortions_apply = document.getElementById('distortions_apply');
if (distortions_apply) {
    // function to toggle
    function toggleDescriptions() {
        let shortDesc = document.getElementsByClassName('check-para-short');
        let longDesc = document.getElementsByClassName('check-para-long');

        for (let shortKey in shortDesc) {
            if (typeof shortDesc[shortKey].classList !== 'undefined') {
                shortDesc[shortKey].classList.toggle('displayNone');
            }
        }
        for (let longKey in longDesc) {
            if (typeof longDesc[longKey].classList !== 'undefined') {
                longDesc[longKey].classList.toggle('displayNone');
            }
        }
    }

    // run once on page load if checked
    if (distortions_apply.checked) {
        toggleDescriptions();
    }

    // run whenever checkbox changes
    distortions_apply.addEventListener('change', toggleDescriptions);
}

</script>
@endpush
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


<style>
    .cbt.regForm {
    background-color: #FFFFFF;
    margin: 100px auto;
    padding: 40px;
    width: 70%;
    min-width: 300px;
}
.cbt.regForm label {
    font-size: 20px;
    color: black;
    font-weight: bold;
}
.cbt.regForm .form-input textarea {
    padding: 30px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #AAAAAA;
    margin: 20px 0px;
    border-radius: 5px;
    resize: none;
}
.cbt.regForm .tab {
    display: none;
}
.cbt.regForm .prev-btn {
    font-family: var(--body-font);
    font-size: var(--body-font-size);
    line-height: var(--body-line-height);
    color: #fff;
    line-height: 40px;
    font-weight: 400;
    display: inline-block;
    padding: 0px 35px;
    border-radius: 5px;
    border: 2px solid var(--blue-magenta);
    max-width: 300px;
    background: var(--blue-magenta);
    transition: 0.25s;
    letter-spacing: 1px;
    cursor: pointer;
}
.cbt.regForm .invalid {
    background-color: #FFDDDD;
}
.cbt.regForm .form-input .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}
.cbt.regForm .switch {
    margin: 30px 0px;
}
.cbt.regForm label {
    font-size: 20px;
    color: black;
    font-weight: bold;
}
.cbt.regForm .form-input .switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
input[type="radio"], input[type="checkbox"] {
    box-sizing: border-box;
    padding: 0;
}
.cbt.regForm .slider.round {
    border-radius: 34px;
}
.cbt.regForm .form-input .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}
.cbt.regForm .slider.round:before {
    border-radius: 50%;
}
.cbt.regForm .form-input .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}
.cbt.regForm .cust-form .cust-check label {
    border: 1px solid #AAAAAA;
    margin-bottom: 10px;
    width: 100%;
    padding: 20px 40px;
    font-size: 20px;
    border-radius: 5px;
    display: block;
    cursor: pointer;
    transition: all 0.5s;
}
.cbt.regForm .cust-form .cust-check .check-para {
    background-color: #F0F3F0;
    padding: 15px 20px;
    margin-top: 20px;
    border-radius: 5px;
    color: #221F1F;
}
.check-para.check-para-short {
    margin-bottom: 10px;
}
p:first-of-type {
    margin-top: 0;
}
.cbt.regForm .cust-form .cust-check .check-para {
    background-color: #F0F3F0;
    padding: 15px 20px;
    margin-top: 20px;
    border-radius: 5px;
    color: #221F1F;
}
.displayNone {
    display: none !important;
}
.cbt.regForm .cust-form .cust-check input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    top: 32%;
    left: 45%;
}
</style>
</div>
@endsection
