<?php
	$search_placeholder = ot_get_option( 'search_placeholder', 'Search' );
?>
<div id="search-field" class="search-widget">
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>"  role="search" method="get" id="searchform" class="search-form">  
        <div class="input-group mb-3">
		  	<input class="form-control" placeholder="<?php echo sprintf(_x( '%s', 'Search placeholder text', 'pergo'), $search_placeholder) ?>" aria-label="Search" aria-describedby="search-field" type="text" name="s">
		 	<div class="input-group-append">
		    	<button class="btn btn-lightgreen1" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		 	</div>
		</div>
    </form>
</div>

								
	
