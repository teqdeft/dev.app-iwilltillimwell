
<?php if( Request::segment(2) != '' ){
  $image = DB::table('companies')->where('slug',Request::segment(2))->pluck('logo'); 
  if( $image ){
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row row-footer-logo">
                    <div class="col-md-6">
                        <img src="{{ asset($image[0]??'/') }}" alt="">
                    </div>
                    <div class="col-md-6">
                        <p class="powered-by">Powered by</p>
                        <img src="{{ asset('assets/services/images/main-logo.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-right">
                    <div class="quick-links">
                        
                    </div>
                    <div class="contact-info">
                        <h4>Contact Info</h4>
                        <p><a href="#">support@imwell.com</a></p>
                        <ul class="social-links">
                            <li><a href="#"><img src="{{ asset('assets/services/images/linkedin.png') }}"></a></li>
                            <li><a href="#"><img src="{{ asset('assets/services/images/instagram.png') }}"></a></li>
                            <li><a href="#"><img src="{{ asset('assets/services/images/twitter.png') }}"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="copyright">
        <p>Copyright © 2022 by imwell.com All rights Reserved</p>
    </div>
</footer>
<?php } } ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/services/js/slick.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery.nestable.js') }}"></script>

<script>
$('.blog-inner').slick({
  dots: false,
  infinite: false,
  speed: 300,
autoplay: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});		


// $('.blog-inner').slick({
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     autoplay: false,
// });
$(document).ready(function(){
    //Event for pushed the video
    $('.carousel').carousel({
        pause: true,
        interval: false
    });
});
</script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      includedLanguages: 'en,es,fr',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');

  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>