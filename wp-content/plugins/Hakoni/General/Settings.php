<?php 
/**
 * Hakoni
 * @package hakoni
 * @author Makanaokeakua Edwards | Hakoni Software<makridevelopment@gmail.com>
 * @copyright 2024 @ Hakoni Software
 * @license Proprietary
 */
declare(strict_types=1);

namespace Hakoni\General;

use Hakoni\Classes\Abstracts\Base;

class Settings extends Base {
	public function init() {
		add_action('admin_menu', [$this, 'registerMenus']);
	}

	function registerMenus() {
		add_menu_page('Hakoni', 'Hakoni', 'manage_options', 'hakoni_settings_page', [$this, 'registerPage'], 'dashicons-admin-tools', 1);
		add_submenu_page('hakoni_settings_page', 'Authentication', 'Authentication', 'manage_options', 'hakoni_settings_authentication_page', [$this, 'registerAuthenticationPage'], 1);
	}


	function registerPage() {
		?>
			<h1>Hakoni Settings Page</h1>
		<?php
	}

	function registerAuthenticationPage() {
		?>
			<h1>Authentication Settings Page</h1>
		<?php
	}
}
?>