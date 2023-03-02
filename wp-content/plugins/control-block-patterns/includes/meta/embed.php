<?php 
$pattern_id = $_REQUEST['post'];
if( is_array( $pattern_id ) ) return [];

$shortcode1    = '[control_block_patterns id="' . $pattern_id . '"]';
$shortcode2    = '[control_block_patterns title="' . get_the_title($pattern_id) . '"]';
return array(
    array(
        'id'           => 'pattern_embed_description',        
        'desc' 			=> "<h3>".esc_html__( 'Shortcodes', 'control-block-patterns' )."</h3>
        <p><input type='text' class='widefat' value='".$shortcode1."' onclick='this.select()'></p>or<p><input type='text' class='widefat' value='".$shortcode2."' onclick='this.select()'></p>",
        'type'         => 'custom_html',			
        'rows'         => '8',
        'required'    => 1,
        'class'        => 'no-flex cbp-no-border',
        'tab'         => 'pattern_embed_tab'
    ),
);