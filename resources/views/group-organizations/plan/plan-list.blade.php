@php 
$total_users = getTotalRefMemberInfu(auth()->user()->id);
@endphp
<div class="plan-compare-heading">
			<p>Compare Commission for {{ ucfirst(auth()->user()->fname) }} {{ ucfirst(auth()->user()->lname) }}</p>
		</div>	
<div class="my_current_plan">
		
        <div class="current_plan_card @if($total_users < 3000) active @endif">
            <div class="radio-card">
                <div class="status_icon">
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                   <img src="{{asset('assets/dashboard/htmlv/assets/images/standard-package.svg') }}" alt="icon">
                </div>
                <div class="detail">
                    <div class="plan-name">
                        <p>Basic</p>
                    </div>
                    <div class="value">
                        <p>0 To 3000 Users</p>
                    </div>
                </div>
            </div>
            <div class="compair_by_plan">
                <div class="title">
                    <p>Commission by Year & Users</p>
                </div>
                <div class="plan">
                    <div class="plan_row">
                       
                        <p>Year</p>
                        <p>Commission</p>
                    </div>
					@foreach ($defaultreward_list as $list)
						@if ($list->max <= 3000)
							<div class="plan_row">
								<p>{{ $list->year }} Year</p>
								<p>{{ $list->commission }}%</p>
							</div>
						@endif
					@endforeach	
                </div>
            </div>
            <div class="current_plan_status">
                <p>Active</p>
            </div>
        </div>

        <div class="current_plan_card @if($total_users > 3000) active @endif">
            <div class="radio-card">
                <div class="status_icon">
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <img src="{{asset('assets/dashboard/htmlv/assets/images/plus-package.svg') }}" alt="icon">
                </div>
                <div class="detail">
                    <div class="plan-name">
                        <p>Advance</p>
                    </div>
                    <div class="value">
                        <p>3000+ Users</p>
                    </div>
                </div>
            </div>
            <div class="compair_by_plan">
                <div class="title">
                    <p>Commission by Year & Users</p>
                </div>
                <div class="plan">
				
					<div class="plan_row">
                       
                        <p>Year</p>
                        <p>Commission</p>
                    </div>
                    
					@foreach ($defaultreward_list as $list)
						@if ($list->max > 3000)
							<div class="plan_row">
								<p>{{ $list->year }} Year</p>
								<p>{{ $list->commission }}%</p>
							</div>
						@endif
					@endforeach
					
                </div>
            </div>
            <div class="current_plan_status">
                <p>Your current plan is active</p>
            </div>
        </div>
</div>
