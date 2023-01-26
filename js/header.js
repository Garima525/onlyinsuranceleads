define('header', [],
    function() {

        var tl;
        var machine;
        var cardTimelines = [];

        var cardIncrement = 275;
        var cardMoveDur = 2.5;
        var cardDelay = 2;
        var cardWidth = 245;
        var cards;
        var card1;
        var card2;
        var card3;
        var card4;
        var card5;
        var videoNode;



        var data = [];
        data[0] = {
            year: '1983',
            squareFeet: '1,288',
            dwelling: '$161,000',
            sepStructure: '$16,100',
            personalProperty: '$120,750',
            premium: '$457.98'
        }
        data[1] = {
            year: '1985',
            squareFeet: '1,990',
            dwelling: '$248,750',
            sepStructure: '$24,875',
            personalProperty: '$186,562',
            premium: '$624.25'
        }

        data[2] = {
            year: '1982',
            squareFeet: '2,184',
            dwelling: '$273,000',
            sepStructure: '$27,300',
            personalProperty: '$204,750',
            premium: '$692.99'
        }


        data[3] = {
            year: '1995',
            squareFeet: '2,654',
            dwelling: '$331,750',
            sepStructure: '$33,175',
            personalProperty: '$248,812',
            premium: '$820.66'
        }


        data[4] = {
            year: '1978',
            squareFeet: '2,812',
            dwelling: '$351,500',
            sepStructure: '$35,150',
            personalProperty: '$263,625',
            premium: '$902.18'
        }


        data[5] = {
            year: '1995',
            squareFeet: '3,338',
            dwelling: '$417,250',
            sepStructure: '$41,725',
            personalProperty: '$312,937',
            premium: '$1,015.54'
        }


        data[6] = {
            year: '2004',
            squareFeet: '3,634',
            dwelling: '$454,250',
            sepStructure: '$45,425',
            personalProperty: '$340,687',
            premium: '$1,000.17'
        }


        data[7] = {
            year: '1993',
            squareFeet: '4,056',
            dwelling: '$507,000',
            sepStructure: '$50,700',
            personalProperty: '$380,250',
            premium: '$1,199.31'
        }

        data[8] = {
            year: '2005',
            squareFeet: '4,393',
            dwelling: '$549,125',
            sepStructure: '$54,912',
            personalProperty: '$411,843',
            premium: '$1,121.67'
        }

        data[9] = {
            year: '1995',
            squareFeet: '6,747',
            dwelling: '$843,375',
            sepStructure: '$84,337',
            personalProperty: '$632,531',
            premium: '$1,760.18'
        }


        var lastNames = ['Black', 'Rusch', 'Broome', 'Reamer', 'Wheeler', 'Cannon', 'Shelton', 'Lehman', 'Mingo', 'White'];
        var firstNames = ['Jason', 'Gerald', 'David', 'Catherine', 'Jessica', 'Amanda', 'Judy', 'Allison', 'Elizabeth', 'Julie'];
        var addresses = ['Winifred Way', 'Geraldine Lane', 'Woodstock Drive', 'Bell Street', 'Carriage Lane', 'Maud Street', 'Vesta Drive', 'Felosa Drive', 'Meadow View Drive', 'Richland Avenue'];

        var header = {


            init: function() {
                cards = $('.card');
                card1 = $('.card1');
                card2 = $('.card2');
                card3 = $('.card3');
                card4 = $('.card4');
                card5 = $('.card5');

                var counter = 0;

                machine = $('.machineContainer');
                var machineHeight = machine.height();
                var headerHeight = $('.mainMenu').height();
                var pageTitle = $('.pageHeader .pageTitle');
                videoNode = $('#bg-video');


                tl = new TimelineMax({ repeat: 0, paused: false });

                cards.each(function(idx) {
                    _self.initCard(cards[idx], idx);
                });

                moveCards();



                function moveCards() {

                    var dur = cardMoveDur;


                    cards.each(function(idx, elm) {
                        var elms = cards.slice(0, idx + 1);

                        tl.add(TweenMax.to(elms, dur, {
                            x: "+=" + cardIncrement,
                            delay: cardDelay,
                            onStart: function() { cardTimelines[idx].play(); }
                        }));

                        tl.eventCallback("onComplete", function() {
                            cardLoop();
                        });
                    });

                    function cardLoop() {
                        counter++;
                        if (counter > cards.length) {
                            counter = 1;
                        }

                        var num = counter;
                        var target = $('.card' + num);
                        TweenMax.set(target, { x: 0 });
                        _self.resetCard(counter);
                        tl.add(TweenMax.to(cards, dur, {
                            x: "+=" + cardIncrement,
                            onComplete: function() {
                                cardLoop();
                            },
                            delay: cardDelay
                        }));
                    }
                }

                function updateHeaderHeight() {
                    //$('.pageHeader .pageTitle').css('height', videoNode.height() - $('.mainMenu').height());

                    var winHeight = $(window).height();
                    newHeight = winHeight - machineHeight - headerHeight;
                    pageTitle.css('height', newHeight);
                    videoNode.css('height', newHeight);

                }
            },

            initAgent: function(agent) {
                $('.agencyInfo').addClass(agent['company']);
                $('.agencyName').text(agent['name']);
                $('.agencyZip').text(agent['zip']);

                sendAgentNotice(agentData);

                function sendAgentNotice(agentData) {
                    $.post("utils/send-agent-notice.php", { agent: agentData, isDebug: isDebug });
                }
            },

            initCard: function(card, idx) {

                var elm = card;
                _self.updateCard(elm, idx);
                var tl = new TimelineMax({ paused: true, delay: cardMoveDur });

                var dimCard = _self.fader($('.mask', elm), 1);
                var fadeDetails = _self.fader($('.details', elm), 0);
                var fadeCalculating = _self.fader($('.calculating', elm), 1);

                var hideFront = new TweenMax.to($('.frontContainer', elm), 1, {
                    rotationY: 180,
                    opacity: 0
                });


                var showBack = new TweenMax.from($('.back', elm), 1, {
                    rotationY: -180,
                    opacity: 1
                });

                var hideCard = new TweenMax.to($('.back', elm), 1, {
                    opacity: 0
                });

                var showLetter = new TweenMax.from($('.printedLetter', elm), 1, {
                    clip: "rect(0 245px 245px 245px)",
                });

                tl.add([dimCard, fadeDetails, fadeCalculating], 0);
                tl.add([hideFront, showBack], "+=1");
                tl.add([hideCard, showLetter], "+=3.7");


                cardTimelines.push(tl);
            },

            resetCard: function(card) {
                card = cardTimelines[card - 1];
                _self.updateCard(card);
                card.delay(cardDelay + cardMoveDur);
                card.restart(true);
            },

            updateCard: function(card) {

                var cardData = data[_self.getRandomIntInclusive(0, 7)];
                var firstName = firstNames[_self.getRandomIntInclusive(0, firstNames.length - 1)];
                var lastName = lastNames[_self.getRandomIntInclusive(0, lastNames.length - 1)];
                var street = addresses[_self.getRandomIntInclusive(0, addresses.length - 1)];
                var address = _self.getRandomIntInclusive(100, 8999);
                //var city = "Anywhere, USA 12345";
                var city = cityName;

                // if (agent.city) {
                //     city = agent.city + ', ' + agent.state + ' ' + agent.zip;
                // }

                if (city) {
                    city = cityName + ', ' + stateName + ' ' + zipCode;
                }

                $('.details .name', card).text(firstName + ' ' + lastName);
                $('.details .address', card).text(address + ' ' + street);
                $('.details .location', card).text(city);
                $('.cardBuilt', card).text(cardData.year);
                $('.cardSquareFeet', card).text(cardData.squareFeet);
                $('.cardDwelling', card).text(cardData.dwelling);
                $('.cardSepStructure', card).text(cardData.sepStructure);
                $('.cardPersonalProperty', card).text(cardData.personalProperty);
                $('.cardPremium', card).text(cardData.premium);
            },

            getRandomIntInclusive: function(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            },


            fader: function(elm, endOpacity) {
                var tween = new TweenMax.to(elm, 0.65, {
                    opacity: endOpacity
                });

                return tween;
            },

            handleScroll: function() {
                if (machine.visible(true)) {
                    tl.resume();
                    cardTimelines.forEach(function(cardTl) {
                        if (cardTl.paused() && cardTl.progress()) {
                            cardTl.resume();
                        }
                    });

                } else {
                    tl.pause();
                    cardTimelines.forEach(function(cardTl) {
                        if (cardTl.progress()) {
                            cardTl.pause();
                        }
                    });
                }
            }

        }
        var _self = header;
        return header;
    });
