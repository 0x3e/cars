<?php
namespace Øx3e;
require_once('car.php');
class Cars {
  function wordpress_setup() {
    $car = new Car();
    add_action('init',function() use ($car){
      register_taxonomy('car',array('fill'), $car->taxonomy());
    });
    add_action('template_include',function($template){
      global $wp,$wp_query;
      if($wp_query->query_vars['taxonomy']=='car'
        && isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' 
        ){
        $new_template = locate_template( array( 'taxonomy-car_ajax.php' ) );
        if ( '' != $new_template ) {
          return $new_template ;
        }
      }
      elseif ($wp->request == 'car') {
        $new_template = locate_template( array( 'archive-car.php' ) );
        if ( '' != $new_template ) {
          return $new_template ;
        }
      }
      return $template;
    });
    return $this;
  }
  function get_loop($car){
    $loop = new \WP_Query(array(
      'post_type' => 'fill',
      'posts_per_page' => 100,
      'car' => $car )
    );
    return $loop;
  }
}
