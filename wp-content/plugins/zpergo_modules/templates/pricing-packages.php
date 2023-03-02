<?php
add_action( 'vc_load_default_templates_action','pergo_pricing_packages_template_for_vc' ); // Hook in
function pergo_pricing_packages_template_for_vc() {
    $data               = array(); // Create new array
    $data['name']       = __( 'Template: Pricing & Packages', 'pergo' ); // Assign name for your custom template
    $data['weight']     = 0; 
    $data['image_path'] = '';
    $data['custom_class'] = ''; // CSS class name
    $data['content']    = <<<CONTENT
  [vc_section bg_class="bg-lightgrey"][vc_row][vc_column][pergo_section_title title="" subtitle="Aliquam orci nullam tempor sapien orci gravida donec enim ipsum porta justo integer at velna vitae auctor integer congue magna"][/vc_column][/vc_row][vc_row][vc_column][vc_tta_tabs spacing="" alignment="center" active_section="1"][vc_tta_section title="Monthly Billing" tab_id="monthly"][vc_row_inner][vc_column_inner width="1/3"][pergo_pricing_table css_animation="fadeInUp" animation_delay="300"]
<ul class="features">
 	<li><strong>10</strong> Users Tasks</li>
 	<li><strong>5 GB</strong> of Storage</li>
 	<li><strong>10 mySQL</strong> Database</li>
 	<li><strong>9/5</strong> Support</li>
</ul>
[/pergo_pricing_table][/vc_column_inner][vc_column_inner width="1/3"][pergo_pricing_table featured="yes" title="Small Business" price="99" css_animation="fadeInUp" animation_delay="400"]
<ul class="features">
 	<li><strong>50</strong> Users Tasks</li>
 	<li><strong>50 GB</strong> of Storage</li>
 	<li><strong>50 mySQL</strong> Database</li>
 	<li><strong>12/7</strong> Support</li>
</ul>
[/pergo_pricing_table][/vc_column_inner][vc_column_inner width="1/3"][pergo_pricing_table title="Corporate Plan" price="189" css_animation="fadeInUp" animation_delay="500"]
<ul class="features">
 	<li><strong>100</strong> Users Tasks</li>
 	<li><strong>100 GB</strong> of Storage</li>
 	<li><strong>50 mySQL</strong> Database</li>
 	<li><strong>24/7</strong> Support</li>
</ul>
[/pergo_pricing_table][/vc_column_inner][/vc_row_inner][/vc_tta_section][vc_tta_section title="Annual Billing save 20%" tab_id="Annual"][vc_row_inner][vc_column_inner width="1/3"][pergo_pricing_table price="24" css_animation="fadeInUp" animation_delay="300"]
<ul class="features">
 	<li><strong>10</strong> Users Tasks</li>
 	<li><strong>5 GB</strong> of Storage</li>
 	<li><strong>10 mySQL</strong> Database</li>
 	<li><strong>9/5</strong> Support</li>
</ul>
[/pergo_pricing_table][/vc_column_inner][vc_column_inner width="1/3"][pergo_pricing_table featured="yes" title="Small Business" price="79" css_animation="fadeInUp" animation_delay="400"]
<ul class="features">
 	<li><strong>10</strong> Users Tasks</li>
 	<li><strong>5 GB</strong> of Storage</li>
 	<li><strong>10 mySQL</strong> Database</li>
 	<li><strong>9/5</strong> Support</li>
</ul>
[/pergo_pricing_table][/vc_column_inner][vc_column_inner width="1/3"][pergo_pricing_table title="Corporate Plan" price="149" css_animation="fadeInUp" animation_delay="500"]
<ul class="features">
 	<li><strong>10</strong> Users Tasks</li>
 	<li><strong>5 GB</strong> of Storage</li>
 	<li><strong>10 mySQL</strong> Database</li>
 	<li><strong>9/5</strong> Support</li>
</ul>
[/pergo_pricing_table][/vc_column_inner][/vc_row_inner][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row][vc_column width="1/12"][/vc_column][vc_column width="10/12"][vc_column_text]
<h4 class="h4-xs animated fadeInUp visible" style="text-align: center;" data-animation="fadeInUp" data-animation-delay="600">All of our Pricing Plans include:</h4>
<div class="row text-left m-top-25 m-bottom-50">
<div class="col-md-6">
<ul class="content-list">
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="600">Quisque lobortis nulla, lacerat iaculis tempus massa</li>
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="700">Semper lacus cursus porta, feugiat primis ultrice ligula risus auctor rhoncus purus ipsum primis</li>
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="800">An enim nullam tempor sapien gravida enim ipsum blandit porta justo integer odio velna</li>
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="900">congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula nisl</li>
</ul>
</div>
<div class="col-md-6">
<ul class="content-list">
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="600">An enim nullam tempor sapien gravida enim ipsum blandit porta justo integer odio velna</li>
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="700">Quisque lobortis nulla, lacerat iaculis tempus massa</li>
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="800">congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula nisl</li>
 	<li class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="900">congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula nisl</li>
</ul>
</div>
</div>
<p class="grey-color animated fadeInUp visible" style="text-align: center;" data-animation="fadeInUp" data-animation-delay="1100">*Not sure which pricing plan's right for you? <span class="dark-color txt-500">You can switch plans any time you need</span></p>
[/vc_column_text][/vc_column][vc_column width="1/12"][/vc_column][/vc_row][/vc_section][vc_section padding_class="wide-100"][vc_row][vc_column][pergo_section_title title="Questions About Pricing Plans?" subtitle="Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius impedit enim tempor sapien" tag="h2:h2-xs"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][pergo_faq css_animation="fadeInUp" animation_delay="200"][pergo_faq css_animation="fadeInUp"][pergo_faq title="An interdum lobortis pretium ornare?" subtitle="Feugiat eros, ac tincidunt ligula massa in faucibus orci luctus et purus pretium ligula posuere cubilia curae" css_animation="fadeInUp" animation_delay="400"][pergo_faq title="Interdum lobortis pretium ornare?" subtitle="Praesent semper, lacus sed cursus porta, odio augue ligula massa risus laoreet. Laoreet auctor massa varius egestas amet mauris suscipit semper lacus sed cursus porta primis" css_animation="fadeInUp" animation_delay="500"][/vc_column][vc_column width="1/2"][pergo_faq title="Aliquam dapibus pretium ornare?" css_animation="fadeInUp" animation_delay="200"][pergo_faq title="Pretium purus lacus tempor an ipsum vitae augue egestas emo ligula?" subtitle="Praesent semper lacus sed cursus porta, feugiat primis in orci luctus ligula egestas volute turpis quaerat sodales sapien orci luctus et ultrices ante ipsum primis in amet in odio." css_animation="fadeInUp"][pergo_faq title="Dapibus lobortis pretium ornare?" subtitle="Semper lacus sed cursus porta,feugiat primis in egestas volute turpis quaerat sodales sapien ligula ultrice egesta magna" css_animation="fadeInUp" animation_delay="400"][pergo_faq title="Interdum lobortis pretium ornare?" subtitle="Feugiat eros, ac tincidunt ligula massa in faucibus orci luctus et ultrices posuere cubilia curae integer congue leo metus" css_animation="fadeInUp" animation_delay="500"][/vc_column][/vc_row][vc_row][vc_column][pergo_more_question_button params="%5B%7B%22icon%22%3A%22fa%20fa-angle-double-right%22%2C%22button_text%22%3A%22Ask%20Your%20Question%20Here%22%2C%22button_url%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fcontact-us%2F%22%2C%22button_target%22%3A%22_self%22%7D%5D" css_animation="fadeInUp" animation_delay="800"][/vc_column][/vc_row][/vc_section][vc_section parallax="content-moving" parallax_image="http://jthemes.org/wp/pergo/files/images/brands.jpg" padding_class="wide-70" bg_class="bg-dark" parallax_image_repeat="" parallax_image_position="50% 0" parallax_image_attachment="inherit" css=".vc_custom_1533704378990{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_row][vc_column][pergo_section_title title="Trusted by thousands of companies" subtitle="Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius augue luctus donec volutpat sapien"][pergo_our_clients params="%5B%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-11.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-17.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-13.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-18.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-19.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-16.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-14.png%22%7D%2C%7B%22title%22%3A%22Brand%20image%22%2C%22image%22%3A%22http%3A%2F%2Fjthemes.org%2Fwp%2Fpergo%2Fstartup%2Fwp-content%2Fthemes%2Fpergo%2Fimages%2Fbrand-15.png%22%7D%5D"][/vc_column][/vc_row][/vc_section]

CONTENT;
  
    vc_add_default_templates( $data );   
}

