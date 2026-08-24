<div id="password-management" class=" tab-pane fade">
                            <br>
                            <h3>Update your account password</h3>
                            <form class="forms-sample" method="post" id="account-update-password-form"
                                action="{{ route('update-password') }}">
                                @csrf
                                <div class="row ">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Old Password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                id="current_password" placeholder="Password"
                                                
												autocomplete="off"
												/>
                                            @error('current_password')
                                            <span class="error" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputConfirmPassword1">New Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="New Password"  autocomplete="off" />
                                            @error('password')
                                            <span class="error" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputConfirmPassword2">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password-confirm" placeholder="Confirm Password"
                                                
												autocomplete="off"
												/>
                                            @error('password_confirmation')
                                            <span class="error" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- <div class="form-check form-check-flat form-check-primary">
											<label class="form-check-label">
											<input type="checkbox" class="form-check-input">
											Remember me
											<i class="input-helper"></i></label>
										</div> -->
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>