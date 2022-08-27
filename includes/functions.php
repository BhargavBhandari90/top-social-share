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
			'img_url' => TSS_PLUGINS_URL.'icons/facebook.svg',
			'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="background-color: #1877F2;"><path fill="#FFF" d="M17.78 27.5V17.008h3.522l.527-4.09h-4.05v-2.61c0-1.182.33-1.99 2.023-1.99h2.166V4.66c-.375-.05-1.66-.16-3.155-.16-3.123 0-5.26 1.905-5.26 5.405v3.016h-3.53v4.09h3.53V27.5h4.223z"/></svg>',
			'bgcolor' => '#1877F2'
		),
		'twitter' => array(
			'label' => 'Twitter',
			'img_url' => TSS_PLUGINS_URL.'icons/twitter.svg',
			'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"  style="background-color: #1D9BF0;"><path fill="#FFF" d="M28 8.557a9.913 9.913 0 0 1-2.828.775 4.93 4.93 0 0 0 2.166-2.725 9.738 9.738 0 0 1-3.13 1.194 4.92 4.92 0 0 0-3.593-1.55 4.924 4.924 0 0 0-4.794 6.049c-4.09-.21-7.72-2.17-10.15-5.15a4.942 4.942 0 0 0-.665 2.477c0 1.71.87 3.214 2.19 4.1a4.968 4.968 0 0 1-2.23-.616v.06c0 2.39 1.7 4.38 3.952 4.83-.414.115-.85.174-1.297.174-.318 0-.626-.03-.928-.086a4.935 4.935 0 0 0 4.6 3.42 9.893 9.893 0 0 1-6.114 2.107c-.398 0-.79-.023-1.175-.068a13.953 13.953 0 0 0 7.55 2.213c9.056 0 14.01-7.507 14.01-14.013 0-.213-.005-.426-.015-.637.96-.695 1.795-1.56 2.455-2.55z"/></svg>',
			'bgcolor' => '#1D9BF0'
		),
		'pinterest' => array(
			'label' => 'Pinterest',
			'img_url' => TSS_PLUGINS_URL.'icons/pinterest.svg',
			'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"  style="background-color: #BD081C;"><path fill="#FFF" d="M16.539 4.5c-6.277 0-9.442 4.5-9.442 8.253 0 2.272.86 4.293 2.705 5.046.303.125.574.005.662-.33.061-.231.205-.816.27-1.06.088-.331.053-.447-.191-.736-.532-.627-.873-1.439-.873-2.591 0-3.338 2.498-6.327 6.505-6.327 3.548 0 5.497 2.168 5.497 5.062 0 3.81-1.686 7.025-4.188 7.025-1.382 0-2.416-1.142-2.085-2.545.397-1.674 1.166-3.48 1.166-4.689 0-1.081-.581-1.983-1.782-1.983-1.413 0-2.548 1.462-2.548 3.419 0 1.247.421 2.091.421 2.091l-1.699 7.199c-.505 2.137-.076 4.755-.039 5.019.021.158.223.196.314.077.13-.17 1.813-2.247 2.384-4.324.162-.587.929-3.631.929-3.631.46.876 1.801 1.646 3.227 1.646 4.247 0 7.128-3.871 7.128-9.053.003-3.918-3.317-7.568-8.361-7.568z"/></svg>',
			'bgcolor' => '#BD081C'
		),
		'linkedIn' => array(
			'label' => 'LinkedIn',
			'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"  style="background-color: #007BB5;"><path d="M6.227 12.61h4.19v13.48h-4.19V12.61zm2.095-6.7a2.43 2.43 0 0 1 0 4.86c-1.344 0-2.428-1.09-2.428-2.43s1.084-2.43 2.428-2.43m4.72 6.7h4.02v1.84h.058c.56-1.058 1.927-2.176 3.965-2.176 4.238 0 5.02 2.792 5.02 6.42v7.395h-4.183v-6.56c0-1.564-.03-3.574-2.178-3.574-2.18 0-2.514 1.7-2.514 3.46v6.668h-4.187V12.61z" fill="#FFF"/></svg>',
			'img_url' => TSS_PLUGINS_URL.'icons/linkedIn.svg',
			'bgcolor' => '#007BB5'
		),
		'whatsapp' => array(
			'label' => 'whatsapp',
			'img' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"  style="background-color: #12AF0A;"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF" d="M16.21 4.41C9.973 4.41 4.917 9.465 4.917 15.7c0 2.134.592 4.13 1.62 5.832L4.5 27.59l6.25-2.002a11.241 11.241 0 0 0 5.46 1.404c6.234 0 11.29-5.055 11.29-11.29 0-6.237-5.056-11.292-11.29-11.292zm0 20.69c-1.91 0-3.69-.57-5.173-1.553l-3.61 1.156 1.173-3.49a9.345 9.345 0 0 1-1.79-5.512c0-5.18 4.217-9.4 9.4-9.4 5.183 0 9.397 4.22 9.397 9.4 0 5.188-4.214 9.4-9.398 9.4zm5.293-6.832c-.284-.155-1.673-.906-1.934-1.012-.265-.106-.455-.16-.658.12s-.78.91-.954 1.096c-.176.186-.345.203-.628.048-.282-.154-1.2-.494-2.264-1.517-.83-.795-1.373-1.76-1.53-2.055-.158-.295 0-.445.15-.584.134-.124.3-.326.45-.488.15-.163.203-.28.306-.47.104-.19.06-.36-.005-.506-.066-.147-.59-1.587-.81-2.173-.218-.586-.46-.498-.63-.505-.168-.007-.358-.038-.55-.045-.19-.007-.51.054-.78.332-.277.274-1.05.943-1.1 2.362-.055 1.418.926 2.826 1.064 3.023.137.2 1.874 3.272 4.76 4.537 2.888 1.264 2.9.878 3.43.85.53-.027 1.734-.633 2-1.297.266-.664.287-1.24.22-1.363-.07-.123-.26-.203-.54-.357z"/></svg>',
			'img_url' => TSS_PLUGINS_URL.'icons/whatsapp.svg',
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
