jQuery(function(){

	// var match_url =$('match_url')
	// Routing.generate(match_url.html());
	
	// Récupération variable
	var score1 = $("#score1");
	var score2 = $("#score2");
	var add1 = $("#more1");
	var add2 = $("#more2");
	var less1 = $("#less1");
	var less2 = $("#less2");

	$("i").click(function(){
		var btn = $(this).attr('id');
		$.post('http://localhost:8888/www/Scoreboard/web/app_dev.php/match/2', {'btn':btn}, function(data, textStatus) {

		}, "json");
	})


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


});
