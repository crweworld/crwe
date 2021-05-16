(function ($) {
    "use strict";

    // SKYCONS WEATHER
    var icons = new Skycons({"color": "#adadad"});

    icons.set("clear-day", Skycons.CLEAR_DAY);
    icons.set("clear-night", Skycons.CLEAR_NIGHT);
    icons.set("partly-cloudy-day", Skycons.PARTLY_CLOUDY_DAY);
    icons.set("partly-cloudy-night", Skycons.PARTLY_CLOUDY_NIGHT);
    icons.set("cloudy", Skycons.CLOUDY);
    icons.set("rain", Skycons.RAIN);
    icons.set("sleet", Skycons.SLEET);
    icons.set("snow", Skycons.SNOW);
    icons.set("wind", Skycons.WIND);
    icons.set("fog", Skycons.FOG);
    icons.play();

    // EASY TICKER JQUERY
    var dd = $('.vticker').easyTicker({
        direction: 'up',
        easing: 'easeInOutBack',
        speed: 'slow',
        interval: 5000,
        height: 'auto',
        visible: 1,
        mousePause: 0,
        controls: {
            up: '.up',
            down: '.down',
            toggle: '.toggle',
            stopText: 'Stop !!!'
        }
    }).data('easyTicker');

})(jQuery);


