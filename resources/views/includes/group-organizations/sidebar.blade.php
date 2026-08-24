<nav class="sidebar sidebar-offcanvas" id="sidebar">
   <ul class="nav">

		<li class="nav-item">
				<a class="nav-link" href="{{ url('group-organizations') }}">
				   <i class="icon-grid menu-icon"></i>
				   <span class="menu-title">Dashboard</span>
				</a>
		</li>
		
		<li class="nav-item">
				<a class="nav-link" href="{{ url('group-organizations/my-current-plan') }}">
				   <i class="icon-grid menu-icon"></i>
				   <span class="menu-title">Commission Policies</span>
				</a>
		</li>
		<li class="nav-item hr-list-box1">
			 <a class="nav-link collapsed" data-toggle="collapse" href="#ref-member-list" aria-expanded="false" aria-controls="affirmation">
				<i class="fas fa-laptop-medical menu-icon"></i>
				<span class="menu-title">Members Stats</span>
				<i class="menu-arrow"></i>
			 </a>
			 <div class="collapse" id="ref-member-list">
				<ul class="nav flex-column sub-menu">
					
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('ref-member-list') }}">Monthly Members Stats List</a></li>
					
				   
				</ul> 
			 </div>
		</li>
		<li class="nav-item hr-list-box1">
			 <a class="nav-link collapsed" data-toggle="collapse" href="#coupon-list" aria-expanded="false" aria-controls="affirmation">
				<i class="fas fa-laptop-medical menu-icon"></i>
				<span class="menu-title">Promo Code</span>
				<i class="menu-arrow"></i>
			 </a>
			 <div class="collapse" id="coupon-list">
				<ul class="nav flex-column sub-menu">
					
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('coupon-list') }}">Promo Code List</a></li>
					
				   
				</ul> 
			 </div>
		</li>
		
		
		
		<li class="nav-item hr-list-box1">
			 <a class="nav-link collapsed" data-toggle="collapse" href="#Commission-list" aria-expanded="false" aria-controls="affirmation">
				<i class="fas fa-laptop-medical menu-icon"></i>
				<span class="menu-title">Commission</span>
				<i class="menu-arrow"></i>
			 </a>
			 <div class="collapse" id="Commission-list">
				<ul class="nav flex-column sub-menu">
					
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('group-order-history') }}">Commission List</a></li>
					
					<?php /*
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('group-organizations-calculation') }}">Commission List</a></li>
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('group-organizations-history') }}">History</a></li>
					*/ ?>
					
				   
				</ul> 
			 </div>
		</li>
		
		<li class="nav-item hr-list-box1">
			 <a class="nav-link collapsed" data-toggle="collapse" href="#withdrawal-list" aria-expanded="false" aria-controls="affirmation">
				<i class="fas fa-laptop-medical menu-icon"></i>
				<span class="menu-title">Withdrawal</span>
				<i class="menu-arrow"></i>
			 </a>
			 <div class="collapse" id="withdrawal-list">
				<ul class="nav flex-column sub-menu">
					
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('group-organizations-withdrawal-list') }}">Withdrawal History</a></li>
					<li class="nav-item "><a class="nav-link dropdown-btn" href="{{ route('group-organizations-withdrawal-add') }}">Withdrawal Request</a></li>
					
				   
				</ul> 
			 </div>
		</li>
		
		<li class="nav-item">
				<a class="nav-link" href="{{ url('logout') }}">
				   <i class="icon-grid menu-icon"></i>
				   <span class="menu-title">Log Out</span>
				</a>
		</li>
		
	  
   </ul>
</nav>

