<?php
function pergo_custom_css( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'custom_css',
            'label' => __( 'Custom css', 'pergo' ),
            'desc' => '',
            'std' => '',
            'type' => 'css',
            'section' => 'custom_css',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ) 
    );
    return apply_filters( 'pergo_custom_css', $options );
}
?>