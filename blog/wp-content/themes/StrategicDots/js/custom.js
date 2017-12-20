/* OWL CAROUSEL */
$(document).ready(function() {
    /* signup remove on click */
    $("div#signup").show();
    $("#signup .remove-btn").click(function(){
        $("#signup").remove();
    });

    /* nav dropdown */
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(250);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(250);
    });
    // make parent dropdown clickable
    $('.navbar .dropdown > a').click(function(){
        location.href = this.href;
    });

    /* image modal on click */
    $('img').on('click', function () {
        var image = $(this).attr('src');
        $('#imgModal').on('show.bs.modal', function () {
            $(".showimage").attr("src", image);
        });
    });

    /* OWL CAROUSEL */
    var owl = $("#owl-demo");
    owl.owlCarousel({
        items : 3, //3 items above 1000px browser width
        itemsDesktop : [1200,3], //3 items between 1000px and 901px
        itemsDesktopSmall : [991,2], // betweem 900px and 601px
        itemsTablet: [600,1], //1 items between 600 and 0
        itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
    });
    // Custom Navigation Events
    $(".next").click(function(){
        owl.trigger('owl.next');
    })
    $(".prev").click(function(){
        owl.trigger('owl.prev');
    })
    $(".play").click(function(){
        owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
    })
    $(".stop").click(function(){
        owl.trigger('owl.stop');
    })

    /* thumbs to main image */
    $('#thumbs img').click(function(e){
        e.preventDefault();
        $('#main-image').attr('src',$(this).attr('src'));
    });

    /* Lightbox by Lokesh Dakhar */
/*
    lightbox.option({
        'maxWidth': 500,
        'maxHeight': true
    })*/
});

