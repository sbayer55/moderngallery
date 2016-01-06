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

	<section class="container">
		<?php
		$currenty_term = get_queried_object();
		$taxonomy = get_taxonomy($currenty_term->taxonomy);
		?>
		<h2><?php echo "$taxonomy->label: $currenty_term->name"; ?></h2>
	</section>

	<section class="container">
		<div class="row">

			<?php if (have_posts()): ?>
				<?php while (have_posts()): ?>
					<?php the_post(); ?>

					<div class="col-sm-6 col-lg-4">
						<a href="<?php the_permalink(); ?>" class="thumbnail thumbnail-fixed">
							<div style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
							<div class="slide-up-on-hover">
								<div class="">
									<span class="title"><?php the_title(); ?></span>
								</div>
							</div>
							</div>
						</a>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</div> <!-- row -->
	</section> <!-- container -->


	<script>
		var theme_url = "<?php echo get_template_directory_uri(); ?>";
		var foo;
		$(function () {
		})
	</script>

<?php get_footer(); ?>