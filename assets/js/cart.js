const $ = require('jquery');

let $headerCart = $('#header-cart');
let $body = $('body');

$('.js-add-to-cart').on('click', function (event) {

    event.preventDefault();

    $.get(this.href, function (data) {
        $headerCart.html(data);

    });

});

$body.on('input', '.js-cart-count', function (event) {
    let $me = $(this);

    $.post(
        $me.data('href'),
        {'count': $me.val()}, updateCart);
    
});

$body.on('click', '.js-cart-delete', function (event) {
    event.preventDefault();

    if (confirm('Вы действительно хотите удалить товар из корзины?')) {
        $.post(this.href, updateCart);
    }

});

function updateCart(data) {
    $('#cartTable').html(data);
    let amount = $('#orderAmount').html();
    $headerCart.html(amount);
}