function calculateCartTotal() {
    var subtotal = 0;

    $('.cartItems').not('.removed-item').each(function() {
        var itemTotal = parseFloat($(this).find('.shopping-cart__subtotal').text().replace(/[^\d.-]/g, ''));

        subtotal += itemTotal;
    });

    var total = subtotal;

    // Update the subtotal, coupon discount, shipping, and total on the page
    $('.subtotal').text('$' + subtotal.toFixed(2));
    // $('.shipping .price').text('$' + shippingCost.toFixed(2));
    $('.total_amount').text('$' + total.toFixed(2));

    if (total > 0) {
        $("#checkoutButton").removeAttr('disabled', 'disabled');
    } else {
        $("#checkoutButton").attr('disabled', true)
    }
}


$('.qty-left-minus').on('click', function () {
    var $qty = $(this).siblings(".qty-input");
    var currentVal = parseInt($qty.val());

    if (!isNaN(currentVal) && currentVal > 1) {
        $qty.val(currentVal - 1);
    }

    // if ($qty.val() == '1') {
    //     $(this).parents('.cart_qty').removeClass("open");
    // }

    var price = $(this).closest('tr').find('.unitPrice').val();
    var quantity = $(this).siblings(".qty-input").val();
    
    var itemTotal = price*quantity;

    $(this).closest('tr').find('.shopping-cart__subtotal').text('$' + itemTotal.toFixed(2));

    // Recalculate cart total after quantity change
    calculateCartTotal();
});

// Event listener for quantity increase button
$('.qty-right-plus').click(function () {
    var price = $(this).closest('tr').find('.unitPrice').val();
    var current_stock = parseInt($(this).closest('tr').find('.current_stock').val());

    var $qty = $(this).siblings(".qty-input");
    var currentVal = parseInt($qty.val());
    
    if (currentVal < current_stock) {
        $qty.val(parseInt($qty.val()) + 1);
    }

    var quantity = parseInt($qty.val());
    var itemTotal = price*quantity;

    $(this).closest('tr').find('.shopping-cart__subtotal').text('$'+itemTotal.toFixed(2));

    // Recalculate cart total after quantity change
    calculateCartTotal();
});