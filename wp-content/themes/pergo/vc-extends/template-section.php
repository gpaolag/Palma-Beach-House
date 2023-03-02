<?php
add_action( 'vc_load_default_templates_action','pergo_template_sections_for_vc' ); // Hook in
function pergo_template_sections_for_vc() {
	$templates = array();
	$empty_value = '';

	$templates['Section: Process Group'] = '[vc_section bg_class="bg-lightgrey" el_id="process"][vc_row][vc_column][pergo_section_title title="Register, Connect, Enjoy Pergo" subtitle="Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, blandit posuere ligula varius magna congue cursus porta"][/pergo_section_title][/vc_column][/vc_row][vc_row][vc_column][perch_process column_sm="4" list_group="%5B%7B%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fnextapp%2Fwp-content%2Fthemes%2Fnextapp%2Fimages%2Ficons%2Fadd-user.png%22%2C%22img_size%22%3A%2270%22%2C%22title%22%3A%22Create%20Account%22%2C%22subtitle%22%3A%22Nemo%20ipsam%20egestas%20volute%20fugit%20dolores%20quaerat%20sodales%22%7D%2C%7B%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fnextapp%2Fwp-content%2Fthemes%2Fnextapp%2Fimages%2Ficons%2Fsettings-1.png%22%2C%22img_size%22%3A%2270%22%2C%22title%22%3A%22Configure%20Profile%22%2C%22subtitle%22%3A%22Nemo%20ipsam%20egestas%20volute%20fugit%20dolores%20quaerat%20sodales%22%7D%2C%7B%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fnextapp%2Fwp-content%2Fthemes%2Fnextapp%2Fimages%2Ficons%2Ffilter.png%22%2C%22img_size%22%3A%2270%22%2C%22title%22%3A%22Sort%20Your%20Files%22%2C%22subtitle%22%3A%22Nemo%20ipsam%20egestas%20volute%20fugit%20dolores%20quaerat%20sodales%22%7D%2C%7B%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fnextapp%2Fwp-content%2Fthemes%2Fnextapp%2Fimages%2Ficons%2Fcloud-computing-3.png%22%2C%22img_size%22%3A%2270%22%2C%22title%22%3A%22Sync%20Your%20Media%22%2C%22subtitle%22%3A%22Nemo%20ipsam%20egestas%20volute%20fugit%20dolores%20quaerat%20sodales%22%7D%5D"][/vc_column][/vc_row][/vc_section]';

	$templates['Section: New Testimonial'] = '[vc_section parallax="content-moving" parallax_image="http://jthemes.org/wp/nextapp/wp-content/themes/nextapp/images/bg-map.png" padding_class="wide-100" bg_class="bg-lightgrey" parallax_image_repeat="" parallax_image_position="50% 0" parallax_image_attachment="inherit" el_id="reviews-2"][vc_row][vc_column][pergo_section_title title="10k+ Customers Love Pergo" subtitle="Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius ullam libero"][/pergo_section_title][/vc_column][/vc_row][vc_row][vc_column width="3/12"][/vc_column][vc_column width="6/12"][pergo_testimonials_single name="@p_paterson" desc="``Egestas egestas magna and vitae purus efficitur ipsum in primis cubilia a laoreet augue congue vitae lobortis magna``"][/vc_column][vc_column width="3/12"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][pergo_testimonials_single image="'.get_template_directory_uri().'/images/review-author-2.jpg" name="@jthemes" desc="`` Mauris donec ociis et magnis sapien etiam sapien sagittis congue augue an orci nullam tempor sapien``"][/vc_column][vc_column width="1/2"][pergo_testimonials_single image="'.get_template_directory_uri().'/images/review-author-3.jpg" name="@lesserpas" desc="``An orci nullam tempor sapien gravida an eget donec auctor ipsum a porta integer justo at odio velna auctor``" css=".vc_custom_1563725100192{margin-top: 60px !important;}"][/vc_column][/vc_row][/vc_section]';
	
	foreach ($templates as $key => $template) {
		$data               = array(); 
	    $data['name']       = esc_attr($key); // Assign name for your custom template
	    $data['weight']     = 0; 
	    $data['image_path'] = '';
	    $data['custom_class'] = ''; // CSS class name
	    $data['content']    = $template;

	    vc_add_default_templates( $data );
	}
      

}



