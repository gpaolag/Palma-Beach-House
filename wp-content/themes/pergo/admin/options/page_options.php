<?php
function pergo_page_options( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'show_breadcrumbs',
            'label' => __( 'Show Breadcrumbs', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'page_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ) 
    );
    return apply_filters( 'pergo_page_options', $options );
}
?>