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

//clear cart
function clearCart(){
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function(data){
            showCart(data);
        },
        error: function () {
            alert("Error!!! Try again later.");
        }
    });

    // delete default events
    // return false;
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

// search
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();
$('#typeahead').typeahead({
    highlight: true // подсветка вводимого
},{
    name: 'products',
    display: 'title', // return id and title showing only title, id as key
    limit: 9, // 1+ more than items from database;
    source: products
});

// event after clicking founded product
$('#typeahead').bind('typeahead:select', function (ev, suggestion) {
    //console.log(suggestion);
    window.location = path + '/search/?s=' + encodeURIComponent(suggestion.title);
});


// filters
$('body').on('change', '.w_sidebar input', function () {
   var checked = $('.w_sidebar input:checked'),
       data = '';
   checked.each(function () {
       data += this.value + ',';
   });
   if (data){
       $.ajax({
           url: location.href,
           data: {
               filter: data
           },
           type: 'GET',
           beforeSend: function(){
               $('.preloader').show();
               $('.product-one').hide();
           },
           success: function(res){
               $('.preloader').delay(500).fadeOut('slow', function () {
                   $('.product-one').html(res).fadeIn(); //show products
                   var url = location.search.replace(/filter(.+?)(&|$)/g, ''); //delete in url: /filter=1,2,5;
                   var newUrl = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                   newUrl = newUrl.replace('&&', '&');
                   newUrl = newUrl.replace('?&', '?');
                   history.pushState({}, '', newUrl);
               });
           },
           error: function () {
               alert("Error!!! Try again later.");
           }
       });
   } else {
       window.location = location.pathname;
   }


   // console.log(data);
});
