function con(id){
 
   r= confirm("ARE YOU SURE YOU WANT TO DELETE ");
	
 var p = parseInt(id);
 var s = "#".concat("r",id);
 if(r==true)
 { $.ajax({ 
			url: 'delete.php',
			data: {"del":p},
			type: 'post',
			success: function(html)
			{
				$(s).html(html);
			}
			});
	}
}