<?php
/**
 * File contain all common functions used in different files.
 *
 * @package TSS\Functions
 */

/**
 * All Social share options array.
 *
 * @param none
 * @return Array $tss_social_buttons
 */
function tss_social_sharing_options(){

	$tss_social_buttons = array(
		'facebook' => array(
			'label' => 'Facebook',
			'img' => TSS_PLUGINS_URL.'icons/facebook.svg',
			'bgcolor' => '#1877F2'
		),
		'twitter' => array(
			'label' => 'Twitter',
			'img' => TSS_PLUGINS_URL.'icons/twitter.svg',
			'bgcolor' => '#1D9BF0'
		),
		'pinterest' => array(
			'label' => 'Pinterest',
			'img' => TSS_PLUGINS_URL.'icons/pinterest.svg',
			'bgcolor' => '#BD081C'
		),
		'linkedIn' => array(
			'label' => 'LinkedIn',
			'img' => TSS_PLUGINS_URL.'icons/linkedIn.svg',
			'bgcolor' => '#007BB5'
		),
		'whatsapp' => array(
			'label' => 'whatsapp',
			'img' => TSS_PLUGINS_URL.'icons/whatsapp.svg',
			'bgcolor' => '#12AF0A'
		),
	);

	/**
	 * Allow to add more social share options and update existing options.
	 *
	 * @since 1.0.0
	 * @param array $tss_social_buttons array of all social buttons
	 */
	$tss_social_buttons = apply_filters_ref_array( 'tss_social_buttons', array( &$tss_social_buttons ));
	return $tss_social_buttons;

}

if( !function_exists( 'tss_share_shortcode' ) ){
	// Add shortcode here.
	add_shortcode( 'top-share', 'tss_share_shortcode' );
	/**
	 * Add shortcode to add share bar.
	 *
	 * @param $atts shortcode attributes
	 */
	function tss_share_shortcode( $atts ) {
		$instance = new TSS_Social_Share();
		$html = '<div class="tss-share-shortcode-output">';
			$html .= $instance->build_the_tss_icons();
		$html .= '</div>';

		return $html;
	}
}
