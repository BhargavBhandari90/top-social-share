<?php
/**
 * File to add plugin settings.
 *
 * @since 1.0.0
 * @package TSS\Admin
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) || exit;

/**
 * Load Plugin Settings
 *
 * @package    TSS
 * @subpackage TSS/Admin
 * @author     buddydevelopers <buddydevelopers@gmail.com>
 * @since 2.0.0
 */
class TSS_Settings {

	/**
	 * Plugin settings data array.
	 *
	 * @access  private
	 *
	 * @var Array  $tss_option settings array
	 */
	private $tss_option;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->load();
	}

	/**
	 * Load settings files.
	 */
	public function load() {
		// get the setting data array.
		$this->tss_option = get_option( 'tss_options' );
		/**
		 * Register tss_options_page to the admin_menu action hook
		 */
		add_action( 'admin_menu', array( $this, 'tss_options_page' ) );
		/**
		 * register our tss_settings_init to the admin_init action hook
		 */
		add_action( 'admin_init', array( $this, 'tss_settings_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'tss_enqueue_admin_script' ) );
	}

	/**
	 * Enqueue the wp color picket and the custom script required for the plugin setting.
	 */
	public function tss_enqueue_admin_script() {
		// Css rules for Color Picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'tss-script-handle', TSS_PLUGINS_URL . 'assets/js/scripts.js', array( 'wp-color-picker', 'jquery-ui-sortable' ), TSS_PLUGINS_VERSION, true );
		wp_enqueue_style( 'tss-admin-style-handle', TSS_PLUGINS_URL . 'assets/css/admin-style.css', array(), TSS_PLUGINS_VERSION );
	}

	/**
	 * Create the top level menu
	 */
	public function tss_options_page() {
		// add top level menu page
		add_menu_page(
			__( 'Top Social Sharing Plugin', 'top-social-share' ),
			__( 'Social Sharing', 'top-social-share' ),
			'manage_options',
			'tss',
			array( $this, 'tss_options_page_html_cb' ),
			'dashicons-share'
		);
	} //end tss_options_page

	/**
	 * Top level menu callback function
	 */
	public function tss_options_page_html_cb() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// check if the user have submitted the settings
		// WordPress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'tss_messages', 'tss_message', __( 'Settings Saved', 'top-social-share' ), 'updated' );
		}

		// show error/update messages
		settings_errors( 'tss_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" id="tss_admin_form" method="post">
				<?php
				// output security fields for the registered setting "tss"
				settings_fields( 'tss' );
				// output setting sections and their fields
				// (sections are registered for "tss", each field is registered to a specific section)
				do_settings_sections( 'tss' );
				// output save settings button
				submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Provides default values for the Input Options.
	 */
	public function tss_default_options() {

		$defaults = array(
			'tss_field_post_types_post'                      => '1',
			'tss_field_post_types_page'                      => '1',
			'tss_field_share_buttons_facebook'               => '1',
			'tss_field_share_buttons_twitter'                => '1',
			'tss_field_share_buttons_linkedIn'               => '1',
			'tss_field_share_buttons_pinterest'              => '1',
			'tss_field_share_buttons_whatsapp'               => '1',
			'tss_field_icon_size'                            => 'small',
			'tss_field_icon_style_bg_color'                  => '#000000',
			'tss_field_icon_style'                           => 'original',
			'tss_field_icon_style_foreground'                => 'original',
			'tss_field_icon_style_foreground_color'          => '#8224e3',
			'tss_field_icon_placement_floating_left'         => '1',
		);

		return apply_filters( 'tss_default_options', $defaults );

	} // end tss_default_options

	/**
	 * Initialize custom option and settings
	 */
	public function tss_settings_init() {
		if ( false == $this->tss_option ) {
			add_option( 'tss_options', apply_filters( 'tss_default_options', $this->tss_default_options() ) );
		} // end if

		// register a new setting for "tss" page
		register_setting( 'tss', 'tss_options' );

		// register a new section in the "tss" page
		add_settings_section(
			'tss_section',
			__( 'Settings', 'top-social-share' ),
			array( $this, 'tss_intro_section_cb' ),
			'tss'
		);

		add_settings_field(
			'tss_field_post_types',
			__( 'Post Types', 'top-social-share' ),
			array( $this, 'tss_field_post_types_cb' ),
			'tss',
			'tss_section',
			array(
				'label_for'        => 'tss_field_post_types_',
				'class'            => 'tss_row',
				'tss_custom_data' => 'tss-plugin-post-types',
			)
		);

		add_settings_field(
			'tss_field_share_buttons',
			__( 'Share Buttons', 'top-social-share' ),
			array( $this, 'tss_field_share_buttons_cb' ),
			'tss',
			'tss_section',
			array(
				'label_for'        => 'tss_field_share_buttons',
				'class'            => 'tss_row',
				'tss_custom_data' => 'tss-plugin-share-buttons',
			)
		);

		add_settings_field(
			'tss_field_icon_size',
			__( 'Sharing Icons Size', 'top-social-share' ),
			array( $this, 'tss_field_icon_size_cb' ),
			'tss',
			'tss_section',
			array(
				'label_for'        => 'tss_field_icon_size',
				'class'            => 'tss_row',
				'tss_custom_data' => 'tss-plugin-icon-size',
			)
		);

		add_settings_field(
			'tss_field_icon_style',
			__( 'Sharing Icons Style', 'top-social-share' ),
			array( $this, 'tss_field_icon_style_cb' ),
			'tss',
			'tss_section',
			array(
				'label_for'        => 'tss_field_icon_style',
				'class'            => 'tss_row',
				'tss_custom_data' => 'tss-plugin-icon-style',
			)
		);

		add_settings_field(
			'tss_field_icon_placement',
			__( 'Sharing Icons Placement', 'tss-social-placement' ),
			array( $this, 'tss_field_icon_placement_cb' ),
			'tss',
			'tss_section',
			array(
				'label_for'        => 'tss_field_icon_placement',
				'class'            => 'tss_row',
				'tss_custom_data' => 'tss-plugin-icon-placement',
			)
		);
	} //end tss_settings_init

	/**
	 * Intro section for shortcode
	 *
	 * @param Array $args setting field data
	 */
	public function tss_intro_section_cb( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php echo __( 'Top Social share plugin also provide a shortcode to embed the social sharing buttons in your website content, you can use the <code>[top-share]</code>, and the butttons will appear.', 'top-social-share' ); ?></p>
		<?php
	}

	/**
	 * Post Types Checkboxes
	 *
	 * Input type: checkboxes
	 *
	 * @param $args setting field data
	 */
	public function tss_field_post_types_cb( $args ) {
		// Get the value of the setting we've registered with register_setting()
		$public_post_types = get_post_types( array( 'public' => true ) );

		foreach ( $public_post_types as $post_type ) {

			if ( array_key_exists( 'tss_field_post_types_' . $post_type, $this->tss_option ) ) {
				$is_checked = $this->tss_option[ 'tss_field_post_types_' . $post_type ];
			} else {
				$is_checked = '';
			}

			if ( $post_type != 'attachment' ) {
				?>
				<input type="checkbox" id="<?php echo esc_attr( $args['label_for'] . $post_type ); ?>" name="tss_options[<?php echo esc_attr( $args['label_for'] . $post_type ); ?>]" value="1" <?php checked( 1, $is_checked, true ); ?>/>
				<label for="<?php echo esc_attr( $args['label_for'] . $post_type ); ?>"><?php echo esc_html( ucfirst( $post_type ), 'tss' ); ?></label>
				<?php
			}
		}
	} // end tss_field_post_types_cb

	/**
	 * Share buttons
	 *
	 * @param $args setting field data
	 */
	public function tss_field_share_buttons_cb( $args ) {

		ob_start();
		echo '<p>Choose the services you want below.  Click a chosen service again to remove.  Reorder services by dragging and dropping as they appear above.</p>';
		?>
		<div class="wrap">
			<small><?php _e( 'Enable sharing icons and reorder them here. WhatsApp icon only appear on mobile.', 'social-share-top-tal' ); ?></small>
			<ul class="sharing-icons-lists" id="tss-social-icon-sortable">
				<?php
				$tss_social_buttons = tss_social_sharing_options();
				if ( array_key_exists( 'tss_social_icon_order_1', $this->tss_option ) ) {
					// load reorderd options
					for ( $tss_icon = 0; $tss_icon <= count( $tss_social_buttons ); $tss_icon++ ) {
						if ( array_key_exists( 'tss_social_icon_order_' . $tss_icon, $this->tss_option ) ) {
							$tss_social_icon = $this->tss_option[ 'tss_social_icon_order_' . $tss_icon ];
							if ( ! empty( $tss_social_buttons[ $tss_social_icon ] ) ) {
								$img = ! empty( $tss_social_buttons[ $tss_social_icon ]['img_url'] ) ? '<img src="' . esc_url( $tss_social_buttons[ $tss_social_icon ]['img_url'] ) . '" width="24px" height="24px" style="background-color:' . esc_attr( $tss_social_buttons[ $tss_social_icon ]['bgcolor'] ) . '" />' : '';
								echo '<li data-tss-icon-name="' . esc_attr( $tss_social_icon ) . '"><label><input type="checkbox" name="tss_options[tss_field_share_buttons_' . esc_attr( $tss_social_icon ) . ']" ' . checked( $this->tss_option[ 'tss_field_share_buttons_' . $tss_social_icon ], 1, false ) . ' value="1"> ' . $img . esc_attr( $tss_social_buttons[ $tss_social_icon ]['label'] ) . '</label></li>';
							}
						}
					}
				} else {
					// load default options
					foreach ( $tss_social_buttons as $button_slug => $tss_social_button ) {
						$img = ! empty( $tss_social_button['img_url'] ) ? '<img src="' . esc_url( $tss_social_button['img_url'] ) . '" width="24px" height="24px" style="background-color:' . esc_attr( $tss_social_button['bgcolor'] ) . '" />' : '';
						echo '<li data-tss-icon-name="' . esc_attr( $button_slug ) . '"><label><input type="checkbox" name="tss_options[tss_field_share_buttons_' . esc_attr( $button_slug ) . ']"  ' . checked( $this->tss_option[ 'tss_field_share_buttons_' . $button_slug ], 1, false ) . ' value="1"> ' . $img . esc_attr( $tss_social_button['label'] ) . '</label></li>';
					}
				}
				?>
			</ul>
			<?php
			for ( $tss_icon = 0; $tss_icon <= count( $tss_social_buttons ); $tss_icon++ ) {
				if ( array_key_exists( 'tss_social_icon_order_' . $tss_icon, $this->tss_option ) ) {
					echo '<input class="tss_hidden_options" name="tss_options[tss_social_icon_order_' . $tss_icon . ']" type="hidden" value="' . $this->tss_option[ 'tss_social_icon_order_' . $tss_icon ] . '">';
				}
			}
			?>
		</div>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Add icons size options html
	 *
	 * @param $args setting field data
	 */
	public function tss_field_icon_size_cb( $args ) {
		ob_start();
		?>
		<div class="wrap">
			<small><?php _e( 'Select size for sharing icons', 'social-share-top-tal' ); ?></small>
			<?php

			if ( array_key_exists( 'tss_field_icon_size', $this->tss_option ) ) {
				$is_checked = esc_attr( $this->tss_option['tss_field_icon_size'] );
			} else {
				$is_checked = '';
			}
			?>
			<ul class="tss-icon-size">
				<li>
					<input type="radio" id="<?php echo esc_attr( $args['label_for'] . 'small' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
						value="small" <?php checked( 'small', $is_checked, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . 'small' ); ?>"><?php echo esc_html( 'Small', 'tss' ); ?></label>
				</li>
				<li>
					<input type="radio" id="<?php echo esc_attr( $args['label_for'] . 'medium' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
						value="medium" <?php checked( 'medium', $is_checked, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . 'medium' ); ?>"><?php echo esc_html( 'Medium', 'tss' ); ?></label>
				</li>
				<li>
					<input type="radio" id="<?php echo esc_attr( $args['label_for'] . 'large' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
						value="large" <?php checked( 'large', $is_checked, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . 'large' ); ?>"><?php echo esc_html( 'Large', 'tss' ); ?></label>
				</li>
			</ul>
		</div>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Add options to change colors or social share icons globally.
	 *
	 * @param $args setting field data
	 */
	public function tss_field_icon_style_cb( $args ) {
		ob_start();
		if ( array_key_exists( 'tss_field_icon_style', $this->tss_option ) ) {
			$tss_field_icon_style = esc_attr( $this->tss_option['tss_field_icon_style'] );
		} else {
			$tss_field_icon_style = '';
		}
		if ( array_key_exists( 'tss_field_icon_style_foreground', $this->tss_option ) ) {
			$tss_field_icon_foreground_style = esc_attr( $this->tss_option['tss_field_icon_style_foreground'] );
		} else {
			$tss_field_icon_foreground_style = '';
		}
		?>
		<div class="wrap tss-style-container">
			<small><?php _e( 'Select custom color style for sharing icons', 'social-share-top-tal' ); ?></small>
			<ul>
				<li>
					<label>
						<select class="tss_icon_color"  name="tss_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
							<option value="original" <?php selected( $tss_field_icon_style, 'original' ); ?>>Original</option>
							<option value="custom" <?php selected( $tss_field_icon_style, 'custom' ); ?>>Custom&#8230;</option>
						</select>
						background
					</label>
					<div class="color-field-container"><input name="tss_options[<?php echo esc_attr( $args['label_for'] ) . '_bg_color'; ?>]" class="color-field" type="text" value="<?php echo ! empty( $this->tss_option['tss_field_icon_style_bg_color'] ) ? esc_attr( $this->tss_option['tss_field_icon_style_bg_color'] ) : '#2a2a2a'; ?>" data-default-color="#2a2a2a"></div>
				</li>
				<li>
					<label>
						<select class="tss_icon_color"  name="tss_options[<?php echo esc_attr( $args['label_for'] ) . '_foreground'; ?>]">
							<option value="original"  <?php selected( $tss_field_icon_foreground_style, 'original' ); ?>>Original</option>
							<option value="custom" <?php selected( $tss_field_icon_foreground_style, 'custom' ); ?>>Custom&#8230;</option>
						</select>
						foreground
					</label>
					<div class="color-field-container"><input name="tss_options[<?php echo esc_attr( $args['label_for'] ) . '_foreground_color'; ?>]" class="color-field" type="text" value="<?php echo ! empty( $this->tss_option['tss_field_icon_style_foreground_color'] ) ? esc_attr( $this->tss_option['tss_field_icon_style_foreground_color'] ) : '#ffffff'; ?>" data-default-color="#ffffff"></div>
				</li>
			</ul>
		</div>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Add options for social icons placements
	 *
	 * @param $args setting field data
	 */
	public function tss_field_icon_placement_cb( $args ) {
		ob_start();
		?>
		<div class="wrap">
			<small><?php _e( 'Select placement for the sharing icons', 'social-share-top-tal' ); ?></small>
			<?php

			if ( array_key_exists( 'tss_field_icon_placement_below_post_title', $this->tss_option ) ) {
				$below_post_title = esc_attr( $this->tss_option['tss_field_icon_placement_below_post_title'] );
			} else {
				$below_post_title = '';
			}

			if ( array_key_exists( 'tss_field_icon_placement_floating_left', $this->tss_option ) ) {
				$floating_left = esc_attr( $this->tss_option['tss_field_icon_placement_floating_left'] );
			} else {
				$floating_left = '';
			}

			if ( array_key_exists( 'tss_field_icon_placement_after_post_content', $this->tss_option ) ) {
				$after_post_content = esc_attr( $this->tss_option['tss_field_icon_placement_after_post_content'] );
			} else {
				$after_post_content = '';
			}

			if ( array_key_exists( 'tss_field_icon_placement_inside_feature_image', $this->tss_option ) ) {
				$inside_feature_image = esc_attr( $this->tss_option['tss_field_icon_placement_inside_feature_image'] );
			} else {
				$inside_feature_image = '';
			}
			?>
			<ul class="tss-icon-placement">
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $args['label_for'] . '_floating_left' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] . '_floating_left' ); ?>]"
						value="1" <?php checked( 1, $floating_left, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . '_floating_left' ); ?>"><?php echo esc_html( 'Floating Left (will display on every page, regardless of post type selection above)', 'tss' ); ?></label>
				</li>
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $args['label_for'] . '_below_post_title' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] . '_below_post_title' ); ?>]"
						value="1" <?php checked( 1, $below_post_title, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . '_below_post_title' ); ?>"><?php echo esc_html( 'Below post title, before content.', 'tss' ); ?></label>
				</li>
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $args['label_for'] . '_inside_feature_image' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] . '_inside_feature_image' ); ?>]"
						value="1" <?php checked( 1, $inside_feature_image, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . '_inside_feature_image' ); ?>"><?php echo esc_html( 'Inside Feature Image', 'tss' ); ?></label>
				</li>
				<li>
					<input type="checkbox" id="<?php echo esc_attr( $args['label_for'] . '_after_post_content' ); ?>"
						data-custom="<?php echo esc_attr( $args['tss_custom_data'] ); ?>"
						name="tss_options[<?php echo esc_attr( $args['label_for'] . '_after_post_content' ); ?>]"
						value="1" <?php checked( 1, $after_post_content, true ); ?>/>
					<label for="<?php echo esc_attr( $args['label_for'] . '_after_post_content' ); ?>"><?php echo esc_html( 'After post content', 'tss' ); ?></label><br/>
				</li>
			</ul>
		</div>
		<?php
		echo ob_get_clean();
	}
}
$instance = new TSS_Settings();
