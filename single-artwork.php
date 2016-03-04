<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 * @since Bootstrap 0.0.2
 */

get_header(); ?>

	<section class="content">

		<?php if (have_posts()): ?>
			<?php while (have_posts()): ?>
				<?php the_post(); ?>


				<div class="thumbnail">
					<img class="img-fullwidth" src="<?php the_post_thumbnail_url(); ?>">
				</div>
				<div class="row">
					<div class="col-sm-8">
						<p>
						<h1><?php the_title(); ?></h1>
						</p>
						<?php if ($artist = get_post_meta($post->ID, 'Artist', true)): ?>
							<p>
								<?php $artist_post = get_page_by_title($artist, 'OBJECT', 'artist'); ?>
								<a href="<?php echo get_permalink($artist_post->ID); ?>">
									Artist: <?php echo $artist; ?>
								</a>
							</p>
						<?php endif; ?>
						<?php if ($width = get_post_meta($post->ID, 'Width', true)): ?>
							<?php if ($height = get_post_meta($post->ID, 'Height', true)): ?>
								<p>
									<?php echo "Dimensions $width x $height"; ?>
								</p>
							<?php endif; ?>
						<?php endif; ?>
						<p>
							<?php echo get_the_term_list($post->ID, 'collection', 'Related Collections ', ', ', ''); ?>
						</p>
						<p>
							<?php echo get_the_term_list($post->ID, 'color', 'Related Colors ', ', ', ''); ?>
						</p>
					</div>
					<div class="col-sm-4">
						<?php if ($price = get_post_meta($post->ID, 'Price', true)): ?>
							<div
								style="background-color: #23282d; color: #8A8A8A; margin-top: 20px; padding: 5px 15px 20px">

								<h3><?php echo "Price $$price"; ?></h3>
								<button class="btn btn-primary">Buy Now</button>
								<button class="btn btn-default">Add To Cart</button>
							</div>
						<?php endif; ?>
					</div>
				</div>


			<?php endwhile; ?>

		<?php endif; ?>

	</section> <!-- container -->


<?php get_footer(); ?>