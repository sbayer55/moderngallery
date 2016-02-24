<?php
/**
 * Modern Gallery functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Modern Gallery
 * @subpackage Design-Expression
 */

if (version_compare($GLOBALS['wp_version'], '4.4-alpha', '<')) {
	error_log('Using Modern Gallery theme with legacy Wordpress');
}

if (!function_exists('moderngallery_setup')) {
	function moderngallery_setup()
	{
		// Add default posts and comments RSS feed links to head.
		//add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		//add_theme_support('title-tag');

		// Define thumbnail support
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1200, 0, true);

		// Define nav menus
		register_nav_menus([
			'primary' => __('Primary Menu', 'moderngallery'),
			'footer_column_1' => __('Footer Column 1', 'moderngallery'),
			'footer_column_2' => __('Footer Column 2', 'moderngallery'),
			'footer_column_3' => __('Footer Column 3', 'moderngallery'),
			'footer_column_4' => __('Footer Column 4', 'moderngallery'),
		]);

		// Switch default core to be HTML5 compatable
		add_theme_support('html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		]);

		// Define post formats
		add_theme_support('post-formats', [
			'image',
			'video',
			'quote',
			'link',
			'gallery'
		]);
	}
} // end if (!function_exists('moderngallery_setup'))

add_action('after_setup_theme', 'moderngallery_setup');

function moderngallery_content_width()
{
	$GLOBALS['content_width'] = apply_filters('moderngallery_content_width', 1060);
}

add_action('after_setup_theme', 'moderngallery_content_width', 0);

function moderngallery_javascript_detection()
{
	error_log('moderngallery_javascript_detection used!');
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'moderngallery_javascript_detection', 0);

function moderngallery_scripts()
{
	wp_enqueue_style('moderngallery-fonts', 'https://fonts.googleapis.com/css?family=Scheherazade', [], null);
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', [], null);
	wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.css', [], null);
	wp_enqueue_style('moderngallery-theme-style', get_template_directory_uri() . '/style.css', [], null);
	wp_enqueue_script('jquery-script', get_template_directory_uri() . '/js/jquery-2.1.4.js', [], null);
	wp_enqueue_script('jquery-script', get_template_directory_uri() . '/js/jquery.validate.js', [], null);
	wp_enqueue_script('moderngallery-script', get_template_directory_uri() . '/js/bootstrap.js', [], null);
}

add_action('wp_enqueue_scripts', 'moderngallery_scripts');

function moderngallery_widget_init() {
	/*
	register_sidebar([
		'name'			=> 'sidebar',
		'id'			=> 'sidebar-primary',
		'description'	=> 'The main sidebar, visible on most pages',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>'
	]);
	*/
}
add_action('widgets_init', 'moderngallery_widget_init');

function setup_custom_post_types()
{
	$artwork_labels = [
		'name' => 'Artwork',
		'singular_name' => 'Artwork',
		'menu_name' => 'Artwork',
		'name_admin_bar' => 'Artwork',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Artwork',
		'new_item' => 'New Artwork',
		'edit_item' => 'Change Artwork Image',
		'view_item' => 'View Artwork',
		'all_items' => 'Catalog',
		'search_items' => 'Search For Artwork',
		'parent_item_colon' => 'Parent Artwork =>',
		'not_found' => 'The Artwork is missing! (404, Not Found)',
		'not_found_in_trash' => 'The Artwork is missing from trash!'
	];

	$artwork_args = [
		'labels' => $artwork_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-format-image',
		'query_var' => true,
		'rewrite' => ['slug' => 'artwork'],
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => ['title', 'thumbnail']
	];
	register_post_type('artwork', $artwork_args);

	$artist_labels = [
		'name' => 'Artist',
		'singular_name' => 'Artist',
		'menu_name' => 'Artist',
		'name_admin_bar' => 'Artist',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Artist',
		'new_item' => 'New Artist',
		'edit_item' => 'Edit Artist Bio',
		'view_item' => 'View Artist',
		'all_items' => 'All Artists',
		'search_items' => 'Search For Artist',
		'parent' => 'Parent Artist',
		'parent_item_colon' => 'Parent Artist =>',
		'not_found' => 'Artist not found',
		'not_found_in_trash' => 'Artist not found in the trash'
	];

	$artist_args = [
		'labels' => $artist_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-users',
		'query_var' => true,
		'rewrite' => ['slug' => 'artist'],
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'supports' => ['title', 'editor', 'thumbnail']
	];
	register_post_type('artist', $artist_args);

	$collection_labels = [
		'name' => 'Art Collection',
		'singular_name' => 'Collection',
		'search_items' => 'Search Collection',
		'all_items' => 'All Collections',
		'parent_item' => 'Parent Collection',
		'parent_item_colon' => 'Parent Collection =>',
		'edit_item' => 'Edit Collection',
		'update_item' => 'Update Collection',
		'add_new_collection' => 'Add A New Type Of Collection',
		'new_item_name' => 'New Collection Name',
		'menu_name' => 'Collection(s)'
	];

	$collection_args = [
		'hierarchical' => true,
		'labels' => $collection_labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'rewrite' => ['slug' => 'collection']
	];

	register_taxonomy('collection', ['artwork', 'artist'], $collection_args);

	$color_labels = [
		'name' => 'Color',
		'singular_name' => 'Color Group',
		'search_items' => 'Search Colors',
		'all_items' => 'All Color Group',
		'parent_item' => 'Parent Color',
		'parent_item_colon' => 'Parent Color =>',
		'edit_item' => 'Edit Color',
		'update_item' => 'Update Color',
		'add_new_collection' => 'Add A New Color Group',
		'new_item_name' => 'New Color Name',
		'separate_items_with_commas' => 'Seperate colors with commas',
		'add_or_remove_items' => 'Add or Remove Colors',
		'choose_from_most_used' => 'Choose from most used colors',
		'not_found' => 'No artwork matches that color',
		'menu_name' => 'Color Group(s)'
	];

	$color_args = [
		'hierarchical' => false,
		'labels' => $color_labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'rewrite' => ['slug' => 'color']
	];

	register_taxonomy('color', ['artwork'], $color_args);


	//flush_rewrite_rules();
}

add_action('init', 'setup_custom_post_types');

function render_artwork_details($post)
{
	global $wpdb;
	$values = get_post_custom($post->ID);
	$selected_artist = isset($values['Artist']) ? esc_attr($values['Artist'][0]) : null;
	$price = isset($values['Price']) ? intval(esc_attr($values['Price'][0])) : 0;
	$width = isset($values['Width']) ? intval(esc_attr($values['Width'][0])) : 0;
	$height = isset($values['Height']) ? intval(esc_attr($values['Height'][0])) : 0;
	wp_nonce_field('artist_picker_nonce', 'meta_box_nonce');

	// Well.. Because wordpress sucks, here is a customer query to get all the names of the artist posts.
	$results = $wpdb->get_results("SELECT `post_title` FROM wordpress_db.wp_posts WHERE `post_type` = 'artist' AND `post_status` = 'publish'");
	?>
	<table>
		<tr>
			<td>Artist</td>
			<td>
				<select name="Artist" id="Artist">
					<option value="--none--" <?php selected($selected_artist, '--none--'); ?>>--none--</option>

					<!-- Render list of artists: -->
					<?php if ($results): ?>
						<?php foreach ($results as $artist):; ?>
							<?php var_dump($artist); ?>
							<option value="<?php echo $artist->post_title; ?>" <?php selected($selected_artist, $artist->post_title); ?>>
								<?php echo $artist->post_title; ?>
							</option>
						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

				</select>
			</td>
		</tr>
		<tr>
			<td>Price</td>
			<td><input type="number" name="Price" id="Price" value="<?php echo $price; ?>"></td>
		</tr>
		<tr>
			<td colspan="2">
				<h4>Dimensions</h4>
			</td>
		</tr>
		<tr>
			<td>Width</td>
			<td><input type="number" name="Width" id="Width" value="<?php echo $price; ?>"></td>
		</tr>
		<tr>
			<td>Height</td>
			<td><input type="number" name="Height" id="Height" value="<?php echo $price; ?>"></td>
		</tr>
	</table>
	<?php
}

function add_artwork_details()
{
	add_meta_box('artwork_details', 'Artwork Details', 'render_artwork_details', 'artwork', 'side', 'low');
}

add_action('add_meta_boxes', 'add_artwork_details');

function save_artwork_details($post_id)
{
	// Bail if we're doing an auto save
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// if our nonce isn't there, or we can't verify it, bail
	if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'artist_picker_nonce')) return;

	// if our current user can't edit this post, bail
	if (!current_user_can('edit_post')) return;

	// now we can actually save the data
	$allowed = [
		'a' => [ // on allow a tags
			'href' => [] // and those anchors can only have href attribute
		]
	];

	if (isset($_POST['Artist']))
		update_post_meta($post_id, 'Artist', esc_attr($_POST['Artist']));

	// Make sure your data is set before trying to save it
	if( isset( $_POST['Price'] ) )
		update_post_meta( $post_id, 'Price', wp_kses( $_POST['Price'], $allowed ) );
	if( isset( $_POST['Width'] ) )
		update_post_meta( $post_id, 'Width', wp_kses( $_POST['Width'], $allowed ) );
	if( isset( $_POST['Height'] ) )
		update_post_meta( $post_id, 'Height', wp_kses( $_POST['Height'], $allowed ) );

	// This is purely my personal preference for saving check-boxes
	/*
	$chk = isset( $_POST['my_meta_box_check'] ) && $_POST['my_meta_box_select'] ? 'on' : 'off';
	update_post_meta( $post_id, 'my_meta_box_check', $chk );
	*/
}
add_action('save_post', 'save_artwork_details');

function query_intercept($query)
{
	if (!is_admin() && $query->is_main_query()) {
		if ($query->is_home()) {
			$query->set('post_type', ['post', 'artwork', 'artist']);
		}
	}
}

add_action('pre_get_posts', 'query_intercept');

// AJAX request handleing
function test_connection()
{
	$response = ["title" => "Response Data", "content" => "This is a AJAX response data."];
	wp_send_json($response);
}

add_action('wp_ajax_test_connection', 'test_connection');
add_action('wp_ajax_nopriv_test_connection', 'test_connection');
