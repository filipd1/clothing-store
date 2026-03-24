<?php
    defined('ABSPATH') || exit;
    do_action( 'woocommerce_before_checkout_form', $checkout );

    if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
        echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
        return;
    }
?>

<div class="checkout-container">
    <h1>Checkout</h1>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <div class="checkout-grid">

            <div class="checkout-left">
                <?php do_action('woocommerce_checkout_billing'); ?>
                
                <h2>Shipping details</h2>
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>

            <div class="checkout-right">
                <h2>Your order</h2>
                
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>
            </div>

        </div>

    </form>
</div>

<?php 
    do_action( 'woocommerce_after_checkout_form', $checkout ); 
?>