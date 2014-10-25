function spgclick(pgno)
	{
			
			$.ajax({ 
			url: 'searchquery.php',
			data: {"pgno": pgno},
			type: 'post',
			success: function(html)
			{
				$('#searchresults').html(html);
			}
			});
		
	}
function spgclickgo(pgs)
	{
			
			pgno=parseInt($("#spggo").val());
			if((1<=pgno)&& (pgno <=pgs))
			{
			$.ajax({ 
			url: 'searchquery.php',
			data: {"pgno": pgno},
			type: 'post',
			success: function(html)
			{
				$('#searchresults').html(html);
			}
			});
			}
			else 
			$("#error").slideDown(1000).delay(3000).slideUp(1000);
                                
		
	}

