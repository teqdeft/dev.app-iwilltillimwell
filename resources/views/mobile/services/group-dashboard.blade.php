@extends("mobile.layouts.dashboard")
@section("content")
<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Group Dashboard</h2>
                </div>
                <div class="screen-number d-n">
                </div>
            </div>
        </div>
</section>
<section class="group-dashboard-section">
        <iframe class="group-dashboard-frame" src="{{ $groupDashboardUrl }}" title="Group Dashboard"></iframe>
</section>
<style>
.group-dashboard-section {
    padding: 0 12px 100px;
}
.group-dashboard-frame {
    display: block;
    width: 100%;
    height: calc(100vh - 190px);
    min-height: 480px;
    border: 0;
    border-radius: 16px;
    background: #fff;
}
</style>
@endsection
