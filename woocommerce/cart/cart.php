<?php
/**
 * Cart Page
 * This is an override for Woocommerce.
 * Original file: woocommerce/template/cart/cart.php
 * Last checked against WC version 10.2.2.
 */

defined('ABSPATH') || exit;
if ( WC()->cart->is_empty() ) {
    wc_get_template( 'woocommerce/cart/cart-empty.php' );
    return;
}

do_action('woocommerce_before_cart'); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<?php do_action('woocommerce_before_cart_table'); ?>
	<?php do_action('woocommerce_before_cart_contents'); ?>

	<div class="cart-items-container woocommerce-cart-form__contents">
		<?php
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
			$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
				?>
				<div
					class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
					<div class="product-remove">
						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
								esc_url(wc_get_cart_remove_url($cart_item_key)),
								/* translators: %s is the product name */
								esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
								esc_attr($product_id),
								esc_attr($_product->get_sku()),
								highness_svg('xbox-x', 'icon icon--remove', 'Remove item', true)
							),
							$cart_item_key
						);
						?>
					</div>
					<div class="product-thumbnail">
						<?php
						/**
						 * Filter the product thumbnail displayed in the WooCommerce cart.
						 *
						 * This filter allows developers to customize the HTML output of the product
						 * thumbnail. It passes the product image along with cart item data
						 * for potential modifications before being displayed in the cart.
						 *
						 * @param string $thumbnail     The HTML for the product image.
						 * @param array  $cart_item     The cart item data.
						 * @param string $cart_item_key Unique key for the cart item.
						 *
						 * @since 2.1.0
						 */
						$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
						if (!$product_permalink) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
						}
						?>
					</div>
					<div class="product-info">
						<div class="product-titles">
							<div class="product-name">
								<?php
								if (!$product_permalink) {
									echo wp_kses_post($product_name . '&nbsp;');
								} else {
									/**
									 * This filter is documented above.
									 *
									 * @since 2.1.0
									 */
									echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
								}
								do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
								// Meta data.
								echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
								// Backorder notification.
								if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
									echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
								}
								?>
							</div>
							<div class="product-author">
								<p>
									<?php
									$terms = get_the_terms($_product->get_id(), 'authors');
									echo esc_html($terms[0]->name);
									?>
								</p>
							</div>
						</div>
						<div class="product-quantity">
							<?php
							if ($_product->is_sold_individually()) {
								$min_quantity = 1;
								$max_quantity = 1;
							} else {
								$min_quantity = 0;
								$max_quantity = $_product->get_max_purchase_quantity();
							}
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name' => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value' => $max_quantity,
									'min_value' => $min_quantity,
									'product_name' => $product_name,
								),
								$_product,
								false
							);
							echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
							?>
						</div>
					</div>
					<div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
						<?php
						echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
						?>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
	<?php do_action('woocommerce_cart_contents'); ?>
	<div class="after-cart-contents">
		<div class="coupon">
			<input type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
				placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
			<div class="columns">
				<div class="col">
					<button type="submit" class="button" name="apply_coupon"
						value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
					<?php do_action('woocommerce_cart_coupon'); ?>
				</div>
				<div class="col">
					<!-- UPDATE CART -->
					<button type="submit" class="button" name="update_cart"
						value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
				</div>
			</div>
		</div>
		<div
			class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">
			<?php do_action('woocommerce_before_cart_totals'); ?>
			<div class="subtotal">
				<span><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
				<div data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
					<?php wc_cart_totals_subtotal_html(); ?>
				</div>
			</div>
			<?php foreach (WC()->cart->get_coupons() as $code => $coupon): ?>
				<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
					<span><?php wc_cart_totals_coupon_label($coupon); ?></span>
					<div data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>">
						<?php wc_cart_totals_coupon_html($coupon); ?>
					</div>
				</div>
			<?php endforeach; ?>
			<?php
			if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
				$taxable_address = WC()->customer->get_taxable_address();
				$estimated_text = '';

				if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
					/* translators: %s location. */
					$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
				}

				if ('itemized' === get_option('woocommerce_tax_total_display')) {
					foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						?>
						<div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
							<span><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</span>
							<div data-title="<?php echo esc_attr($tax->label); ?>">
								<?php echo wp_kses_post($tax->formatted_amount); ?>
							</div>
						</div>
						<?php
					}
				} else {
					?>
					<div class="tax-total">
						<span><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
						<div data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>">
							<?php wc_cart_totals_taxes_total_html(); ?>
						</div>
					</div>
					<?php
				}
			}
			?>

			<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

			<div class="order-total">
				<span><?php esc_html_e('Grand Total', 'woocommerce'); ?></span>
				<div data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
					<?php wc_cart_totals_order_total_html(); ?>
				</div>
			</div>

			<?php do_action('woocommerce_cart_totals_after_order_total'); ?>
		</div>
	</div>
	<div class="add-to-cart-wrap">
		<?php do_action('woocommerce_after_cart_contents'); ?>

		<?php do_action('woocommerce_proceed_to_checkout'); ?>
		<?php do_action('woocommerce_after_cart'); ?>
	</div>
</form>
