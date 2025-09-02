<?php
/**
 * Plugin Name: WooCommerce Product Type Prefix
 * Plugin URI: https://www.bbioon.com
 * Description: Displays WooCommerce product type as a prefix to product names in the admin product list.
 * Version: 1.0.0
 * Author: Ahmad Wael
 * Author URI: https://www.bbioon.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wc-product-type-prefix
 * Domain Path: /languages
 */

declare(strict_types=1);

namespace WCTP;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main plugin class.
 * This class is responsible for initializing the plugin.
 */
class WC_Product_Type_Prefix {
	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	private const VERSION = '1.0.0';

	/**
	 * Plugin instance.
	 *
	 * @var WC_Product_Type_Prefix|null
	 */
	private static $instance = null;

	/**
	 * Get the singleton instance of the plugin.
	 *
	 * @return WC_Product_Type_Prefix
	 */
	public static function get_instance(): WC_Product_Type_Prefix {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin.
	 */
	public function init(): void {
		if ( ! $this->is_woocommerce_active() ) {
			add_action( 'admin_notices', array( $this, 'display_woocommerce_missing_notice' ) );
			return;
		}

		add_filter( 'manage_edit-product_columns', array( $this, 'modify_product_columns' ), 10, 1 );
		add_action( 'manage_product_posts_custom_column', array( $this, 'render_product_name_column' ), 10, 2 );
	}

	/**
	 * Check if WooCommerce is active.
	 *
	 * @return bool
	 */
	private function is_woocommerce_active(): bool {
		return class_exists( 'WooCommerce' );
	}

	/**
	 * Display admin notice if WooCommerce is not installed.
	 */
	public function display_woocommerce_missing_notice(): void {
		?>
		<div class="notice notice-error">
			<p>
				<?php
				esc_html_e(
					'WooCommerce Product Type Prefix plugin requires WooCommerce to be installed and active.',
					'wc-product-type-prefix'
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Modify product columns to adjust name column.
	 *
	 * @param array $columns Existing columns.
	 * @return array Modified columns.
	 */
	public function modify_product_columns( array $columns ): array {
		if ( isset( $columns['name'] ) ) {
			$columns['name'] = esc_html__( 'Product Name (Type)', 'wc-product-type-prefix' );
		}
		return $columns;
	}

	/**
	 * Render the product name column with type prefix.
	 *
	 * @param string $column_name Column name.
	 * @param int    $post_id    Post ID.
	 */
	public function render_product_name_column( string $column_name, int $post_id ): void {
		if ( 'name' !== $column_name ) {
			return;
		}

		$product = wc_get_product( $post_id );
		if ( ! $product ) {
			the_title();
			return;
		}

		$product_type = $this->get_product_type_label( $product );
		$prefix       = sprintf( '<code>%s</code> ', esc_html( $product_type ) );

		// Output prefixed title with proper escaping
		echo wp_kses_post( $prefix );
	}

	/**
	 * Get product type label.
	 *
	 * @param WC_Product $product Product object.
	 * @return string Product type label.
	 */
	private function get_product_type_label( $product ): string {
		$product_type = $product->get_type();

		return ucfirst( $product_type );
	}

	/**
	 * Enqueue admin styles.
	 */
	public function enqueue_styles(): void {
		$screen = get_current_screen();
		if ( $screen && 'edit-product' === $screen->id ) {
			wp_enqueue_style(
				'wc-product-type-prefix',
				plugin_dir_url( __FILE__ ) . 'assets/css/admin.css',
				array(),
				self::VERSION
			);
		}
	}

	/**
	 * Load plugin text domain for translations.
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain(
			'wc-product-type-prefix',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}
}

// Initialize the plugin
WC_Product_Type_Prefix::get_instance();