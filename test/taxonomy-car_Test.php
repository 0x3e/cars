<?php
namespace Øx3e;
include_once 'test/mocks/mock_wp_functions.php';
include_once 'test/mocks/fill.php';
if(!function_exists('Øx3e\get_the_date')){
  function get_the_date(){return "2015-07-30";}
}
class TaxonomyCarTest extends \PHPUnit_Framework_TestCase
{
  public function testOutput()
  {
    $loop = $this->getMockBuilder('loop')
      ->setMethods(array('have_posts','the_post'))
      ->getMock();
    $loop->method('have_posts')
      ->will($this->onConsecutiveCalls(1,1,0));
    $cars = $this->getMockBuilder('cars')
      ->setMethods(array('get_loop'))
      ->getMock();
    $cars->method('get_loop')->willReturn($loop);
    $cars->fills = $this->getMockBuilder('fills')
      ->setMethods(array('get_formater'))
      ->getMock();
    $fill=new Mock_Fill();
    $cars->fills->method('get_formater')->willReturn($fill);
    $this->expectOutputRegex('/4.00.*5.00.*6.00/');
    include 'dist/themes/min/taxonomy-car.php';
  }
}
