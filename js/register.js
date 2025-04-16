$(function () {
    $('#register-form').on('submit', function (e) {
        e.preventDefault();

        $('#error-message').hide();

        $.ajax({
            url: 'register.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
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