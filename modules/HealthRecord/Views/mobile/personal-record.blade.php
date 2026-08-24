@extends('mobile.layouts.dashboard')
@section('content')
<?php
use Carbon\Carbon;
?>
    <section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">

                  <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                     <img src="{{ asset('assets/dashboard/assets/images/left-errow.png')}}" alt="back icon">
                  </a>

                </div>
                <div class="top-title">
                    <h2 class="title">Health Record</h2>
                </div>
                <div class="screen-number">
                    
                </div>
            </div>
        </div>
    </section>

    <section class="custom-tab">
        <div class="cust-container-lg">
            <div class="tab-container">
                <div class="tab-header">
                    <!-- Tab Buttons -->
                    <div class="tab-buttons">
                        <button class="tab-link tab-list-class {{ request()->get('active-tab') == 'tab1' || !request()->has('active-tab') ? 'active' : '' }}" data-tab="tab1">Personal Details</button>
                        <button   class="tab-link tab-list-class {{ request()->get('active-tab') == 'tab2' ? 'active' : '' }}" data-tab="tab2">Medications</button>
                        <button  class="tab-link tab-list-class {{ request()->get('active-tab') == 'tab3' ? 'active' : '' }}" data-tab="tab3">Medication Allergies</button>
						
                        <button  class="tab-link tab-list-class {{ request()->get('active-tab') == 'tab4' ? 'active' : '' }}" data-tab="tab4">Medical Conditions</button>
						
                        <button  class="tab-link tab-list-class {{ request()->get('active-tab') == 'tab5' ? 'active' : '' }}" data-tab="tab5">Surgical Conditions</button>
						
                        <button  class="tab-link tab-list-class {{ request()->get('active-tab') == 'tab6' ? 'active' : '' }}" data-tab="tab6">Document manager</button>
                    </div>
                </div>

                <div class="tab-content-detail">
                    
                  

                    <div id="tab1" class="tab-content {{ request()->get('active-tab') == 'tab1' || !request()->has('active-tab') ? 'active' : '' }}">

						@include('HealthRecord::mobile.health-record.medications-card-header',['slug'=>'personal-detail'])
                        @include('HealthRecord::mobile.health-record.personal-detail')
                        
                    </div>
                    <div id="tab2" class="tab-content {{ request()->get('active-tab') == 'tab2' ? 'active' : '' }}">
						
						@include('HealthRecord::mobile.health-record.medications-card-header',['slug'=>'medications'])
                        @include('HealthRecord::mobile.health-record.medications-detail')

                    </div>
                    <div id="tab3" class="tab-content {{ request()->get('active-tab') == 'tab3' ? 'active' : '' }}">
						
						@include('HealthRecord::mobile.health-record.medications-card-header',['slug'=>'medications-allergies'])
                        @include('HealthRecord::mobile.health-record.medications-allergies-detail')

                    </div>

                    <div id="tab4" class="tab-content {{ request()->get('active-tab') == 'tab4' ? 'active' : '' }}">
						
						@include('HealthRecord::mobile.health-record.medications-card-header',['slug'=>'medical-condition'])
						@include('HealthRecord::mobile.health-record.medical-condition-detail')

                        
                    </div>
                    <div id="tab5" class="tab-content {{ request()->get('active-tab') == 'tab5' ? 'active' : '' }}">
						
						@include('HealthRecord::mobile.health-record.medications-card-header',['slug'=>'surgical'])
						@include('HealthRecord::mobile.health-record.surgical-screen')

                        
                    </div>
					<div id="tab6" class="tab-content {{ request()->get('active-tab') == 'tab6' ? 'active' : '' }}">
					
						@include('HealthRecord::mobile.health-record.medications-card-header',['slug'=>'document-manager'])	
						@include('HealthRecord::mobile.health-record.document-manager-detail')

                        
                    </div>
                    
                </div>

            </div>
        </div>
    </section>

    @include('mobile.includes.foooter-tab')
    
    <script>
       
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');
        const tabButtonsContainer = document.querySelector('.tab-buttons');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
				
			
                tabLinks.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                link.classList.add('active');
                document.getElementById(link.dataset.tab).classList.add('active');

        
                const buttonRect = link.getBoundingClientRect();
                const containerRect = tabButtonsContainer.getBoundingClientRect();
                const offset = buttonRect.left - containerRect.left - containerRect.width / 2 + buttonRect.width / 2;
                tabButtonsContainer.scrollBy({
                    left: offset,
                    behavior: 'smooth'
                });
              
                

                const url = new URL(window.location);
                 url.searchParams.set('active-tab', link.getAttribute("data-tab"));
                 window.history.pushState({}, '', url); 

				
                nextTabHealRecoards();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const customSelects = document.querySelectorAll(".custom-select");
            customSelects.forEach((customSelect) => {
                const selectSelected = customSelect.querySelector(".select-selected");
                const selectItems = customSelect.querySelector(".select-items");
                // Toggle dropdown visibility
                selectSelected.addEventListener("click", () => {
                    closeAllSelectsExcept(customSelect);
                    selectItems.classList.toggle("select-hide");
                    selectSelected.classList.toggle("select-arrow-active");
                });
                // Handle item selection
                selectItems.addEventListener("click", (e) => {
                    if (e.target.tagName === "LI") {
                        selectSelected.textContent = e.target.textContent;
                        selectItems.classList.add("select-hide");
                    }
                });
            });
            // Close all other selects when clicking outside
            document.addEventListener("click", (e) => {
                if (!e.target.closest(".custom-select")) {
                    closeAllSelects();
                }
            });
            // Helper function to close all selects
            function closeAllSelects() {
                customSelects.forEach((customSelect) => {
                    customSelect.querySelector(".select-items").classList.add("select-hide");
                    customSelect.querySelector(".select-selected").classList.remove("select-arrow-active");
                });
            }
            // Close all selects except the current one
            function closeAllSelectsExcept(currentSelect) {
                customSelects.forEach((customSelect) => {
                    if (customSelect !== currentSelect) {
                        customSelect.querySelector(".select-items").classList.add("select-hide");
                        customSelect.querySelector(".select-selected").classList.remove("select-arrow-active");
                    }
                });
            }
        });

        document.querySelectorAll('.toggle-icon').forEach(icon => {
            console.log("Here");
            icon.addEventListener('click', function (event) {
                document.querySelectorAll('.toggle-content').forEach(content => {
                    if (content !== this.nextElementSibling) {
                        content.classList.add('hidden');
                    }
                });
                const content = this.nextElementSibling;
                content.classList.toggle('hidden');

                event.stopPropagation();
            });
        });
        document.addEventListener('click', function () {
            document.querySelectorAll('.toggle-content').forEach(content => {
                content.classList.add('hidden');
            });
        });
        document.querySelectorAll('.toggle-content').forEach(content => {
            content.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });        
    </script>

    <script>
        document.getElementById('file-upload').addEventListener('change', function () {
            const fileName = this.files[0]?.name || 'No file chosen';
            document.querySelector('.file-name').textContent = fileName;
        });

function nextTabHealRecoards(request) {
	
	if(request) {
		$(".tab-list-class").removeAttr("disabled");
	}
	
	
	
    var currentTab = $(".tab-link.active");
    if(request=="next_tab") {
        var target_tab = currentTab.next(".tab-link"); 
    } else if(request=="preview") {
        var target_tab = currentTab.prev(".tab-link"); 
    }
    if(request=="next_tab" || request=="preview") { 
            if (target_tab.length > 0) { 
                var currentContent = $(".tab-content.active");
                if(request=="preview") {
                    var nextContent = currentContent.prev(".tab-content")
                } else {
                    var nextContent = currentContent.next(".tab-content")
                }
                
                currentContent.removeClass("active");
                nextContent.addClass("active");
                currentTab.removeClass("active");
                target_tab.addClass("active");

                


            }
    }
    let currenttabIndex = $(".tab-link.active").index(); 
    $(".screen-number").html("<p><span>"+parseInt(currenttabIndex+1)+"</span> of <span>6</span></p>");
    $(".tab-link.active").trigger("click");
	//$(".tab-list-class").attr("disabled");
	//$(".tab-list-class.active").removeAttr("disabled");
	addAttributeDisabledButton();
	
	
	$('.nav-item-link-anchor a').each(function () {
	
		const params = new URLSearchParams(window.location.search);
		const activeTab = params.get('active-tab');
		
        let baseHref = $(this).attr('href').split('?')[0];
        $(this).attr('href', baseHref + '?active-tab=' + activeTab); 
		
		
    });
	
}
nextTabHealRecoards();
function OnClickHealthDocumentDeleted(request_from) {

    $("#health-record-popup-confirmation").addClass("show");
    $(".confirm_btn").attr("onclick","OnClickHealthDocumentDeletedConfirm('"+request_from+"')");

}
function OnClickHealthDocumentDeletedConfirm(request_from) {
    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
    let url = $("#"+request_from+"-url").val();
    let id = $("#"+request_from+"-deleted-id").val(); 
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    var formData = new FormData(); 
	formData.append('_token', csrfToken);
    formData.append('id', id);
    if(request_from=="document-manager-tab") {
        formData.append('_method', 'DELETE');
    }
    $.ajax({
               method: "POST",
               url:url,
               data:formData,
               processData: false, 
               contentType: false,
               success: function(data) {
                   
                   location.reload();

               },
    });
}

function getLocalValueStoreForm(array_values,id){
    $('#'+id+' input, #'+id+' select').each(function() {
        array_values[$(this).attr('name')] = $(this).val();
    });
    return array_values
}
function addAttributeDisabledButton() {
	
	setTimeout(function() {
		$(".tab-list-class").attr("disabled",true);
		
	}, 400);

	
}
</script>

<div class="popup" id="health-record-popup-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('health-record-popup-confirmation')">&times;</span>
  
      <div class="popu-content delete-pup">
          <div class="delete-alert" >
              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png')}}" />
          </div>
          <div class="complete-form">
             <h2 class="text-center heading">Are you sure ? </h2>
             <p class="text-center message" style="padding: 10px 0 0 0;">Are you sure you want to delete this record?</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button confirm_btn" href="javascript:void(0)">Yes</a>
              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('health-record-popup-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>  

@endsection
