<?php get_header(); ?>

<div class="container">

    <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
    <h1 class="container-title">Brands</h1>

    <?php
        $taxonomy = 'pa_brand';
        $brands = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ));

        $attribute_slug = 'brand';
        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

        if (!empty($brands) && !is_wp_error($brands)) : 
    ?>

    <ul class="brands-list">
        <?php
            foreach($brands as $brand) :
                $brand_link = add_query_arg( 'filter_' . $attribute_slug, $brand->slug, $shop_page_url );
        ?>
        <li class="brand-item">
            <a href="<?php echo esc_html($brand_link); ?>">
                <?php echo esc_html($brand->name) ?>
            </a>
        </li>

        <?php endforeach; ?>

        <li class="brand-item">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/versace_logo.svg'
                );
            ?>
        </li>

        <li class="brand-item">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/zara_logo.svg'
                );
            ?>
        </li>

        <li class="brand-item">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/gucci_logo.svg'
                );
            ?>
        </li>

        <li class="brand-item">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/prada_logo.svg'
                );
            ?>
        </li>

        <li class="brand-item">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/CK_logo.svg'
                );
            ?>
        </li>

    </ul>
    <?php else : ?>
        <p>No brands found</p>
    <?php endif; ?>


</div>

<?php get_footer(); ?>