jQuery(function($){
    wp.customize("logo_color_set", function(value) {
        value.bind(function(newval) {
            $(".navbar-brand").css('color',newval);
        } );
    });
    wp.customize("header_menu_color_set", function(value) {
        value.bind(function(newval) {
            $(".top-menu").css('background', newval);
            $(".top-menu > li > a:before").css('border-left-color', newval);
        } );
    });
    wp.customize("carousel_color_set", function(value) {
        value.bind(function(newval) {
            $("svg .svg-bg").css('fill', newval);
            $(".carousel-indicators > li.active > span").css('color', newval);
        } );
    });
    wp.customize("button_color_set", function(value) {
        value.bind(function(newval) {
            $(".btn-yellow").css('background', newval);
            $(".article-head > a:hover").css('color', newval);
        } );
    });
    wp.customize("most_popular_color_set", function(value) {
        value.bind(function(newval) {
            $(".block-most-popular li:hover").css('background', newval);
        } );
    });
    wp.customize("categories_color_set", function(value) {
        value.bind(function(newval) {
            $(".block-categories li:hover, .num-cat").css('background', newval);
        } );
    });
    wp.customize("galleries_head_color_set", function(value) {
        value.bind(function(newval) {
            $(".blog-gallery-post > h4").css('background', newval);
        } );
    });
    wp.customize("contacts_color_set", function(value) {
        value.bind(function(newval) {
            $(".our-info-contact > address").css('background', newval);
        } );
    });
});