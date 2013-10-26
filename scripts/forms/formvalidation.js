$(document).ready(function() {
    $('.field input').keyup(function() {

        var empty = false;
        $('.field input').each(function() {
            if ($(this).val().length == 0) {
                empty = true;
            }
        });

        if (empty) {
            $('.actions input').attr('disabled', 'disabled');
			$('.send').css('background-color', '#ccc');
        } else {
            $('.actions input').attr('disabled', false);
			$('.send').css({'background-color': '#21759b','color':'#ffffff'});
        }
    });
});