<?php
    defined('ABSPATH') || exit;
    global $product
?>

<li class="product-card" ?>
    <a href="<?php the_permalink(); ?>">
        <div class="product-image">
            <?php echo woocommerce_get_product_thumbnail(); ?>
        </div>

        <h3 class="product-title"><?php the_title(); ?></h3>

        <?php
            $average = $product->get_average_rating();
            $count   = $product->get_review_count();

            if ($count > 0) {
                echo '<div class="product-rating">';
                echo wc_get_rating_html($average);
                echo '</div>';
            }

            get_template_part('template-parts/components/product-price', null, [
                'product' => $product,
            ]); 
        ?>

    </a>
</li>