<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The typography field.
 *
 * @package ControlPatterns
 */

/**
 * The Typography field.
 */
class Typography extends Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {

		$args  = func_get_args();
		$field = reset( $args );
		$color = Color::normalize(
			array(
				'type'          => 'color',
				'id'            => "{$field['id']}_color",
				'field_name'    => "{$field['field_name']}[color]",
				'alpha_channel' => true,
			)
		);
		Color::admin_enqueue_scripts( $color );
		
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field settings.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$meta = wp_parse_args(
			$meta,
			array(
				'font-color'      => '',
				'font-family'      => '',
				'font-size'     => '',
				'font-style' => '',
				'font-variant'   => '',
				'font-weight'       => '',
				'letter-spacing'       => '',
				'line-height'       => '',
				'text-decoration'       => '',
				'text-transform'       => '',
			)
		);

		$output = '<div class="ctrlbp-typography-row">';

		// Color.
		$color   = Color::normalize(
			array(
				'type'          => 'color',
				'id'            => "{$field['id']}_font_color",
				'field_name'    => "{$field['field_name']}[font-color]",
				'alpha_channel' => true,
			)
		);
		$output .= Color::html( $meta['font-color'], $color );

		$output .= '</div><!-- .ctrlbp-typography-row -->';

		$output .= '<div class="ctrlbp-typography-row ctrlbp-row ctrlbp-g-1">';

		// Font family.		
		$output .= '<div class="ctrlbp-col-6">';
		$google_fonts  = Select::normalize(
			array(
				'type'        => 'ctrlbp_fonts',
				'class'        => 'select',
				'id'          => "{$field['id']}_font_family",
				'field_name'  => "{$field['field_name']}[font-family]",
				'placeholder'  => esc_html__( '-- Font-family --', 'control-block-patterns' ),
				'options'  => []
			)
		);
		$output .= Select::html( $meta['font-family'], $google_fonts );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		// Position.
		$position = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_font_size",
				'field_name'  => "{$field['field_name']}[font-size]",
				'placeholder' => esc_html__( '-- Font-size --', 'control-block-patterns' ),
				'options'     => self::range(1, 120, 1, '', 'px'),
			)
		);
		$output  .= Select::html( $meta['font-size'], $position );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';
		

		// Attachment.
		$attachment = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_style",
				'field_name'  => "{$field['field_name']}[font-style]",
				'placeholder' => esc_html__( '-- Font style --', 'control-block-patterns' ),
				'options'     => array(
					'normal'   => esc_html__( 'Normal', 'control-block-patterns' ),
					'italic'  => esc_html__( 'Italic', 'control-block-patterns' ),
					'oblique' => esc_html__( 'Oblique', 'control-block-patterns' ),
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
				),
			)
		);
		$output    .= Select::html( $meta['font-style'], $attachment );

		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		// Size.
		$size    = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_weight",
				'field_name'  => "{$field['field_name']}[font-weight]",
				'placeholder' => esc_html__( '-- Font-weight --', 'control-block-patterns' ),
				'options'     => array(
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
					'100'   => esc_html__( 'Extra Light(100)', 'control-block-patterns' ),
					'300' => esc_html__( 'Light(300)', 'control-block-patterns' ),
					'400' => esc_html__( 'Regular(300)', 'control-block-patterns' ),
					'500' => esc_html__( 'Semi-bold(300)', 'control-block-patterns' ),
					'700' => esc_html__( 'Bold(300)', 'control-block-patterns' ),
					'800' => esc_html__( 'Bolder(300)', 'control-block-patterns' ),
					'900' => esc_html__( '900', 'control-block-patterns' ),
				),
			)
		);
		$output .= Select::html( $meta['font-weight'], $size );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		//variant
		$variant = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_variant",
				'field_name'  => "{$field['field_name']}[font-variant]",
				'placeholder' => esc_html__( '-- Font-variant --', 'control-block-patterns' ),
				'options'     => array(
					'normal'   => esc_html__( 'Normal', 'control-block-patterns' ),
					'small-caps'  => esc_html__( 'Small Caps', 'control-block-patterns' ),
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
				),
			)
		);
		$output .= Select::html( $meta['font-variant'], $variant );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		//letter spacing
		$letter_spacing = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_letter_spacing",
				'field_name'  => "{$field['field_name']}[letter-spacing]",
				'placeholder' => esc_html__( '-- Letter-spacing --', 'control-block-patterns' ),
				'options'     => self::range(-0.09, 0.1, .01, '', 'em')
			)
		);
		$output .= Select::html( $meta['letter-spacing'], $letter_spacing );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		//line height
		$line_height = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_line_height",
				'field_name'  => "{$field['field_name']}[line-height]",
				'placeholder' => esc_html__( '-- Line-height --', 'control-block-patterns' ),
				'options'     => self::range(0, 150, 1, '', 'px')
			)
		);
		$output .= Select::html( $meta['letter-spacing'], $line_height );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		//text decoration
		$text_decoration = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_text_decoration",
				'field_name'  => "{$field['field_name']}[text-decoration]",
				'placeholder' => esc_html__( '-- Text-decoration --', 'control-block-patterns' ),
				'options'     => array(
					'blink'   => esc_html__( 'Blink', 'control-block-patterns' ),
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
					'line-through' => esc_html__( 'Line Through', 'control-block-patterns' ),
					'none' => esc_html__( 'None', 'control-block-patterns' ),
					'overline' => esc_html__( 'Overline', 'control-block-patterns' ),
					'underline' => esc_html__( 'Underline', 'control-block-patterns' ),
				),
			)
		);
		$output .= Select::html( $meta['text-decoration'], $text_decoration );
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-3">';

		//text transform
		$text_transform = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_text_transform",
				'field_name'  => "{$field['field_name']}[text-transform]",
				'placeholder' => esc_html__( '-- Text-transform --', 'control-block-patterns' ),
				'options'     => array(
					'capitalize'   => esc_html__( 'Capitalize', 'control-block-patterns' ),
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
					'lowercase' => esc_html__( 'Lowercase', 'control-block-patterns' ),
					'none' => esc_html__( 'None', 'control-block-patterns' ),
					'uppercase' => esc_html__( 'Uppercase', 'control-block-patterns' ),
				),
			)
		);
		$output .= Select::html( $meta['text-transform'], $text_transform );
		$output .= '</div>';
		$output .= '</div>';

		

		return $output;
	}

	/**
	 * Format a single value for the helper functions. Sub-fields should overwrite this method if necessary.
	 *
	 * @param array    $field   Field parameters.
	 * @param array    $value   The value.
	 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return string
	 */
	public static function format_single_value( $field, $value, $args, $post_id ) {
		if ( empty( $value ) ) {
			return '';
		}
		$output = '';
		$value  = array_filter( $value );
		foreach ( $value as $key => $subvalue ) {
			$subvalue = 'image' === $key ? 'url(' . esc_url( $subvalue ) . ')' : $subvalue;
			$output  .= 'background-' . $key . ': ' . $subvalue . ';';
		}
		return $output;
	}

	private static function range( $start, $limit, $step = 1, $prefix = '', $postfix = '' ) { 
		if ( $step < 0 ) $step = 1;  	  
		$range = range( $start, $limit, $step );
	  
		foreach( $range as $k => $v ) {	  
				  
				$range[$prefix.$v.$postfix] = $prefix.$v.$postfix;
				unset($range[$k]);	  
				  
		}		
	  
		return $range;	  
	}
	
	
}
