<?php
namespace ControlPatterns;
/**
 * Fire on the initialization of Control Patterns.
 */
class Patterns {

    /**
     * Class constructor.
     *
     * This method loads other methods of the class.
     *
     * @access public
     */
    public function __construct() {            
        add_action( 'init', array( $this, 'init' ), 1 );
    }

    /**
     * ControlBlockPatterns loads on the 'after_setup_theme' action.
     *
     * @todo Load immediately.
     *
     * @access public
     * 
     */
    public function init() {      
        define( 'CTRLBP_PATTERNS_VER', CTRLBP_VER );
        define( 'CTRLBP_PATTERNS_DIR',  trailingslashit( CTRLBP_DIR.'classes/Patterns/' ) );
        define( 'CTRLBP_PATTERNS_URI', trailingslashit( CTRLBP_URI.'classes/Patterns/' ) );

       

        require_once  CTRLBP_PATTERNS_DIR .'functions.php';
        require_once CTRLBP_PATTERNS_DIR . 'directory/includes/pattern.php';
      
        // Required Classes 
        new Patterns\AjaxAction;      
        new Patterns\Directory;
        new Patterns\PostType;  
        new Patterns\Core;          
        
        //new Attributes;
        new Patterns\Templates;
        new Patterns\Shortcode;
        new Patterns\Tools;      
         
        
    }

    
        
}