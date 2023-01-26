define('anim',
    [],
    function () {

        var scrubTl;
        var scrubNode;
        var scrubTable;
        var scrubRows;
        var matrixTl;
        var matrixNode;
        var premiumsTl;
        var targetedNode;

        var anim = {

          init:function(){
            scrubNode = $('.scrubImage');
            scrubTable = $('.dataTable');
            scrubRows = $('tr', scrubTable);
            targetedNode = $('.prospectsImg');

            _self.dataScrub();
            _self.matrix();
            _self.targeted();

          },

          handleScroll: function() {
              if(scrubNode.visible( true )) {
                  scrubTl.play();
              } else {
                  scrubTl.pause();
              }
          },

          dataScrub:function() {

            scrubTl = new TimelineMax({ repeat: -1, repeatDelay: 0.5, delay: 2 });

            var targetRows = [$(scrubRows[2]),$(scrubRows[4]), $(scrubRows[8])];
            var targetRows2 = [$(scrubRows[12]),$(scrubRows[15]), $(scrubRows[18])];

            scrubTl.staggerTo(targetRows, 1, {
              background: '#FFEDED',
              onStart: function(){
                this.target.addClass('remove');
              }
            }, 0.65, 0);

            scrubTl.to(scrubTable, 1, {
              yPercent: '-28'
            });

            scrubTl.staggerTo(targetRows2, 1, {
              background: '#FFEDED',
              onStart: function(){
                this.target.addClass('remove');
              }
            }, 0.65);

            scrubTl.to(scrubTable, 1, {
              yPercent: '-50',
              onComplete: function(){
                scrubRows.removeClass('remove');
              }
            });

            scrubTl.set(targetRows, {
                background: '#fff'
              });

            scrubTl.eventCallback('onComplete', function(){
              scrubRows.removeClass('remove');
            });

          },

          matrix:function() {
            var count = 0;
            var prems = $('.mockSidebar .premium');
            var next = $('.next');
            var dots = $('.dot');
            matrixTl = new TimelineMax({ repeat: 0, paused: false, onComplete: quoteComplete });
            premiumsTl = new TimelineMax({ paused: true });
            var timeline = matrixTl;
            var topInputs = $('.topInput');
            var hidden = $('.hidden');
            var mockControls = $('.mockControls');
            var mockItems = $('.mockItems');
            var success = $('.mockSuccess');
            var premiumNodes = $('.premium');
            var zipCodes = $('.zipCodes');
            var deductible = $('.deductible');
            var dwelling = $('.dwelling');
            var mockDwelling = $('.mockDwelling');
            var personalProperty = $('.personalProperty');
            var mockPersonalProperty = $('.mockPersonalProperty');
            var sepStructure = $('.sepStructure');
            var mockSepStructure = $('.mockSepStructure');
            var lossOfUse = $('.lossOfUse');
            var mockLossOfUse = $('.mockLossOfUse');
            var mockLiability = $('.mockLiability');

            var quotes = [];
            quotes[0] = ['1000','$125,000','$12,500','$93,750','Up to 12 months','$300,000'];
            quotes[1] = ['1,750','$218,750','$21,875','$164,063','Up to 12 months','$300,000'];
            quotes[2] = ['2,250','$281,250','$28,125','$210,938','Up to 12 months','$300,000'];
            quotes[3] = ['2,500','$312,500','$31,250','$234,375','Up to 12 months','$300,000'];
            quotes[4] = ['3,500','$437,500','$43,750','$328,125','Up to 12 months','$300,000'];
            quotes[5] = ['5,500','$687,500','$68,750','$515,625','Up to 12 months','$300,000'];
            quotes[6] = ['7,500','$937,500','$93,750','$703,125','Up to 12 months','$300,000'];
            quotes[7] = ['8,500','$1,062,500','$106,250','$796,875','Up to 12 months','$300,000'];



            var premiums = [];
            premiums[0] = ['$229.89','$347.83','$361.82','$376.99','$381.73','$389.94'];
            premiums[1] = ['$335.77','$540.81','$568.00','$594.63','$599.69','$613.77'];
            premiums[2] = ['$395.25','$644.10','$677.07','$712.68','$720.34','$737.75'];
            premiums[3] = ['$438.99','$716.53','$755.42','$798.15','$807.98','$830.73'];
            premiums[4] = ['$579.75','$963.47','$1,025.15','$1,098.25','$1,118.22','$1,151.83'];
            premiums[5] = ['$810.19','$1,317.77','$1,426.25','$1,558.35','$1,598.00','$1,648.93'];
            premiums[6] = ['$1,035.86','$1,669.60','$1,825.71','$2,018.16','$2,078.00','$2,146.29'];
            premiums[7] = ['$1,138.69','$1,825.53','$2,003.25','$2,222.14','$2,290.78','$2,366.85'];


            function typeIt(target, str) {
              timeline.to(target, 1, {typed:{to:str, stopOnCommon:true},
                onStart:function(){
                  TweenMax.set(target.next(), {visibility: 'visible'});
                },
                onComplete:function() {
                  TweenMax.set(target.next(), {visibility: 'hidden'});
                }
              });
            }

            function showIt(target) {
              timeline.to(target, 0.25, {visibility: 'visibile', opacity: 1});
            }

            function quoteComplete() {
              var trg = TweenMax.to(next, 0.35, {backgroundColor: '#50328A', color:'#fff', yoyo:true, repeat: 1, onComplete: revQuote});
            }

            function revQuote() {
              if(count >= premiums.length-1) {
                showSuccess();
                return;
              }

              var tl = premiumsTl;
              resetPremiums();
              tl.to(mockItems, 0.5, { x: -240, opacity: 0, onComplete: function(){
                setMockQuote();
                tl.fromTo(mockItems, 0.5, {x: "+=300", opacity: 0}, { x: 0, opacity: 1, onComplete: addPremiums });
                updateDots();
              } });

              tl.play();
              count++;
            }

            function setMockQuote() {
              $('.mockSquareFeet').html(quotes[count][0]);
              $('.mockDwelling').html(quotes[count][1]);
              $('.mockSepStructure').html(quotes[count][2]);
              $('.mockPersonalProperty').html(quotes[count][3]);
              $('.mockLossOfUse').html(quotes[count][4]);
              $('.mockLiability').html(quotes[count][5]);
            }


            function updateDots() {
              dots.removeClass('active');
              $(dots[count]).addClass('active');
            }

            function addPremiums() {
              prems.each(function(idx, elm){
                typeIt($(elm), premiums[count][idx]);
              });
            }

            function resetPremiums() {
              premiumNodes.html('');
            }

            function showSuccess() {
              mockControls.fadeOut();
              var twn = TweenMax.fromTo(success, 1,
                { visibility: 'hidden', scale: 0.5, opacity: 0 },
                { visibility: 'visible', scale: 1, opacity: 1, onComplete: reset }
              );

              twn.yoyo(true);
              twn.repeat(1);
              twn.repeatDelay(1);
            }

            function reset() {
              count = 0;
              topInputs.html(' ');
              resetPremiums();
              updateDots();
              setMockQuote();
              TweenMax.set(hidden, {opacity: 0 });
              mockControls.fadeIn();
              init();
            }


            function init() {
              var zip = agent['zip'] ? agent['zip'] : '12345';
              typeIt(zipCodes, zip);
              typeIt(deductible, '$1,000');
              typeIt(dwelling, '$125');
              showIt(mockDwelling);
              typeIt(sepStructure, '10%');
              showIt(mockSepStructure);
              typeIt(personalProperty, '75%');
              showIt(mockPersonalProperty);
              showIt(mockLossOfUse);
              showIt(mockLiability);
              addPremiums();
            }
            init();
          },

          // Targeted Prospects Animation
          targeted: function() {
            var rings = $('.ring', targetedNode);
            var homeNode = $('.home', targetedNode);
            var quote = $('.hqQuote', targetedNode);

            var tl = new TimelineMax({ repeat: -1 });
            var count = 2;

            var ringTl = TweenMax.staggerFromTo(rings, 1.25, {
              scale: 0.1,
              opacity: 1
            }, {
              scale: 1,
              opacity: 0
            }, 0.2);

            var homeTl = TweenMax.to(homeNode, 1, {
              opacity: 0.4,
              yoyo: true,
              repeat: -1
            });

            tl.add(ringTl, homeTl);

            tl.eventCallback('onRepeat',  function() {
              if(count > 7) {
                count = 1;
              }

              homeNode.removeClass();
              homeNode.addClass('home home'+count);
              var quoteTween = TweenMax.fromTo(quote, 1, {
                opacity: 0,
              },{
                opacity: 1
              });

              quoteTween.delay(0.75);
              quote.text('$'+_self.getRandomIntInclusive(400, 1326));
              count++;
              
            });
          },

          getRandomIntInclusive: function(min, max) {
              var num = Math.random() * (max - min + 1) + min;
              return num.toFixed(2);
          },
        }

        var _self = anim;
        return anim;
});