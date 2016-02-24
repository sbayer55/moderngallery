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

$referrer = isset($_post['referrer']) ? $_post['referrer'] : 'thesilentvowel.com';

get_header(); ?>

<section class="container">
	<form id="user_registration" action="<?php echo $referrer; ?>" method="post">
		<input type="hidden" name="action" value="register_user">
		<table class="table table-striped table-responsive">
			<thead>
			<tr>
				<td class="text-right">Field Name</td>
				<td class="">Value</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td class="text-right"><label for="email">Email</label></td>
				<td class=""><input type="text" name="email" id="email" class="register" maxlength="300"></td>
			</tr>
			<tr>
				<td class="text-right"><label for="phone">Phone Number</label></td>
				<td class=""><input type="text" name="phone" id="phone" class="register" maxlength="10"></td>
			</tr>
			<tr>
				<td class="text-right"><label for="password">Password</label></td>
				<td class="">
					<input type="password" name="password" id="password" class="register" maxlength="300">
					<input type="password" name="password_2" id="password_2" class="register" maxlength="300">
				</td
			</tr>
			<tr>
				<td class="text-right"><label for="first_name">First Name</label></td>
				<td class=""><input type="text" name="first_name" id="first_name" class="register"
											maxlength="300"></td>
			</tr>
			<tr>
				<td class="text-right"><label for="last_name">Last Name</label></td>
				<td class=""><input type="text" name="last_name" id="last_name" class="register"
											maxlength="300"></td>
			</tr>
			<tr>
				<td class="text-right"><label for="street_1">Street</label></td>
				<td class=""><input type="text" name="street_1" id="street_1" class="register" maxlength="300">
				</td>
			</tr>
			<tr>
				<td class="text-right"><label for="street_2">Apartment / Suite</label></td>
				<td class=""><input type="text" name="street_2" id="street_2" class="register" maxlength="300">
				</td>
			</tr>
			<tr>
				<td class="text-right"><label for="city">City</label></td>
				<td class=""><input type="text" name="city" id="city" class="register" maxlength="300"></td>
			</tr>
			<tr>
				<td class="text-right"><label for="state">State</label></td>
				<td class=""><input type="text" name="state" id="state" class="register" maxlength="300"></td>
			</tr>
			<tr>
				<td class="text-right"><label for="zip">Zip code</label></td>
				<td class=""><input type="text" name="zip" id="zip" class="register" maxlength="5"></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">
					<input type="submit" class="btn btn-primary" value="Register">
				</td>
			</tr>
			</tbody>
		</table>
	</form>
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
		$('#user_registration').validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				first_name: {
					minlength: 2,
					required: true
				}
			},
			highlight: function (element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function (element) {
				element.text('OK!').addClass('valid')
					.closest('.control-group').removeClass('error').addClass('success');
			}
		});
	})
</script>

<?php get_footer(); ?>
