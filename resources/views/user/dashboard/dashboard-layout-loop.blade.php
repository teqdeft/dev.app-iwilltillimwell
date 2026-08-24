@if($data)

@foreach($data as $list)

@php

$icon = isset($list['ico']) && !empty($list['ico']) ? $list['ico'] : 'my-health-records.svg';

$slug = isset($list['slug']) && !empty($list['slug']) ? $list['slug'] : 'personal-record';

@endphp

@if($dash_layout=="left")



<a

	@if(isset($list['ds_status']))

	disabled

	href="javascript:void(0)"

	onclick="show_popup('dashboard-semaglutide-alert','flex')"



	@else



	@if($slug=="search-prescription-plan" )

	data-toggle="modal" data-target="#pre-search-dash-model" onclick="prescriptionsearchmodal()"

	@else

	href="{{url($slug)}}"

	@endif





	@endif

	class="{{ $list['extra_class'] ?? '' }}">

	<div class="dash-menu-card ">

		<div class="icon">

			<img src="{{ asset('assets/dashboard/htmlv/assets/images/dashboard/' . $icon) }}"

				alt="{{ $list['name'] ?? 'Icon' }}" />

		</div>

		@if(isset($list['name']))

		<div class="title">

			<p>{{$list['name']}}</p>

		</div>

		@endif

		@if(isset($list['sub_name']))

		<div class="service-price">
			<p>{{$list['sub_name']}}</p>
		</div>

		@endif

	</div>

</a>



@else

<div class="schedule-card {{ $list['extra_class'] ?? '' }} {{ !isset($list['book_now']) ? 'book_now_disabled' : '' }}">



	@if(in_array($list['slug'], ['consultation-type?action=psychology','consultation-type?action=psychiatry','behavioral-health','in-the-moment-care']))

	<span class="schudle_card_betch">



		@if(isset($list['tag']))

		{{$list['tag']}}

		@else

		{{ $list['slug']=="behavioral-health" ? 'Short-Term Therapy' : 'Long-Term Therapy' }}

		@endif

	</span>

	@endif


 


	<a

		@if(isset($list['ds_status']))

		disabled

		href="javascript:void(0)"

		onclick="show_popup('dashboard-semaglutide-alert','flex')"

		@else



		@if($slug=="search-prescription-plan" )

		data-toggle="modal" data-target="#pre-search-dash-model" onclick="prescriptionsearchmodal()"

		@else

		href="{{url($slug)}}"

		@endif



		@endif>

		<div class="icon">

			<img src="{{ asset('assets/dashboard/htmlv/assets/images/dashboard/' . $icon) }}"

				alt="{{ $list['name'] ?? 'Icon' }}" />

		</div>

		<div class="text">

			@if(isset($list['name']))

			<p>{{$list['name']}}</p>

			@endif

		</div>



		@if(isset($list['book_now']))

		@if(!isset($list['ds_status']))

		<div class="book_consul_btn"><button class="consul-booknowbtn" type="button">Book Now</button></div>

		@endif

		@endif



		<div class="service-price">

			@if($list['name']=="Psychiatrist")

			<p><span>Initial: </span><span>$215.00</span><span>/visit</span><br>

				<span>Follow-Up: </span><span>$100.00</span><span>/visit</span>
			</p>

			@elseif(isset($list['sub_name']))

			<p>{{$list['sub_name']}}</p>

			@endif

		</div>





	</a>

</div>

@endif

@endforeach

@endif