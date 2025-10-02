<?php
/**
 * This is an override for Woocommerce.
 * Original: woocommerce/templates/cart/cart-empty.php
 * Last checked against WC version 10.2.2
 */

defined( 'ABSPATH' ) || exit;

// /*
//  * @hooked wc_empty_cart_message - 10
//  */
// do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<section id="cart-empty">
		<p class="return-to-shop">
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' )); ?>">
				There's nothing to see here... yet!
			</a>
		</p>
	</section>
<?php endif; ?>
