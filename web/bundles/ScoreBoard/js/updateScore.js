$(function(){
     maFuction();
    var score1 = $("#score1");
    var score2 = $("#score2");
     var duree = $("#countdown");  
	function maFuction(){
          $.getJSON(match_url).success(function(data){
            score1.html(data.score1);
            score2.html(data.score2);
           // var hp= data.heureDepart;
           // var d = new Date(); 
           // d = d.getHours();
           // var dm = d - hp ;
           // duree.html(dm); 
           // alert(d);
            //duree.html(data.duree)
            //$(".ajax").html($(data).find(".ajax").html());
          });
  }
	var x = setInterval(maFuction, 5000);
});



