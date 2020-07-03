<?php
namespace CTCL\ElectionWebsite;

class Google_Settings extends Settings {

	public static function register_menu() {
		add_submenu_page( 'elections', 'Google', 'Google', 'manage_options', 'google', [ get_called_class(), 'options_page' ] );
	}

	public static function register_settings() {
		add_settings_section(
			'analytics_section',
			'Google Analytics',
			false,
			'google_fields'
		);

		add_settings_section(
			'recaptcha_section',
			'ReCAPTCHA',
			false,
			'google_fields'
		);

		$fields = [
			'analytics_fields' =>
			[
				[
					'uid'         => 'tracking_id',
					'label'       => 'Tracking ID',
					'section'     => 'analytics_section',
					'type'        => 'text',
					'placeholder' => 'UA-123456789-0',
					'label_for'   => 'tracking_id',
				],
			],
			'recaptcha_fields' =>
			[
				[
					'uid'         => 'recaptcha_site_key',
					'label'       => 'Site Key',
					'section'     => 'recaptcha_section',
					'type'        => 'text',
					'placeholder' => 'Site Key',
					'label_for'   => 'recaptcha_site_key',
				],
				[
					'uid'         => 'recaptcha_secret_key',
					'label'       => 'Secret Key',
					'section'     => 'recaptcha_section',
					'type'        => 'text',
					'placeholder' => 'Secret Key',
					'label_for'   => 'recaptcha_secret_key',
				],
			],
		];

		\CTCL\ElectionWebsite\Settings::configure_fields( $fields, 'google_fields' );
	}

	public static function options_page() {
		?>
		<form method="post" action="options.php">
			<h2>Google Settings</h2>
			<?php
				settings_fields( 'google_fields' );
			if ( filter_input( INPUT_GET, 'settings-updated', FILTER_SANITIZE_STRING ) ) {
				self::admin_notice();
			}
				do_settings_sections( 'google_fields' );
				submit_button();
			?>
		</form>
		<?php
	}
}

add_action( 'after_setup_theme', [ '\CTCL\ElectionWebsite\Google_Settings', 'hooks' ] );
