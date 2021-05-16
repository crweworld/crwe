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

    // Get Current Date
    var objToday = new Date(),
        weekday = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'),
        dayOfWeek = weekday[objToday.getDay()],
        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
        curMonth = months[objToday.getMonth()],
        curYear = objToday.getFullYear();
    var today = dayOfWeek + ", " + curMonth + " " + objToday.getDate() + ", " + curYear;

    $('.date').html(today);

})(jQuery);


