var timerMatch = new (function() {
    var $countdown,
        $form,
        incrementTime = 100,
        currentTime = 0,
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
        var countdown = $("#countdown"); 
        if($form.find('input[type=text]').val() > 1)
        {
            alert('connard');
            var newTime = parseInt($form.find('input[type=text]').val()) * 6000;
        }
        else
        {
            alert('allo');
            console.log(countdown.text());
             var newTime = countdown.text() ;

        }

        if (newTime > 0) 
        {
            currentTime = newTime;
            var duree=currentTime/6000;
            var btn="initi";
            $.post(Routing.generate('match_ScoreBoard',{id:match_id}), {'btn':btn,'duree':duree}, function(data, textStatus) {
               
               
             }, "json");
        }
      
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

function formatDuree(time) {
    var min = parseInt(time / 60),
        sec = parseInt(time ) - (min * 60),
        hundredths = pad(time - (sec ) - (min * 60), 2);
    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
}