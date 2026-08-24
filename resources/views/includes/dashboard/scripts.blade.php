<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>

<script type="text/javascript" src="{{ url('assets/js/jquery.validate.min.js') }}"></script>



<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script src="{{ asset('assets/assets/vendors/js/vendor.bundle.base.js') }}"></script>

<script src="{{ asset('assets/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>

<script src="{{ asset('assets/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

<script src="{{ asset('assets/assets/js/off-canvas.js') }}"></script>

<script src="{{ asset('assets/assets/js/hoverable-collapse.js') }}"></script>

<script src="{{ asset('assets/assets/js/template.js') }}"></script>

<script src="{{ asset('assets/assets/js/file-upload.js') }}"></script>



<!-- common files -->

<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/additional-methods.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/validation-2.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js">

</script>



@php

    $action = request('action');

    $path = request()->path();

@endphp



@if($action === 'urgentcare' && Str::contains($path, 'step-6'))

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/datepickers.js') }}"></script>

@elseif (!request()->is('schedule-consultation/*'))

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/datepickers.js') }}"></script> 

@endif	







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!--<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>-->

<script type="text/javascript" src="{{ asset('assets/js/datatable.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"

    integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="

    crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ asset('timepicker/mdtimepicker.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery.nestable.js') }}"></script>

<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>



<?php /*

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">

 function googleTranslateElementInit() {

    new google.translate.TranslateElement({

      pageLanguage: 'en',

      includedLanguages: 'en,es',

      autoDisplay: false

    }, 'google_translate_element');

  }



  document.addEventListener("DOMContentLoaded", function () {

    const customSelect = document.getElementById("customTranslate");

    customSelect.addEventListener("change", function () {

      const lang = this.value;

      const googleSelect = document.querySelector("select.goog-te-combo");

      if (googleSelect) {

        googleSelect.value = lang;

        googleSelect.dispatchEvent(new Event("change"));

      }

    });

  });

</script>

*/?>



<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">

 function googleTranslateElementInit() {

    new google.translate.TranslateElement({

      pageLanguage: 'en',

      includedLanguages: 'en,es',

      autoDisplay: false

    }, 'google_translate_element');

  }



  document.addEventListener("DOMContentLoaded", function () {

    const customSelect = document.getElementById("customTranslate");
    if(customSelect) {
            customSelect.addEventListener("change", function () {

            const lang = this.value;

            const googleSelect = document.querySelector("select.goog-te-combo");

            if (googleSelect) {

                googleSelect.value = lang;

                googleSelect.dispatchEvent(new Event("change"));

            }

            });
    }
  });

</script>







<script>

const dropdownItems = langDropdown.querySelectorAll(".dropdown-v1 li");

document.addEventListener("DOMContentLoaded", function () {

  const langDropdown = document.getElementById("langDropdown");

  const selectedLang = document.getElementById("selectedLang");

  



  // Load saved language from localStorage

  const savedLang = localStorage.getItem("selectedLang");

  if (savedLang) {

    const savedItem = [...dropdownItems].find(li => li.getAttribute("data-lang") === savedLang);

    if (savedItem) {

      selectedLang.innerHTML = savedItem.innerHTML;

      selectedLang.setAttribute("data-lang", savedLang);



      // Apply Google Translate on load

      const select = document.querySelector(".goog-te-combo");

      if (select) {

        select.value = savedLang;

        select.dispatchEvent(new Event("change"));

      }

    }

  }



  // Toggle dropdown

  selectedLang.addEventListener("click", () => {

    langDropdown.classList.toggle("open");

  });



  // Select language

  dropdownItems.forEach(item => {

    item.addEventListener("click", () => {

      const lang = item.getAttribute("data-lang");



      selectedLang.innerHTML = item.innerHTML;

      selectedLang.setAttribute("data-lang", lang);

      langDropdown.classList.remove("open");



      // Save language to localStorage

      localStorage.setItem("selectedLang", lang);



      // Trigger Google Translate

      const select = document.querySelector(".goog-te-combo");

      if (select) {

        select.value = lang;

        select.dispatchEvent(new Event("change"));

      }

    });

  });





document.addEventListener("click", (e) => {

    if (!langDropdown.contains(e.target)) {

      langDropdown.classList.remove("open");

    }

  });

});



const savedLang = localStorage.getItem("selectedLang");

if (savedLang) {

  const savedItem = [...dropdownItems].find(li => li.getAttribute("data-lang") === savedLang);

  if (savedItem) {

    selectedLang.innerHTML = savedItem.innerHTML;

    selectedLang.setAttribute("data-lang", savedLang);



    // Wait until Google Translate select is ready

    const interval = setInterval(() => {

      const select = document.querySelector(".goog-te-combo");

      if (select) {

        select.value = savedLang;

        select.dispatchEvent(new Event("change"));

        clearInterval(interval);

      }

    }, 500);

  }

}

$(document).ready(function () {
        $('.menu li').each(function () {
            if ($(this).find('ul li.active').length > 0) {
                $(this).addClass('active-item');
            }
        });
});
</script>







<script>

@if(Session::has('success'))

    toastr.success("{{ session('success') }}")

@php Session::forget('success') @endphp

@elseif(Session::has('error'))

    toastr.error("{{ session('error') }}")

    @php Session::forget('error') @endphp

@elseif(Session::has('warning'))

    toastr.warning("{{ session('warning') }}")

    @php Session::forget('warning') @endphp

@elseif(Session::has('info'))

    toastr.info("{{ session('info') }}")

    @php Session::forget('info') @endphp

@endif



</script>



<script>

$(function() {

    

});



new SlimSelect({

    select: '#slim-select'

});



new SlimSelect({

    select: '#slim-emotional-wellness'

});



new SlimSelect({

    select: '#slim-medical-care'

});



new SlimSelect({

    select: '#slim-tele-pet-now'

});





function show1() {

    x = document.getElementsByClassName('main-medication-refill-box');

    x[0].style.display = 'block';

}



function show2() {

    x = document.getElementsByClassName('main-medication-refill-box')

    x[0].style.display = 'none';

}



function show3() {

    x = document.getElementsByClassName('date-time-range-box');

    x[0].style.display = 'block';

}



function show4() {

    x = document.getElementsByClassName('date-time-range-box')

    x[0].style.display = 'none';

}



let addbutton = document.getElementById("addbutton");

if( addbutton ){

    addbutton.addEventListener("click", function() {

        let boxes = document.getElementById("boxes");

        let clone = boxes.firstElementChild.cloneNode(true);

        boxes.appendChild(clone);

    });

}





function generate_year_range(start, end) {

    var years = "";

    for (var year = start; year <= end; year++) {

        years += "<option value='" + year + "'>" + year + "</option>";

    }

    return years;

}



today = new Date();

currentMonth = today.getMonth();

currentYear = today.getFullYear();

selectYear = document.getElementById("year");

selectMonth = document.getElementById("month");





createYear = generate_year_range(1970, 2050);

/** or

 * createYear = generate_year_range( 1970, currentYear );

 */



document.getElementById("year").innerHTML = createYear;



var calendar = document.getElementById("calendar");

var lang = calendar.getAttribute('data-lang');



var months = "";

var days = "";



var monthDefault = ["January", "February", "March", "April", "May", "June", "July", "August", "September",

    "October", "November", "December"

];



var dayDefault = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];



months = monthDefault;

days = dayDefault;



var $dataHead = "<tr>";

for (dhead in days) {

    $dataHead += "<th data-days='" + days[dhead] + "'>" + days[dhead] + "</th>";

}

$dataHead += "</tr>";



//alert($dataHead);

document.getElementById("thead-month").innerHTML = $dataHead;





monthAndYear = document.getElementById("monthAndYear");

showCalendar(currentMonth, currentYear);







function next() {

    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;

    currentMonth = (currentMonth + 1) % 12;

    showCalendar(currentMonth, currentYear);

}



function previous() {

    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;

    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;

    showCalendar(currentMonth, currentYear);

}



function jump() {

    currentYear = parseInt(selectYear.value);

    currentMonth = parseInt(selectMonth.value);

    showCalendar(currentMonth, currentYear);

}



function showCalendar(month, year) {



    var firstDay = (new Date(year, month)).getDay() - 1;



    tbl = document.getElementById("calendar-body");





    tbl.innerHTML = "";





    monthAndYear.innerHTML = months[month] + " " + year;

    selectYear.value = year;

    selectMonth.value = month;



    // creating all cells

    var date = 1;

    for (var i = 0; i < 6; i++) {



        var row = document.createElement("tr");





        for (var j = 0; j < 7; j++) {

            if (i === 0 && j < firstDay) {

                cell = document.createElement("td");

                cellText = document.createTextNode("");

                cell.appendChild(cellText);

                row.appendChild(cell);

            } else if (date > daysInMonth(month, year)) {

                break;

            } else {

                cell = document.createElement("td");

                cell.setAttribute("data-date", date);

                cell.setAttribute("data-month", month + 1);

                cell.setAttribute("data-year", year);

                cell.setAttribute("data-month_name", months[month]);

                cell.className = "date-picker";

                cell.innerHTML = "<span>" + date + "</span>";



                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {

                    cell.className = "date-picker selected";

                }

                row.appendChild(cell);

                date++;

            }





        }



        tbl.appendChild(row);

    }



}



function daysInMonth(iMonth, iYear) {

    return 32 - new Date(iYear, iMonth, 32).getDate();

}



$(document).ready(function() {

    $('.js-example-basic-single').select2();

});



$(document).on('change', '.moduleName', function() {

    var getClassName = $(this).attr('id');

    if ($(this).is(":checked")) {

        $(`.${getClassName}`).prop('checked', true);

    } else {

        $(`.${getClassName}`).prop('checked', false);

    }

})



$(document).on('change', '#selectAllPermission', function() {

    if ($(this).is(":checked")) {

        $(`.moduleName`).prop('checked', true);

        $(`.child-permission`).prop('checked', true);

    } else {

        $(`.moduleName`).prop('checked', false);

        $(`.child-permission`).prop('checked', false);

    }

})











@if ( checkProfileComplete() )

<script>

    $(document).ready(function() {

        $("#congrats-modal").modal('show');



    });

</script>

@endif



</script>



@if ( !checkProfileComplete() && checkHealthRecordStart() )



<script>

    $(document).ready(function() {

        $("#personal-record-modal").modal('show');

    });

    </script>

@endif



<script>

window.embeddedChatbotConfig = {

chatbotId: "S1JGSkRkW3T7iOdowYowj",

domain: "www.chatbase.co"

}

</script>

<script

src="https://www.chatbase.co/embed.min.js"

chatbotId="S1JGSkRkW3T7iOdowYowj"

domain="www.chatbase.co"

defer>

</script>





