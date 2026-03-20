<?php
    defined('ABSPATH') || exit;

    $user_id = get_current_user_id();
    $wishlist = get_user_meta($user_id, 'wishlist', true);

    if (!is_array($wishlist)) {
        $wishlist = [];
    }
?>

<h2>My wishlist</h2>
<?php if (!$wishlist) : ?>
    <p>Your wishlist is empty</p>
<?php endif; ?>

<div class="wishlist-grid">
    <?php
        foreach ($wishlist as $product_id) :
            $product = wc_get_product($product_id);
            if (!$product) continue;
    ?>
        <div class="wishlist-item">

            <a href="?remove_wishlist=<?php echo $product_id; ?>" class="remove-wishlist">X</a>

            <a href="<?php echo get_permalink($product_id); ?>">
                <?php echo $product->get_image(); ?>
                <h3><?php echo $product->get_name(); ?></h3>
            </a>

            <p><?php echo $product->get_price_html(); ?></p>

            <a href="?add-to-cart=<?php echo $product_id; ?>" class="btn btn-wishlist">Add to cart</a>

        </div>
    <?php endforeach; ?>
</div>