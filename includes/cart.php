<?php
/**
 * Disables the payment option.
 */
add_filter('woocommerce_cart_needs_payment', '__return_false');
