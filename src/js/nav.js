let SERVERURL = document.location.origin;
localStorage.setItem('serverurl', SERVERURL);


$(document).ready(function ($) {
    $('#almuerzo').fadeIn("slow");
    $('#registros').DataTable();
    var navigation = $('#navigation'),
        main = navigation.find('ul.menu');
    $('.nav-trigger').on('click', function () {
        $(this).toggleClass('open');
        main.off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend').toggleClass('is-visible');
    });
});

