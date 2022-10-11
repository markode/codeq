(function($) {


  $(document).ready(function() {
    $( '.button__container button' ).click( function() {
      let pageID = $( '.persons__list' ).attr('pageid');
      console.log(pageID);
      console.log(rest_url.ajax,);
      $.ajax({
        type: 'post',
        url: rest_url.ajax,
        data: {
        action: 'persons_list',
        pageID: pageID,
        },
        error: function(response) {
        console.log('error');
        },
        success: function(response) {
        $("#ajax_persons").html(response);
        },
        complete: function(data) {
        $(".button__container").slideToggle();
        }
      });
    } )
    // Animate wow + animate.css
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 300, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        scrollContainer: null // optional scroll container selector, otherwise use window
    });
    wow.init();

    // End document.ready
  });
})(jQuery);
