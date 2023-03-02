<?php
$logo  = ot_get_option( 'logo', apply_filters( 'pergo_header_logo_default', PERGO_URI . '/images/logo.png') );
$logo_white= ot_get_option( 'logo_white', apply_filters( 'pergo_header_logo_white_default', PERGO_URI . '/images/logo-white.png') );
$sticky_navbar = ot_get_option( 'header_sticky_nav', 'on' );
$nav_style = ot_get_option( 'nav_style', 'navbar-dark bg-tra' );

$logo = apply_filters( 'pergo_navbar_logo', $logo);
$logo_white = apply_filters( 'pergo_navbar_logo_white', $logo_white);
$sticky_navbar = apply_filters( 'pergo_sticky_navbar', $sticky_navbar);
$nav_style = apply_filters( 'pergo_navbg_style', $nav_style);

if(!PergoHeader::header_banner_is_on() && (PergoHeader::get_shortcode() == false)){
	$nav_style = 'bg-light navbar-light';
}

$classArr = array('navbar', 'navbar-expand-lg' );

$classArr[] = ( $sticky_navbar == 'on' )? ' fixed-top' : '';
$classArr[] = $nav_style;
$classArr[] = ot_get_option('pergo_dropdown_type', 'click-menu');
$classArr = array_filter($classArr); 
$meta = is_page_template('templates/onepage-template.php')? true : false;
$field_id = 'responsive_logo';        
?>
<!-- HEADER
============================================= -->
<header id="header" class="header navbar-style1">
	<nav class="<?php echo implode(' ', $classArr) ?>">
		<div class="container">


			<!-- LOGO IMAGE -->
			<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 284 x 72 pixels) -->
	 		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand logo-white" rel="home"><img src="<?php echo esc_url($logo_white); ?>" height="36" alt="<?php bloginfo( 'name' ); ?>"></a>
	 		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand logo-black" rel="home">
	 			<picture>
	 				<?php do_action( 'pergo_responsive_images_source', $field_id, $meta ); ?>
	 				<img src="<?php echo esc_url($logo); ?>" height="36" alt="<?php bloginfo( 'name' ); ?>">
	 			</picture>
	 		</a>


	 		<!-- Responsive Menu Button -->
	 		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	   		 	<span class="navbar-toggler-icon"></span>
	  		</button>

	  		 <?php 
	  		 $button = PergoHeader::get_nav_button();
	  		 $icons = PergoHeader::header_social_icons();
	  		 $searchicon = PergoHeader::get_searchform();
	  		 $headerinfo = PergoHeader::get_headerinfo();
	  		 $rightnavmenu = PergoHeader::get_rightnavmenu();
	  		 $cart = function_exists('is_woocommerce') ?pergo_get_cart_icon() : '';

	  		 

	          $args = array(
	            'container'       => 'div',
	            'container_id'    => 'navbarSupportedContent',
	            'container_class' => 'collapse navbar-collapse',
	            'menu_class'      => 'navbar-nav ml-auto',
	            'theme_location'  => 'primary',
	            'depth'           => 2,
	            'walker'          => new Pergo_Walker_Menu(),
	            'fallback_cb'     => 'Pergo_Walker_Menu::fallback',
	            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$rightnavmenu.$headerinfo.$searchicon.$cart.$icons.$button.'</ul>',
	          );
	          $args = apply_filters( 'pergo_navbar_style_args', $args ); 
	          if( !function_exists('cool_megamenu') ){
	          		wp_nav_menu( $args );
	          }else{	          	
	          		cool_megamenu( $args );
	          }      
	          
	        ?>

		</div>	  <!-- End container -->
	</nav>	   <!-- End navbar -->
</header>	<!-- END HEADER -->