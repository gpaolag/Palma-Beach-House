<?php
namespace ControlPatterns\Settings\Customizer;

class Control extends \WP_Customize_Control {
	public $type = 'meta_box';
	public $meta_box;

	public function render_content() {
		$this->meta_box->show();
		?>
		<input type="hidden" <?php $this->link(); ?>>
		<?php
	}

	public function enqueue() {
		$this->meta_box->enqueue();

		wp_enqueue_style( 'ctrlbp-customizer', CTRLBP_CSS_URI . 'customizer.css', false, time() );
		wp_register_script( 'ctrlbp-serialize-object', CTRLBP_JS_URI . 'jquery.serialize-object.js', ['jquery'], CTRLBP_VER, true );
		wp_enqueue_script( 'ctrlbp-customizer', CTRLBP_JS_URI . 'customizer.js', ['ctrlbp-conditional', 'customize-controls', 'ctrlbp-serialize-object', 'ctrlbp', 'underscore'], CTRLBP_VER, true );

		
		
	}
}