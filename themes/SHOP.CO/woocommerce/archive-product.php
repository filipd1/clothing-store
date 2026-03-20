<?php get_header(); ?>

<div class="container">
    <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>

    <h1 class="container-title">
        <?php 
        if ( get_query_var('on_sale') == '1' ) {
            echo 'On sale';
        } elseif ( is_search() ) {
            echo 'Search results for:' . ' ' . get_search_query();
        } elseif ( is_shop() ) {
            echo 'All products';
        } else {
            single_term_title(); 
        }
        ?>
    </h1>

    <div class="archive-grid">

        <?php get_template_part('template-parts/components/product-filters'); ?>

        <ul class="products-grid">
            <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                else :
                    echo '<p>No products found</p>';
                endif;
            ?>
        </ul>

    </div>

</div>

<?php get_footer(); ?>