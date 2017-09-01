<?php
/**
 * The index template for displaying content
 *
 * @package Verbosa
 */
?>
<div id="container" class="<?php echo verbosa_get_layout_class(); ?>">
	<?php verbosa_header_section() ?>
	<main id="main" role="main" <?php cryout_schema_microdata('main'); ?> class="main">
	<?php cryout_before_content_hook(); ?>
				
	<?php if ( have_posts() ) : ?>
	
		<div id="content-masonry">
			<?php /* Start the Loop */
			while ( have_posts() ) : the_post();
			get_template_part( 'content/content', get_post_format() );
			endwhile; ?>
		</div> <!-- content-masonry -->	
		<?php verbosa_pagination(); 
	
	else : 
		get_template_part( 'content/content', 'notfound' );
	endif; 

	cryout_after_content_hook(); ?>
	</main><!-- #main -->

</div><!-- #container -->
