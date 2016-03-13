<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search">
		<span class="fa fa-search"></span>
		<input id="search" type="search" class="search-field" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'YellowBlog' ); ?>" />
	</label>
	<button type="submit" class="search-submit" style="display: none"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'Yellowblog' ); ?></span></button>
</form>