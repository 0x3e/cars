<?php
/*
Plugin Name: Cars
Plugin URI:  http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This describes my plugin in a short sentence
Version:     1.0
Author:      0x3e
*/
if(php_sapi_name()!='cli') defined( 'ABSPATH' ) or die( 'No!' );
require(__DIR__.'/controller/cars_controller.php');
$cars_controller = new Cars_Controller();
