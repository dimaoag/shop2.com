//cart
//add products to cart
$('body').on('click', '.add-to-cart', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        mod = $('.available select').val();

    $.ajax({
        url: '/cart/add',
        data: {
            id: id,
            qty: qty,
            mod: mod
        },
        type: 'GET',
        success: function(data){
            showCart(data);
        },
        error: function () {
            alert("Error!!! Try again later.");
        }
    });
});

//delete products from cart
$('#cart .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {
            id: id
        },
        type: 'GET',
        success: function(data){
            showCart(data);
        },
        error: function () {
            alert("Error!!! Try again later.");
        }
    });
});


//show cart in modal-body
function showCart(cart){
    if ($.trim(cart) == '<h3>Cart is empty!</h3>'){
        $('#checkout, #clearCart').hide();
    } else {
        $('#checkout, #clearCart').show();
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if ($('.cart-sum').text()){
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    } else {
        $('.simpleCart_total').text('Empty Cart');
    }
}

//get cart on click for header icon cart
function getCart(){
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function(data){
            showCart(data);
        },
        error: function () {
            alert("Error!!! Try again later.");
        }
    });
}


//change current currency
$('#currency').change(function (e) {
    e.preventDefault();
    window.location = '/currency/change/?curr=' + $(this).val();
});

//modification product's price by color
$('.available select').on('change', function () {
    var modId = $(this).val(),
        color = $(this).find('option').filter(':selected').data('title'),
        price = $(this).find('option').filter(':selected').data('price');
        basePrice = $('#base-price').data('base');

    if (price){
        $('#base-price span').text(price);
    } else {
        $('#base-price span').text(basePrice);

    }
});