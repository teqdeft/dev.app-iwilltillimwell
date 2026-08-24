<script src="{{ asset('assets/js/mobile/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/mobile/custom.js') }}"></script>
<script>
    const toggleBtn = document.querySelector('.toggle-btn');
    if(toggleBtn){
        const navMenu = document.querySelector('.nav-menu');

        toggleBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            toggleBtn.classList.toggle('open');
        });
    }
</script>
<style>
    .faq-pay-detail .cust-container .collapse { display: none;}
    .faq-pay-detail .faq-link-main .cust-container h3 { padding: 0px 6px 12px 0px; font-size: 14px;}
</style>
<script>
$(document).on('click', '.faq-pay-detail #faq-list ul li', function() {
    let heading = $(this).find('.span-lag').text();
    let childContent = $(this).find('.card-body').html();
    $("#faq-ans ul li a").html(heading);
    $("#faq-ans .faq-link-main p").html(childContent);
    $('#faq-list').animate({
                marginLeft: '-100%'
            },100, function() {
                $("#faq-list").hide(); 
    });
    
    $('#faq-ans').animate({
                marginLeft: '0%'
            },200, function() {
                $("#faq-ans").show(); 
        });
    });
    function back_faq_list() {
        $('#faq-ans').animate({
                marginLeft: '1000%' 
            },200, function() {
                $("#faq-ans").hide(); 
        });
        $('#faq-list').animate({
                marginLeft: '0%' 
            },100, function() {
                $("#faq-list").show();
        });
    }
    </script>