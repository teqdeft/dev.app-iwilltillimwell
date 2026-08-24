@if(!Auth::user()->parentId)
<div id="supporters" class="tab-pane fade">
   
	@if($friendContact)
		
		<div class="support-title">	
		 <h3>Supporters</h3>
		</div>
		
		<table class="table table-striped table-data-theme" id="supporterTableData">
				<thead>
				   <tr>
					  <th scope="col">Name</th>
					  <th scope="col">Relation</th>
					  <th scope="col">Email</th>
					  <th scope="col">Phone Number</th>
					  <th scope="col">Frequency</th>
					  <th scope="col">Share Information</th>
					  <th scope="col">Action</th>
				   </tr>
				</thead>
				<tbody>
				
					@php $i = 0; @endphp
					@foreach ($friendContact as $key => $value )	
					
						<tr>
							<td>{{ ucfirst($value['name']) }}</td>
							<td>{{ ucfirst($value['relation']) }}</td>
							<td>{{ $value['email'] }}</td>
							<td>{{ $value['phone']}}</td>
							<td>{{ $value['frequency'] }}</td>
							<td><?= ($value['information'])?ucfirst(str_replace("_"," ",implode(',',(array_keys(json_decode($value['information'],true)))))):'N/A'; ?></td>
							<td>
								 <a class="deleteByAjax" data-resource="" href="#!" number="{{ $value['id'] }}" data-url="{{ url('share/deleteFriendContact') }}" data-toggle="tooltip" title="Delete">
								 <label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label>
								 </a>
								 <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" sf-id="{{ $value['id'] }}" class="editFrienContacts">
								 <label class="badge badge-danger-cus"><i class="fas fa-edit"></i></label>
								 </a>
							</td>
						</tr>	
						
						@php $i++; @endphp
					@endforeach
				
				</tbody>
		</table>
	@endif
	


<div class="card--white full-height feels-view safety-conent-wrap ps-card-first addMoreSupporterContent">
   <div class="sendFeelTofriend supporters-btn d-flex justify-content-between">
      <div class="send-friend_container ps-pills-content mt-3 mb-3"><a href="#!" class="btn btn-primary addNewSupporter"><i class="fas fa-plus"></i> Add More Supporters</a>
      </div>
     
   </div>
</div>
<x-edit-friend-contact-form />
@if ( checkSettingComplete() )
<x-why-we-fill-details-popup />
@endif
@push('scripts')
<script>
function validLength(input,max_number) {    
	let value = input.value.replace(/\D/g, '');     
	if (value.length > max_number) {        
		value = value.substring(0, max_number);    
	}    
	input.value = value;
}
$(document).on('click','.editFrienContacts',function(){		
	toastr.info('Please wait...', 'Processing', {                
		timeOut: 0,                
		extendedTimeOut: 0,            
	});			   
	let id = $(this).attr('sf-id');    
	let number = $(this).attr('number');    
	let type = $(this).attr('type');    
	$.ajax({        
		url:'{{ url("share/load-editcontact-form")}}',        
		method:'post',        
		data:{"_token": $('#csrf-token')[0].content,id:id,number:number,type:type},        
		error:(error) => console.log(error),        
		success:(response) => {			
		toastr.clear();            
		$("#editFriendContactForm").find('.modal-body').html(response.data);            
		$("#editFriendContactForm").modal('show');        
	}    
}) 
})

function saveSupport(){
	
	let sfirst_name = $("#sfirst_name").val();
	let slast_name = $("#slast_name").val();
	let relation = $("#relation").val();
	let semail = $("#semail").val();
	let floatingPhone = $("#floatingPhone").val();
	
	if(sfirst_name=="") {
		toastr.error("First Name Required");
		return false;
	}
	if(slast_name=="") {
		toastr.error("Last Name Required");
		return false;
	}
	if(relation=="") {
		toastr.error("Relation Required");
		return false;
	}
	if(semail=="") {
		toastr.error("Email Required");
		return false;
	}
	if(floatingPhone=="") {
		toastr.error("Phone Number Required");
		return false;
	}
	
}

</script>
@endpush
<style> 
.personal-setting-wrapper .card--white {
    background-color: #fff;
    box-shadow: 0 1px 2px rgba(56, 65, 74, 0.15);
    -webkit-box-shadow: 0 1px 2px rgba(56, 65, 74, 0.15);
    -moz-box-shadow: 0 1px 2px rgba(56, 65, 74, 0.15);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 20px;
}
button.close-suppoters {
    position: absolute;
    top: 5px;
    right: 0;
    color: #1f1f1f;
}
.ps-pills-content .module-list_area {
    margin-bottom: 40px;
}
.ps-pills-content h4.h4-title {
    margin-bottom: 1em;
    font-size: 20px;
    font-weight: 600;
}
.list-ps {
    display: flex;
    flex-wrap: wrap;
}
.module-list_area ul {
    list-style: none;
    padding-left: 0;
}
</style>

<div class="card--white full-height feels-view safety-conent-wrap supportFormCard displayNone">
   <div class="sendFeelTofriend fill-supports">
      <div class="send-friend_container ps-pills-content">
         <form action="{{ url('share/addMailAndPhone') }}" id="supporterDetails" method="POST">
            @csrf
            <div class="send-friend_Add position-relative">
               <h4 class="h4-title">Fill in the supporter's information</h4>
                @if ( $friendContact )
                 <button type="button" class="close-suppoters btn btn-link p-0 closeSupportForm"><i class="fa fa-times"></i> close</button>
                @endif
               <div class="form-row">
                  <div class="col-md-4 col-sm-12 inputContainers">
                     <div class="mb-3">
						<label>Supporter’s First Name</label>
                        <input name="first_name" id="sfirst_name" placeholder="Enter a first name" class="form-control">
                        
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-12 inputContainers">
                     <div class="mb-3">
						<label>Supporter’s Last Name</label>
                        <input name="last_name" id="slast_name" placeholder="Enter a last name" class="form-control">
                        
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-12 inputContainers">
                     <div class="mb-3">
						<label>Select Your Relationship</label>
                        <select class="form-control"  id="relation" name="relation">
                           <option value="" >Relationship</option>
                           <option value="Spouse" >Spouse</option>
                           <option value="Mother" >Mother</option>
                           <option value="Father" >Father</option>
                           <option value="Siblings" >Siblings</option>
                           <option value="Friend" >Friend</option>
                           <option value="Others" >Others</option>
                        </select>
                        
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-12 inputContainers">
                     <div class="mb-3">
						<label>Supporter’s Email (Ex: xyz@iwilltilimwell.com)</label>
                        <input name="email" id="semail" placeholder="Enter a new mail" class="form-control">
                        
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-12 inputContainers">
                     <div class="mb-3">
						<label>Supporter's Phone (e.g., +2145552)</label>
                        <input name="phone" placeholder="Enter a new phone" class="form-control" id="floatingPhone" onkeyup="validLength(this,'10')">
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-12 inputContainers">
                     <div class="mb-3">
                        <label>Select Frequency</label>
						<select style="padding-top: 10px;     color: #959595;" class="form-control"  id="frequency" name="frequency">
                           <option value="" >Sharing Frequency</option>
                           <option value="Daily" >Daily</option>
                           <option value="Weekly" >Weekly</option>
                           <option value="Monthly" >Monthly</option>
                        </select>
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="module-list_area">
               <h4 class="h4-title">Choose the information you want to share with a counselor, family member, or friend.</h4>
               <ul class="list-ps">
                  @foreach ($moduleName as $moduleValue )
                  <li>
                     <div class="affirmation-container">
                        <div class="servicesStatus ">
                           <label class="switch">
                           <input type="checkbox" name="moduleName[{{ $moduleValue['name'] }}]" class="moduleShareCheck">
                           <span class="slider round"></span>
                           </label>
                        </div>
                        <div class="affirmation-action_check">
                           <p>{{ $moduleValue['label'] }}</p>
                        </div>
                     </div>
                  </li>
                  @endforeach
               </ul>
            </div>
            <div class="quick-link-box">
               <div class="row">
                  <div class="col-12">
                     <h4 class="h4-title">Affirmation</h4>
                     {{--
                     <h3 class="font-weight-bold"><i class="far fa-hand-point-right"></i> Affirmation</h3>
                     --}}
                  </div>
                  <div class="col-md-12 col-xl-6 mb-3 stretch-card transparent module-list_area">
                     <ul class="list-ps">
                        <li>
                           <div class="affirmation-container">
                              <div class="servicesStatus ">
                                 <label class="switch">
                                 <input type="checkbox" name="affirmation[web]" class="" portal-type="web">
                                 <span class="slider round"></span>
                                 </label>
                              </div>
                              <div class="affirmation-action_check">
                                 <p>Affirmation Web Notification</p>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="affirmation-container">
                              <div class="servicesStatus ">
                                 <label class="switch">
                                 <input type="checkbox" name="affirmation[mobile]" portal-type="mobile" class="" >
                                 <span class="slider round"></span>
                                 </label>
                              </div>
                              <div class="affirmation-action_check">
                                 <p>Affirmation Mobile Notification </p>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="ps-btn-btm mb-2">
               <button type="submit" class="btn btn-primary" onclick="return saveSupport()">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
@endif