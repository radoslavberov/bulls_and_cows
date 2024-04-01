$(document).ready(function () {
    $('#guess-form').submit(function (event) {
        event.preventDefault();

        let guess = $('#guess').val();
        let url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                guess: guess
            },
            success: function (response) {
                let resultContent = `Guess: ${guess} - Bulls: ${response.result.bulls}, Cows: ${response.result.cows}`;
                $('#guess-results').append(`<div class='alert alert-info'>${resultContent}</div>`);
                $('#attempts-count').text(response.attempts);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) { // Validation failed
                    let errors = xhr.responseJSON.errors;
                    if (errors.guess) {
                        // Assuming you have a <div> to show the guess errors
                        $('#guess-errors').html(errors.guess[0]).show();
                    }
                }
            }
        });
    });
});

$('#give-up-form').submit(function(event) {
    event.preventDefault();

    let url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
