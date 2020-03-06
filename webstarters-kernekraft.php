<?php
/**
 * @package           webstarters-kernekraft
 * @version           1.5.1
 * @link              https://webstarters.dk
 *
 * Plugin Name:       Webstarters Kernekraft
 * Plugin URI:        https://webstarters.dk
 * Description:       Et plugin til at understøtte andre plugins fra Webstarters.
 * Version:           1.5.1
 * Author:            Webstarters
 * Author URI:        https://webstarters.dk
 */

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    die;
}

// Load in our stuff.
require_once(dirname(__FILE__) . '/lib/misc.php');
require_once(dirname(__FILE__) . '/lib/shortcodes.php');
require_once(dirname(__FILE__) . '/src/class-ws-fragment-cache.php');

?>