<?php
foreach ( glob( PERGO_DIR . "/admin/widgets/*.php" ) as $filename ) {
    include $filename;
} //glob( PERGO_DIR . "/admin/widgets/*.php" ) as $filename
if ( !function_exists( 'pergo_custom_register_widgets' ) ):
    function pergo_custom_register_widgets( ) {
        if ( class_exists( 'Pergo_About_me_Widget' ) ) {
            register_widget( 'Pergo_About_me_Widget' );
        } //class_exists( 'Pergo_About_me_Widget' )
        /*if( class_exists('Pergo_Testimonial_Widget') ){         
        register_widget( 'Pergo_Testimonial_Widget' );         
        }        
        */
        if ( class_exists( 'Pergo_Widget_Recent_Posts' ) ) {
            register_widget( 'Pergo_Widget_Recent_Posts' );
        } //class_exists( 'Pergo_Widget_Recent_Posts' )
        if ( class_exists( 'Pergo_How_can_We_Help_Widget' ) ) {
            register_widget( 'Pergo_How_can_We_Help_Widget' );
        } //class_exists( 'Pergo_How_can_We_Help_Widget' )
        if ( class_exists( 'Pergo_Footer_Subscription_Form' ) ) {
            register_widget( 'Pergo_Footer_Subscription_Form' );
        } //class_exists( 'Pergo_Footer_Subscription_Form' )
        if ( class_exists( 'Pergo_Get_In_Touch' ) ) {
            register_widget( 'Pergo_Get_In_Touch' );
        } //class_exists( 'Pergo_Get_In_Touch' )
        if ( class_exists( 'Pergo_Social_links' ) ) {
            register_widget( 'Pergo_Social_links' );
        } //class_exists( 'Pergo_Social_links' )
        if ( class_exists( 'Pergo_Download_link_Widget' ) ) {
            register_widget( 'Pergo_Download_link_Widget' );
        } //class_exists( 'Pergo_Download_link_Widget' )
    }
    add_action( 'widgets_init', 'pergo_custom_register_widgets' );
endif;