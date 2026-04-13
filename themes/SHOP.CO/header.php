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

        <div class="user-dropdown-container">
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/user.svg'
                    );
                ?>
            </a>

            <ul class="sub-menu user-dropdown">

                <?php if (is_user_logged_in()) : ?>
                    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                        <li class="<?=wc_get_account_menu_item_classes($endpoint); ?>">
                            <a href="<?=esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
                                <?=esc_html($label); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>
                        <a href="<?=get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                            Login
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>

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
