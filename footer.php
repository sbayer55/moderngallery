<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 * @since Modern Gallery 0.0.2
 */
?>

<!-- End Body: -->
</div>
<?php if (!is_home() && !is_front_page()): ?>
	<div class="">
		<nav>
			<ul class="pager">
				<?php if (get_next_post_link()): ?>
					<li class="previous">
						<?php echo get_next_post_link('%link', '&larr; %title'); ?>
					</li>
				<?php endif; ?>
				<?php if (get_previous_post_link()): ?>
					<li class="next">
						<?php echo get_previous_post_link('%link', '%title &rarr;'); ?>
					</li>
				<?php endif; ?>
				<!--li class="previous"><a href="#">&larr; Last</a></li>
				<li class="next"><a href="#">Next &rarr;</a></li-->
			</ul>
		</nav>
	</div>
<?php endif; ?>

<footer>
	<?php wp_footer(); ?>
</footer>

</body>
</html>
