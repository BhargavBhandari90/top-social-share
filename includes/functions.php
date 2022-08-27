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


// Add shortcode here.
