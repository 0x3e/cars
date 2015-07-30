<?php
namespace Øx3e;
class Mock_Fill{
  public $a=array(1,2,3,4,5,6,7);
  function __call($a,$b){return array_shift($this->a);}
}
