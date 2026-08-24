<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->
 <script src="https://www.google.com/recaptcha/api.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script type="text/javascript" src="<?= asset('assets/js/validation-2.js') ?>"></script>
<script type="text/javascript" src="{{ asset('assets/js/additional-methods.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="{{ asset('assets/js/datepickers.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/slick.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/daypilot/daypilot-all.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      includedLanguages: 'en,es',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');

  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
  new WOW().init();
</script>
<script>
  $(document).ready(function() {

    var poppy = localStorage.getItem('myPopup');
    if (!poppy) {
      function PopUp() {		/*
        $("#popupModal").modal('show');		*/ 
      }

      setTimeout(function() {
        PopUp();
      }, 2000); 

      localStorage.setItem('myPopup', 'true');
    }

  });
  $(document).ready(function() {
    $('.hamburger-menu ul').click(function() {
      $('.hamburger-menu ul').toggleClass('active');
    })

    $(".mobile-menu").click(function() {
      $("body").toggleClass("main-show");
    });
    $('.mobile-menu').on('click', function() {
      $('.navbar-toggler').trigger('click');
    });
  });
</script>
<script>
  $(document).ready(function() {

    $('.my-next-button').on('click', function() {
      $('button.slick-next.slick-arrow').trigger('click');
    });
    $('.my-prev-button').on('click', function() {
      $('button.slick-prev.slick-arrow').trigger('click');
    });
    $("div[data-toggle=collapse]").click(function() {
      $(this).children('span').toggleClass("fa-chevron-down fa-chevron-up");
    });

    let lang = $("html").attr("lang");
    if (lang == "es") {
      $('.span-lag').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('¿', 'R'));
      });
    }
  });
</script>

<script type="text/javascript">
  @if(Session::has('success'))
    toastr.success("{{ session('success') }}")
    {{ Session::forget('success') }}
  @elseif(Session::has('error'))
    toastr.error("{{ session('error') }}")
    {{ Session::forget('error') }}
  @elseif(Session::has('warning'))
     toastr.warning("{{ session('warning') }}")
     {{ Session::forget('warning') }}
  @elseif(Session::has('info'))
     toastr.info("{{ session('info') }}")
     {{ Session::forget('info') }}
  @endif
</script>
<script type="text/javascript">
  $('.slick-slider-cus').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 1000,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [{
        breakpoint: 1441,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
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
        breakpoint: 578,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
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
 $('.sliderhome').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [{
        breakpoint: 1441,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
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
        breakpoint: 578,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
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
  (function() {
    "use strict";

    var cookieAlert = document.querySelector(".cookie-alert");
    var acceptCookies = document.querySelector(".accept-cookies");

    cookieAlert.offsetHeight; // Force browser to trigger reflow (https://stackoverflow.com/a/39451131)

    if (!getCookie("acceptCookies")) {
      cookieAlert.classList.add("show");
    }

    acceptCookies.addEventListener("click", function() {
      setCookie("acceptCookies", true, 60);
      cookieAlert.classList.remove("show");
    });
  })();


  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) === 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  $(document).on("click", ".decline-cookies", function(e) {
    $('.cookie-alert').removeClass("show");
  });

  $(document).ready(function() {
    function formatDesign(item) {
      console.log( item );
      //var selectionText = item.text.split(".");
      /*var $returnString = selectionText[0] + "</br>" + selectionText[1];
      return $returnString;*/
    }
    $('.commanSelect2').select2({
      escapeMarkup: function(m) {
        return m;
      }
    });


    /* daypiolet */
    
    if( typeof $('#dp').attr('alldataget') !== 'undefined' ){
        console.log(1);
           var allDataTaget = JSON.parse($('#dp').attr('alldataget'));
        var setData = [];
        var setTime = [];
    
        
    
         $.each(allDataTaget,function(i,v){
           var dateTime = new Date(v.start);
             setData.push({
                  start: new DayPilot.Date(`${v.start}`),
                  end: new DayPilot.Date(`${v.end}`).addHours(1),
                  id: DayPilot.guid() + `__${v.id}`,
                  text: v.text,
                  barColor: v.barColor,
                  barBackColor: v.barbarColor
              })
              setTime.push({
                   start: new DayPilot.Date(`${v.start}`),
                   end: new DayPilot.Date(`${v.end}`),
               })
         })
    
        var nav = new DayPilot.Navigator("nav");
        nav.showMonths = 2;
        nav.skipMonths = 2;
        if($(window).width() >= 768) {
          nav.selectMode = "Week";
        }
        nav.selectionDay = DayPilot.Date.today();
    
    
        nav.onVisibleRangeChange = function (args) {
          console.log('args',args );
           var start = args.start;
           var end = args.end;
           if (start <= nav.selectionDay && nav.selectionDay < end) {
               return;
           }
           var day = nav.selectionDay.getDay();
           var target = start.firstDayOfMonth().addDays(day);
           nav.select(target);
        };
        console.log(2);
    
    
    
        nav.onTimeRangeSelected = function(args) {
            dp.startDate = args.start;
            dp.update();
        };
        //nav.events.list = setTime;
        nav.init();
        var dp = new DayPilot.Calendar("dp");
        dp.startDate = nav.selectionDay;
        if($(window).width() <= 768) {
          dp.viewType = "Days";
        }else{
          dp.viewType = "Week";
        }
    
        
        dp.scale = "CellDuration";
        dp.cellDuration = 60;
        dp.eventClickHandling = "Select";
        dp.eventMoveHandling = "Disabled";
        dp.eventResizeHandling = "Disabled";
    
        dp.events.list = setData;
        console.log(3);
        
        dp.onEventClicked = function(args) {
          $('#select_counseling').val(args.e.id());
          $('#counseling-title').html(args.e.data.text);
          $('.next-step-button').show();
        };
        console.log(4);
    
       
        dp.init();
    }

 
    

    $(document).on('click','.calendar_default_event',function(){
      $('.calendar_default_event_inner').removeClass('calendar_default_selected');
      $(this).children('.calendar_default_event_inner').addClass('calendar_default_selected');
    })

    $(document).on('click','.next-step-button',function(){
        $('.first-counseling-step').hide();
        $('.second-counseling-step').show();
        $(this).hide();
        $('.preview-step-button').show();
    })

    $(document).on('click','.preview-step-button',function(){
        $('.first-counseling-step').show();
        $('.second-counseling-step').hide();
        $('.next-step-button').show();
        $(this).hide();
    })

    /*$('.navigator_default_month').each(function(){
      var month = $(this).children('.navigator_default_title').html();
      $.each(allDataTaget,function(i,v){
        var dateTime = new Date(v.start);
      })
        console.log(month);
    })*/


});

$(document).ready(function(){
  //$(".sort-blog-btns li:first").addClass("active");
 $(".sort-blog-btns  a").click(function(){
  $(".sort-blog-btns li").removeClass("active");
 $(this).parent().toggleClass("active");
});



    });

</script>
<script>
window.embeddedChatbotConfig = {
chatbotId: "S1JGSkRkW3T7iOdowYowj",
domain: "www.chatbase.co"
}
</script>

<?php /*
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="S1JGSkRkW3T7iOdowYowj"
domain="www.chatbase.co"
defer>
</script>
*/ ?>
