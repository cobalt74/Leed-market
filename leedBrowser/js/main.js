function readUnread(element,id, rootpath){
	
	
	if(!$(element).hasClass('eventRead')){
		$(element).addClass('eventRead').html('Marquer comme non lu');
		$.ajax({
					  url: rootpath+"action.php?action=readContent",
					  data:{id:id},
					  success:function(msg){
					  	if(msg!="") alert('Erreur de lecture : '+msg);
					  }
		});
	}else{
		$(element).removeClass('eventRead').html('Marquer comme lu');
				$.ajax({
					url: rootpath+"action.php?action=unreadContent",
					data:{id:id}
		});
			
	}
	
}


function favorize(element,id, rootpath){
	
	
	if(!$(element).hasClass('eventFavorite')){
		$(element).addClass('eventFavorite').html('Défavoriser');
		$.ajax({
					  url: rootpath+"action.php?action=addFavorite",
					  data:{id:id},
					  success:function(msg){
					  	if(msg!="") alert('Erreur de lecture : '+msg);
					  }
		});
	}else{
		$(element).removeClass('eventFavorite').html('Favoriser');
				$.ajax({
					url: rootpath+"action.php?action=removeFavorite",
					data:{id:id}
		});
			
	}
	
}