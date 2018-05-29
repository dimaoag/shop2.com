//cart
$('body').on('click', '.add-to-cart', function (event) {
    event.preventDefault();
    let id = $(this).data('id'),
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
            alert("Error!!! Try again later.")
        }
    });
});

function showCart(cart){
    console.log(cart);
}


//change current currency
$('#currency').change(function () {
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