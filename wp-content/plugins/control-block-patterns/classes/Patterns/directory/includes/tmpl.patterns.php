<script type="text/html" id="tmpl-customize-themes-details-view">
		<div class="theme-backdrop"></div>
		<div class="theme-wrap wp-clearfix" role="document">
			<div class="theme-header">
				<button type="button" class="left dashicons dashicons-no"><span class="screen-reader-text"><?php _e( 'Show previous theme' ); ?></span></button>
				<button type="button" class="right dashicons dashicons-no"><span class="screen-reader-text"><?php _e( 'Show next theme' ); ?></span></button>
				<button type="button" class="close dashicons dashicons-no"><span class="screen-reader-text"><?php _e( 'Close details dialog' ); ?></span></button>
			</div>
			<div class="theme-about wp-clearfix">
				<div class="theme-screenshots">
				<# if ( data.screenshot && data.screenshot[0] ) { #>
					<div class="screenshot"><img src="{{ data.screenshot[0] }}" alt="" /></div>
				<# } else { #>
					<div class="screenshot blank"></div>
				<# } #>
				</div>

				<div class="theme-info">
					<# if ( data.active ) { #>
						<span class="current-label"><?php _e( 'Current Theme' ); ?></span>
					<# } #>
					<h2 class="theme-name">{{{ data.name }}}<span class="theme-version">
						<?php
						/* translators: %s: Theme version. */
						printf( __( 'Version: %s' ), '{{ data.version }}' );
						?>
					</span></h2>
					<h3 class="theme-author">
						<?php
						/* translators: %s: Theme author link. */
						printf( __( 'By %s' ), '{{{ data.authorAndUri }}}' );
						?>
					</h3>

					<# if ( data.stars && 0 != data.num_ratings ) { #>
						<div class="theme-rating">
							{{{ data.stars }}}
							<a class="num-ratings" target="_blank" href="{{ data.reviews_url }}">
								<?php
								printf(
									'%1$s <span class="screen-reader-text">%2$s</span>',
									/* translators: %s: Number of ratings. */
									sprintf( __( '(%s ratings)' ), '{{ data.num_ratings }}' ),
									/* translators: Accessibility text. */
									__( '(opens in a new tab)' )
								);
								?>
							</a>
						</div>
					<# } #>

					<# if ( data.hasUpdate ) { #>
						<# if ( data.updateResponse.compatibleWP && data.updateResponse.compatiblePHP ) { #>
							<div class="notice notice-warning notice-alt notice-large" data-slug="{{ data.id }}">
								<h3 class="notice-title"><?php _e( 'Update Available' ); ?></h3>
								{{{ data.update }}}
							</div>
						<# } else { #>
							<div class="notice notice-error notice-alt notice-large" data-slug="{{ data.id }}">
								<h3 class="notice-title"><?php _e( 'Update Incompatible' ); ?></h3>
								<p>
									<# if ( ! data.updateResponse.compatibleWP && ! data.updateResponse.compatiblePHP ) { #>
										<?php
										printf(
											/* translators: %s: Theme name. */
											__( 'There is a new version of %s available, but it doesn&#8217;t work with your versions of WordPress and PHP.' ),
											'{{{ data.name }}}'
										);
										if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
											printf(
												/* translators: 1: URL to WordPress Updates screen, 2: URL to Update PHP page. */
												' ' . __( '<a href="%1$s">Please update WordPress</a>, and then <a href="%2$s">learn more about updating PHP</a>.' ),
												self_admin_url( 'update-core.php' ),
												esc_url( wp_get_update_php_url() )
											);
											wp_update_php_annotation( '</p><p><em>', '</em>' );
										} elseif ( current_user_can( 'update_core' ) ) {
											printf(
												/* translators: %s: URL to WordPress Updates screen. */
												' ' . __( '<a href="%s">Please update WordPress</a>.' ),
												self_admin_url( 'update-core.php' )
											);
										} elseif ( current_user_can( 'update_php' ) ) {
											printf(
												/* translators: %s: URL to Update PHP page. */
												' ' . __( '<a href="%s">Learn more about updating PHP</a>.' ),
												esc_url( wp_get_update_php_url() )
											);
											wp_update_php_annotation( '</p><p><em>', '</em>' );
										}
										?>
									<# } else if ( ! data.updateResponse.compatibleWP ) { #>
										<?php
										printf(
											/* translators: %s: Theme name. */
											__( 'There is a new version of %s available, but it doesn&#8217;t work with your version of WordPress.' ),
											'{{{ data.name }}}'
										);
										if ( current_user_can( 'update_core' ) ) {
											printf(
												/* translators: %s: URL to WordPress Updates screen. */
												' ' . __( '<a href="%s">Please update WordPress</a>.' ),
												self_admin_url( 'update-core.php' )
											);
										}
										?>
									<# } else if ( ! data.updateResponse.compatiblePHP ) { #>
										<?php
										printf(
											/* translators: %s: Theme name. */
											__( 'There is a new version of %s available, but it doesn&#8217;t work with your version of PHP.' ),
											'{{{ data.name }}}'
										);
										if ( current_user_can( 'update_php' ) ) {
											printf(
												/* translators: %s: URL to Update PHP page. */
												' ' . __( '<a href="%s">Learn more about updating PHP</a>.' ),
												esc_url( wp_get_update_php_url() )
											);
											wp_update_php_annotation( '</p><p><em>', '</em>' );
										}
										?>
									<# } #>
								</p>
							</div>
						<# } #>
					<# } #>

					<# if ( data.parent ) { #>
						<p class="parent-theme">
							<?php
							printf(
								/* translators: %s: Theme name. */
								__( 'This is a child theme of %s.' ),
								'<strong>{{{ data.parent }}}</strong>'
							);
							?>
						</p>
					<# } #>

					<# if ( ! data.compatibleWP || ! data.compatiblePHP ) { #>
						<div class="notice notice-error notice-alt notice-large"><p>
							<# if ( ! data.compatibleWP && ! data.compatiblePHP ) { #>
								<?php
								_e( 'This theme doesn&#8217;t work with your versions of WordPress and PHP.' );
								if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
									printf(
										/* translators: 1: URL to WordPress Updates screen, 2: URL to Update PHP page. */
										' ' . __( '<a href="%1$s">Please update WordPress</a>, and then <a href="%2$s">learn more about updating PHP</a>.' ),
										self_admin_url( 'update-core.php' ),
										esc_url( wp_get_update_php_url() )
									);
									wp_update_php_annotation( '</p><p><em>', '</em>' );
								} elseif ( current_user_can( 'update_core' ) ) {
									printf(
										/* translators: %s: URL to WordPress Updates screen. */
										' ' . __( '<a href="%s">Please update WordPress</a>.' ),
										self_admin_url( 'update-core.php' )
									);
								} elseif ( current_user_can( 'update_php' ) ) {
									printf(
										/* translators: %s: URL to Update PHP page. */
										' ' . __( '<a href="%s">Learn more about updating PHP</a>.' ),
										esc_url( wp_get_update_php_url() )
									);
									wp_update_php_annotation( '</p><p><em>', '</em>' );
								}
								?>
							<# } else if ( ! data.compatibleWP ) { #>
								<?php
								_e( 'This theme doesn&#8217;t work with your version of WordPress.' );
								if ( current_user_can( 'update_core' ) ) {
									printf(
										/* translators: %s: URL to WordPress Updates screen. */
										' ' . __( '<a href="%s">Please update WordPress</a>.' ),
										self_admin_url( 'update-core.php' )
									);
								}
								?>
							<# } else if ( ! data.compatiblePHP ) { #>
								<?php
								_e( 'This theme doesn&#8217;t work with your version of PHP.' );
								if ( current_user_can( 'update_php' ) ) {
									printf(
										/* translators: %s: URL to Update PHP page. */
										' ' . __( '<a href="%s">Learn more about updating PHP</a>.' ),
										esc_url( wp_get_update_php_url() )
									);
									wp_update_php_annotation( '</p><p><em>', '</em>' );
								}
								?>
							<# } #>
						</p></div>
					<# } #>

					<p class="theme-description">{{{ data.description }}}</p>

					<# if ( data.tags ) { #>
						<p class="theme-tags"><span><?php _e( 'Tags:' ); ?></span> {{{ data.tags }}}</p>
					<# } #>
				</div>
			</div>

			<div class="theme-actions">
				<# if ( data.active ) { #>
					<button type="button" class="button button-primary customize-theme"><?php _e( 'Customize' ); ?></button>
				<# } else if ( 'installed' === data.type ) { #>
					<?php if ( current_user_can( 'delete_themes' ) ) { ?>
						<# if ( data.actions && data.actions['delete'] ) { #>
							<a href="{{{ data.actions['delete'] }}}" data-slug="{{ data.id }}" class="button button-secondary delete-theme"><?php _e( 'Delete' ); ?></a>
						<# } #>
					<?php } ?>

					<# if ( data.compatibleWP && data.compatiblePHP ) { #>
						<button type="button" class="button button-primary preview-theme" data-slug="{{ data.id }}"><?php _e( 'Live Preview' ); ?></button>
					<# } else { #>
						<button class="button button-primary disabled"><?php _e( 'Live Preview' ); ?></button>
					<# } #>
				<# } else { #>
					<# if ( data.compatibleWP && data.compatiblePHP ) { #>
						<button type="button" class="button theme-install" data-slug="{{ data.id }}"><?php _e( 'Install' ); ?></button>
						<button type="button" class="button button-primary theme-install preview" data-slug="{{ data.id }}"><?php _e( 'Install &amp; Preview' ); ?></button>
					<# } else { #>
						<button type="button" class="button disabled"><?php _ex( 'Cannot Install', 'theme' ); ?></button>
						<button type="button" class="button button-primary disabled"><?php _e( 'Install &amp; Preview' ); ?></button>
					<# } #>
				<# } #>
			</div>
		</div>
	</script>