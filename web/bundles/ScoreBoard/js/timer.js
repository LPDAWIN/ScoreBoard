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

function formatDuree(time) {
    var min = parseInt(time / 60),
        sec = parseInt(time ) - (min * 60),
        hundredths = pad(time - (sec ) - (min * 60), 2);
    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
}



$(function(){
     maFuction();
    var score1 = $("#score1");
    var score2 = $("#score2");
     var countdown = $("#countdown"); 
     var startTime = $("#startTime") ;
    function maFuction(){
          $.getJSON(match_url).success(function(data){
            score1.html(data.score1);
            score2.html(data.score2);

            //Recuperation de l'heure de départ, la duréee  et de la date
            var hp= data.heureDepart;
            var uneDate = new Date(); 
            var duree = data.duree ;
            var incrementTime = 100;

            //Transformation de la date en heurs / minutes / seconds
            var heures = uneDate.getHours();
            var minutes = uneDate.getMinutes();
            var secondes = uneDate.getSeconds();
            //Convertion en secondes
            var now = heures*3600 + minutes*60 +secondes;

            //On converti l'heure de départ en seconds
            var a = hp.split(':');

            var seconds = (+a[0]) * 3600 + (+a[1]) * 60 + (+a[2]); 
            
            //On calcul l'heure actuel - l'heure de départ
            var laDuree = (now - seconds);

            //on converti la durée en seconde
            var b = duree.split(':');
            var secondsDuree =(+b[0]) * 3600 + (+b[1]) * 60 + (+b[2]); 
            startTime.html(b[1]);

            var dureeFinal= secondsDuree - laDuree   ;

            //   var dureeFinal = dureeFinal *60;
            
           var d = formatDuree(dureeFinal);
              console.log("durée Final : " +d);
              countdown.html(d);
              
            timerMatch.currentTime = d;
              console.log(timerMatch.currentTime);
              timerMatch.updateTimer;
            //  timerMatch.Timer.toggle();
            
              timerMatch.Timer.go();
              timerMatch.Timer.play();
     
});
         
  }
    var x = setInterval(maFuction, 5000);
});
