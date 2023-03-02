<div class="wrap">
    <h2><?php echo $this->plugin->displayName; ?> &raquo; <?php esc_html_e( 'Settings', 'perch' ); ?></h2>

    <?php
    if ( isset( $this->message ) ) {
        ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>
        <?php
    }
    if ( isset( $this->errorMessage ) ) {
        ?>
        <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>
        <?php
    }
    ?>

    <div id="poststuff">
    	<div id="post-body" class="metabox-holder columns-2">
    		<!-- Content -->
    		<div id="post-body-content">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
	                <div class="postbox">	                   

	                    <div class="inside">
		                    <form action="options-general.php?page=<?php echo $this->plugin->name; ?>" method="post">
		                    	<p>
		                    		<label for="perch_ihaf_insert_header"><strong><?php esc_html_e( 'Scripts in Header', 'perch' ); ?></strong></label>
		                    		<textarea name="perch_ihaf_insert_header" id="perch_ihaf_insert_header" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['perch_ihaf_insert_header']; ?></textarea>
									<?php
										printf(
											/* translators: %s: The `<head>` tag */
											esc_html__( 'These scripts will be printed in the %s section.', 'perch' ),
											'<code>&lt;head&gt;</code>'
										);
									?>
		                    	</p>
								<?php if ( $this->body_open_supported ) : ?>
								<p>
									<label for="perch_ihaf_insert_body"><strong><?php esc_html_e( 'Scripts in Body', 'perch' ); ?></strong></label>
									<textarea name="perch_ihaf_insert_body" id="perch_ihaf_insert_body" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['perch_ihaf_insert_body']; ?></textarea>
									<?php
										printf(
											/* translators: %s: The `<head>` tag */
											esc_html__( 'These scripts will be printed just below the opening %s tag.', 'perch' ),
											'<code>&lt;body&gt;</code>'
										);
									?>
								</p>
								<?php endif; ?>
								<p>
									<label for="perch_ihaf_insert_footer"><strong><?php esc_html_e( 'Scripts in Footer', 'perch' ); ?></strong></label>
									<textarea name="perch_ihaf_insert_footer" id="perch_ihaf_insert_footer" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['perch_ihaf_insert_footer']; ?></textarea>
									<?php
										printf(
											/* translators: %s: The `</body>` tag */
											esc_html__( 'These scripts will be printed above the closing %s tag.', 'perch' ),
											'<code>&lt;/body&gt;</code>'
										);
									?>
		                    	</p>
		                    	<?php wp_nonce_field( $this->plugin->name, $this->plugin->name . '_nonce' ); ?>
		                    	<p>
									<input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php esc_attr_e( 'Save settings', 'perch' ); ?>" />
								</p>
						    </form>
	                    </div>
	                </div>
	                <!-- /postbox -->
				</div>
				<!-- /normal-sortables -->
    		</div>
    		<!-- /post-body-content -->

    		<!-- Sidebar -->
    		<div id="postbox-container-1" class="postbox-container">
    			<?php require_once( $this->plugin->folder . '/views/sidebar.php' ); ?>
    		</div>
    		<!-- /postbox-container -->
    	</div>
	</div>
</div>
