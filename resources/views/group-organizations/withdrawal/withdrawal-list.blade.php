<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Amount</th>
											<th>Paid</th>
											<th>Date</th>
											<th>Status</th>
											<th>Remark</th>
											
										</tr>
									</thead>

									<tbody>
										@forelse($withdrawals as $key => $row)
											<tr>
												<td>{{ $withdrawals->firstItem() + $key }}</td>
												<td>${{ number_format($row->total_withdrawal, 2) }}</td>
												<td>
													@if($row->status!="pending")
														${{ number_format($row->paid_payout, 2) }}
													@else 
														${{ number_format(0, 2) }}
													@endif 
												</td>
												<td>{{ $row->created_at->format('d M Y') }}</td>
												<td>
													<span class="badge 
														@if($row->status == 'approved') bg-success
														@elseif($row->status == 'rejected') bg-danger
														@else bg-warning
														@endif">
														{{ ucfirst($row->status) }}
													</span>
												</td>	
												<td>	
													@if($row->remark) 
															
														<span>
															{{$row->remark}}
														</span>
													@endif 
													
												</td>
												
											</tr>
										@empty
											<tr>
												<td colspan="4" class="text-center">No withdrawals found</td>
											</tr>
										@endforelse
									</tbody>
								</table>