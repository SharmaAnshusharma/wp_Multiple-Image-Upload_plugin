<?php
/*Plugin Name: Upload Multiple Images
Plugin URI:
Author: Anshu Sharma
version:1.1
description:This is a plugin which is build for uploading multiple images with media handle upload*/

function include_css_js_files()
{
	wp_register_style('css_file1','https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
	wp_enqueue_style('css_file1');


	wp_register_script('js_file1','https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
	wp_enqueue_script('js_file1');
	wp_register_script('js_file2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js');
	wp_enqueue_script('js_file2');
	wp_register_script('js_file3','https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js');
	wp_enqueue_script('js_file3');

}
add_action('admin_enqueue_scripts','include_css_js_files');
function add_plugin_menu()
{
	add_menu_page(
		'Upload Image',
		'Upload Image',
		'manage_options',
		'upload-multiple-image',
		'upload_multiple_image'
	);
	
	
}
add_action('admin_menu','add_plugin_menu');


function upload_multiple_image()
{
	include (plugin_dir_path(__FILE__).'/inc/file.php');
}

?>



