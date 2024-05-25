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
		'action' =>  __NAMESPACE__ . '\\registerAuthenticationSettingsPage',
		'options' => [
			[
				'type' => 'text',
				'label' => 'Field 1',
				'slug' => 'field_1',
				'placeholder' => 'Field 1 Place Holder Text'
			]
		]
	]
];

add_action('admin_init', __NAMESPACE__ . '\\registerAllSettings');

function registerAllSettings() {
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

	if($option['type'] == 'text') {
		?>
			<input type="text" name="<?php echo $option['slug'] ?>" placeholder="<?php echo $option['placeholder'] ?>"/>
		<?php
	}
}
	
function registerMenus() {
	add_menu_page('Hakoni', 'Hakoni', 'manage_options', 'hakoni_settings_page', __NAMESPACE__ . '\\registerPage', 'dashicons-admin-tools', 1);

	foreach($settings as $setting) {
		add_submenu_page('hakoni_settings_page', $setting['label'], $setting['label'], 'manage_options', $setting['slug'], $setting['action'], 1, 0);
	}
}

function registerPage() {
	?>
		<h1>Hakoni Settings Page</h1>
	<?php
}

function registerSettingsPage() {
	?>		
		<div class="wrap">
			<h1>Authentication Settings</h1>

			<form action="options.php" method="post">
				<?php settings_fields('hakoni_authentication_settings'); ?>

				<table class="form" role="presentation">
					<?php do_settings_fields('hakoni_authentication_settings', 'default') ?>
				</table>

				<?php submit_button(); ?>
			</form>
		</div>
	<?php
}


?>