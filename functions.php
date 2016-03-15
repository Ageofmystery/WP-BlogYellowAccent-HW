<?php

function loadResources() {
	//style
	wp_enqueue_style( 'bootstrap' , get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css');
	wp_enqueue_style( 'flexboxgrid' , get_template_directory_uri() . '/bower_components/flexboxgrid/dist/flexboxgrid.min.css');
	wp_enqueue_style( 'fontawesome' , get_template_directory_uri() . '/bower_components/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style( 'style', get_stylesheet_uri());
	//scripts
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js','','',true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.min.js','','',true);
	wp_enqueue_script( 'prime-script', get_template_directory_uri() . '/js/theme-function.js','','',true);
}
add_action('wp_enqueue_scripts', 'loadResources');

//live prev js
function live_preview_customizer() {
	wp_enqueue_script('theme_customize', get_template_directory_uri().'/js/theme-customize.js', array( 'jquery','customize-preview' ),'', true);
}
add_action( 'customize_preview_init', 'live_preview_customizer' );

//enable img-thumb
if (function_exists('add_theme_support')) add_theme_support('post-thumbnails');
add_image_size( 'carousel-thumb', 692, 250, true );

//register menus
register_nav_menus([
	'primary' => 'Header',
	'secondary' => 'Subheader',
	'last' => 'Footer'
]);

//limiting words in content
function new_excerpt_length($length) {
	return 75;
}
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', function($more) {
	return '...';
});

//widget footer-social
register_sidebar([
	'id' => 'widget-zone-footer',
	'name' => 'Зона соц. иконок',
	'description' => 'Иконки фонтавесоме',
	'class' => '',
	'before_widget' => '<div class="sc-block">',
	'after_widget' => "</div>\n",
]);

//widget content-share
register_sidebar([
	'id' => 'widget-header-search',
	'name' => 'Head search',
	'description' => 'Form search in header',
	'class' => '',
	'before_widget' => '',
	'after_widget' => "",
]);

//prime sidebar
register_sidebar([
	'id' => 'prime_bar',
	'name' => 'Prime sidebar',
	'description' => 'Prime sidebar of blog',
	'class' => '',
	'before_widget' => '<div id="%1$s" class="widget-cat %2$s">',
	'after_widget' => "</div>\n",
	'before_title' => '<h5 class="text-uppercase aside-head">',
	'after_title' => "</h5>\n",
]);

//widget subscribe
register_sidebar([
	'id' => 'subscribe',
	'name' => 'MailChimp',
	'description' => 'Form news subscribe',
	'class' => '',
	'before_widget' => '',
	'after_widget' => "",
	'before_title' => '',
	'after_title' => "",
]);

//widget subscribe
register_sidebar([
	'id' => 'contact_form',
	'name' => 'Contact form',
	'description' => 'About contact form',
	'class' => '',
	'before_widget' => '',
	'after_widget' => "",
	'before_title' => '<h3 class="article-primehead">',
	'after_title' => "</h3>",
]);

//pagination changes
function my_navigation_template( $template, $class ){
	return '<nav class="navigation row end-xs %1$s" role="navigation"><div class="nav-links row">%3$s</div></nav>';
}
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );

//carousel post-type
function carousel_generic() {
	$args = array(
		'label' => 'Bootstrap carousel',
		'singular_label' => 'One slide',
		'public' => true,
		'show_ui' => true,
		'supports' => array( 'thumbnail', 'title', 'custom-fields', 'editor')
	);
	register_post_type( 'carousel' , $args ); }
add_action('init', 'carousel_generic');

//gallery post-type
function gallery_posts() {
	$args = array(
		'label' => 'Galleries',
		'singular_label' => 'One gallery slide',
		'public' => true,
		'show_ui' => true,
		'hierarchical' => true,
		'has_archive' => false,
		'supports' => array( 'thumbnail', 'title', 'editor')
	);
	register_post_type( 'gallery' , $args ); }
add_action('init', 'gallery_posts');

//add category class in single-post
function addCatClassInSinglePost($output) {
	global $post;
	if (is_single()) :
		$categories = wp_get_post_categories($post->ID);
		if ($categories) {
			foreach ($categories as $value) {
				if (preg_match('#item-' . $value . '">#', $output)) {
					$output = str_replace('item-' . $value . '">', 'item-' . $value . ' current-cat">', $output);
				}
			}
		}
	endif;
	return $output;
}
add_filter('wp_list_categories','addCatClassInSinglePost');

//popular posts
function most_commented_posts($post_num=10, $format='', $days=0, $cache='', $post_type='post'){
	global $wpdb;
	if( $cache ){
		$key = (string) md5( $post_num . $format . $days . $post_type );
		if ( $cache_out = wp_cache_get($key, __FUNCTION__) )
			return $cache_out;
	}
	if($days){
		$AND_days = "AND post_date > CURDATE() - INTERVAL $days DAY";
		if(strlen($days)==4)
			$AND_days = "AND YEAR(post_date)=" . trim($days);
	}
	$sql = "SELECT ID, post_title, post_date, comment_count, guid
		FROM $wpdb->posts p
		WHERE post_status = 'publish' AND post_type = '$post_type' $AND_days
		ORDER BY comment_count DESC ".
		($post_num ? " LIMIT $post_num" : '');
	$res = $wpdb->get_results($sql);
	if(!$res) return false;
	if( $format ) preg_match ('!{date:(.*?)}!', $format, $date_m);
	foreach ($res as $pst){
		if($pst->comment_count==0) continue;
		$x == 'li1' ? $x = 'li2' : $x = 'li1';
		$title = esc_attr($pst->post_title);
		$a = "<a class='article-head' href='". get_permalink($pst->ID) ."' title='$title'>";
		$Sformat = "$a$title</a>";
		if($format){
			$replacement = array(
				'{title}'     => $title
			,'{a}'        => $a
			,'{/a}'       => '</a>'
			,'{comments}' => $pst->comment_count
			);
			if($date_m)
				$replacement[$date_m[0]] = apply_filters('the_time', mysql2date($date_m[1], $pst->post_date));
			$Sformat = strtr($format, $replacement);
		}
		$out .= "<li class='$x'>$Sformat</li>";
	}
	if( !$out )
		return "<li><p class='text-desc'>No posts with comments</p></li>";
	if( $cache )
		wp_cache_add($key, $out, __FUNCTION__);
	return $out;
}

//count categories in span
function cat_count_span($links) {
	$links = str_replace('<a ', '<a class="text-desc"', $links);
	$links = str_replace('</a> (', '</a> <span class="num-cat">(', $links);
	$links = str_replace(')', ')</span>', $links);
	return $links;
}
add_filter('wp_list_categories', 'cat_count_span');

//customise function
function customize_theme_options( $wp_customize ) {
	$col_yellow = #ffffff

//logotype name
	$wp_customize->add_setting( 'logo_name_set' , array(
		'default'     => 'Blog',
		'transport'=>'refresh',
	) );
	$wp_customize->add_section( 'logo_name_sec' , array(
		'title'      => __( 'Logotype', 'mytheme' ),
		'priority'   => 100,
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_name_set', array(
		'label'        => __( 'Logo name', 'mytheme' ),
		'section'    => 'logo_name_sec',
		'settings'   => 'logo_name_set',
	) ) );
//logotype color
	$wp_customize->add_setting( 'logo_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logo_color_set', array(
		'label'        => __( 'Logo color', 'mytheme' ),
		'section'    => 'logo_name_sec',
		'settings'   => 'logo_color_set',
	) ) );
//header menu color
	$wp_customize->add_setting( 'header_menu_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_section( 'elements_color_sec' , array(
		'title'      => __( 'Styling color of page elements', 'mytheme' ),
		'priority'   => 100,
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_menu_color_set', array(
		'label'        => __( 'Top menu color', 'mytheme' ),
		'section'    => 'elements_color_sec',
		'settings'   => 'header_menu_color_set',
	) ) );
//carousel color
	$wp_customize->add_setting( 'carousel_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'carousel_color_set', array(
		'label'        => __( 'Carousel elements color', 'mytheme' ),
		'section'    => 'elements_color_sec',
		'settings'   => 'carousel_color_set',
	) ) );
//button color
	$wp_customize->add_setting( 'button_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_color_set', array(
		'label'        => __( 'Button background', 'mytheme' ),
		'section'    => 'elements_color_sec',
		'settings'   => 'button_color_set',
	) ) );
//block most-popular color
	$wp_customize->add_setting( 'most_popular_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'most_popular_color_set', array(
		'label'        => __( 'Block most-popular hover', 'mytheme' ),
		'section'    => 'elements_color_sec',
		'settings'   => 'most_popular_color_set',
	) ) );
//block categories color
	$wp_customize->add_setting( 'categories_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'categories_color_set', array(
		'label'        => __( 'Block categories', 'mytheme' ),
		'section'    => 'elements_color_sec',
		'settings'   => 'categories_color_set',
	) ) );
//galleries head color
	$wp_customize->add_setting( 'galleries_head_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'galleries_head_color_set', array(
		'label'        => __( 'Galleries headname', 'mytheme' ),
		'section'    => 'elements_color_sec',
		'settings'   => 'galleries_head_color_set',
	) ) );
//customize contacts
	$wp_customize->add_section( 'contacts_color_sec' , array(
		'title'      => __( 'Customize contacts', 'mytheme' ),
		'priority'   => 100,
	) );
	//color
	$wp_customize->add_setting( 'contacts_color_set' , array(
		'default'     => $col_yellow,
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'contacts_color_set', array(
		'label'        => __( 'Top menu color', 'mytheme' ),
		'section'    => 'contacts_color_sec',
		'settings'   => 'contacts_color_set',
	) ) );
	//number
	$wp_customize->add_setting( 'contacts_number_set' , array(
		'default'     => '123456789',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contacts_number_set', array(
		'label'        => __( 'Number of phone', 'mytheme' ),
		'section'    => 'contacts_color_sec',
		'settings'   => 'contacts_number_set',
	) ) );
	//email
	$wp_customize->add_setting( 'contacts_email_set' , array(
		'default'     => 'info@domain.com',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contacts_email_set', array(
		'label'        => __( 'Current email', 'mytheme' ),
		'section'    => 'contacts_color_sec',
		'settings'   => 'contacts_email_set',
	) ) );
//sidebar position
	$wp_customize->add_section( 'sidebar_sec' , array(
		'title'      => __( 'Customize sidebar', 'mytheme' ),
		'priority'   => 170,
	) );
	$wp_customize->add_setting( 'sidebar_position_set' , array(
		'default'     => '1',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control('sidebar_position_set', array(
		'label'        => __( 'Position of sidebar', 'mytheme' ),
		'section'    => 'sidebar_sec',
		'settings'   => 'sidebar_position_set',
		'type'     => 'radio',
		'choices'  => array(
			'-1'  => 'Left side',
			'1' => 'Right side',
		),
	) ) ;
//custom banner
	$wp_customize->add_section( 'banner_sec' , array(
		'title'      => __( 'Customize banner in sidebar', 'mytheme' ),
		'priority'   => 170,
	) );
	//link
	$wp_customize->add_setting( 'banner_link_set' , array(
		'default'     => 'http://localhost',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'banner_link_set', array(
		'label'        => __( 'Link for the banner', 'mytheme' ),
		'section'    => 'banner_sec',
		'settings'   => 'banner_link_set',
	) ) );
	//image
	$wp_customize->add_setting( 'banner_image_set' , array(
		'default'     => 'http://localhost.png',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'banner_image_set', array(
		'label'        => __( 'Select banner image', 'mytheme' ),
		'section'    => 'banner_sec',
		'settings'   => 'banner_image_set',
	) ) );
}
add_action( 'customize_register', 'customize_theme_options' );

//css apply to html
function apply_css() { ?>
	<style type="text/css">
		.navbar-brand { color:<?php echo get_theme_mod('logo_color_set'); ?> !important; }
		.top-menu { background:<?php echo get_theme_mod('header_menu_color_set'); ?> !important; }
		.top-menu > li > a:before { border-left-color:<?php echo get_theme_mod('header_menu_color_set'); ?> !important; }
		svg .svg-bg { fill:<?php echo get_theme_mod('carousel_color_set'); ?> !important; }
		.carousel-indicators > li.active > span { color:<?php echo get_theme_mod('carousel_color_set'); ?> !important; }
		.btn-yellow { background:<?php echo get_theme_mod('button_color_set'); ?> !important; }
		.article-head > a:hover { color:<?php echo get_theme_mod('button_color_set'); ?> !important; }
		.block-most-popular li:hover { background:<?php echo get_theme_mod('most_popular_color_set'); ?> !important; }
		.block-categories li:hover, .num-cat { background:<?php echo get_theme_mod('categories_color_set'); ?> !important; }
		.blog-gallery-post > h4 { background:<?php echo get_theme_mod('galleries_head_color_set'); ?> !important; }
		.our-info-contact > address { background:<?php echo get_theme_mod('contacts_color_set'); ?> !important; }
		.prime-bar { order:<?php echo get_theme_mod('sidebar_position_set'); ?> !important; }
	</style>
<?php }
add_action( 'wp_head', 'apply_css');