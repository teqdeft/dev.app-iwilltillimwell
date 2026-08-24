@extends('layouts.dashboard')

@section('content')
@if(LoginUserBToBVerification())


<div class="main-panel">	<div class="moodContainer journal-container content-wrapper">
@include('services.moods.what-is-mood-content')

@else 
<div class="main-panel">
    <div class="content-wrapper">
		<div class="row">
        <div class="col-12 grid-margin stretch-card btob-admin">
                <div class="card card-body">
                 {{ LoginUserBToBVerificationMSG() }}
             </div>
        </div>
    </div>
@endif
@endsection

