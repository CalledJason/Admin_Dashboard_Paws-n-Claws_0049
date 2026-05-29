$(document).ready(function() {
    const tarifDasar = {

        cat: {
            small: 40000,
            medium: 55000,
            large: 70000
        },
        dog: {
            small: 50000,
            medium: 75000,
            large: 100000
        }
    };

    function calculateTotal() {
        let petType = $('#petType').val();
        let petSize = $('#petSize').val();
        let packageBasePrice = parseInt($('input[name="packageRadio"]:checked').val()) || 0;

        if(!petType || !petSize || packageBasePrice ===0) {
            $('#warningMsg').removeClass('d-none');
            return;
        }

        $('#warningMsg').addClass('d-none');

        let sizeMultiplier = 1;
        if(petSize === 'medium') sizeMultiplier = 1.2;
        if(petSize === 'large') sizeMultiplier = 1.5;

        let typeBonus = (petType === 'dog') ? 15000 : 0;
        let grandTotal = (packageBasePrice * sizeMultiplier) + typeBonus;

        let formatRupiah = 'Rp' + grandTotal.toLocaleString('id-ID');

        $('#totalDisplay').text(formatRupiah).addClass('text-success').removeClass('text-muted');
    }

    $('#petType').on('change', function() {
        if ($(this).val() && $(this).val() !== "0") {
            $('#petSize').prop('disabled', false);
        } else {
            
            $('#petSize').prop('disabled', true).val(''); 
            $('input[name="packageRadio"]').prop('disabled', true).prop('checked', false);
        }
        calculateTotal();
    });

    $('#petSize').on('change', function() {
        if ($(this).val() && $(this).val() !== "0") {
            $('input[name="packageRadio"]').prop('disabled', false);
        } else {
            
            $('input[name="packageRadio"]').prop('disabled', true).prop('checked', false);
        }
        calculateTotal();
    });

    $('#petType, #petSize, input[name="packageRadio"]').on('change', function() {
        calculateTotal();
    });

    $('#btnReset').on('click', function() {
        
        $('#petType').val('');
        
        
        $('#petSize').val('').prop('disabled', true);
        
        
        $('input[name="packageRadio"]').prop('checked', false).prop('disabled', true);
        
        
        $('#totalDisplay').text('Rp 0').removeClass('text-success').addClass('text-muted');
        
        
        $('#warningMsg').removeClass('d-none');
    });

    const sections = $('section, header');

    $(window).on('scroll', function() {
            let current = '';

            if ($(window).scrollTop() > 50){
                $('.navbar').addClass('navbar-scrolled');
            } else {
                $('.navbar').removeClass('navbar-scrolled');
            }

            sections.each(function() {
                const sectionTop = $(this).offset().top - 150;

                if ($(window).scrollTop() >= sectionTop) {
                    current = $(this).attr('id');
                }
            });

            $('.navbar-nav .nav-link').removeClass('active');

            $('.navbar-nav .nav-link').each(function () {
            if ($(this).attr('href') === '#' + current) {
                $(this).addClass('active');
            }
        });
    });
});
