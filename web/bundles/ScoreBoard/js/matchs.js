jQuery(function(){

	
	// Récupération variable
	var score1 = $("#score1");
	var score2 = $("#score2");
	//alert(score1.html());
	var i = 0;
	var j = 0;
	score1.html(i);
	score2.html(j);
	var add1 = $("#more1");
	var add2 = $("#more2");
	var less1 = $("#less1");
	var less2 = $("#less2");

	$("i").click(function(){
		var btn = $(this).attr('id');
		$.post('http://localhost:8888/www/Scoreboard/web/app_dev.php/match/2', {'btn':btn}, function(data, textStatus) {

		}, "json");


	})

	$(add2).click(function(){
		var btn = $(this).attr('id');
			$.post('http://localhost:8888/www/Scoreboard/web/app_dev.php/match/2', {'btn':btn}, function(data, textStatus) {

		}, "json");


	})

	$(less1).click(function(){
		var btn = $(this).attr('id');
			$.post('http://localhost:8888/www/Scoreboard/web/app_dev.php/match/2', {'btn':btn}, function(data, textStatus) {

		}, "json");


	})

	$(less2).click(function(){
		var btn = $(this).attr('id');
			$.post('http://localhost:8888/www/Scoreboard/web/app_dev.php/match/2', {'btn':btn}, function(data, textStatus) {

		}, "json");


	})



	/*Ajoute Score 1 : + 1
	add1.click(function(){
		
		i += 1;
		score1.html(i);

	});

	//Ajoute Score 2 : + 1
	add2.click(function(){
		j+= 1;	
		score2.html(j);
	});

	//Enleve Score 1 : - 1
	less1.click(function(){
		if(i > 0){
		i -= 1;
		score1.html(i);
		}

	});

	//Enleve Score 2 : - 1
	less2.click(function(){
		if(j > 0){
		j -= 1;
		score2.html(j);
		}

	});*/


});
