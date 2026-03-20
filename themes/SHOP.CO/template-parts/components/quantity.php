<div class="cart-quantity">
    <button type="button" class="quantity-minus">-</button>
    <?php
        echo woocommerce_quantity_input([
            'input_name'  => $args['input_name'],
            'input_value' => $args['input_value'],
            'max_value'   => $args['max_value'],
            'min_value'   => 0,
            'input_class' => ['qty'],
        ], $args['product'], false);
    ?>
    <button type="button" class="quantity-plus">+</button>
</div>