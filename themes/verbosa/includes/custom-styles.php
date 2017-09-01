<?php
/**
 * MASTER GENERATED STYLE FUNCTION
 *
 * @package Verbosa
 */

function verbosa_body_classes($classes) {
	$verbosas = cryout_get_option( array(
		'verbosa_image_style','verbosa_magazinelayout','verbosa_comclosed','verbosa_contenttitles', 'verbosa_caption_style',
		'verbosa_elementborder', 'verbosa_elementshadow', 'verbosa_elementborderradius', 'verbosa_fresponsive',
		'verbosa_comlabels', 'verbosa_sidebarback', 'verbosa_comdate'
	) );
	$classes[] = esc_html( $verbosas['verbosa_image_style'] );
	$classes[] = esc_html( $verbosas['verbosa_caption_style'] );

	if ( $verbosas['verbosa_fresponsive'] ) $classes[] = 'verbosa-responsive-featured';
		else $classes[] = 'verbosa-cropped-featured';

	if ( $verbosas['verbosa_magazinelayout'] ) {
		switch ( $verbosas['verbosa_magazinelayout'] ):
			case 1: $classes[] = 'magazine-one magazine-layout'; break;
			case 2: $classes[] = 'magazine-two magazine-layout'; break;
			case 3: $classes[] = 'magazine-three magazine-layout'; break;
		endswitch;
	}
	switch ( $verbosas['verbosa_comclosed'] ) {
		case 2: $classes[] = 'comhide-in-posts'; break;
		case 3: $classes[] = 'comhide-in-pages'; break;
		case 0: $classes[] = 'comhide-in-posts'; $classes[] = 'comhide-in-pages'; break;
	}
	if ( $verbosas['verbosa_comlabels'] == 1 ) $classes[] = 'comment-placeholder';
	if ( $verbosas['verbosa_comdate'] == 1 ) $classes[] = 'comment-date-published';

	switch ( $verbosas['verbosa_contenttitles'] ) {
		case 2: $classes[] = 'hide-page-title'; break;
		case 3: $classes[] = 'hide-cat-title'; break;
		case 0: $classes[] = 'hide-page-title'; $classes[] = 'hide-cat-title'; break;
	}

	if ( $verbosas['verbosa_elementborder'] ) $classes[] = 'verbosa-elementborder';
	if ( $verbosas['verbosa_elementshadow'] ) $classes[] = 'verbosa-elementshadow';
	if ( $verbosas['verbosa_elementborderradius'] ) $classes[] = 'verbosa-elementradius';

	if ( !$verbosas['verbosa_sidebarback'] ) $classes[] = 'verbosa-no-sidebar-back';

	return $classes;
}
add_filter('body_class','verbosa_body_classes');


/*
 * Dynamic styles for the frontend
 */
function verbosa_custom_styles() {
	$verbosas = cryout_get_option();

	foreach ($verbosas as $key => $value) { ${"$key"} = $value; }

	ob_start();

// <style> wrapping is handled by wp_add_inline_style()

/////////// LAYOUT DIMENSIONS. ///////////
?>

#content { max-width: <?php echo esc_html($verbosa_sitewidth); ?>px; }

<?php
/////////// COLUMNS ///////////
$colPadding = 1; // percent
?>

#sidebar 									{ width: <?php echo $verbosa_sidebar; ?>px; }
#container.one-column 						{ }
#container.two-columns-left #sidebar 		{ float: left; }
#container.two-columns-left .main			{ width: calc(<?php echo 97-(int)$colPadding ?>% - <?php echo $verbosa_sidebar; ?>px); float: left; margin-left: 3%; }
#container.two-columns-left #sidebar-back 	{ width: calc( 50% - <?php echo (($verbosa_sitewidth)/2 - $verbosa_sidebar); ?>px); min-width: <?php echo $verbosa_sidebar;?>px;}
#container.two-columns-right #sidebar 		{ float: right; }
#container.two-columns-right .main			{ width: calc(<?php echo 97-(int)$colPadding ?>% - <?php echo $verbosa_sidebar; ?>px); float: right; margin-right: 3%; }
#container.two-columns-right #sidebar-back 	{ left: auto; right: 0; width: calc( 50% - <?php echo (($verbosa_sitewidth)/2 - $verbosa_sidebar); ?>px); min-width: <?php echo $verbosa_sidebar;?>px;}

<?php
/////////// FONTS ///////////
?>
html
					{ font-family: <?php echo cryout_font_select( $verbosa_fgeneral, $verbosa_fgeneralgoogle ) ?>;
					  font-size: <?php echo esc_html($verbosa_fgeneralsize) ?>; font-weight: <?php echo esc_html($verbosa_fgeneralweight) ?>;
					  line-height: <?php echo esc_html( (float)$verbosa_lineheight ) ?>; }

#site-title 		{ font-family: <?php echo cryout_font_select( $verbosa_fsitetitle, $verbosa_fsitetitlegoogle ) ?>;
					  font-size: <?php echo esc_html($verbosa_fsitetitlesize) ?>; font-weight: <?php echo esc_html($verbosa_fsitetitleweight) ?>; }

#site-description	{ font-family: <?php echo cryout_font_select( $verbosa_fsitedesc, $verbosa_fsitedescgoogle ) ?>;
					  font-size: <?php echo esc_html($verbosa_fsitedescsize) ?>; font-weight: <?php echo esc_html($verbosa_fsitedescweight) ?>; }

#access ul li a 	{ font-family: <?php echo cryout_font_select( $verbosa_fmenu, $verbosa_fmenugoogle ) ?>;
					  font-size: <?php echo esc_html($verbosa_fmenusize) ?>; font-weight: <?php echo esc_html($verbosa_fmenuweight) ?>; }
#mobile-menu ul li a { font-family: <?php echo cryout_font_select( $verbosa_fmenu, $verbosa_fmenugoogle ) ?>; }

.widget-title 		{ font-family: <?php echo cryout_font_select( $verbosa_fwtitle, $verbosa_fwtitlegoogle ) ?>;
					  font-size: <?php echo esc_html($verbosa_fwtitlesize) ?>; font-weight: <?php echo esc_html($verbosa_fwtitleweight) ?>; }
.widget-container 	{ font-family: <?php echo cryout_font_select( $verbosa_fwcontent, $verbosa_fwcontentgoogle ) ?>;
				      font-size: <?php echo esc_html($verbosa_fwcontentsize) ?>; font-weight: <?php echo esc_html($verbosa_fwcontentweight) ?>; }
.entry-title, #reply-title
					{ font-family: <?php echo cryout_font_select( $verbosa_ftitles, $verbosa_ftitlesgoogle ) ?>; color: <?php echo esc_html($verbosa_titletext); ?>;
					  font-size: <?php echo esc_html($verbosa_ftitlessize) ?>; font-weight: <?php echo esc_html($verbosa_ftitlesweight) ?>;}
<?php
$font_root = 260; // headings font size root
for ( $i=1; $i<=6; $i++ ) {
		$size = round( ($font_root-(30*$i))/100 * (preg_replace("/[^\d]/","",esc_html($verbosa_fheadingssize))/100), 5 ); ?>
		h<?php echo $i ?> { font-size: <?php echo $size ?>em; } <?php
} //for ?>
h1, h2, h3, h4, h5, h6 { font-family: <?php echo cryout_font_select( $verbosa_fheadings, $verbosa_fheadingsgoogle ) ?>;
					     font-weight: <?php echo esc_html($verbosa_fheadingsweight) ?>; }


<?php
/////////// COLORS ///////////
?>
body 										{ color: <?php echo esc_html($verbosa_sitetext); ?>;
											  background-color: <?php echo esc_html($verbosa_sitebackground) ?>; }

#site-title a, #access li 					{ color: <?php echo esc_html($verbosa_accent1) ?>; }
#site-description 							{ color: <?php echo esc_html($verbosa_metatext) ?>; }
#access a, #access .dropdown-toggle			{ color: <?php echo esc_html($verbosa_menutext) ?>; }
#access a:hover								{ color: <?php echo esc_html($verbosa_menutexthover) ?>; }
#access li:before							{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_sidebarbackground,17)) ?>; }
#access li:hover:before						{ background-color: <?php echo esc_html($verbosa_menutexthover) ?>; }
<?php if (! $verbosa_menubullets) { ?>
#access li:before							{ display: none;}
<?php } ?>
.dropdown-toggle:hover:after 				{ border-color: <?php echo esc_html($verbosa_metatext) ?>;}
.searchform:before 							{ background-color: <?php echo esc_html($verbosa_accent2) ?>;
											  color: <?php echo esc_html($verbosa_sidebarbackground) ?>;}

article.hentry, .main > div:not(#content-masonry), .comment-header,
.main > header, .main > nav#nav-below, .pagination span, .pagination a, #nav-old-below, .content-widget
											{ background-color: <?php echo esc_html($verbosa_contentbackground) ?>; }
#sidebar-back, #sidebar, nav#mobile-menu	{ background-color: <?php echo esc_html($verbosa_sidebarbackground) ?>; }
.pagination a:hover, .pagination span:hover { border-color: <?php echo esc_html($verbosa_metatext); ?>;}
#breadcrumbs-container 						{ background-color: <?php echo esc_html($verbosa_contentbackground); ?>;}
#colophon 									{ background-color: <?php echo esc_html($verbosa_footerbackground); ?>; }

span.entry-format 							{ color: <?php echo esc_html($verbosa_accent1) ?>;
											  border-color: <?php echo esc_html($verbosa_metatext);?>;}
.entry-format > i:before 					{ color: <?php echo esc_html($verbosa_metatext);?>;}
.format-aside 								{ border-color: <?php echo esc_html($verbosa_sitebackground) ?>; }

.entry-content blockquote::before,
.entry-content blockquote::after 			{ color: rgba(<?php echo cryout_hex2rgb( esc_html($verbosa_sitetext) ) ?>,0.1); }

a 											{ color: <?php echo esc_html($verbosa_accent1); ?>; }
a:hover, .entry-meta span a:hover, .widget-title span,
.comments-link a:hover 						{ color: <?php echo esc_html($verbosa_accent2); ?>; }
.entry-meta a								{ background-image: linear-gradient(to bottom, <?php echo esc_html($verbosa_accent2);?> 0%,  <?php echo esc_html($verbosa_accent2);?> 100%);}
.entry-title a								{ background-image: linear-gradient(to bottom, <?php echo esc_html($verbosa_titletext);?> 0%,  <?php echo esc_html($verbosa_titletext);?> 100%);}
#entry-author-info #author-avatar,
#author-info #author-avatar img
											{ border-color:  <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)); ?>;
											  background-color: <?php echo esc_html($verbosa_contentbackground);?> ;}
#footer a, .page-title strong 				{ color: <?php echo esc_html($verbosa_accent1) ?>; }
#footer a:hover								{ color: <?php echo esc_html($verbosa_accent2) ?>; }

.socials a 									{ border-color: <?php echo esc_html($verbosa_accent1); ?>;}
.socials a:before 							{ color: <?php echo esc_html($verbosa_accent1); ?>; }
.socials a:after 							{ background-color: <?php echo esc_html($verbosa_accent2); ?>; }

#commentform								{ <?php if ($verbosa_comformwidth) { echo 'max-width:' . esc_html($verbosa_comformwidth) . 'px;';}?>}

#toTop .icon-back2top:before 				{ color: <?php echo esc_html($verbosa_accent1) ?>; }
#toTop:hover .icon-back2top:before 			{ color: <?php echo esc_html($verbosa_accent2) ?>; }
.page-link a:hover 							{ background: <?php echo esc_html($verbosa_accent2) ?>; color: <?php echo esc_html($verbosa_sitebackground) ?>; }
.page-link > span > em						{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }

.verbosa-caption-one .main .wp-caption .wp-caption-text 	{ border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }
.verbosa-caption-two .main .wp-caption .wp-caption-text 	{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,10)) ?>; }

.verbosa-image-one .entry-content img[class*="align"],
.verbosa-image-one .entry-summary img[class*="align"],
.verbosa-image-two .entry-content img[class*='align'],
.verbosa-image-two .entry-summary img[class*='align'] 	{ border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }
.verbosa-image-five .entry-content img[class*='align'],
.verbosa-image-five .entry-summary img[class*='align'] 	{ border-color: <?php echo esc_html($verbosa_accent2);?>; }

/* diffs */

#sidebar .searchform 						{ border-color: <?php echo esc_html( cryout_hexdiff($verbosa_sidebarbackground, 17) ) ?>; }
.main .searchform 							{ border-color: <?php echo esc_html( cryout_hexdiff($verbosa_contentbackground, 17) ) ?>;
											  background-color: <?php echo esc_html($verbosa_contentbackground) ?>;}
.searchform .searchsubmit					{ color: <?php echo esc_html($verbosa_metatext); ?>;}
.socials a:after							{ color: <?php echo esc_html($verbosa_sidebarbackground); ?>;}
#breadcrumbs-nav .icon-angle-right::before,

.entry-meta span, .entry-meta span a, .entry-utility span, .entry-meta time,
.comment-meta a, .entry-meta .icon-metas:before,
a.continue-reading-link						{ color: <?php echo esc_html($verbosa_metatext) ?>;
											  font-family: <?php echo cryout_font_select( $verbosa_fmetas, $verbosa_fmetasgoogle ) ?>;
											  font-size: <?php echo esc_html($verbosa_fmetassize) ?>; font-weight: <?php echo esc_html($verbosa_fmetasweight) ?>;
											  }
a.continue-reading-link						{ background-color: <?php echo esc_html($verbosa_accent2) ?>; color: <?php echo esc_html($verbosa_contentbackground) ?>; }
a.continue-reading-link:hover				{ background-color: <?php echo esc_html($verbosa_accent1) ?>; }
.comment-form > p:before					{ color: <?php echo esc_html($verbosa_metatext) ?>; }
.comment-form > p:hover:before				{ color: <?php echo esc_html($verbosa_accent2) ?>; }

code,
#nav-below .nav-previous a:before, #nav-below .nav-next a:before
											{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }
#nav-below .nav-previous a:hover:before, #nav-below .nav-next a:hover:before
											{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,34)) ?>; }
#nav-below em 								{ color: <?php echo esc_html($verbosa_metatext);?>;}
#nav-below > div:before						{ border-color:  <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>;
											  background-color: <?php echo esc_html($verbosa_contentbackground);?>;}
#nav-below > div:hover:before				{ border-color:  <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,34)) ?>;
											  background-color:  <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,34)) ?>;}
pre, #entry-author-info, .comment-author, #nav-comments, .page-link,
.commentlist .comment-body, .commentlist .pingback, .commentlist img.avatar
											{ border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }

#sidebar .widget-title span					{ background-color: <?php echo esc_html($verbosa_sidebarbackground) ?>; }
#sidebar .widget-title:after				{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_sidebarbackground,17)) ?>; }
#site-copyright, #footer 					{ border-color: <?php echo esc_html(cryout_hexdiff($verbosa_sidebarbackground,17)) ?>; }

#colophon .widget-title span				{ background-color: <?php echo esc_html($verbosa_footerbackground) ?>; }
#colophon .widget-title:after				{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_footerbackground,17)) ?>; }

select, input[type], textarea 				{ color: <?php echo esc_html($verbosa_sitetext); ?>;
											  /*background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,10)) ?>;*/ }
input[type="submit"], input[type="reset"]
											{ background-color: <?php echo esc_html($verbosa_accent1) ?>;
											  color: <?php echo esc_html($verbosa_contentbackground) ?>; }
input[type="submit"]:hover, input[type="reset"]:hover
											{ background-color: <?php echo esc_html($verbosa_accent2) ?>; }
select, input[type], textarea
											{ border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,22)) ?>; }
input[type]:hover, textarea:hover,
input[type]:focus, textarea:focus
											{ /*background-color: rgba(<?php echo esc_html(cryout_hex2rgb(cryout_hexdiff($verbosa_contentbackground,10))) ?>,0.65);*/
												border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,50)) ?>;		}

#toTop 										{ background-color: rgba(<?php echo esc_html(cryout_hex2rgb(cryout_hexdiff($verbosa_contentbackground,5))) ?>,0.8) }


<?php
/////////// LAYOUT ///////////
/*if ($verbosa_tables) { ?>
	.main table, .main tr, .main tr th, .main thead th, .main tr td, .main tr.even { background:none; border:none; color:inherit; }
<?php }*/ ?>
.main .entry-content, .main .entry-summary 	{ text-align: <?php echo esc_html($verbosa_textalign) ?>; }
.main p, .main ul, .main ol, .main dd, .main pre, .main hr
											{ margin-bottom: <?php echo esc_html($verbosa_paragraphspace) ?>; }
.main p 									{ text-indent: <?php echo esc_html($verbosa_parindent) ?>;}
.main a.post-featured-image 				{ background-position: <?php echo esc_html($verbosa_falign) ?>; }
.main .featured-bar							{ height: <?php echo esc_html($verbosa_fbar); ?>px;
											  background-color: <?php echo esc_html($verbosa_accent2);?>;}

.main			 							{ margin-top: <?php echo esc_html($verbosa_contentmargintop) ?>px; }
<?php if ($verbosa_fpost) { ?>
.verbosa-cropped-featured .main .post-thumbnail-container
											{ height: <?php echo esc_html($verbosa_fheight) ?>px; }
.verbosa-responsive-featured .main .post-thumbnail-container
											{ max-height: <?php echo esc_html($verbosa_fheight) ?>px; height: auto; }
<?php } ?>

<?php
/////////// ELEMENTS PADDING ///////////
?>
article.hentry, #breadcrumbs-nav,
.magazine-one #content-masonry article.hentry, .magazine-one .pad-container  {
		padding-left: <?php echo esc_html( $verbosa_elementpadding ) ?>%;
		padding-right: <?php echo esc_html( $verbosa_elementpadding ) ?>%; }
.magazine-two #content-masonry article.hentry, .magazine-two .pad-container, .with-masonry.magazine-two #breadcrumbs-nav {
		padding-left: <?php echo esc_html( round($verbosa_elementpadding/2.1, 2) ) ?>%;
		padding-right: <?php echo esc_html( round($verbosa_elementpadding/2.1, 2) ) ?>%; }
.magazine-three #content-masonry article.hentry, .magazine-three .pad-container, .with-masonry.magazine-three #breadcrumbs-nav {
		padding-left: <?php echo esc_html( round($verbosa_elementpadding/3.1, 2) ) ?>%;
		padding-right: <?php echo esc_html( round($verbosa_elementpadding/3.1, 2) ) ?>%; }
article.hentry .post-thumbnail-container {
		margin-left: -<?php echo esc_html( round($verbosa_elementpadding * 1.5, 2) ) ?>%;
		margin-right: -<?php echo esc_html( round($verbosa_elementpadding * 1.5, 2) ) ?>%;
		width: <?php echo esc_html( (100 + (int)$verbosa_elementpadding * 3) ); ?>%; }

<?php
/////////// HEADER LAYOUT ///////////
?>
#branding img.header-image 				{ max-height: <?php echo esc_html($verbosa_headerheight) ?>px; }
<?php if (! display_header_text() ) { ?>
	#site-title, #site-description		{ display: none; }
<?php };
 // end </style>

	$verbosa_custom_styling = ob_get_contents();
	ob_end_clean();
	return $verbosa_custom_styling;
} // verbosa_custom_styles()


/*
 * Dynamic styles for the admin MCE Editor
 */
function verbosa_custom_editor_styles() {
	header( 'Content-type: text/css' );
	$verbosas = cryout_get_option();
	foreach ($verbosas as $key => $value) { ${"$key"} = $value; }

	switch ($verbosa_sitelayout) {
		case '1c':
			$verbosa_sidebar = $verbosa_secondarysidebar = 0;
			break;
		case '2cSl':
			$verbosa_secondarysidebar = 0;
			break;
		case '2cSr':
			$verbosa_sidebar = 0;
			break;
		default:
			break;
	}
	$content_body = floor( (int)$verbosa_sitewidth - (int)$verbosa_sidebar);

	ob_start();
?>
body.mce-content-body {
	max-width: <?php echo esc_html($content_body); ?>px;
	font-family: <?php echo cryout_font_select( $verbosa_fgeneral, $verbosa_fgeneralgoogle ) ?>;
	font-size: <?php echo esc_html($verbosa_fgeneralsize) ?>; font-weight: <?php echo esc_html($verbosa_fgeneralweight) ?>;
	line-height: <?php echo esc_html( (float)$verbosa_lineheight ) ?>;
	color: <?php echo esc_html($verbosa_sitetext); ?>;
	background-color: <?php echo esc_html($verbosa_contentbackground) ?>	}
<?php
$font_root = 260; // headings font size root
for ( $i=1; $i<=6; $i++ ) {
	$size = round( ($font_root-(30*$i))/100 * (preg_replace("/[^\d]/","",esc_html($verbosa_fheadingssize))/100), 5 ); ?>
.mce-content-body h<?php echo $i ?> {
	font-size: <?php echo $size ?>em; } <?php
} //for ?>
.mce-content-body h1, .mce-content-body h2, .mce-content-body h3, .mce-content-body h4, .mce-content-body h5, .mce-content-body h6 {
	font-family: <?php echo cryout_font_select( $verbosa_fheadings, $verbosa_fheadingsgoogle ) ?>;
	font-weight: <?php echo esc_html($verbosa_fheadingsweight) ?>; }

.mce-content-body blockquote::before, .mce-content-body blockquote::after {
	color: rgba(<?php echo cryout_hex2rgb( esc_html($verbosa_sitetext) ) ?>,0.1); }

.mce-content-body a 		{ color: <?php echo esc_html($verbosa_accent1); ?>; }
.mce-content-body a:hover	{ color: <?php echo esc_html($verbosa_accent2); ?>; }

.mce-content-body code	{ background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }
.mce-content-body pre		{ border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?>; }

.mce-content-body select, .mce-content-body input[type], .mce-content-body textarea {
	color: <?php echo esc_html($verbosa_sitetext); ?>;
	background-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,10)) ?>;
	border-color: <?php echo esc_html(cryout_hexdiff($verbosa_contentbackground,17)) ?> }

.mce-content-body p, .mce-content-body ul, .mce-content-body ol, .mce-content-body dd,
.mce-content-body pre, .mce-content-body hr { margin-bottom: <?php echo esc_html($verbosa_paragraphspace) ?>; }
.mce-content-body p { text-indent: <?php echo esc_html($verbosa_parindent) ?>;}

<?php // end </style>
	$verbosa_custom_styling = ob_get_contents();
	ob_end_clean();
	echo $verbosa_custom_styling;
} // verbosa_custom_editor_styles()


/* FIN */
