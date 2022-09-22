<?php
/**
 * Plugin name: Presearch - SearchBar
 * Plugin author: Tijn Hoorneman
 * Plugin URI: https://github.com/tijnski
 * Version: 1
 *
 * Description: Intergrate Presearch on your website.
 *
 * License: GPL2
 * Text Domain: startpage
 *
 * @package Startpage
 */

/**
 * This file loads all the dependencies the Startpage plugin.
 */

defined( 'ABSPATH' ) || exit;

include __DIR__ . '/class-startpage-templates.php';
include __DIR__ . '/class-startpage.php';

add_action( 'plugins_loaded', array( 'Startpage', 'init' ) );
