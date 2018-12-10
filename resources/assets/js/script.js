$( document ).ready(function() {
	$('#comment').submit(function(e) {
		e.preventDefault(); 
		var $form = $(this);
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function (html) {
				$("#list_error").remove();
				if (html.success) {
					$('#comments_list').prepend(html.html_comment);
					$('#comment')[0].reset();
				}
				else if(html.error){
					$('#error_comment').prepend(html.html_error);
				}
			},
			error: function (data) {
				console.log('fail comment');
			}
		});
	});
});