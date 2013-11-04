$(document).ready(function() {
			var button = $('#uploadButton'), interval;
            var _csrf = $('input[name=_csrf]').val();
            var category_id = $('input[name=category_id]').val();
			$.ajax_upload(button, {
						action : '?plugin=logocategory&action=saveimage',
						name : 'logocategory',
                        data : { _csrf : _csrf,category_id : category_id},
						onComplete : function(file, response) {
                            var response = $.parseJSON(response);
                            if(response.status=='ok') {
                                $("#response").text(file);
                                $("#preview").html('<img src="'+response.data.preview+'" />');
                                $("#deleteButton").show();
                            } else if(response.status=='fail'){
                                $("#response").text(response.errors[0][0]);
                            }
                            
						}
					});
                    
            $('#deleteButton').click(function(){
                var _csrf = $('input[name=_csrf]').val();
                var category_id = $('input[name=category_id]').val();
                $.ajax({
                    url: "?plugin=logocategory&action=deleteimage",
                    dataType: 'json',
                    type: 'POST',
                    data:{_csrf:_csrf,category_id:category_id}
                }).done(function(response) {
                    
                    $("#preview").html('');
                    $("#response").text(response.data.message);
                    $("#deleteButton").hide();
                });
            });    
            
		});
