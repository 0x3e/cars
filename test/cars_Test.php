<?php
namespace Øx3e;
include_once 'test/empty_wp_functions.php';
include 'dist/plugin/cars/cars.php';
class CarsTest extends \PHPUnit_Framework_TestCase
{
  public function testLoop()
  {
    $wp_query = $this->getMockBuilder('mock_wp_query')
      ->setMockClassName('WP_Query')
      ->setMethods(array('have_posts','the_post'))
      ->getMock();
    $cars = new Cars();
    $loop = $cars->get_loop('test');
    print_r($loop);
  }
}
