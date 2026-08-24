<div class="affiliate_title mt-4 text-center">
    <h3>Affiliate Dashboard – <span>{{ ucfirst(auth()->user()->fname) }}</span> Reseller</h3>
</div>


		<div class="group-organizations mt-3">
		
			<a href="{{'group-organizations/ref-member-list'}}" class="organizations">
							<div class="organi-icon">
								<img src="{{ asset('assets/group-organizations/TotalUsers.png') }}" alt="Total Users ">
							</div>
							<div class="organi-title">
								<p>Total Users </p>
							</div>
							<div class="organi-number">
								<p>{{$dashboard_info['total_user']}}</p>
							</div>
			</a>

			<a href="{{'group-organizations/coupon-list'}}" class="organizations">
							<div class="organi-icon">
								<img src="{{ asset('assets/group-organizations/TotalCoupon.png') }}" alt="Total Coupon">
							</div>
							<div class="organi-title">
								<p>Total Coupon</p>
							</div>
							<div class="organi-number">
								<p>{{$dashboard_info['total_promo_code']}}</p>
							</div>
			</a>

			<a href="{{'group-organizations/order-history'}}" class="organizations">
							<div class="organi-icon">
								<img src="{{ asset('assets/group-organizations/TotalCommissioin.png') }}" alt="Total Commissioin">
							</div>
							<div class="organi-title">
								<p>Total Commissioin</p>
							</div>
							<div class="organi-number">
								<p>${{$dashboard_info['total_commission']}}</p>
							</div>
			</a>

			<a href="{{'group-organizations/withdrawal-list'}}" class="organizations">
							<div class="organi-icon">
								<img src="{{ asset('assets/group-organizations/TotalWithdrawal.png') }}" alt="Total Withdrawal">
							</div>
							<div class="organi-title">
								<p>Total Withdrawal</p>
							</div>
							<div class="organi-number">
								<p>${{$dashboard_info['total_withdrawal']}}</p>
							</div>
			</a>

			<a href="javascript:void(0)" class="organizations">
							<div class="organi-icon">
								<img src="{{ asset('assets/group-organizations/Balance.png') }}" alt="Balance">
							</div>
							<div class="organi-title">
								<p>Balance</p>
							</div>
							<div class="organi-number">
								<p>${{$dashboard_info['balance']}}</p>
							</div>
			</a>
			
</div>