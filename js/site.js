require('script!./vendor/vanilla-form/js/vanilla-form.min.js');
require('script!./vendor/gsapTyped.js');
require('script!./vendor/scrollstop.js');
require('script!./vendor/jquery.visible.min.js');
var CountUp = require("countup.js");

var oil = {};

$(document).ready(function() {

	//Defer
	var imgDefer = document.getElementsByTagName('img');
	for (var i = 0; i < imgDefer.length; i++) {
		if (imgDefer[i].getAttribute('data-src')) {
			imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
		}
	}

	if ($('body.home').length) {
		oil.scroll = require('./scroll.js');
		oil.pricing = require('./pricing.js');
		oil.anim = require('./anim.js');
		oil.quotes = require('./quotes.js');
		oil.gallery = require('./gallery.js');
		oil.header = require('./header.js');

		oil.scroll.init();
		oil.pricing.init();
		oil.anim.init();
		oil.quotes.init();
		oil.gallery.init();
		oil.header.init();
		if (agent) {
			oil.header.initAgent(agent);
		}

		$('[data-fancybox]').fancybox({
			scrolling: 'no', // changes CSS property "overflow" for the "fancybox-inner" element
			iframe: {
				attr: {
					scrolling: "no"
				}
			},
			arrows: false,
			infobar: false
		});
	}

	var myForm = new VanillaForm(document.querySelector("form.vanilla-form"));
	myForm.responseTimeout = 45000;

	var menuIcon = $('.menuIcon');
	var menuNode = $('.nav');
	var menuItems = $('.nav .menuItem');

	menuIcon.on('click', function() {
		menuIcon.addClass('nav-open');
		menuNode.addClass('nav-open');
	});

	menuItems.on('click', function() {
		menuIcon.removeClass('nav-open');
		menuNode.removeClass('nav-open');
	});
});
