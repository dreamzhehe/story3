<?php
/**
 * The default template for displaying content
 *
 * @package Verbosa
 */

$verbosas = cryout_get_option( array('verbosa_excerptarchive', 'verbosa_excerptsticky', 'verbosa_excerpthome') );

?><?php cryout_before_article_hook(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); cryout_schema_microdata('article'); ?>>
	<?php cryout_featured_hook(); ?>
	
	<header class="entry-header">	
	<?php cryout_post_title_hook(); ?>		
		<h2 class="entry-title"  <?php cryout_schema_microdata('entry-title'); ?>>
		<?php if (is_sticky()) { ?><span class="entry-format"><i class="icon-pushpin" title="<?php _e( 'Sticky', 'verbosa' ); ?>"></i></span>	<?php } ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" <?php cryout_schema_microdata('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h2>
		<div class="entry-meta">
			<?php cryout_post_meta_hook(); ?>
		</div><!-- .entry-meta -->	
			
	</header><!-- .entry-header -->
		
	<?php cryout_post_before_content_hook(); ?>
	<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			
		<?php if ($verbosas['verbosa_excerptarchive'] != "full" ){ ?>
						
			<div class="entry-summary" <?php cryout_schema_microdata('entry-summary'); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			
			<footer class="post-continue-container">
				<?php cryout_post_excerpt_hook(); ?>
			</footer>
						
		<?php } else { ?>
						
			<div class="entry-content" <?php cryout_schema_microdata('entry-content'); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'verbosa' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content --> 
						
		<?php }   ?>
			
	<?php else :
		
			if (is_sticky() && $verbosas['verbosa_excerptsticky'] == "full") { $sticky_test = 1; } 
				else { $sticky_test = 0; }
			if ($verbosas['verbosa_excerpthome'] != "full" && $sticky_test == 0){ ?>
					
				<div class="entry-summary" <?php cryout_schema_microdata('entry-summary'); ?>>
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->	
				<footer class="post-continue-container">
					<?php cryout_post_excerpt_hook(); ?>
				</footer>
						
			<?php } else { ?>
				
				<div class="entry-content" <?php cryout_schema_microdata('entry-content'); ?>>
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'verbosa' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content --> 
						
			<?php }  

	endif; ?>
					
<?php cryout_post_after_content_hook();  ?>	
</article><!-- #post-<?php the_ID(); ?> -->
	
<?php cryout_after_article_hook(); ?>