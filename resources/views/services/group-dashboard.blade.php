@extends('layouts.dashboard')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        {{-- The Apps Script page brings its own "Your Group Dashboard" heading. --}}
        <iframe class="group-dashboard-frame" src="{{ $groupDashboardUrl }}" title="Group Dashboard"></iframe>
    </div>
<style>
.group-dashboard-frame {
    display: block;
    width: 100%;
    height: calc(100vh - 140px);
    min-height: 600px;
    border: 0;
    border-radius: 20px;
    background: #fff;
}
</style>
@endsection
