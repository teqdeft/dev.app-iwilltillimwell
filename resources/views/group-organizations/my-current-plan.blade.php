@extends('layouts.group-organizations')
@section('content')
	<div class="content-wrapper">
		
		<div class="user-package-list">
			@include('group-organizations.plan.package')
		</div>	
	</div>
@endsection