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
                console.error(error);
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
            // Update the UI or notify the user that the game has ended
            alert(response.message); // Or update a DOM element with the message
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
