//Mobile Menu

let SERVERURL = document.location.origin;

jQuery(document).ready(function ($) {

    

    $('#almuerzo').fadeIn("slow");
    $('#registros').DataTable();
    var navigation = $('#navigation'),
        main = navigation.find('ul.menu');
    $('.nav-trigger').on('click', function () {
        $(this).toggleClass('open');
        main.off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend').toggleClass('is-visible');
    });
});

// DataTables Bulma
$(document).ready(function () {


    var table = $('#example').removeAttr('width').DataTable({
        // scrollY: "300px",
        // columnDefs: [{
        //     width: 6200,
        //     targets: 0
        // }],
        "language": {
            "url": "./src/es_es.json"
        },
        "order": [
            [
                0, "desc"
            ]
        ],
        searching: false,
        pagin: false,
        "pagingType": "simple",
        lengthChange: false,
        // responsive: true,
        scrollCollapse: true,
        scroller: true,
        // deferRender: true,
        fixedColumns: true,
    });

});