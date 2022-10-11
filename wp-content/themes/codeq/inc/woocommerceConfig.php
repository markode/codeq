<?php


add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false');
/* WooCommerce: The Code Below Removes Checkout Fields */
// add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// function custom_override_checkout_fields( $fields ) {
// // unset($fields['billing']['billing_first_name']);
// // unset($fields['billing']['billing_last_name']);
//  unset($fields['billing']['billing_company']);
// // unset($fields['billing']['billing_address_1']);
// // unset($fields['billing']['billing_address_2']);
// // unset($fields['billing']['billing_city']);
// // unset($fields['billing']['billing_postcode']);
// unset($fields['billing']['billing_country']);
// // unset($fields['billing']['billing_state']);
// // unset($fields['billing']['billing_phone']);
// // unset($fields['order']['order_comments']);
// // unset($fields['billing']['billing_email']);
// // unset($fields['account']['account_username']);
// // unset($fields['account']['account_password']);
// // unset($fields['account']['account_password-2']);
// return $fields;
// }


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// add_filter( 'woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2 );
// add_filter( 'woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2 );
//
// function wpglorify_variation_price_format( $price, $product ) {
//
// // Main Price
// $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
// $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
//
// // Sale Price
// $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
// sort( $prices );
// $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
//
// if ( $price !== $saleprice ) {
// $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
// }
// return $price;
// }

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
    <div class="img">

    </div>
    <?php echo $woocommerce->cart->get_cart_total(); ?>
  </a>
  <?php
  $fragments['a.cart-customlocation'] = ob_get_clean();
  return $fragments;
}

// add_filter( 'gettext', 'change_cart_totals_text', 20, 3 );
// function change_cart_totals_text( $translated, $text, $domain ) {
//     if( $translated == 'Cart totals' ){
//         $translated = __('Cart totals', 'woocommerce');
//         return $translated;
//     }
//     else if( $translated == 'Apply coupon' ){
//         $translated = __('Apply coupon', 'woocommerce');
//         return $translated;
//     }
//     else if( $translated == 'Coupon code' ){
//         $translated = __('Coupon code', 'woocommerce');
//         return $translated;
//     }
//     else if( $translated == 'Subtotal' ){
//         $translated = __('Subtotal', 'woocommerce');
//         return $translated;
//     } else {
//         return $translated;
//     }
//
// }

// cart page return to shop link
 add_filter( 'woocommerce_return_to_shop_redirect', 'tm_get_shop_link' );
 // continue shopping redirect
 add_filter( 'woocommerce_continue_shopping_redirect', 'tm_get_shop_link' );
 function tm_get_shop_link() {
   return get_site_url().'/';
 } // end function

 /*Add to cart*/
add_filter( 'woocommerce_product_single_add_to_cart_text', 'sm_woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'sm_woo_custom_cart_button_text' );

function sm_woo_custom_cart_button_text() {
        return __( 'Dodaj do koszyka', 'woocommerce' );
}

/*View Cart*/
function sm_text_view_cart_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'View Cart' :
            $translated_text = __( 'Pokaż koszyk', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'sm_text_view_cart_strings', 20, 3 );




// add_filter( 'woocommerce_get_availability', 'custom_override_get_availability', 10, 2);
//
// // The hook in function $availability is passed via the filter!
//     function custom_override_get_availability( $availability, $_product ) {
//     if ( $_product->is_in_stock() ){
//       $availability['availability'] = __('Tak', 'woocommerce');
//     }  else {
//       $availability['availability'] = __('Nie', 'woocommerce');
//     }
//     return $availability;
//     }

// add_action( 'after_setup_theme', 'yourtheme_setup' );
//
// function yourtheme_setup() {
//     add_theme_support( 'wc-product-gallery-zoom' );
//     add_theme_support( 'wc-product-gallery-lightbox' );
//     add_theme_support( 'wc-product-gallery-slider' );
// }

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');

function woocommerce_custom_add_to_cart_text() {
return __('Dodaj do koszyka', 'woocommerce');
}

// add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html', 12, 2 );
// function filter_dropdown_option_html( $html, $args ) {
//     $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
//     $show_option_none_html = '<option value="">'.esc_html( $show_option_none_text ).'</option>';
//     $html = str_replace($show_option_none_html, '', $html);
//     return $html;
// }

add_action( 'after_setup_theme', 'setup_woocommerce_support' );

 function setup_woocommerce_support()
{
  add_theme_support('woocommerce');
}

function my_woocommerce_make_tags_hierarchical( $args ) {
    $args['hierarchical'] = true;
    return $args;
};
add_filter( 'woocommerce_taxonomy_args_product_tag', 'my_woocommerce_make_tags_hierarchical' );


add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
wp_deregister_script('heartbeat');
}

function wpcustom_deregister_scripts_and_styles(){
  wp_deregister_style('storefront-woocommerce-style');
  wp_deregister_style('storefront-style');
  add_filter('storefront_customizer_css', '__return_false');
  add_filter('storefront_customizer_woocommerce_css', '__return_false');
  add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter('use_block_editor_for_post_type', '__return_false', 10);
}
add_action( 'wp_print_styles', 'wpcustom_deregister_scripts_and_styles', 100 );

// Don't load Gutenberg-related stylesheets.
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // WordPress core
wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
wp_dequeue_style( 'storefront-gutenberg-blocks-css' ); // Storefront theme
wp_dequeue_style( 'storefront-gutenberg-blocks-inline-css' ); // Storefront theme
}
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function my_theme_remove_storefront_standard_functionality() {

//remove customizer inline styles from parent theme as I don't need it.
set_theme_mod('storefront_styles', '');
set_theme_mod('storefront_woocommerce_styles', '');

}

add_action( 'init', 'my_theme_remove_storefront_standard_functionality' );


// Adds a custom rule type.
add_filter( 'acf/location/rule_types', function( $choices ){
    $choices[ __("Other",'acf') ]['wc_prod_attr'] = 'WC Product Attribute';
    return $choices;
} );

// Adds custom rule values.
add_filter( 'acf/location/rule_values/wc_prod_attr', function( $choices ){
    foreach ( wc_get_attribute_taxonomies() as $attr ) {
        $pa_name = wc_attribute_taxonomy_name( $attr->attribute_name );
        $choices[ $pa_name ] = $attr->attribute_label;
    }
    return $choices;
} );

// Matching the custom rule.
add_filter( 'acf/location/rule_match/wc_prod_attr', function( $match, $rule, $options ){
    if ( isset( $options['taxonomy'] ) ) {
        if ( '==' === $rule['operator'] ) {
            $match = $rule['value'] === $options['taxonomy'];
        } elseif ( '!=' === $rule['operator'] ) {
            $match = $rule['value'] !== $options['taxonomy'];
        }
    }
    return $match;
}, 10, 3 );
