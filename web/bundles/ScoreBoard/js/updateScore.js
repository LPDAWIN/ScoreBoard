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
        var hp = data.heureDepart;
        var uneDate = new Date(); 
        var duree = data.duree ;
        var secondsDuree = duree*60;
        var laDuree = data.elapsed;
        var dureeFinal= secondsDuree - laDuree;
        var d = formatDuree(dureeFinal);
        console.log("dureeElapsed: " + laDuree);
        console.log("durée Final : " + d);
      //  var cd = countdown.text();

       /* if(cd != d)
        {
            console.log("cd != d");
           
            countdown.html(d);
            cd = countdown.text();
            console.log("countdown :" + cd);
          //  timerMatch.Timer.set(timerMatch.time,d,true);
            timerMatch.Timer.stop().once();
        }*/
        


});
         
  }
    var x = setInterval(maFuction, 5000);
});
