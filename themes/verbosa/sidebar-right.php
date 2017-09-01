<?php
/**
 * The Sidebar that is normally displayed on the right side (Secondary).
 *
 * @package Verbosa
 */
?>

<aside id="secondary" class="widget-area sidey" role="complementary" <?php cryout_schema_microdata('sidebar');?>>
<?php cryout_before_secondary_widgets_hook(); ?>

		<?php if (is_active_sidebar('widget-area-right')): 
					dynamic_sidebar( 'widget-area-right' );
			  endif; ?>

	<?php cryout_after_primary_widgets_hook(); ?>

</aside>
