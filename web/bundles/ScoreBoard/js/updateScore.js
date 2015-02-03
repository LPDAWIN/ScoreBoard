var game_state = {
    time_left: 0
};

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
    // var startTime = $("#startTime") ;
    function maFuction(){
        $.getJSON(match_id).success(function(data){
            game_state = data;
            score1.html(data.score1);
            score2.html(data.score2);
            game_state.time_left = data.timeLeft;
    });
         
  }
    setInterval(maFuction, 5000);
    maFuction();

    function decrement()
    {
        if (game_state.etat == 1) 
        {
            game_state.time_left -= 1;
        }

        countdown.text(formatDuree(game_state.time_left*60));
    }
    setInterval(decrement, 1000);

});
