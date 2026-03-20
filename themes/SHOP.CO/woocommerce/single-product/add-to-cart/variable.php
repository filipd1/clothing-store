<?php
	defined('ABSPATH') || exit;

	global $product;

	$attributes = $product->get_variation_attributes();
	$available_variations = $product->get_available_variations();
?>

<form class="variations_form cart"
	action="<?php echo esc_url( $product->get_permalink() ); ?>"
	method="post"
	enctype='multipart/form-data'
	data-product_variations="<?php echo esc_attr( wp_json_encode( $available_variations ) ); ?>"
	data-product_id="<?php echo $product->get_id(); ?>"
>

	<div class="variations">
		<?php foreach ($attributes as $attribute_name => $options) : ?>
			<?php $taxonomy = str_replace('attribute_', '', $attribute_name); ?>

			<div class="product-option">
				<label><?php echo wc_attribute_label($attribute_name); ?></label>

				<div class="option-buttons">
					<?php
						foreach ($options as $option) {

							if ($attribute_name === 'pa_color') {

							$color = $option;

								echo '<button
								type="button"
								class="option-btn color"
								style="background:'.$color.'"
								data-attribute="'.$attribute_name.'"
								data-value="'.$option.'"
								></button>';
							}

							else {
								echo '<button
								type="button"
								class="option-btn"
								data-attribute="'.$attribute_name.'"
								data-value="'.$option.'"
								>'.$option.'</button>';
							}
						}
					?>
				</div>

				<select name="attribute_<?php echo strtolower(esc_attr($attribute_name)); ?>" style="display:none">
					<option value="">Choose</option>
					<?php
						foreach ($options as $option){
						echo '<option value="'.$option.'">'.$option.'</option>';
						}
					?>
				</select>

				<hr>

			</div>
		<?php endforeach; ?>
	</div>

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

	<input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>">
	<input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
	<input type="hidden" name="variation_id" class="variation_id" value="0">

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>