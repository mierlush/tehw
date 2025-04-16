$(document).ready(function () {
    $('#login-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    window.location.href = 'index.php';
                } else {
                    $('#error-message').text(response.message).fadeIn();
                }
            },
            error: function () {
                $('#error-message').text('Eroare de server. Încearcă din nou.').fadeIn();
            }
        });
    });
});

