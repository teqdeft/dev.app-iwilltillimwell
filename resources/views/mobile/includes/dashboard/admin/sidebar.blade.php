@php $permissions = get_permissions(); @endphp
<nav class="sidebar sidebar-offcanvas " id="sidebar">
   <ul class="nav">
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="fas fa-chart-line menu-icon"></i>
            <span class="menu-title">Dashboard</span>
         </a>
      </li>
      @if(permission_exist('users_view',$permissions))
        <li class="nav-item">
           <a class="nav-link" href="{{ url('admin/users/subscriber') }}">
              <i class="fas fa-users menu-icon"></i>
              <span class="menu-title">Subscriber</span>
           </a>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="{{ url('admin/users/employee') }}">
              <i class="fas fa-users menu-icon"></i>
              <span class="menu-title">Employee</span>
           </a>
        </li>
      @endif
      @if(permission_exist('permission_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/permission') }}">
            <i class="fas fa-shield-alt menu-icon"></i>
            <span class="menu-title">Permission</span>
         </a>
      </li>
      @endif
      @if(permission_exist('categories_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/categories') }}">
            <i class="fab fa-blogger menu-icon"></i>
            <span class="menu-title">Media Hub Categories</span>
         </a>
      </li>
      @endif
      @if(permission_exist('blogs_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/blog') }}">
            <i class="fas fa-blog menu-icon"></i>
            <span class="menu-title">Media Hub</span>
         </a>
      </li>
      @endif
      @if(permission_exist('plan_type_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/plan-type') }}">
            <i class=" fas fa-money-bill-wave-alt menu-icon"></i>
            <span class="menu-title">Plans Type</span>
         </a>
      </li>
      @endif
      @if(permission_exist('plans_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/plans') }}">
            <i class="fas fa-money-check-alt menu-icon"></i>
            <span class="menu-title">Plans</span>
         </a>
      </li>
      @endif
      @if(permission_exist('affiliates_counselors_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/influencers') }}">
            <i class="fas fa-user-tag menu-icon"></i>
            <span class="menu-title">Affiliate / Counselor</span>
         </a>
      </li>
      @endif
      @if(permission_exist('promo_codes_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/promo-codes') }}">
            <i class="fas fa-tags menu-icon"></i>
            <span class="menu-title">Promo Code</span>
         </a>
      </li>
      @endif
      @if(permission_exist('group_counseling_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/group-counseling') }}">
            <i class="fas fa-handshake menu-icon"></i>
            <span class="menu-title">Group Counseling</span>
         </a>
      </li>
      @endif
      @if(permission_exist('services_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/corporate') }}">
            <i class="fas fa-sitemap menu-icon"></i>
            <span class="menu-title">imWELL App Set Up</span>
         </a>
      </li>
      @endif
      @if(permission_exist('journal_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/journal') }}">
            <i class="fas fa-journal-whills menu-icon"></i>
            <span class="menu-title">Journal</span>
         </a>
      </li>
      @endif

      @if(permission_exist('safety_view',$permissions))
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/safety') }}">
            <i class="fas fa-journal-whills menu-icon"></i>
            <span class="menu-title">Safety Plans</span>
         </a>
      </li>
      @endif

      @if(permission_exist('affirmation_view',$permissions))
      <li class="nav-item hr-list-box">
         <a class="nav-link collapsed" data-toggle="collapse" href="#affirmation" aria-expanded="false" aria-controls="affirmation">
            <i class="fas fa-laptop-medical menu-icon"></i>
            <span class="menu-title">Affirmation</span>
            <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="affirmation">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item "> <a class="nav-link dropdown-btn" href="{{ url('admin/affirmation/type') }}">Type</a></li>
               <li class="nav-item "> <a class="nav-link dropdown-btn" href="{{ url('admin/affirmation') }}">List</a></li>
            </ul> 
         </div>
      </li>
      @endif

      @if(permission_exist('manage_content_view',$permissions))
      
      <li class="nav-item">
         <a class="nav-link" href="{{ url('admin/menu') }}">
            <i class="fas fa-bars menu-icon"></i>
            <span class="menu-title">Menu</span>
         </a>
      </li>

      <li class="nav-item hr-list-box">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="fas fa-laptop-medical menu-icon"></i>
            <span class="menu-title">Manage Content</span>
            <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item "> <a class="nav-link dropdown-btn" href="{{ url('admin/manage-page/landing') }}">Home Page</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/tele-counseling') }}">Teletherapy</a></li>
               <li class="nav-item ">
                  <a class="nav-link collapsed" data-toggle="collapse" data-target="#submenu2">
                     <span class="menu-title">Group Counseling</span>
                     <i class="menu-arrow"></i></a>
                  <div class="collapse" id="submenu2">
                     <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/about-group-counseling') }}">About Group Counseling</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/working-with-anexity') }}">Working with Anxiety</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/healthy-boundaries-relations') }}">Setting Healthy Boundaries in Relationships</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/grief-loss') }}">Grief & Loss</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/emotion-regulations') }}">Emotion & Regulations</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/understanding-purpose') }}">Understanding Purpose</a></li>
                     </ul>
                  </div>
               </li>

               <li class="nav-item ">
                  <a class="nav-link collapsed" data-toggle="collapse" data-target="#submenu3">
                     <span class="menu-title">Medical Care</span>
                     <i class="menu-arrow"></i></a>
                  <div class="collapse" id="submenu3">
                     <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/telemedicine') }}">Telemedicine</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/message-a-specialist') }}">Message a Specialist</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/advocacy-program') }}">Care Coordinator</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/precription-program') }}">Precription Program</a></li>
                     </ul>
                  </div>
               </li>

               <li class="nav-item ">
                  <a class="nav-link collapsed" data-toggle="collapse" data-target="#submenu4">
                     <span class="menu-title">Providers</span>
                     <i class="menu-arrow"></i></a>
                  <div class="collapse" id="submenu4">
                     <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/professional-welllness-partners') }}">Professional Wellness Partners</a></li>
                     </ul>
                  </div>
               </li>

               <li class="nav-item ">
                  <a class="nav-link collapsed" data-toggle="collapse" data-target="#legal">
                     <span class="menu-title">Legal</span>
                     <i class="menu-arrow"></i></a>
                     <div class="collapse" id="legal">
                     <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/legal-informational-services') }}">Legal Informational Services</a></li>
                     </ul>
                  </div>
               </li>
               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/pet-telehealth') }}">Tele-Vet</a></li>
               
               <li class="nav-item ">
                  <a class="nav-link collapsed" data-toggle="collapse" data-target="#faq">
                     <span class="menu-title">FAQ</span>
                     <i class="menu-arrow"></i></a>
                  <div class="collapse" id="faq">
                     <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/medical-faq') }}">Medical FAQ</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/prescription-faq') }}">Prescription FAQ</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/counseling-faq') }}">Counseling FAQ</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/group-counseling-faq') }}">Group Counseling FAQ</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/legal-information-services-faq') }}">Legal Information Services FAQ</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/pet-faq') }}">Pet FAQ</a></li>
                     </ul>
                  </div>
               </li>
               <!-- <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/pet-tele-health') }}">Pet Tele-Health</a></li> -->
               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/enterprise-eap') }}">Enterprise EAP</a></li>
              
               <li class="nav-item ">
                  <a class="nav-link collapsed" data-toggle="collapse" data-target="#community">
                     <span class="menu-title">Community</span>
                     <i class="menu-arrow"></i></a>
                  <div class="collapse" id="community">
                     <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/podcast-blogs') }}">Podcasts / Blogs</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/knowledge-library') }}">Knowledge Library</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/about') }}">About</a></li>
                        <li class="nav-item ">
                           <a class="nav-link collapsed" data-toggle="collapse" data-target="#IAC">
                              <span class="menu-title">Inclusion & Access</span>
                              <i class="menu-arrow"></i></a>
                           <div class="collapse" id="IAC">
                              <ul class="nav flex-column sub-menu">
                                 <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/biopoc') }}">BIPOC</a></li>
                                 <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/latino-lantinx') }}">Latino / LATINX</a></li>
                                 <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/lgbtq') }}">LGBTQ</a></li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </li>

               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/brochure') }}">Brochures</a></li>

               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/rss-feeds') }}">Topics</a></li>

               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/term-and-conditions') }}">Terms & Conditions</a></li>

               <li class="nav-item"> <a class="nav-link" href="{{ url('admin/manage-page/privacy') }}">Privacy</a></li>

            </ul>
         </div>
      </li>
      @endif
   </ul>
</nav>
