<table class="table table-striped table-data-theme" id="supporterTableData">
    <thead>
        <tr>
            <th>Transaction Period</th>
            <th>Package Name</th>
            <th>Package Type</th>
            <th>Package Amount</th>
            <th>Add-Ons</th> @if(config('constants.pro_data_status') === 'active') <th>Pro-Rata</th> @endif <th>Promo Code</th>
            <th>Final Amount</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody> @forelse($transction_record as $result) <tr> {{-- Transaction Date --}}
            <td> {{ \Carbon\Carbon::parse($result->subscription_start_date)->format('d M Y') }} – {{ \Carbon\Carbon::parse($result->subscription_end_date)->format('d M Y') }} </td> {{-- Package Name --}}
            <td>{{ $result->name }}</td> {{-- Package Type --}}
            <td> @switch(true) @case($result->subscription_type === 'twelve-month') 12 Month @break @case($result->subscription_type === 'four-month') 4 Month @break @case($result->planid % 2 === 0) Self + Family @break @default Self @endswitch </td> {{-- Amount --}}
            <td>${{ number_format($result->amount, 2) }}</td> {{-- Add-Ons --}}
            <td>${{ number_format($result->optional_amount ?? 0, 2) }}</td> @if(config('constants.pro_data_status') === 'active') <td> @if($result->pro_rata_days > 0) <div class="pro-rata-cell">
                    <div> <small class="text-muted">Days</small><br> <strong>{{ $result->pro_rata_days }}</strong> </div>
                    <div class="text-success"> <small class="text-muted">Amount</small><br> <strong>${{ number_format($result->pro_rata_amount, 2) }}</strong> </div>
                </div> @else <span class="text-muted">—</span> @endif </td> @endif <td> @if(!empty($result->promo_code) && $result->promo_code_value > 0) <strong>{{$result->promo_code}}</strong> - ${{number_format($result->promo_code_value,2)}} @else <span>none</span> @endif </td>
            <td> @php $final_amount = $result->final_amount; @endphp <div class="text-success"> <strong>${{ number_format($final_amount, 2) }}</strong> </div>
            </td> {{-- Status --}}
            
            <td> 
                <span class="badge                         {{ $result->subscription_status === 'active' ? 'badge-success' : 'badge-danger' }}"> {{ ucfirst($result->subscription_status) }} </span> 
            </td>
            <td>

                {{ucfirst($result->payment_method)}}

            </td>

            <?php /*				
            <td>                   
             @if($result->terms_accepted)                       
             <span class="badge bg-success">Accepted</span>                        
             <br>                        
             <small class="text-muted">                            
             {{ \Carbon\Carbon::parse($result->terms_accepted_at)->format('d M Y, h:i A') }}                       
               </small>                    
               @else                        
               <span class="badge bg-danger">Not Accepted</span>                   
                @endif                
                </td>				
                */ ?> {{-- Actions --}}
            
            <td>
                <div class="transaction-action"> <a href="#!" class="download-icon" title="Download Invoice"> <i class="fas fa-download"></i> </a> <a href="#!" class="view-history-icon" title="View Details"> <i class="fa fa-eye"></i> </a> </div>
            </td>

        </tr> @empty <tr>
            <td colspan="7" class="text-center text-muted py-4"> No transaction history available. </td>
        </tr> @endforelse </tbody>
</table>{{-- Pagination --}}
<div class="mt-3"> {{ $transction_record->links() }}</div>