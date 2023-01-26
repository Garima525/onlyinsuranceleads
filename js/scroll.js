define('scroll',
    [],
    function () {
        var headerVideo;

        var scroll = {

	 		init:function(){
               $(window).on("scrollstart", _self.handleScroll);
               $(window).on("scrollstop", _self.handleScroll);
               $('.mainMenu .scroller').on('click', _self.handleNavClick);
               $('.logoContainer').on('click', function(){
                    _self.scrollTo('#ourService');
               });

               $('#becomeCustomers .button').on('click', _self.handleNavClick);

               headerVideo = document.getElementById('bg-video');
	 		},

            // Add a scroll class to the body when the user scrolls
            handleScroll:function(){
                var scrollTop = $(window).scrollTop();

                if(scrollTop > 0) {
                    $('body').addClass('scrolled');
                } else {
                    $('body').removeClass('scrolled');
                }

                if($(headerVideo).visible( true )) {
                    headerVideo.play();
                } else {
                    headerVideo.pause();
                }
            },

            // Smoothscroll on nav click
            handleNavClick: function(evt) {
                evt.preventDefault();
                var href = evt.target.getAttribute('href');
                var id = href.split('#')[1];
                var target = $('#'+id);
                _self.scrollTo(target);
            },

            scrollTo: function(elm) {
                TweenLite.to(window, 1.5, {scrollTo:{y:$(elm).offset().top-80}, ease:Power2.easeOut});
            }
        }
        var _self = scroll;
        return scroll;
});