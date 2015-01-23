$(function(){

	function maFuction(){
          $.ajax({
            method:'get',
            url:'http://localhost:8080/web/app_dev.php/match',
            success:function(data){
              $(".ajax").html($(data).find(".ajax").html());
            }
          });
	}
	var x = setInterval(maFuction, 1000);




});



