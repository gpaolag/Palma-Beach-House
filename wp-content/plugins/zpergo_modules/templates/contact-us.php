<?php
add_action( 'vc_load_default_templates_action','pergo_contact_us_template_for_vc' ); // Hook in
function pergo_contact_us_template_for_vc() {
    $data               = array(); // Create new array
    $data['name']       = __( 'Template: Contact Us', 'pergo' ); // Assign name for your custom template
    $data['weight']     = 0; 
    $data['image_path'] = '';
    $data['custom_class'] = ''; // CSS class name
    $data['content']    = <<<CONTENT
    <p>[vc_row][vc_column][pergo_google_map][/vc_column][/vc_row][vc_section parallax="content-moving" parallax_image="http://jthemes.org/wp/pergo/files/images/clouds.jpg" parallax_image_repeat="no-repeat" parallax_image_position="bottom center" parallax_image_attachment="inherit"][vc_row][vc_column][pergo_section_title title="Need Help? Say Hello" subtitle="Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius impedit enim tempor sapien" tag="h2:h2-xs"][/vc_column][/vc_row][vc_row][vc_column width="1/12"][/vc_column][vc_column width="10/12"][vc_row_inner][vc_column_inner width="4/12"][pergo_contact_info css_animation="fadeInUp"][pergo_contact_info title="Contact Phones" subtitle="Phone : +12 3 3456 7890<br />
Fax : +12 9 8765 4321" css_animation="fadeInUp" animation_delay="400"][pergo_contact_info title="Working Hours" subtitle="Mon - Fri: 8:30am - 7:30pm<br />
Sat: 8:30am - 3:30pm" css_animation="fadeInUp" animation_delay="500"][/vc_column_inner][vc_column_inner width="8/12"][contact-form-7 id="144"][/vc_column_inner][/vc_row_inner][vc_empty_space height="20px"][/vc_column][vc_column width="1/12"][/vc_column][/vc_row][/vc_section]</p>

CONTENT;
  
    vc_add_default_templates( $data );   
}

