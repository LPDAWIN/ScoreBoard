jQuery(function(){
	var score1 = $("#score1");
	var score2 = $("#score2");
	var add1 = $("#more1");
	var add2 = $("#more2");
	var less1 = $("#less1");
	var $form = $('#timerform');
	var less2 = $("#less2");
	var countdown = $("#countdown"); 
	var teamNumber = $("#teamNumber");
	var endGame = $("#end");

	$("i").click(function(){
		var btn = $(this).attr('id');
		$.post(Routing.generate('match_ScoreBoard',{id:match_id}), {'btn':btn,'timeLeft':game_state.time_left}, function(data, textStatus) {
			
		}, "json");
	})


	$("input[type=button]").click(function(){
		var btn = $(this).attr('id');
		var duree = $form.find('input[type=text]').val();
		$.post(Routing.generate('match_ScoreBoard',{id:match_id}), {'btn':btn, 'duree':duree,'timeLeft':game_state.time_left}, function(data, textStatus) {
				
		}, "json");
	});


	//Ajoute Score 1 : + 1
	add1.click(function(){
		var i = parseInt(score1.html());
		i += 1;
		score1.html(i);

	});

	//Ajoute Score 2 : + 1
	add2.click(function(){
		var j = parseInt(score2.html());
		j+= 1;	
		score2.html(j);
	});

	//Enleve Score 1 : - 1
	less1.click(function(){
		var i = parseInt(score1.html());
		i -= 1;
		score1.html(i);
	});

	//Enleve Score 2 : - 1
	less2.click(function(){
		var j = parseInt(score2.html());
		j -= 1;
		score2.html(j);
	});





setTimeout(function() {}, 10);

	



});
