$(function(){
     maFuction();
    var score1 = $("#score1");
    var score2 = $("#score2");
     var countdown = $("#countdown"); 
    // var startTime = $("#startTime") ;
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
        var aMin = new Date(hp.timestamp*1000).getMinutes();
        var aHeure = new Date(hp.timestamp*1000).getHours();
        var aSec = new Date(hp.timestamp*1000).getSeconds();
        var seconds =  aHeure * 3600 + aMin*60 + aSec ;

        //On calcul l'heure actuel - l'heure de départ
        var laDuree = (now - seconds);

        //on converti la durée en seconde
        var secondsDuree = new Date(duree.timestamp*1000).getMinutes();

        secondsDuree = secondsDuree*60;


        var dureeFinal= secondsDuree - laDuree   ;


        var d = formatDuree(dureeFinal);
        console.log("durée Final : " +d);
        // countdown.html(d);

        //timerMatch.currentTime = d;

});
         
  }
    var x = setInterval(maFuction, 5000);
});
