<?php
/**
 * Plugin Name: Telephonist
 * Description: Button for quick communication of the client from the site
 * Plugin URI:  
 * Author URI:  https://web-triton.com
 * Author:      Team Web-Triton
 * Version:     2.0
 *
 * Text Domain: wp_telephonist
 * Domain Path: 
 *
 * License:     
 * License URI: 
 *
 * Network:     false
 */

define('PLUGIN_PATH', plugins_url('/', __FILE__));


add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_style( 'telephonist-admin-css', PLUGIN_PATH .'assets/css/admin-css.css' );
}, 99 );

add_action( 'wp_enqueue_scripts', 'wp_telephonist_style' );
function wp_telephonist_style() {
	wp_enqueue_style( 'wp-telephonist-style', PLUGIN_PATH.'/assets/css/main.css', false );
	wp_enqueue_style( 'wp-font-awesome-style', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false );
}

add_action("wp_footer", "wp_telephonist_markup");
function wp_telephonist_markup() { ?>

	<div class="telephonist">
		<a href="tel:+61312345678" title="<?php _e('Call the director'); ?>">
			<div class="phone-call" style="background-color:#03a9f4;color: #fff;left: 20px;">
				<i class="fas fa-phone-alt"></i>
			</div>
		</a>
	</div>

<?php }







add_action('admin_menu', function(){
	add_menu_page( 'Telephonist', 'Telephonist', 'manage_options', 'telephonistka', 'wp_telephonist_setting', 'dashicons-phone', 100 ); 
} );

function wp_telephonist_setting(){
	?>
	<div class="wrap">
		<div class="admin-telephonist" style="margin-top: 40px;">
			<div class="admin-telephonist-item">
				<h2><?php _e('Telephonist',); ?></h2>
				<p><?php _e('Button for quick communication of the client from the site'); ?></p>

				<div class="admin-telephonist-form">
					<form action="<?php echo PLUGIN_PATH ?>handlers/data.php" method="POST">

						<label for="wp_telephonist_phone"> <?php _e('Phone number:'); ?> </label>
						<p>
							<span>+</span>
							<input id="wp_telephonist_phone" type="tel" name="wp_telephonist_phone" placeholder="61 3 (1) 234-56-78">
						</p>

						<label for="wp_telephonist_anchor_title"> <?php _e('Anchor title:'); ?> </label>
						<input id="wp_telephonist_anchor_title" type="text" name="wp_telephonist_anchor_title" placeholder="<?php _e('Call the director'); ?>">

						<input type="submit" name="wp_telephonist_submit" value="<?php _e('Save'); ?>">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php

}


// Добавим подменю в меню админ-панели "Инструменты" (tools):
add_action('admin_menu', 'wp_telephonistka_submenu_settings');

function wp_telephonistka_submenu_settings() {
	add_submenu_page( 
		'telephonistka',
		'Settings',
		'Settings',
		'manage_options',
		'settings-telephonistka',
		'wp_telephonistka_settings'
	);
}

function wp_telephonistka_settings() { ?>
	<div class="wrap">
		<div class="admin-telephonist-item">
			<h2><?php _e('Location'); ?></h2>
			<p><?php _e('Choose where the widget should be located'); ?></p>

			<div class="admin-telephonist-form">
				<form action="<?php echo PLUGIN_PATH ?>handlers/location.php" method="POST">
					<label for=""><?php _e('Position'); ?>:</label>
					<select name="" id="">
						<option value="left"><?php _e('Bottom left') ?></option>
						<option value="right"><?php _e('Bottom right') ?></option>
					</select>

					<label for=""> <?php _e('Button background'); ?>: </label>
					<input type="color" value="#03a9f4">

					<label for=""> <?php _e('Icon color'); ?>: </label>
					<input type="color" value="#ffffff">

					<input type="submit" name="wp_telephonist_submit" value="<?php _e('Save'); ?>">
				</form>
			</div>
		</div>
	</div>
<?php }