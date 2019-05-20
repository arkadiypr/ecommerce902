const $ = require('jquery');

$('.js-add-to-cart').on('click', function (event) {
    let headerCart = $('#header-cart');

    event.preventDefault();

    $.get(this.href, function (data) {
        headerCart.html(data);

    });

});