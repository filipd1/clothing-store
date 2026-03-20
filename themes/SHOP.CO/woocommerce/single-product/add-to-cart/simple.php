<?php

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product );

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>

		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
		
		<div class="single_variation_wrap">

			<div class="product-quantity-btns">
				<?php
					get_template_part (
						'template-parts/components/quantity',
						null,
						[
						'input_name' => 'quantity',
						'input_value' => 1,
						'product' => $product,
						'max_value' => $product->get_max_purchase_quantity(),
						]
					);
				?>

				<button type="submit" class="single_add_to_cart_button btn btn-main">
					Add to Cart
				</button>

			</div>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>