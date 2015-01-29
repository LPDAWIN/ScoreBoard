$(function(){
    maFuction();
    var score1 = $("#score1");
    var score2 = $("#score2");
     var countdown = $("#countdown"); 
    // var startTime = $("#startTime") ;
    function maFuction(){
        $.getJSON(match_id).success(function(data){
        score1.html(data.score1);
        score2.html(data.score2);

        //Recuperation de l'heure de départ, la duréee  et de la date
        var hp= data.heureDepart;
        var uneDate = new Date(); 
        var duree = data.duree ;


        //on converti la durée en seconde
        var secondsDuree = new Date(duree.timestamp*1000).getMinutes();

        secondsDuree = secondsDuree*60;


       // var dureeFinal= secondsDuree - laDuree   ;


        //var d = formatDuree(dureeFinal);
       // console.log("durée Final : " +d);
        // countdown.html(d);

        //timerMatch.currentTime = d;

});
         
  }
    var x = setInterval(maFuction, 5000);
});
