@extends("mobile.layouts.group-organizations")
@section("content")


<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('group-organizations')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">My Account Details</p>
                </div>
                <div class="screen-number d-n">
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
</section>

<section class="custom-tab tab-edit-v2">
        <div class="cust-container-lg">
            <div class="tab-container">
		
                <div class="tab-content-detail account-edit-tab">
                  
                        @include('mobile.auth.my-account-tab.personal-info')
                       

                </div>
            </div>
        </div>
</section>

<script>
        // JavaScript for tab functionality
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');
        const tabButtonsContainer = document.querySelector('.tab-buttons');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Remove active class from all buttons and tabs
                tabLinks.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to the clicked button and corresponding tab
                link.classList.add('active');
                document.getElementById(link.dataset.tab).classList.add('active');

                // Scroll to center the active button
                const buttonRect = link.getBoundingClientRect();
                const containerRect = tabButtonsContainer.getBoundingClientRect();
                const offset = buttonRect.left - containerRect.left - containerRect.width / 2 + buttonRect.width / 2;
                tabButtonsContainer.scrollBy({
                    left: offset,
                    behavior: 'smooth'
                });

                const url = new URL(window.location);
                 url.searchParams.set('active-tab', link.getAttribute("data-tab")); // Set or update the "active-tab" parameter
                 window.history.pushState({}, '', url); // Update the browser's URL bar

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
function nextTab() {
    $(".tab-link.active").trigger("click");
}    
nextTab();    
</script>



@include('mobile.includes.foooter-tab')	
@endsection