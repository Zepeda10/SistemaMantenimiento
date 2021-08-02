
$('#user_id').on('change', function(){
    var user_id = $(this).val();

	// AJAX
	$.get('/api/orden/'+user_id+'/usuario', function (data) {
		for (var i=0; i<data.length; ++i)
			$('#name').val(data[i].name+' '+data[i].ap_paterno+' '+data[i].ap_materno);
	});
    
});