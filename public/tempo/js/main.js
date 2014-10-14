$(document).ready(function() {

    /* ======= jQuery Placeholder ======= */
    $('input, textarea').placeholder();    
    
    /* ======= jQuery FitVids - Responsive Video ======= */
    $(".video-container").fitVids();
    
    /* ======= FAQ accordion ======= */

    function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find('.panel-title a')
        .toggleClass('active')
        .find("i.fa")
        .toggleClass('fa-plus-square fa-minus-square');
    }
    $('.panel').on('hidden.bs.collapse', toggleIcon);
    $('.panel').on('shown.bs.collapse', toggleIcon);
    
    /* ======= Fixed header when scrolled ======= */
    
    //$(window).bind('scroll', function() {
    //     if ($(window).scrollTop() > 50) {
    //         $('#header').addClass('navbar-fixed-top');
    //     }
    //     else {
    //         $('#header').removeClass('navbar-fixed-top');
    //     }
    //});
    
    
    

});