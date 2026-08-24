<table>
                                        <thead>
                                            <tr>
                                                <th class="text-left">Feature</th>
                                                <th>Basic</th>
                                                <th>Standard</th>
												@if($p_type=="package")
													<th>PLUS</th>
													<th>PREMIUM</th>
												@endif	
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<tr>
												<td>Virtual Urgent Care - <p class="package-description">Unlimited urgent care visits with an MD for acute medical care.</p></td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
											</tr>
											
											<tr>
												<td>Care Coordinators - <p class="package-description">24/7/365 access to care coordinators to help you manage your care.</p></td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
											</tr>
											
											
											<tr>
												<td>Message a Specialist -  <p class="package-description">Consultations with Pediatricians, Ophthalmologists, Women's Health Physicians, Sports Medicine Doctors, Nutritionists, Registered Dietitians, Fitness Coaches, Dentists, Pharmacists, and more via your member portal only.</p></td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
											</tr>
											
											
											
											<tr>
												<td>Behavioral Health - <p class="package-description">Master's Level Therapists, Psychologists and Psychiatrists.</p></td>
												<td>
													<div class="service-list-include check-ic no-feature">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
											</tr>
											
											<tr>
												<td>Advanced Behavioral Health Care -<p class="package-description">An app with Assessment Measures (Anxiety, Depression, & Substance Use), a Mood Calendar, Voice & Written Journal Capabilities, Safety Plans, Emergency Resources, Affirmations Sharing, and more.</p></td>
												<td>
													<div class="service-list-include check-ic no-feature">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic no-feature">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
											</tr>
											
											<tr>
												<td>*Virtual Primary Care - <p class="package-description">All of the above, plus Unlimited VPC, Medication Management, Lab Panels, Health Risk Assessments, and Virtual Dermatology.</p></td>
												<td>
													<div class="service-list-include check-ic no-feature">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic no-feature">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic no-feature">&nbsp;</div>
												</td>
												<td>
													<div class="service-list-include check-ic active">&nbsp;</div>
												</td>
											</tr>
											
											
											
										<?php /*	
										@if(!empty($include_list))
											@for($i = 0; $i < count($include_list); $i++)
												<?php 
												$class_name = getClassNamePackageList($include_list[$i]['include_ids'],'package_include');
												if($class_name) {
												?>
											
													<tr  class="service-list chek-s1 assing-pack-id <?php echo $class_name?> package_include" style="display:none;">
													
														<td class="text-left">
														<?php echo $include_list[$i]['name']?>
														<?php 
														if(isset($include_list[$i]['description']) && !empty($include_list[$i]['description'])) {
															echo "(".$include_list[$i]['description'].")";
														}
														?>
														
														
														<input type="checkbox" class="package_service_list" value="{{$include_list[$i]['id']}}" id="TelePet<?php echo $i?>" checked disabled style="opacity: -1;">
															
														</td>
														@if($p_type=="holiday")
															<td><div class="no-feature active service-list-include service-list-include-13 service-list-include-14 service-list-include-15 service-list-include-16 ">&nbsp;</div></td>
															<td><div class="no-feature service-list-include service-list-include-13 service-list-include-14 service-list-include-15 service-list-include-16">&nbsp;</div></td>
														@else
														
														<td><div class="no-feature active service-list-include service-list-include-1 service-list-include-2">&nbsp;</div></td>
														<td><div class="no-feature service-list-include service-list-include-3 service-list-include-4">&nbsp;</div></td>
														<td><div class="no-feature service-list-include service-list-include-5 service-list-include-6">&nbsp;</div></td>
														<td><div class="no-feature service-list-include service-list-include-7 service-list-include-8">&nbsp;</div></td>
														@endif
													</tr>
												<?php } ?>
																				@endfor	
																			@endif
												@if($p_type=="holiday")

													<tr  class="service-list chek-s1 assing-pack-id">
														<td class="text-left">Prescription Plan</td>
														<td><div class="no-feature active service-list-include">&nbsp;</div></td>
														<td><div class="no-feature service-list-include service-list-include-13 service-list-include-14 service-list-include-15 service-list-include-16">&nbsp;</div></td>
													</tr>
													
												@endif
							*/ ?>					
												
					
        </tbody>
</table>