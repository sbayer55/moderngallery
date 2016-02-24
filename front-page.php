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


<?php
$args = [
	'post_type' => 'artwork',
	'posts_per_page' => 5,
	'orderby' => 'rand'
];
?>

<?php $artwork = new WP_Query($args) ?>
<?php if ($artwork->have_posts()): ?>
	<section class="container">
		<div class="">

			<?php while ($artwork->have_posts()): $artwork->the_post(); ?>

				<?php the_content(); ?>
				<?php the_post_thumbnail('medium', ['class' => 'img-masonry']); ?>

			<?php endwhile; ?>

		</div>
	</section><!-- container -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
