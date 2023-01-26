// Color Printing = .73, .70, .67, .66, .63
// B&W = color printing - 0.06
// Filters = 0.04 each
// Enhanced Envelope = 0.04
// Amex/Visa = 0.02
//Discover/Amex = 0.07

define('pricing',
    [],
	function () {
		var data = {
			packages: {
				selected: 'grow',
				nodes: '',
				price: {
					connect: {
						bw: 0.67,
						color: 0.73,
						reach: 750,
						maxReach: 1249
					},
					grow: {
						bw: 0.64,
						color: 0.70,
						reach: 1250,
						maxReach: 4999
					},
					expand: {
						bw: 0.61,
						color: 0.67,
						reach: 5000,
						maxReach: 9999
					},
					expandPlus: {
						bw: 0.59,
						color: 0.65,
						reach: 10000,
						maxReach: 24999
					},
					enterprise: {
						bw: 0.57,
						color: 0.63,
						reach: 25000,
						maxReach: 50000
					}
				}
			},
			ink: {
				selected: 'color',
				nodes: ''
			},
			envelope: {
				selected: 'standard',
				nodes: '',
				preview: {
					standard: '',
					stamp: 'teaser'
				},
				price: {
					standard: 0,
					stamp: 0.04
				}
			},

			filters: {
				selected: '',
				nodes: '',
				price: 0.04
			},

			total: {
				nodes: '',
				reachNode: ''
			},

			roi: {
				closeRate: '',
				commission: '',
				selectedReach: ''
			},
			payment: {
				nodes: '',
				type: 'check',
				price: {
					check: 0,
					visa: 0.02,
					mastercard: 0.02,
					amex: 0.07,
					discover: 0.07
				}
			},
			preview: {
				envelope: '',
				letter: ''
			},

		};

		var pricing = {

			init: function () {
				// populate data set with dom nodes
				data.packages.nodes = $('.package');
				data.ink.nodes = $('.ink');
				data.envelope.nodes = $('.envelope');
				data.filters.nodes = $('.filters input');
				data.preview.envelope = $(document.getElementById('envelopePreview'));
				data.preview.letter = $(document.getElementById('letterPreview'));
				data.total.nodes = $(document.getElementById('total'));
				data.total.reachNode = $(document.getElementById('packageReach'));
				data.roi.closeRate = $(document.getElementById('roiCloseRate'));
				data.roi.commission = $(document.getElementById('commission'));
				data.roi.clientYears = $(document.getElementById('clientYears'));
				data.roi.investment = $(document.getElementById('investment'));
				data.roi.households = $(document.getElementById('households'));
				data.roi.roi = $(document.getElementById('roi'));
				data.payment.nodes = $('.paymentType');
				data.payment.type = 'check';

				$('.ink').prop('checked', true);

				// hook up events on the nodes
				data.packages.nodes.on('click', _self.handleClick);
				data.ink.nodes.on('click', _self.handleClick);
				data.envelope.nodes.on('click', _self.handleClick);
				data.filters.nodes.on('click', _self.handleFilterClick);
				data.payment.nodes.on('click', _self.handlePaymentClick);

				// Hook up change event to roi inputs
				$(".roiInput").change(_self.updatePrice);
				var rangeSlider = require("rangeslider-pure");
				$(".prospects").change(function (e) {
					if (e.originalEvent) {
						_self.handleManualReach();
					}
				});

				rangeSlider.create($('#slider'), {
					polyfill: true, // Boolean, if true, custom markup will be created
					rangeClass: 'rangeSlider',
					disabledClass: 'rangeSlider--disabled',
					fillClass: 'rangeSlider__fill',
					bufferClass: 'rangeSlider__buffer',
					handleClass: 'rangeSlider__handle',
					startEvent: ['mousedown', 'touchstart', 'pointerdown'],
					moveEvent: ['mousemove', 'touchmove', 'pointermove'],
					endEvent: ['mouseup', 'touchend', 'pointerup'],
					min: 750, // Number , 0
					max: 30000, // Number, 100
					step: 10, // Number, 1
					value: 1250, // Number, center of slider
					buffer: null, // Number, in percent, 0 by default
					stick: null, // [Number stickTo, Number stickRadius] : use it if handle should stick to stickTo-th value in stickRadius
					borderRadius: 10, // Number, if you use buffer + border-radius in css for looks good,
					onInit: function (position, value) {
						data.roi.selectedReach = 1250;
					},
					onSlideStart: function (position, value) {
						//console.info('onSlideStart', 'position: ' + position, 'value: ' + value);
					},
					onSlide: function (position, value) {
						//console.log('onSlide', 'position: ' + position, 'value: ' + value);
						data.roi.selectedReach = position;
						_self.checkSliderPackage(position);
						_self.updatePrice();
					},
					onSlideEnd: function (position, value) {
						//_self.updatePrice();
						// console.warn('onSlideEnd', 'position: ' + position, 'value: ' + value);
					}
				});


				// set price on page load
				_self.updatePrice();

				data.roi.commission.change(function () {
					var val = data.roi.commission.val();
					if (val.indexOf("$") == -1) {
						data.roi.commission.val("$" + val);
					}

					if (val.indexOf(".") == -1) {
						data.roi.commission.val("$" + val + ".00");
					}
				});
			},

			handleClick: function (evt) {
				// Get the target node from the click
				var node = $(evt.delegateTarget)[0];

				var isChecked = node.checked;

				// Get the type of node that was clicked (package, ink, envelope)
				var type = node.dataset.category;
				var saveVal = '';

				switch (type) {
				case 'ink':
					if (isChecked) {
						saveVal = 'color';
					} else {
						saveVal = 'bw';
					}
					break;

				case 'envelope':
					if (isChecked) {
						saveVal = 'stamp';
					} else {
						saveVal = 'standard';
					}
					break;

				case 'packages':
					saveVal = node.id;
					_self.selectPackage(node);
					data.roi.selectedReach = data.packages.price[data.packages.selected].reach;
				}

				// Save the appropriate data
				data[type].selected = saveVal;

				// Update the preview
				_self.updatePreviews();

				// Update Slider
				_self.updateSlider();

				// Run price update
				_self.updatePrice();

			},

			handlePaymentClick: function (evt) {
				data.payment.nodes.removeClass('selected');
				target = $(evt.target);
				target.addClass('selected');
				data.payment.type = target.data('payment');
				_self.updatePrice();
			},

			handleManualReach: function () {
				var val = $(".prospects").val();
				if (val <= 750) {
					val = '750';
					$(".prospects").val(val);
				}
				val = parseFloat(val.replace(/,/g, ''))
				data.roi.selectedReach = val;
				_self.checkSliderPackage(val);
				_self.updateSlider();
				_self.updatePrice();
			},

			selectPackage: function (packageNode) {
				$('.package').removeClass('selected');
				$(packageNode).addClass('selected');
				data['packages'].selected = $(packageNode)[0].id;
			},

			handleFilterClick: function (evt) {
				// Update the number of filters that have been clicked

				data.filters.selected = $('.filters input:checked').length;

				// Run price update
				_self.updatePrice();
			},

			updatePrice: function () {
				// Get the name of the selected package and ink
				var pkg = data.packages.selected;
				var ink = data.ink.selected;

				// Get the price of the selected package
				var pkgPrice = data.packages.price[pkg][ink];

				// Get the price of the selected envelope
				var env = data.envelope.price[data.envelope.selected];

				// Determine the price of the selected filters
				var filters = data.filters.selected;
				var filtersPrice = filters * data.filters.price;


				// Determine Payment price
				var paymentType = data.payment.type;
				var paymentPrice = data.payment.price[paymentType];

				// Total the prices and drop any digits after the the 2nd decimal place.
				var total = (pkgPrice + env + filtersPrice + paymentPrice);

				// The reach of the package
				//var reach = data.packages.price[data.packages.selected].reach;
				var reach = data.roi.selectedReach;
				var maxReach = data.packages.price[data.packages.selected].maxReach;

				// Set the page's total field to show the new total
				data.total.nodes.text('$' + total.toFixed(2));
				$(".prospects").val(data.roi.selectedReach.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ","));

				// ROI Calculations
				var closeRate = data.roi.closeRate.val();
				var commission = data.roi.commission.val().replace("$", "");
				var clientYears = data.roi.clientYears.val();
				var households = Math.round(data.roi.selectedReach * closeRate);
				var newtotal = $("#customprice").val();

				// var investment = data.roi.selectedReach * total;
				var investment = data.roi.selectedReach * newtotal;

				var roiTotal = households * commission * clientYears;

				data.roi.households.text(households);
				data.roi.investment.text('$' + investment.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
				data.roi.roi.text('$' + roiTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
			},

			updateSlider: function () {
				var attributes = {
					value: data.roi.selectedReach
				};

				data.roi.selectedReach = attributes.value;

				$('#slider')[0].rangeSlider.update(attributes);
			},

			checkSliderPackage: function (val) {
				var packages = data.packages.price;
				$.each(packages, function (key, keyVal) {
					var reach = keyVal.reach;
					var pkg = key;
					if (val >= reach) {
						_self.selectPackage($('#' + pkg));
					}


				});
			},

			updatePreviews: function () {
				var preview = data.envelope.selected;

				var isBw;
				if (data.ink.selected == 'color') {
					isBw = false;
				} else {
					isBw = true;
				}

				data.preview.letter.toggleClass('bw', isBw);
				var isTeaser = false
				if (data.envelope.selected == 'stamp') {
					isTeaser = true;
				}
				data.preview.envelope.toggleClass('teaser', isTeaser);

			}
		}

		var _self = pricing;

		return pricing;
	});
