<?php
/**
 * Install theme administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once ABSPATH . 'wp-admin/admin.php';
require_once __DIR__ . '/includes/pattern.php';





$title       = __( 'Patterns Directory' );
$parent_file = 'edit.php?post_type=ctrl_block_patterns&page=directory';

wp_reset_vars( array( 'tab' ) );

$tab = empty($tab)? 'new' : $tab;
$paged = empty($paged)? 1 : $paged;

add_thickbox();
?>
<div class="wrap" id="control-block-patterns-directory-wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( $title ); ?></h1>

	

	<hr class="wp-header-end">

	<div class="error hide-if-js">
		<p><?php _e( 'The Theme Installer screen requires JavaScript.' ); ?></p>
	</div>

	

	<h2 class="screen-reader-text hide-if-no-js"><?php _e( 'Filter themes list' ); ?></h2>

	<div class="wp-filter hide-if-no-js">
		<div class="filter-count">
			<span class="count pattern-count"></span>
		</div>

		

		<ul class="filter-links">
			<li><a href="#" data-sort="new"><?php _ex( 'Latest', 'themes' ); ?></a></li>
			<!-- <li><a href="#" data-sort="favorites"><?php //_ex( 'Favorites', 'themes' ); ?></a></li> -->			
		</ul>	


		<form class="search-form search-plugins search-patterns">
			<?php 
			$pattern_catergoies = $this->categories();
			if( !empty($pattern_catergoies) && 0 ): ?>				
				<select name="category" id="cbp-categoryselector">
					<option value="">All Category</option>
					<?php
					foreach ($pattern_catergoies as $key => $category) {	
					$selected = (!empty($_GET['type']) && $_GET['type'] == $category['slug'])? '  selected="selected"' : '';	
						echo '<option value="'.esc_attr($category['slug']).'"'.$selected.'>'.esc_attr($category['name']).'</option>';				
					}
					?>
				</select>
		<?php endif; ?>
		</form>

		<div class="favorites-form">
			<?php
			$action = 'save_wporg_username_' . get_current_user_id();
			if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( wp_unslash( $_GET['_wpnonce'] ), $action ) ) {
				$user = isset( $_GET['user'] ) ? wp_unslash( $_GET['user'] ) : get_user_option( 'wporg_favorites' );
				update_user_meta( get_current_user_id(), 'wporg_favorites', $user );
			} else {
				$user = get_user_option( 'wporg_favorites' );
			}
			?>
			<p class="install-help"><?php _e( 'If you have marked themes as favorites on WordPress.org, you can browse them here.' ); ?></p>

			<p>
				<label for="wporg-username-input"><?php _e( 'Your WordPress.org username:' ); ?></label>
				<input type="hidden" id="wporg-username-nonce" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( $action ) ); ?>" />
				<input type="search" id="wporg-username-input" value="<?php echo esc_attr( $user ); ?>" />
				<input type="button" class="button favorites-form-submit" value="<?php esc_attr_e( 'Get Favorites' ); ?>" />
			</p>
		</div>

		
	</div>
	<h2 class="screen-reader-text hide-if-no-js"><?php _e( 'Themes list' ); ?></h2>
	<div class="cbp-theme-browser theme-browser content-filterable"></div>
	<div class="theme-install-overlay wp-full-overlay expanded"></div>

	<p class="no-themes"><?php _e( 'No themes found. Try a different search.' ); ?></p>
	<span class="spinner"></span>

<?php
if ( $tab ) {
	/**
	 * Fires at the top of each of the tabs on the Install Themes page.
	 *
	 * The dynamic portion of the hook name, `$tab`, refers to the current
	 * theme installation tab.
	 *
	 * Possible hook names include:
	 *
	 *  - `install_themes_dashboard`
	 *  - `install_themes_featured`
	 *  - `install_themes_new`
	 *  - `install_themes_search`
	 *  - `install_themes_updated`
	 *  - `install_themes_upload`
	 *
	 * @since 2.8.0
	 *
	 * @param int $paged Number of the current page of results being viewed.
	 */
	do_action( "cbp_install_patterns_{$tab}", $paged );
}

?>
</div>


<script id="tmpl-theme" type="text/template">
	<div id="ctrl-block-patterns-{{data.pattern_id}}" class="pattern-grid__pattern-frame">
	<# if ( data.content ) { #>
		<div id="patternLoader" class="svg-wrap">
				<img width="100" src="<?php printf( CTRLBP_URI.'assets/img/preloader.svg' ); ?>" />
				<p>Pattern Preview Loading...</p>
			</div>
		<div class="theme-screenshot">
		<div class="pattern-grid__preview">

			<iframe id="iframe-{{data.id}}" frameborder="0" src="<?php printf( CTRLBP_INC_URI.'template-canvas.php?id=%s', '{{data.pattern_id}}' ); ?>"></iframe>
		</div>
		</div>
		
	<# } else { #>
		<div class="theme-screenshot blank"></div>
	<# } #>

	<# if ( data.installed ) { #>
		<div class="notice notice-success notice-alt"><p><?php _ex( 'Installed', 'theme' ); ?></p></div>
	<# } #>


	<span class="more-details"><?php _ex( 'Details &amp; Preview', 'theme' ); ?></span>
	<div class="theme-author">
		<?php
		/* translators: %s: Theme author name. */
		printf( __( 'By %s' ), '{{ data.author }}' );
		?>
	</div>

	<div class="theme-id-container">
		<h3 class="theme-name">{{ data.name }}</h3>

		<div class="theme-actions ">
			<?php
			/* translators: %s: Theme name. */
			$aria_label = sprintf( _x( 'Use the Pattern %s', 'theme' ), '{{ data.name }}' );
			?>
			<a class="button button-primary cpb-insert-pattern" data-source="remote"  data-id="{{ data.pattern_id }}" href="{{ data.install_url }}" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Insert Pattern' ); ?></a>
			<button class="button preview install-theme-preview cbp-pattern-preview"><?php _e( 'Preview' ); ?></button>
		</div>
	</div>
	</div>

</script>

<script id="tmpl-theme-preview" type="text/template">
	<div class="wp-full-overlay-sidebar">
		<div class="wp-full-overlay-header">
			<button class="close-full-overlay"><span class="screen-reader-text"><?php _e( 'Close' ); ?></span></button>
			<button class="previous-theme"><span class="screen-reader-text"><?php _e( 'Previous pattern' ); ?></span></button>
			<button class="next-theme"><span class="screen-reader-text"><?php _e( 'Next pattern' ); ?></span></button>
			<div class="theme-actions">
			<?php
				/* translators: %s: Theme name. */
				$aria_label = sprintf( _x( 'Use the Pattern %s', 'theme' ), '{{ data.name }}' );
				?>
				<a class="button button-primary cpb-insert-pattern" data-source="remote" data-id="{{ data.pattern_id }}" href="{{ data.install_url }}" aria-label="<?php echo esc_attr( $aria_label ); ?>"><?php _e( 'Insert Pattern' ); ?></a>
				
			</div>
		</div>
		<div class="wp-full-overlay-sidebar-content">
			<div class="install-theme-info">
				<h2 class="pattern-name">{{ data.name }}</h2>
				<ul id="misc-publishing-actions" class="cbp-publishing-info">
					<li class="pattern-by">
						<a href="<?php printf( '{{ data.authorAndUri }}' ); ?>">
						<img width="16" src="<?php printf( '{{ data.authorAvatar }}' ); ?>" alt=""></a>
						<?php
						/* translators: %s: Theme author name. */
						printf( 'by {{ data.author }}' );
						?>
					</li>
					<li class="last-modified">
						<span class="dashicons dashicons-calendar"></span> 
						<?php
						/* translators: %s: Theme author name. */
						printf( __( 'Published: %s' ), '{{ data.last_modified }}' );
						?>
						
					</li>
					<li class="theme-details">
						<# if ( data.favorite_count ) { #>
							<span class="dashicons dashicons-heart"></span> 
							<?php
							/* translators: %s: Number of ratings. */
							printf( __( '%s Likes' ), '{{ data.favorite_count }}' );
							?>
								
							
						<# }  #>
					</li>
				</ul>
				<div class="theme-description">{{{ data.description }}}</div>
				
			</div>
		</div>
		<div class="wp-full-overlay-footer">
			<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="<?php esc_attr_e( 'Collapse Sidebar' ); ?>">
				<span class="collapse-sidebar-arrow"></span>
				<span class="collapse-sidebar-label"><?php _e( 'Collapse' ); ?></span>
			</button>
		</div>
	</div>
	<div class="wp-full-overlay-main">
		<div id="patternLoader" class="svg-wrap">
			<img width="100" src="<?php printf( CTRLBP_URI.'assets/img/preloader.svg' ); ?>" />
			<p>Pattern Preview Loading...</p>
		</div>	
		<iframe src="<?php printf( CTRLBP_INC_URI.'template-canvas.php?id=%s', '{{data.pattern_id}}' ); ?>" title="<?php esc_attr_e( 'Preview' ); ?>"></iframe>
	</div>
</script>

