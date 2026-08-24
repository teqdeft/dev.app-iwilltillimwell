@if($allDependent)
<div class="viewing-records">

                                    <div class="app-heading">
                                        <p>Viewing records for:</p>
                                    </div>

                                    <div class="vi-re-i">
                                        <p>* Dependent is over 18 and must manage their own records.</p>
                                    </div>

     @foreach($allDependent as $key => $dependent) 
	 
            <div id="dependent-{{$dependent->id}}"  data-dependent="{{ json_encode($dependent) }}">  
                                       
				
					
				
				<input type="hidden" value="{{ route('update.relatioship', $dependent->id) }}" id="dependent-relationship-{{$dependent->id}}">
				<input type="hidden" value="{{ route('resend.dependent.email', $dependent->id) }}" id="dependent-resend-email-{{$dependent->id}}">
				<input type="hidden" value="" id="dependent-change-email-{{$dependent->id}}">
				<input type="hidden" value="{{ route('update.status', $dependent->id) }}" id="dependent-status-{{$dependent->id}}">
				
				<input type="hidden"  id="dependent-age-{{$dependent->id}}"
				@if(getAge($dependent->dob) < Config::get('constants.minor_age'))
					value="dependent-eighteen-below"
				@else 
					value="dependent-eighteen-plus"
				@endif	
				>
				
                                    <div class="new-depn">
                                        <button class="primary-button">
										{{$dependent->fname}} {{$dependent->lname}}
											
										</button>
                                    </div>
                                    
                                    <div  class="dependent-detail">
                                        
                                        <div class="edit-bt">
                                            <a href="javascript:void(0)" onclick="showaddeditform('{{$dependent->id}}')">
                                                <img src="{{ asset('assets/dashboard/assets/images/edit_pencil.svg')}}" alt="icon">
                                            </a>
                                        </div>

                                        <div class="depn-row">
                                            <div class="depent-card">
                                                <div class="title">
                                                    <p>Name</p>
                                                </div>
                                                <div class="value">
                                                    <p><?php echo $dependent->fname?></p>
                                                </div>
                                            </div>

                                            <div class="depent-card">
                                                <div class="title">
                                                    <p>Last Name</p>
                                                </div>
                                                <div class="value">
                                                    <p><?php echo $dependent->lname?></p>
                                                </div>
                                            </div>

                                            <div class="depent-card">
                                                <div class="title">
                                                    <p>Relationship</p>
                                                </div>
                                                <div class="value">
                                                    <p>

                                                        @if($dependent->relationship == '1')
                                                            Spouse
                                                        @elseif($dependent->relationship == '2')    
                                                            Child
                                                        @elseif($dependent->relationship == '3')
                                                            Other
                                                        @endif
    
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="depent-card">
                                                <div class="title">
                                                    <p>Gender</p>
                                                </div>
                                                <div class="value">
                                                    <p>
                                                        
                                                        @if($dependent->gender == 'm')
                                                            Male
                                                        @elseif($dependent->gender == 'f')    
                                                            Female
                                                        @elseif($dependent->gender == '0')
                                                            Other
                                                        @endif
    
                                                    </p>
                                                </div>
                                            </div>

                                            
                                            <div class="depent-card">
                                                <div class="title">
                                                    <p>Dob</p>
                                                </div>
                                                <div class="value">
                                                    <p><?php echo $dependent->dob?></p>
                                                </div>
                                            </div>
                                            <div class="depent-card">
                                                <div class="title">
                                                    <p>Phone</p>
                                                </div>
                                                <div class="value">
                                                    <p><?php echo $dependent->primaryPhone?></p>
                                                </div>
                                            </div>

                                        </div>
                                       
                                    </div>
            </div>                        
        @endforeach
</div>
@endif