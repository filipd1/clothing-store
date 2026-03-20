<?php
	defined('ABSPATH') || exit;
?>

<div class="checkout-container">

	<h1>Checkout</h1>

	<form class="checkout" method="post">

		<div class="checkout-grid">

			<div class="checkout-left">
				<?php do_action('woocommerce_checkout_billing'); ?>
				<h2>Shipping details</h2>
				<?php do_action('woocommerce_checkout_shipping'); ?>
			</div>

			<div class="checkout-right">
				<h2>Your order</h2>
				<?php do_action('woocommerce_checkout_order_review'); ?>
			</div>

		</div>

	</form>

</div>