<?php

class MooseLike_Meta_Object { 

  public $attributes = array();
  public $methods    = array();
  public $class;
  #public $object;

  public function __construct( $class , $object ){
    $this->class = $class;
    #$this->object = $object;
  }
  public function add_attribute( $name , $properties ){ 
    $this->attributes[$name] = $properties;
  }
  public function add_method( $name, $callref ){ 
    $this->methods[$name] = $callref;
  }
  public function has_attribute( $name ){
    return isset( $this->attributes[$name] );
  }
  public function has_method( $name ){ 
    return isset( $this->methods[$name] );
  }

  public function require_attribute( $name ){ 
    if ( ! $this->has_attribute( $name ) ){ 
      throw new CodeParamException("'$name' is not a valid attribute for " . $this->class);
    }
  }
  public function require_method( $name ){ 
    if ( ! $this->has_method($name)){
      throw new CodeException("'$name' is not a method for " . $this->class );
    }
  }
  public function initialise_attribute( $name , $object, $config ){
    $this->require_attribute( $name );
    if( isset( $object->_stash[$name] ) ){ 
      return;
    }
    if( isset( $config['value'] ) && isset( $this->attributes[$name]['noinit'] ) && $this->attributes[$name]['noinit'] ){ 
      throw new CodeParamException("'$name' is an unsettable property for " . $this->class );
    }
    if( isset( $config['value'] ) ){ 
      $object->_stash[$name] = $config['value'];
    }
    if( isset( $this->attributes[$name]['required'] ) && $this->attributes[$name]['required'] ){ 
      if( !isset( $object->_stash[$name] ) ){
        throw new CodeParamException("'$name' is a required property for "  . $this->class . " but it is not defined" );
      }
    }
  }

  public function pre_validate_attribute( $name, $object, $value ){
    
  }
  public function read_attribute( $name, $object ){
    $this->initialise_attribute( $name, $object, array() );
    return $object->_stash[$name];
  }
  public function call_method( $name, $object, $args ){ 
    $this->require_method( $name );
    $method = $this->methods[$name];
    array_unshift( $args, $object );
    return call_user_func_array( $method, $args );
  }
}
