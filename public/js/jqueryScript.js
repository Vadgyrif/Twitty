$(document).ready(function () {

    console.log('Hello jquery');
    

    const maxChars = 300;
    const $textarea = $('#twittTextarea');
    const $counter = $('#charCounter');

    $textarea.on('input', function () {
        const remainingChars = maxChars - $(this).val().length;
        $counter.text(remainingChars);

        if(remainingChars < 0){
            $counter.css('color', 'red');
            $('#submit-btn').prop('disabled', true);
        } else {
            $counter.css('color', '');
            $('#submit-btn').prop('disabled', false);
        }
    }); 


    $('.twitt__textarea').on('keydown', function (event) {
        if(event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            if(!$('#submit-btn').prop('disabled')){
                $(this).closest('form').submit();
            }
        }  
    });

    

});