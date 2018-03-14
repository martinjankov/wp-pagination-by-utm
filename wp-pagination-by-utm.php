<?php
/**
 * Plugin Name: WP Pagination By Utm
 * Description: Shows post as full article by default. If any utm parameter is present in the url, it shows shows post as paginated
 * Author:      Martin Jankov
 * Author URI:  https://martincv.com
 * Version:     1.0.0
 * Text Domain: wpputm
 *
 * WP Pagination By Utm is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * WP Pagination By Utm is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WP Pagination By Utm. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    WPPaginationByUtm
 * @author     Martin Jankov
 * @since      1.0.0
 * @license    GPL-3.0+
 * @copyright  Copyright (c) 2018, Martin Jankov
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

final class WPPaginationByUtm {

	private static $_instance;

	private $_version = '1.0.0';

	public static function instance() {

		if ( ! isset( self::$_instance ) && ! ( self::$_instance instanceof WPPaginationByUtm ) ) {

			self::$_instance = new WPPaginationByUtm;
			self::$_instance->constants();
			self::$_instance->includes();

			add_action( 'plugins_loaded', array( self::$_instance, 'objects' ), 10 );
		}
		return self::$_instance;
	}

	private function includes() {

		// Classes
		require_once WPPUTM_PLUGIN_DIR . 'classes/WPPUTM_Post.php';
	}

	private function constants() {

		// Plugin version
		if ( ! defined( 'WPPUTM_VERSION' ) ) {
			define( 'WPPUTM_VERSION', $this->_version );
		}

		// Plugin Folder Path
		if ( ! defined( 'WPPUTM_PLUGIN_DIR' ) ) {
			define( 'WPPUTM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'WPPUTM_PLUGIN_URL' ) ) {
			define( 'WPPUTM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'WPPUTM_PLUGIN_FILE' ) ) {
			define( 'WPPUTM_PLUGIN_FILE', __FILE__ );
		}
	}

	public function objects() {

		// Global objects
		new WPPUTM_Post;
	}
}

function wpputm() {
	return WPPaginationByUtm::instance();
}
wpputm();
