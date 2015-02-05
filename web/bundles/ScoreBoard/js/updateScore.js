var game_state = {
    time_left: 0
};
var txte ;
function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {str = '0' + str;}
    return str;
}

function formatDuree(time) {
    var min = parseInt(time / 60),
        sec = parseInt(time ) - (min * 60),
        hundredths = pad(time - (sec ) - (min * 60), 2);
    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2);
}

$(function(){
    maFuction();
    var score1 = $("#score1");
    var score2 = $("#score2");
    var countdown = $("#countdown"); 
    var timelineli = $("#timelineli");
    // var startTime = $("#startTime") ;
    function maFuction(){
        $.getJSON(match_id).success(function(data){
            game_state = data;
            score1.html(data.score1);
            score2.html(data.score2);

            Events = data.event
          
            $(".scrollbar > ul").empty();
            Events.forEach(function(entry) {
              $("#timelineUl") .append("<li>" + entry + "</li>")
            }); 
           
            if(data.timeLeft >0){

                game_state.time_left = data.timeLeft;
            }
            else{
                game_state.time_left = 0 ;
                var btn = "temps";
                 $.post(Routing.generate('match_ScoreBoard',{id:match_id}), {'btn':btn}, function(data, textStatus) {

                }, "json");
    
            }
        
    });
         
  }
    setInterval(maFuction, 3000);
    maFuction();

    function decrement()
    {
        if (game_state.etat == 1 && game_state.time_left >0) 
        {
            game_state.time_left -= 1;
        }

    var txt = formatDuree(game_state.time_left); 
   
    countdown.text(txt);
    }
 

    setInterval(decrement, 1000);
    

});
