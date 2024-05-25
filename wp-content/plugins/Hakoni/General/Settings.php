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

use Hakoni\Classes\Base;

class Settings extends Base {
	public function init() {
		add_action('admin_init', [$this, 'registerMenus']);
	}

	function registerMenus() {
		add_menu_page('Settings', 'Settings', 'manage_options', 'hakoni_settings_page', [$this, 'registerPage'], '', 1);
	}


	function registerPage() {
		?>
			<h1>Settings Page</h1>
		<?php
	}
}
?>