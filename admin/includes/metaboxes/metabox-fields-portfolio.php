<?php
/**
 * Add metabox options for portfolio
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
*/

// no direct access allowed
if ( ! defined('ABSPATH') )  exit;


/*======================================================================*/

function auxin_push_metabox_models_portfolio( $models ){

    // Load general metabox models
    include_once( AUX_CON . 'admin/metaboxes/metabox-fields-general-slider-setting.php' );
    include_once( AUX_CON . 'admin/metaboxes/metabox-fields-general-bg-setting.php'     );
    include_once( AUX_CON . 'admin/metaboxes/metabox-fields-general-title-setting.php'  );
    include_once( AUX_CON . 'admin/metaboxes/metabox-fields-general-advanced.php'       );
    include_once( AUX_CON . 'admin/metaboxes/metabox-fields-general-layout.php'         );

    include_once( 'metabox-fields-portfolio-metadata.php'     );
    include_once( 'metabox-fields-portfolio-related.php'     );

    // Attach general common metabox models to hub
    $models[] = array(
        'model'     => auxin_metabox_fields_general_layout(),
        'priority'  => 10
    );
    $models[] = array(
        'model'     => auxin_metabox_fields_general_title() ,
        'priority'  => 10
    );
    $models[] = array(
        'model'     => auxin_metabox_fields_general_background(),
        'priority'  => 10
    );
    $models[] = array(
        'model'     => auxin_metabox_fields_general_slider(),
        'priority'  => 10
    );
    $models[] = array(
        'model'     => auxin_metabox_fields_general_advanced(),
        'priority'  => 10
    );
    $models[] = array(
        'model'     => auxpfo_metabox_fields_portfolio_metadata(),
        'priority'  => 8
    );
     $models[] = array(
        'model'     => auxpfo_metabox_fields_portfolio_related_metadata(),
        'priority'  => 9
    );

    return $models;
}

add_filter( 'auxin_admin_metabox_models_portfolio', 'auxin_push_metabox_models_portfolio' );



