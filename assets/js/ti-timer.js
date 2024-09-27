jQuery('document').ready(function ($) {
    /* COUNTDOWN TIMER */
    const timerExpiry = $('.tefl_countdown_timer_value').val();

    if (timerExpiry != 'null') {
        const countDownDate = new Date(timerExpiry).getTime();

        let dayContainer = $('.digit.day .base');
        let hourContainer = $('.digit.hour .base');
        let minuteContainer = $('.digit.minute .base');
        let secondContainer = $('.digit.second .base');
        // Update the count down every 1 second
        const x = setInterval(function () {

            // Get todays date and time
            const now = new Date().getTime();

            // Find the distance between now and the count down date
            const distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance > 0) {

                function setTime(flip) {
                    updateGroup('day', days, flip);
                    updateGroup('hour', hours, flip);
                    updateGroup('min', minutes, flip);
                    updateGroup('sec', seconds, flip);
                }
                setTime(true);
            }
        }, 1000);
    }

    function flipTo(digit, n) {
        var current = digit.attr('data-num');
        digit.attr('data-num', n);
        setTimeout(function () {
            digit.find('.base').text(n);
        }, 350);
    }

    function jumpTo(digit, n) {
        digit.attr('data-num', n);
        digit.find('.base').text(n);
    }

    function updateGroup(group, n, flip) {
        var digit1 = $('.ten' + group);
        var digit2 = $('.' + group);
        n = String(n);
        if (n.length == 1) n = '0' + n;
        var num1 = n.substr(0, 1);
        var num2 = n.substr(1, 1);
        if (digit1.attr('data-num') != num1) {
            if (flip) flipTo(digit1, num1);
            else jumpTo(digit1, num1);
        }
        if (digit2.attr('data-num') != num2) {
            if (flip) flipTo(digit2, num2);
            else jumpTo(digit2, num2);
        }
    }
    /* /COUNTDOWN TIMER */
});