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

//$terms = get_terms('color', ['number' => 3]);
?>

<?php
$args = [
	'post_type' => 'artwork',
	'posts_per_page' => 25,
];
$artist = new WP_Query($args);
?>
<?php if ($artist->have_posts()): ?>
	<?php while ($artist->have_posts()): $artist->the_post(); ?>
		<div class="col-sm-6 col-md-4" style="margin-bottom: 40px;">
			<a href="<?php the_permalink(); ?>">
				<div
					style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover; height: 300px">
				</div>
				<h3>
					<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
				</h3>
			</a>
		</div>
	<?php endwhile; ?>
<?php endif; ?>


<?php wp_reset_query(); ?>