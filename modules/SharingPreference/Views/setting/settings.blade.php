            <form class="supporterDetailsClass" action="{{ url('share/addMailAndPhone') }}" id="supporterDetails" method="POST">
                @csrf
                <div class="send-friend_Add">
                <h4 class="h4-title">Fill the supporter’s information</h4>
                <div class="form-row">

                    <div class="col-md-4 col-sm-12 inputContainers">
                        <div class="form-floating mb-3">
                            <input name="name" placeholder="Enter a first name" class="form-control">
                            <label>Supporter’s First Name</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 inputContainers">
                        <div class="form-floating mb-3">
                            <input name="name" placeholder="Enter a last name" class="form-control">
                            <label>Supporter’s Last Name</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 inputContainers">
                        <div class="form-floating mb-3">
                        <select style="padding-top: 10px; color: #959595;" class="form-control"  id="exampleFormControlSelect1" name="relation">
                            <option value="" >Relationship</option>
                            <option value="Spouse" >Spouse</option>
                            <option value="Mother" >Mother</option>
                            <option value="Father" >Father</option>
                            <option value="Siblings" >Siblings</option>
                            <option value="Friend" >Friend</option>
                            <option value="Others" >Others</option>
                        </select>
                        <label></label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 inputContainers">
                        <div class="form-floating mb-3">
                            <input name="mail" placeholder="Enter a new mail" class="form-control">
                            <label>Supporter’s Email (Ex: xyz@domain.com) </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 inputContainers">
                        <div class="form-floating mb-3">
                            <input name="phone" placeholder="Enter a new phone" class="form-control">
                            <label>Supporter’s Phone (Ex: +2145552) </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 inputContainers">
                        <div class="form-floating mb-3">
                        <select style="padding-top: 10px;     color: #959595;" class="form-control"  id="exampleFormControlSelect1" name="relation">
                            <option value="" >Sharing Frequency</option>
                            <option value="Daily" >Daily</option>
                            <option value="Weekly" >Weekly</option>
                            <option value="Monthly" >Monthly</option>
                        </select>
                        <label></label>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
                <div class="module-list_area">
                    <h4 class="h4-title">Choose the information that you want to share with a counselor, family member or friend.</h4>
                    <ul class="list-ps">
                        @foreach ($moduleName as $moduleValue )
                            <li>
                                <div class="affirmation-container">
                                    <div class="servicesStatus ">
                                        <label class="switch">
                                            <input type="checkbox" @if ( !empty($shareModule) && in_array($moduleValue['name'],$shareModule)  )
                                                checked
                                            @endif name="{{ $moduleValue['name'] }}" class="moduleShareCheck">
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
                        </div>
                        <div class="col-md-12 col-xl-6 mb-3 stretch-card transparent module-list_area">
                            <ul class="list-ps">
                                <li>
                                    <div class="affirmation-container">
                                        <div class="servicesStatus ">
                                            <label class="switch">
                                                <input type="checkbox" name="affirmation" class="affirmationOnOff" portal-type="web" @if( $affStatus[0] == 'yes' ) checked @endif checkstatus="{{ $affStatus[0]??'' }}">
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
                                                <input type="checkbox" name="affirmation" portal-type="mobile" class="affirmationOnOff" @if( isset($userMeta['mobileAffermation']) && $userMeta['mobileAffermation'] == 'yes' ) checked @endif checkstatus="{{ $userMeta['mobileAffermation']??'' }}">
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
                    <a href="{{ url('share/add/supporters-phone-number') }}" class="btn btn-primary">Save</a>
                </div>


