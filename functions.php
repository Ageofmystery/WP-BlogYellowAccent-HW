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
