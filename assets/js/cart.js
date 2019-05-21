const $ = require('jquery');

$('.js-add-to-cart').on('click', function (event) {
    let headerCart = $('#header-cart');

    event.preventDefault();

    $.get(this.href, function (data) {
        headerCart.html(data);

    });

});

$('body').on('input', '.js-cart-count', function (event) {
    let $me = $(this);

    $.post(
        $me.data('href'),
        {'count': $me.val()},
        function (data) {
            $('#cartTable').html(data);
        }
    );
    
});