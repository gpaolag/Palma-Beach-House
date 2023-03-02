<?php
namespace ControlPatterns\Patterns;

use WP_Query;

class Tools {
	public function __construct() {
        // Export
		add_filter( 'post_row_actions', [$this, 'add_export_link'], 10, 2 );
		add_action( 'admin_init', [ $this, 'export' ] );

        // Import
        add_action( 'admin_footer-edit.php', [ $this, 'output_js_templates' ] );
		add_action( 'admin_init', [ $this, 'import' ] );

        add_action( 'admin_print_styles-edit.php', [ $this, 'enqueue' ] );

		//ajax action
		add_action( 'wp_ajax_cbp-insert-reusable-blocks', [ $this, 'insert_reusable_blocks' ] );
	}

	public function insert_reusable_blocks(){
		$args = array(
			'numberposts'      => -1,
			'post_type'        => 'wp_block'
		);
		$posts = get_posts($args);
		$response = [
			'success' => false
		];
		if( !empty($posts) ){
			
			foreach ($posts as $key => $post) {
				
				$pattern = array(
					'post_title' => $post->post_title,
					'post_content' => $post->post_content,
					'post_status' => 'publish',
					'post_type' => 'ctrl_block_patterns'
				);	
				$post_id = wp_insert_post( $pattern );	
			}
			$response['success'] = true;
		}	

        wp_send_json_success( $response );
		wp_die();
	}

	public function add_export_link( $actions, $post ) {
		if ( 'ctrl_block_patterns' === $post->post_type ) {
			$actions['export'] = '<a href="' . add_query_arg( ['action' => 'cbp-export', 'post[]' => $post->ID] ) . '">' . esc_html__( 'Export', 'control-block-patterns' ) . '</a>';
		}
		return $actions;
	}

	public function export() {
		$action  = isset( $_REQUEST['action'] ) && 'cbp-export' === $_REQUEST['action'];
		$action2 = isset( $_REQUEST['action2'] ) && 'cbp-export' === $_REQUEST['action2'];

		if ( ( ! $action && ! $action2 ) || empty( $_REQUEST['post'] ) ) {
			return;
		}

		$post_ids = $_REQUEST['post'];

		$query = new WP_Query( [
			'post_type'              => 'ctrl_block_patterns',
			'post__in'               => $post_ids,
			'posts_per_page'         => count( $post_ids ),
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
		] );

		$data = [];
		foreach ( $query->posts as $post ) {
			$meta_input = array();
			$meta_arr = array( 'cbp_content', 'description', 'viewportWidth', 'content_rendered' );
			foreach( $meta_arr as $meta_key ){
                $meta_input[$meta_key] = get_post_meta( $post->ID, $meta_key, true );
			}	
			
            $data[] = array(
                    'ID' => $post->ID,
                    'post_title' => $post->post_title,
                    'post_content' => $post->post_content,
                    'post_status' => $post->post_status,
                    'post_type' => 'ctrl_block_patterns',
                    'meta_input'   => $meta_input
                );
		}

		$file_name = 'control-block-patterns-exported-'.date('m-d-Y');
		if ( count( $post_ids ) === 1 ) {
			$data = reset( $data );
			$file_name = $query->posts[0]->post_name;
		}

		$data = json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

		header( 'Content-Type: application/octet-stream' );
		header( "Content-Disposition: attachment; filename=$file_name.json" );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . strlen( $data ) );
		echo $data;
		die;
	}

    public function output_js_templates() {
		if ( 'edit-ctrl_block_patterns' !== get_current_screen()->id ) {
			return;
		}
		$reusable_blocks = wp_count_posts( 'wp_block' )->publish;
		?>
		<?php if ( isset( $_GET['imported'] ) ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'Block Pattern have been imported successfully!', 'control-block-patterns' ); ?></p></div>
		<?php endif; ?>

		<script type="text/template" id="cbp-import-form">
			<div class="cbp-import-form">
				
				
				<p><?php esc_html_e( 'Choose an exported ".json" file from your computer:', 'control-block-patterns' ); ?></p>
				<form enctype="multipart/form-data" method="post" action="">
					<?php wp_nonce_field( 'import', 'nonce' ); ?>
					<input type="file" name="cbp_file">
					<?php submit_button( esc_attr__( 'Import', 'control-block-patterns' ), 'secondary', 'submit', false, ['disabled' => true] ); ?>
				</form>
				<?php if( $reusable_blocks ): ?>
				<p>or <a href="#" class="cbp-import-reusable-blocks"><?php printf( esc_html__( 'Import all Reusable blocks (%s)', 'control-block-patterns' ), $reusable_blocks); ?></a> </p>
				<?php endif; ?>
			</div>
		</script>
		<?php
	}

	public function import() {
		// No file uploaded.
		if ( empty( $_FILES['cbp_file'] ) || empty( $_FILES['cbp_file']['tmp_name'] ) ) {
			return;
		}

		$url = admin_url( 'edit.php?post_type=ctrl_block_patterns' );

		// Verify nonce.
		$nonce = filter_input( INPUT_POST, 'nonce' );
		if ( ! wp_verify_nonce( $nonce, 'import' ) ) {
			wp_die( sprintf( __( 'Invalid form submit. <a href="%s">Go back</a>.', 'control-block-patterns' ), $url ) );
		}

		$data = file_get_contents( $_FILES['cbp_file']['tmp_name'] );

		$result = $this->import_json( $data );		

		if ( ! $result ) {
			wp_die( sprintf( __( 'Invalid file data. <a href="%s">Go back</a>.', 'control-block-patterns' ), $url ) );
		}

		$url = add_query_arg( 'imported', 'true', $url );
		wp_safe_redirect( $url );
		die;
	}

	private function prepare_posts_data($posts){
		// If import only one post.
		if ( isset( $posts['ID'] ) ) {
			$posts = [ $posts ];
		}

		// If import reusable blocks.
		if ( isset( $posts['__file'] ) && ( $posts['__file'] == 'wp_block' ) ) {
			$posts = array(
					'ID' => NULL,
					'post_title' => $posts['title'],
					'post_content' => $posts['content'],
					'post_status' => 'publish',
					'post_type' => 'ctrl_block_patterns'
				);			
			$posts = [ $posts ];
		}

		

		return $posts;
	}

	/**
	 * Import .json
	 */
	private function import_json( $data ) {
		$posts = json_decode( $data, true );
		if ( json_last_error() !== JSON_ERROR_NONE ) {
			return false;
		}

		// prepare posts data
		$posts = $this->prepare_posts_data($posts);
		

		foreach ( $posts as $post ) {
			unset( $post['ID'] );
			$post_id = wp_insert_post( $post );
			if ( ! $post_id ) {
				wp_die( sprintf( __( 'Cannot import the block pattern <strong>%s</strong>. <a href="%s">Go back</a>.', 'control-block-patterns' ), $post['post_title'], $url ) );
			}
			if ( is_wp_error( $post_id ) ) {
				wp_die( implode( '<br>', $post_id->get_error_messages() ) );
			}
		}

		return true;
	}

    public function enqueue() {
		if ( 'edit-ctrl_block_patterns' !== get_current_screen()->id ) {
			return;
		}

		wp_enqueue_style( 'cbp-list', CTRLBP_CSS_URI . 'list.css', [], CTRLBP_VER );
		wp_enqueue_script( 'cbp-list', CTRLBP_JS_URI . 'list.js', [ 'jquery', 'wp-backbone' ], CTRLBP_VER );
		wp_localize_script( 'cbp-list', 'CBP', [
			'export' => esc_html__( 'Export', 'control-block-patterns' ),
			'import' => esc_html__( 'Import', 'Control-block-patterns' ),
			'directory' => esc_html__( 'Browse Directory', 'Control-block-patterns' ),
			'working' => esc_html__( 'Working...', 'Control-block-patterns' ),
		] );
    }
	
}
