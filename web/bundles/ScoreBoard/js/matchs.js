jQuery(function(){

	// var match_url =$('match_url')
	
	//alert(Routing.generate('match_ScoreBoard',{id:match_id}));
	//alert(match_id); 

	// Récupération variable
	var score1 = $("#score1");
	var score2 = $("#score2");
	var add1 = $("#more1");
	var add2 = $("#more2");
	var less1 = $("#less1");
	var less2 = $("#less2");

	$("i").click(function(){
		var btn = $(this).attr('id');
<<<<<<< HEAD
		$.post(Routing.generate('match_ScoreBoard', {id: match_url}), {'btn':btn}, function(data, textStatus) {
=======
		$.post(Routing.generate('match_ScoreBoard',{id:match_id}), {'btn':btn}, function(data, textStatus) {
>>>>>>> d2b93b4d1f7d4f2a733e99f8d4d5905dfae888e0

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
