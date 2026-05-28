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

        if(!petType || !petSize || packageBasePrice ===0) {
            $('#warningMsg').removeClass('d-one');
            return;
        }

        $('#warningMsg').addClass('d-one');

        let sizeMultiplier = 1;
        if(petSize === 'medium') sizeMultiplier = 1.2;
        if(petSize === 'large') sizeMultiplier = 1.5;

        let typeBonus = (petType === 'dog') ? 15000 : 0;
        let grandTotal = (packageBasePrice * sizeMultiplier) + typeBonus;
    }


});

