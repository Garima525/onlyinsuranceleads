define('gallery', [],
	function() {
		
		var gallery = {
			init: function() {
				previews = $('.letterSlide, .letterPreviewThumb');
				swiper = new Swiper('.swiper-container', {
					pagination: {
						el: '.swiper-pagination',
						type: 'bullets',
						clickable: true,
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					keyboard: {
						enabled: true,
						onlyInViewport: false,
					},
					effect: 'coverflow',
					grabCursor: true,
					centeredSlides: true,
					slidesPerView: 'auto',
					initialSlide: 1,
					coverflow: {
						rotate: 50,
						stretch: 0,
						depth: 100,
						modifier: 1,
						slideShadows: false,
					},
					simulateTouch: false,
					slideToClickedSlide: true,
					paginationClickable: true,
					preloadImages: true,
					on: {
						slideChange: function() {
							var idx = this.activeIndex;
							var preview = $('#letterPreview');
							$('.templateNumber').html(idx + 1);
							updatePreview(this.slides[this.activeIndex]);
						},
						resize: function() {
							this.updateSize();
						},
						init: function() {
							updatePreview(this.slides[this.activeIndex]);
						}
					}
				});

			}
		}

		function updatePreview(slide) {
			var iframe = $('iframe', slide);
			var src = $(iframe).attr('src');
			var name = $(iframe).data('prospect-firstname') + " " + $(iframe).data('prospect-lastname');
			var address = $(iframe).data('prospect-address');
			$('.addressWindow .name').text(name);
			$('.addressWindow .address').text(address);
			$('#letterPreview').attr('src', src);

		}

	
		$(".btn-switcher").click(function (e) {
			var type = $(this).attr('data-type');
			var repl = 'letter';
			if(type == repl) {
				repl = "postcard";
			}
			$('body').toggleClass('postcard');
			
			var iframes = $('iframe.mailingItem', swiper.$el);
			var toggles = $('a.mailingItem', swiper.$el)

			$.each(iframes, function(idx, el){
				$(el).attr('src', $(el).attr('src').replace(repl, type));
			});

			$.each(toggles, function(idx, el){
				$(el).data('src', $(el).data('src').replace(repl, type));
			});
			updatePreview(swiper.slides[swiper.activeIndex]);
			$(this).addClass("selected").siblings().removeClass("selected");
		});

		return gallery;
	});

$("#custom-pop-up-letter").on("click", function(){
	if(this).hasClass("selected"){
		$(.fancybox-content).addClass("letter-pop-up");
	}
});