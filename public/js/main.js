/* Add Items to the Cart */

$(document).ready(function() {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        // return false;
    });

    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        // return false;
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


// /* Change Item quantity and update session */
//
// $(document).ready(function() {
//     $('.jq-minus').click(function () {
//         var $input = $(this).parent().find('input.quantity');
//         var count = parseInt($input.val()) - 1;
//         // count = count < 1 ? 1 : count;
//         $input.val(count);
//         $input.change();
//         // return false;
//
//         var dishId = $(this).siblings('input.dishId').val();
//         var url = $(this).parents('form').attr('action');
//         var dishQuantity = -1;
//
//         // console.log(url);
//         changeItemQuantityInSession(dishId, url, dishQuantity);
//     });
//
//     $('.jq-plus').click(function () {
//         var $input = $(this).parent().find('input.quantity');
//         $input.val(parseInt($input.val()) + 1);
//         $input.change();
//         // return false;
//         var dishId = $(this).siblings('input.dishId').val();
//         var url = $(this).parents('form').attr('action');
//         var dishQuantity = 1;
//         changeItemQuantityInSession(dishId, url, dishQuantity);
//     });
//
//
//     function changeItemQuantityInSession(dishId, url, dishQuantity) {
//         $.ajax({
//             url: url,
//             type: 'POST',
//             // dataType: 'html',
//             data: {dishId: dishId, dishQuantity: dishQuantity},
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         })
//         .done(function (data) {
//             console.log(data);
//             console.log([dishId, dishQuantity]);
//         })
//         .fail(function () {
//             console.log("error");
//         })
//     }
// });




/* CART */

$(document).ready(function() {

    /* Get initial total price */
    recalculateCart();

    /* Set rates + misc */
    var fadeTime = 50;

    /* Assign actions */
    $('.product-quantity input.quantity').change( function() {
        updateQuantity(this);
    });

    $('.product-removal button').click( function(event) {
        event.preventDefault();
        removeItem(this);

        var dishId = $(this).siblings('input.dishId').val();
        var url = $(this).parent().attr('action');
        removeItemFromSession(dishId, url);
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
        // console.log(productRow);
        var price = parseFloat(productRow.children('.product-price').text());
        // console.log(price);
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



    /* Change Item quantity and update session */

    $('.jq-minus').click(function () {
        var $input = $(this).parent().find('input.quantity');
        var count = parseInt($input.val()) - 1;
        var $dishId = $(this).siblings('input.dishId').val();
        var $url = $(this).parents('form').attr('action');
        var $urlDelete = $url + '/' + $dishId;
        var $dishQuantity = -1;

        if (count === 0) {
            removeItem(this);
            removeItemFromSession($dishId, $urlDelete);
        }

        // count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        // return false;

        changeItemQuantityInSession($dishId, $url, $dishQuantity);
    });

    $('.jq-plus').click(function () {
        var $input = $(this).parent().find('input.quantity');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        // return false;
        var dishId = $(this).siblings('input.dishId').val();
        var url = $(this).parents('form').attr('action');
        var dishQuantity = 1;
        changeItemQuantityInSession(dishId, url, dishQuantity);
    });


    function changeItemQuantityInSession($dishId, $url, $dishQuantity) {
        $.ajax({
            url: $url,
            type: 'POST',
            // dataType: 'html',
            data: {dishId: $dishId, dishQuantity: $dishQuantity},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .done(function (data) {
            console.log(data);
            console.log([$dishId, $dishQuantity]);
        })
        .fail(function () {
            console.log("error");
        })
    }






    /* Remove item from cart */
    function removeItem($item)
    {
        /* Remove row from DOM and recalc cart total */
        var productRow = $($item).parents('.product');
        productRow.remove();
        recalculateCart();
    }


    /* Remove item from session */
    function removeItemFromSession($dishId, $url) {

        $.ajax({
            url: $url,
            type: 'DELETE',
            // dataType: 'html',
            data: {dishId: $dishId},
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