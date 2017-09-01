<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Verbosa
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); cryout_schema_microdata('article');?>>
<?php cryout_featured_hook(); ?>
	
	<header class="entry-header">
	<?php cryout_post_title_hook(); ?>
			
		<h2 class="entry-title"  <?php cryout_schema_microdata('entry-title'); ?>>
			<span class="entry-format"><i class="icon-star-full" title="<?php _e( 'Status', 'verbosa' ); ?>"></i></span>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'verbosa' ), the_title_attribute( 'echo=0' ) ); ?>" 
			rel="bookmark"  <?php cryout_schema_microdata('url'); ?>><?php the_title(); ?></a>
		</h2>	
		<div class="entry-meta">
			<?php	cryout_post_meta_hook();  ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->
	
	<?php cryout_post_before_content_hook();  ?>
	<div class="entry-content"  <?php cryout_schema_microdata('entry-content'); ?>>	
	
		<div class="avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'verbosa_status_avatar', '65' ) ); ?>
		</div>
		<div class="status_content">	
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'verbosa' ) ); ?> 
		</div>
		
	</div><!-- .entry-content -->
	
	<footer class="post-continue-container">
		<?php cryout_post_after_content_hook();  ?>
	</footer>
	
</article><!-- #post-<?php the_ID(); ?> -->
