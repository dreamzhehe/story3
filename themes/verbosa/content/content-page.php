<?php
/**
 *
 * The template for displaying pages
 *
 * @package Verbosa
 */

if ( have_posts()  ) while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); cryout_schema_microdata('page');?>>
		<?php cryout_singlefeatured_hook(); ?>
		<header class="entry-header">
			<?php if ( is_front_page() ) { ?>
				<h2 class="entry-title" <?php cryout_schema_microdata('entry-title'); ?>><?php the_title(); ?></h2>
			<?php } else { ?>
				<h1 class="entry-title" <?php cryout_schema_microdata('entry-title'); ?>><?php the_title(); ?></h1>
			<?php } ?>
			<span class="entry-meta" >
				<?php edit_post_link( __( 'Edit', 'verbosa' ), '<span class="edit-link"><i class="icon-pencil2"></i> ', '</span>' ); ?>
			</span>
		</header>
		
		<div class="entry-content">
			<?php the_content(); ?>
			<div style="clear:both;"></div>
			
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'verbosa' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		
		<?php  comments_template( '', true ); ?>
		
	</article><!-- #post-## -->
	
<?php endwhile; ?>
