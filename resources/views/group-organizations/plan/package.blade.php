<div class="tabs choose-plan">
@php
    $include_list = getPackageIncludeList();
@endphp
<script> 
var promo_data=""; 
</script>

        <div class="choose-plan-nav mt-0 mb-0">
            <div class="plan-nav-text">
                <div class="title">
                    <h2>Commission Policies</h2>
                </div>
                <div class="text">
                   
                </div>
            </div>
        </div>
		
		@include('group-organizations.plan.plan-list')
       
</div>


