<?php
/*
Plugin Name: Cars
Plugin URI:  http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This describes my plugin in a short sentence
Version:     1.0
Author:      0x3e
*/
if(php_sapi_name()!='cli') defined( 'ABSPATH' ) or die( 'No!' );
require_once 'Øx3e/cars.php';
$cars = (new Øx3e\Cars())->wordpress_setup();
require_once 'Øx3e/fills.php';
$cars->fills = (new Øx3e\Fills())->wordpress_setup();
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
