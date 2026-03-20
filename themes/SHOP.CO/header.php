<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="site-header">
    
    <?php if (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
    <?php endif; ?>

    <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container' => 'false',
            'menu_class' => 'main-menu'
        ])
    ?>

    <?php get_template_part('template-parts/components/search-form'); ?>

    <div class="header-icons">
        <a href="<?php echo wc_get_cart_url(); ?>">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/cart.svg'
                );
            ?>
        </a>
        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
            <?php
                echo file_get_contents(
                    get_stylesheet_directory() . '/assets/icons/user.svg'
                );
            ?>
        </a>
    </div>

    <button class="mobile-menu-toggle" aria-label="Open menu">
        ☰
    </button>

    <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container'      => 'false',
            'menu_class' => 'mobile-menu'
        ]);
    ?>

</div>
