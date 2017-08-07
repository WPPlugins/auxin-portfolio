<?php
/**
 * Load frontend scripts and styles
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2017 
 */

/**
* Constructor
*/
class AUXPFO_Frontend_Assets {


	/**
	 * Construct
	 */
	public function __construct() {

	}

    /**
     * Styles for admin
     *
     * @return void
     */
    public function load_styles() {
        //wp_enqueue_style( AUXPFO_SLUG .'-main',   AUXPFO_PUB_URL . '/assets/css/main.css',  array(), AUXPFO_VERSION );
    }

    /**
     * Scripts for admin
     *
     * @return void
     */
    public function load_scripts() {
        //wp_enqueue_script( AUXPFO_SLUG .'-main', AUXPFO_PUB_URL . '/assets/js/main.js', array('jquery'), AUXPFO_VERSION, true );
    }

}
return new AUXPFO_Frontend_Assets();
