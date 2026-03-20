<?php get_header(); ?>

<div class="container">

    <div class="hero-section">
        <div class="hero-content">
            <h1>Find clothes that matches your style</h1>

            <p>
                Browse through our diverse range of meiculously crafted garments, designed to bring out your individually and cater to your sense of style
            </p>

            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-main">Shop now</a>

            <div class="hero-numbers">

                <div class="hero-numbers-col">
                    <h4>200+</h4>
                    <p>International brands</p>
                </div>

                <div class="hero-numbers-col">
                    <h4>2 000+</h4>
                    <p>High-Quality Products</p>
                </div>

                 <div class="hero-numbers-col">
                    <h4>30 000+</h4>
                    <p>Happy customers</p>
                </div>

            </div>
        </div>
    </div>
    <div class="hero-brands">
        <?php
            echo file_get_contents(
                get_stylesheet_directory() . '/assets/icons/versace_logo.svg'
            );
        ?>
        <?php
            echo file_get_contents(
                get_stylesheet_directory() . '/assets/icons/zara_logo.svg'
            );
        ?>
        <?php
            echo file_get_contents(
                get_stylesheet_directory() . '/assets/icons/gucci_logo.svg'
            );
        ?>
        <?php
            echo file_get_contents(
                get_stylesheet_directory() . '/assets/icons/prada_logo.svg'
            );
        ?>
        <?php
            echo file_get_contents(
                get_stylesheet_directory() . '/assets/icons/CK_logo.svg'
            );
        ?>
    </div>

    <?php
        $products_new = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => 4,
            'tax_query' => [
                [
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => 'new-arrival'
                ]
            ]
        ]);

        get_template_part(
            'template-parts/components/products-grid',
            null,
            [
                'title' => 'New Arrivals',
                'query' => $products_new,
                'view_all_link' => get_term_link('new-arrival', 'product_tag'),
            ]
        );

        echo '<hr>';

        $products_top = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => 4,
            // 'meta_key' => 'total_sales',
            // 'orderby' => 'meta_value_num',
            'tax_query' => [
                [
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => 'top-selling'
                ]
            ]
        ]);

        get_template_part(
            'template-parts/components/products-grid',
            null,
            [
                'title' => 'Top Selling',
                'query' => $products_top,
                'view_all_link' => get_term_link('top-selling', 'product_tag'),
            ]
        );
    ?>

    <?php get_template_part('template-parts/tags-section', null, []); ?>
    <?php get_template_part('template-parts/testimonies', null, []); ?>

</div>

<?php get_footer(); ?>