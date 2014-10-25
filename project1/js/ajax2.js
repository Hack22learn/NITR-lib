

function pgclick(pgno,check)
	{
			
			if(check==true)
			{	$.ajax({ 
			url: 'browse.php',
			data: {"pgno": pgno},
			type: 'post',
			success: function(html)
			{
				$('#wholeresult').html(html);
			}
			});}
			else
			{
				$.ajax({ 
			url: 'browse.php',
			data: {"pgno": pgno},
			type: 'post',
			success: function(html)
			{
				$('.modal-box').html(html);
			}
			});}
		
	}
function pgclickgo(pgs,check)
	{
		pgno=parseInt($("#pggo").val());
			if((1<=pgno)&& (pgno <=pgs))
			{	
			if(check==true)
			{	$.ajax({ 
			url: 'browse.php',
			data: {"pgno": pgno},
			type: 'post',
			success: function(html)
			{
				$('#wholeresult').html(html);
			}
			});}
			else
			{
				$.ajax({ 
			url: 'browse.php',
			data: {"pgno": pgno},
			type: 'post',
			success: function(html)
			{
				$('.modal-box').html(html);
			}
			});
			}
			}
			else
			$("#error").slideDown(1000).delay(3000).slideUp(1000);
		
	}
$(document).ready(function()
{
	$('.pgbtn').click(function(){
	var pgno = parseInt($(this).attr("id").replace(/[^0-9]+/g,''));
	pgclick(pgno,false);
	});
	$('.titlebtn').click(function()
	{     	var scat = $(this).attr("id") ;
			$.ajax({
			url: 'browsebytitle.php',
			data:{"Category":"Title" , "SubCategory":scat},
			type: 'post',
			success: function(html)
			{
				
				$('#wholeresult').html(html);
				$('.pgbtn').onClick = function(){
				pgclick();
				}
			}
			});
	});
});