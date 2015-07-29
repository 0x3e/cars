<?php
namespace Øx3e;
require_once('fill.php');
class Fills {
  function wordpress_setup(){
    $fill = new Fill();
    add_action('init', function () use ($fill){
      register_post_type('fill',$fill->post_type());
    });
    add_action("admin_init", array($fill,"admin_init"));
    add_action('save_post', array($fill,'save_details'));
    add_filter("manage_edit-fill_columns", array($fill,"edit_columns"));
    add_action("manage_fill_posts_custom_column", array($fill,"custom_columns"));
    return $this;
  }
  function get_formater(){
    return new Fill();
  }
}
