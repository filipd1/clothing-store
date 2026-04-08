<?php
add_theme_support('woocommerce');

add_action( 'wp_enqueue_scripts', function() {
    if (!is_woocommerce() && !is_cart() && !is_checkout()) {
        wp_dequeue_script('wc-cart-fragments');
    }
}, 11 );


// Logo i menu
add_action( 'after_setup_theme', function () {

    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'main_menu' => 'Main menu',
        'footer_menu_company' => 'Footer menu company',
        'footer_menu_help' => 'Footer menu help',
        'footer_menu_faq' => 'Footer menu faq',
        'footer_menu_resources' => 'Footer menu resources',
    ]);
});



// CSS
add_action( 'wp_enqueue_scripts', function () {

    wp_enqueue_style(
        'main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        filemtime(get_template_directory() . '/assets/css/main.css')
    );
});



// Wishlist
add_filter('woocommerce_account_menu_items', function($items) {
    $items['wishlist'] = 'Wishlist';
    return $items;
});


add_action('init', function() {
    add_rewrite_endpoint('wishlist', EP_ROOT | EP_PAGES);
});


add_filter('woocommerce_account_menu_items', function($items) {
    $new = [];
    $new['dashboard'] = $items['dashboard'];
    $new['wishlist'] = 'Wishlist';
    $new['orders'] = $items['orders'];
    $new['edit-address'] = $items['edit-address'];
    $new['edit-account'] = $items['edit-account'];
    $new['customer-logout'] = $items['customer-logout'];

    return $new;
});


add_action('woocommerce_account_wishlist_endpoint', function() {

    wc_get_template(
        'myaccount/wishlist.php',
        [],
        '',
        get_stylesheet_directory() . '/woocommerce/'
    );

});


add_action('template_redirect', function() {
    if (!isset($_GET['toggle_wishlist']) || !is_user_logged_in()) {
        return;
    }

    $product_id = intval($_GET['toggle_wishlist']);
    if (!$product_id) return;

    $user_id = get_current_user_id();
    $wishlist = get_user_meta($user_id, 'wishlist', true);
    if (!is_array($wishlist)) $wishlist = [];

    if (in_array($product_id, $wishlist)) {
        $wishlist = array_diff($wishlist, [$product_id]);
    } else {
        $wishlist[] = $product_id;
    }

    update_user_meta($user_id, 'wishlist', array_values($wishlist));

    $redirect_url = remove_query_arg('toggle_wishlist');
    wp_safe_redirect($redirect_url);
    exit;
});



// Skrypty JS i Swiper
function theme_enqueue_scripts() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js', [], null, true);

    wp_enqueue_script('theme-main', get_stylesheet_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);

    if (is_front_page()) {
        wp_enqueue_script('theme-swiper-init', get_stylesheet_directory_uri() . '/assets/js/swiper.js', ['swiper-js'], '1.0.0', true);
    }

    if (is_product()) {
        wp_enqueue_script('wc-add-to-cart-variation');
        wp_enqueue_script('product-logic', get_stylesheet_directory_uri().'/assets/js/product.js', ['jquery','wc-add-to-cart-variation'], '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');



// Usuwanie wariantów z nazwy produktu w koszyku
function custom_cart_item_name( $product_name, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];
    
    if ( $product->is_type( 'variation' ) ) {
        $product_id = $product->get_parent_id();
        $product_name = get_the_title( $product_id );
        
        $product_permalink = $product->get_permalink( $cart_item );
        return sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_name );
    }
    
    return $product_name;
}
add_filter( 'woocommerce_cart_item_name', 'custom_cart_item_name', 10, 3 );



// Wyświetlanie wariantów pod nazwą produktu w koszyku
function show_variations_under_cart_title($item_data, $cart_item) {

    if (!empty($cart_item['variation'])) {
        foreach ($cart_item['variation'] as $key => $value) {
            $taxonomy = str_replace('attribute_', '', $key);
            $label = wc_attribute_label($taxonomy);

            if (taxonomy_exists($taxonomy)) {
                $term = get_term_by('slug', $value, $taxonomy);
                $value = $term ? $term->name : $value;
            }

            $item_data[] = [
                'key'   => $label,
                'value' => $value
            ];
        }
    }

    return $item_data;
}
add_filter('woocommerce_get_item_data', 'show_variations_under_cart_title', 10, 2);



// Kupony w koszyku
add_action( 'wp_loaded', 'custom_apply_coupon_logic' );
function custom_apply_coupon_logic() {
    if ( isset( $_POST['apply_coupon'] ) && !empty( $_POST['coupon_code'] ) ) {
        WC()->cart->apply_coupon( sanitize_text_field( $_POST['coupon_code'] ) );
    }
}



// Strona On Sale
add_action('init', function() {
    add_rewrite_rule('^sale/?$', 'index.php?post_type=product&on_sale=1', 'top');
});

add_filter('query_vars', function($vars) {
    $vars[] = 'on_sale';
    return $vars;
});

add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && $query->get('on_sale') == '1') {
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $query->set('post__in', array_merge([0], $product_ids_on_sale));
    }
});



// Wygląd pojedynczej opinii o produkcie
function custom_woocommerce_review_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
        <li <?php comment_class('testimony-card'); ?> id="comment-<?php comment_ID(); ?>">

            <?php 
                if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                    $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
                    if ( $rating ) {
                        echo '<div class="comment-rating">' . wc_get_rating_html( $rating ) . '</div>';
                    }
                }
            ?>

            <p class="testimony-card-name"><?php comment_author(); ?></p>
            <div class="testimony-card-content"><?php comment_text(); ?></div>
            <p class="testimony-card-date">Posted on <?php echo get_comment_date(); ?></p>
                
        </li>
    <?php
}



// CPT
add_action('init', function () {
    
    register_post_type('testimonies', [
        'labels' => [
            'name' => 'Testimonies',
            'singular_name' => 'Testimony',
        ],
        'rewrite' => [
            'slug' => 'testimonies',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-portfolio',
    ]);
});



// ACF OPTIONS
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Ustawienia globalne',
        'menu_title' => 'Global Settings',
        'menu_slug'  => 'global-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ]);
}