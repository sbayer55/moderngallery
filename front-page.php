<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Bootstrap
 * @subpackage Design-Expression
 */

get_header(); ?>

<section class="container">
	<div class="slider"
		 style="background-image: url('<?php echo get_bloginfo('template_directory'); ?>/images/slider.jpg');">
	</div>
</section>


<section class="container">
	<div class="color-1">
		<h1>Featured Artists</h1>
		<?php get_template_part('template-parts/artist-samples'); ?>
	</div>
</section>

	<section class="container featured-text">
		<div class="color-2">
			<?php if (have_posts()): ?>
				<?php while (have_posts()): ?>
					<?php the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>

			<?php endif; ?>
		</div>
	</section> <!-- container -->

	<section class="container">
		<div class="color-1">
			<div class="row">
				<div class="col-md-4">
					<h1>Be Original, Do Good</h1>
					<p>
						The Silent Vowel Art Gallery was established to encourage admirers to become collectors,
						creatives
						to become professionals, and buyers to become supporters.
					</p>
					<a href="http://localhost/index.php/be-original-do-good/" class="accent">Read More &raquo;</a>
				</div>
				<div class="col-md-4">
					<h1>Investing in Art</h1>
					<p>
						Becoming an art investor can sound like a frightening (and expensive) proposition. It doesn’t
						need
						to be.
					</p>
					<a href="http://localhost/index.php/investing-in-art/" class="accent">Read More &raquo;</a>
				</div>
				<div class="col-md-4">
					<h1>The Curator</h1>
					<p>
						Vestibulum porttitor feugiat neque nec viverra. Vivamus venenatis sed enim a ullamcorper. In in
						feugiat diam. Aliquam imperdiet egestas libero quis eleifend.
					</p>
					<a href="http://localhost/index.php/the-curator/" class="accent">Read More &raquo;</a>
				</div>
			</div>
		</div>
	</section>


	<script>
		var theme_url = "<?php echo get_template_directory_uri(); ?>";
		var foo;
		$(function () {
			$.ajaxSetup({
				url: '/wp-admin/admin-ajax.php',
				type: 'POST',
				dataType: 'JSON'
			});
		})
	</script>

<?php get_footer(); ?>
