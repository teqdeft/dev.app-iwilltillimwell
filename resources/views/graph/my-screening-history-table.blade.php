<div class="col-md-12">
    @if($screening)
        @if ($dataByTitle)
            <div class="quizTableGraph">
             
                @foreach ($headSetByName as $hedValue => $hedKey )
                    @if( isset($dataByTitle[$hedKey]['quizResult'] ))												
						@if($hedValue==$chart_name)
							<div class="headerContainer">								
								<h4>{{ $hedKey }}</h4>								
									<div class="table-responsive">
									@php										
									$screening = $dataByTitle[$hedKey];										
									$dates = collect($screening['date'])->unique()->values();										
									$severityLevels = [];										
									foreach($screening['quizResult'] as $group) {											
										foreach($group as $severity => $entries) {												
												$severityLevels[] = $severity;											}										
									}										
									$severityLevels = array_unique($severityLevels);									@endphp									
									
									<table class="table table-bordered table-striped  user-table-box user_subs_table" id="quizTest">										
									<thead>											
											<tr>												
												<th>Date</th>												
													@foreach($severityLevels as $severity)													
													<th>{{ $severity }}</th>												@endforeach											
												</tr>										
									</thead>										
									<tbody>											
										@foreach($dates as $date)												
											<tr>													
												<td>{{ $date }}</td>													
												@foreach($severityLevels as $severity)														@php															
												$value = '';															foreach($screening['quizResult'] as $group) {																
												if(isset($group[$severity][$date])) {																	
												if($group[$severity][$date]['x']) {																		
												$value = 'X';																	}																																	
												}															}														@endphp														
												<td>
													@if($value=="X")
														<div class="active-screening-data">&nbsp;</div>
													@endif	
												</td>													@endforeach												
											</tr>											
										@endforeach										
										</tbody>									
								</table>																		
						
                                </div>
							</div>
						@endif                    
					@endif
                @endforeach
            </div>
         @endif               
    @else
        <div class="row"><div class="col-md-12"><div class="emptyContainer"><h4>No record in {{ $screenHead  }} </h4></div></div></div>                       
    @endif 
</div> 