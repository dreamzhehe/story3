<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Verbosa
 */

get_header();?>

<div id="container" class="<?php echo verbosa_get_layout_class(); ?>">
	<?php verbosa_header_section() ?>
	<main id="main" role="main" <?php cryout_schema_microdata('main'); ?> class="main">
	<?php cryout_before_content_hook(); ?>
			
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); cryout_schema_microdata('article');?>>
			<?php cryout_singlefeatured_hook(); ?>
			<header class="entry-header">
				<?php cryout_post_title_hook(); ?>
				<h1 class="entry-title" <?php cryout_schema_microdata('entry-title'); ?>><?php the_title(); ?></h1>
				<div class="entry-meta">
					<?php cryout_post_meta_hook(); ?>
				</div><!-- .entry-meta -->
			</header>
			
			<div class="entry-content" <?php cryout_schema_microdata('entry-content'); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'verbosa' ), 'after' => '</span></div>' ) ); ?>
			</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
			<div id="entry-author-info" <?php cryout_schema_microdata('author'); ?>>
			
				<div id="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'verbosa_author_bio_avatar_size', 80 ), '', '', array('extra_attr' => cryout_schema_microdata('image', 0) ) ); ?>
				</div><!-- #author-avatar -->
			
				<h2 class="page-title">
					<?php echo __('About','verbosa').' <strong'. cryout_schema_microdata('author-name', 0) .'>'.esc_attr( get_the_author() ). '</strong>'; ?>
				</h2>
				
				<div id="author-description"  <?php cryout_schema_microdata('author-description'); ?>>
					<span><?php the_author_meta( 'description' ); ?></span>
					<div id="author-link">
						<a class="continue-reading-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"  <?php cryout_schema_microdata('author-url'); ?>>
							<span><?php printf( __( 'View all posts by ','verbosa').'%s' . '</span>' . '<i class="icon-arrow-right2"></i>', get_the_author() ); ?>
						</a>
					</div><!-- #author-link	-->
				</div><!-- #author-description -->
				
			</div><!-- #entry-author-info -->
<?php endif; ?>

			<footer class="entry-meta">
				<?php cryout_post_footer_hook(); ?>
			</footer><!-- .entry-meta -->
		
			<nav id="nav-below" class="navigation" role="navigation">
				<div class="nav-previous"><em><?php _e('Previous Post', 'verbosa');?></em><?php previous_post_link( '%link', '<span>%title</span>' ); ?></div>
				<div class="nav-next"><em><?php _e('Next Post', 'verbosa');?></em><?php next_post_link( '%link', '<span>%title</span>' ); ?></div>
			</nav><!-- #nav-below -->

		<?php comments_template( '', true ); ?>
			
		</article><!-- #post-## -->

<?php endwhile; // end of the loop. ?>

	<?php cryout_after_content_hook(); ?>
	</main><!-- #main -->
</div><!-- #container -->

<?php get_footer();
