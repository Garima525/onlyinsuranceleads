define('quotes',
    [],
    function () {
        var quotes;
        var quoteContainer;
        var tl;

        var testimonials = {

          init:function(){

            quoteContainer = $('.quoteContainer');
            quotes = $('.quoteBlock', quoteContainer);
            var minHeight = quotes.first().height();
            quoteContainer.css('minHeight', minHeight);
            tl = new TimelineMax({ paused: true, delay: 0, repeat: -1, repeatDelay: 0 });

            tl.staggerFromTo($('.quoteBlock'), 1, {
                opacity: 0,
            },{
                opacity: 1,
                yoyo: true,
                repeat: 1,
                repeatDelay: 7
            }, 9);

            tl.play();

          },
        }

        var _self = testimonials;
        return testimonials;
});