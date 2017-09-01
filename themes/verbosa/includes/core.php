<?php
/**
 * Core theme functions
 *
 * @package Verbosa
 */

/**
 * Header image handler (via div with background image)
 */
add_action ('cryout_headerimage_hook', 'verbosa_header_image', 99);
if ( ! function_exists( 'verbosa_header_image' ) ) :
function verbosa_header_image() {
	if (get_header_image() != '') {
		$header_image = get_header_image();
	}

	if ( !empty($header_image) ):?>
		<?php cryout_header_widget_hook(); ?>
		<img class="header-image" alt="" src="<?php echo esc_url( $header_image ) ?>" />
	<?php endif;
} // verbosa_header_image()
endif;

/**
 * Adds title and description to header
 * Used in header.php
*/
if ( ! function_exists( 'verbosa_title_and_description' ) ) :
function verbosa_title_and_description() {

	$verbosas = cryout_get_option( array('verbosa_logoupload','verbosa_siteheader') );
	echo '<div class="identity">';
	if ( in_array($verbosas['verbosa_siteheader'], array( 'logo', 'both' ) ) ) {
		echo verbosa_logo_helper($verbosas['verbosa_logoupload']);
	}
	if ( in_array($verbosas['verbosa_siteheader'], array('title', 'both') ) ) {
		$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
		echo '<' . $heading_tag . cryout_schema_microdata('site-title', 0) . ' id="site-title">';
		echo '<span> <a href="' . esc_url( home_url( '/' ) ) . '"  rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> </span>';
		echo '</' . $heading_tag . '>';
		echo '<span id="site-description" ' . cryout_schema_microdata('site-description', 0) . ' >' . esc_attr( get_bloginfo( 'description' ) ) . '</span>';
	}

	echo '</div>';
} // verbosa_title_and_description()
endif;
add_action ('cryout_branding_hook', 'verbosa_title_and_description');

function verbosa_logo_helper($verbosa_logo) {
	    if ( function_exists( 'the_custom_logo' ) ) {
	        // WP 4.5+
	        $wp_logo = str_replace( 'class="custom-logo-link"', 'id="logo" class="custom-logo-link" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"', get_custom_logo() );
	        if (!empty($wp_logo) ) return $wp_logo;
	    } else {
	        // older WP
	        if ( !empty($verbosa_logo) ) :
	            $img = wp_get_attachment_image_src($verbosa_logo, 'full');
	            return '<a id="logo" href="'.esc_url( home_url( '/' ) ).'" >
							<img title="'.get_bloginfo( 'name' ).'" alt="'.get_bloginfo( 'name' ).'" src="' . esc_url( $img[0] ) . '" />
						</a>';
	        endif;
	    }
	    return '';
} // verbosa_logo_helper()

/**
 * Verbosa back to top button
 * Creates div for js
*/
if ( ! function_exists( 'verbosa_back_top' ) ) :
function verbosa_back_top() {
	echo '<div id="toTop"><i class="icon-back2top"></i> </div>';
} // verbosa_back_top()
endif;
add_action ('cryout_footer_hook', 'verbosa_back_top');


/**
 * Creates pagination for blog pages.
 */
if ( ! function_exists( 'verbosa_pagination' ) ) :
function verbosa_pagination($pages = '', $range = 2, $prefix ='')
{
	$pagination = cryout_get_option('verbosa_pagination');
	if ($pagination && function_exists( 'the_posts_pagination' ) ):
		the_posts_pagination( array(
			'prev_text' => '<i class="icon-arrow-left2"></i>',
			'next_text' => '<i class="icon-arrow-right2"></i>',
			'mid_size' => $range
		) );
	else:
		//posts_nav_link();
		verbosa_content_nav( 'nav-old-below' );
	endif;

} // verbosa_pagination()
endif;

/**
 *
 */
if ( ! function_exists( 'verbosa_nextpage_links' ) ) :
function verbosa_nextpage_links($defaults) {
	$args = array(
		'link_before'      => '<em>',
		'link_after'       => '</em>',
	);
	$r = wp_parse_args($args, $defaults);
	return $r;
} // verbosa_nextpage_links()
endif;
add_filter('wp_link_pages_args','verbosa_nextpage_links');


/**
 * Footer Hook
 */
add_action('cryout_master_footer_hook', 'verbosa_master_footer');
function verbosa_master_footer() {
	$verbosa_theme = wp_get_theme();
	do_action('cryout_footer_hook');
	echo '<div id="site-copyright">' . wp_kses_post( cryout_get_option( 'verbosa_copyright' ) ). '</div>';
	echo '<div id="poweredby">' . __("Powered by","verbosa") .
		'<a target="_blank" href="' . esc_html( $verbosa_theme->get( 'ThemeURI' ) )  . '" title="';
	echo 'Verbosa Theme by' . ' Cryout Creations"> ' . 'Verbosa' .'</a> &amp; <a target="_blank" href="' . "http://wordpress.org/";
	echo '" title="' . esc_attr__( "Semantic Personal Publishing Platform", "verbosa" ) . '"> ' . sprintf( " %s.", "WordPress" ) . '</a></div>';
}


if ( ! function_exists( 'verbosa_header_section' ) ) :
function verbosa_header_section() { ?>
	<div id="sidebar">

		<header id="header" <?php cryout_schema_microdata('header') ?>>
			<nav id="mobile-menu">
				<span id="nav-cancel"><i class="icon-cross"></i></span>
				<?php cryout_mobilemenu_hook(); ?>
			</nav>
			<div id="branding" role="banner">
			<?php cryout_branding_hook();?>
			<?php cryout_headerimage_hook(); ?>
			<?php get_sidebar('left'); ?>
				<a id="nav-toggle"><span>&nbsp;</span></a>
				<nav id="access" role="navigation"  aria-label="Primary Menu" <?php cryout_schema_microdata('menu'); ?>>
				<h3 class="widget-title menu-title"><span><?php _e("Menu", "verbosa");?></span></h3>
					<?php cryout_access_hook();?>
				</nav><!-- #access -->

			</div><!-- #branding -->
		</header><!-- #header -->

		<?php get_sidebar('right'); ?>
		<?php cryout_master_footer_hook(); ?>

		</div><!--sidebar-->
		<div id="sidebar-back"></div>
<?php }// verbosa_header_section
endif;

if ( ! function_exists( 'verbosa_get_layout_class' ) ) :
function verbosa_get_layout_class() {
	$verbosa_sitelayout = cryout_get_option( 'verbosa_sitelayout' );

	/*  If page template, return the page template's layout */
	global $verbosa_template_layout;
	if (isset($verbosa_template_layout)) return $verbosa_template_layout;

	/*  If not, return the general layout */
	switch($verbosa_sitelayout) {
		case '2cSl': return "two-columns-left"; break;
		case '2cSr': return "two-columns-right"; break;
		case '1c':
		default: return "one-column"; break;
	}
} // verbosa_get_layout_class()
endif;


/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
* @return array list of classes.
*/
function verbosa_mobile_body_class($classes){
	$browser = (!empty($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'');
	$keys = 'mobile|android|mobi|tablet|ipad|opera mini|series 60|s60|blackberry';
	if (preg_match("/($keys)/i",$browser)): $classes[] = 'mobile'; endif; // mobile browser detected
	return $classes;
} // verbosa_mobile_body_class()
add_filter('body_class', 'verbosa_mobile_body_class');


/**
* Creates breadcrumbs with page sublevels and category sublevels.
* Hooked in master hook
*/
if ( ! function_exists( 'verbosa_breadcrumbs' ) ) :
function verbosa_breadcrumbs() {

	$verbosas = cryout_get_option( 'verbosa_frontpage' );

	$separator = '<i class="icon-ctrl-right"></i>'; 	// separator between crumbs
	$home = '<a href="'. esc_url( home_url() ).'" title="'.__('Home','verbosa').'"><i class="icon-home"></i></a>'; // text for the 'Home' link
	$showCurrent = 1; 									// whether to show current post/page title in breadcrumbs
	$before = '<span class="current">'; 				// tag before the current crumb
	$after = '</span>'; 								// tag after the current crumb

	global $post;
	$homeLink = esc_url( home_url() );
	if ( is_front_page() ) { return; }	// don't display breadcrumbs on the homepage (yet)

	// let's begin
	echo '<div id="breadcrumbs-container" class="' . verbosa_get_layout_class() . '"><div id="breadcrumbs"> <nav id="breadcrumbs-nav" ' . cryout_schema_microdata('breadcrumbs', 0) . '>' . $home . $separator . ' ';

    if ( is_category() ) {
		// category section
		$queried_object = get_queried_object();
	 	$cat_parents = $queried_object->category_parent;

		if ( !empty( $cat_parents ) ) echo get_category_parents( $cat_parents, TRUE, ' ' . $separator . ' ');
		echo $before . __('Archive for category','verbosa').' "' . single_cat_title('', false) . '"' . $after;
    } elseif ( is_search() ) {
		// search section
		echo $before . __('Search results for','verbosa').' "' . get_search_query() . '"' . $after;
    } elseif ( is_day() ) {
		// daily archive
		echo '<a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . get_the_time('Y') . '</a> ' . $separator . ' ';
		echo '<a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . get_the_time('F') . '</a> ' . $separator . ' ';
		echo $before . get_the_time('d') . $after;
    } elseif ( is_month() ) {
		// monthly archive
		echo '<a href="' .  esc_url( get_year_link( get_the_time('Y') ) ) . '">' . get_the_time('Y') . '</a> ' . $separator . ' ';
		echo $before . get_the_time('F') . $after;
    } elseif ( is_year() ) {
		// yearly archive
		echo $before . get_the_time('Y') . $after;
    } elseif ( is_single() && !is_attachment() ) {
		// single post or page
		if ( get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ($showCurrent) echo ' ' . $separator . ' ' . $before . get_the_title() . $after;
		} else {
			$cat = get_the_category(); if (isset($cat[0])) {$cat = $cat[0];} else {$cat = false;}
			if ($cat) {$cats = get_category_parents($cat, TRUE, ' ' . $separator . ' ');} else {$cats=false;}
			if (!$showCurrent && $cats) $cats = preg_replace("#^(.+)\s$separator\s$#", "$1", $cats);
			echo $cats;
			if ($showCurrent) echo $before . get_the_title() . $after;
		}
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		// some other single item
		$post_type = get_post_type_object(get_post_type());
		echo $before . $post_type->labels->singular_name . $after;
	} elseif ( is_attachment() ) {
		// attachment section
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); if (isset($cat[0])) {$cat = $cat[0];} else {$cat=false;}
		if ($cat) echo get_category_parents($cat, TRUE, ' ' . $separator . ' ');
		echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a>';
		if ($showCurrent) echo ' ' . $separator . ' ' . $before . get_the_title() . $after;
    } elseif ( is_page() && !$post->post_parent ) {
		// parent page
		if ($showCurrent) echo $before . get_the_title() . $after;
    } elseif ( is_page() && $post->post_parent ) {
		// child page
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i++) {
			echo $breadcrumbs[$i];
			if ($i != count($breadcrumbs)-1) echo ' ' . $separator . ' ';
		}
		if ($showCurrent) echo ' ' . $separator . ' ' . $before . get_the_title() . $after;
    } elseif ( is_tag() ) {
		// tags archive
		echo $before . __('Posts tagged','verbosa').' "' . single_tag_title('', false) . '"' . $after;
    } elseif ( is_author() ) {
		// author archive
		global $author;
		$userdata = get_userdata($author);
		echo $before . __('Articles posted by','verbosa'). ' ' . $userdata->display_name . $after;
    } elseif ( is_404() ) {
		// 404
		echo $before . __('Not Found','verbosa') . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','verbosa') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</nav></div></div><!-- breadcrumbs -->';
} // verbosa_breadcrumbs()
endif;


/**
* Master hook to bypass customizer options
*/
if ( ! function_exists( 'cryout_master_hook' ) ) :
function cryout_master_hook(){
	$verbosa_interim_options = cryout_get_option( array(
		'verbosa_breadcrumbs',
		'verbosa_searchboxmain',
		'verbosa_searchboxfooter',
		'verbosa_comlabels',
		'verbosa_socials_header_above',
		'verbosa_socials_header_below',
		'verbosa_socials_sidebar',
		)
	);
	if ( $verbosa_interim_options['verbosa_breadcrumbs'] )  add_action('cryout_before_content_hook', 'verbosa_breadcrumbs');

	if ( $verbosa_interim_options['verbosa_comlabels'] == 1) {
		add_filter('comment_form_default_fields', 'verbosa_comments_form');
		add_filter('comment_form_field_comment', 'verbosa_comments_form_textarea');
	}

	if ( $verbosa_interim_options['verbosa_socials_header_above'] ) add_action('cryout_branding_hook', 'verbosa_socials_menu_header_above', 5);
	if ( $verbosa_interim_options['verbosa_socials_header_below'] ) add_action('cryout_branding_hook', 'verbosa_socials_menu_header_below', 30);
	if ( $verbosa_interim_options['verbosa_socials_sidebar'] ) add_action('cryout_footer_hook', 'verbosa_socials_menu_footer', 17);

};
endif;
add_action('wp', 'cryout_master_hook');
