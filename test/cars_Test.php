<?php
namespace Øx3e;
include_once 'test/mocks/mock_wp_functions.php';
include 'dist/plugins/cars/cars.php';
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
    $this->assertTrue(get_class($loop)=='WP_Query');
  }
}
