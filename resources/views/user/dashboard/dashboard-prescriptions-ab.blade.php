<div class="dash-section">
	<div class="vis_dash2v_row">
		<div class="service_col">
			<div class="dashboard-title"><div class="title"><p>Prescription</p></div></div>
			<div class="dash-row-v1">
			@php 
			
				$data[] = ['id'=>'31','name'=>'Silver Prescription Plan','ico'=>'silver-prescription-plan.svg','slug'=>'prescriptions-a-type'];	
				$data[] = ['id'=>'32','name'=>'Gold Prescription Plan','ico'=>'gold-prescription-plan.svg','slug'=>'prescriptions-b-type'];	
				$data[] = ['id'=>'33','name'=>'Platinum Prescription Plan','ico'=>'platinum-prescription-plan.svg','slug'=>'prescriptions-c-type'];	
					
			@endphp	
				@include('user.dashboard.dashboard-layout-loop',['dash_layout'=>'left','data'=>$data])
			</div>
		</div>
		<div class="consul_col">
			<div class="dashboard-title"><div class="title"><p>Search Prescription</p></div></div>
			<div class="dash-row-v1">
			@php 
				$schedule[] = ['id'=>'12','name'=>'Prescription Search','ico'=>'search-prescription-plan.svg','slug'=>'search-prescription-plan'];					
			@endphp
				@include('user.dashboard.dashboard-layout-loop',['dash_layout'=>'right','data'=>$schedule])
			</div>
		</div>			
	</div>
</div>

<?php /*
<div class="dash-section dash-prescriptions">
    <div class="dashboard-title">
        <div class="title"><p>Prescriptions</p></div>
	</div>
	<div class="dash-row-v1">
        <a href="{{url('prescriptions-a-type')}}">
            <div class="dash-menu-card">
                                    <div class="icon">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect x="11" y="12" width="34.5243" height="34.5242" rx="17.2621" fill="#EEEFF4"/>
										<mask id="mask0_2387_256" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="1" width="35" height="35">
										<path d="M3 1H38V36H3V1Z" fill="white"/>
										</mask>
										<g mask="url(#mask0_2387_256)">
										<path d="M28.8487 8.77113H35.4365C36.5692 8.77113 37.4873 9.68988 37.4873 10.8219V28.229C37.4873 29.361 36.5692 30.2798 35.4365 30.2798H5.56348C4.43076 30.2798 3.5127 29.361 3.5127 28.229V10.8219C3.5127 9.68988 4.43076 8.77113 5.56348 8.77113H14.5438" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M5.56348 23.7427V11.027C5.56348 10.9138 5.65528 10.8219 5.76855 10.8219H14.6307" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M26.3789 10.8219H35.2314C35.3447 10.8219 35.4365 10.9138 35.4365 11.027V28.0239C35.4365 28.1371 35.3447 28.229 35.2314 28.229H5.76855C5.65528 28.229 5.56348 28.1371 5.56348 28.0239V26.1352" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M22.498 30.2794V33.4365" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M18.502 33.4365V30.2794" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M23.6582 33.4365H17.3416C16.3222 33.4365 15.4958 34.2629 15.4958 35.2822C15.4958 35.3955 15.5876 35.4873 15.7009 35.4873H25.2989C25.4121 35.4873 25.5039 35.3955 25.5039 35.2822C25.5039 34.2629 24.6776 33.4365 23.6582 33.4365Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M17.964 15.2421V16.7029C17.964 17.1924 17.6516 17.6265 17.1875 17.7823L12.2389 19.4462C10.8471 19.9138 9.90991 21.2167 9.90991 22.6837V28.229" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M23.0361 15.2496V16.7029C23.0361 17.1924 23.3485 17.6265 23.8127 17.7823L28.7612 19.4462C30.153 19.9137 31.0902 21.2167 31.0902 22.6837V28.229" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M14.5435 8.4917V4.09879C14.5435 2.67056 15.7013 1.51269 17.1296 1.51269H23.8703C25.2986 1.51269 26.4564 2.67056 26.4564 4.09879V8.4917" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M20.4789 15.8147C17.1869 15.8033 14.5435 13.0884 14.5435 9.79972V7.71619C15.7311 7.71968 17.5154 7.56963 19.4885 6.77571C20.4089 6.4054 21.1818 5.97084 21.8087 5.55535C21.9443 5.46546 22.1257 5.49718 22.2253 5.62563C22.5406 6.03175 23.0702 6.59401 23.8732 7.03923C24.9542 7.63847 25.9656 7.71243 26.4564 7.71619V9.86432C26.4564 13.1577 23.7783 15.8261 20.4789 15.8147Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M23.9363 17.8239L20.847 20.9101C20.6868 21.07 20.4273 21.07 20.2672 20.9101L17.1492 17.7953" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M13.0166 26.281H12.5375C12.3426 26.281 12.1846 26.123 12.1846 25.9281V24.2408C12.1846 23.0804 13.1253 22.1397 14.2856 22.1397C15.446 22.1397 16.3867 23.0804 16.3867 24.2408V25.9281C16.3867 26.123 16.2286 26.281 16.0337 26.281H15.5547" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M28.8155 24.4424C28.8155 25.4578 27.9915 26.281 26.975 26.281C25.9585 26.281 25.1345 25.4578 25.1345 24.4424C25.1345 23.427 25.9585 22.6038 26.975 22.6038C27.9915 22.6038 28.8155 23.427 28.8155 24.4424Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M26.9749 22.6038C27.136 22.2425 27.3672 21.5997 27.3751 20.7684C27.3835 19.8901 27.1386 19.2124 26.9749 18.8453" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M14.2857 22.1396C14.1581 21.7915 14.0168 21.2832 13.9932 20.6579C13.9626 19.8493 14.1424 19.2023 14.2857 18.8103" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
										<path d="M5.55566 23.5896V26.6095" stroke="#8462A8" stroke-linecap="round"/>
										<path d="M26.5371 8.76318H29.2021" stroke="#8462A8" stroke-linecap="round"/>
										</svg>

                                    </div>
@php
	$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
    $pay_amount = ($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan')))? 15 : 10;
@endphp									
                                    <div class="title">
                                        <p>Silver Prescription Plan</p>
                                    </div>
            </div>
        </a>

        <a href="{{url('prescriptions-b-type')}}">
            <div class="dash-menu-card">
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="8.76978" y="11.4873" width="34.5243" height="34.5242" rx="17.2621" fill="#EEEFF4"/>
					<path d="M4 6.92067V4.41797C4 2.53029 5.53029 1 7.41797 1H22.7485C24.6362 1 26.1665 2.53029 26.1665 4.41797V7.66326" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M26.1665 23.0463V31.5567C26.1665 33.4444 24.6362 34.9747 22.7485 34.9747H7.41797C5.53029 34.9747 4 33.4444 4 31.5567V9.38184" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M4 29.7175V31.5566C4 33.4443 5.53029 34.9746 7.41797 34.9746H22.7486C24.6363 34.9746 26.1666 33.4443 26.1666 31.5566V29.7175H4Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M12.6533 4.03662H17.5131" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M30.5395 15.4175V9.2358C30.5395 8.36736 29.8354 7.66333 28.967 7.66333H9.75851C8.89007 7.66333 8.18604 8.36736 8.18604 9.2358V21.2214C8.18604 22.0898 8.89007 22.7939 9.75851 22.7939H12.6552C13.1437 22.7939 13.595 23.0544 13.8393 23.4775L14.1642 24.0403C14.6904 24.9517 16.006 24.9517 16.5322 24.0403L16.8571 23.4775C17.1014 23.0544 17.5527 22.7939 18.0412 22.7939H28.9671C29.8355 22.7939 30.5396 22.0898 30.5396 21.2214V17.8103" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M18.7931 13.9733H17.3782C17.0377 13.9733 16.7617 13.6973 16.7617 13.3569V11.9419C16.7617 11.6014 16.4857 11.3254 16.1452 11.3254H14.6193C14.2788 11.3254 14.0028 11.6015 14.0028 11.9419V13.3569C14.0028 13.6974 13.7268 13.9733 13.3864 13.9733H11.9712C11.6307 13.9733 11.3547 14.2494 11.3547 14.5898V16.1158C11.3547 16.4563 11.6308 16.7323 11.9712 16.7323H13.3862C13.7267 16.7323 14.0026 17.0083 14.0026 17.3487V18.7637C14.0026 19.1042 14.2787 19.3802 14.6191 19.3802H16.145C16.4855 19.3802 16.7615 19.1041 16.7615 18.7637V17.3487C16.7615 17.0082 17.0375 16.7323 17.3779 16.7323H18.7929C19.1334 16.7323 19.4094 16.4562 19.4094 16.1158V14.5898C19.4097 14.2494 19.1336 13.9733 18.7931 13.9733Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M22.3516 11.3254H27.3069" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M22.3516 13.9363H27.3069" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M22.3516 16.5474H27.3069" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M22.3516 19.1584H27.3069" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M30.5383 15.2957V18.3327" stroke="#8462A8" stroke-linecap="round"/>
					<path d="M4.00293 6.64185V9.76762" stroke="#8462A8" stroke-linecap="round"/>
					</svg>

                </div>

@php
    $pay_amount = ($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan')))? 20 : 15;
@endphp
				
				
                <div class="title"><p>Gold Prescription Plan</p></div>
            </div>
        </a>
		
		
		<a href="{{url('prescriptions-c-type')}}">
            <div class="dash-menu-card">
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="11" y="12" width="34.5243" height="34.5242" rx="17.2621" fill="#EEEFF4"/>
					<mask id="mask0_2868_443" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="0" width="35" height="35">
					<path d="M3 3.8147e-06H38V35H3V3.8147e-06Z" fill="white"/>
					</mask>
					<g mask="url(#mask0_2868_443)">
					<path d="M28.3994 5.2131C28.6229 9.31398 28.7351 13.4258 28.7351 17.5C28.7351 21.9133 28.6031 26.3703 28.3413 30.8103C28.2374 32.5739 26.8449 33.9862 25.084 34.1318C19.3664 34.6049 13.6215 34.6056 7.91553 34.1332C6.15459 33.9876 4.76279 32.5753 4.65889 30.8116C4.39707 26.3778 4.26514 21.914 4.26514 17.5C4.26514 13.086 4.39707 8.62218 4.65889 4.18839C4.76279 2.42472 6.15459 1.01242 7.91553 0.866812C13.6215 0.394449 19.3664 0.395132 25.084 0.868179C26.4942 0.985073 27.668 1.91408 28.1328 3.18556" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M10.8427 30.3557C12.7226 30.4459 14.612 30.4917 16.4864 30.4917C19.2864 30.4917 22.122 30.3898 24.9151 30.1889C25.6575 30.1355 26.2509 29.6119 26.2939 28.9721C26.553 25.1508 26.6843 21.2905 26.6843 17.5C26.6843 13.7095 26.553 9.84922 26.2939 6.02793C26.2509 5.38809 25.6575 4.86446 24.9151 4.81114C22.1227 4.61016 19.2864 4.50831 16.4864 4.50831C13.6919 4.50831 10.8646 4.61016 8.08438 4.81045C7.34199 4.86377 6.74932 5.38672 6.70557 6.02657C6.44717 9.84444 6.31592 13.7047 6.31592 17.5C6.31592 21.2953 6.44717 25.1556 6.70557 28.9734C6.74932 29.6133 7.34199 30.1362 8.08438 30.1896C8.32295 30.2066 8.56221 30.223 8.80146 30.2388" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M13.3599 2.6084H19.6402" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M9.40771 23.2322H23.5927" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M9.40771 20.8679H23.5927" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M9.40771 25.5962H19.2042" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M12.1422 12.8838C13.5082 14.3355 14.9171 15.7444 16.3689 17.1105C17.6082 18.2768 19.5596 18.2619 20.7655 17.061C20.7799 17.0466 20.7943 17.0323 20.8086 17.0178C22.0096 15.812 22.0244 13.8607 20.8581 12.6212C19.492 11.1696 18.0831 9.76061 16.6314 8.39459C15.392 7.22824 13.4407 7.24314 12.2348 8.44401C12.2204 8.45843 12.206 8.47279 12.1916 8.48721C10.9908 9.69307 10.9759 11.6445 12.1422 12.8838Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M18.7768 10.4756L14.2234 15.0291" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					</g>
					</svg>

                </div>
                <div class="title"><p>Platinum Prescription Plan</p></div>
            </div>
        </a>
		
        <a href="javascript:void(0)" data-toggle="modal" data-target="#pre-search-dash-model" onclick="prescriptionsearchmodal()">
            <div class="dash-menu-card">
                <div class="icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="11" y="12" width="34.5243" height="34.5242" rx="17.2621" fill="#EEEFF4"/>
					<g clip-path="url(#clip0_2866_148)">
					<mask id="mask0_2866_148" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="35" height="35">
					<path d="M35 3.8147e-06H3.8147e-06V35H35V3.8147e-06Z" fill="white"/>
					</mask>
					<g mask="url(#mask0_2866_148)">
					<path d="M26.485 24.4227C26.98 23.9277 27.8252 23.9585 28.3201 24.4535C28.6258 24.7592 28.6257 25.2549 28.3199 25.5607L25.5608 28.3199C25.255 28.6257 24.7593 28.6258 24.4535 28.3201C23.9586 27.8252 23.9231 26.9839 24.4181 26.4889" stroke="#8462A8" stroke-miterlimit="10" stroke-linejoin="round"/>
					<path d="M29.0181 30.8787L26.2154 27.6653L27.6653 26.2153L33.9403 31.6883C34.6369 32.2959 34.6734 33.3662 34.0198 34.0198C33.3662 34.6734 32.2959 34.6369 31.6883 33.9403L30.6985 32.8053" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M4.53689 15.153C4.53689 21.0161 9.28971 25.769 15.1527 25.769C21.0157 25.769 25.7686 21.0161 25.7686 15.153C25.7686 9.28999 21.0157 4.53703 15.1527 4.53703C9.28971 4.53703 4.53689 9.28999 4.53689 15.153Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linejoin="round"/>
					<path d="M11.3009 15.153C11.3009 21.0161 13.0255 25.769 15.1528 25.769C17.2801 25.769 19.0046 21.0161 19.0046 15.153C19.0046 9.28999 17.2801 4.53703 15.1528 4.53703C13.0255 4.53703 11.3009 9.28999 11.3009 15.153Z" stroke="#8462A8" stroke-miterlimit="10" stroke-linejoin="round"/>
					<path d="M24.4307 20.3147H5.87451" stroke="#8462A8" stroke-miterlimit="10" stroke-linejoin="round"/>
					<path d="M24.4399 10.0066H5.86561" stroke="#8462A8" stroke-miterlimit="10" stroke-linejoin="round"/>
					<path d="M25.7686 15.1531H4.53689" stroke="#8462A8" stroke-miterlimit="10" stroke-linejoin="round"/>
					<path d="M6.21691 26.7506C2.74754 24.0734 0.512803 19.8741 0.512803 15.1529C0.512803 7.06735 7.06737 0.512639 15.1529 0.512639C23.2384 0.512639 29.793 7.06735 29.793 15.1529C29.793 23.2385 23.2384 29.7932 15.1529 29.7932C12.6712 29.7932 10.3338 29.1757 8.28581 28.0861" stroke="#8462A8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					</g>
					</g>
					<defs>
					<clipPath id="clip0_2866_148">
					<rect width="35" height="35" fill="white"/>
					</clipPath>
					</defs>
					</svg>

                </div>
                <div class="title"><p>Prescription Search</p></div>
            </div>
        </a>

                            
    </div>
</div>
*/ ?>