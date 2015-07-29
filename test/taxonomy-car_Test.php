<?php
namespace Øx3e;
include_once 'test/empty_wp_functions.php';
function get_the_date(){return "2015-07011";}
class Mock_Fill{
  public $a=array(1,2,3,4,5,6,7);
  function __call($a,$b){return array_shift($this->a);}
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
    $fills = $this->getMockBuilder('fills')
      ->setMethods(array('get_formater'))
      ->getMock();
    $fill=new Mock_Fill();
    $fills->method('get_formater')->willReturn($fill);
    $this->expectOutputRegex('/4.00.*5.00.*6.00/');
    include 'dist/theme/min/taxonomy-car.php';
  }
}
