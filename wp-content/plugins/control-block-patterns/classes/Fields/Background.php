<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The background field.
 *
 * @package ControlPatterns
 */

/**
 * The Background field.
 */
class Background extends Field {
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
		File_Input::admin_enqueue_scripts();
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
				'color'      => '',
				'image'      => '',
				'repeat'     => '',
				'attachment' => '',
				'position'   => '',
				'size'       => '',
			)
		);

		$output = '<div class="ctrlbp-background-row">';

		// Image.
		$image   = File_Input::normalize(
			array(
				'type'        => 'file_input',
				'id'          => "{$field['id']}_image",
				'field_name'  => "{$field['field_name']}[image]",
				'placeholder' => __( 'Background Image', 'control-block-patterns' ),
			)
		);
		$output .= File_Input::html( $meta['image'], $image );

		$output .= '</div><!-- .ctrlbp-background-row -->';

		
		
		$output .= '<div class="ctrlbp-background-row">';

		// Color.
		$color   = Color::normalize(
			array(
				'type'          => 'color',
				'id'            => "{$field['id']}_color",
				'field_name'    => "{$field['field_name']}[color]",
				'alpha_channel' => true,
			)
		);
		$output .= Color::html( $meta['color'], $color );

		// Repeat.
		$repeat  = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_repeat",
				'field_name'  => "{$field['field_name']}[repeat]",
				'placeholder' => esc_html__( '-- Repeat --', 'control-block-patterns' ),
				'options'     => array(
					'no-repeat' => esc_html__( 'No Repeat', 'control-block-patterns' ),
					'repeat'    => esc_html__( 'Repeat All', 'control-block-patterns' ),
					'repeat-x'  => esc_html__( 'Repeat Horizontally', 'control-block-patterns' ),
					'repeat-y'  => esc_html__( 'Repeat Vertically', 'control-block-patterns' ),
					'inherit'   => esc_html__( 'Inherit', 'control-block-patterns' ),
				),
			)
		);
		$output .= Select::html( $meta['repeat'], $repeat );

		// Position.
		$position = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_position",
				'field_name'  => "{$field['field_name']}[position]",
				'placeholder' => esc_html__( '-- Position --', 'control-block-patterns' ),
				'options'     => array(
					'top left'      => esc_html__( 'Top Left', 'control-block-patterns' ),
					'top center'    => esc_html__( 'Top Center', 'control-block-patterns' ),
					'top right'     => esc_html__( 'Top Right', 'control-block-patterns' ),
					'center left'   => esc_html__( 'Center Left', 'control-block-patterns' ),
					'center center' => esc_html__( 'Center Center', 'control-block-patterns' ),
					'center right'  => esc_html__( 'Center Right', 'control-block-patterns' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'control-block-patterns' ),
					'bottom center' => esc_html__( 'Bottom Center', 'control-block-patterns' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'control-block-patterns' ),
				),
			)
		);
		$output  .= Select::html( $meta['position'], $position );

		// Attachment.
		$attachment = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_attachment",
				'field_name'  => "{$field['field_name']}[attachment]",
				'placeholder' => esc_html__( '-- Attachment --', 'control-block-patterns' ),
				'options'     => array(
					'fixed'   => esc_html__( 'Fixed', 'control-block-patterns' ),
					'scroll'  => esc_html__( 'Scroll', 'control-block-patterns' ),
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
				),
			)
		);
		$output    .= Select::html( $meta['attachment'], $attachment );

		// Size.
		$size    = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_size",
				'field_name'  => "{$field['field_name']}[size]",
				'placeholder' => esc_html__( '-- Size --', 'control-block-patterns' ),
				'options'     => array(
					'inherit' => esc_html__( 'Inherit', 'control-block-patterns' ),
					'cover'   => esc_html__( 'Cover', 'control-block-patterns' ),
					'contain' => esc_html__( 'Contain', 'control-block-patterns' ),
				),
			)
		);
		$output .= Select::html( $meta['size'], $size );
		$output .= '</div><!-- .ctrlbp-background-row -->';

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
}
