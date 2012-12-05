<?php
/*
Plugin Name: My wp video plugin
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Sille Van Landschoot
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

require_once ('Formbuilder.php');

class Video{

	function __construct() {
		add_action( 'admin_menu', array($this,'adminpage') );
		add_shortcode( 'video', array($this,'showVideo' ));
	}

	public function adminpage()
	{
		add_menu_page( 'My video plugin', 'Video', 'manage_options', 'video', array($this, 'videoOptions'));
	}

	public function showVideo($atts)
	{
		extract( shortcode_atts( array(
			'id' => 'Wic2Ychvpdg',
		), $atts ) );
		$width = get_option('videosize');
		$height = ($width*9)/16;

		return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
	}

	public function videoOptions()
	{
		if($_POST['submit']){
			$videosize = $_POST['videosize'];
			update_option('videosize', $videosize);
		}		
		

		$output = "<h2>Video options</h2>";
		$form = new Formbuilder(HttpMethod::POST);
		$form->addFormInput(new FormInput(
		    FormInputElement::TEXT,
		    "videosize",
		    "videosize",
		    get_option('videosize')
		    ));

		$form->addFormInput(new FormInput(
		    FormInputElement::SUBMIT,
		    "Verzenden",
		    "submit",
		    "Verzenden"
		    ));
		$output .= $form->getForm();
		echo $output;
	}
}



global $video;
if(class_exists(Video) && !$video){
	$video = new Video();
}




