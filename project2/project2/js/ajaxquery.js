  function show(input)
  {
    if(input == 1)
	{ 
	  $(".hiddenba").hide();
	  $(".shownba").show();
	  $(".hiddenta").show();
	}
	else if(input == 2)
	{
		$(".hiddenba").show();
	    $(".shownba").hide();
	    $(".hiddenta").hide();
	}
	else if(input == 3)
	{ 
	  $(".hiddenby").hide();
	  $(".shownby").show();
	  $(".hiddenty").show();
	}
	else if(input == 4)
	{
		$(".hiddenby").show();
	    $(".shownby").hide();
	    $(".hiddenty").hide();
	}
	else if(input == 5)
	{ 
	  $(".hiddenbd").hide();
	  $(".shownbd").show();
	  $(".hiddentd").show();
	}
	else if(input == 6)
	{
		$(".hiddenbd").show();
	    $(".shownbd").hide();
	    $(".hiddentd").hide();
	}
  }
  
 function submit_form(){
 var data = $("form").serialize(); 

                $.ajax({
                    url: "query.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
                        $("#result").html(data); 
                    }
                });
 }
  function  pgclick( pg ){
				 $.ajax({
                    url: "pgpost.php", 
                    type: "POST",
                    data: {"pgno":parseInt(pg)}, 
                    success: function(data){ 
                        $(".query").html(data); 
                    }
                });
  }
 function  pgclickgo(maxpg){
       var pg = parseInt($("#pggo").val());
	    if(pg>=1 && pg<= maxpg)
		{
				 $.ajax({
                    url: "pgpost.php", 
                    type: "POST",
                    data:{"pgno": pg}, 
                    success: function(data){ 
                        $(".query").html(data); 
                    }
                });
		}
		else $("#msg").slideDown(1000).delay(3000).slideUp(1000);
  }

   

$(document).ready(function() {
submit_form();
})