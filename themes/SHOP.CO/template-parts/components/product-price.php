<?php
    $product = $args['product'];
?>

<div class="product-price">
    <?php
        woocommerce_template_single_price();

        if ($product->is_on_sale()) {
            if ($product->is_type('variable')) {
                $available_variations = $product->get_available_variations();
                $variation_id = $available_variations[0]['variation_id'];
                $variation = new WC_Product_Variation($variation_id);

                $regular = (float) $variation->get_regular_price();
                $sale    = (float) $variation->get_sale_price();
            } else {
                $regular = (float) $product->get_regular_price();
                $sale    = (float) $product->get_sale_price();
            }

            if ($regular > 0 && $sale > 0 && $sale < $regular) {
                $discount = round((($regular - $sale) / $regular) * 100);
                echo '<span class="sale-badge">-' . $discount . '%</span>';
            }
        }
    ?>
</div>