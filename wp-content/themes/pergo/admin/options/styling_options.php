<?php
function pergo_styling_options( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'primary_color',
            'label' => __( 'Preset color', 'pergo' ),
            'desc' => '',
            'std' => apply_filters( 'pergo_primary_color_default', '#ff3366'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'primary_color_2',
            'label' => __( 'Preset color dark', 'pergo' ),
            'desc' => '',
            'std' => apply_filters( 'pergo_primary_color_2_default', '#e62354'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'secondary_color',
            'label' => __( 'Dark color', 'pergo' ),
            'desc' => '',
            'std' => apply_filters( 'pergo_dark_color_default', '#2c353f'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'white_color_alt',
            'label' => __( 'Grey color', 'pergo' ),
            'desc' => '',
            'std' => apply_filters( 'pergo_grey_color_default', '#f0f0f0'),
            'type' => 'colorpicker',
            'section' => 'styling_options',
            'operator' => 'and' 
        ) 
    );
    return apply_filters( 'pergo_styling_options', $options );
}
?>