<div class="table-responsive pt-3" id="customer-table">
@php 
$total_usersyet = getTotalRefMemberInfu(auth()->user()->id);
@endphp

                            <table class="table table-bordered user-table-box" >
                                    <thead>	
										<tr>
											<th>#</th>
											<th>Month</th>
											<th>Total Users</th>
											<th>Active Users</th>
											<th>New Users</th>
											
										</tr>
                                    </thead>	
                                    <tbody>	
										@if($users->count())
											@foreach($users as $key => $user)
												
												
												
												<tr>
												
													<td>{{ $users->firstItem() + $key }}</td>
													<td>
@php
    $total_activeaccordingmonth = getActiveMemberAccordingMonth(auth()->id(), $user->months);
    $current_month_active = getCurrentMonthActiveUser(auth()->id(), $user->months);
@endphp
													{{ $user->display_months }}</td>
													<td>{{ $total_usersyet }}</td>
													<td>{{$current_month_active}}</td>
													<td>{{$total_activeaccordingmonth}}</td>
													
													
												</tr>
											@endforeach
										@else
											<tr>
												<td colspan="5" class="text-center">No users found</td>
											</tr>
										@endif	
                                    </tbody>	
                            </table>	
</div>
{{ $users->links() }}