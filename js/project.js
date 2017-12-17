$(document).ready(function () {
      
      // dropdown parent on mouseover
      $(".dropdown-menu").hover(
            function() {
                  $(this).parent().css("background-color", "#FFCC00");
            },
            function() {
                  $(this).parent().css("background-color", "#fff");
            }
      );
});