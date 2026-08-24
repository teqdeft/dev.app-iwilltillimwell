@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner group-counseling-banner" style="background-image: url('assets/images/contact-header-img.jpg');">
         <div class="cust-container">
            <div class="banner-cont">
               <h1 class="wow fadeInUp">Contact Us</h1>
      
            </div>
         </div>
      </div>
      <section class="contact-page-sec">
         <div class="cust-container">
            <div class="">
               <div class="wow fadeInUp contact-box" >
                  <h2 class="theme-heading-text fs-30 text-center lh-1">Any question or remarks? Just write us a message!</h2>
                  <div class="row row-contact-us">
                    <div class="col-md-5">
                      <h2 class="theme-heading-text fs-30 lh-1">Contact Information</h2>
                      <p>Fill out the form and our Team will get back to you.</p>
                      <div class="conact-info">
                        <a href="#"><span><img src="{{ asset('assets/images/tm-phone-icon.png') }}" alt="tm-phone-icon" /></span> +1 833 2375 455</a>
                        <a href="#"><span><img src="{{ asset('assets/images/tm-email-icon.png') }}" alt="tm-phone-icon" /></span> support@iwilltilimwell.com</a>
                        <span><span><img src="{{ asset('assets/images/tm-location-icon.png') }}" alt="tm-phone-icon" /></span> 1728 Goldentree Drive, Ste 100
                          San Jose CA, 95131</span>
                      </div>
                      <div class="social-icon-group">
                        <ul>
                          <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fab fa-vimeo-v" aria-hidden="true"></i></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-7">
                     
                      <form class="form-contact-us" method="post" action="contact-us" data-form-title="CONTACT US" id="contact-us-form">
                        {{csrf_field('POST')}}
                              <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="exampleInputFirstName">First Name</label>
                                      <input type="text" class="form-control" name="first_name" required="" placeholder="" data-form-field="First Name">
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="exampleInputLastName">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" required="" placeholder="" data-form-field="Last Name">
                                      </div>
                                      </div>
                                      <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail">Email</label>
                                      <input type="email" class="form-control" name="email" required="" placeholder="" data-form-field="Email">
                                    </div></div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail">Phone</label>
                                      <input type="tel" class="form-control" name="phone" placeholder="" data-form-field="Phone">
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <div class="form-group mb-0">
                                      <label for="exampleInputMessage">Message</label>
                                      <textarea class="form-control" name="message" placeholder="" rows="7" data-form-field="Message"></textarea>
                                    </div></div>
                                    <div class="col-sm-12 text-right">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  
                                </div>
                              </div></form>
                           
                        

                    </div>
                  </div>
                  
               
                  </div>
               </div>
            </div>
         </section>
@endsection