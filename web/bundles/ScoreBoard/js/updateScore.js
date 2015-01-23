$(function(){
    var score1 = $("#score1");
    var score2 = $("#score2");  
	function maFuction(){
          $.getJSON(match_url).success(function(data){
            console.log(data);
            score1.html(data.score1);
            score2.html(data.score2);
            //$(".ajax").html($(data).find(".ajax").html());
          });
  }
	var x = setInterval(maFuction, 1000);




});



