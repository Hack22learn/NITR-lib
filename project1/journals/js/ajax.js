$(document).ready(function()
{
	$("#Category").change(function()
	{
		document.getElementById("wholeresult").innerHTML = "";
		var cat=$(this).val();
        if(cat!="Title")
		{
				$('#SubCategory').show();
				$('#submit').show();
				$('#titleatoz').hide();
				$.ajax
				({
					type: "POST",
					url: "Ajax_SubCategory.php",
					data: {"cat":cat},
					cache: false,
					success: function(html)
									{
										$("#SubCategory").html(html);
									} 
				});
		}
		else
		{
			$('#SubCategory').hide();
			$('#submit').hide();
			$('#titleatoz').show();
		}
		
	});	
	
	
});	


  