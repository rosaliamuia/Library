$(document).ready(function() {
	
	$('.assignbook').click(function(e){
			e.preventDefault();
       $.get('create',function(data){
			$('#assignbook').modal('show')
		 		.find('#assignbookContent')
		 		.html(data);
        });
	});
	
	
    $('.addauthor').click(function(e){
			e.preventDefault();
	       $.get('addauthor',function(data){
				$('#addauthor').modal('show')
			 		.find('#addauthorContent')
			 		.html(data);
        });
	});

	$('.returnbook').click(function(e){
			e.preventDefault();
			var id = $(this).attr("val");
	       $.get('returnbook?id='+id,function(data){
				$('#returnbook').modal('show')
			 		.find('#returnbookContent')
			 		.html(data);
        });
	});

	$('.borrowbook').click(function(e){
			e.preventDefault();
			var id = $(this).attr("val");
	       $.get('borrowbook?id='+id,function(data){
				$('#borrowbook').modal('show')
			 		.find('#borrowbookContent')
			 		.html(data);
        });

	});

	$('.approvebook').click(function(e){
			e.preventDefault();
			var id = $(this).attr("val");
	       $.get('approvebook?id='+id,function(data){
				$('#approvebook').modal('show')
			 		.find('#approvebookContent')
			 		.html(data);
        });

	});


});

