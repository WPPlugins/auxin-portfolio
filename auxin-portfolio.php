<?php
/**
 * Premium Portfolio for Phlox theme
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 *
 * Plugin Name:       Phlox Portfolio
 * Plugin URI:        http://averta.net/phlox/
 * Description:       Showcase your projects beautifully in Phlox theme
 * Version:           0.9.0
 * Author:            averta
 * Author URI:        http://averta.net
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       auxin-portfolio
 * Domain Path:       /languages
 * Tested up to: 	  4.8.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die('No Naughty Business Please !');
}

// Abort loading if WordPress is upgrading
if ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) {
    return;
}

/**
 * Check plugin requirements
 * ===========================================================================*/

// Don't check the requirements if it's frontend or AUXIN_DUBUG set to false
if( is_admin() || false === get_transient( 'auxpfo_plugin_requirements_check' ) ){

    if( ! class_exists( 'Auxin_Plugin_Requirements' ) ){
        require_once( plugin_dir_path( __FILE__ ) . 'includes/classes/class-auxin-plugin-requirements.php' );
    }

    $plugin_requirements = new Auxin_Plugin_Requirements();
    $plugin_requirements->requirements = array(

        'plugins' => array(
            array(
                'name'               => __('Phlox Core Elements', 'auxin-portfolio'), // The plugin name.
                'basename'           => 'auxin-elements/auxin-elements.php', // The plugin basename (typically the folder name and main php file)
                'required'           => true,    // If true, the user will be notified with a notice to install the plugin.
                'version'            => '1.3.10', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
                'dependency'         => true,    // If true, and the plugin is activated, the plugin will be loaded before as a dependeny.
                'is_callable'        => 'AUXELS' // If set, this callable will be be checked for availability to determine if a plugin is active.
            )
        ),

        'themes' => array(
            array(
                'name'               => __('Phlox', 'auxin-portfolio'), // The theme name.
                'version'            => '1.6.9', // E.g. 1.0.0. If set, the active theme must be this version or higher.
                'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a theme is active.
                'file_exists'        => get_template_directory() . '/auxin/auxin-include/auxin.php' // If set, this file will be checked for availability to determine if a theme is active.
            )
        ),

        'php' => array(
            'version' => '5.3.0'    // The minimum PHP version for this plugin, otherwise, throw a notice
        ),

        'config' => array(
            'plugin_name'     =>  __('Phlox Portfolio', 'auxin-portfolio'), // Current plugin name.
            'plugin_basename' => plugin_basename( __FILE__ ),
            'plugin_dir_path' => plugin_dir_path( __FILE__ ),
            'debug'           => false
        )

    );

    // Check the requirements
    $validation = $plugin_requirements->validate();

    // If the requirements were not met, dont initialize the plugin
    if( true !== $validation ){
        return;
    // cache the validation result and skip the extra checks on frontend for cache period
    } else {
        set_transient( 'auxpfo_plugin_requirements_check', true, 15 * MINUTE_IN_SECONDS );
    }
}

/**
 * Initialize the plugin
 * ===========================================================================*/

require_once( plugin_dir_path( __FILE__ ) . 'includes/define.php'     );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-auxpfo.php' );

// Register hooks that are fired when the plugin is activated or deactivated.
register_activation_hook  ( __FILE__, array( 'AUXPFO', 'activate'   ) );
register_deactivation_hook( __FILE__, array( 'AUXPFO', 'deactivate' ) );

/*============================================================================*/
