<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 * Change Date Format
 */

add_filter( 'post_date_column_time' , 'woo_custom_post_date_column_time' );
/**
 * woo_custom_post_date_column_time
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function woo_custom_post_date_column_time( $post ) {
	
	$h_time = get_post_time( __( 'd/m/Y', 'woocommerce' ), $post );
	
	return $h_time;
	
}

/**
 * Ẩn mã bưu chính
 * Ẩn địa chỉ thứ hai
 * Đổi tên Bang / Hạt thành Tỉnh / Thành
 * Đổi tên Tỉnh / Thành phố thành Quận / Huyện
 * 
 * 
 * @hook woocommerce_checkout_fields
 * @param $fields
 * @return mixed
 */
function tp_custom_checkout_fields( $fields ) {
  // Ẩn mã bưu chính
  unset( $fields['postcode'] );
  
  // Ẩn địa chỉ thứ hai
  unset( $fields['address_2'] );
  
  // Đổi tên Bang / Hạt thành Tỉnh / Thành
  $fields['state']['label'] = 'Tỉnh / Thành';
  
  // Đổi tên Tỉnh / Thành phố thành Quận / Huyện
  $fields['city']['label'] = 'Quận / Huyện';
  
  return $fields;
 }
 add_filter( 'woocommerce_default_address_fields', 'tp_custom_checkout_fields' );