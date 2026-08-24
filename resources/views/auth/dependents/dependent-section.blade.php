<div class="tabs-new-dependent">

    <div class="inner mb-2">
        <h3>Viewing Records For:</h3>
    </div>

    <div class="depen_over mt-3">
        <p>Note: <span class="depen_over_span">* Dependent is over 18 and must manage their own records.</span></p>
    </div>

    {{-- Tab Navigation --}}
    <ul class="nav nav-tabs mt-3" id="myTabs" role="tablist">

        @forelse ($allDependent as $dependent)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                   data-toggle="tab"
                   href="#dependent-{{ $dependent->id }}"
                   role="tab"
                   aria-controls="dependent-{{ $dependent->id }}"
                   aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ ucfirst($dependent->fname) }} {{ ucfirst($dependent->lname) }}
                </a>
            </li>
        @empty
            <li class="nav-item disabled">
                <span class="nav-link text-muted">No dependents found</span>
            </li>
        @endforelse

        <li class="nav-item">
            <a class="nav-link add-new-dependent-tab d-none"
               id="new-dependent-tab"
               data-toggle="tab"
               href="#new-dependent"
               role="tab"
               aria-controls="new-dependent"
               aria-selected="false">
                New Dependent
            </a>
        </li>

    </ul>

    {{-- Tab Content --}}
    <div class="tab-content pt-0 dependent-content-cnt" id="myTabContent">

        @forelse ($allDependent as $dependent)

            @php $isMinor = getAge($dependent->dob) < config('constants.minor_age'); @endphp

            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                 id="dependent-{{ $dependent->id }}"
                 role="tabpanel"
                 aria-labelledby="dependent-{{ $dependent->id }}-tab">

                @if ($isMinor)
                    {{-- ===================== MINOR DEPENDENT FORM ===================== --}}
				
					@include('auth.dependents.minor-dependent-form')
			
                @else
                    {{-- ===================== ADULT DEPENDENT VIEW ===================== --}}
				
					@include('auth.dependents.adult-dependent-view')
                    
                @endif

            </div>{{-- /.tab-pane --}}

        @empty
            <div class="tab-pane fade active show" id="no-dependents" role="tabpanel">
                <p class="text-muted mt-3">No dependents have been added yet.</p>
            </div>
        @endforelse

        {{-- ===================== ADD NEW DEPENDENT FORM ===================== --}}
		
		@include('auth.dependents.add-new-dependent-form')
	
    </div>{{-- /.tab-content --}}
</div>{{-- /.tabs-new-dependent --}}