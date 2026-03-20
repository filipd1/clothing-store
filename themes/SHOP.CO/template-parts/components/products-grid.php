<?php
    $title = $args['title'] ?? 'Products';
    $query = $args['query'] ?? null;
    $view_all_link = $args['view_all_link'] ?? '#';
?>

<div class="container-section">
    <h2 class="container-title"><?php echo esc_html($title); ?></h2>

    <ul class="products-grid">

        <?php if ( $query->have_posts() ) : ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); 
                global $product;
                $product = wc_get_product(get_the_ID()); ?>

                <?php wc_get_template_part('content', 'product'); ?>
            <?php endwhile; ?>

        <?php else : ?>
            <p>No products found</p>
        <?php endif; ?>  

        <?php wp_reset_postdata(); ?>
    </ul>

    <a class="btn btn-secondary btn-view-all" href="<?php echo esc_url($view_all_link); ?>">
        View All
    </a>
</div>
