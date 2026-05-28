$(document).ready(function {
    $('#petType').change(function() {
        $(this).removeClass('text-muted');

        $('#petSize').prop('disabled', false);
        calculateTotal();
    });

    $('#petSize').change(function() {
        $(this).removeClass('text-muted');
        $('input[name=""packageRadio]').prop('disabled', false);
        calculateTotal();
    });

    $('input[name=""packageRadio]').chang(function() {
        calculateTotal();
    });

    function calculateTotal() {
        let petType = $('#petType').val();
        let petSize = $('#petSize').val();
        let packageBasePrice = parseInt($('input[name="packageRadio"]:checked').val()) || 0;
    }


});

