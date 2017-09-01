<?php
/**
 * Customizer settings and other theme related settings (fonts arrays, widget areas)
 *
 * @package Verbosa
 */

function cryout_sanitize_tn($input){
	return preg_replace( '/[^a-z0-9-]/i', '-', $input );
}
function cryout_sanitize_tn_fn($input){
	return preg_replace( '/[^a-z0-9]/i', '_', $input );
}

// needed by the options array below
function cryout_gen_values( $from, $to, $step = 1, $attr = array() ){
	// prepend extra values
	if ( !empty($attr['pre']) && is_array($attr['pre']) )  $data = $attr['pre'];
													  else $data = array();
	// set float precision
	if ( !empty($attr['precision']) && is_numeric($attr['precision'] ) )  $precision = $attr['precision'];
								                                     else $precision = 1;
	// set measuring unit
    if ( !empty($attr['um']) ) $um = $attr['um'];
						  else $um = '';

	// generate numbers
	if ($step < 1):
		// floats
		for ($i=$from;$i<=$to;$i+=$step) {
			$data[] = number_format($i,$precision).$um;
		}
	else:
		// integers
		for ($i=$from;$i<=$to;$i+=$step) {
			$data[] = $i.$um;
		}
	endif;

	// append extra values
	if ( !empty($attr['post']) && is_array($attr['post']) )  $data = array_merge($data,$attr['post']);

	return $data;
} // cryout_gen_values()

$verbosa_big = array(

/************* general info ***************/

'info_sections' => array(
	'about' => array(
		'title' => __( 'About', 'cryout' ) . ' ' . _CRYOUT_THEME_NAME,
		'desc' => '<img src=" ' . get_template_directory_uri() . '/admin/images/logo-about-header.png" ><br>' . __( 'Got a question? Need help?', 'cryout' ),
	),
), // info_sections

'info_settings' => array(
	'support_link_faqs' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/wordpress-themes/' . _CRYOUT_THEME_NAME . '" target="_blank">%s</a>', __( 'Read the Docs', 'cryout' ) ),
		'desc' =>  '',
		'section' => 'about',
	),
	'support_link_forum' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/forums/f/wordpress/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '" target="_blank">%s</a>', __( 'Browse the Forum', 'cryout' ) ),
		'desc' => '',
		'section' => 'about',
	),
	'premium_support_link' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/priority-support" target="_blank">%s</a>', __( 'Priority Support', 'cryout' ) ),
		'desc' => '',
		'section' => 'about',
	),
	'rating_url' => array(
		'label' => __('Rating', 'cryout'),
		'default' => sprintf( '<a href="https://wordpress.org/support/view/theme-reviews/'. cryout_sanitize_tn( _CRYOUT_THEME_NAME ).'#postform" target="_blank">%s</a>', sprintf( __( 'Rate %s on WordPress.org', 'cryout' ) , ucwords(_CRYOUT_THEME_NAME) ) ),
		'desc' => __('If you like the theme, rate it. If you hate the theme, rate it as well. Let us know how we can make it better.', 'cryout'),
		'section' => 'about',
	),
	'management' => array(
		'label' => __('Manage Theme Settings', 'cryout') ,
		'default' => sprintf( '<a href="themes.php?page=about-' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '-theme">%s</a>', __('Manage Theme Settings', 'cryout') ),
		'desc' => __('Theme settings can be saved, loaded or reset from the theme\'s about page.', 'cryout'),
		'section' => 'about',
	),
), // info_settings

'panel_overrides' => array(
	'background' => array(
        'title' => __( 'Background', 'cryout' ),
		'desc' => __( 'Background Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-verbosa_siteidentity',
		'replaces' => 'background_image',
		'type' => 'section',
	),
	'verbosa_header_section' => array(
		'title' => __( 'Header Image', 'cryout' ),
		'desc' => __( 'Header Image Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-verbosa_siteidentity',
		'replaces' => 'header_image',
		'type' => 'section',
	),
	'identity' => array(
		'title' => __( 'Site Identity', 'cryout' ),
		'desc' => '',
		'priority' => 50,
		'section' => 'cryoutoverride-verbosa_siteidentity',
		'replaces' => 'title_tagline',
		'type' => 'section',
	),
	'colors' => array(
		'section' => 'section',
		'replaces' => 'colors',
		'type' => 'remove',
	),

), // panel_overrides

/************* panels *************/

'panels' => array(

	array('id'=>'verbosa_siteidentity', 'title'=>__('Site Identity','verbosa'), 'callback'=>'', 'identifier'=>'cryoutoverride-' ),
	array('id'=>'verbosa_general_section', 'title'=>__('General','verbosa') , 'callback'=>''),
	array('id'=>'verbosa_post_section', 'title'=>__('Post Information','verbosa') , 'callback'=>''),
	array('id'=>'verbosa_text_section', 'title'=>__('Typography','verbosa'), 'callback'=>''),

), // panels

/************* sections *************/

'sections' => array(

	// layout
	array('id'=>'verbosa_layout', 'title'=>__('Layout', 'verbosa'), 'callback'=>'', 'sid'=>'', 'priority'=>51),
	// header
	array('id'=>'verbosa_siteheader', 'title'=>__('Header','verbosa'), 'callback'=>'', 'sid'=> '', 'priority'=>52 ),
	// text
	array('id'=>'verbosa_fontfamily', 'title'=>__('General Font','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_text_section'),
	array('id'=>'verbosa_fontheader', 'title'=>__('Header Fonts','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_text_section'),
	array('id'=>'verbosa_fontwidget', 'title'=>__('Widget Fonts','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_text_section'),
	array('id'=>'verbosa_fontcontent', 'title'=>__('Content Fonts','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_text_section'),
	array('id'=>'verbosa_textformatting', 'title'=>__('Formatting','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_text_section'),
	// general
	array('id'=>'verbosa_contentstructure', 'title'=>__('Structure','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_general_section'),
	array('id'=>'verbosa_colors', 'title'=>__('Colors','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_general_section'),
	array('id'=>'verbosa_contentgraphics', 'title'=>__('Decorations','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_general_section'),
	array('id'=>'verbosa_postimage', 'title'=>__('Post Images','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_general_section'),
	array('id'=>'verbosa_socials', 'title'=>__('Social Icons','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_general_section'),
	// post info
	array('id'=>'verbosa_featured', 'title'=>__('Featured Image', 'verbosa'), 'callback'=>'', 'sid'=>'verbosa_post_section'),
	array('id'=>'verbosa_metas', 'title'=>__('Meta Information','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_post_section'),
	array('id'=>'verbosa_excerpts', 'title'=>__('Excerpts','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_post_section'),
	array('id'=>'verbosa_comments', 'title'=>__('Comments','verbosa'), 'callback'=>'', 'sid'=> 'verbosa_post_section'),
	// post excerpt
	array('id'=>'verbosa_excerpthome', 'title'=>__('Home Page','verbosa'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'verbosa_excerptsticky', 'title'=>__('Sticky Posts','verbosa'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'verbosa_excerptarchive', 'title'=>__('Archive and Category Pages','verbosa'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'verbosa_excerptlength', 'title'=>__('Post Excerpt Length ','verbosa'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'verbosa_excerptdots', 'title'=>__('Excerpt suffix','verbosa'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'verbosa_excerptcont', 'title'=>__('Continue reading link text ','verbosa'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	// misc
	array('id'=>'verbosa_misc', 'title'=>__('Miscellaneous','verbosa'), 'callback'=>'', 'sid'=> '', 'priority'=>72),

	/*** developer options ***/
	//array('id'=>'verbosa_developer', 'title'=>__('[ Developer Options ]','verbosa'), 'callback'=>'', 'sid'=>'', 'priority'=>101),

), // sections


/************* settings *************/

'options' => array (
	//////////////////////////////////////////////////// Layout ////////////////////////////////////////////////////
	array(
	'id' => 'verbosa_sitelayout',
		'type' => 'radioimage',
		'label' => __('Main Layout','verbosa'),
		'choices' => array(
			'1c' => array(
				'label' => __("One column (no sidebars)","verbosa"),
				'url'   => '%s/admin/images/1c.png'
			),
			'2cSl' => array(
				'label' => __("Two columns, sidebar on the left","verbosa"),
				'url'   => '%s/admin/images/2cSl.png'
			),
			'2cSr' => array(
				'label' => __("Two columns, sidebar on the right","verbosa"),
				'url'   => '%s/admin/images/2cSr.png'
			),
		),
		'desc' => __("Defines the general site layout.<br>This can be overridden in pages by using Page Templates.","verbosa"),
	'section' => 'verbosa_layout' ),
	array(
	'id' => 'verbosa_sitewidth',
		'type' => 'slider',
		'label' => 'Site Width',
		'min' => 960, 'max' => 1920, 'step' => 10, 'um' => 'px',
		'desc' => __("Select the maximum width (in pixels) of your site.","verbosa"),
	'section' => 'verbosa_layout' ),

	/* array(
	'id' => 'verbosa_contentwidth',
		'type' => 'slidertwo',
		'label' => 'Content/Sidebar Widths',
		'min' => 20, 'max' => 80, 'step' => 1, 'total' => 100, 'um' => '%',
		'desc' => __("Select the width (in percentage) of your <b>content</b> and <b>sidebar(s)</b>. When using a 3 columns layout (with 2 sidebars) they will each have half the configured width.","verbosa"),
	'section' => 'verbosa_layout' ), */

	array(
	'id' => 'verbosa_sidebar',
		'type' => 'slider',
		'label' => 'Sidebar Width',
		'min' => 300, 'max' => 700, 'step' => 10, 'um' => 'px',
		'desc' => __("Width (in pixels) of the sidebar.","verbosa"),
	'section' => 'verbosa_layout' ),

	array(
	'id' => 'verbosa_sidebarback',
		'type' => 'select',
		'label' => __('Stretch sidebar to edge','verbosa'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","verbosa"), __("Disable","verbosa") ),
		'desc' => __("Stretch the sidebar background to the edge of the screen. Enabled by default for a nice effect.","verbosa"),
	'section' => 'verbosa_layout' ),

	array(
	'id' => 'verbosa_magazinelayout',
		'type' => 'radioimage',
		'label' => __('Magazine Layout','verbosa'),
		'choices' => array(
			'1' => array(
				'label' => __("One column","verbosa"),
				'url'   => '%s/admin/images/magazine-1col.png'
			),
			'2' => array(
				'label' => __("Two columns","verbosa"),
				'url'   => '%s/admin/images/magazine-2col.png'
			),
			'3' => array(
				'label' => __("Three columns","verbosa"),
				'url'   => '%s/admin/images/magazine-3col.png'
			),
		),
		'desc' => __("This layout applies to post lists and will arrange posts in columns.","verbosa"),
	'section' => 'verbosa_layout' ),
	array(
	'id' => 'verbosa_contentmargintop',
		'type' => 'number',
		'label' => __('Margin top','verbosa'),
		'desc' => __("Set the top margin (in pixels) for the main content area.","verbosa"),
	'section' => 'verbosa_layout' ),
	array(
	'id' => 'verbosa_elementpadding',
		'type' => 'select',
		'label' => __('Post/page left/right padding','verbosa'),
		'values' => cryout_gen_values( 0, 15, 1, array('um'=>'') ),
		'desc' => __("Set the left/right padding (in percent) for each page/post/content element.","verbosa"),
	'section' => 'verbosa_layout' ),

	array(
	'id' => 'verbosa_footercols',
		'type' => 'select',
		'label' => __("Footer Widgets Columns","verbosa"),
		'values' => array(0, 1, 2, 3, 4),
		'labels' => array( "All in a row" , "1 Column", "2 Columns" , "3 Columns" , "4 Columns" ),
		'desc' => __("Set the number of footer widgets to display per row.","verbosa"),
	'section' => 'verbosa_layout' ),
	array(
	'id' => 'verbosa_footeralign',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Default","verbosa"), __("Center","verbosa") ),
		'label' => __('Footer Widgets Alignment','verbosa'),
		'desc' => __("Activate to center align footer widgets.","verbosa"),
	'section' => 'verbosa_layout' ),

	// Header
	array(
	'id' => 'verbosa_headerheight',
		'type' => 'number',
		'min' => 0,
		'max' => 800,
		'label' => __('Header Image Height','verbosa'),
		'desc' => __("Select the header image height (in pixels).","verbosa"),
	'section' => 'verbosa_siteheader' ),
	array(
	'id' => 'verbosa_siteheader',
		'type' => 'select',
		'label' => __('Site Header Content','verbosa'),
		'values' => array( 'title' , 'logo' , 'both' , 'empty' ),
		'labels' => array( __("Site Title","verbosa"), __("Logo","verbosa"), __("Logo & Site Title","verbosa"), __("Empty","verbosa") ),
		'desc' => '',
	'section' => 'verbosa_siteheader' ),
	array(
	'id' => 'verbosa_logoupload',
		'type' => 'media-image',
		'label' => __('Logo Image','verbosa'),
		'desc' => __("The logo will appear in the header.","verbosa"),
		'disable_if' => 'the_custom_logo',
	'section' => 'verbosa_siteheader' ),
	array(
	'id' => 'verbosa_menubullets',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Hide","verbosa"), __("Show","verbosa") ),
		'label' => __('Menu Bullets','verbosa'),
		'desc' => __("Show or hide the menu bullets","verbosa"),
	'section' => 'verbosa_siteheader' ),


	//////////////////////////////////////////////////// Colors ////////////////////////////////////////////////////

	array(
	'id' => 'verbosa_sitebackground',
		'type' => 'color',
		'label' => __('Site Background','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_sitetext',
		'type' => 'color',
		'label' => __('Site Text','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_contentbackground',
		'type' => 'color',
		'label' => __('Content Background','verbosa'),
		'desc' => __('Main content, breadcrumbs, pagination and content widgets background.','verbosa'),
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_sidebarbackground',
		'type' => 'color',
		'label' => __('Sidebar Background','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_menutext',
		'type' => 'color',
		'label' => __('Menu Text','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_menutexthover',
		'type' => 'color',
		'label' => __('Menu Text on Hover','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_footerbackground',
		'type' => 'color',
		'label' => __('Footer Widgets Background','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_titletext',
		'type' => 'color',
		'label' => __('Post/Page Titles','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_metatext',
		'type' => 'color',
		'label' => __('Post metas','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_accent1',
		'type' => 'color',
		'label' => __('Primary Accent','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),
	array(
	'id' => 'verbosa_accent2',
		'type' => 'color',
		'label' => __('Secondary Accent','verbosa'),
		'desc' => '',
	'section' => 'verbosa_colors' ),

	//////////////////////////////////////////////////// Fonts ////////////////////////////////////////////////////
	array( // general font
	'id' => 'verbosa_fgeneralsize',
		'type' => 'select',
		'label' => __('General Font','verbosa'),
		'values' => cryout_gen_values( 12, 20, 1, array('um'=>'px') ),
		'desc' => '',
	'section' => 'verbosa_fontfamily' ),
	array(
	'id' => 'verbosa_fgeneralweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontfamily' ),
	array(
	'id' => 'verbosa_fgeneral',
		'type' => 'font',
		'label' => '',
		'desc' => __("Select the general font options for the the site. This will apply to all content that is not controlled by the rest of the font options.","verbosa"),
	'section' => 'verbosa_fontfamily' ),
	array(
	'id' => 'verbosa_fgeneralgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected built-in font.<br><br>When using Google Fonts for General Font make sure they also have multiple font weights and that you specify them all eg.: <em>Roboto:400,300,500,700</em><br><br> <strong>Additional Info:</strong><br>The fonts under the <em>Preferred Theme Fonts</em> category are recommended for this because they have all the font weights used throughout the theme.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontfamily' ),

	array( // site title font
	'id' => 'verbosa_fsitetitlesize',
		'type' => 'select',
		'label' => __('Site Title','verbosa'),
		'values' => cryout_gen_values( 90, 250, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fsitetitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fsitetitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fsitetitlegoogle',
		'type' => 'text',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontheader' ),

	array( // site description font
	'id' => 'verbosa_fsitedescsize',
		'type' => 'select',
		'label' => __('Site Description','verbosa'),
		'values' => cryout_gen_values( 60, 120, 5, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fsitedescweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fsitedesc',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fsitedescgoogle',
		'type' => 'text',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontheader' ),

	array( // menu font
	'id' => 'verbosa_fmenusize',
		'type' => 'select',
		'label' => __('Main Menu','verbosa'),
		'values' => cryout_gen_values( 70, 150, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fmenuweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fmenu',
		'type' => 'font',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
	'section' => 'verbosa_fontheader' ),
	array(
	'id' => 'verbosa_fmenugoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontheader' ),

	array( // widget fonts
	'id' => 'verbosa_fwtitlesize',
		'type' => 'select',
		'label' => __('Widget Title','verbosa'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontwidget' ),
	array(
	'id' => 'verbosa_fwtitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontwidget' ),
	array(
	'id' => 'verbosa_fwtitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontwidget' ),
	array(
	'id' => 'verbosa_fwtitlegoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontwidget' ),

	array(
	'id' => 'verbosa_fwcontentsize',
		'type' => 'select',
		'label' => __('Widget Content','verbosa'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontwidget' ),
	array(
	'id' => 'verbosa_fwcontentweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontwidget' ),
	array(
	'id' => 'verbosa_fwcontent',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontwidget' ),
	array(
	'id' => 'verbosa_fwcontentgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontwidget' ),

	array( // content fonts
	'id' => 'verbosa_ftitlessize',
		'type' => 'select',
		'label' => __('Post/Page Titles','verbosa'),
		'values' => cryout_gen_values( 90, 220, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_ftitlesweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_ftitles',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_ftitlesgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontcontent' ),

	array( // post meta fonts
	'id' => 'verbosa_fmetassize',
		'type' => 'select',
		'label' => __('Post metas','verbosa'),
		'values' => cryout_gen_values( 60, 120, 5, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_fmetasweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_fmetas',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_fmetasgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontcontent' ),

	array(
	'id' => 'verbosa_fheadingssize',
		'type' => 'select',
		'label' => __('Headings','verbosa'),
		'values' => cryout_gen_values( 100, 150, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_fheadingsweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','verbosa'), __('400 (normal)','verbosa'), __('700 (bold)','verbosa'), __('800 (bolder)','verbosa') ),
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_fheadings',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'verbosa_fontcontent' ),
	array(
	'id' => 'verbosa_fheadingsgoogle',
		'type' => 'text',
		'label' => '',
		'desc' => __("Insert a Google font name/identifier in the field above to override the selected font.","verbosa"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font','verbosa') ),
	'section' => 'verbosa_fontcontent' ),

	array( // formatting
	'id' => 'verbosa_lineheight',
		'type' => 'select',
		'label' => __('General Line Height','verbosa'),
		'values' => cryout_gen_values( 1.0, 2.4, 0.2, array('um'=>'em') ),
		'desc' => __(" ","verbosa"),
	'section' => 'verbosa_textformatting' ),
	array(
	'id' => 'verbosa_textalign',
		'type' => 'select',
		'label' => __('Content Text Alignment','verbosa'),
		'values' => array( "Default" , "Left" , "Right" , "Justify" , "Center" ),
		'labels' => array( __("Default","verbosa"), __("Left","verbosa"), __("Right","verbosa"), __("Justify","verbosa"), __("Center","verbosa") ),
		'desc' => __("This overwrites the text alignment in posts and pages. Leave 'Default' for browser default.","verbosa"),
	'section' => 'verbosa_textformatting' ),
	array(
	'id' => 'verbosa_paragraphspace',
		'type' => 'select',
		'label' => __('Content Paragraph Spacing','verbosa'),
		'values' => cryout_gen_values( 0.5, 1.6, 0.1, array('um'=>'em', 'pre'=>array('0.0em') ) ),
		'desc' => __("Select the spacing between the paragraphs.","verbosa"),
	'section' => 'verbosa_textformatting' ),
	array(
	'id' => 'verbosa_parindent',
		'type' => 'select',
		'label' => __('Content Paragraph Indentation','verbosa'),
		'values' => cryout_gen_values( 0, 2, 0.5, array('um'=>'em') ),
		'desc' => __("Choose the indentation for your paragraphs.","verbosa"),
	'section' => 'verbosa_textformatting' ),

	//////////////////////////////////////////////////// Structure ////////////////////////////////////////////////////

	array(
	'id' => 'verbosa_breadcrumbs',
		'type' => 'select',
		'label' => __('Breadcrumbs','verbosa'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","verbosa"), __("Disable","verbosa") ),
		'desc' => __("Show breadcrumbs at the top of the content. Breadcrumbs are a form of navigation that keeps track of your location within the site.","verbosa"),
	'section' => 'verbosa_contentstructure' ),
	array(
	'id' => 'verbosa_pagination',
		'type' => 'select',
		'label' => __('Pagination','verbosa'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","verbosa"), __("Disable","verbosa") ),
		'desc' => __("Show numbered pagination. Where there is more than one page, instead of the bottom <em>Older Posts</em> and <em>Newer posts</em> links you will have a numbered pagination. ","verbosa"),
	'section' => 'verbosa_contentstructure' ),
	array(
	'id' => 'verbosa_contenttitles',
		'type' => 'select',
		'label' => __('Page/Category Titles','verbosa'),
		'values' => array( 1, 2, 3, 0 ),
		'labels' => array( __('Always Visible','verbosa'), __('Hide on Pages','verbosa'), __('Hide on Categories','verbosa'), __('Always Hidden','verbosa') ),
		'desc' => __("Control the visibility of titles on pages, categories and/or archives.","verbosa"),
	'section' => 'verbosa_contentstructure' ),
	array(
		'id' => 'verbosa_copyright',
		'type' => 'textarea',
		'label' => __( 'Custom Footer Text', 'verbosa' ),
		'desc' => __("Insert custom text or basic HTML code that will appear in you footer. <br /> You can use HTML to insert links, images and special characters.","verbosa"),
		'section' => 'verbosa_contentstructure' ),

	//////////////////////////////////////////////////// Graphics ////////////////////////////////////////////////////

	array(
	'id' => 'verbosa_elementborder',
		'type' => 'checkbox',
		'label' => __('Border','verbosa'),
		'desc' => '',
	'section' => 'verbosa_contentgraphics' ),
	array(
	'id' => 'verbosa_elementshadow',
		'type' => 'checkbox',
		'label' => __('Shadow','verbosa'),
		'desc' => '',
	'section' => 'verbosa_contentgraphics' ),
	array(
	'id' => 'verbosa_elementborderradius',
		'type' => 'checkbox',
		'label' => __('Rounded Corners','verbosa'),
		'desc' => __('These decorations apply to certain theme elements.','verbosa'),
	'section' => 'verbosa_contentgraphics' ),

	//////////////////////////////////////////////////// Search Box ////////////////////////////////////////////////////

	//////////////////////////////////////////////////// Post Image ////////////////////////////////////////////////////

	array(
	'id' => 'verbosa_image_style',
		'type' => 'radioimage',
		'label' => __('Post Images Style','verbosa'),
		'choices' => array(
			'verbosa-image-none' => array(
				'label' => __("No Styling","verbosa"),
				'url'   => '%s/admin/images/image-style-0.png'
			),
			'verbosa-image-one' => array(
				'label' => __("Style 1","verbosa"),
				'url'   => '%s/admin/images/image-style-1.png'
			),
			'verbosa-image-two' => array(
				'label' => __("Style 2","verbosa"),
				'url'   => '%s/admin/images/image-style-2.png'
			),
			'verbosa-image-three' => array(
				'label' => __("Style 3","verbosa"),
				'url'   => '%s/admin/images/image-style-3.png'
			),
			'verbosa-image-four' => array(
				'label' => __("Style 4","verbosa"),
				'url'   => '%s/admin/images/image-style-4.png'
			),
			'verbosa-image-five' => array(
				'label' => __("Style 5","verbosa"),
				'url'   => '%s/admin/images/image-style-5.png'
			),
		),
		'desc' => __("Define the border style for your images. Applies to captionless images in posts and pages.","verbosa"),
	'section' => 'verbosa_postimage' ),
	array(
	'id' => 'verbosa_caption_style',
		'type' => 'select',
		'label' => __('Post Captions Style','verbosa'),
		'values' => array( 'verbosa-caption-zero', 'verbosa-caption-one', 'verbosa-caption-two' ),
		'labels' => array( __('Plain','verbosa'), __('With Border','verbosa'), __('With Background','verbosa') ),
		'desc' => __("Define the caption style for your images. Applies to images that have captions. ","verbosa"),
	'section' => 'verbosa_postimage' ),


	//////////////////////////////////////////////////// Post Information ////////////////////////////////////////////////////

	array( // meta
	'id' => 'verbosa_meta_author',
		'type' => 'checkbox',
		'label' => __("Display Author","verbosa"),
		'desc' => '',
	'section' => 'verbosa_metas' ),
	array(
	'id' => 'verbosa_meta_date',
		'type' => 'checkbox',
		'label' => __("Display Date","verbosa"),
		'desc' => '',
	'section' => 'verbosa_metas' ),
	array(
	'id' => 'verbosa_meta_time',
		'type' => 'checkbox',
		'label' => __("Display Time","verbosa"),
		'desc' => '',
	'section' => 'verbosa_metas' ),
	array(
	'id' => 'verbosa_meta_category',
		'type' => 'checkbox',
		'label' => __("Display Category","verbosa"),
		'desc' => '',
	'section' => 'verbosa_metas' ),
	array(
	'id' => 'verbosa_meta_tag',
		'type' => 'checkbox',
		'label' => __("Display Tags","verbosa"),
		'desc' => '',
	'section' => 'verbosa_metas' ),
	array(
	'id' => 'verbosa_meta_comment',
		'type' => 'checkbox',
		'label' => __("Display Comments","verbosa"),
		'desc' => __("Choose the meta information you want to show on posts.","verbosa"),
	'section' => 'verbosa_metas' ),


	array( // comments
	'id' => 'verbosa_comclosed',
		'type' => 'select',
		'label' => __('Comments Closed Text','verbosa'),
		//'values' => array( "Show" , "Hide in posts", "Hide in pages", "Hide everywhere" ),
		'values' => array( 1, 2, 3, 0 ),
		'labels' => array( __("Show","verbosa"), __("Hide in posts","verbosa"), __("Hide in pages","verbosa"), __("Hide everywhere","verbosa") ),
		'desc' => __("Controls the <b>Comments are closed</b> text normally visible on pages and posts with comments disabled.","verbosa"),
	'section' => 'verbosa_comments' ),
	array(
	'id' => 'verbosa_comdate',
		'type' => 'select',
		'label' => __('Comment Date Format','verbosa'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Date Published","verbosa"), __("Time difference","verbosa") ),
		'desc' => __("Controls the comments' meta date format. While choosing <strong>Date Published</strong> shows the date when the comment was posted,
					<strong>Time difference</strong> shows the time that has passed since the comment was posted (ex.: <u>1 hour ago</u>, <u>5 mins ago</u>, <u>2 days ago</u>).","verbosa"),
	'section' => 'verbosa_comments' ),
	array(
	'id' => 'verbosa_comlabels',
		'type' => 'select',
		'label' => __('Comment Form Labels','verbosa'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Placeholders","verbosa"), __("Labels","verbosa") ),
		'desc' => __("Controls the comment form field labels appearance. Change to labels for better compatibility with comment-related plugins.","verbosa"),
	'section' => 'verbosa_comments' ),
	array(
	'id' => 'verbosa_comformwidth',
		'type' => 'number',
		'label' => __('Comment form width','verbosa'),
		'desc' => __("In pixels. Sets the maximum width for the comment form. Entering 0 as the value makes the comment form full width.","verbosa"),
	'section' => 'verbosa_comments' ),

	array( // excerpts
	'id' => 'verbosa_excerpthome',
		'type' => 'select',
		'label' => __( 'Posts on Homepage', 'verbosa' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","verbosa"), __("Full Post","verbosa") ),
		'desc' => __("Controls posts appearance on homepage. Only applies to standard posts; other post formats (aside, image, chat, quote etc.) have their specific formatting.","verbosa"),
	'section' => 'verbosa_excerpts' ),
	array(
	'id' => 'verbosa_excerptsticky',
		'type' => 'select',
		'label' => __( 'Sticky Posts on Homepage', 'verbosa' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Inherit","verbosa"), __("Full Post","verbosa") ),
		'desc' => __("Controls sticky posts appearance on the homepage.","verbosa"),
	'section' => 'verbosa_excerpts' ),
	array(
	'id' => 'verbosa_excerptarchive',
		'type' => 'select',
		'label' => __( 'Posts in Categories/Archives', 'verbosa' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","verbosa"), __("Full Post","verbosa") ),
		'desc' => __("Controls posts appearance in archive, category and search pages. Only applies to standard posts.","verbosa"),
	'section' => 'verbosa_excerpts' ),
	array(
	'id' => 'verbosa_excerptlength',
		'type' => 'number',
		'label' => __( 'Excerpt Length' , 'verbosa' ),
		'desc' => __("The number of words for excerpts. When excerpts are used posts are truncated to the number of words and a <i>Continue reading</i> link is appended linking to the full post page." , "verbosa"),
	'section' => 'verbosa_excerpts' ),
	array(
	'id' => 'verbosa_excerptdots',
		'type' => 'text',
		'label' => __( 'Excerpt Suffix', 'verbosa' ),
		'desc' => __("Defines the three dots '[...]' that are appended automatically to excerpts.","verbosa"),
	'section' => 'verbosa_excerpts' ),
	array(
	'id' => 'verbosa_excerptcont',
		'type' => 'text',
		'label' => __( 'Continue Reading Link', 'verbosa' ),
		'desc' => __("Defines the 'Continue Reading' link text appended to post excerpts.","verbosa"),
	'section' => 'verbosa_excerpts' ),

	//////////////////////////////////////////////////// Featured Images ////////////////////////////////////////////////////
	array(
	'id' => 'verbosa_fpost',
		'type' => 'select',
		'label' => __( 'Featured Images', 'verbosa' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","verbosa"), __("Disabled","verbosa") ),
		'desc' => __("Enable to show the selected featured image on blog and archive/category/search pages.","verbosa"),
	'section' => 'verbosa_featured' ),
	array(
	'id' => 'verbosa_fspost',
		'type' => 'select',
		'label' => __( 'Featured Images on Single Posts', 'verbosa' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","verbosa"), __("Disabled","verbosa") ),
		'desc' => __("Enable to also show the selected featured image on single posts and pages.","verbosa"),
	'section' => 'verbosa_featured' ),
	array(
	'id' => 'verbosa_fauto',
		'type' => 'select',
		'label' => __( 'Auto Select Images From Posts Content', 'verbosa' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","verbosa"), __("Disabled","verbosa") ),
		'desc' => __("Show the first image that you inserted in a post as a thumbnail. If there is a Featured Image selected for that post, it will have priority.","verbosa"),
	'section' => 'verbosa_featured' ),
/*	array(
	'id' => 'verbosa_fwidth',
		'type' => 'number',
		'label' => __( 'Featured Image Width', 'verbosa' ),
		'desc' => __(" ","verbosa"),
	'section' => 'verbosa_featured' ),*/
	array(
	'id' => 'verbosa_fheight',
		'type' => 'number',
		'label' => __( 'Featured Image Height', 'verbosa' ),
		'desc' => __("In pixels. The width is not configurable as it is site-width and layout dependent.<br><u style='color: #990000;'>Remember to regenerate your thumbnails after changing this value</u>" , "verbosa"),
	'section' => 'verbosa_featured' ),
	array(
	'id' => 'verbosa_fresponsive',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Cropped","verbosa"), __("Responsive","verbosa") ),
		'label' => __('Featured image responsiveness','verbosa'),
		'desc' => __("Select how your featured image looks and behaves.<br>A <strong>Responsive</strong> featured image will scale depending on the viewed resolution, while a <strong>Cropped</strong> featured image will always have the configured height.","verbosa"),
	'section' => 'verbosa_featured' ),
	array(
	'id' => 'verbosa_falign',
		'type' => 'select',
		'label' => __( 'Featured Image Alignment', 'verbosa' ),
		'values' => array( "left top" , "left center", "left bottom", "right top", "right center", "right bottom", "center top", "center center", "center bottom" ),
		'labels' => array( __("Left Top","verbosa"), __("Left Center","verbosa"), __("Left Bottom","verbosa"), __("Right Top","verbosa"), __("Right Center","verbosa"), __("Right Bottom","verbosa"), __("Center Top","verbosa"), __("Center Center","verbosa"), __("Center Bottom","verbosa") ),
		'desc' => __("Featured image image alignment. Only works when <b>Cropped</b> is chosen for the option above.","verbosa"),
	'section' => 'verbosa_featured' ),
	array(
	'id' => 'verbosa_fbar',
		'type' => 'number',
		'label' => __( 'Featured Bar Height' , 'verbosa' ),
		'desc' => __("In pixels. The bar that appears under the featured image." , "verbosa"),
	'section' => 'verbosa_featured' ),

	//////////////////////////////////////////////////// Social Positions ////////////////////////////////////////////////////

	array(
	'id' => 'verbosa_socials_header_above',
		'type' => 'checkbox',
		'label' => __( 'Display above Site Title', 'verbosa' ),
		'desc' => '',
	'section' => 'verbosa_socials' ),
	array(
	'id' => 'verbosa_socials_header_below',
		'type' => 'checkbox',
		'label' => __( 'Display below Site Title', 'verbosa' ),
		'desc' => '',
	'section' => 'verbosa_socials' ),
	array(
	'id' => 'verbosa_socials_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display at the bottom of the sidebar', 'verbosa' ),
		'desc' => '',
	'section' => 'verbosa_socials' ),

	//////////////////////////////////////////////////// Miscellaneous ////////////////////////////////////////////////////
	array(
		'id' => 'verbosa_customcss',
		'type' => 'textarea',
		'label' => __( 'Custom Theme CSS', 'verbosa' ),
		'desc' => __("Insert your custom theme CSS. Styling declarations made here will override the theme's if they are specific enough.","verbosa"),
		'section' => 'verbosa_misc' ),

	//////////////////////////////////////////////////// !!! DEVELOPER !!! ////////////////////////////////////////////////////
	array(
	'id' => 'verbosa_frontpageslider',
		'type' => 'select',
		'label' => __('Presentation Page Slider','verbosa'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled", "verbosa"), __("Disabled","verbosa") ),
		'desc' => sprintf( __("Enable the Presentation Page homepage slider above the posts list.","verbosa"), '#'),
	'section' => 'verbosa_developer' ),

), // options

/* option=array(
	type: checkbox, select, textarea, input, function
	id: field_name or custom_function_name
	values: value_0, value_1, value_2 | true/false | number
	labels: __('Label 0','context'), ... | __('Enabled','context')/... |  number/__('Once','context')/...
	desc: html to be displayed at the question mark
	section: section_id

	array(
	'id' => '',
		'type' => '',
		'label' => '',
		'values' => array(  ),
		'labels' => array(  ),
		'desc' => '',
		// conditionals
		'disable_if' => 'function_name',
		'require_fn' => 'function_name',
	'section' => '' ),

*/

/*** fonts ***/

'fonts' => array(

	'Recommended Google Fonts'=> array(
					"Merriweather/gfont",
					"Noto Serif/gfont",
					"Noto Sans/gfont",
					"PT Serif/gfont",
					"PT Sans/gfont",
					"Droid Serif/gfont",
					"Droid Sans/gfont",
					"Old Standard TT/gfont",
					"Lato/gfont",
					"Josefin Sans/gfont",
					"Open Sans/gfont",
					"Open Sans Condensed/gfont",
					"Source Sans Pro/gfont"
					),
	'Sans-Serif' => array(
					"Segoe UI, Arial, sans-serif",
					"Verdana, Geneva, sans-serif" ,
					"Geneva, sans-serif",
					"Helvetica Neue, Arial, Helvetica, sans-serif",
					"Helvetica, sans-serif" ,
					"Century Gothic, AppleGothic, sans-serif",
				    "Futura, Century Gothic, AppleGothic, sans-serif",
					"Calibri, Arian, sans-serif",
				    "Myriad Pro, Myriad,Arial, sans-serif",
					"Trebuchet MS, Arial, Helvetica, sans-serif" ,
					"Gill Sans, Calibri, Trebuchet MS, sans-serif",
					"Impact, Haettenschweiler, Arial Narrow Bold, sans-serif",
					"Tahoma, Geneva, sans-serif" ,
					"Arial, Helvetica, sans-serif" ,
					"Arial Black, Gadget, sans-serif",
					"Lucida Sans Unicode, Lucida Grande, sans-serif"
					),
	'Serif' => array(
					"Georgia, Times New Roman, Times, serif",
					"Times New Roman, Times, serif",
					"Cambria, Georgia, Times, Times New Roman, serif",
					"Palatino Linotype, Book Antiqua, Palatino, serif",
					"Book Antiqua, Palatino, serif",
					"Palatino, serif",
				    "Baskerville, Times New Roman, Times, serif",
 					"Bodoni MT, serif",
					"Copperplate Light, Copperplate Gothic Light, serif",
					"Garamond, Times New Roman, Times, serif"
					),
	'MonoSpace' => array(
					"Courier New, Courier, monospace" ,
					"Lucida Console, Monaco, monospace",
					"Consolas, Lucida Console, Monaco, monospace",
					"Monaco, monospace"
					),
	'Cursive' => array(
					"Lucida Casual, Comic Sans MS , cursive ",
				    "Brush Script MT,Phyllis,Lucida Handwriting,cursive",
					"Phyllis,Lucida Handwriting,cursive",
					"Lucida Handwriting,cursive",
					"Comic Sans MS, cursive"
					)
	), // fonts

/*** google font enabled option fields ***/
'google-font-enabled-fields' => array(
	'verbosa_fgeneral',
	'verbosa_fsitetitle',
	'verbosa_fsitedesc',
	'verbosa_fmenu',
	'verbosa_fwtitle',
	'verbosa_fwcontent',
	'verbosa_ftitles',
	'verbosa_fmetas',
	'verbosa_fheadings',
	),


/************* widget areas *************/

'widget-areas' => array(
	'widget-area-left' => array(
		'name' => __( 'Sidebar - Before menu', 'verbosa' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	),
	'widget-area-right' => array(
		'name' => __( 'Sidebar - After menu', 'verbosa' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	),
	'footer-widget-area' => array(
		'name' => __( 'Footer', 'verbosa' ),
		'description' 	=> __('You can select how many widgets to show per row from Graphics &raquo; Layout.', 'verbosa'),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="footer-widget-inside">',
		'after_widget' => '</div></section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	),
	'content-widget-area-before' => array(
		'name' => __( 'Content Before', 'verbosa' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	),
	'content-widget-area-after' => array(
		'name' => __( 'Content After', 'verbosa' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	),

), // widget-areas


); // $verbosa_big
