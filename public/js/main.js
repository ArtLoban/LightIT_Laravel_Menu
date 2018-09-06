/* Add Items to the Cart */

$(document).ready(function() {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });

    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});



/*  AJAX Add-to-Cart request  */
$(function() {
    $('form.dish-order').submit(function (event) {
        var url = $(this).attr('action');
        var dishId = $(this).find('.dishId').val();
        var dishQuantity = $(this).find('.dish-quantity').val();

        // console.log(dishId);
        // console.log(dishQuantity);

        event.preventDefault();

        $.ajax({
            url: url,
            type: 'POST',
            // dataType: 'html',
            data: {dishId: dishId, dishQuantity: dishQuantity},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .done(function (data) {
            console.log(data);
            console.log([dishId, dishQuantity]);
        })
        .fail(function () {
            console.log("error");
        })
    })
});




/* CART */

$(document).ready(function() {

    /* Get initial total price */
    recalculateCart();

    /* Set rates + misc */
    var fadeTime = 50;

    /* Assign actions */
    $('.product-quantity input').change( function() {
        updateQuantity(this);
    });

    $('.product-removal button').click( function(event) {
        event.preventDefault();
        removeItem(this);

        var item = $(this).siblings('input.dishId').val();
        var url = $(this).parent().attr('action');
        removeItemFromSession(item, url);
    });


    /* Recalculate cart */
    function recalculateCart()
    {
        var total = 0;

        /* Sum up row totals */
        $('.product').each(function () {
            total += parseFloat($(this).children('.product-line-price').text());
        });
        $('#cart-total').fadeOut(fadeTime, function() {
            $(this).html(total);
            $(this).fadeIn(fadeTime);
        });
        // $('#cart-total').html(subtotal);

    }


    /* Update quantity */
    function updateQuantity(quantityInput)
    {
        /* Calculate line price */
        var productRow = $(quantityInput).closest('.product');
        console.log(productRow);
        var price = parseFloat(productRow.children('.product-price').text());
        console.log(price);
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;

        /* Update line price display and recalc cart totals */
        productRow.children('.product-line-price').each(function () {
            $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice.toFixed(1));
                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        });
    }





    /* Remove item from cart */
    function removeItem(removeButton)
    {
        /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).parent().parent().parent();
        productRow.remove();
        recalculateCart();
    }


    /* Remove item from session */
    function removeItemFromSession(item, url) {
        // console.log(item + '. Hello!');

        $.ajax({
            url: url,
            type: 'DELETE',
            // dataType: 'html',
            data: {dishId: item},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .done(function (data) {
            console.log(data);
            console.log('Deleted');
        })
        .fail(function () {
            console.log("Failed");
        })
    }

});