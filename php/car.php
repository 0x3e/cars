<?php
class Car {
  private $car;
  function taxonomy() {
    $labels = array(
      'name'                       => _x( 'Cars', 'Taxonomy General Name', 'text_domain' ),
      'singular_name'              => _x( 'Car', 'Taxonomy Singular Name', 'text_domain' ),
      'menu_name'                  => __( 'Cars', 'text_domain' ),
      'all_items'                  => __( 'All Cars', 'text_domain' ),
      'new_item_name'              => __( 'New Car Name', 'text_domain' ),
      'add_new_item'               => __( 'Add New Car', 'text_domain' ),
      'edit_item'                  => __( 'Edit Car', 'text_domain' ),
      'update_item'                => __( 'Update Car', 'text_domain' ),
      'view_item'                  => __( 'View Item', 'text_domain' ),
      'separate_items_with_commas' => __( 'Separate cars with commas', 'text_domain' ),
      'add_or_remove_items'        => __( 'Add or remove genres', 'text_domain' ),
      'choose_from_most_used'      => __( 'Choose from the most used cars', 'text_domain' ),
      'popular_items'              => __( 'Popular Items', 'text_domain' ),
      'search_items'               => __( 'Search cars', 'text_domain' ),
      'not_found'                  => __( 'Not Found', 'text_domain' ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => true,
      'with_front'                 => false,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => true,
      'show_tagcloud'              => true,
    );
    return $args;
  }
  function __construct($car=false){
    if($car)
      $this->car=$car;
  }
  function get_loop(){
    $loop = new WP_Query(array(
      'post_type' => 'fill',
      'posts_per_page' => 100,
      'car' => $this->car )
    );
    return $loop;
  }

}
