<?php
function wp_head(){}
function wp_footer(){}
function get_the_date(){return "2015-07011";}
class Loop{
  public $a=array(true,true,false);
  function have_posts(){return array_shift($this->a);}
  function the_post(){return true;}
}
class Car{
  function get_loop(){return new Loop();}
}
class Fill{
  public $a=array(1,2,3,4,5,6,7);
  function __call($a,$b){return array_shift($this->a);}
}

class TaxonomyCarTest extends PHPUnit_Framework_TestCase
{
  public function testOutput()
  {
    $this->expectOutputRegex('/2.00/');
    include 'dist/theme/min/taxonomy-car.php';
  }
}
