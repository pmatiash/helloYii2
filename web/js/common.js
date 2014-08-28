$('#itemsPerPage').on('change', function(){
    alert('go');

    var perPage = $(this).val();
    $.get('\\site\\darrowtest', {'per-page': perPage}, function(response) {
        $('#darrowtest').html(response);
    });
});