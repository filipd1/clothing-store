<?php
    defined('ABSPATH') || exit;
    $product = wc_get_product(get_the_ID());
?>

<?php get_header(); ?>

<div class="container">

    <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>

    <div class="product-layout">
        <div class="product-gallery">

            <?php
                echo get_the_post_thumbnail();

                $user_id = get_current_user_id();
                $wishlist = get_user_meta($user_id,'wishlist',true);

                if (!$wishlist) $wishlist = [];
                $in_wishlist = in_array($product->get_id(), $wishlist);
            ?>

            <a
                class="btn-wishlist <?php echo $in_wishlist ? 'added' : ''; ?>"
                href="?toggle_wishlist=<?php echo $product->get_id(); ?>"
            >
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/wishlist.svg'
                    );
                ?>
            </a>

        </div>

        <div class="product-info">

            <h1 class="product-title"><?php the_title(); ?></h1>
            <?php
                if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $product->get_rating_count() > 0 ) {
                    echo wc_get_rating_html( $product->get_average_rating() ); 
                }
            ?>
            
            <?php
                get_template_part('template-parts/components/product-price', null, [
                    'product' => $product,
                ]);
            ?>

            <div class="product-desc">
                <?php woocommerce_template_single_excerpt(); ?>
            </div>

            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
    </div>

    <div class="product-tabs">
        <button class="tab" data-tab="details">Product Details</button>
        <button class="tab active" data-tab="reviews">Rating & Reviews</button>
        <button class="tab" data-tab="faqs">FAQs</button>
    </div>

    <div class="tab-content" id="details">
        <?php get_template_part('template-parts/product-details'); ?>
    </div>

    <div class="tab-content active" id="reviews">
        <?php get_template_part('template-parts/product-reviews'); ?>
    </div>


    <div class="tab-content" id="faqs">
        <?php get_template_part('template-parts/product-faqs'); ?>
    </div>
    
</div>

<?php get_footer(); ?>