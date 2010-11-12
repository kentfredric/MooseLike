<?php

class MooseLike_Exception extends Exception {

  private $trace;

  public function __construct(){
    $args = func_get_args();
    call_user_func_array('parent::__construct', $args );
    $this->trace = $this->getTrace();
    if(preg_match('/Exceptions.php$/', $this->file ) ){
      $trace = $this->getTrace();
      $this->file = $trace[1]['file'];
      $this->line = $trace[1]['line'];
      array_shift($trace);
      $this->trace = $trace;
    }
  }
  public function cTrace(){
    $trace = $this->getTrace();
    array_shift($trace);
    return $trace;
  }
}

function ___generate_Exceptions(){
  $exception_tree = array(
    'Code' => '',
    'Constructor' => 'Code',
    'Attribute' => 'Code',
    'NotImplemented' => '',

  );
  foreach( $exception_tree  as $exception_name  => $isa ){
    if( $isa ){
      eval("class MooseLike_Exception_{$exception_name}Exception extends MooseLike_Exception_{$isa}Exception { }");
    } else {
      eval("class MooseLike_Exception_{$exception_name}Exception extends MooseLike_Exception { }");
    }
  }
}

___generate_Exceptions();

class MooseLike_Exception_AttributeMissingException extends MooseLike_Exception_AttributeException {
  public function __construct( $name ){
    parent::__construct("No such attribute '$name'");
  }
}

class MooseLike_Exceptions {
 
  public static function notimplemented(){
    $args = func_get_args();
    $ref  = new ReflectionClass('MooseLike_Exception_NotImplementedException');
    throw $ref->newInstanceArgs( $args );
  }

  public static function code(){
    $args = func_get_args();
    $ref  = new ReflectionClass('MooseLike_Exception_CodeException');
    throw $ref->newInstanceArgs( $args );
  }
  public static function constructor(){
    $args = func_get_args();
    $ref  = new ReflectionClass('MooseLike_Exception_ConstructorException');
    throw $ref->newInstanceArgs( $args );
  }
  public static function attribute(){
    $args = func_get_args();
    $ref  = new ReflectionClass('MooseLike_Exception_AttributeException');
    throw $ref->newInstanceArgs( $args );
  }
  public static function attribute_missing(){
    $args = func_get_args();
    $ref  = new ReflectionClass('MooseLike_Exception_AttributeMissingException');
    throw $ref->newInstanceArgs( $args );
  }


}
