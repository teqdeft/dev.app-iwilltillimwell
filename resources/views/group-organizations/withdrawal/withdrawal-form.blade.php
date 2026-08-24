<?php $data = getInfluenceWallet(auth()->user()->id);?>
		
		<div class="withdrawal_main">
			
			<div class="withdrawal">
				
				<form method="POST" action="{{ route('withdrawal.store') }}">
					@csrf
					<div class="now">
					
						<div class="title">
							<p>Avaible Balance</p>
						</div>
						
						<div class="value">
							<p>${{$data['total_balance']}}</p>
						</div>
						
					</div>
					
					<div class="now">
						
						<div class="title">
							<p>Enter Amount</p>
						</div>
						
						<div class="value">
							<input type="text" class="form-control" id="total_withdrawal" name="total_withdrawal" placeholder="Enter Your Withdrawal Amount" />
						</div>
						
					</div>
					
					<div class="now">
						
						<div class="w-100 title">
							<button class="btn-primary primary-button" type="submit">Submit</button>
						</div>
						
					</div>
				</form>
			</div>
				
		</div>