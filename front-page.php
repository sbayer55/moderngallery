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
<section class="content">
	<div class="grid">
		<?php if ($artwork->have_posts() && false): ?>
			<?php while ($artwork->have_posts()): $artwork->the_post(); ?>

				<div class="grid-item">
					<?php the_content(); ?>
					<?php the_post_thumbnail('medium', ['class' => 'img-masonry']); ?>
				</div>

			<?php endwhile; ?>
		<?php endif; ?>

	</div>
</section><!-- container -->
<?php wp_reset_postdata(); ?>

<script>

	mg.cacheLoaded(function (artwork) {
		var $columns = [$('<div>', {class: 'grid-column'}), $('<div>', {class: 'grid-column'}), $('<div>', {class: 'grid-column'})];
		var nextColumn = 0;
		var count = 0;

		$('.grid').append($columns);

		$.each(artwork, function(index, value) {
			var $element = mg.toElement(value, count);
			$columns[nextColumn].append($element);

			$element.find('img').on('load', function() {
				$(this).closest('.grid-item').addClass('grid-item-loaded');
			});

			if (++nextColumn >= $columns.length) { nextColumn = 0; }
			count += 500;
		});
	})
</script>

<?php get_footer(); ?>