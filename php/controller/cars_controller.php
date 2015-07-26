<?php

class Cars_Controller{
  function __construct() {
    require_once(__DIR__.'/../models/car.php');
    require_once(__DIR__.'/../models/fill.php');
    $car = new Car();
    add_action( 'init', array( $car, 'taxonomy' ) );
    add_action( 'template_include', function ($template){
      global $wp;
      if ($wp->request == 'car') {
        $new_template = locate_template( array( 'archive-car.php' ) );
        if ( '' != $new_template ) {
          return $new_template ;
        }
      }
      return $template;
    });
    $fill = new Fill();
    add_action('init',array($fill,'create_post_type'));
    add_action("admin_init", array($fill,"admin_init"));
    add_action('save_post', array($fill,'save_details'));
    add_filter("manage_edit-fill_columns", array($fill,"edit_columns"));
    add_action("manage_fill_posts_custom_column", array($fill,"custom_columns"));
  }
}
/*
create or replace view fills as 
select p.id, t.name as car, p.post_date,
group_concat(case when m.meta_key = 'litres' then m.meta_value end) l, 
group_concat(case when m.meta_key = 'kilometres' then m.meta_value end) k, 
group_concat(case when m.meta_key = 'dollars' then m.meta_value end) d 
from wp_posts p join wp_postmeta m on m.post_id = p.id  
left join wp_term_relationships r on r.object_id = p.id  
left join wp_terms t on r.term_taxonomy_id = t.term_id group by p.id;
*/
