<?php
if( class_exists('Email_Subscribers')):
class PergoNewsletter extends Email_Subscribers{

	function __construct() {
		add_action( 'init', array( $this, 'create_newsletter_group' ) );		
		add_filter( 'perch_modules/vc/perch_newsletter_form', array( $this, 'vc_list_fields' ) );
		add_filter( 'perch_modules/enable_newsletter_form', array( $this, 'vc_list_fields2' ) );	
	}

	public static function vc_list_fields($params){
		extract(self::newsletter_form_args());
		$array = array(
			array(
                 'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Selected lists', 'pergo' ),
                'param_name' => 'selected_lists',
                'value' => $lists_id_name_map,                   
            ),			
            array(
                'type' => 'checkbox',
                'heading' => __( 'Display list in checkbox', 'pergo' ),
                'param_name' => 'show_list',
                'std' => '0',
                'value' => array( __( 'Checked to enable.', 'pergo' ) => '1' ),  
                'admin_label' => true,               
            ),
            array(
                 'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Display lists', 'pergo' ),
                'param_name' => 'list_ids',
                'value' => $lists_id_name_map, 
                'dependency' => array( 'element' => 'show_list', 'value' => '1', ),
            ),
            array(
                    'type' => 'dropdown',
                    'heading' => __( 'List column', 'pergo' ),
                    'param_name' => 'columns',
                    'std' => '0',
                    'value' => array(
                    	esc_attr__('Initial', 'pergo') => '0',
                    	esc_attr__('Single column', 'pergo') => '1',
                    	esc_attr__('2 column', 'pergo') => '2',
                    	esc_attr__('3 column', 'pergo') => '3',
                    	esc_attr__('4 column', 'pergo') => '4',
                    	esc_attr__('6 column', 'pergo') => '6',
                    ),  
                    'admin_label' => true,
                    'dependency' => array( 'element' => 'show_list', 'value' => '1', ),  
                ),
		);

		return array_merge($params, $array);
	}

	public static function vc_list_fields2($params){
		extract(self::newsletter_form_args());
		$array = array(			
			array(
                 'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Selected lists', 'pergo' ),
                'param_name' => 'selected_lists',
                'value' => $lists_id_name_map, 
                'dependency' => array( 'element' => 'enable_newsletter_form', 'value' => 'yes'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Display list in checkbox', 'pergo' ),
                'param_name' => 'show_list',
                'std' => '0',
                'value' => array( __( 'Checked to enable.', 'pergo' ) => '1' ),  
                'admin_label' => true,    
                'dependency' => array( 'element' => 'enable_newsletter_form', 'value' => 'yes'),           
            ),
            array(
                 'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Display lists', 'pergo' ),
                'param_name' => 'list_ids',
                'value' => $lists_id_name_map, 
                 'dependency' => array( 'element' => 'show_list', 'value' => '1', ), 
            ), 
            array(
                    'type' => 'dropdown',
                    'heading' => __( 'List column', 'pergo' ),
                    'param_name' => 'columns',
                    'std' => '0',
                    'value' => array(
                    	esc_attr__('Initial', 'perch') => '0',
                    	esc_attr__('Single column', 'perch') => '1',
                    	esc_attr__('2 column', 'perch') => '2',
                    	esc_attr__('3 column', 'perch') => '3',
                    	esc_attr__('4 column', 'perch') => '4',
                    	esc_attr__('6 column', 'perch') => '6',
                    ),  
                    'admin_label' => true,
                    'dependency' => array( 'element' => 'show_list', 'value' => '1', ),  
                ),
		);

		return array_merge($params, $array);
	}


	public static function es_get_form_horizontal( $instance ) {

		$es_desc  = $instance['es_desc'];		
		$es_name  = $instance['enable_name'];
		$es_group = $instance['es_group'];
		$es_pre   = $instance['es_pre'];
		$name_placeholder  = $instance['name'];
		$email_placeholder  = $instance['email'];
		$email_wrapper_class = ($es_name == "yes")? 'col-lg-5' : 'col-lg-9';
		$form_extra_class = ($instance['el_class'] != '')? $instance['el_class'] : 'quick-form-horizontal form-holder register-form mb-30';

		$instance['form_extra_class'] = $form_extra_class;	
		$instance['email_placeholder'] = $instance['email'];
		$instance['email_field_before'] = '<div class="'.$email_wrapper_class.'">';	
		$instance['email_field_after'] = '</div>';	
		$instance['name_placeholder'] = $instance['name'];	
		$instance['name_visible'] = $instance['enable_name'];
		$instance['name_field_before'] = '<div class="col-lg-4">';	
		$instance['name_field_after'] = '</div>';	
		$instance['fields_before'] = '<div class="row">';	
		$instance['fields_after'] = '</div>';
		$instance['form_button_style'] = 'text_button';
		$instance['button_field_before'] = '<div class="col-lg-3" style="padding-left: 0">';	
		$instance['button_field_after'] = '</div>';

		ob_start();
		self::render_form($instance);		
      	return $es_form = ob_get_clean();
	}

	public static function es_get_form( $instance ) {
		$instance['form_extra_class'] = 'register-form';	
		$instance['email_placeholder'] = $instance['email'];	
		$instance['name_placeholder'] = $instance['name'];	
		$instance['name_visible'] = $instance['enable_name'];
		$instance['form_button_style'] = 'text_button';	

		ob_start();
		self::render_form($instance);
		return $es_form = ob_get_clean();
	}

	public static function es_get_form_simple( $instance ) {
		
		$es_desc  = $instance['es_desc'];		
		$es_name  = $instance['enable_name'];
		$es_group = $instance['es_group'];
		$es_pre   = $instance['es_pre'];
		$name_placeholder  = $instance['name'];
		$email_placeholder  = $instance['email'];		
		$button_style = $instance['button_style'];
		$button_style = str_replace("btn-","",$button_style).'-color';
		$form_extra_class = ($instance['el_class'] != '')? $instance['el_class'] : 'newsletter-form newsletter-form-simple';

		$instance['form_extra_class'] = $form_extra_class;	
		$instance['email_placeholder'] = $instance['email'];	
		$instance['name_placeholder'] = $instance['name'];	
		$instance['name_visible'] = $instance['enable_name'];
		$instance['fields_before'] = '<div class="input-group">';	
		$instance['fields_after'] = '</div>';	
		$instance['email_field_before'] = '';	
		$instance['email_field_after'] = '';
		$instance['form_button_style'] = ! empty( $instance['form_button_style'] ) ? $instance['form_button_style'] : 'icon';

		ob_start();
		self::render_form($instance);
		return $es_form = ob_get_clean();
	}

	public static function es_get_widget_form( $instance ) {

		$es_desc  = $instance['es_desc'];		
		$es_name  = $instance['enable_name'];
		$es_group = $instance['es_group'];
		$es_pre   = $instance['es_pre'];
		$name_placeholder  = $instance['name'];
		$email_placeholder  = $instance['email'];
		$button_text = $instance['button_text'];
		$button_style = $instance['button_style'];
		$button_style = str_replace("btn-","",$button_style).'-color';
		$form_extra_class = 'newsletter-widget-form newsletter-form footer-form';
		
		$instance['form_extra_class'] = $form_extra_class;	
		$instance['email_placeholder'] = $instance['email'];	
		$instance['name_placeholder'] = $instance['name'];	
		$instance['name_visible'] = false;
		$instance['fields_before'] = '<div class="input-group">';	
		$instance['fields_after'] = '</div>';	
		$instance['email_field_before'] = '';	
		$instance['email_field_after'] = '';
		$instance['form_button_style'] = 'icon';
		$instance['form_button_icon'] = $button_text;

		ob_start();
		self::render_form($instance);
		return $es_form = ob_get_clean();
	}


	/*
	* Newsletter form arguments
	*/
	public static function newsletter_form_args(){
		$theme = wp_get_theme();
		$args = array(			
			'form_class' => array('es_subscription_form', 'es_shortcode_form'),
			'form_extra_class' => '',
			'form_wrapper_class' => array('emaillist'),
			'desc' => '',
			'required_sign' => '*',
			'fields_before' => '',
			'fields_after' => '',
			// name
			'name_visible' => false,
			'name_label_visible' => false,
			'name_label' => esc_attr__( 'Name', 'pergo' ),
			'name_placeholder' => '',
			'name_required' => false,			
			'name_field_before' => '',
			'name_field_after' => '',
			'name_format' => '%1s%2s<input type="text" class="form-control" name="name"%3s/>%4s',

			// email
			'email_visible' => true,
			'email_label_visible' => false,
			'email_label' => esc_attr__( 'Email *', 'pergo' ),
			'email_placeholder' => '',
			'email_required' => true,
			'email_required_sign' => '*',
			'email_field_before' => '',
			'email_field_after' => '',
			'email_format' => '%1s%2s<input type="email" class="es_required_field form-control" name="email"%3s/>%4s',

			// list
			'show_list' => false,
			'list_ids' => (function_exists('ES'))? ES()->lists_db->get_list_id_name_map(): '',
			'list' => 1,
			'columns' => false,
			'selected_lists' => array($theme->get( 'Name' )),

			//button
			'button_class' => array( 'btn', 'es_textbox_button', 'es_submit_button', 'es_subscription_form_submit' ),
			'button_extra_class' => 'btn-lg btn-rose',
			'inline_btn_text' => 'Subscribe',
			'button_field_before' => '',
			'button_field_after' => '',
			'button_text' => 'Subscribe',
			'button_style' => '',
			'form_button_style' => 'icon',
			'form_button_icon' => 'fas fa-arrow-right',
			'button_text_icon' => 'fas fa-angle-double-right',
			'button_text_format' => '%1s<button type="submit" id="%2s" class="%3s" name="es_txt_button">%4s</button>%5s',
			'button_icon_format' => '%1s<span class="input-group-btn"><button type="submit" id="%2s" class="btn btn-simple es_textbox_button es_submit_button" name="es_txt_button" title="%3s"><span class="inline-btn-text">%4s</span><i class="%5s"></i></button></span>%6s',

			// Output order			
			'output_order' => array( 'name_format', 'email_format', 'list_format', 'button_format' ),
			'es_pre' => '',
			'es_group' => '',

		);
		$atts = apply_filters( 'perch_modules/newsletter_form/args', array() );		

		$args += array(
			'form_id' => get_the_ID(),
			'unique_id' => uniqid('wp_knifer_'),
			'current_page' => get_the_ID(),
			'current_page_url' => get_the_permalink( get_the_ID() ),
			'hp_style' => "position:absolute;top:-99999px;" . ( is_rtl() ? 'right' : 'left' ) . ":-99999px;z-index:-99;",
			'nonce' => wp_create_nonce( 'es-subscribe' ),
			'lists_id_name_map' => (function_exists('ES'))? ES()->lists_db->get_list_id_name_map():'',
		);

		return shortcode_atts($args, $atts);
	}



	public static function render_form( $data ) {		

		$data = shortcode_atts(self::newsletter_form_args(), $data);
		$atts = self::validated_atts($data);		
		extract($atts);	

		
		// Compatibility for GDPR
		global $es_includes;		

		// Compatibility for GDPR
		$active_plugins = get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		if ( ! isset( $es_includes ) || $es_includes !== true ) {
			$es_includes = true;
		}
		$form_class[] = $form_extra_class;

		// Form html		
		?>

        <div class="<?php echo implode(' ', $form_wrapper_class) ?>">
            <form action="#" method="post" class="<?php echo implode(' ', $form_class) ?>" id="es_subscription_form_<?php echo $unique_id; ?>" data-source="ig-es">
				<?php if ( $desc != "" ) { ?>
                    <div class="es_caption"><?php echo $desc; ?></div>
				<?php } ?>			
				
				<input type="hidden" name="form_id" value="<?php echo  intval($form_id); ?>" />
                <input type="hidden" name="es_email_page" value="<?php echo $current_page; ?>"/>
                <input type="hidden" name="es_email_page_url" value="<?php echo $current_page_url; ?>"/>
                <input type="hidden" name="status" value="Unconfirmed"/>
                <input type="hidden" name="es-subscribe" id="es-subscribe" value="<?php echo $nonce; ?>"/>
                <label style="<?php echo $hp_style; ?>"><input type="text" name="es_hp_email" class="es_required_field" tabindex="-1" autocomplete="off" value=""/></label>
				<?php do_action( 'es_after_form_fields' ) ?>
				<?php if ( ( in_array( 'gdpr/gdpr.php', $active_plugins ) || array_key_exists( 'gdpr/gdpr.php', $active_plugins ) ) ) {
					echo GDPR::consent_checkboxes();
				} ?>
				<?php echo $fields_before; ?>
				<?php echo self::newsletter_form_name_field($atts); ?>
				<?php echo self::newsletter_form_email_field($atts); ?>				
				<?php echo self::newsletter_form_button_field($atts, $unique_id); ?>				
				<?php echo $fields_after; ?>
				<?php echo self::newsletter_form_list_field($atts); ?>
				
                <span class="es_spinner_image" id="spinner-image"><i class="fa fa-spinner fa-spin fa-lg"></i></span>

            </form>

            <span class="es_subscription_message success" id="es_subscription_message_<?php echo $unique_id; ?>"></span>
        </div>

		<?php
	}

	public static function newsletter_form_list_field($atts){		
		extract($atts);


		if( count($list_ids) == 1 ) $show_list = false; 	
		
		// Lists
		if ( ! empty( $list_ids ) && $show_list ) {						
			$list_html         = self::prepare_lists_checkboxes( $lists_id_name_map, $list_ids, $columns, $selected_lists );

		} elseif ( ! empty( $selected_lists ) && ! $show_list ) {
			$list_html = '';
			foreach ( $lists_id_name_map as $id => $list_name ) {
				$list_html .=  in_array( $list_name, $selected_lists )? '<input type="hidden" name="lists[]" value="' . $id . '" />' : '';
			}
		} elseif ( is_numeric( $list ) ) {
			$list_html = '<input type="hidden" name="lists[]" value="' . $list . '" />';
		} else {
			$list_data = ES_DB_Lists::get_list_by_name( $list );
			if ( empty( $list_data ) ) {
				$list_id = ES_DB_Lists::add_list( $list );
			} else {
				$list_id = $list_data['id'];
			}

			$list_html = '<input type="hidden" name="lists[]" value="' . $list_id . '" />';
		}

		$list_html = apply_filters( 'perch_modules/newsletter_form/list_field', $list_html, $atts );

		return $list_html;
	}


	public static function prepare_lists_checkboxes( $lists, $list_ids = array(), $columns = 3, $selected_lists = array(), $contact_id = 0, $name = "lists[]" ) {
		$lists_html = $columns ? '<div class="row">' : '';
		$i          = 0;

		if ( ! empty( $contact_id ) ) {
			$list_contact_status_map = ES_DB_Lists_Contacts::get_list_contact_status_map( $contact_id );
		}	


		foreach ( $lists as $list_id => $list_name ) {
			
			$status_span = '';
			if ( in_array( $list_name, $list_ids ) ) {
				if ( in_array( $list_name, $selected_lists ) ) {
					$lists_html .= $columns ? '<div class="col-sm-'.(12/$columns).'">' : '';
					if ( ! empty( $contact_id ) ) {
						$status_span = '<span class="es_list_contact_status ' . $list_contact_status_map[ $list_id ] . '" title="' . ucwords( $list_contact_status_map[ $list_id ] ) . '">';
					}
					$lists_html .= $status_span . '<div class="custom-control custom-checkbox"><input type="checkbox" name="' . $name . '" checked="checked" value="' . $list_id . '"  id="customCheck-' . $list_id . '" class="custom-control-input" /><label class="custom-control-label" for="customCheck-' . $list_id . '">' . $list_name . '</label></div>';
					$lists_html .= $columns ? '</div>' : '';
				} else {
					$lists_html .= $columns ? '<div class="col-sm-'.(12/$columns).'">' : '';
					$lists_html .= '
					<div class="custom-control custom-checkbox">
					<input type="checkbox" name="' . $name . '" value="' . $list_id . '" id="customCheck-' . $list_id . '"  class="custom-control-input" />
					<label class="custom-control-label" for="customCheck-' . $list_id . '">' . $list_name . '</label>
					</div>';
					$lists_html .= $columns ? '</div>' : '';
				}
				$i ++;
			}
			
		}

		$lists_html .= $columns ? '</div>' : '';
		

		return $lists_html;
	}

	/**
	* Grenerate newsletter lists
	*/
	public function create_newsletter_group(){	
		$atts = self::newsletter_form_args();
		$lists = isset($atts[ 'list_ids' ])? $atts[ 'list_ids' ] : array();
		if( !empty($lists) ):
			global $wpdb; 
			$table = "{$wpdb->prefix}ig_lists";	
			foreach ($lists as $key => $title) :
				$data = array(
					'name' => $title,
					'slug' => sanitize_title($title),
					'created_at' => current_time( 'mysql' )
				);
				$count = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE name = '$title'");
				if( $count == 0 ) $wpdb->insert( $table, $data );
			endforeach;	
		endif;
	}

	/**
	* Newsletter Name field
	*/
	public static function newsletter_form_name_field($atts){
		extract($atts);
		$output = '';

		if ( $name_visible ) {

			$label = ( $name_label_visible ) ? '<label>'.$name_label.$required_sign.'</label>' : '';
			$placeholder = ( $name_placeholder != '' ) ? ' placeholder="'.esc_attr($name_placeholder).'"' : '';
			$placeholder   .= ( $name_required ) ? ' required="reuired"' : '';

			$output = sprintf( $name_format, $name_field_before, $label, $placeholder, $name_field_after );
		}

		return apply_filters( 'perch_modules/newsletter_form/name_field', $output, $atts );		
	}

	/**
	* Newsletter email field
	*/
	public static function newsletter_form_email_field($atts){
		extract($atts);

		$label = ( $email_label_visible ) ? '<label>'.$email_label.$required_sign.'</label>' : '';
		$placeholder = ( $email_placeholder != '' ) ? ' placeholder="'.esc_attr($email_placeholder).'"' : '';
		$placeholder   .= ( $email_required ) ? ' required="reuired"' : '';

		$output = sprintf( $email_format, $email_field_before, $label, $placeholder, $email_field_after );
		
		return apply_filters( 'perch_modules/newsletter_form/email_field', $output, $atts );
	}

	/**
	* Newsletter button field
	*/
	public static function newsletter_form_button_field($atts, $unique_id){		
		extract($atts);
		$output = '';

		$form_button_id = "es_subscription_form_submit_".$unique_id;
		$btn_atts = array(
    		'type' => 'submit',
    		'id' => $form_button_id,
    		'name' =>"es_txt_button",
    	);

    	if( $form_button_style == 'text_button' ){        	
        	$button_classes = array_filter(array_merge( $button_class, array( $button_style, $button_extra_class)));
        	if( $button_text_icon != '' ) $button_classes[] = 'btn-arrow';        	
        	$form_button_class = implode(' ', $button_classes);

        	$button_icon = ($button_text_icon != '')? ' <i class="'.esc_attr($button_text_icon).'"></i>' : '';
        	$button_text = '<span>'.esc_attr($button_text).$button_icon.'</span>';

        	$output = sprintf( $button_text_format, $button_field_before, $form_button_id, $form_button_class, $button_text, $button_field_after ); 
    	}else{    		
    		$form_button_icon .= str_replace("btn-"," ",$button_style).'-color';    		
		    $output = sprintf( $button_icon_format, $button_field_before, $form_button_id, $button_text, $inline_btn_text, $form_button_icon, $button_field_after );            
    	}

		return apply_filters( 'perch_modules/newsletter_form/button', $output, $atts );		
	}

	public static function prepare_selected_lists_id($selected_lists){
		$_selected = array();
		if( !is_array($selected_lists) && ($selected_lists != '') ){
			$array = explode(',', $selected_lists);
			$list_id_map = ES()->lists_db->get_list_id_name_map();
			foreach ($array as $value) {
				if( isset($list_id_map[$value]) ) $_selected[] = esc_attr($list_id_map[$value]);
			}
			
		}
		return $_selected; 
	}

	private static function validated_atts( $args ){
		$atts = array();
		$array_type = array('form_class', 'form_wrapper_class', 'predefined_lists', 'output_order');
		foreach ($args as $key => $value) {
			// modified list
			if( $key == 'list_ids' ) $value = self::prepare_selected_lists_id($value);
			if( $key == 'selected_lists' ) $value = self::prepare_selected_lists_id($value);

			if( in_array($key, $array_type) && !is_array($value) ){
				$atts[$key] = array($value);
			}else{
				$atts[$key] = $value;
			}
		}

		return $atts;
	}
	
}
new PergoNewsletter();
endif;