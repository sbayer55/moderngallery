<?php
/**
 * Template file for Gallery Collections
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


<?php if (have_posts()): ?>
	<?php while (have_posts()): ?>
		<?php the_post(); ?>
		<section class="container">
			<div class="row">

				<div class="col-sm-4">
					<a href="<?php the_permalink(); ?>" class="thumbnail">
						<img src="<?php the_post_thumbnail_url(); ?>">
					</a>
					<h3><?php the_title(); ?></h3>
					<h4>Syracuse, New York</h4>
					<div>
						<?php the_content(); ?>
					</div>
				</div> <!-- Left Column -->

				<!-- Right Column -->
				<div class="col-sm-8">
					<?php
					$args = [
						'post_type' => 'artwork',
						'meta_query' => [[
							'key' => 'Artist',
							'value' => get_the_title(),
							'compare' => '='
						]]
					];

					$artwork = new WP_Query($args);
					?>

					<div class="row">

						<?php if ($artwork->have_posts()): ?>
							<?php while ($artwork->have_posts()): $artwork->the_post(); ?>
								<div class="col-lg-6">
									<a href="<?php the_permalink(); ?>" class="thumbnail thumbnail-fixed">
										<div style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
									</a>
									<h2><?php the_title(); ?></h2>
									<hr>
								</div>

							<?php endwhile; ?>
						<?php endif; ?>

					</div>
				</div> <!-- Right column -->

			</div> <!-- row -->
		</section> <!-- container -->

	<?php endwhile; ?>
<?php endif; ?>

	<script>
		var theme_url = "<?php echo get_template_directory_uri(); ?>";
		var foo;
		$(function () {
		})
	</script>

<?php get_footer(); ?>