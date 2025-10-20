<?php
/**
 * Additional Information tab
 *
 * This is an override for Woocommerce.
 * Original file: woocommerce/template/single-product/tabs/additional-information.php
 * Last checked against WC version 10.2.2.
 */

defined( 'ABSPATH' ) || exit;

global $product;

?>

<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
