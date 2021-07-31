$('#equipos').on('change', function(){
    var equipo_id = $(this).val();

	// AJAX
	$.get('/api/equipo/'+equipo_id+'/inventario', function (data) {
        var html_select = '';
		for (var i=0; i<data.length; ++i)
		html_select += '<option value="'+data[i].noInventario+'">'+ data[i].noInventario +'</option>';
		$('#inventarios').html(html_select);
        $('#inventarios').selectpicker('refresh');
	});
    
});