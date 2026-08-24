    @if($is_mobile) 
        
                @forelse ($pharmacies as $pharmacy)
                <div class="loca-phar-card" style="border-bottom: 0px;">									
                        <input type="hidden" name="latitude" id="latitude" value="<?= $pharmacy['latitude']; ?>"/>
                        <input type="hidden" name="longitude" id="longitude"  value="<?= $pharmacy['longitude']; ?>"/>    
                                            <div class="loca-icon">
                                                <img src="{{ asset('assets/dashboard/assets/images/location.svg') }} " alt="image">
                                            </div>
                                            <div class="locat-detail">
                                                <div class="loc-title">
                                                    <p id="pharmacy-name">{{ $pharmacy['storeName'] }} </p>
                                                </div>
                                                <div class="cont-num">
                                                    <p>
                                                         <a href="tel:{{ $pharmacy['phone'] }}" phone="{{ $pharmacy['phone'] }}" id="pharmacy-phone">
                                                            <span>PH: </span><span>{{ $pharmacy['phone'] }}</span>
                                                         </a>    
                                                    </p>
                                                </div>
                                                <div class="address">
                                                    <p id="pharmacy-address">{{ $pharmacy['address'] }} </p>
                                                    <p id="pharmacy-city">{{ $pharmacy['city'] }},</p>
                                                    <p id="pharmacy-state">{{ $pharmacy['stateName'] }},</p>
                                                    <p id="pharmacy-zipcode">{{ $pharmacy['zipCode'] }},</p>
													<input type="hidden" id="pharmacy-id" value="{{ $pharmacy['sureScriptPharmacy_id'] }}" />
                                                </div>
                                                <div class="usel-location">
                                                    <button 
													type="button" 
													class="use-pharmacy" 
													onclicks="usePharmcy(<?php echo $pharmacy['sureScriptPharmacy_id']?>)"
													id="update-user-pharmacy-app"
													>Use Pharmacy</button>
                                                </div>
                                            </div>
                </div>

                @empty
                    <div class="loca-phar-card" style="display: block;padding-bottom: 20px;">
                      <div class="locat-detail">
                        No record
                      </div>
                    </div>
                @endforelse
         
    @else 

    <div class="inner-branch-pharmacy-box">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <tbody>
                            @forelse ($pharmacies as $pharmacy)
                            <tr>
                                <td width="40px">
                                    <i class="fas fa-map-marked-alt"></i>
                                </td>
                                <td width="50%">
                                    <h5 id="pharmacy-name">{{ $pharmacy['storeName'] }}</h5>
                                   <input type="hidden" name="latitude" id="latitude" value="<?= $pharmacy['latitude']; ?>"/>
                                   <input type="hidden" name="longitude" id="longitude"  value="<?= $pharmacy['longitude']; ?>"/>
                                    <address>
                                        <a href="tel:{{ $pharmacy['phone'] }}" id="pharmacy-phone" phone="{{ $pharmacy['phone'] }}">PH:
                                            {{ $pharmacy['phone'] }}</a>.<br>
                                        <span id="pharmacy-address">{{ $pharmacy['address'] }}</span><br>
                                        <span id="pharmacy-city">{{ $pharmacy['city'] }}</span>, 
										<span id="pharmacy-state" >{{ $pharmacy['stateName'] }}</span>  
										<span id="pharmacy-zipcode">{{ $pharmacy['zipCode'] }}</span>
                                        <input type="hidden" id="pharmacy-id" value="{{ $pharmacy['sureScriptPharmacy_id'] }}" />
                                    </address>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="javascript:void(0)" class="mr-2 ">
										
										<label
												onclicks="usePharmcy(<?php echo $pharmacy['sureScriptPharmacy_id']?>)"
                                                class="badge badge-success badge-danger-cus" id="update-user-pharmacy-web">Use
                                                Pharmacy</label>
												
												
												</a>
                                        <div class="form-check mb-0">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    No matching records found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif