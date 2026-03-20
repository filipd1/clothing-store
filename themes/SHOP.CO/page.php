<?php get_header(); ?>

<div class="container">
    <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
    
    <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
    ?>
</div>

<?php get_footer(); ?>