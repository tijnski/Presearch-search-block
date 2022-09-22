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
class Startpage_Templates {
	/**
	 * Contains a reference to the Startpage class.
	 *
	 * @var Startpage
	 */
	private $startpage;

	/**
	 * Contains the available templates
	 */
	private $templates = array(
		'minimalist' => 'Minimalist Startpage',
		'bliphome'   => 'Bliphome Startpage',
	);

	/**
	 * Constructor
	 */
	public function __construct( Startpage $startpage ) {
		$this->startpage = $startpage;
		$this->register_hooks();
	}

	/**
	 * Register the WordPress hooks
	 */
	private function register_hooks() {
		add_filter( 'theme_page_templates', array( $this, 'add_templates' ) );
		add_filter( 'wp_insert_post_data', array( $this, 'register_templates' ) );
		add_filter( 'template_include', array( $this, 'view_project_template' ) );
	}

	/**
	 * Adds our templates to the Page Template dropdown.
	 */
	public function add_templates( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	public function register_templates( $attributes ) {
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = $this->templates;
		} else {
			$templates = array_merge( $templates, $this->templates );
		}

		wp_cache_set( 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() ), $templates, 'themes', 1800 );

		return $attributes;
	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {
		$post_id = get_the_ID();
		if ( $post_id ) {
			$page_template = get_post_meta( $post_id, '_wp_page_template', true );
			if ( isset( $this->templates[ $page_template ] ) ) {
				return plugin_dir_path( __FILE__ ) . '/templates/' . $page_template . '/index.php';
			}
		}
		return $template;
	}
}
