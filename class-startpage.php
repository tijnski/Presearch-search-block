<?php
/**
 * Startpage
 *
 * This contains the functions for Startpage.
 *
 * @package Startpage
 */

/**
 * This is the class for the Startpage Plugin.
 *
 * @since 1
 *
 * @package Startpage
 * @author Tijn Hoorneman
 */
class Startpage {

	/**
	 * A reference to the Startpage_Templates object.
	 *
	 * @var Startpage_Templates
	 */
	public $templates;

	/**
	 * Initialize the plugin
	 */
	public static function init() {
		static::get_instance();
	}

	/**
	 * Get the class singleton
	 *
	 * @return Startpage A class instance.
	 */
	public static function get_instance() {
		static $instance;
		if ( ! isset( $instance ) ) {
			$self     = get_called_class();
			$instance = new $self();
		}
		return $instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->templates = new Startpage_Templates( $this );
		$this->register_hooks();
	}

	/**
	 * Register the WordPress hooks
	 */
	private function register_hooks() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_startpage_blocks' ) );
	}

	/**
	 * Register the Gutenberg Block Visibility
	 */
	public function register_startpage_blocks() {
		wp_enqueue_script(
			'startpage-search-engine-form',
			plugins_url( 'blocks/search-engine-form.build.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor' )
		);

		wp_enqueue_style(
			'startpage',
			plugins_url( 'startpage.css', __FILE__ )
		);
	}
}
