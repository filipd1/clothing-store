<?php
	defined('ABSPATH') || exit;
	do_action('woocommerce_before_cart');
?>

<div class="cart-container">
	<h2 class="cart-title">Your Cart</h2>

	<?php if ( WC()->cart->is_empty() ) : ?>
        <div class="cart-empty">
            <p><?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ); ?></p>
            <a class="btn btn-main" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                Return to Shop
            </a>
        </div>
    <?php else : ?>

		<div class="cart-grid">
			<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<div class="cart-item-list">

					<?php 
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
						$product = $cart_item['data'];

						if ( $product && $product->exists() && $cart_item['quantity'] > 0 ) :
					?>
						<div class="cart-item">
							<div class="cart-img">
								<?php echo apply_filters('woocommerce_cart_item_thumbnail', $product->get_image(), $cart_item, $cart_item_key); ?>
							</div>

							<div class="cart-info">
								<h3>
									<?php echo apply_filters('woocommerce_cart_item_name', $product->get_name(), $cart_item, $cart_item_key); ?>
								</h3>

								<div class="cart-variation">
									<?php echo wc_get_formatted_cart_item_data($cart_item); ?>
								</div>

								<div class="cart-bottom">

									<p class="cart-price">
										<?php
										echo apply_filters(
											'woocommerce_cart_item_price',
											WC()->cart->get_product_price($product),
											$cart_item,
											$cart_item_key
										);
										?>
									</p>

									<?php
										get_template_part(
											'template-parts/components/quantity',
											null,
											[
												'input_name' => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'product' => $product,
												'max_value' => $product->get_max_purchase_quantity()
											]
										);
									?>

								</div>

								<a class="cart-remove" href="<?php echo esc_url( wc_get_cart_remove_url($cart_item_key) ); ?>">
									<?php
									echo file_get_contents(
										get_stylesheet_directory() . '/assets/icons/remove.svg'
									);
									?>
								</a>

							</div>
						</div>
					<?php
							endif;
						endforeach;
					?>

				</div>

				<div class="cart-form-actions" style="display:none;">
					<input type="submit" name="update_cart" value="update_cart">
					<?php wp_nonce_field('woocommerce-cart','woocommerce-cart-nonce'); ?>
				</div>

			</form>

			<?php woocommerce_cart_totals(); ?>
		</div>
	
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>