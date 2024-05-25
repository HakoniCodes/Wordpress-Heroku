<?php 
/**
 * Hakoni
 * @package hakoni
 * @author Makanaokeakua Edwards | Hakoni Software<makridevelopment@gmail.com>
 * @copyright 2024 @ Hakoni Software
 * @license Proprietary
 */
namespace Hakoni\General;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action('admin_menu', __NAMESPACE__ . '\\registerMenus');

$settings = [
	[	
		'label' => 'Authentication',
		'slug' => 'hakoni_authentication_settings',
		'section' => 'default',
		'options' => [
			[
				'type' => 'number',
				'label' => 'Lifetime',
				'slug' => 'session_lifetime',
				'min' => 1000,
				'max' => 60000,
				'placeholder' => 'The life time of this session'
			],
			[
				'type' => 'text',
				'label' => 'Domain',
				'slug' => 'session_domain',
				'placeholder' => 'The domain related to this session'
			],
			[
				'type' => 'text',
				'label' => 'Path',
				'slug' => 'session_path',
				'placeholder' => 'The path related to this session'
			],
			[
				'type' => 'radio',
				'label' => 'Secure',
				'slug' => 'session_secure',
				'placeholder' => 'The security of this session'
			],
			[
				'type' => 'radio',
				'label' => 'Http Only',
				'slug' => 'session_http_only',
				'placeholder' => 'The request type of this session'
			]
		]
	]
];

add_action('admin_init', __NAMESPACE__ . '\\registerAllSettings');

function registerAllSettings() {
	global $settings;

	foreach($settings as $setting) {
		foreach($setting['options'] as $option) {
			$args = [
				'type' => 'String',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => NULL
			];
			register_setting($setting['slug'], $option['slug'], $args);

			add_settings_field($option['slug'], $option['label'], function() use($option) {
				renderField($option);
			}, $setting['slug']);
		}
	}
}

function renderField($option) {
	if(!isset($option['slug'])) return;

	$value = get_option($option['slug']);

	if($option['type'] == 'text') {
		?>
			<input type="text" name="<?php echo $option['slug'] ?>" placeholder="<?php echo $option['placeholder'] ?>" value="<?php echo esc_attr($value) ?>" />
		<?php
	} else if($option['type'] == 'number') {
		?>
			<input type="number" name="<?php echo $option['slug'] ?>" placeholder="<?php echo $option['placeholder'] ?>" value="<?php echo esc_attr($value) ?>" min="<?php echo esc_attr($option['min']) ?>" max="<?php echo esc_attr($option['max']) ?>"/>
		<?php
	} else if($option['type'] == 'radio') {
		?>
			<input type="hidden" name="<?php echo $option['slug'] ?>" placeholder="<?php echo $option['placeholder'] ?>" value="0" />
			<input type="radio" name="<?php echo $option['slug'] ?>" placeholder="<?php echo $option['placeholder'] ?>" value="1" <?php echo ($value == 1 ? 'checked="checked"' : '') ?>/>
		<?php
	}
}
	
function registerMenus() {
	global $settings;

	add_menu_page('Hakoni', 'Hakoni', 'manage_options', 'hakoni_settings_page', __NAMESPACE__ . '\\registerPage', 'dashicons-admin-tools', 1);

	foreach($settings as $key => $setting) {
		add_submenu_page('hakoni_settings_page', $setting['label'], $setting['label'], 'manage_options', $setting['slug'], function() use($setting) {
			registerSettingsPage($setting);
		}, 1, $key);
	}
}

function registerPage() {
	?>
		<h1>Hakoni Settings Page</h1>
	<?php
}

function registerSettingsPage($setting) {
	?>		
		<div class="wrap">
			<h1><?php echo $setting['label'] ?></h1>

			<form action="options.php" method="post">
				<?php settings_fields($setting['slug']); ?>

				<table class="form" role="presentation">
					<?php do_settings_fields($setting['slug'], $setting['section']) ?>
				</table>

				<?php submit_button(); ?>
			</form>
		</div>
	<?php
}
?>