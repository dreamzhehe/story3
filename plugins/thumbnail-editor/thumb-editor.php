<?php
/*
Plugin Name: Thumbnail Editor
Plugin URI: https://wordpress.org/plugins/thumbnail-editor/
Description: Manually <strong>Crop</strong> and <strong>Resize</strong> thumbnail images that are uploaded in the Media section.
Version: 2.2.1
Text Domain: thumbnail-editor
Domain Path: /languages
Author: aviplugins.com
Author URI: http://www.aviplugins.com/
*/

/**
	  |||||   
	<(`0_0`)> 	
	()(afo)()
	  ()-()
**/


include_once dirname( __FILE__ ) . '/thumb-editor-process.php';
include_once dirname( __FILE__ ) . '/thumb-editor-function.php';

class thumbnail_editor_setup {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'additional_scripts' ) );
		add_filter( 'media_row_actions', array( $this, 'afo_media_row_actions' ), 10, 3); 
		add_filter( 'attachment_fields_to_edit', array( $this, 'media_thumbnail_edit_link' ), 10, 20 );
		add_action( 'plugins_loaded',  array( $this, 'thumb_editor_afo_text_domain' ) );
	}
	
	public function additional_scripts(){
		wp_enqueue_script( 'jquery.Jcrop', plugins_url( 'js/jquery.Jcrop.js' , __FILE__ ) );
		wp_enqueue_script( 'jquery.cr', plugins_url( 'js/jquery.cr.js' , __FILE__ ) );
		wp_enqueue_script( 'jquery-ui-resizable' );
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_style( 'jquery.Jcrop', plugins_url( 'css/jquery.Jcrop.css' , __FILE__ ) );
		wp_enqueue_style( 'jquery-ui', plugins_url( 'css/jquery-ui.css' , __FILE__ ) );
		wp_enqueue_style( 'editor', plugins_url( 'css/editor.css' , __FILE__ ) );
	}
	
	public function afo_media_row_actions($actions, $post, $detached){
		$actions['thued'] = '<a href="options-general.php?page=thumbnail_editor_setup_data&att_id='.$post->ID.'" title="Crop Thumbnail">'.__('Crop Thumbnail','thumbnail-editor').'</a>';
		return $actions;
	}
	
	public function thumb_editor_afo_text_domain(){
		load_plugin_textdomain('thumbnail-editor', FALSE, basename( dirname( __FILE__ ) ) .'/languages');
	}
	
	public function media_thumbnail_edit_link( $form_fields, $post ) {
		$hide_info = '<style>.media-types-required-info{display:none;}</style>';
		
		$form_fields['th-editor-link'] = array(
			'label' => '',
			'input' => 'html',
			'html'  => '<a href="options-general.php?page=thumbnail_editor_setup_data&att_id='.$post->ID.'" title="Crop Thumbnail">'.__('Crop Thumbnail','thumbnail-editor').'</a>' . $hide_info,
		);
		
		return $form_fields;
	}
	
	public function admin_menu () {
		add_options_page( 'Thumbnail Editor','Thumbnail Editor','manage_options','thumbnail_editor_setup_data', array( $this, 'settings_page' ) );
	}
	
	public function  settings_page () {
		echo '<div class="wrap">';
		if(isset($GLOBALS['msg'])){
        	echo '<div class="updated notice notice-success"><p>'.$GLOBALS['msg'].'</p></div>';
		}
		
		$att_id = '';
		$this->thumbnail_editor_pro_add();
		$this->help_support();
		
		if(isset($_REQUEST['att_id'])){
			$att_id = sanitize_text_field($_REQUEST['att_id']);
		}
		
		if($att_id == ''){
			echo '<p>Goto <a href="upload.php"><strong>Media Library</strong></a> and select <strong>Crop Thumbnail</strong> link to modify image thumbnails.</p>';
			return;
		}
		
		$full_image = wp_get_attachment_image_src( $att_id, 'full' );
		if($full_image == ''){
			echo '<p>Please select an <strong>Image</strong> file to edit. Go back to <a href="upload.php"><strong>Media Library</strong></a></p>';
			return;
		}
		?>
		<form id="coords" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="th_edit_option" id="th_edit_option" value="imageCrop">
        <?php wp_nonce_field( 'th_edit_save_action', 'th_edit_save_action_field' ); ?>
        <table width="100%" border="0" style="background-color:#fff; border:1px solid #CCCCCC; margin:2px 0px 0px 0px; padding:5px;">
          <tbody>
          <tr>
              <td> 
              <div class="tools">
              <strong><?php _e('Tools','thumbnail-editor');?> </strong>            
              <img src="<?php echo  plugin_dir_url( __FILE__ ) . '/images/crop.png';?>" class="tool-item" alt="Crop" onClick="ImageEditor('crop');" title="Crop ( Drag inside the image to Crop )" id="crop-tool">
               <img src="<?php echo  plugin_dir_url( __FILE__ ) . '/images/resize.png';?>" class="tool-item" alt="Resize" onClick="ImageEditor('resize');" title="Resize ( Drag image from Bottom / Right Corners to Resize )" id="resize-tool">
              <i><?php _e('Select a tool to start editing','thumbnail-editor');?></i>
              </div>
              </td>
            </tr>
            <tr>
              <td><img src="<?php echo $full_image[0];?>" id="target" style="border:1px dashed #CCCCCC;"></td>
            </tr>
            <tr>
              <td>
                <input type="hidden" name="att_id" value="<?php echo $att_id;?>">
                <div class="inline-labels">
                <input type="hidden" size="4" id="x1" name="x1" />
                <input type="hidden" size="4" id="y1" name="y1" />
                <input type="hidden" size="4" id="x2" name="x2" />
                <input type="hidden" size="4" id="y2" name="y2" />
                <p>
                <label><strong><?php _e('Crop Width','thumbnail-editor');?></strong> <input type="text" size="4" id="w" name="w" readonly /></label>
                <label><strong><?php _e('Crop Height','thumbnail-editor');?></strong> <input type="text" size="4" id="h" name="h" readonly /></label>
                </p>
                <p>
                <label><strong><?php _e('Resize Width','thumbnail-editor');?></strong> <input type="text" size="4" id="rw" name="rw" readonly /></label>
                <label><strong><?php _e('Resize Height','thumbnail-editor');?></strong> <input type="text" size="4" id="rh" name="rh" readonly /></label>
                </p>
                <p>
                <select name="crop_type">
					<?php
                    $sizes = get_intermediate_image_sizes();
                    foreach($sizes as $key => $value){
						$s = $this->get_image_sizes($value);
                        echo '<option value="'.$value.'">'.$value.' - '.$s['width'].'x'.$s['height'].'</option>';
                    }
                    ?>
            	</select>
                <input type="submit" name="submit" value="<?php _e('Edit Image','thumbnail-editor');?>" class="button button-primary"></p>
				<p><?php _e('Once Image is updated you can check the updated image from the below list of thumbnails. The above image will not be effected by the changes you make.','thumbnail-editor');?>
                </p>
                </div>
              </td>
            </tr>
            <tr>
            <td><hr>
            <h3><?php _e('List of Available Thumbnail Types','thumbnail-editor');?></h3>
            <p><?php printf( esc_html__( 'If thumbnail images doesn\'t reflect the changes you made please use %s or clear browser cache. More editing options are available with %s version.', 'thumbnail-editor' ), '<strong>Ctrl + F5</strong>', '<a href="http://www.aviplugins.com/thumbnail-editor-pro/" target="_blank">PRO</a>' );?>
            </p>
            </td>
            </tr>
            <?php
			$sizes = get_intermediate_image_sizes();
			foreach($sizes as $key => $value){
				$full_image = wp_get_attachment_image_src( $att_id, $value );
				echo '<tr>
            		<td>
					<div style="border:1px dashed #ccc; padding:5px;">
						<p><h3>'.$value.'</h3></p>
						<img src="'.$full_image[0].'">
						<p><strong>Usage</strong> <br>
						<span style="color:#0000ff;">get_thumb_image_src( "attachment id", "thumbnail type" ); </span>
						<br>
						<br>
						<strong>'.__('Example','thumbnail-editor').'</strong> 
						<br>
						// this will output the image src <br>
						<span style="color:#0000ff;">echo get_thumb_image_src( "'.$att_id.'", "'.$value.'" );</span> <br>
						<strong>Shortcode</strong> [thumb_image_src att_id="'.$att_id.'" type="'.$value.'"] 
						<br>
						<br>
						// this will output the image <br>
						<span style="color:#0000ff;"> echo get_thumb_image( "'.$att_id.'", "'.$value.'" ); </span>
						<br>
						<strong>Shortcode</strong> [thumb_image att_id="'.$att_id.'" type="'.$value.'"] <br>
						
						</p>
					</div>
					</td>
            	</tr>';
			}
			?>
          </tbody>
        </table>
         </form>
        <?php
		$this->donate();
		echo '<div>';
	}

	public function help_support(){ ?>
	<table width="100%" border="0" style="background-color:#FFFFFF; border:1px solid #999999; padding:2px 0px 2px 10px; margin:5px 0px;">
	  <tr>
		<td align="right"><a href="http://www.aviplugins.com/support.php" target="_blank">Help and Support</a> <a href="http://www.aviplugins.com/rss/news.xml" target="_blank"><img src="<?php echo  plugin_dir_url( __FILE__ ) . '/images/rss.png';?>" style="vertical-align: middle;" alt="RSS"></a></td>
	  </tr>
	</table>
	<?php
	}
	
	public function donate(){	?>
	<table width="100%" border="0" style="background-color:#FFF; border:1px solid #ccc; margin:2px 0px; padding-right:10px;">
	 <tr>
	 <td align="right"><a href="http://www.aviplugins.com/donate/" target="_blank">Donate</a> <img src="<?php echo  plugin_dir_url( __FILE__ ) . '/images/paypal.png';?>" style="vertical-align: middle;" alt="PayPal"></td>
	  </tr>
	</table>
	<?php
	}
	
	public function thumbnail_editor_pro_add(){ ?>
	<table border="0" style="width:100%;background-color:#FFFFD2; border:1px solid #E6DB55; padding:0px 0px 0px 10px; margin:5px 0px;">
  <tr>
    <td>
    <strong>Thumbnail Editor PRO</strong>
    <p>The <strong>PRO</strong> version of this plugin has additional features. <strong>1.</strong> Add custom <strong>Text Signature</strong> in the images. <strong>2.</strong> Add image <strong>Borders</strong>. <strong>3.</strong> Add Image <strong>Effects</strong> like <strong>Gray Scale, Sketch, Negative</strong> or Add <strong>Image Color Effects</strong>. <strong>4.</strong> Option to <strong>Revert Back</strong> the changes you made in the image. Get <strong>Thumbnail Editor PRO</strong> from <a href="http://www.aviplugins.com/thumbnail-editor-pro/" target="_blank">here</a> in <strong>USD 2.00</strong> </p></td>
  </tr>
</table>
	<?php }
	
	
	public function get_image_sizes( $size = '' ) {
		global $_wp_additional_image_sizes;
		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		// Create the full array with sizes and crop info
		foreach( $get_intermediate_image_sizes as $_size ) {
				if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
						$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
						$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
						$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
		
				} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
						$sizes[ $_size ] = array( 
								'width' => $_wp_additional_image_sizes[ $_size ]['width'],
								'height' => $_wp_additional_image_sizes[ $_size ]['height'],
								'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
						);
				}
		}
		if ( $size ) {
				if( isset( $sizes[ $size ] ) ) {
						return $sizes[ $size ];
				} else {
						return false;
				}
		}
		return $sizes;
	}

}

new thumbnail_editor_setup;
new thumbnail_editor_process;

add_shortcode( 'thumb_image', 'get_thumb_image_sc' );
add_shortcode( 'thumb_image_src', 'get_thumb_image_src_sc' );