<?php
class Fill {
  function post_type() {
    $labels = array(
        'name' => 'Fills',
        'singular_name' => 'Fill',
        'add_new' => 'Add Fill',
        'all_items' => 'All Fills',
        'add_new_item' => 'Add New Fill',
        'edit_item' => 'Edit Fill',
        'new_item' => 'New Fill',
        'view_item' => 'View Fill',
        'search_items' => 'Search Fills',
        'not_found' =>  'No Fills found',
        'not_found_in_trash' => 'No Fills found in trash',
        'parent_item_colon' => 'Parent Fill:',
        'menu_name' => 'Fills'
    );
    $args = array(
      'can_export' => true,
      'capability_type' => 'page',
      'description' => "These are fills.",
      'exclude_from_search' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'labels' => $labels,
      'menu_icon' => null,
      'menu_position' => 21,
      'public' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'fill'),
      'show_in_admin_bar' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'supports' => array('author','revisions','title'),
      'taxonomies' => array('car')
    );
    return $args;
  }
  function admin_init(){
    add_meta_box("fill_meta", "Fill Details", array($this,"meta_fill"), "fill", "normal", "high");
  }
  function meta_fill(){
    global $post;
    $custom = get_post_custom($post->ID);
    $litres = $custom["litres"][0];
    $kilometres = $custom["kilometres"][0];
    $dollars = $custom["dollars"][0];
    ?>
    <label>L</label>
    <input name="litres" value="<?php echo $litres; ?>" />
    <br/><label>K</label>
    <input name="kilometres" value="<?php echo $kilometres; ?>" />
    <br/><label>$</label>
    <input name="dollars" value="<?php echo $dollars; ?>" />
    <?php
  }
  function save_details(){
    global $post;

    update_post_meta($post->ID, "litres", $_POST["litres"]);
    update_post_meta($post->ID, "kilometres", $_POST["kilometres"]);
    update_post_meta($post->ID, "dollars", $_POST["dollars"]);
  }
  function custom_columns($column){
    global $post;
    switch ($column) {
      case "litres":
        echo get_post_meta( $post->ID , 'litres' , true );
        break;
      case "kilometres":
        echo get_post_meta( $post->ID , 'kilometres' , true );
        break;
      case "dollars":
        echo get_post_meta( $post->ID , 'dollars' , true );
        break;
    }
  }
  function edit_columns($columns){
    $columns = array(
      "cb" => '<input type="checkbox" />',
      "title" => "T",
      "litres" => "L",
      "kilometres" => "K",
      "dollars" => "D"
    );

    return $columns;
  }
  function get_meta($key){
    $meta = get_post_meta(get_the_ID());
    if($meta["$key"])
      return $meta["$key"][0];
  }
  function get_litres(){
    return $this->get_meta('litres');
  }
  function get_kilometres(){
    return $this->get_meta('kilometres');
  }
  function get_dollars(){
    return $this->get_meta('dollars');
  }
  function get_dollars_per_litre(){
    return $this->get_meta('dollars')/$this->get_meta('litres');
  }
  function get_litres_per_hundred_km(){
    return $this->get_meta('litres')/$this->get_meta('kilometres')*100;
  }
  function get_km_per_litre(){
    return $this->get_meta('kilometres')/$this->get_meta('litres');
  }
  function get_dollars_per_hundred_km(){
    return $this->get_dollars_per_litre() * $this->get_litres_per_hundred_km();
  }
}
