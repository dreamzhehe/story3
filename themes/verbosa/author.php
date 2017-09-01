<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Verbosa
 */

get_header(); ?>

		<div id="container" class="<?php echo verbosa_get_layout_class(); ?>">
			<?php verbosa_header_section() ?>
			<main id="main" role="main" <?php cryout_schema_microdata('main'); ?> class="main">
			<?php cryout_before_content_hook(); ?>
	
		
			<?php if ( have_posts() ) : ?>
			
				<?php
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					the_post();
				?>
			<header class="page-header pad-container">
				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts(); ?>

				<div id="author-info" <?php cryout_schema_microdata('author'); ?>>
				<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'verbosa_author_bio_avatar_size', 80 ), '', '', array('extra_attr' => cryout_schema_microdata('image', 0) ) ); ?>
					</div><!-- #author-avatar -->
					<h2 class="page-title" <?php cryout_schema_microdata('author-name', 0) ?>><?php echo __('Author:', 'verbosa') . ' <strong' . cryout_schema_microdata('author-name', 0) . '>' . esc_attr( get_the_author() ) . '</strong>'; ?></h2>
					
				<?php // If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="author-description" <?php cryout_schema_microdata('author-description'); ?>>
						<span><?php the_author_meta( 'description' ); ?></span>
					</div><!-- #author-description	-->
				<?php endif; ?>	
				</div><!-- #entry-author-info -->
			</header>
			<div id="content-masonry">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content/content', get_post_format() );
					?>

				<?php endwhile; ?>
				</div><!--content-masonry-->
				<?php 
				verbosa_pagination(); 
				
			else : 

				get_template_part( 'content/content', 'notfound' );
				?><div id="content-masonry"></div><?php
				
			endif; ?>
			
			<?php cryout_after_content_hook(); ?>
			</main><!-- #main -->
		</div><!-- #container -->

<?php get_footer(); ?>
