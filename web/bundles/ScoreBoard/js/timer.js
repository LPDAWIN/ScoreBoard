# This file is auto-generated during the composer install
parameters:
    database_driver: pdo_mysql
    database_host: info-arie.iut.bx1
    database_port: null
    database_name: info_ftardieu
    database_user: ftardieu
    database_password: eAYAcmlq1XS7
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    locale: en
    secret: ThisTokenIsNotSoSecretChangeIt



$( function() {
	var timerMath = new (function() {

    var $countdown;
    var $form;
    var incrementTime = 70;
    var currentTime = 300000; // 5 minutes (in milliseconds)
    
    $(function() {

        // Setup the timer
        $countdown = $('#countdown');
        timerMath.Timer = $.timer(updateTimer, incrementTime, true);

        // Setup form
        $form = $('#example2form');
        $form.bind('submit', function() {
            timerMath.resetCountdown();
            return false;
        });

    });

    function updateTimer() {

        // Output timer position
        var timeString = formatTime(currentTime);
        $countdown.html(timeString);

        // If timer is complete, trigger alert
        if (currentTime == 0) {
            timerMath.Timer.stop();
            
            timerMath.resetCountdown();
            return;
        }

        // Increment timer position
        currentTime -= incrementTime;
        if (currentTime < 0) currentTime = 0;

    }

    this.resetCountdown = function() {

        // Get time from form
        var newTime = parseInt($form.find('input[type=text]').val()) * 1000;
        if (newTime > 0) {currentTime = newTime;}

        // Stop and reset timer
        timerMath.Timer.stop().once();

    };

});

