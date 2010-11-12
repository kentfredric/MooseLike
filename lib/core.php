<?php

function _use( $name ){ 
  $file = $name; 
  $file = str_replace('_','/', $file );
  $file .= '.php';
  require_once(realpath(dirname(__FILE__) . '/' . $file ));
}
