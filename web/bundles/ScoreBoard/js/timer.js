var timerMatch = new (function() {
    var $countdown,
        $form,
        incrementTime = 100,
        currentTime = null,
        updateTimer = function() {
            $countdown.html(formatTime(currentTime));
           
            if (currentTime == 0) {
                timerMatch.Timer.stop();
                timerComplete();
                timerMatch.resetCountdown();
                return;
            }
            currentTime -= incrementTime / 10;
            if (currentTime < 0) currentTime = 0;
        },
        timerComplete = function() {
           
        },
        init = function() {
            $countdown = $('#countdown');
            timerMatch.Timer = $.timer(updateTimer, incrementTime, true);
            timerMatch.Timer.stop();
            $form = $('#timerform');
            $form.bind('submit', function() {
                timerMatch.resetCountdown();
                return false;
            });
        };
    this.resetCountdown = function() {
        var newTime = parseInt($form.find('input[type=text]').val()) * 6000;
        if (newTime > 0) {currentTime = newTime;}
        this.Timer.stop().once();
    };
    $(init);
});


function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {str = '0' + str;}
    return str;
}

function formatTime(time) {
    var min = parseInt(time / 6000),
        sec = parseInt(time / 100) - (min * 60),
        hundredths = pad(time - (sec * 100) - (min * 6000), 2);
    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
}
