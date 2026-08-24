@php
    $activeTab = request()->get('active-tab');
@endphp
<ul class="nav nav-tabs nav-tabs-neutral nav-tabs-responsive theme-bg-color cust-helt-sp" role="tablist" data-background-color="orange">

    <li class="nav-item nav-item-link-anchor">
		<a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" href="{{ url('/personal-record/') }}{{ $activeTab ? '?active-tab='.$activeTab : '' }}">{{ Auth::user()->name }}</a>
	</li>
                        
	@if($dependents)
            @foreach ($dependents as $dependent)
				@if($dependent->age < Config::get('constants.minor_age'))
                    
					<li class="nav-item pr-cus-link nav-item-link-anchor">
						<a 
							class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}" 
							href="{{ url('/personal-record/'.$dependent->id) }}{{ $activeTab ? '?active-tab='.$activeTab : '' }}" 
							role="tab"> 
							{{ $dependent->name }}
						</a>
                    </li>
					
                @endif
            @endforeach
    @endif

</ul>