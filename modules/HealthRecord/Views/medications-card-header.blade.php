<div class="card-header">
    <div class="ip-hamburger-icon d-flex align-items-center">
        <ul><li></li><li></li><li></li></ul>
   <h5 class="fs-16 mb-0">Members</h5></div>
    <div class="menu-tabs-cus members-detail-v1">
        <ul class="nav nav-tabs nav-tabs-neutral nav-tabs-responsive theme-bg-color " role="tablist" data-background-color="orange">
			<li class="nav-item">
			
			@php 
				$url_link = url($slug);
				$currentUserId = request()->get('user_id') 
                    ?? (Request::segment(2) ?? Auth::id());
			@endphp 
			
                <a class="nav-link {{ ($currentUserId == Auth::user()->id) ? 'active' : '' }}" 
				
				href="{{ $url_link }}"
				
				>{{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}</a>
            </li>
            
			@if($dependents)
			@foreach($dependents as $dependent)
				@if ($dependent->age < Config::get('constants.minor_age'))
					<li class="nav-item pr-cus-link">
						<a 
							class="nav-link 
								{{ ($currentUserId == $dependent->id) ? 'active' : '' }}" 
							href="{{ $slug == 'personal-record' 
								? url('/personal-record/'.$dependent->id) 
								: url($url_link.'?user_id='.$dependent->id) }}"
							role="tab">
							{{ ucfirst($dependent->fname) }} {{ ucfirst($dependent->lname) }}
						</a>
					</li>
				@endif
			@endforeach
		@endif

        </ul>
    </div>
</div>