define('about', [],
    function () {
        var CountUp = require("countup.js");

        var about = {
            init: function () {
                var startAmt = 20000000;
                var end = $("#mailings")[0].innerText;
                //console.log(end);
                var numAnim = new CountUp($("#mailings")[0], startAmt, end);
                numAnim.start();
                //console.log(numAnim);
            },
        }
        var _self = about;
        return about;
    });