$(function () {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    $('div>input[name="datetimes"]').daterangepicker({
        timePicker: true,
        minDate: new Date(),
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(48, 'hour'),
        locale: {
            format: 'DD-MM-YYYY'
        },
    });
    $('.hide-show').show();
    $('.hide-show span').addClass('show');
    $('.hide-show span').click(function () {
        if ($(this).hasClass('show')) {
            $(this).text('Hide');
            $('.password').attr('type', 'text');
            $(this).removeClass('show');
        } else {
            $(this).text('Show');
            $('.password').attr('type', 'password');
            $(this).addClass('show');
        }
    });
    $('form button[type="submit"]').on('click', function () {
        $('.hide-show span').text('Show').addClass('show');
        $('.password').attr('type', 'password');
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    var new_rooms_left = document.querySelectorAll('.new_rooms_div > div.card:first-child, .new_rooms_div > div.card:nth-child(2)');
    var new_rooms_right = document.querySelectorAll('.new_rooms_div > div.card:nth-child(3) , .new_rooms_div > div.card:nth-child(4)');
    var rooms_left = document.querySelectorAll('.room_row:nth-child(even)');
    var rooms_right = document.querySelectorAll('.room_row:nth-child(odd)');
    anime({
        targets: [new_rooms_left, rooms_left],
        easing: 'easeInOutSine',
        direction: 'alternate',
        translateX: -window.outerWidth/3,
        duration: 1000
    });
    anime({
        targets: [new_rooms_right, rooms_right],
        easing: 'easeInOutSine',
        direction: 'alternate',
        translateX: +window.outerWidth/3,
        duration: 1000
    });

    setTimeout(function(){
        $('.new_rooms_div > div.card, .room_row:nth-child(odd), .room_row:nth-child(even)').fadeIn(1500);
    },1000);
});