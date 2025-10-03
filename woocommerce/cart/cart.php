<?php
/**
 * Cart Page
 * This is an override for Woocommerce.
 * Original file: woocommerce/template/cart/cart.php
 * Last checked against WC version 10.2.2.
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<?php do_action( 'woocommerce_before_cart_contents' ); ?>

	<?php 
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
		?>
		<div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
			<div class="product-remove">
				<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							/* translators: %s is the product name */
							esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
							esc_attr( $product_id ),
							esc_attr( $_product->get_sku() ),
							highness_svg( 'xbox-x', 'icon icon--remove', 'Remove item', true)
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
				$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

				if ( ! $product_permalink ) {
					echo $thumbnail; // PHPCS: XSS ok.
				} else {
					printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
				}
				?>
			</div>
		</div>
		<div class="product-info">
			<div class="product-titles">
				<div class="product-name">
					<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( $product_name . '&nbsp;' );
						} else {
							/**
							 * This filter is documented above.
							 *
							 * @since 2.1.0
							 */
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}
						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
					?>
				</div>
				<div class="product-author">
					<?php 
						$attribute_name = 'book-author';
						$terms = wp_get_post_terms( $product_id, $attribute_name);
					?>
				</div>
			</div>
		</div>
		<?php
		}
	}
	?>
</form>
