$(function() {
	
	$('#departamento_id').on('change', onSelectProjectChange);
	

});

function onSelectProjectChange() {
	var dep_id = $(this).val();

	// AJAX
	$.get('/api/orden/'+dep_id+'/departamento', function (data) {
		var html_select = '';
		for (var i=0; i<data.length; ++i)
		html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
		$('#equipos').html(html_select);
        $('#equipos').selectpicker('refresh');
	});
    
}



