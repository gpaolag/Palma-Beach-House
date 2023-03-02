<?php
add_action( 'vc_load_default_templates_action','pergo_our_team_template_for_vc' ); // Hook in
function pergo_our_team_template_for_vc() {
    $data               = array(); // Create new array
    $data['name']       = __( 'Template: Our team', 'pergo' ); // Assign name for your custom template
    $data['weight']     = 0; 
    $data['image_path'] = '';
    $data['custom_class'] = ''; // CSS class name
    $data['content']    = <<<CONTENT
   [vc_section][vc_row][vc_column][pergo_team_template order="desc" orderby="date"][/vc_column][/vc_row][/vc_section][vc_section bg_class="bg-lightgrey"][vc_row][vc_column][pergo_our_skills title="We're making design better for everyone" params="%5B%7B%22title%22%3A%22Coding%20Knowledge%22%2C%22count%22%3A%22%2097%22%7D%2C%7B%22title%22%3A%22Digital%20Marketing%22%2C%22count%22%3A%2292%22%7D%2C%7B%22title%22%3A%22Front%20End%20Development%22%2C%22count%22%3A%2285%22%7D%2C%7B%22title%22%3A%22WordPress%22%2C%22count%22%3A%2294%22%7D%5D"]An enim nullam tempor sapien gravida donec enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula congue vitae auctor eros erat magna morbi[/pergo_our_skills][/vc_column][/vc_row][/vc_section][vc_section][vc_row][vc_column][pergo_digital_solutions techs_group="%5B%7B%22title%22%3A%22HTML5%22%2C%22icon%22%3A%22fa%20fa-html5%22%7D%2C%7B%22title%22%3A%22CSS3%22%2C%22icon%22%3A%22fa%20fa-css3%22%7D%2C%7B%22title%22%3A%22jsfiddle%22%2C%22icon%22%3A%22fa%20fa-jsfiddle%22%7D%2C%7B%22title%22%3A%22git%22%2C%22icon%22%3A%22fa%20fa-git%22%7D%2C%7B%22title%22%3A%22WordPress%22%2C%22icon%22%3A%22fa%20fa-wordpress%22%7D%2C%7B%22title%22%3A%22mixcloud%22%2C%22icon%22%3A%22fa%20fa-mixcloud%22%7D%5D" params="%5B%7B%22title%22%3A%22HTML5%22%2C%22icon%22%3A%22fa+fa-html5%22%7D%2C%7B%22title%22%3A%22CSS3%22%2C%22icon%22%3A%22fa+fa-css3-alt%22%7D%2C%7B%22title%22%3A%22JavaScripts%22%2C%22icon%22%3A%22fa+fa-js-square%22%7D%2C%7B%22title%22%3A%22PHP%22%2C%22icon%22%3A%22fa+fa-php%22%7D%2C%7B%22title%22%3A%22WordPress%22%2C%22icon%22%3A%22fa+fa-wordpress%22%7D%2C%7B%22title%22%3A%22Sass%22%2C%22icon%22%3A%22fa+fa-sass%22%7D%5D"]An enim nullam tempor sapien gravida donec enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula congue vitae auctor eros erat magna morbi pretium neque[/pergo_digital_solutions][/vc_column][/vc_row][/vc_section][vc_section parallax="content-moving" parallax_image="http://jthemes.org/wp/pergo/files/images/call-to-action.jpg" bg_class="bg-dark" parallax_image_repeat="" parallax_image_position="50% 0" parallax_image_attachment="inherit"][vc_row][vc_column][pergo_call_to_action params="%5B%7B%22icon%22%3A%22fa%20fa-angle-double-right%22%2C%22button_text%22%3A%22Get%20Started%20Now%22%2C%22button_url%22%3A%22%23%22%2C%22button_target%22%3A%22_self%22%2C%22button_size%22%3A%22btn-md%22%7D%5D"][/vc_column][/vc_row][/vc_section]

CONTENT;
  
    vc_add_default_templates( $data );   
}

