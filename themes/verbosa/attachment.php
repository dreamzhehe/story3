<?php
/**
 * The template for displaying attachments.
 *
 * @package Verbosa
 */

get_header(); ?>

<div id="container" class="single-attachment <?php echo verbosa_get_layout_class(); ?>">
	<?php verbosa_header_section() ?>
	<main id="main" role="main" class="main">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class("post"); cryout_schema_microdata('article');?>>

			<header>
				<?php cryout_post_title_hook(); ?>
				<h1 class="entry-title" <?php cryout_schema_microdata('entry-title'); ?>><?php the_title(); ?></h1>
				<div class="entry-meta">
					<?php cryout_post_meta_hook();
					echo "<span class=\"attach-size\">";
						if ( wp_attachment_is_image() ) {
							$metadata = wp_get_attachment_metadata();
							printf( __( 'Full size is %s pixels', 'verbosa'),
								sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
									esc_url( wp_get_attachment_url() ),
									esc_attr( __('Link to full-size image', 'verbosa') ),
									$metadata['width'],
									$metadata['height']
								)
							);
						}
					echo "</span>"; ?>
				</div><!-- .entry-meta -->
			</header>

			<div class="entry-content" <?php cryout_schema_microdata('entry-content'); ?>>
				<div class="entry-attachment">

<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = esc_url( get_attachment_link( $attachments[ $k ]->ID ) );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = esc_url( get_attachment_link( $attachments[ 0 ]->ID ) );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = esc_url( wp_get_attachment_url() );
	}
?>
					<p class="attachment">
						<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_size = apply_filters( 'verbosa_attachment_size', 900 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.?>
						</a>
					</p>

				<div class="entry-caption">
					<?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
				</div>

<?php else : ?>
					<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( esc_url( get_permalink() ) ); ?></a>
<?php endif; ?>
				</div><!-- .entry-attachment -->

					<footer class="entry-meta">
						<?php cryout_post_footer_hook(); ?>
						<?php if ( ! empty( $post->post_parent ) ) : ?>
					<p class="page-title"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ) ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'verbosa' ), get_the_title( $post->post_parent ) ) ); ?>" ><?php
						/* translators: %s - title of parent post */
						printf( '&laquo; %s', get_the_title( $post->post_parent ) );
					?></a></p>
				<?php endif; ?>
					</footer><!-- .entry-meta -->



			</div><!-- .entry-content -->

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_image_link( false,'<i class="icon-arrow-left2"></i>'.__("Previous image","verbosa")); ?></div>
				<div class="nav-next"><?php next_image_link( false,__("Next image","verbosa").'<i class="icon-arrow-right2"></i>' ); ?></div>
			</div><!-- #nav-below -->

		<?php  comments_template( '', true ); ?>

		</article><!-- #post-## -->


<?php endwhile; ?>



			</main><!-- #main -->
		</div><!-- #container -->

<?php get_footer(); ?>
