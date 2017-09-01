<?php
/**
 * Styles and scripts registration and enqueuing
 *
 * @package verbosa
 */

/* Styles and scripts */
function verbosa_enqueue_styles() {

	wp_enqueue_script( 'verbosa-html5shiv', get_template_directory_uri() . '/resources/js/html5shiv.min.js', null, _CRYOUT_THEME_VERSION );
	if ( function_exists( 'wp_script_add_data' ) ) wp_script_add_data( 'verbosa-html5shiv', 'conditional', 'lt IE 9' );

	$cryout_theme_structure = cryout_get_theme_structure();
	$verbosas = cryout_get_option();

	wp_enqueue_style( 'verbosa-themefonts', get_template_directory_uri() . '/resources/fonts/fontfaces.css', null, _CRYOUT_THEME_VERSION ); // fontfaces.css

	// google fonts
	$gfonts = array();
	$roots = array();
	foreach ( $cryout_theme_structure['google-font-enabled-fields'] as $item ) {
		$itemg = $item . 'google';
		$itemw = $item . 'weight';
		// custom font names
		if ( ! empty( $verbosas[$itemg] ) ) {
				$gfonts[] = cryout_gfontclean( $verbosas[$itemg] ) . ":" . $verbosas[$itemw];
				$roots[] = cryout_gfontclean( $verbosas[$itemg] );
		}
		// preset google fonts
		if ( preg_match('/^(.*)\/gfont$/i', $verbosas[$item], $bits ) ) {
				$gfonts[] = cryout_gfontclean( $bits[1] ) . ":" . $verbosas[$itemw];
				$roots[] = cryout_gfontclean( $bits[1] );
		}
	};

	// enqueue google fonts with subsets separately
	foreach( $gfonts as $i => $gfont ):
		if ( strpos( $gfont, "&" ) === false):
		   // do nothing
		else:
			wp_enqueue_style( 'verbosa-googlefont'.$i, '//fonts.googleapis.com/css?family=' . $gfont, null, _CRYOUT_THEME_VERSION );
			unset($gfonts[$i]);
		endif;
	endforeach;

	// merged google fonts
	if ( count( $gfonts ) > 0 ):
		wp_enqueue_style( 'verbosa-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_merge( array_unique( $roots ), array_unique( $gfonts ) ) ), null, _CRYOUT_THEME_VERSION );
	endif;

	// main theme style
	wp_enqueue_style( 'verbosa-main', get_stylesheet_uri(), null, _CRYOUT_THEME_VERSION );

	// RTL style
	if (is_RTL()) wp_enqueue_style( 'verbosa-rtl', get_template_directory_uri() . '/resources/styles/rtl.css', null, _CRYOUT_THEME_VERSION );

	// theme generated style
	wp_add_inline_style( 'verbosa-main', preg_replace("/[\n\r\t\s]+/"," " ,verbosa_custom_styles()) ); // includes/custom-styles.php

	// user custom style
	wp_add_inline_style( 'verbosa-main', preg_replace("/[\n\r\t\s]+/"," " , htmlspecialchars_decode( $verbosas['verbosa_customcss'], ENT_QUOTES ) ) );

	// responsive style
	wp_enqueue_style( 'verbosa-responsive', get_template_directory_uri() . '/resources/styles/responsive.css', null, _CRYOUT_THEME_VERSION );

} // verbosa_enqueue_styles
add_action('wp_head', 'verbosa_enqueue_styles', 5 );


/* Outputs the author meta link in header */
function verbosa_author_link() {
	global $post;
	if (is_single() && get_the_author_meta('user_url',$post->post_author)) {
		echo '<link rel="author" href="' . get_the_author_meta('user_url',$post->post_author) . '">';
	}
}
add_action ('wp_head','verbosa_author_link');

// Adds HTML5 tags for IE8
function verbosa_header_scripts() {
?>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
</script>
<![endif]-->
<?php
} // verbosa_header_scripts()
//add_action('wp_head','verbosa_header_scripts',100);

/* Main theme scripts */
function verbosa_scripts_method() {

	wp_enqueue_script( 'verbosa-frontend', get_template_directory_uri() . '/resources/js/frontend.js', array('jquery'), _CRYOUT_THEME_VERSION );

	wp_enqueue_script( 'jquery-masonry' );

	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

}
add_action('wp_footer', 'verbosa_scripts_method');

function verbosa_scripts_filter($tag) {
	$scripts_to_defer = array('comment-reply.min.js', 'frontend.js', 'masonry.min.js');
	foreach($scripts_to_defer as $defer_script){
		if(true == strpos($tag, $defer_script ) )
			return str_replace( ' src', ' defer src', $tag ); // ' async' causes issues with masonry
	}
	return $tag;
}
//add_filter('script_loader_tag', 'verbosa_scripts_filter', 10, 2); 

function verbosa_responsive_meta() {
	echo PHP_EOL.'<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
	echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">';
}

add_action ('cryout_meta_hook', 'verbosa_responsive_meta');


add_editor_style( add_query_arg( 'action', 'verbosa_editor_styles', admin_url( 'admin-ajax.php' ) ));

// add wp_ajax callback
add_action( 'wp_ajax_verbosa_editor_styles', 'verbosa_custom_editor_styles'  );
add_action( 'wp_ajax_no_priv_verbosa_editor_styles', 'verbosa_custom_editor_styles'  );

/* FIN */
