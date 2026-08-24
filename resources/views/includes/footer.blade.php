<div class="main-footer-wrapper">
  <div class="cust-container">
    <div class="footer-cont " >
      <div class="footer-top  wow fadeInUp animated " data-wow-delay=".3s">
        <div class="footer-logo">
          <div class="img-sec"><a href="#"><img src="{{ asset('assets/images/logo.png') }}"></a></div>
          <div class="img-cont">
          </div>
        </div>
        <div class="footer-company">
          <h3>Our Program</h3>
          <ul>
            <li><a href="{{ url('tele-counseling') }}">Teletherapy</a></li>
            <li><a href="{{ url('medical-care-consent') }}">Medical Care  </a></li>
            <li><a href="{{ url('providers') }}">Providers</a></li>
            <li><a href="{{ url('pet-telehealth') }}">Tele-Vet</a></li>
            <li><a href="{{ url('healthcare-advocacy') }}"> Healthcare Advocacy</a></li>
            <li><a href="{{ url('legal-service') }}">Legal Advice Program</a></li>
            <li><a href="{{ url('medical-faqs') }}">Medical FAQ</a></li>
           <!--  <li><a href="{{ url('about') }}">About Us</a></li> -->
            <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
          </ul>
        </div>
        <div class="footer-customer">
          <h3>Customer Service</h3>
          <p>Need help? Let us help you.</p>
          <p><a href="mailto:support@iwilltilimwell.com"><span><img src="{{ asset('assets/images/mail-icon.png') }}"></span>support@iwilltilimwell.com</a></p>
        </div>
      </div>
      <div class="footer-newsletter wow fadeInUp animated" data-wow-delay=".3s">
        <div class="newsletter">
          <h4 class="theme-color-darkpink font-weight-bolder mb-0">HIPAA-compliant technology</h4>
        </div>
        <div class="social-icon">
          <ul>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom" >
    <div class="cust-container">
      <div class="footer-bottom-cont">
        <div class="footer-bottom-left">
          <ul>
            <li><a href="{{ url('privacy-policy') }}">Privacy Policy </a></li>
            <li><a href="{{ url('refund-policy') }}">Refund Policy </a></li>
            <li><a href="{{ url('term-and-conditions') }}">Terms & Conditions</a></li>

          </ul>
        </div>
        <div class="footer-bottom-right">
          <p>© <?= date('Y') ?> iwilltilimwell.com ! All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>


    <div class="card cookie-alert">
  <div class="card-body">

    <p class="card-text">This website stores cookies on your computer. These cookies are used to improve your website
      experience and provide more personalized services to you,
      both on this website and through other media. To find out more about the cookies we use, see our Privacy Policy.</p>
      <p>We won't track your information when you visit our site. But in order to comply with your preferences,
        we'll have to use just one tiny cookie so that you're not asked to make this choice again.</p>
    <div class="d-flex justify-content-center flex-wrap btn-group-cookie">

      <a href="#" class="btn btn-success accept-cookies">Accept</a>
      <a href="#" class="btn btn-danger decline-cookies">Decline</a>
       <a href="{{ url('about') }}" class=" btn-link text-white btn-secondary">Learn more</a>

    </div>
  </div>
</div>

</div>

<div id='loading' style="display:none">
  <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
   <circle cx="170" cy="170" r="160" stroke="#E2007C"/>
   <circle cx="170" cy="170" r="135" stroke="#404041"/>
   <circle cx="170" cy="170" r="110" stroke="#E2007C"/>
   <circle cx="170" cy="170" r="85" stroke="#404041"/>
</svg>
</div>
