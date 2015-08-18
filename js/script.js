$(document).ready(function () {
    var _csrf = $('input[name=_csrf]').val();
    var category_id = $('input[name=category_id]').val();
    $('.fileupload').fileupload({
        url: '?plugin=logocategory&action=saveimage',
        dataType: 'json',
        done: function (e, data) {
            $(this).parent().find('.slide-result').html('');
            $('.loading').remove();
            if (data.result.status == 'ok') {
                $("#preview").html('<img src="' + data.result.data.preview + '" />');
                $("#deleteButton").show();
                $("#response").text('Изображение загружено');
            } else {
                $("#response").text(data.result.errors[0][0]);
            }
        },
        fail: function (e, data) {
            $('.loading').remove();
            $("#response").text(data.result.errors[0][0]);
        },
        start: function (e, data) {
            $(this).parent().append('<span class="loading"><i class="icon16 loading"></i>Loading...</span>');
        },
    });

    $('#deleteButton').click(function () {
        $.ajax({
            url: "?plugin=logocategory&action=deleteimage",
            dataType: 'json',
            type: 'POST',
            data: {_csrf: _csrf, category_id: category_id}
        }).done(function (response) {
            $("#preview").html('');
            $("#response").text(response.data.message);
            $("#deleteButton").hide();
        });
    });
    $('.dialog-buttons-gradient .button').click(function(){
        $('.fileupload').remove();
    });
});
